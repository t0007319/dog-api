<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Breed extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * @param array $breeds
     * @return void
     */
    public function saveAllBreeds(array $breeds): void
    {
        foreach ($breeds as $breed => $subBreeds) {
            $newBreed = Breed::updateOrCreate(['name' => $breed]);

            // could use save many outside of this loop and build sub array
            if (!empty($subBreeds)) {
                foreach ($subBreeds as $subBreed) {
                    $newSubBreed = SubBreed::updateOrCreate(['name' => $subBreed]);
                    $newBreed->subBreeds()->save($newSubBreed);
                }
            }
        }
    }

    public function subBreeds(): HasMany
    {
        return $this->hasMany(SubBreed::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function parks()
    {
        return $this->morphedByMany(Park::class, 'breedable');
    }
}
