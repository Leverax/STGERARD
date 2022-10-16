<?php

namespace App\Http\Controllers;

use App\Models\Schooling;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(mb_strtoupper('été'));
        $students = Students::orderByDesc('lastname')->get();
        return view('student.list' , compact('students'));
    }

    public function getStudent(Request $request , $academic_year_id){

        $GLOBALS['academic_year_id'] = intval($academic_year_id);

        if ($request->search == 'undefined') {
            $students = Students::orderBy('lastname')
                                ->limit(10)
                                ->get()
                                ->filter(function($student){
                                    if (!Schooling::where(['academic_years_id' => $GLOBALS['academic_year_id'] , 'students_id' => $student->id])->where('rest' ,'<=', '0')->first()) {
                                        return $student;
                                    }
                                })->sortByDesc('updated_at')->values()->all();
            // $students = Students::all();
        } else {
            $students = Students::where('firstname' , 'LIKE' , '%'.$request->search.'%')
                                ->orWhere('lastname' , 'LIKE' , '%'.$request->search.'%')
                                ->orWhere('matricule' , 'LIKE' , '%'.$request->search.'%')
                                ->orWhere('indicative' , 'LIKE' , '%'.$request->search.'%')
                                ->limit(10)
                                ->get()
                                ->filter(function($student){
                                    if (!Schooling::where(['academic_years_id' => $GLOBALS['academic_year_id'] , 'students_id' => $student->id])->where('rest' ,'<=', '0')->first()) {
                                        return $student;
                                    }
                                })->sortByDesc('updated_at')->values()->all();
        }

        // return collection student
        return response()->json(['students' => $students]);
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
        $create = 0;
        $students = $request->student;
        
        foreach ($students as $student) {

            if ($student['firstname'] != null && $student['lastname'] != null) {
                $firstname   = mb_strtoupper($student['firstname']);
                $lastname    = mb_strtoupper($student['lastname']);
                $matricule   = mb_substr($lastname, 0, 3).'_'.date('Y').date('m').date('d').Students::all()->count();
                $backward    = $student['backward'] == null ? 0 : ( $student['backward'] < 0 ? 0 : $student['backward'] );

                //Store student
                $create_student = Students::create([
                    'firstname'     => $firstname,
                    'lastname'      => $lastname,
                    'matricule'     => $matricule,
                    'users_id'      => Auth::id(),
                    'backward'      => $backward
                ]);
                
               
               
            }
            
        }

        if (isset($create_student)) {
            return redirect()->route('student.index')->with(['success' => "Vous venez d'enregistrer ".$create." élève(s)."]);
        }else {
            return redirect()->route('student.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Students::find($id);
        return response()->json($students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'lastname'    => 'required|string' ,
            'firstname'   => 'required|string' ,
        ]);

        $students = Students::find($id);

        $lastname  = $request->lastname;
        $firstname = $request->firstname;
        $backward  = $request->backward;
        $indicative  = $request->indicative;
        $update = false;
        
        if ( iconv('utf-8', 'ascii//TRANSLIT', $lastname) != iconv('utf-8', 'ascii//TRANSLIT', $students->lastname) ) {
            $students->update(['lastname' => mb_strtoupper($lastname)]);
            $update = true;
        }


        if (iconv('utf-8' , 'ascii//TRANSLIT' , $firstname) != iconv('utf-8', 'ascii//TRANSLIT', $students->firstname)) {
            $students->update(['firstname' => mb_strtoupper($firstname)]);
            $update = true;
        }

        if (!$indicative) {
            $students->update(['indicative' => null]);
            $update = true;
        }elseif (iconv('utf-8' , 'ascii//TRANSLIT' , $indicative) != iconv('utf-8', 'ascii//TRANSLIT', $students->first()->indicative)) {
            $students->update(['indicative' => $indicative]);
            $update = true;
        }

        if ($backward != $students->backward) {
            $students->update(['backward' => $backward]);
            $update = true;
        }

        if ($update) {
            return redirect()->route('student.index')->with(['success' => "Vous venez de modifier l'élève ".$students->lastname." ".$students->firstname]);
        }else {
            return redirect()->route('student.index')->with(['error' => "Aucune modification apportée."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = Students::find($id);

        if($students->delete()){
            return Redirect::back()->with(['info' => "Vous venez de supprimer l'élève ".$students->lastname." ".$students->firstname."."]);
        }else{
            return Redirect::back()->with(['error' => "Suppression de l'élève ".$students->lastname." ".$students->firstname." a échouée. Veuillez rééssayer à nouveau."]);
        }
    }
}
