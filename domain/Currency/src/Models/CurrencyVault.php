<?php

namespace Currency\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyVault extends Model
{
    protected $table = 'currency_vault';

    protected $primaryKey = 'currency_id';

    protected $fillable = [
        'currency_id',
        'exchange_rate'
    ];
}
