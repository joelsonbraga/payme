<?php

namespace App\Repositories\User\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class CreateUserErrorException extends BaseException
{
    public function __construct(string $message, int $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to create User.'  . $message), $code, $previous);
    }
}