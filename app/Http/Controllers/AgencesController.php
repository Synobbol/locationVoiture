<?php

namespace App\Http\Controllers;

use App\Models\Agences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agences = Agences::all();

        return view("agences.index",['agences'=> $agences]);
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
            'title'=>'required',
            'adress'=>'required',
            'city'=>'required',
            'cp'=>'required',
            'description'=>'required',
            'photo'=>'required',
        ]);

        $title = request('title');
        $adress = request('adress');
        $city = request('city');
        $cp = request('cp');
        $descript = request('description');
        $photo = request('photo');

        $image = $request->city . time() . '.'. $request->photo->extension();

        $pathImg = $request->photo->storeAs(
            'agences',
            $image,
            'public',
        );

        $agence = new Agences();
        $agence->titre = $title;
        $agence->adresse = $adress;
        $agence->ville = $city;
        $agence->cp = $cp;
        $agence->description = $descript;
        $agence->photo = $pathImg;
        
        $agence->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agences  $agences
     * @return \Illuminate\Http\Response
     */
    public function show(Agences $agences)
    {
        $agences = Agences::all();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    $agences
     * @return \Illuminate\Http\Response
     */
    public function edit( $agences)
    {
        $agences = Agences::find($agences);
        
        return view("agences.edit", compact("agences"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param    $agences
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $agences)
    {
        
        // validation
        $rules = [
            'title'=>'required',
            'adress'=>'required',
            'city'=>'required',
            'cp'=>'required',
            'description'=>'required'
        ];

        $title = request('title');
        $adress = request('adress');
        $city = request('city');
        $cp = request('cp');
        $descript = request('description');
        // $photo = request('photo');
        
        $currentAgence = Agences::find($agences);
        
        // si une nouvelle image est envoyée
        if ($request->has('photo')){

            $rules["photo"] = 'required';
            
        }

        $this->validate($request, $rules);
        
        if ($request->has('photo')){
            //  on supprime l'ancienne image
            Storage::delete($currentAgence->photo);
            
            //on stock la nouvelle image
            
            $image = $request->city . time() . '.'. $request->photo->extension();

            $pathImg = $request->photo->storeAs(
                'agences',
                $image,
                'public',
            );

        }
        
        // on met à jour les infos du tableau
        $currentAgence->update([
            "titre"=>$title,
            "adresse"=>$adress,
            "ville"=>$city,
            "cp" => $cp,
            "photo" => isset($pathImg) ? $pathImg : $currentAgence->photo,
            "description" => $descript
        ]);
        
        
        return redirect(route("agences.index",['agences'=> $currentAgence]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $agences
     * @return \Illuminate\Http\Response
     */
    public function destroy($agences)
    {
        $delete = Agences::find($agences);
        Storage::delete($delete->photo);
        $delete->delete();

        return redirect(route('agences.index'));
    }
}
