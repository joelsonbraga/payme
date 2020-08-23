<?php

namespace App\Http\Resources\Person;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->resource->toArray();
        $collection['data'] = $this->collection->map(function ($item, $key) {
            return [
                'id'   => $item->id,
                'uuid' => $item->uuid,
                'person_id' => $item->person_id,
                'city_id'   => $item->city_id,
                'contract_service_id' => $item->contract_service_id,
                'type'      => $item->type,
                'type_document'  => $item->type_document,
                'document'  => $item->document,
                'name'      => $item->name,
                'email'     => $item->email,
                'cellphone' => $item->cellphone,
                'phone'     => $item->phone,
                'address'   => $item->address,
                'zip_code'  => $item->zip_code,
                'coordinates'  => $item->coordinates,
                'contract_service' => $item->contractService ?? null,
                'city' => $item->city ? [
                    'id' => $item->city->id,
                    'name' => $item->city->name,
                    'state_id' => $item->city->state_id,
                    'abbreviation' => $item->city->abbreviation,
                ]:null,
            ];
        })->toArray();

        return $collection;
    }
}
