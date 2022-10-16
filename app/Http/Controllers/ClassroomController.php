<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Schooling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::orderByDesc('updated_at')->get();
        return view('class.list' , compact('classrooms'));
    }


    public function getClassroom(Request $request , $academic_year_id , $student_id){

        // $GLOBALS['academic_year_id'] = intval($academic_year_id);
        // $GLOBALS['student_id'] = intval($student_id);

        $schooling = Schooling::where('academic_years_id' , $academic_year_id)
                    ->where('students_id' , $student_id)
                    ->first();
        $isArray = false;

        if ($request->search == 'undefined') {
            // $classroom = Classroom::orderBy('lastname')
            //                     ->limit(10)
            //                     ->get()
            //                     ->filter(function($student){
            //                         if (!Schooling::where(['academic_years_id' => $GLOBALS['academic_year_id'] , 'students_id' => $student->id])->where('rest' ,'<=', '0')->first()) {
            //                             return $student;
            //                         }
            //                     })->sortByDesc('updated_at')->values()->all();
            
            if ($schooling) {
                $classroom = $schooling->classrooms;
            }else{
                $classroom = Classroom::orderBy('name')
                                        ->limit(10)
                                        ->get();
                $isArray = true;
            }
        } else {
            // $students = Students::where('firstname' , 'LIKE' , '%'.$request->search.'%')
            //                     ->orWhere('lastname' , 'LIKE' , '%'.$request->search.'%')
            //                     ->orWhere('matricule' , 'LIKE' , '%'.$request->search.'%')
            //                     ->limit(10)
            //                     ->get()
            //                     ->filter(function($student){
            //                         if (!Schooling::where(['academic_years_id' => $GLOBALS['academic_year_id'] , 'students_id' => $student->id])->first()) {
            //                             return $student;
            //                         }
            //                     })->sortByDesc('updated_at')->values()->all();
            if ($schooling) {
                $classroom = $schooling->classrooms;
            }else{
                $classroom = Classroom::where('name' , 'LIKE' , '%'.$request->search.'%')
                                        ->limit(10) 
                                        ->get();
                $isArray = true;
            }
        }

        // return collection student
        return response()->json(['classrooms' => $classroom , 'isArray' => $isArray]);
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
            'name'         => 'required|string' ,
            'schoolings'   => 'required|integer' ,
        ]);

        $name   = $request->name;
        $schoolings  = $request->schoolings;

        //Store user
        $classroom = Classroom::create([
            'name'          => $name ,
            'schoolings'    => $schoolings ,
            'users_id'      => Auth::id()
        ]);

        if ($classroom) {
            if ($request->indicative) {
                $classroom = $classroom->update(['indicative' => $request->indicative]);
            }
            return redirect()->route('classroom.index')->with(['success' => "Vous venez d'enregistrer une nouvelle classe."]);
        }else {
            return redirect()->route('classroom.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return response()->json($classroom);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
      
        $request->validate([
            'name'         => 'required|string' ,
            'schoolings'   => 'required|string' ,
        ]);

        $name        = $request->name;
        $schoolings  = $request->schoolings;
        $indicative  = $request->indicative;
        $update = false;
        
        if ( iconv('utf-8', 'ascii//TRANSLIT', $name) != iconv('utf-8', 'ascii//TRANSLIT', $classroom->first()->name) ) {
            $classroom->update(['name' => $name]);
            $update = true;
        }


        if (iconv('utf-8' , 'ascii//TRANSLIT' , $schoolings) != iconv('utf-8', 'ascii//TRANSLIT', $classroom->first()->schoolings)) {
            $classroom->update(['schoolings' => $schoolings]);
            $update = true;
        }

        if (!$indicative) {
            $classroom->update(['indicative' => null]);
            $update = true;
        }elseif (iconv('utf-8' , 'ascii//TRANSLIT' , $indicative) != iconv('utf-8', 'ascii//TRANSLIT', $classroom->first()->indicative)) {
            $classroom->update(['indicative' => $indicative]);
            $update = true;
        }

        if ($update) {
            return redirect()->route('classroom.index')->with(['success' => "Vous venez de modifier la classe ".$classroom->first()->name]);
        }else {
            return redirect()->route('classroom.index')->with(['error' => "Aucune modification apportée."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        if($classroom->delete()){
            return Redirect::back()->with(['info' => "Vous venez de supprimer la classe ".$classroom->name]);
        }else{
            return Redirect::back()->with(['error' => "Suppression de la classe ".$classroom->name.' a échouée. Veuillez rééssayer à nouveau.']);
        }
    }
}
