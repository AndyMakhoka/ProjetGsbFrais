<?php

namespace App\metier;
use Illuminate\Database\Eloquent\Model;
use DB;

class Frais
{

    protected $table = 'frais';
    public $timestamps = false;
    private $id_frais;
    protected $fillable = [
        'id_frais',
        'id_etat',
        'anneemois',
        'id_visiteur',
        'nbjustification',
        'datemodifiaction',
        'montant_valide',
    ];

    public function __construct(){
        $this->id_frais;
    }
    public function getBtId(){

}

}
