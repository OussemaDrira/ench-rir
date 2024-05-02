<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enchere extends Model
{
    protected $fillable = [
        'produit_id','user_id','prixActuelle','statut'
        ];


     public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
        
        
    use HasFactory;
}
