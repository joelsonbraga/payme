<?php

namespace App\Repositories\Person;

use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface PersonRepositoryInterface
 * @package App\Repositories\Person
 */
interface PersonRepositoryInterface
{

    /**
     * @param PersonEntity $personEntity
     * @return Person
     */
    public function create(PersonEntity $personEntity): Person;

    /**
     * @param PersonEntity $personEntity
     * @return Person
     */
    public function update(PersonEntity $personEntity): Person;

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool;

    /**
     * @param string $uuid
     * @return Person
     */
    public function findByUuid(string $uuid): Person;

    /**
     * @param int $id
     * @return Person
     */
    public function findByid(int $id): Person;

    /**
     * @param string $document
     * @return Person
     */
    public function findByDocument(string $document): Person;

    /**
     * @param PersonEntity|null $personEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     */
    public function findAll(PersonEntity $personEntity = null, string $sortBy = 'name', string $orientation = 'asc'): LengthAwarePaginator;
}
