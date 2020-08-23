<?php

namespace App\Repositories\Person\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class DeletePersonErrorException extends BaseException
{
    public function __construct(string $message, $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to delete Person.'  . $message), $code, $previous);
    }
}
