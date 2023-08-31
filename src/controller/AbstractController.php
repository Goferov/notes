<?php

declare(strict_types=1);



namespace App\Controller;


use App\Database;
use App\Exception\ConfiguartionException;
use App\Exception\StorageException;;
use App\Exception\NotFoundException;;
use App\Request;
use App\View;

abstract class AbstractController
{
    protected const DEFAULT_ACTION = 'list';
    protected static array $configuration = [];
    protected Request $request;
    protected View $view;
    protected Database $db;

    public static function initConfiguration(array $configuration): void {
        self::$configuration = $configuration;
    }
    public function __construct(Request $request) {
        if(empty(self::$configuration['db'])) {
            throw new ConfiguartionException('Database configuration error');
        }
        $this->db = new Database(self::$configuration['db']);
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