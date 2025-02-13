<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Actions\Actionable;

// class Setting extends Model
class Setting extends Authenticatable
{
    use Actionable, HasFactory;

    const MIN_RECEIPT_AMOUNT = 'MIN_RECEIPT_AMOUNT';
    const MIN_ENTRY_AMOUNT = 'MIN_ENTRY_AMOUNT';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
    ];

    public function scopeMinReceiptAmount($query){
        return $query->where('name', self::MIN_RECEIPT_AMOUNT);
    }

    public function scopeMinEntryAmount($query){
        return $query->where('name', self::MIN_ENTRY_AMOUNT);
    }
}
