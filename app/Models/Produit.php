<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nomProduit','description','Image','prixIntialee','delaitFin','statut','scategorieID','user_id'
        ];
    use HasFactory;
 public function user()
{

return $this-> belongsTo(User::class, 'user_id');
}
public function scategories()
{
return $this->belongsTo(SCategorie::class,"scategorieID");
}
}
