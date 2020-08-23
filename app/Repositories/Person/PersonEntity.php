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
    private $person_id;
    /**
     * @var
     */
    private $city_id;
    /**
     * @var
     */
    private $contract_service_id;
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
     * @var
     */
    private $phone;
    /**
     * @var
     */
    private $address;
    /**
     * @var
     */
    private $zip_code;
    /**
     * @var
     */
    private $coordinates;
    /**
     * @var string|null
     */
    private $housing_type;
    /**
     * PersonEntity constructor.
     * @param array $mixedData
     */
    public function __construct(array $mixedData)
    {
        $this->setId($mixedData['id'] ?? null);
        $this->setUuid($mixedData['uuid'] ?? null);
        $this->setPersonId($mixedData['person_id'] ?? null);
        $this->setCityId($mixedData['city_id'] ?? null);
        $this->setContractServiceId($mixedData['contract_service_id'] ?? null);
        $this->setType($mixedData['type'] ?? null);
        $this->setTypeDocument($mixedData['type_document'] ?? null);
        $this->setDocument($mixedData['document'] ?? null);
        $this->setName($mixedData['name'] ?? null);
        $this->setEmail($mixedData['email'] ?? null);
        $this->setCellphone($mixedData['cellphone'] ?? null);
        $this->setPhone($mixedData['phone'] ?? null);
        $this->setAddress($mixedData['address'] ?? null);
        $this->setZipCode($mixedData['zip_code'] ?? null);
        $this->setCoordinates($mixedData['coordinates'] ?? null);
        $this->setHousingType($mixedData['housing_type'] ?? null);

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
            'city_id' => $this->getCityId(),
            'contract_service_id' => $this->getContractServiceId(),
            'type' => $this->getType(),
            'type_document' => $this->getTypeDocument(),
            'document' => $this->getDocument(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'cellphone' => $this->getCellphone(),
            'phone' => $this->getPhone(),
            'address' => $this->getAddress(),
            'zip_code' => $this->getZipCode(),
            'coordinates' => $this->getCoordinates(),
            'housing_type' => $this->getHousingType(),
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
    public function getPersonId()
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
     * @return mixed
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * @param int|null $city_id
     */
    public function setCityId(?int $city_id): void
    {
        $this->city_id = $city_id;
    }

    /**
     * @return mixed
     */
    public function getContractServiceId()
    {
        return $this->contract_service_id;
    }

    /**
     * @param int|null $contract_service_id
     */
    public function setContractServiceId(?int $contract_service_id): void
    {
        $this->contract_service_id = $contract_service_id;
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

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * @param string|null $zip_code
     */
    public function setZipCode(?string $zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param string|null $coordinates
     */
    public function setCoordinates(?string $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return string|null
     */
    public function getHousingType(): ?string
    {
        return $this->housing_type;
    }

    /**
     * @param string|null $housing_type
     */
    public function setHousingType(?string $housing_type): void
    {
        $this->housing_type = $housing_type;
    }
}
