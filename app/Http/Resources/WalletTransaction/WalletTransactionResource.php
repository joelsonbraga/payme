<?php

namespace App\Http\Resources\WalletTransaction;

use App\Http\Resources\Person\PersonResource;
use Illuminate\Http\Resources\Json\JsonResource;;

class WalletTransactionResource extends JsonResource
{
	public function toArray($request): array
	{
		return [
			'id' => $this->id,
			'uuid' => $this->uuid,
			'payer' => new PersonResource($this->payerPerson),
			'payee' => new PersonResource($this->payeePerson),
			'type' => $this->type,
			'value' => $this->value,
		];
	}
}
