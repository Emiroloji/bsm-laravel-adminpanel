<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'first_name','last_name','email','phone',
        'company_id','position','address','notes','is_active'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject')->orderByDesc('created_at');
    }
}