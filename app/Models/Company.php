<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name','legal_name','tax_number','phone','email',
        'website','industry','size','address','notes'
    ];
}