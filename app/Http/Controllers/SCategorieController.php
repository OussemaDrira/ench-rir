<?php

namespace App\Http\Controllers;

use App\Models\SCategorie;
use Illuminate\Http\Request;

class SCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SCategorie = SCategorie::all();
        return $SCategorie;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $SCategorie = new SCategorie([
            'nomSCategorie' => $request->input('nomSCategorie'),
            'categorie_id' => $request->input('categorie_id'),
        ]);
        $SCategorie->save();
        return response()->json($SCategorie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $SCategorie = SCategorie::find($id);
        return response()->json($SCategorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $SCategorie = SCategorie::find($id);
        $SCategorie->update($request->all());
        return response()->json($SCategorie, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $SCategorie = SCategorie::find($id);
        $SCategorie->delete();
        return response()->json('scategorie supprimée !');
    }


    public function getScategorieByCategorie($id)
    {
        $SCategorie = SCategorie::where('categorie_id',$id)->get();
        
        return $SCategorie;
    }
}
