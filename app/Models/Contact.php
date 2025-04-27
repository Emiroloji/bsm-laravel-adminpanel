<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'first_name','last_name','email','phone',
        'company_id','position','address','notes','is_active'
    ];

    public function company()   // şimdilik null, sonra Company ekleyince tamamlanacak
    {
        return $this->belongsTo(Company::class);
    }
}