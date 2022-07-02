<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WBreak extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'breaks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'starts_at',
        'ends_at'
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
        'starts_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    /**
     * The barbers that belong to the breaks
     *
     * @return BelongsToMany
     */
    public function barbers(): BelongsToMany
    {
        return $this->belongsToMany(Barber::class, 'break_barber');
    }
}
