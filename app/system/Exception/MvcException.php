<?php

namespace app\system\Exception;

use Exception;

class MvcException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * generate Error Exception due to error occur
     */
    public function showException($file = [])
    {
        $bt = debug_backtrace();
        return [
            'message' => $this->getMessage(),
            'used_file' => [
                'file' => $bt[0]['file'] . ' at line: ' . $bt[0]['line'],
                'class' => $bt[1]['class'],
                'method' => $bt[1]['function'] . '()',
//                'called by' => $this->getCaller()
            ]
        ];
    }

}