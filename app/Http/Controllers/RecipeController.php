<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        $academic_years = AcademicYear::all();
        return view('recipe.list' , compact('recipes' , 'academic_years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'academic_year' => 'required|integer' ,
            'motif'         => 'required|string' ,
            'amount'        => 'required|integer' ,
        ]);

        $academic_year  = $request->academic_year;
        $motif          = $request->motif;
        $amount         = $request->amount;

        //Store user
        $recipe = Recipe::create([
            'academic_years_id' => $academic_year ,
            'motif'             => $motif ,
            'amount'            => $amount ,
            'users_id'          => Auth::id()
        ]);

        if ($recipe) {
            return redirect()->route('recipe.index')->with(['success' => "Vous venez d'enregistrer une nouvelle recette."]);
        }else {
            return redirect()->route('recipe.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return response()->json($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'academic_year' => 'required|integer' ,
            'motif'         => 'required|string' ,
            'amount'        => 'required|integer' ,
        ]);

        $academic_year  = $request->academic_year;
        $motif          = $request->motif;
        $amount         = $request->amount;
        $update = false;
        
        if ( iconv('utf-8', 'ascii//TRANSLIT', $motif) != iconv('utf-8', 'ascii//TRANSLIT', $recipe->first()->motif) ) {
            $recipe->update(['motif' => $motif]);
            $update = true;
        }

        if ($amount != $recipe->first()->$amount) {
            $recipe->update(['amount' => $amount]);
            $update = true;
        }

        if ($academic_year != $recipe->first()->academic_years_id) {
            $recipe->update(['academic_years_id' => $academic_year]);
            $update = true;
        }

        if ($update) {
            return redirect()->route('recipe.index')->with(['success' => "Vous venez de modifier la recette ".$recipe->first()->motif]);
        }else {
            return redirect()->route('recipe.index')->with(['error' => "Aucune modification apportée."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        if($recipe->delete()){
            return Redirect::back()->with(['info' => "Vous venez de supprimer la recette ".$recipe->motif]);
        }else{
            return Redirect::back()->with(['error' => "Suppression de la recette ".$recipe->motif.' a échouée. Veuillez rééssayer à nouveau.']);
        }
    }
}
