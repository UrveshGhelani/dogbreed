<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Park extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'parkable', 'parkables', 'park_id', 'parkable_id');
    }

    public function allowedBreeds(): MorphToMany
    {
        return $this->morphToMany(Breed::class, 'breedable', 'breedables', 'breed_id', 'breedable_id');
    }
}
