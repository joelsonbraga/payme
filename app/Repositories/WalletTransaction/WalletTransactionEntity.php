<?php

namespace App\Repositories\WalletTransaction;

/**
 * Class WalletTransactionEntity
 * @package App\Repositories\WalletTransaction
 */
class WalletTransactionEntity
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
    private $origin;
    /**
     * @var
     */
    private $destiny;
    /**
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $status;
    /**
     * @var
     */
    private $value;

    /**
     * WalletTransactionEntity constructor.
     * @param array $mixedData
     */
    public function __construct(array $mixedData)
	{
		$this->setId($mixedData['id'] ?? null);
		$this->setUuid($mixedData['uuid'] ?? null);
		$this->setOrigin($mixedData['origin'] ?? null);
		$this->setDestiny($mixedData['destiny'] ?? null);
		$this->setType($mixedData['type'] ?? null);
		$this->setStatus($mixedData['status'] ?? null);
		$this->setValue($mixedData['value'] ?? null);
	}

    /**
     * @return null[]|string[]
     */
    public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'uuid' => $this->getUuid(),
			'origin' => $this->getOrigin(),
			'destiny' => $this->getDestiny(),
			'type' => $this->getType(),
			'status' => $this->getStatus(),
			'value' => $this->getValue(),
		];
	}

    /**
     * @return string|null
     */
    public function getId(): ?string
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
     * @return string|null
     */
    public function getOrigin(): ?string
	{
		return $this->origin;
	}

    /**
     * @param string|null $origin
     */
    public function setOrigin(?string $origin): void
	{
		$this->origin = $origin;
	}

    /**
     * @return string|null
     */
    public function getDestiny(): ?string
	{
		return $this->destiny;
	}

    /**
     * @param string|null $destiny
     */
    public function setDestiny(?string $destiny): void
	{
		$this->destiny = $destiny;
	}

    /**
     * @return string|null
     */
    public function getType(): ?string
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
     * @return string|null
     */
    public function getStatus(): ?string
	{
		return $this->status;
	}

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
	{
		$this->status = $status;
	}

    /**
     * @return string|null
     */
    public function getValue(): ?string
	{
		return $this->value;
	}

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
	{
		$this->value = $value;
	}

}

