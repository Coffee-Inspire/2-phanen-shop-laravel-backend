<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCosmetic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'priceInd', 'priceTwn', 'description', 'category', 'status'];
}
