<?php
declare(strict_types=1);

namespace App\Repositories\Person;

use App\Models\Person;
use App\Repositories\Person\Exceptions\PersonNotFoundException;
use App\Repositories\Person\Exceptions\CreatePersonErrorException;
use App\Repositories\Person\Exceptions\DeletePersonErrorException;
use App\Repositories\Person\Exceptions\UpdatePersonErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


/**
 * Class PersonRepository
 * @package App\Repositories\Person
 */
class PersonRepository implements PersonRepositoryInterface
{

    /**
     * @var Person
     */
    private $person;
    /**
     * @var int
     */
    private $perPage = 25;

    /**
     * PersonRepository constructor.
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @param PersonEntity $personEntity
     * @return Person
     */
    public function create(PersonEntity $personEntity): Person
    {
        try {

            $this->person->person_id = $personEntity->getPersonId();
            $this->person->city_id   = $personEntity->getCityId();
            $this->person->contract_service_id = $personEntity->getContractServiceId();
            $this->person->type_document = $personEntity->getTypeDocument();
            $this->person->type        = $personEntity->getType();
            $this->person->document    = $personEntity->getDocument();
            $this->person->name        = $personEntity->getName();
            $this->person->email       = $personEntity->getEmail();
            $this->person->cellphone   = $personEntity->getCellphone();
            $this->person->phone       = $personEntity->getPhone();
            $this->person->address     = $personEntity->getAddress();
            $this->person->zip_code    = $personEntity->getZipCode();
            $this->person->coordinates = $personEntity->getCoordinates();
            $this->person->housing_type = $personEntity->getHousingType();

            $this->person->save();
        } catch (QueryException | \Throwable $e) {
            throw new CreatePersonErrorException($e->getMessage(), 500);
        }

        return $this->person;
    }

    /**
     * @param PersonEntity $personEntity
     * @return Person
     */
    public function update(PersonEntity $personEntity): Person
    {
        try {

            $person = $this->findById($personEntity->getUuid());

            $person->person_id = $personEntity->getPersonId();
            $person->city_id   = $personEntity->getCityId();
            $person->contract_service_id = $personEntity->getContractServiceId();
            $person->type        = $personEntity->getType();
            $person->type_document = $personEntity->getTypeDocument();
            $person->document    = $personEntity->getDocument();
            $person->name        = $personEntity->getName();
            $person->email       = $personEntity->getEmail();
            $person->cellphone   = $personEntity->getCellphone();
            $person->phone       = $personEntity->getPhone();
            $person->address     = $personEntity->getAddress();
            $person->zip_code    = $personEntity->getZipCode();
            $person->coordinates = $personEntity->getCoordinates();
            $person->housing_type  = $personEntity->getHousingType();

            $person->save();
        } catch (QueryException | \Throwable $e) {
            throw new UpdatePersonErrorException($e->getMessage(), 500);
        }

        return $person;
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool
    {
        try {
            return $this->person->where('uuid', $uuid)->first()->delete();
        } catch (QueryException | \Throwable $e) {
            throw new DeletePersonErrorException($e->getMessage(), 500);
        }

    }

    /**
     * @param string $uuid
     * @return Person
     */
    public function findById(string $uuid): Person
    {
        try {
            return $this->person->where('uuid', $uuid)->first();
        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }
    }

    /**
     * @param PersonEntity|null $personEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     * @throws PersonNotFoundException
     */
    public function findAll(PersonEntity $personEntity = null, string $sortBy = 'person_id', string $orientation = 'asc'): LengthAwarePaginator
    {
        try {

            $person =  $this->person
                ->where(function($query) use ($personEntity) {

                    if (!is_null($personEntity->getPersonId())) {
                        $query->where('person_id', $personEntity->getPersonId());
                    }

                    if (!is_null($personEntity->getCityId())) {
                        $query->where('city_id', $personEntity->getCityId());
                    }

                    if (!is_null($personEntity->getContractServiceId())) {
                        $query->where('contract_service_id', $personEntity->getContractServiceId());
                    }

                    if (!is_null($personEntity->getType())) {
                        $query->where('type', $personEntity->getType());
                    }

                    if (!is_null($personEntity->getDocument())) {
                        $query->where('document', $personEntity->getDocument());
                    }

                    if (!is_null($personEntity->getEmail())) {
                        $query->where('email', $personEntity->getEmail());
                    }

                    if (!is_null($personEntity->getName())) {
                        $query->where('name', 'like', '%' . $personEntity->getName() . '%');
                    }
                })
                ->orderBy($sortBy, $orientation)
                ->paginate($this->perPage);

        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }

        return $person;
    }

    /**
     * @param PersonEntity|null $personEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     * @throws PersonNotFoundException
     */
    public function findList(PersonEntity $personEntity = null, string $sortBy = 'person_id', string $orientation = 'asc'): Collection
    {
        try {

            $person =  $this->person
                ->where(function($query) use ($personEntity) {

                    if (!is_null($personEntity->getPersonId())) {
                        $query->where('person_id', $personEntity->getPersonId());
                    }

                    if (!is_null($personEntity->getCityId())) {
                        $query->where('city_id', $personEntity->getCityId());
                    }

                    if (!is_null($personEntity->getContractServiceId())) {
                        $query->where('contract_service_id', $personEntity->getContractServiceId());
                    }

                    if (!is_null($personEntity->getType())) {
                        $query->where('type', $personEntity->getType());
                    }

                    if (!is_null($personEntity->getDocument())) {
                        $query->where('document', $personEntity->getDocument());
                    }

                    if (!is_null($personEntity->getEmail())) {
                        $query->where('email', $personEntity->getEmail());
                    }

                    if (!is_null($personEntity->getName())) {
                        $query->where('name', 'like', '%' . $personEntity->getName() . '%');
                    }
                })
                ->orderBy($sortBy, $orientation)
                ->paginate($this->perPage);

        } catch (QueryException | \Throwable $e) {
            throw new PersonNotFoundException($e->getMessage());
        }

        return $person;
    }
}
