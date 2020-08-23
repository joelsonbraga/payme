<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Person\PersonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
                'id'     => $item->id,
                'uuid'   => $item->uuid,
                'name'   => $item->name,
                'email'  => $item->email,
                'person' => new PersonResource($item->person),
            ];
        });

        return $collection;
    }
}
