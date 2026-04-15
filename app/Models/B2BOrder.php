<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2BOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'b2b_category_id',
        'company_name',
        'email',
        'phone',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(B2BCategory::class, 'b2b_category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'b2b_order_product', 'b2b_order_id', 'product_id');
    }
}
