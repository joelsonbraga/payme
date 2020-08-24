<?php


namespace App\Services;


use App\Models\Person;
use App\Models\WalletTransaction;
use App\Repositories\Person\Exceptions\CreatePersonErrorException;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\PersonEntity;
use App\Repositories\Person\PersonRepositoryInterface;
use App\Repositories\WalletTransaction\Exceptions\CreateWalletTransactionErrorException;
use App\Repositories\WalletTransaction\WalletTransactionEntity;
use App\Repositories\WalletTransaction\WalletTransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WalletTransactionService
{
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;
    /**
     * @var WalletTransactionRepositoryInterface
     */
    private $walletTransactionRepository;

    /**
     * WalletTransactionService constructor.
     * @param WalletTransactionRepositoryInterface $walletTransactionRepository
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(WalletTransactionRepositoryInterface $walletTransactionRepository, PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    /**
     * @param int $person_id
     * @return Person
     * @throws PersonNotFoundException
     */
    public function getPayer(int $person_id): Person
    {
        try {
            $payer = $this->personRepository->findByid($person_id);

            if ($payer->type != 'common') {
                throw new PersonNotFoundException(__('Only ordinary users can make transfers.'));
            }

            return $payer;
        } catch (PersonNotFoundException $e) {
            throw new PersonNotFoundException($e->getMessage(), 401);
        }
    }

    /**
     * @param int $person_id
     * @return Person
     * @throws PersonNotFoundException
     */
    public function getPayee(string $document): Person
    {
        try {
            return $this->personRepository->findByDocument($document);
        } catch (PersonNotFoundException $e) {
            throw new PersonNotFoundException($e->getMessage());
        }
    }

    /**
     * @param WalletTransactionEntity $walletTransactionEntity
     * @param PersonEntity $personEntity
     * @return WalletTransaction
     * @throws CreateWalletTransactionErrorException
     */
    public function createDebit(WalletTransactionEntity $walletTransactionEntity, PersonEntity $personEntity): WalletTransaction
    {
        try {
            $payer = $this->getPayer(Auth::user()->person_id);
            $payee = $this->getPayee($personEntity->getDocument());

            $walletTransactionEntity->setPayer($payer->id);
            $walletTransactionEntity->setPayee($payee->id);
            $walletTransactionEntity->setType('debit');

            if ($this->isAuthorized() === false) {
                throw new \Exception(__('Unauthorized transaction.'), 401);
            }

            return $this->walletTransactionRepository->create($walletTransactionEntity);

        } catch (CreatePersonErrorException | \Exception $e) {
            throw new CreateWalletTransactionErrorException($e->getMessage(), $e->getCode());
        } catch (PersonNotFoundException $e) {
            throw new CreateWalletTransactionErrorException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param WalletTransactionEntity $walletTransactionEntity
     * @param PersonEntity $personEntity
     * @return WalletTransaction
     * @throws CreateWalletTransactionErrorException
     */
    public function createCredit(WalletTransactionEntity $walletTransactionEntity, PersonEntity $personEntity): WalletTransaction
    {
        try {
            $payer = $this->getPayer(Auth::user()->person_id);
            $payee = $this->getPayee($personEntity->getDocument());

            $walletTransactionEntity->setPayer($payer->id);
            $walletTransactionEntity->setPayee($payee->id);
            $walletTransactionEntity->setType('credit');

            if ($this->isAuthorized() === false) {
                throw new \Exception(__('Unauthorized transaction.'), 401);
            }

            return $this->walletTransactionRepository->create($walletTransactionEntity);

        } catch (CreatePersonErrorException | \Exception $e) {
            throw new CreateWalletTransactionErrorException($e->getMessage(), $e->getCode());
        } catch (PersonNotFoundException $e) {
            throw new CreateWalletTransactionErrorException($e->getMessage());
        }
    }

    /**
     * @return bool
     */
    private function isAuthorized(): bool
    {
        $response = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6')->json();

        return $response['message'] == 'Autorizado' ? true : false;
    }

    /**
     * @return bool
     */
    public function isSent(): bool
    {
        $response = Http::get('https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04')->json();

        return $response['message'] == 'Enviado' ? true : false;
    }
}
