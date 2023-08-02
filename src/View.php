<?php
    declare(strict_types=1);

    namespace App;

    class View
    {
        private function escape(array $params): array {
            $clear_params = [];

            foreach ($params as $key=>$param) {
                if(is_array($param)) {
                    $clear_params[$key] = $this->escape($param);
                }
                else if(!$param || is_numeric($param)) {
                    $clear_params[$key] = ($param);
                }
                else {
                    $clear_params[$key] = htmlentities($param);
                }
            }

            return $clear_params;
        }
        public function render(string $page, array $params = []): void
        {
            $params = $this->escape($params);
            include_once('templates/layout.php');
        }
    }