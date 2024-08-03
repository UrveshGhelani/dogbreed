<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'breedable', 'breedables', 'breedable_id', 'breed_id');
    }

    public function parks(): MorphToMany
    {
        return $this->morphToMany(Park::class, 'breedable', 'breedables', 'breedable_id', 'breed_id');
    }
}
