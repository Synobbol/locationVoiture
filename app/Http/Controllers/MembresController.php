<?php

namespace App\Http\Controllers;

use App\Models\Membres;
use Illuminate\Http\Request;

class MembresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membres = Membres::all();
        
        return view('membres.index', ['membres'=> $membres]);
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
            'pseudo'=>'required',
            'mdp'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required',
            'civil'=>'required',
            'statut'=>'required',
        ]);

        // définir la date pour remplir le champs date_enregistrement
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d H:i:s");
        
        Membres::create([
            'pseudo'=>request("pseudo"),
            'mdp'=>request("mdp"),
            'nom'=>request("nom"),
            'prenom'=>request("prenom"),
            'email'=>request("email"),
            'civil'=>request("civilite"),
            'statut'=>request("statut"),
            'date_enregistrement'=>$date,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membres  $membres
     * @return \Illuminate\Http\Response
     */
    public function show(Membres $membres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    $membres
     * @return \Illuminate\Http\Response
     */
    public function edit( $membres)
    {
        $membres = Membres::find($membres);

        return view("membres.edit", compact("membres"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $membres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $membres)
    {
        $request->validate([
            'pseudo'=>'required',
            'mdp'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required',
            'civil'=>'required',
            'statut'=>'required',
        ]);
        
        // définir la date pour remplir le champs date_enregistrement
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d H:i:s");
        
        $currentMembre = Membres::find($membres);
          
        $currentMembre->update([
            'pseudo'=>request("pseudo"),
            'mdp'=>request("mdp"),
            'nom'=>request("nom"),
            'prenom'=>request("prenom"),
            'email'=>request("email"),
            'civilite'=>request("civil"),
            'statut'=>request("statut"),
            'date_enregistrement'=>$date,
        ]);
        
        return redirect(route("membres.index", ['membres'=>$currentMembre]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $membres
     * @return \Illuminate\Http\Response
     */
    public function destroy( $membres)
    {
        $delete = Membres::find($membres);
        $delete->delete();

        return redirect(route('membres.index'));
    }
}
