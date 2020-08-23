<?php

namespace App\Repositories\WalletTransaction\Exceptions;

use App\Repositories\BaseException;
use Throwable;

/**
 * Class WalletTransactionNotFoundException
 * @package App\Repositories\WalletTransaction\Exceptions
 */
class WalletTransactionNotFoundException extends BaseException
{
    /**
     * WalletTransactionNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, $code = 404, Throwable $previous = null)
    {
        parent::__construct(__('WalletTransaction not found.'  . $message), $code, $previous);
    }
}
