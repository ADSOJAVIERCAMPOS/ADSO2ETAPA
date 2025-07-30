<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    //Define no se encuentra el rol
    //__construct inyecta
    public function __construct($message = 'not found', $code = 404)
    {
        parent::__construct($message, $code);
    }
}
