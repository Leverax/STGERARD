<?php

namespace App\Http\Controllers;

use App\Helpers\State;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Schooling;
use App\Models\SchoolingDetails;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){

        // $schooling = Schooling::where('academic_years_id' , 2)->whereBetween('classrooms_id' , [1,4])->get();
        // dd($schooling);


        $n_register             = State::register();
        $n_sold                 = State::sold();
        $n_unsold               = State::unsold();
        $backward               = State::backward();
        $n_student              = State::student();
        $amount                 = State::amount();
        $expense                = State::expense();
        $recipe                 = State::recipe();
        $academic_year_active   = State::academic_year_active();
        $academic_years         = AcademicYear::all();
        $classrooms             = Classroom::all();
        return view('state.index' , compact('academic_years' , 'classrooms', 'academic_year_active' , 'n_register' , 'n_sold' , 'n_unsold' , 'backward' , 'n_student' , 'amount' , 'expense' , 'recipe'));
    }


    public function search($year_id){
        $academic_year  = AcademicYear::find($year_id);

        $n_register     = State::register($academic_year);
        $n_sold         = State::sold($academic_year);
        $n_unsold       = State::unsold($academic_year);
        $expense        = State::expense($academic_year);
        $recipe         = State::recipe($academic_year);
        $backward_count = State::backward()->count();
        $backward_sum   = State::backward()->sum('backward');
        $n_student      = State::student();
        $amount_today   = State::amount($academic_year)[0];
        $amount_total   = State::amount($academic_year)[1];

        // $academic_year_active = State::academic_year_active();
        // $academic_years = AcademicYear::all();
        return response()->json(['expense' => $expense , 'recipe' => $recipe , 'n_register' => $n_register , 'n_sold' => $n_sold , 'n_unsold' => $n_unsold , 'backward_count' => $backward_count ,  'backward_sum' => $backward_sum , 'n_student' => $n_student , 'amount_today' => $amount_today , 'amount_total' => $amount_total]);
    }
}
