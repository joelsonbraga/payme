<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\Exceptions\UserNotFoundException;
use App\Repositories\User\Exceptions\CreateUserErrorException;
use App\Repositories\User\Exceptions\DeleteUserErrorException;
use App\Repositories\User\Exceptions\UpdateUserErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var int
     */
    private $perPage = 25;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param UserEntity $userEntity
     * @return User
     * @throws CreateUserErrorException
     */
    public function create(UserEntity $userEntity): User
    {
        try {

            $this->user->person_id = $userEntity->getPersonId();
            $this->user->name      = $userEntity->getName();
            $this->user->email     = $userEntity->getEmail();
            $this->user->password  = $userEntity->getPassword();
            $this->user->email_verified_at = $userEntity->getEmailVerifiedAt();

            $this->user->save();
        } catch (QueryException | \Throwable $e) {
            throw new CreateUserErrorException($e->getMessage(), 500);
        }

        return $this->user;
    }

    /**
     * @param UserEntity $userEntity
     * @return User
     * @throws UpdateUserErrorException
     */
    public function update(UserEntity $userEntity): User
    {
        try {

            $user = $this->findByUuid($userEntity->getUuid());

            $user->person_id = $userEntity->getPersonId();
            $user->name      = $userEntity->getName();
            $user->email     = $userEntity->getEmail();
            $user->password  = $userEntity->getPassword();
            $user->email_verified_at = $userEntity->getEmailVerifiedAt();

            $user->save();
        } catch (QueryException | \Throwable $e) {
            throw new UpdateUserErrorException($e->getMessage(), 500);
        }

        return $user;
    }

    /**
     * @param string $uuid
     * @return bool
     * @throws DeleteUserErrorException
     */
    public function delete(string $uuid): bool
    {
        try {
            return $this->user->where('uuid', $uuid)->first()->delete();
        } catch (QueryException | \Throwable $e) {
            throw new DeleteUserErrorException($e->getMessage(), 500);
        }

    }

    /**
     * @param string $uuid
     * @return User
     */
    public function findByUuid(string $uuid): User
    {
        try {
            return $this->user->where('uuid', $uuid)->first();
        } catch (QueryException | \Throwable $e) {
            throw new UserNotFoundException($e->getMessage());
        }

    }

    /**
     * @param int $person_id
     * @return User
     * @throws UserNotFoundException
     */
    public function findByPersonId(int $person_id): User
    {
        try {
            return $this->user->where('person_id', $person_id)->first();
        } catch (QueryException | \Throwable $e) {
            throw new UserNotFoundException($e->getMessage());
        }

    }

    /**
     * @param UserEntity|null $userEntity
     * @param string $sortBy
     * @param string $orientation
     * @return LengthAwarePaginator
     */
    public function findAll(UserEntity $userEntity = null, string $sortBy = 'name', string $orientation = 'asc'): LengthAwarePaginator
    {
        try {

            $user =  $this->user
                ->where(function($query) use ($userEntity) {
                    if (!is_null($userEntity->getPersonId())) {
                        $query->where('person_id', $userEntity->getPersonId());
                    }

                    if (!is_null($userEntity->getName())) {
                        $query->where('name', 'like', '%' . $userEntity->getName() . '%');
                    }

                    if (!is_null($userEntity->getEmail())) {
                        $query->where('email', 'like', '%' . $userEntity->getEmail() . '%');
                    }
                })
                ->orderBy($sortBy, $orientation)
                ->paginate($this->perPage);

        } catch (QueryException | \Throwable $e) {
            throw new UserNotFoundException($e->getMessage());
        }

        return $user;
    }
}
