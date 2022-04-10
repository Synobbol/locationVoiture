<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Agences;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicule = DB::table('vehicule')
            ->join('agences', 'vehicule.id_agence', '=','agences.id_agence')
            ->select('vehicule.*', 'agences.titre as agence_titre')
            ->get();

        return view('cars.index',['vehicule'=> $vehicule]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cars.index");
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
            'agences'=>'required',
            'title'=>'required',
            'brand'=>'required',
            'model'=>'required',
            'price'=>'required',
            'photo'=>'required',
            'description'=>'required'
        ]);

        // retourne la valeur des input du formulaire
        $agence = request('agences');
        $title = request('title');
        $brand = request('brand');
        $model = request('model');
        $descript = request('description');
        $photo = request('photo');
        $price = request('price');

        $image = $request->model . time() . '.'. $request->photo->extension();

        $pathImg = $request->photo->storeAs(
            'vehicule',
            $image,
            'public',
        );

        $cars = new Vehicule();
        $cars->id_agence = $agence;
        $cars->titre = $title;
        $cars->marque = $brand;
        $cars->modele = $model;
        $cars->description = $descript;
        $cars->photo = $pathImg;
        $cars->prix_journalier = $price;
        $cars->save();

        return redirect(route("cars.index"));
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicule $vehicule)
    {
  
        // return view("cars.index", compact("vehicule"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function edit( $vehicule)
    {
        $vehicule = Vehicule::find($vehicule);
        $idAgence = $vehicule->id_agence;
        $agence = Agences::find($idAgence);
        $agenceTitre = $agence->titre;
        
        return view("cars.edit", ['vehicule'=>$vehicule, 'agence'=>$agenceTitre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $vehicule)
    {
        
        // validation
        $rules = [
            'agences'=>'required',
            'title'=>'required',
            'brand'=>'required',
            'model'=>'required',
            'price'=>'required',
            'description'=>'required'
        ];

        $agence = request('agences');
        $title = request('title');
        $brand = request('brand');
        $model = request('model');
        $descript = request('description');
        // $photo = request('photo');
        $price = request('price');
        
        $currentVehicule  = Vehicule::find($vehicule);
        // si une nouvelle image est envoyée
        if ($request->has('photo')){

            $rules["photo"] = 'required';
        }

        $this->validate($request, $rules);

        if ($request->has('photo')){
            //  on supprime l'ancienne image
            Storage::delete($currentVehicule->photo);
            
            // on stock la nouvelle
            $image = $request->model . time() . '.'. $request->photo->extension();

            $pathImg = $request->photo->storeAs(
                'vehicule',
                $image,
                'public',
            );
            
        }

        // on met à jour les infos du tableau

        $currentVehicule->update([
            "id_agence"=>$agence,
            "titre" => $title,
            "marque" => $brand,
            "modele" => $model,
            "prix_journalier" => $price,
            "photo" => isset($pathImg) ? $pathImg : $currentVehicule->photo,
            "description" => $descript
        ]);

        // dd($currentVehicule);
        
        return redirect(route("cars.index", ['vehicule'=>$currentVehicule]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $vehicule
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicule)
    {
        $delete = Vehicule::find($vehicule);
        Storage::delete($delete->photo);
        $delete->delete();
        
        return redirect(route('cars.index'));
    }
}
