<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // Toplu atamaya izin verilen alanlar
    protected $fillable = [
        'subject_type',
        'subject_id',
        'type',
        'comment',
        'due_at',
    ];

    // Tarih alanlarını Carbon nesnesine çevir
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'due_at'     => 'datetime',
    ];

    /**
     * Polymorphic ilişki: Contact veya Deal gibi subject’e bağlanır
     */
    public function subject()
    {
        return $this->morphTo();
    }
}