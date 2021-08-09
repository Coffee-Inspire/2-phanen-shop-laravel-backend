<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFashion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'priceInd', 'priceTwn', 'info', 'description', 'category', 'size', 'status'];
}
