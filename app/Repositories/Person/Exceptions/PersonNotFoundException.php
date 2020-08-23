<?php

namespace App\Repositories\Person\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class PersonNotFoundException extends BaseException
{
    public function __construct(string $message, $code = 404, Throwable $previous = null)
    {
        parent::__construct(__('Person not found.'  . $message), $code, $previous);
    }
}