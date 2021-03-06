<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Common\IndexCommonRequest;
use App\Http\Requests\Common\StoreCommonRequest;
use App\Http\Requests\Common\UpdateCommonRequest;
use App\Http\Resources\Person\PersonCollection;
use App\Http\Resources\Person\PersonResource;
use App\Repositories\Person\Exceptions\CreatePersonErrorException;
use App\Repositories\Person\Exceptions\DeletePersonErrorException;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\Exceptions\UpdatePersonErrorException;
use App\Repositories\Person\PersonEntity;
use App\Repositories\Person\PersonRepositoryInterface;
use App\Repositories\User\Exceptions\CreateUserErrorException;
use App\Repositories\User\Exceptions\DeleteUserErrorException;
use App\Repositories\User\UserEntity;
use App\Repositories\User\UserRepositoryInterface;

class CommonController extends Controller
{

    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * CommonController constructor.
     * @param PersonRepositoryInterface $personRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository, UserRepositoryInterface $userRepository)
    {
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexCommonRequest $request)
    {
        try {
            $personEntity = new PersonEntity($request->validated());

            $person = $this->personRepository->findAll($personEntity);
            return response()->json(new PersonCollection($person));
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommonRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommonRequest $request)
    {
        try {
            $validated = $request->validated();

            $personEntity = new PersonEntity($validated);
            $person = $this->personRepository->create($personEntity);

            if (isset($validated['user'])) {
                $userEntity = new UserEntity($validated['user']);
                $userEntity->setPersonId($person->id);
                $userEntity->setEmail($person->email);
                $userEntity->setName($person->name);

                $this->userRepository->create($userEntity);
            }

            return response()->json(new PersonResource($person));
        } catch (CreatePersonErrorException | CreateUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $uuid)
    {
        try {
            $person = $this->personRepository->findByUuid($uuid);

            return response()->json(new PersonResource($person));
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommonRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCommonRequest $request, string $uuid)
    {
        try {
            $validated = $request->validated();
            $validated['uuid'] = $uuid;

            $personEntity = new PersonEntity($validated);
            $person = $this->personRepository->update($personEntity);

            return response()->json(new PersonResource($person));
        } catch (UpdatePersonErrorException $e) {
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
            $person = $this->personRepository->findByUuid($uuid);
            $user   = $this->userRepository->findByPersonId($person->id);

            $this->personRepository->delete($uuid);
            $this->userRepository->delete($user->uuid);

            $response = [
                'success' => [
                    'message' => __('Common was successfully excluded.'),
                ],
            ];

            return response()->json($response);
        } catch (DeletePersonErrorException | DeleteUserErrorException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }
}
