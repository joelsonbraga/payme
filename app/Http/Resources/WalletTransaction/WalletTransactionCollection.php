<?php

namespace App\Http\Resources\WalletTransaction;

use App\Http\Resources\Person\PersonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WalletTransactionCollection  extends ResourceCollection
{
	public function toArray($request): array
	{
		$collection = $this->resource->toArray();
		$collection['data'] = $this->collection->map(function ($item, $key) {
			return [
				'id' => $item->id,
				'uuid' => $item->uuid,
				'payer' => new PersonResource($item->payerPerson),
                'payee' => new PersonResource($item->payeePerson),
				'type' => $item->type,
				'value' => $item->value,
			];
		});

		return $collection;
	}
}
