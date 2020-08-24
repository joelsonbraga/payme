<?php

namespace App\Repositories\WalletTransaction;

use App\Models\WalletTransaction;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface WalletTransactionRepositoryInterface
 * @package App\Repositories\WalletTransaction
 */
interface WalletTransactionRepositoryInterface
{

    /**
     * @param WalletTransactionEntity $walletTransactionEntity
     * @return WalletTransaction
     */
    public function create(WalletTransactionEntity $walletTransactionEntity): WalletTransaction;

    /**
     * @param string $uuid
     * @return WalletTransaction
     */
    public function findById(string $uuid): WalletTransaction;

    /**
     * @param WalletTransactionEntity|null $walletTransactionEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     */
    public function findAll(WalletTransactionEntity $walletTransactionEntity = null, string $sortBy = 'id', string $orientation = 'asc'): LengthAwarePaginator;
}
