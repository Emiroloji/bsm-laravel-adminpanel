<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'title','amount','stage','close_date',
        'company_id','contact_id','description','status'
      ];

      public function company() { return $this->belongsTo(Company::class); }
      public function contact() { return $this->belongsTo(Contact::class); }


      protected $casts = [
        'close_date' => 'date',
    ];
}