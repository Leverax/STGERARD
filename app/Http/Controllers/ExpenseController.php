<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        $academic_years = AcademicYear::all();
        return view('expense.list' , compact('expenses' , 'academic_years'));
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
        // dd($request);
        $request->validate([
            'academic_year' => 'required|integer' ,
            'motif'         => 'required|string' ,
            'receiver'      => 'required|string' ,
            'amount'        => 'required|integer' ,
            'cycle'         => 'required|string' ,
        ]);

        $academic_year  = $request->academic_year;
        $motif          = $request->motif;
        $receiver       = $request->receiver;
        $amount         = $request->amount;
        $cycle          = $request->cycle;

        //Store user
        $expense = Expense::create([
            'academic_years_id' => $academic_year ,
            'motif'             => $motif ,
            'receiver'          => $receiver ,
            'amount'            => $amount ,
            'cycle'             => $cycle ,
            'users_id'          => Auth::id()
        ]);

        if ($expense) {
            return redirect()->route('expense.index')->with(['success' => "Vous venez d'enregistrer une nouvelle dépense."]);
        }else {
            return redirect()->route('expense.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'academic_year' => 'required|integer' ,
            'motif'         => 'required|string' ,
            'receiver'      => 'required|string' ,
            'amount'        => 'required|integer' ,
            'cycle'         => 'required|string' ,
        ]);

        $academic_year  = $request->academic_year;
        $motif          = $request->motif;
        $receiver       = $request->receiver;
        $amount         = $request->amount;
        $cycle          = $request->cycle;
        $update = false;
        
        if ( iconv('utf-8', 'ascii//TRANSLIT', $motif) != iconv('utf-8', 'ascii//TRANSLIT', $expense->first()->motif) ) {
            $expense->update(['motif' => $motif]);
            $update = true;
        }

        if ( iconv('utf-8', 'ascii//TRANSLIT', $receiver) != iconv('utf-8', 'ascii//TRANSLIT', $expense->first()->receiver) ) {
            $expense->update(['receiver' => $receiver]);
            $update = true;
        }

        if ( iconv('utf-8', 'ascii//TRANSLIT', $cycle) != iconv('utf-8', 'ascii//TRANSLIT', $expense->first()->cycle) ) {
            $expense->update(['cycle' => $cycle]);
            $update = true;
        }

        if ($amount != $expense->first()->$amount) {
            $expense->update(['amount' => $amount]);
            $update = true;
        }

        if ($academic_year != $expense->first()->academic_years_id) {
            $expense->update(['academic_years_id' => $academic_year]);
            $update = true;
        }

        if ($update) {
            return redirect()->route('expense.index')->with(['success' => "Vous venez de modifier la dépense ".$expense->first()->motif]);
        }else {
            return redirect()->route('expense.index')->with(['error' => "Aucune modification apportée."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        if($expense->delete()){
            return Redirect::back()->with(['info' => "Vous venez de supprimer la dépense ".$expense->motif]);
        }else{
            return Redirect::back()->with(['error' => "Suppression de la dépense ".$expense->motif.' a échouée. Veuillez rééssayer à nouveau.']);
        }
    }
}
