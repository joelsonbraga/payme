<?php
declare(strict_types=1);

namespace App\Repositories\WalletTransaction;

use App\Models\WalletTransaction;
use App\Repositories\WalletTransaction\Exceptions\WalletTransactionNotFoundException;
use App\Repositories\WalletTransaction\Exceptions\CreateWalletTransactionErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


/**
 * Class WalletTransactionRepository
 * @package App\Repositories\WalletTransaction
 */
class WalletTransactionRepository implements WalletTransactionRepositoryInterface
{

    /**
     * @var WalletTransaction
     */
    private $walletTransaction;
    /**
     * @var int
     */
    private $perPage = 25;

    /**
     * WalletTransactionRepository constructor.
     * @param WalletTransaction $walletTransaction
     */
    public function __construct(WalletTransaction $walletTransaction)
    {
        $this->walletTransaction = $walletTransaction;
    }

    /**
     * @param WalletTransactionEntity $walletTransactionEntity
     * @return WalletTransaction
     * @throws CreateWalletTransactionErrorException
     */
    public function create(WalletTransactionEntity $walletTransactionEntity): WalletTransaction
    {
        try {
            $this->walletTransaction->payer = $walletTransactionEntity->getPayer();
            $this->walletTransaction->payee = $walletTransactionEntity->getPayee();
            $this->walletTransaction->type  = $walletTransactionEntity->getType();
            $this->walletTransaction->value = $walletTransactionEntity->getValue();

            $walletTransaction = DB::table('wallet_transactions')
                ->insertGetId([
                    'uuid' => Str::uuid()->toString(),
                    'payer' => $this->walletTransaction->payer,
                    'payee' => $this->walletTransaction->payee,
                    'type' => $this->walletTransaction->type,
                    'value' => $this->walletTransaction->value,
                    'created_at' => now(),
                ]);

            return $this->walletTransaction->find($walletTransaction);

        } catch (QueryException | \Throwable $e) {
            throw new CreateWalletTransactionErrorException($e->getMessage(), 500);
        }
    }

    /**
     * @param string $uuid
     * @return WalletTransaction
     * @throws WalletTransactionNotFoundException
     */
    public function findById(string $uuid): WalletTransaction
    {
        try {
            return $this->walletTransaction->where('uuid', $uuid)->first();
        } catch (QueryException | \Throwable $e) {
            throw new WalletTransactionNotFoundException($e->getMessage());
        }
    }

    /**
     * @param WalletTransactionEntity|null $walletTransactionEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     * @throws WalletTransactionNotFoundException
     */
    public function findAll(WalletTransactionEntity $walletTransactionEntity = null, string $sortBy = 'id', string $orientation = 'asc'): LengthAwarePaginator
    {
        try {
            $walletTransaction =  $this->walletTransaction
                ->where(function($query) use ($walletTransactionEntity) {
                    if (!is_null($walletTransactionEntity->getPayer())) {
                        $query->where('payer', $walletTransactionEntity->getPayer());
                    }
                    if (!is_null($walletTransactionEntity->getPayee())) {
                        $query->where('payee', $walletTransactionEntity->getPayee());
                    }
                    if (!is_null($walletTransactionEntity->getType())) {
                        $query->where('type', $walletTransactionEntity->getType());
                    }
                })
                ->orderBy($sortBy, $orientation)
                ->paginate($this->perPage);

        } catch (QueryException | \Throwable $e) {
            throw new WalletTransactionNotFoundException($e->getMessage());
        }

        return $walletTransaction;
    }

}
