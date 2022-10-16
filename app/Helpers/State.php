<?php
namespace App\Helpers;

use App\Models\AcademicYear;
use App\Models\Expense;
use App\Models\Recipe;
use App\Models\Schooling;
use App\Models\SchoolingDetails;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;

class State {

    public static function academic_year_active(){
        return AcademicYear::where('isActive' , true)->first();
    }

    public static function register($year = false){

        if (!$year) {
            $year = State::academic_year_active();
        }

        if ($year) {
            $n_register = Schooling::where('academic_years_id' , $year->id)
                                ->get()->count();
        }else{
            $n_register = 0;
        }
        
        return $n_register;

    }

    public static function registerByPeriod($start_date , $end_date){

        if ($start_date && $end_date) {
            $n_register = Schooling::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])
                                ->get()->count();
        }else{
            $n_register = 0;
        }
        
        return $n_register;

    }


    public static function sold($year = false){

        if (!$year) {
            $year = State::academic_year_active();
        }

        if ($year) {
            $n_sold = Schooling::where('academic_years_id' , $year->id)
                            ->where('rest' , '<=' , 0)->get()->count();
        }else{
            $n_sold = 0;
        }
        return $n_sold;
        
    }

    public static function soldByPeriod($start_date , $end_date){

        if ($start_date && $end_date) {
            $n_sold = Schooling::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])
                            ->where('rest' , '<=' , 0)->get()->count();
        }else{
            $n_sold = 0;
        }
        return $n_sold;
        
    }

    public static function unsold($year = false){

        if (!$year) {
            $year = State::academic_year_active();
        }

        if ($year) {
            $n_unsold = Schooling::where('academic_years_id' , $year->id)
                                ->where('rest' , '>' , 0)->get()->count();
        }else{
            $n_unsold = 0;
        }
        return $n_unsold;
        
    }


    public static function unsoldByPeriod($start_date , $end_date){

        if ($start_date && $end_date) {
            $n_unsold = Schooling::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])
                                ->where('rest' , '>' , 0)->get()->count();
        }else{
            $n_unsold = 0;
        }
        return $n_unsold;
        
    }

    public static function backward(){
        
        $backward = Students::where('backward' , '>' , 0)->get();
        return $backward;
        
    }

    public static function backwardByPeriod($start_date , $end_date){
        
        $backward = Students::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])
                            ->where('backward' , '>' , 0)->get();
        return $backward;
        
    }
    

    public static function student(){
        
        $n_student = Students::all()->count();
        return $n_student;
        
    }

    public static function studentByPeriod($start_date , $end_date){
        
        $n_student = Students::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])->count();
        return $n_student;
        
    }

    public static function amount($year = false){
        if (!$year) {
            $GLOBALS['year'] = State::academic_year_active();
        }else{
            $GLOBALS['year'] = $year;
        }

        if ($GLOBALS['year']) {
            if (Auth::user()->status == 'user') {
                $schooling_details_today = SchoolingDetails::whereDate('created_at' , date('Y-m-d'))->get()->filter(function($schooling_details){
                    if ($schooling_details->schooling) {
                        if($schooling_details->schooling->academic_years_id == $GLOBALS['year']->id && $schooling_details->schooling->users_id == Auth::id() ){
                            return $schooling_details;
                        }
                    }
                });
        
                $schooling_details = SchoolingDetails::all()->filter(function($schooling_details){
                    if ($schooling_details->schooling) {
                        if($schooling_details->schooling->academic_years_id == $GLOBALS['year']->id && $schooling_details->schooling->users_id == Auth::id()){
                            return $schooling_details;
                        }
                    }
                });
            }elseif (Auth::user()->status == 'admin') {
                $schooling_details_today = SchoolingDetails::whereDate('created_at' , date('Y-m-d'))->get()->filter(function($schooling_details){
                    if ($schooling_details->schooling) {
                        if($schooling_details->schooling->academic_years_id == $GLOBALS['year']->id){
                            return $schooling_details;
                        }
                    }
                });
        
                $schooling_details = SchoolingDetails::all()->filter(function($schooling_details){
                    if ($schooling_details->schooling) {
                        if($schooling_details->schooling->academic_years_id == $GLOBALS['year']->id){
                            return $schooling_details;
                        }
                    }
                });            
            }
            

            $amount_today = $schooling_details_today->sum('amount') + $schooling_details_today->sum('backward');
            $amount_total = $schooling_details->sum('amount') + $schooling_details->sum('backward');
            $amount = [$amount_today , $amount_total];
        }else{
            $amount = [0,0];
        }
        
        return $amount;
    }



    public static function amountByPeriod($start_date , $end_date){
        $GLOBALS['year'] = State::academic_year_active();
        if ($start_date && $end_date) {
            if (Auth::user()->status == 'user') {
                $schooling_details = SchoolingDetails::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])
                                                    ->get()
                                                    ->filter(function($schooling_details){
                                                        if ($schooling_details->schooling) {
                                                            if($schooling_details->schooling->users_id == Auth::id()){
                                                                return $schooling_details;
                                                            }
                                                        }
                                                    });
            }elseif (Auth::user()->status == 'admin') {
                $schooling_details = SchoolingDetails::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])
                                        ->get()
                                        ->filter(function($schooling_details){
                                            if ($schooling_details->schooling) {
                                                return $schooling_details;
                                            }
                                        });
            }
            
            $amount = $schooling_details->sum('amount') + $schooling_details->sum('backward');
        }else{
            $amount = 0;
        }
        
        return $amount;
    }

    public static function expense($year = false){
        if (!$year) {
            $year = State::academic_year_active();
        }

        if ($year) {
            $expense = Expense::where('academic_years_id' , $year->id)->get()->sum('amount');
        }else{
            $expense = 0;
        }
        return $expense;
    } 

    public static function expenseByPeriod($start_date , $end_date){
        
        $expenses = Expense::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])->get();
        return $expenses;
        
    }

    public static function recipe($year = false){
        if (!$year) {
            $year = State::academic_year_active();
        }

        if ($year) {
            $recipe = Recipe::where('academic_years_id' , $year->id)->get()->sum('amount');
        }else{
            $recipe = 0;
        }
        return $recipe;
    } 
    
    public static function recipeByPeriod($start_date , $end_date){
        
        $recipes = Recipe::whereBetween('created_at' , [date('Y-m-d 00:00:00' , strtotime($start_date)) , date('Y-m-d 23:59:59' , strtotime($end_date))])->get();
        return $recipes;
        
    }

}