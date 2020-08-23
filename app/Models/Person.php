<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Person
 * @package App\Models
 */
class Person extends Model
{
    use SoftDeletes;
    use Uuid;

    const PERSON_ADMIN             = 'master';
    const PERSON_SUPERMARKET_CHAIN = 'common';
    const PERSON_SHOPPER           = 'shopkeeper';

    /**
     * @var string
     */
    protected $table = 'persons';
    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'type',
        'document',
        'name',
        'email',
        'cellphone',
    ];
    /**
     * @var string[]
     */
    protected $guarded = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function origins()
    {
        return $this->hasMany(WalletTransaction::class, 'origin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinies()
    {
        return $this->hasMany(WalletTransaction::class, 'destiny');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(Person::class, 'person_id');
    }
}
