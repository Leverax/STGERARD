<?php

namespace App\Http\Controllers;

use App\Models\Schooling;
use App\Models\SchoolingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SchoolingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $schooling = Schooling::find($id);
        

        $data = [];
        if ($schoolingDetails = SchoolingDetails::where('schoolings_id' , $id)->get()) {
            foreach ($schoolingDetails as $key => $schoolingDetail) {
                
                if (!$schoolingDetail->generate) {
                    $number = $schoolingDetail->number;
                    if (Auth::user()->status == 'admin') {
                        $action = 
                        '
                            <a onclick="genetateSchooling('.$schoolingDetail->id.' , \''.$number.'\')">Générer le reçu</a> 
                            <a onclick="deleteSchooling('.$schoolingDetail->id.' , \''.$number.'\')" class="text-danger" data-toggle="modal" data-target="#delete-modal">Supprimer</a> | 
                            <a onclick="editSchooling('.$schoolingDetail->id.')" data-toggle="modal" data-target="#edit-modal">Modifier</a>
                        ';
                    }else{
                        $action = 
                        '
                            <a onclick="genetateSchooling('.$schoolingDetail->id.' , \''.$number.'\')">Générer le reçu</a>
                        ';
                    }
                }else{
                    $action = 
                    '
                        <a href="'.route('schooling_details.download' , $schoolingDetail->id).'">Télécharger le reçu</a> 
                    ';
                }
                
                $data[$key] = [
                                'number'    => $schoolingDetail->number,
                                'tranche'   => 'Versement '.$schoolingDetail->tranche,
                                'date'      => $schoolingDetail->created_at->format('d/m/Y').' à '.$schoolingDetail->created_at->format('H:m:s'),
                                'amount'    => number_format( $schoolingDetail->amount , 0 , '' , ' ').' F CFA',
                                'backward'  => number_format( $schoolingDetail->backward , 0 , '' , ' ').' F CFA',
                                'author'    => $schoolingDetail->author,
                                'action'    => $action
                            ];
            }
        }
        
        

        return response()->json(['data' => $data ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolingDetails  $schoolingDetails
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolingDetails $schoolingDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolingDetails  $schoolingDetails
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $schoolingDetails = SchoolingDetails::find($id);
        $schooling = $schoolingDetails->schooling;
        return response()->json(['schoolingDetails' => $schoolingDetails , 'schooling' => $schooling]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolingDetails  $schoolingDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return response()->json($request);

        // $schoolingDetails = $schoolingDetails->first();
        $schoolingDetails = SchoolingDetails::find($id);
        $schooling        = $schoolingDetails->schooling;
        $student          = $schooling->students;

        // Validation
        $request->validate([
            'amount'        => 'required|string',
        ]);
        
        $amount_enter   = intval($request->amount);
        if ($amount_enter != ($schoolingDetails->amount + $schoolingDetails->backward)) {
            
            // Backward and Amount
            if($amount_enter > ($student->backward + $schoolingDetails->backward)){
                $backward = $student->backward + $schoolingDetails->backward;
                $amount = $amount_enter - $backward;
            }else{
                $backward = $amount_enter;
                $amount = 0;
            }

            $details_total   = ($schooling->rest + $schoolingDetails->amount) - ($student->backward + $schoolingDetails->backward);
            
            $rest            = (intval($schooling->rest) + intval($schoolingDetails->amount)) - intval($request->amount);
            $schooling->rest = $rest;

            if ($schooling->save()) {
                // Update schooling details
                $schoolingDetails->amount   = $amount;
                $schoolingDetails->total    = $details_total;
                $schoolingDetails->backward = $backward;
                $schoolingDetails->total_backward = ($student->backward + $schoolingDetails->backward);
                if ($schoolingDetails->save()) {
                    return response()->json(['response' => 'success' , 'm' => ($schoolingDetails)]);
                }else{
                    return response()->json(["response" => 'error' , 'm' => ($schoolingDetails->amount + $schoolingDetails->backward)]);
                }
            }
        }
        return response()->json(['response' => 'error' , 'm' => ($schoolingDetails->amount + $schoolingDetails->backward)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolingDetails  $schoolingDetails
     * @return \Illuminate\Http\Response
     */
    public function remove($id){

        // Get schoolingDetails selected
        $schoolingDetails = SchoolingDetails::find($id);

        // Variable for verify if delete is good
        $delete = false;

        try {
            DB::beginTransaction();
                $schoolingDetails->schooling->update([ 'rest' => ($schoolingDetails->schooling->rest + $schoolingDetails->amount) ]);
                $schoolingDetails->schooling->students->update([($schoolingDetails->schooling->students->backward + $schoolingDetails->backward)]);
                $schooling = $schoolingDetails->schooling;
                if($schoolingDetails->delete()){
                    $index = 0;
                    foreach ($schooling->schooling_details as $schoolingDetail) {
                        $schoolingDetail->tranche = ++$index;
                        $schoolingDetail->save();
                    }
                    $delete = true;
                }else{
                    $schoolingDetails->schooling->update([ 'rest' => ($schoolingDetails->schooling->rest - $schoolingDetails->amount) ]);
                    $schoolingDetails->schooling->students->update([($schoolingDetails->schooling->students->backward - $schoolingDetails->backward)]);
                }
            DB::commit();
        } catch (\Throwable $th) {
            return response()->json(["response" => 'error']);
        }
        if ($delete) {
            return response()->json(['response' => 'success']);
        }
    }

    public function generate($id){
        $schoolingDetails = SchoolingDetails::find($id);

        $data = [
            'schoolingDetails' => $schoolingDetails,
        ];
        $path = $schoolingDetails->schooling->students->lastname.'_'.$schoolingDetails->schooling->students->firstname.'_'.$schoolingDetails->number;
        $pdf = PDF::loadView('schooling.invoice', $data)
                    ->setPaper('a6')
                    ->setWarnings(false)
                    ->save(public_path("storage/documents/".$path.".pdf"))
                    ->stream();
        if ($pdf) {
            $schoolingDetails->update(['generate' => true]);
            $generate = true;return response()->json(['response' => 'success']);
        }else{
            return response()->json(['response' => 'error']);
        }

    }


    public function download($id){

        $schoolingDetails = SchoolingDetails::find($id);
        $path = $schoolingDetails->schooling->students->lastname.'_'.$schoolingDetails->schooling->students->firstname.'_'.$schoolingDetails->number;

        if(Storage::exists('public/documents/'.$path.'.pdf')){
            return Storage::download('public/documents/'.$path.'.pdf');
            // return Storage::disk('local')->get('public/documents/'.$schoolingDetails->number.'.pdf');
        }else{
            $data = [
                'schoolingDetails' => $schoolingDetails,
            ];

            $pdf = PDF::loadView('schooling.invoice', $data)
                    ->setPaper('a6')
                    ->setWarnings(false)
                    ->save(public_path("storage/documents/".$path.".pdf"))
                    ->stream();
            return Storage::download('public/documents/'.$path.'.pdf');
        }
        
    }

    public function destroy(SchoolingDetails $schoolingDetails)
    {
      
        
    }
}
