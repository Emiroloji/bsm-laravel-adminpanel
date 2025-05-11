<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Activity extends Model
{
    protected $fillable = [
        'subject_type',
        'subject_id',
        'type',
        'comment',
        'due_at',
    ];

    // Burayı ekleyin:
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'due_at'     => 'datetime',
    ];

    public function subject()
    {
        return $this->morphTo();
    }
}