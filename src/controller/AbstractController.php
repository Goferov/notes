<?php

declare(strict_types=1);



namespace App\Controller;


use App\Exception\ConfiguartionException;
use App\Exception\NotFoundException;
use App\Exception\StorageException;
use App\model\NoteModel;
use App\Request;
use App\View;

;;

abstract class AbstractController
{
    protected const DEFAULT_ACTION = 'list';
    protected static array $configuration = [];
    protected Request $request;
    protected View $view;
    protected NoteModel $noteModel;

    public static function initConfiguration(array $configuration): void {
        self::$configuration = $configuration;
    }
    public function __construct(Request $request) {
        if(empty(self::$configuration['db'])) {
            throw new ConfiguartionException('NoteModel configuration error');
        }
        $this->noteModel = new NoteModel(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();
    }

    public function run(): void {
        try {
            $action = $this->action() . 'Action';
            if(!method_exists($this, $action)) {
                $action = self::DEFAULT_ACTION . 'Action';
            }
            $this->$action();
        }
        catch (StorageException $e) {
            dump($e->getMessage());
            $this->view->render('404',['msg'=>$e->getMessage()]);
        }
        catch (NotFoundException $e) {
            $this->redirect('/',['error'=>'noteNotFound']);
        }
    }

    protected function redirect(string $to, array $params):void {

        $location = $to;

        if($params) {
            $queryParams = [];
            foreach ($params as $key=>$param) {
                $queryParams[] = urlencode($key) . '=' . urlencode($param);
            }
            $queryParams = implode('&',$queryParams);
            $location .= '?' . $queryParams;
        }
        header('Location: '.$location);
        exit();
    }

    private function action(): string {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }


}