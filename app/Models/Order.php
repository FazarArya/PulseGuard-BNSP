<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime', 'patient_id', 'product_id', 'quantity', 'total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}