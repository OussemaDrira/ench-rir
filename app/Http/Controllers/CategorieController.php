<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Categorie::all();
        return $Categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Categorie = new Categorie([
            'nomCategorie' => $request->input('nomCategorie'),
        ]);
        $Categorie->save();
        return response()->json($Categorie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $Categorie = Categorie::find($id);
        return response()->json($Categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Categorie = Categorie::find($id);
        $Categorie->update($request->all());
        return response()->json($Categorie, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();
        return response()->json('Catégorie supprimée !');
    }
}
