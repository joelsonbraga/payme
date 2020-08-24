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
    protected $table = 'wallet_transactions';
    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'payer',
        'payee',
        'type',
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
    public function payerPerson() {
        return $this->belongsTo(Person::class, 'payer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payeePerson() {
        return $this->belongsTo(Person::class, 'payee');
    }
}
