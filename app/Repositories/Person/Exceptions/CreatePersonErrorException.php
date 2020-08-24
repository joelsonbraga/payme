<?php

namespace App\Repositories\Person\Exceptions;

use App\Repositories\BaseException;
use Throwable;

class CreatePersonErrorException extends BaseException
{
    public function __construct(string $message, int $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to create Person.'  . $message), $code, $previous);
    }
}
