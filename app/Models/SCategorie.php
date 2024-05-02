<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SCategorie extends Model
{
    protected $fillable = [
        'nomSCategorie','categorie_id'

        ];
        
    use HasFactory;
    public function categories()
{ 
return $this->belongsTo(Categorie::class,"categorie_id"); 
}
}
