<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\Hash;

/**
 * Trait ProductAttibutesTrait
 * @package App\Models\Traits
 */
trait UserAttributesTrait
{
    /**
     * @param null $value
     */
    public function setPasswordAttribute($value = null)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
