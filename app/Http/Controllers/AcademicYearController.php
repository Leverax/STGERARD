<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academic_years = AcademicYear::orderByDesc('updated_at')->get();
        return view('academic_year.list' , compact('academic_years'));
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
            'name'  => 'required|string|unique:academic_years' ,
        ]);

        $name = $request->name;

        if($academic_years = AcademicYear::where('isActive' , true)->get()){
            foreach ($academic_years as $key => $academic_year) {
                $academic_year->isActive = false;
                $academic_year->save();
            }
        }
        
        //Store academic_year
        $academic_year = AcademicYear::create([
            'name'          => $name ,
            'users_id'      => Auth::id()
        ]);

        if ($academic_year) {
            return redirect()->route('academic_year.index')->with(['success' => "Vous venez d'enregistrer une nouvelle année scolaire."]);
        }else {
            return redirect()->route('academic_year.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicYear $academicYear)
    {
        return response()->json($academicYear);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'name'         => 'required|string|unique:academic_years' ,
        ]);

        $name        = $request->name;
        $update = false;
        
        if ( iconv('utf-8', 'ascii//TRANSLIT', $name) != iconv('utf-8', 'ascii//TRANSLIT', $academicYear->first()->name) ) {
            $academicYear->update(['name' => $name]);
            $update = true;
        }

        if ($update) {
            return redirect()->route('academic_year.index')->with(['success' => "Vous venez de modifier l'année académique en ".$academicYear->first()->name."."]);
        }else {
            return redirect()->route('academic_year.index')->with(['error' => "Aucune modification apportée."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicYear $academicYear)
    {
        if($academicYear->delete()){
            return Redirect::back()->with(['info' => "Vous venez de supprimer la classe ".$academicYear->name]);
        }else{
            return Redirect::back()->with(['error' => "Suppression de la classe ".$academicYear->name.' a échouée. Veuillez rééssayer à nouveau.']);
        }
    }

    public function state($id){
        try {

            DB::beginTransaction();

                if($academic_years = AcademicYear::where('isActive' , true)->get()){
                    foreach ($academic_years as $key => $academic_year) {
                        $academic_year->isActive = false;
                        $academic_year->save();
                    }
                }
                $academic_year = AcademicYear::find($id);
                $academic_year->isActive = $academic_year->isActive == 0 ? 1 : 0;
                $academic_year->save();
                $response = $academic_year->isActive ? 'YES' : 'NO';

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
        }
        
        return Response::json(['response' => $response ]);
    }
}
