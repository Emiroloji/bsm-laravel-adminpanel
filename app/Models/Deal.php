<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'stage',
        'close_date',
        'company_id',
        'contact_id',
        'description',
        'status',
        'items',            // ← buraya ekledik
    ];

    // Tarih cast’leri
    protected $casts = [
        'close_date' => 'date',
        'items'      => 'array',   // ← items’ı array olarak oku
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject')->orderByDesc('created_at');
    }
}