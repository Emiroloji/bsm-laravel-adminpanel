<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal\Animal;

class AnimalOwner extends Model
{
    use HasFactory;

    protected $table = 'animal_owners';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function animals()
    {
        return $this->hasMany(Animal::class, 'owner_id');
    }
}