<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'vehicule';
    protected $primaryKey = 'id_vehicule';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_vehicule',
        'id_agence',
        'titre',
        'marque',
        'modele',
        'description',
        'photo',
        'prix_journalier'
    ];
    public function agence()
    {
        return $this->belongsTo(Agences::class, 'id_agence', 'id_vehicule');
    }
}
