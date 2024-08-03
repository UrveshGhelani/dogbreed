<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parks(): MorphToMany
    {
        return $this->morphedByMany(Park::class, 'parkable', 'parkables', 'parkable_id', 'park_id');
    }

    public function breeds(): MorphToMany
    {
        return $this->morphedByMany(Breed::class, 'breedable', 'breedables', 'breedable_id', 'breed_id');
    }
}
