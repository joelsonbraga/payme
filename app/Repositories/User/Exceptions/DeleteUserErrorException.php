<?php

namespace App\Repositories\User\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class DeleteUserErrorException extends BaseException
{
    public function __construct(string $message, $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to delete User.'  . $message), $code, $previous);
    }
}