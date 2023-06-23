<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $fillable = ['type'];

    public function bouquets() {
        return $this->belongsToMany(Bouquet::class, 'bouquets_types', 'type_id', 'bouquet_id');
    }
}
