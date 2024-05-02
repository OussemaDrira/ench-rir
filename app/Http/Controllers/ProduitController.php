<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{


    public function index()
    {
        $Produits = Produit::all();
        return $Produits;
    }




    public function store(Request $request)
    {
        $Produit = new Produit([
            'nomProduit'=> $request->input('nomProduit'),
            'description' => $request->input('description'),
            'Image' => $request->input('Image'),
            'prixIntialee' => $request->input('prixIntialee'),
            'delaitFin' => $request->input('delaitFin'),
            'statut' => $request->input('statut'),
            'user_id' => $request->input('user_id'),
            'scategorieID' => $request->input('scategorieID'),
        ]);
        $Produit->save();
        return response()->json($Produit, 201);
    }

    public function show($id)
    {
        $Produit = Produit::find($id);
        return response()->json($Produit);
    }
    public function update(Request $request, $id)
    {
        $Produit = Produit::find($id);
        $Produit->update($request->all());
        return response()->json($Produit, 200);
    }

    public function destroy($id)
    {
        $Produit = Produit::find($id);
        $Produit->delete();
        return response()->json('Catégorie supprimée !');
    }
    public function validerProduit($id)
    {

        $Produit = Produit::find($id);
        $Produit->statut="dans l'enchére";
        $Produit->save();
        return response()->json($Produit, 200);

    }

    public function RefuserProduit($id)
    {

        $Produit = Produit::find($id);
        $Produit->statut="Refuse";
        $Produit->save();
        return response()->json($Produit, 200);

    }
    public function ProduitNonEncoreApprouve()
    {
        $produits = Produit::where('statut', 'non approuvé')->with('user', 'scategories')->get();
        return response()->json($produits);    }

    public function getUserByProduct($id){
        $Produit = Produit::find($id);
        $userId = $Produit->user_id;
        return $userId;
    }

    public function getPriceByProduct($id){
        $Produit = Produit::find($id);
        $prixunitiale = $Produit->prixIntialee;
        return $prixunitiale;
    }

    public function changerStatu($id){
        $Produit = Produit::find($id);
        $Produit->statut="en enchere";
        $Produit->save();
        return response()->json($Produit, 200);
    }
    
    public function nbreProduitEnchere(){
        $count=Produit::where('statut', 'en enchere')->count();
        
        
        return $count;
    }

    public function nbreProduitNonValide(){
        $count= Produit::where('statut', 'non approuvé')->count();
        
        
        return $count;
    }

    public function nbreProduitRefuse(){
        $count= Produit::where('statut', 'Refuse')->count();
        
        
        return $count;
    }


    public function nbreProduitVendu(){
        $count= Produit::where('statut', 'Vendu')->count();
        
        
        return $count;
    }

    public function nbreProduitNonVendu(){
        $count= Produit::where('statut', 'NonVendu')->count();
        
        
        return $count;
    }
    
}