<?php

namespace App\Repositories\User\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class UserNotFoundException extends BaseException
{
    public function __construct(string $message, $code = 404, Throwable $previous = null)
    {
        parent::__construct(__('User not found.'  . $message), $code, $previous);
    }
}