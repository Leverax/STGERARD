<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('updated_at')->get();
        return view('user.list' , compact('users'));
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
            'lastname'    => 'required|string' ,
            'firstname'   => 'required|string' ,
            'email'       => 'required|email|unique:users',
            'status'      => 'required'
        ]);

        $lastname   = $request->lastname;
        $firstname  = $request->firstname;
        $email      = $request->email;
        $status     = $request->status;

        //Store user
        $new_user = User::create([
            'lastname'      => $lastname ,
            'firstname'     => $firstname ,
            'status'        => $status ,
            'email'         => $email
        ]);

        if ($new_user) {
            return redirect()->route('utilisateur.index')->with(['success' => "Vous venez d'enregistrer un nouvel utilisateur."]);
        }else {
            return redirect()->route('utilisateur.index')->with(['error' => "Enregistrement echoué. Veuillez verifier vos informations saisies."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($user = User::findOrFail($id)) {
            if($user->delete()){
                return Redirect::back()->with(['info' => "Vous venez de supprimer l'utilisateur ".$user->lastname.' '.$user->firstname.'.']);
            }else{
                return Redirect::back()->with(['error' => "Suppression de l'utilisateur ".$user->lastname.' '.$user->firstname.' échouée. Veuillez rééssayer à nouveau.']);
            }
       }else {
            return Redirect::back()->with(['error' => "L'utilisateur sélectionner n'exite plus dans notre base de données."]);
       }  
    }

    public function state($id){
        $user = User::find($id);
        $user->isActive = $user->isActive == 0 ? 1 : 0;
        $user->save();
        $response = $user->isActive ? 'YES' : 'NO';
        return Response::json(['response' => $response ]);
    }
}
