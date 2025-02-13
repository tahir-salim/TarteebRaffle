<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Nova\Actions\Actionable;


class Raffle extends Authenticatable
{
    use Actionable, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function raffleWinners()
    {
        return $this->hasMany(RaffleWinner::class, 'raffle_id');
    }

    public function winners()
    {
        return $this->belongsToMany(Customer::class, RaffleWinner::class, 'raffle_id', 'customer_id')->withTimestamps();
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, RaffleEntry::class, 'raffle_id', 'customer_id');
    }

    public function raffleEntries()
    {
        return $this->hasMany(RaffleEntry::class, 'raffle_id');
    }
}
