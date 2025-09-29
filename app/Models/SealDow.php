<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SealDow extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'product_name',
        'batch_number',
        'manufacture_date',
        'expiry_date',
        'manufacturing_site',
        'repacking_site',  
    ];
}
