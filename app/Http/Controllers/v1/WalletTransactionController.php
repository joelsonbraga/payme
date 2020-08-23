<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\WalletTransaction\IndexWalletTransactionRequest;
use App\Http\Requests\WalletTransaction\StoreWalletTransactionRequest;
use App\Http\Requests\WalletTransaction\UpdateWalletTransactionRequest;
use App\Http\Resources\WalletTransaction\WalletTransactionCollection;
use App\Http\Resources\WalletTransaction\WalletTransactionResource;
use App\Repositories\WalletTransaction\WalletTransactionEntity;
use App\Repositories\WalletTransaction\WalletTransactionRepositoryInterface;
use App\Repositories\WalletTransaction\Exceptions\WalletTransactionNotFoundException;
use App\Repositories\WalletTransaction\Exceptions\CreateWalletTransactionErrorException;
use App\Repositories\WalletTransaction\Exceptions\DeleteWalletTransactionErrorException;
use App\Repositories\WalletTransaction\Exceptions\UpdateWalletTransactionErrorException;

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
     * WalletTransactionController constructor.
     * @param WalletTransactionRepositoryInterface $walletTransactionRepository
     */
    public function __construct(WalletTransactionRepositoryInterface $walletTransactionRepository)
	{
		$this->walletTransactionRepository = $walletTransactionRepository;
	}

    /**
     * @param IndexWalletTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexWalletTransactionRequest $request)
	{
		try {
			$walletTransactionEntity = new WalletTransactionEntity($request->validated());
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
			$walletTransactionEntity = new WalletTransactionEntity($request->validated());
			$walletTransaction = $this->walletTransactionRepository->create($walletTransactionEntity);

			return response()->json(new WalletTransactionResource($walletTransaction));
		} catch (CreateWalletTransactionErrorException $e) {
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
			$walletTransaction = $this->walletTransactionRepository->delete($uuid);
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

