<?php

namespace App\Repositories\User;

/**
 * Class UserEntity
 * @package App\Repositories\User
 */
class UserEntity
{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $uuid;
    /**
     * @var
     */
    private $person_id;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $email_verified_at;

    /**
     * UserEntity constructor.
     * @param array $mixedData
     */
    public function __construct(array $mixedData)
    {
        $this->setId($mixedData['id'] ?? null);
        $this->setUuid($mixedData['uuid'] ?? null);
        $this->setPersonId($mixedData['person_id'] ?? null);
        $this->setName($mixedData['name'] ?? null);
        $this->setEmail($mixedData['email'] ?? null);
        $this->setPassword($mixedData['password'] ?? null);
        $this->setEmailVerifiedAt($mixedData['email_verified_at'] ?? null);

    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'person_id' => $this->getPersonId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'email_verified_at' => $this->getEmailVerifiedAt(),
        ];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @param string|null $uuid
     */
    public function setUuid(?string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return int|null
     */
    public function getPersonId(): ?int
    {
        return $this->person_id;
    }

    /**
     * @param int|null $person_id
     */
    public function setPersonId(?int $person_id): void
    {
        $this->person_id = $person_id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getEmailVerifiedAt(): ?string
    {
        return $this->email_verified_at;
    }

    /**
     * @param string|null $email_verified_at
     */
    public function setEmailVerifiedAt(?string $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

}

?>
