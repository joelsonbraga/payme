<?php

namespace App\Repositories\WalletTransaction\Exceptions;

use App\Repositories\BaseException;
use Throwable;

/**
 * Class UpdateWalletTransactionErrorException
 * @package App\Repositories\WalletTransaction\Exceptions
 */
class UpdateWalletTransactionErrorException extends BaseException
{
    /**
     * UpdateWalletTransactionErrorException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct(__('Unable to update WalletTransaction.'  . $message), $code, $previous);
    }
}
