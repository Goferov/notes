<?php
declare(strict_types=1);

namespace App;

require_once "src/exception/ConfiguartionException.php";

use App\Exception\ConfiguartionException;
use App\Exception\NotFoundException;

require_once "src/View.php";
require_once "src/Database.php";

class Controller
{
    private const DEFAULT_ACTION = 'list';
    private static array $configuration = [];
    private Request $request;
    private View $view;
    private Database $db;

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

        $viewParams = [];
        switch ($this->action()) {
            case 'create':
                $page = 'create';

                if($this->request->hasPost()) {
                    $this->db->createNote([
                        'title' => $this->request->postParam('title'),
                        'description' => $this->request->postParam('description'),
                    ]);
                    header('Location: /?msg=created');
                    exit();
                }

                break;
            case 'show':
                $page = 'show';
                $noteId = (int) $this->request->getParam('id');

                if(!$noteId) {
                    header('Location: /?error=missingNoteId');
                    exit();
                }

                try {
                    $note = $this->db->getNote($noteId);
                }
                catch (NotFoundException $e) {
                    header('Location: /?error=noteNotFound');
                    exit();
                }

                $viewParams = [
                    'note' => $note,
                ];

                break;
            default:
                $page = 'list';

                $viewParams = [
                    'msg' => $this->request->getParam('msg'),
                    'error' => $this->request->getParam('error'),
                    'notes' => $this->db->getNotes(),
                ];
                break;
        }

        $this->view->render($page, $viewParams);
    }
    private function action(): string {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}