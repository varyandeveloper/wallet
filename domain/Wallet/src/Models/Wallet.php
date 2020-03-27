<?php

namespace Wallet\Models;

use Currency\Models\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Wallet
 * @method Wallet|Builder identifier(int $id)
 * @method Wallet|Builder ownedBy(int $userId)
 * @method float sumBalance()
 */
class Wallet extends Model
{
    public const TYPE_CASH = 1;
    public const TYPE_CREDIT_CARD = 2;

    protected $fillable = [
        'user_id',
        'currency_id',
        'type',
        'name',
        'balance',
    ];

    public function scopeSumBalance(Builder $builder)
    {
        return $builder
            ->join('currency_vault', $this->getTable() . '.currency_id', 'currency_vault.currency_id')
            ->sum(DB::raw('balance / currency_vault.exchange_rate'))
        ;
    }

    public function scopeIdentifier(Builder $builder, int $id)
    {
        return $builder->where($this->getTable() . '.' . $this->getKeyName(), $id);
    }

    public function scopeOwnedBy(Builder $builder, int $userId)
    {
        return $builder->where('user_id', $userId);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }
}
