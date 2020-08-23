<?php

namespace App\Http\Resources\WalletTransaction;

use Illuminate\Http\Resources\Json\JsonResource;;

class WalletTransactionResource extends JsonResource
{
	public function toArray($request): array
	{
		return [
			'id' => $this->id,
			'uuid' => $this->uuid,
			'origin' => $this->origin,
			'destiny' => $this->destiny,
			'type' => $this->type,
			'status' => $this->status,
			'value' => $this->value,
		];
	}
}