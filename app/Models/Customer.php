<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Actions\Actionable;


class Customer extends Authenticatable
{
    use Actionable, HasFactory, SoftDeletes;
    /**

     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpr',
        'phone',
        'email',
        'country_id',
        'nationality',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function citizonship()
    {
        return $this->belongsTo(Country::class, 'nationality');
    }

    public function raffleEntries()
    {
        return $this->hasMany(RaffleEntry::class, 'customer_id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'customer_id');
    }

    public function winners()
    {
        return $this->belongsToMany(Raffle::class, RaffleWinner::class, 'customer_id');
    }
}
