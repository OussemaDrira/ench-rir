<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'nomCategorie'

        ];
    use HasFactory;
    public function Scategorie()
{

return $this->hasMany(SCategorie::class);
}
}
