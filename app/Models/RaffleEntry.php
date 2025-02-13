<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Actions\Actionable;


class RaffleEntry extends Authenticatable
{
    use Actionable, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'raffle_id',
        'customer_id',
        'total_amount',
        'number_of_entries'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function receipts()
    {
        return $this->belongsToMany(Receipt::class, 'receipt_raffle_entries', 'receipt_id', 'raffle_entry_id')->withTimestamps();
    }
}
