<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'commande';
    protected $primaryKey = 'id_commande';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_commande',
        'id_membre',
        'id_vehicule',
        'id_agence',
        'date_heure_depart',
        'date_heure_fin',
        'prix_total',
        'date_enregistrement'
    ];
    
    public function agence(){

        return $this->belongsTo(Agences::class,'id_agence', 'id_commande');
    }
    public function vehicule(){
        
        return $this->belongsTo(Vehicule::class, 'id_vehicule', 'id_commande');
    }
}