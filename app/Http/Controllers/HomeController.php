<?php

namespace App\Http\Controllers;

use App\Helpers\State;
use App\Models\AcademicYear;
use App\Models\Classroom;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $n_register = State::register();
        $n_sold = State::sold();
        $n_unsold = State::unsold();
        $backward = State::backward();
        $n_student = State::student();
        $amount = State::amount();
        $expense                = State::expense();
        $recipe                 = State::recipe();
        $academic_year_active = State::academic_year_active();
        $academic_years = AcademicYear::all();
        $classrooms = Classroom::all();
        return view('dashboard.index' , compact('academic_years' , 'academic_year_active' , 'classrooms' , 'n_register' , 'n_sold' , 'n_unsold' , 'backward' , 'n_student' , 'amount' , 'expense' , 'recipe'));
    }
}