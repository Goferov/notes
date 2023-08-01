<?php
declare(strict_types=1);

namespace App;

require_once "src/exception/ConfiguartionException.php";

use App\Exception\ConfiguartionException;

require_once "src/View.php";
require_once "src/Database.php";

class Controller
{
    private const DEFAULT_ACTION = 'list';
    private static array $configuration = [];
    private array $request;
    private View $view;
    private Database $db;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }
    public function __construct(array $request)
    {
        if(empty(self::$configuration['db'])) {
            throw new ConfiguartionException('Database configuration error');
        }
        $this->db = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();
    }


    public function run(): void
    {

        $viewParams = [];
        switch ($this->action()) {
            case 'create':
                $page = 'create';

                $data = $this->getRequestPost();
                if($data) {
                    $this->db->createNote([
                        'title'=>$data['title'],
                        'description'=>$data['description'],
                    ]);
                    header('Location: /?msg=created');
                }
                break;
            case 'show':
                $page = 'show';
                $viewParams = [
                    'title'=>'Moja notatka',
                    'description'=>'Opis',
                ];
                break;
            default:
                $page = 'list';

                $data = $this->getRequestGet();

                $viewParams = [
                    'msg' => $data['msg'] ?? null,
                    'notes' => $this->db->getNotes(),
                ];

                break;
        }

        $this->view->render($page, $viewParams);
    }
    private function action(): string {
        $data = $this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    }
    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }

    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }
}