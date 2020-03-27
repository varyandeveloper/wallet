<?php

namespace Currency\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method Currency|Builder identifier(int $id)
 */
class Currency extends Model
{
    protected $fillable = [
        'symbol',
        'code',
        'name'
    ];

    public function scopeIdentifier(Builder $builder, int $id)
    {
        return $builder->where($this->getTable() . '.' . $this->getKeyName(), $id);
    }
}
