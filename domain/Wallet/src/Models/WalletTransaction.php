<?php

namespace Wallet\Models;

use Currency\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method WalletTransaction|Builder ownedBy(int $walletId)
 */
class WalletTransaction extends Model
{
    public const TYPE_CREDIT = 1;
    public const TYPE_DEBIT = 2;

    protected $fillable = [
        'wallet_id',
        'type',
        'currency_id',
        'amount',
        'transaction_date'
    ];

    public $timestamps = false;

    public function scopeOwnedBy(Builder $builder, $walletId)
    {
        return $builder->where('wallet_id', $walletId);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
