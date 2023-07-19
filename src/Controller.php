<?php
declare(strict_types=1);

namespace App;
require_once "src/View.php";

class Controller
{
    private const DEFAULT_ACTION = 'list';

    private array $postData;
    private array $getData;
    public function __construct(array $getData, array $postData)
    {
        $this->postData = $postData;
        $this->getData = $getData;
    }
    public function run(): void
    {
        $action = $this->getData['action'] ?? self::DEFAULT_ACTION;

        $view = new View();
        $viewParams = [];
        switch ($action) {
            case 'create':
                $page = 'create';
                $created = false;
                if($this->postData) {
                    $created = true;
                    $viewParams = [
                        'title'=>$this->postData['title'],
                        'description'=>$this->postData['description']
                    ];
                }
                $viewParams['created'] = $created;
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
                break;
        }

        $view->render($page, $viewParams);
    }
}