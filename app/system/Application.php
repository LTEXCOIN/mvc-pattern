<?php

namespace app\system;

/*
 * This is main class of mvc that handles and load
 */

use app\core\Exception\MvcDBException;
use app\system\exception\MvcException;
use ArgumentCountError;

class Application
{
    /**
     * @var string
     */
    //protected $controller = 'home';
    protected $controller;

    /**
     * @var string
     */
    // protected $method = 'index';
    protected $method;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * App constructor.
     */
    public function __construct()
    {

        $url = $this->parseUrl();
        $controller = new Controller();
        $controller->config('environment');
        $controller->config('database');

        try {
            if (class_exists('\\app\controllers\\' . $url[0])) {

                $this->controller = $url[0];
                unset($url[0]);

                $classStr = $this->controller;
                $this->controller = "\\app\\controllers\\$classStr";
                $this->controller = new $this->controller;

                if (isset($url[1])) {

                    try {
                        if (method_exists($this->controller, $url[1])) {
                            $this->method = $url[1];
                            unset($url[1]);
                        } else {
                            throw new MvcException('Method ' . $url[1] . ' Not found');
                        }
                        $this->params = $url ? array_values($url) : [];

                        try {
                            call_user_func_array([$this->controller, $this->method], $this->params);

                        } catch (ArgumentCountError $exception) {

                            echo '<pre>';
                            $bt = debug_print_backtrace();
                            print_r([
                                'message' => $exception->getMessage(),
                                'used_file' => [
                                    'file' => $bt[0]['file'] . ' at line: ' . $bt[0]['line'],
                                    'class' => $bt[1]['class'],
                                    'method' => $bt[1]['function'] . '()',
//                'called by' => $this->getCaller()
                                ]
                            ]);
                        }
                    } catch (MvcException $exception) {

                        echo '<pre>';
                        print_r($exception->showException([
                            debug_print_backtrace()
                        ]));
                    }
                }

            } else {
                throw new MvcException('Class ' . $url[0] . ' Not found');
            }

            $controller = new Controller();
            $controller->config('environment');

        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));
        }

    }

    /**
     * Parse Url params
     * @return false|string[]
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {

            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        } else {
            echo 'no';

        }
    }
}