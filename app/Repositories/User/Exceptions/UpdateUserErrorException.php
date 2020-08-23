<?php

namespace App\Repositories\User\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class UpdateUserErrorException extends BaseException
{
    public function __construct(string $message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to update User.'  . $message), $code, $previous);
    }
}