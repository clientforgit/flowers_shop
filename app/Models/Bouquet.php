<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Bouquet extends Model
{
    use HasFactory;
    protected $table = 'bouquets';
    protected $fillable = ['name', 'category', 'price', 'material', 'size', 'description', 'composition', 'img_name', 'best_offer'];
}
