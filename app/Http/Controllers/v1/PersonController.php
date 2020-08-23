<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\Person\IndexPersonRequest;
use App\Http\Resources\Person\PersonCollection;
use App\Http\Resources\Person\PersonResource;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\PersonEntity;
use App\Repositories\Person\PersonRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{

    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexPersonRequest $request)
    {
        try {
            $personEntity = new PersonEntity($request->validated());

            $personRepository = $this->personRepository->findAll($personEntity);
            return response()->json(new PersonCollection($personRepository));
        } catch (PersonNotFoundException $e) {
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
            $personRepository = $this->personRepository->findById($uuid);

            return response()->json(new PersonResource($personRepository));
        } catch (PersonNotFoundException $e) {
            return response()->json($e->getResponse(), $e->getCode());
        }
    }

    /**
     * @todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function logedUser()
    {
        Auth::user()->person;
        return response()->json(Auth::user(), 200);
    }
}
