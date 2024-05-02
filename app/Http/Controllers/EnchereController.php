<?php

namespace App\Http\Controllers;

use App\Models\Enchere;
use Illuminate\Http\Request;

class EnchereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encheres = Enchere::all();
        return $encheres;
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $encheres = new Enchere([
            'produit_id' => $request->input('produit_id'),
            'user_id' => $request->input('user_id'),
            'prixActuelle' => $request->input('prixActuelle'),
            'statut' => $request->input('statut')
            

            ]);
        $encheres->save();
            
        return response()->json($encheres, 201);


        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $encheres = Enchere::find($id);
        return response()->json($encheres);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $encheres = Enchere::find($id);
        $encheres->update($request->all());
       return response()->json($encheres, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $encheres = Enchere::find($id);
       $encheres->delete();
       return response()->json('enchere supprimée !');
    }
    public function Encherer($id,$newUserId,$NouveauPrix)
    {
        $enchere = Enchere::find($id);
        $enchere->user_id=$newUserId;
        $enchere->prixActuelle=$NouveauPrix;
        $enchere->save();
       return response()->json($enchere, 200);
    }
    
    public function countEnchereEnCours()
        {
           $count=Enchere::where('statut', 'en cours')->count();
            
            
            return $count;
        }
        public function countEnchereTermine()
        {
           $count=Enchere::where('statut', 'Termine')->count();
            
            
            return $count;
        }
}
