<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Repositories\User\UserEntity;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\Exceptions\UserNotFoundException;
use App\Repositories\User\Exceptions\CreateUserErrorException;
use App\Repositories\User\Exceptions\DeleteUserErrorException;
use App\Repositories\User\Exceptions\UpdateUserErrorException;

class UserController extends Controller
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param IndexUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexUserRequest $request)
    {
        try {
            $userEntity = new UserEntity($request->validated());
            $categoryProduct = $this->userRepository->findAll($userEntity);
            return response()->json(new UserCollection($categoryProduct));
        } catch (UserNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $userEntity = new UserEntity($request->validated());
            $categoryProduct = $this->userRepository->create($userEntity);

            return response()->json(new UserResource($categoryProduct));
        } catch (CreateUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        try {
            $categoryProduct = $this->userRepository->findByUuid($uuid);

            return response()->json(new UserResource($categoryProduct));
        } catch (UserNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, string $uuid)
    {
        try {
            $validated = $request->validated();
            $validated['uuid'] = $uuid;

            $userEntity = new UserEntity($validated);
            $categoryProduct = $this->userRepository->update($userEntity);

            return response()->json(new UserResource($categoryProduct));
        } catch (UpdateUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $uuid)
    {
        try {
            $categoryProduct = $this->userRepository->delete($uuid);
            $response = [
                'success' => [
                    'message' => __('User was successfully excluded.'),
                ],
            ];
            return response()->json($response);
        } catch (DeleteUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }
}
