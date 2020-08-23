<?php
declare(strict_types=1);

namespace App\Repositories\WalletTransaction;

use App\Models\WalletTransaction;
use App\Repositories\WalletTransaction\Exceptions\WalletTransactionNotFoundException;
use App\Repositories\WalletTransaction\Exceptions\CreateWalletTransactionErrorException;
use App\Repositories\WalletTransaction\Exceptions\DeleteWalletTransactionErrorException;
use App\Repositories\WalletTransaction\Exceptions\UpdateWalletTransactionErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;


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
            $this->walletTransaction->origin = $walletTransactionEntity->getOrigin();
            $this->walletTransaction->destiny = $walletTransactionEntity->getDestiny();
            $this->walletTransaction->type = $walletTransactionEntity->getType();
            $this->walletTransaction->status = $walletTransactionEntity->getStatus();
            $this->walletTransaction->value = $walletTransactionEntity->getValue();

            $this->walletTransaction->save();
        } catch (QueryException | \Throwable $e) {
            throw new CreateWalletTransactionErrorException($e->getMessage(), 500);
        }

        return $this->walletTransaction;
    }

    /**
     * @param WalletTransactionEntity $walletTransactionEntity
     * @return WalletTransaction
     * @throws UpdateWalletTransactionErrorException
     */
    public function update(WalletTransactionEntity $walletTransactionEntity): WalletTransaction
    {
        try {
            $walletTransaction = $this->findById($walletTransactionEntity->getUuid());

            $walletTransaction->origin = $walletTransactionEntity->getOrigin();
            $walletTransaction->destiny = $walletTransactionEntity->getDestiny();
            $walletTransaction->type = $walletTransactionEntity->getType();
            $walletTransaction->status = $walletTransactionEntity->getStatus();
            $walletTransaction->value = $walletTransactionEntity->getValue();
            $walletTransaction->save();
        } catch (QueryException | \Throwable $e) {
            throw new UpdateWalletTransactionErrorException($e->getMessage(), 500);
        }

        return $walletTransaction;
    }

    /**
     * @param string $uuid
     * @return bool
     * @throws DeleteWalletTransactionErrorException
     */
    public function delete(string $uuid): bool
    {
        try {
            return $this->walletTransaction->where('uuid', $uuid)->first()->delete();
        } catch (QueryException | \Throwable $e) {
            throw new DeleteWalletTransactionErrorException($e->getMessage(), 500);
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
                    if (!is_null($walletTransactionEntity->getUuid())) {
                        $query->where('uuid', $walletTransactionEntity->getUuid());
                    }
                    if (!is_null($walletTransactionEntity->getOrigin())) {
                        $query->where('origin', $walletTransactionEntity->getOrigin());
                    }
                    if (!is_null($walletTransactionEntity->getDestiny())) {
                        $query->where('destiny', $walletTransactionEntity->getDestiny());
                    }
                    if (!is_null($walletTransactionEntity->getType())) {
                        $query->where('type', $walletTransactionEntity->getType());
                    }
                    if (!is_null($walletTransactionEntity->getStatus())) {
                        $query->where('status', $walletTransactionEntity->getStatus());
                    }
                    if (!is_null($walletTransactionEntity->getValue())) {
                        $query->where('value', $walletTransactionEntity->getValue());
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
