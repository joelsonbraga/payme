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
    private $payer;
    /**
     * @var
     */
    private $payee;
    /**
     * @var
     */
    private $type;
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
		$this->setPayer($mixedData['payer'] ?? null);
		$this->setPayee($mixedData['payee'] ?? null);
		$this->setType($mixedData['type'] ?? null);
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
			'payer' => $this->getPayer(),
			'payee' => $this->getPayee(),
			'type' => $this->getType(),
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
    public function getPayer(): ?string
	{
		return $this->payer;
	}

    /**
     * @param string|null $payer
     */
    public function setPayer(?string $payer): void
	{
		$this->payer = $payer;
	}

    /**
     * @return string|null
     */
    public function getPayee(): ?string
	{
		return $this->payee;
	}

    /**
     * @param string|null $payee
     */
    public function setPayee(?string $payee): void
	{
		$this->payee = $payee;
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

