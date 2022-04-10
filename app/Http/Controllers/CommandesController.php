<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // filtrage
        $agences = request('agences');

        if(isset($agences)){
            $commandes = DB::table('commande')
            ->join('agences', 'commande.id_agence', '=','agences.id_agence')
            ->join('vehicule', 'commande.id_vehicule', '=','vehicule.id_vehicule')
            ->join('membre', 'commande.id_membre', '=','membre.id_membre')
            ->select('commande.*', 'agences.titre as agence_titre','agences.id_agence as agenceID',
            'vehicule.id_vehicule as vehiculeID','vehicule.titre as vehicule_titre',
            'membre.id_membre as membreID','membre.nom as membre_nom','membre.prenom as membre_prenom','membre.email as membre_email')
            ->where('commande.id_agence', $agences)
            ->get();
        }
        else if(!isset($agences) ){
            $commandes = DB::table('commande')
            ->join('agences', 'commande.id_agence', '=','agences.id_agence')
            ->join('vehicule', 'commande.id_vehicule', '=','vehicule.id_vehicule')
            ->join('membre', 'commande.id_membre', '=','membre.id_membre')
            ->select('commande.*', 'agences.titre as agence_titre','agences.id_agence as agenceID',
            'vehicule.id_vehicule as vehiculeID','vehicule.titre as vehicule_titre',
            'membre.id_membre as membreID','membre.nom as membre_nom','membre.prenom as membre_prenom','membre.email as membre_email')
            ->get();
        }
        
        return view('commandes.index', ['commandes'=> $commandes]);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commandes  $commandes
     * @return \Illuminate\Http\Response
     */
    public function show(Commandes $commandes)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    $commandes
     * @return \Illuminate\Http\Response
     */
    public function edit($commandes)
    {
        // $commandeEdit = DB::table('commande')
        // ->join('agences', 'commande.id_agence', '=','agences.id_agence')
        // ->join('vehicule', 'commande.id_vehicule', '=','vehicule.id_vehicule')
        // ->join('membre', 'commande.id_membre', '=','membre.id_membre')
        // ->select('commande.*', 'agences.titre as agence_titre','agences.id_agence as agenceID',
        // 'vehicule.id_vehicule as vehiculeID','vehicule.titre as vehicule_titre',
        // 'membre.id_membre as membreID','membre.nom as membre_nom','membre.prenom as membre_prenom','membre.email as membre_email')
        // ->where('commande.id_commande', $commandes)
        // ->get();
        $commandeEdit = Commandes::agence($commandes);
        dd($commandeEdit);
        return view("commandes.edit", ['commandes'=> $commandeEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commandes  $commandes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commandes $commandes)
    {

        return view("commandes.index", ['commandes'=>$commandes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $commandes
     * @return \Illuminate\Http\Response
     */
    public function destroy( $commandes)
    {
        $delete = Commandes::find($commandes);
        $delete->delete();

        return redirect(route('commandes.index'));
    }
}
