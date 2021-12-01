<?php

namespace app\system;

use app\system\exception\MvcException;

class Controller
{
    protected $params;

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Model Handler
     * @param $model
     * @return mixed
     */
    public function model($model)
    {
        try {
            if (class_exists('\\app\models\\' . $model)) {

                $model = "\\app\\models\\$model";
                return new $model;

            } else {
                throw new MvcException("Model '$model' does not exist");
            }

        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));
        }
    }

    /**
     * Load View File
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {

        try {

            if (file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                throw new MvcException("Requested view '$view' does not exist");
            }
        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }

    /**
     * This will load library
     * @param string $library
     * @return mixed
     */
    public function load($library = '')
    {
        try {
            switch ($library) {
                case 'database':
                    $library = "\\app\\core\\libraries\\$library";
                    return new $library();
                case 'form':
                    $library = "\\app\\core\\validator\\$library";
                    return new $library();
                default:
                    throw new MvcException("library '$library' does not exist");
            }
        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }

    /**
     * This will load helpers
     * @param string $helper
     * @return mixed
     */
    public function helpers($helper = '')
    {
        try {
            $helper = "\\app\\core\\helpers\\$helper";
            if (class_exists($helper)) {
                return new $helper;
            } else {
                throw new MvcException("library '$helper' does not exist");
            }

        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }


    /**
     * @param $config
     */
    public function config($config)
    {
        try {

            if (file_exists('../app/config/' . $config . '.php')) {

                require_once '../app/config/' . $config . '.php';
            } else {

                throw new MvcException("config file '$config' does not exist");
            }

        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }


}