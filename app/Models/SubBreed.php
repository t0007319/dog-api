<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBreed extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'breed_id'];

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }
}
