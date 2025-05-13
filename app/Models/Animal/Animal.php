<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal\AnimalOwner;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animal_animals';

    protected $fillable = [
        'name',
        'species',
        'breed',
        'birth_date',
        'weight',
        'owner_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(AnimalOwner::class, 'owner_id');
    }
}