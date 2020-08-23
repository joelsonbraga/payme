<?php

namespace App\Repositories\Person\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class UpdatePersonErrorException extends BaseException
{
    public function __construct(string $message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to update Person.'  . $message), $code, $previous);
    }
}