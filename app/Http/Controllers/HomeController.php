<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicule;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        
        $cars = DB::table('vehicule')
            ->join('agences', 'vehicule.id_agence', '=','agences.id_agence')
            ->select('vehicule.*', 'agences.titre as agence_titre')
            ->get();
        return view('frontO.index', ['cars'=>$cars]);
    }
}
