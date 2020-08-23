<?php

namespace App\Http\Resources\Person;

use App\Http\Resources\ContractService\ContractServiceResource;
use App\Http\Resources\State\StateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'uuid' => $this->uuid,
            'person_id' => $this->person_id,
            'city_id'   => $this->city_id,
            'contract_service_id' => $this->contract_service_id,
            'type'      => $this->type,
            'type_document'  => $this->type_document,
            'document'  => $this->document,
            'name'      => $this->name,
            'email'     => $this->email,
            'cellphone' => $this->cellphone,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'zip_code'  => $this->zip_code,
            'housing_type'  => $this->housing_type,
            'full_address'  => $this->full_address,
            'coordinates'  => $this->coordinates,
            'contract_service' => new ContractServiceResource($this->contractService) ?? null,
            'city'     => $this->city?[
                'id' => $this->city->id ?? null,
                'state_id' => $this->city->state_id ?? null,
                'name' => $this->city->name ?? null,
                'abbreviation' => $this->city->abbreviation ?? null,
                'state' => $this->city ? new StateResource($this->city->state) : null,
            ]:null,
        ];
    }
}
