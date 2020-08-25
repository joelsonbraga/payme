<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\User
 */
interface UserRepositoryInterface
{

    /**
     * @param UserEntity $userEntity
     * @return User
     */
    public function create(UserEntity $userEntity): User;

    /**
     * @param UserEntity $userEntity
     * @return User
     */
    public function update(UserEntity $userEntity): User;

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool;

    /**
     * @param string $uuid
     * @return User
     */
    public function findByUuid(string $uuid): User;

    /**
     * @param int $person_id
     * @return User
     */
    public function findByPersonId(int $person_id): User;

    /**
     * @param UserEntity|null $userEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     */
    public function findAll(UserEntity $userEntity = null, string $sortBy = 'name', string $orientation = 'asc'): LengthAwarePaginator;
}

?>
