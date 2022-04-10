<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membres extends Model
{
    use HasFactory;
        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'membre';
    protected $primaryKey = 'id_membre';
    /**
    
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_membre',
        'pseudo',
        'mdp',
        'nom',
        'prenom',
        'email',
        'civilite',
        'statut',
        'date_enregistrement'
    ];
}