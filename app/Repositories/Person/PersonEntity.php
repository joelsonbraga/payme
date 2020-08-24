<?php

namespace App\Repositories\Person;

/**
 * Class PersonEntity
 * @package App\Repositories\Person
 */
class PersonEntity
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
    private $type;
    /**
     * @var
     */
    private $type_document;

    /**
     * @var
     */
    private $document;
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
    private $cellphone;

    /**
     * PersonEntity constructor.
     * @param array $mixedData
     */
    public function __construct(array $mixedData)
    {
        $this->setId($mixedData['id'] ?? null);
        $this->setUuid($mixedData['uuid'] ?? null);
        $this->setType($mixedData['type'] ?? null);
        $this->setTypeDocument($mixedData['type_document'] ?? null);
        $this->setDocument($mixedData['document'] ?? null);
        $this->setName($mixedData['name'] ?? null);
        $this->setEmail($mixedData['email'] ?? null);
        $this->setCellphone($mixedData['cellphone'] ?? null);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'uuid' => $this->getUuid(),
            'type' => $this->getType(),
            'type_document' => $this->getTypeDocument(),
            'document' => $this->getDocument(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'cellphone' => $this->getCellphone(),
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
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
     * @return mixed
     */
    public function getUuid()
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
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTypeDocument()
    {
        return $this->type_document;
    }

    /**
     * @param mixed $type_document
     */
    public function setTypeDocument($type_document): void
    {
        $this->type_document = $type_document;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param string|null $document
     */
    public function setDocument(?string $document): void
    {
        $this->document = $document;
    }

    /**
     * @return mixed
     */
    public function getName()
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
     * @return mixed
     */
    public function getEmail()
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
     * @return mixed
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @param string|null $cellphone
     */
    public function setCellphone(?string $cellphone): void
    {
        $this->cellphone = $cellphone;
    }
}
