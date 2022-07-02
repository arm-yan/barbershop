<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barber extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'barbers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'works_on_holidays',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'works_on_holidays' => 'boolean'
    ];

    /**
     * The services that belong to the barber
     *
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_barber');
    }

    /**
     * The appointments that belong to the barber
     *
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * The barber schedule
     *
     * @return BelongsTo
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * The breaks that belong to the barber
     *
     * @return BelongsToMany
     */
    public function breaks(): BelongsToMany
    {
        return $this->belongsToMany(WBreak::class, 'break_barber', 'barber_id', 'break_id');
    }
}
