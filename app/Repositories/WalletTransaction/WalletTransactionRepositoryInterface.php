<?php

namespace App\Repositories\WalletTransaction;

use App\Models\WalletTransaction;
use Illuminate\Pagination\LengthAwarePaginator;

interface WalletTransactionRepositoryInterface
{

	public function create(WalletTransactionEntity $walletTransactionEntity): WalletTransaction;
	public function update(WalletTransactionEntity $walletTransactionEntity): WalletTransaction;
	public function delete(string $uuid): bool;
	public function findById(string $uuid): WalletTransaction;
	public function findAll(WalletTransactionEntity $walletTransactionEntity = null, string $sortBy = 'id', string $orientation = 'asc'): LengthAwarePaginator;
}