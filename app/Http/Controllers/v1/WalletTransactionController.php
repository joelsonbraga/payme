<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\WalletTransaction\IndexWalletTransactionRequest;
use App\Http\Requests\WalletTransaction\StoreWalletTransactionRequest;
use App\Http\Requests\WalletTransaction\UpdateWalletTransactionRequest;
use App\Http\Resources\WalletTransaction\WalletTransactionCollection;
use App\Http\Resources\WalletTransaction\WalletTransactionResource;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\PersonEntity;
use App\Repositories\Person\PersonRepositoryInterface;
use App\Repositories\WalletTransaction\WalletTransactionEntity;
use App\Repositories\WalletTransaction\WalletTransactionRepositoryInterface;
use App\Repositories\WalletTransaction\Exceptions\WalletTransactionNotFoundException;
use App\Repositories\WalletTransaction\Exceptions\CreateWalletTransactionErrorException;
use App\Repositories\WalletTransaction\Exceptions\DeleteWalletTransactionErrorException;
use App\Repositories\WalletTransaction\Exceptions\UpdateWalletTransactionErrorException;
use App\Services\WalletTransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class WalletTransactionController
 * @package App\Http\Controllers\v1
 */
class WalletTransactionController  extends Controller
{

    /**
     * @var WalletTransactionRepositoryInterface
     */
    private $walletTransactionRepository;
    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;
    /**
     * @var WalletTransactionService
     */
    private $walletTransactionService;

    /**
     * WalletTransactionController constructor.
     * @param WalletTransactionRepositoryInterface $walletTransactionRepository
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(WalletTransactionRepositoryInterface $walletTransactionRepository, PersonRepositoryInterface $personRepository, WalletTransactionService $walletTransactionService)
    {
        $this->walletTransactionRepository = $walletTransactionRepository;
        $this->personRepository = $personRepository;
        $this->walletTransactionService = $walletTransactionService;
    }

    /**
     * @param IndexWalletTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexWalletTransactionRequest $request)
    {
        try {
            $validated = $request->validated();
            $walletTransactionEntity = new WalletTransactionEntity($validated);

            if ($validated['type'] == 'debit') {
                $walletTransactionEntity->setPayer(Auth::user()->person_id);
            } elseif ($validated['type'] == 'credit') {
                $walletTransactionEntity->setPayee(Auth::user()->person_id);
            }

            $walletTransaction = $this->walletTransactionRepository->findAll($walletTransactionEntity);

            return response()->json(new WalletTransactionCollection($walletTransaction));
        } catch (WalletTransactionNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * @param StoreWalletTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreWalletTransactionRequest $request)
    {
        try {
            $personEntity            = new PersonEntity($request->validated());
            $walletTransactionEntity = new WalletTransactionEntity($request->validated());

            DB::beginTransaction();
            $walletTransactionDebit  = $this->walletTransactionService->createDebit($walletTransactionEntity, $personEntity);
            $this->walletTransactionService->createCredit($walletTransactionEntity, $personEntity);
            DB::commit();

            $this->walletTransactionService->isSent();

            return response()->json(new WalletTransactionResource($walletTransactionDebit));
        } catch (CreateWalletTransactionErrorException $e) {
            DB::rollBack();

            return response()->json($e->getResponse(), $e->getCode());
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $uuid)
    {
        try {
            $walletTransaction = $this->walletTransactionRepository->findById($uuid);
            return response()->json(new WalletTransactionResource($walletTransaction));
        } catch (CreateWalletTransactionErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * @param UpdateWalletTransactionRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateWalletTransactionRequest $request, string $uuid)
    {
        try {
            $validated = $request->validated();
            $validated['uuid'] = $uuid;

            $walletTransactionEntity = new WalletTransactionEntity($validated);
            $walletTransaction = $this->walletTransactionRepository->update($walletTransactionEntity);

            return response()->json(new WalletTransactionResource($walletTransaction));
        } catch (UpdateWalletTransactionErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $uuid)
    {
        try {
            $this->walletTransactionRepository->delete($uuid);
            $response = [
                'success' => [
                    'message' => __('walletTransaction was successfully excluded.'),
                ],
            ];
            return response()->json($response);
        } catch (DeleteWalletTransactionErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

}

