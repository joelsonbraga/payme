<?php

namespace App\Repositories\WalletTransaction\Exceptions;

use App\Repositories\BaseException;
use Throwable;

/**
 * Class CreateWalletTransactionErrorException
 * @package App\Repositories\WalletTransaction\Exceptions
 */
class CreateWalletTransactionErrorException extends BaseException
{
    /**
     * CreateWalletTransactionErrorException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to create WalletTransaction.'  . $message), $code, $previous);
    }
}
