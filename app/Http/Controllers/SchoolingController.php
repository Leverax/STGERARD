<?php

namespace App\Http\Controllers;

use App\Exports\SchoolingExport;
use App\Exports\SchoolingSortExport;
use App\Helpers\FormatNumberToLetter;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Schooling;
use App\Models\SchoolingDetails;
use App\Models\Students;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class SchoolingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $academic_year = AcademicYear::where('isActive' , true)->first();
        $academic_years = AcademicYear::orderBy('isActive' , 'DESC')->get();
        $students = Students::orderBy('lastname')->get();
        $classrooms = Classroom::orderBy('name' , 'DESC')->get();
        $schoolings = Schooling::orderByDesc('updated_at')->get();
        // $schoolings = Schooling::orderBy('updated_at' , 'DESC')->get()->groupBy(['academic_years_id' , 'classrooms_id']);
        // dd($schoolings);
        return view('schooling.list' , compact('schoolings' , 'academic_years' , 'students' , 'classrooms'));
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
        // Validation
        $request->validate([
            'academic_year' => 'required|string' ,
            'student'       => 'required|string' ,
            'classroom'     => 'required|string' ,
            'amount'        => 'required|string' ,
        ]);

        // Get Collection and request value
        $academic_year  = AcademicYear::find($request->academic_year);
        $student        = Students::find($request->student);
        $classroom      = Classroom::find($request->classroom);
        // $backward = $request->backward != null ? $request->backward : 0;
        $amount_enter   = intval($request->amount);
        $author   = ($request->author != null) ? $request->author : $student->lastname.' '.$student->firstname;
        
      
                // Unique number
                // $unique_n = 'IR'.sprintf("%08d", ( SchoolingDetails::all()->count() + 1 ));
                
                if ($last_schoolagind_details = SchoolingDetails::all()->last()) {
                    // $last_schoolagind_details = explode('IR' , $last_schoolagind_details);
                    // $unique_n = 'IR'.sprintf("%08d" , $last_schoolagind_details[1]+1);
                    $unique_n = 'IR'.sprintf("%08d" , $last_schoolagind_details->id+1);
                }else{
                    $unique_n = 'IR'.sprintf("%08d", (1));
                }
                
                // Backward and Amount
                if($amount_enter > $student->backward){
                    $backward = $student->backward;
                    $amount = $amount_enter - $student->backward;
                }else{
                    $backward = $amount_enter;
                    $amount = 0; 
                }

                // Check y schooling is already save
                $schooling = Schooling::where('students_id' , $student->id)
                                        ->where('academic_years_id' , $academic_year->id)
                                        ->where('classrooms_id' , $classroom->id)
                                        ->first();

                // If YES
                if ($schooling) {

                    $details_total = $schooling->rest - $student->backward;
                    $rest     = intval($schooling->rest) - intval($request->amount);

                    // Update schooling
                    if($schooling->update(['rest' => $rest])){
                        // Update schooling details
                        $schooling_details = SchoolingDetails::create([
                            'number'        => $unique_n,
                            'amount'        => $amount ,
                            'total'         => $details_total,
                            'author'        => $author,
                            'backward'      => $backward,
                            'total_backward'=> $student->backward,
                            'tranche'       => $schooling->schooling_details->count()+1,
                            'schoolings_id' => $schooling->id,
                        ]);
                    }
                }else{ // If NO
                
                    $rest     = intval($classroom->schoolings) + intval($student->backward) - intval($request->amount);

                    try {

                        DB::beginTransaction();
            
                            //Store schooling
                            $schooling = Schooling::create([
                                'academic_years_id' => $academic_year->id ,
                                'students_id'       => $student->id ,
                                'classrooms_id'     => $classroom->id,
                                'total'             => $classroom->schoolings,
                                'backward'          => $student->backward,
                                'rest'              => $rest,
                                'users_id'          => Auth::id()
                            ]);
                            // Store schooling details
                            $schooling_details = SchoolingDetails::create([
                                'number'        => $unique_n,
                                'amount'        => $amount ,
                                'total'         => $classroom->schoolings,
                                'author'        => $author,
                                'backward'      => $backward,
                                'total_backward'=> $student->backward,
                                'tranche'       => 1,
                                'schoolings_id' => $schooling->id,
                            ]);
                    
                        DB::commit();

                    } catch (\Throwable $th) {
                        // throw $th;
                        return redirect()->route('schooling.index')->with(['error' => "Enregistrement échoué. Veuillez vérifier vos informations saisies."]);
                    }
                }

                // Traitement for backward to student
                $student->update(['backward' => ($student->backward - $backward) ]);

          

        if ($schooling && $schooling_details) {
            return redirect()->route('schooling.index')->with(['success' => "Vous venez d'enregistrer une nouvelle facture."]);
        }else {
            return redirect()->route('schooling.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schooling  $schooling
     * @return \Illuminate\Http\Response
     */
    public function show(Schooling $schooling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schooling  $schooling
     * @return \Illuminate\Http\Response
     */
    public function edit(Schooling $schooling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schooling  $schooling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schooling $schooling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schooling  $schooling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schooling $schooling)
    {
        if($schooling->students->update(['backward' => $schooling->backward])){
            if($schooling->delete()){
                return Redirect::back()->with(['info' => "Suppression de scolarité effectuée avec success."]);
            }else{
                return Redirect::back()->with(['error' => "La suppression de la scolarité a échouée. Veuillez rééssayer à nouveau."]);
            }
        }else{
            return Redirect::back()->with(['error' => "La suppression de la scolarité a échouée. Veuillez rééssayer à nouveau."]);
        }
        
    }

    public function get_rest($student_id , $academic_year_id , $classroom_id){

        $rests = [];
        $rest = 0;
        $student = null;
        $old_rest = false;

        if ($student_id != "null") {

            $student = Students::find($student_id);
            $schoolings = Schooling::where('students_id' , $student_id)->get();
            foreach ($schoolings as $key => $schooling) {
                if ($schooling->rest > 0 ) {
                    array_push($rests , [$schooling->academic_years , $schooling]);
                }
            }

            if ($academic_year_id != "null" && $classroom_id != "null") {
                $schooling = Schooling::where('students_id' , $student_id)
                                        ->where('academic_years_id' , $academic_year_id)
                                        ->where('classrooms_id' , $classroom_id)
                                        ->first();
                if ($schooling) {
                    $rest = intval($schooling->rest);
                    $old_rest = true;
                }else{
                    $rest = Classroom::find($classroom_id)->schoolings;
                }
            }
        }
        
        

        return response()->json(['student' => $student , 'rests' => $rests , 'rest' => $rest , 'old_rest' => $old_rest]);
    }

    public function generate_invoice(){
        // dd(base_path()."/public/images/logo.png");
        // return view('schooling.invoice');
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        // $pdf = PDF::setOptions([
        //     "defaultFont" => "Courier",
        //     "defaultPaperSize" => "a6",
        //     "dpi" => 130
        // ]);
        $pdf = PDF::loadView('schooling.invoice', $data)
            ->setPaper('a6');
            // ->setWarnings(false)
            // ->save(public_path("storage/documents/fichier.pdf"))
            // ->stream();
    
        return $pdf->download('facture.pdf');
    }

    public function export_excel($start_date , $end_date){
        return Excel::download(new SchoolingExport($start_date , $end_date), 'RECAP_du_'.$start_date.'_au_'.$end_date.'.xlsx');
    }

    public function export_sort_excel($academic_year , $classroom){

        $classroom_arr = json_decode($classroom);
        if (count($classroom_arr) == 0) {
            return redirect()->back()->with(['error' => 'Veuillez sélectionnez au moins une classe']);
        }
        $classrooms = Classroom::find($classroom_arr);
        $classroom_name = '';
        foreach ($classrooms as $key => $classroom) {
            $classroom_name = $classroom_name.'_'.$classroom->name;
        }
        
        $academic_year = AcademicYear::find($academic_year);
        return Excel::download(new SchoolingSortExport($academic_year , $classrooms , $classroom_name), 'RECAP_DE'.str_replace('/' , '_' , $classroom_name).'_DE_'.$academic_year->name.'.xlsx');
    }
}
