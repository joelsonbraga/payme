<?php

namespace App\Http\Resources\WalletTransaction;

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
				'origin' => $item->origin,
				'destiny' => $item->destiny,
				'type' => $item->type,
				'status' => $item->status,
				'value' => $item->value,
			];
		});

		return $collection;
	}
}