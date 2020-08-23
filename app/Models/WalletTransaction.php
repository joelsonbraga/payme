<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use App\Models\Traits\WalletTransactionAttributesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WalletTransaction
 * @package App\Models
 */
class WalletTransaction extends Model
{
    use SoftDeletes;
    use Uuid;
    use WalletTransactionAttributesTrait;

    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'origin',
        'destiny',
        'type',
        'status',
        'value',
    ];
    /**
     * @var string[]
     */
    protected $guarded = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originPerson() {
        return $this->belongsTo(Person::class, 'origin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinyPerson() {
        return $this->belongsTo(Person::class, 'destiny');
    }
}
