<?php

namespace App\Repositories\WalletTransaction\Exceptions;

use App\Repositories\BaseException;
use Throwable;

/**
 * Class DeleteWalletTransactionErrorException
 * @package App\Repositories\WalletTransaction\Exceptions
 */
class DeleteWalletTransactionErrorException extends BaseException
{
    /**
     * DeleteWalletTransactionErrorException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to delete WalletTransaction.'  . $message), $code, $previous);
    }
}
