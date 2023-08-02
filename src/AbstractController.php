<?php

declare(strict_types=1);

namespace App;

require_once "src/View.php";
require_once "src/Database.php";
require_once "src/exception/ConfiguartionException.php";

use App\Exception\ConfiguartionException;

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
        $action = $this->action() . 'Action';

        if(!method_exists($this, $action)) {
            $action = self::DEFAULT_ACTION . 'Action';
        }
        $this->$action();
    }
    private function action(): string {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}