<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Exceptions;
use App\metier\Frais;
use Illuminate\Support\Facades\Session;

class ServiceFrais
{

    public function getFrais($id_visiteur)
    {
        try {
            $lesFrais = DB::table('frais')
                ->select()
                ->where('frais.id_visiteur', '=', $id_visiteur)
                ->get();
            return $lesFrais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getFraisHorsForfait($id_frais)
    {
        try {
            $lesFrais = DB::table('fraishorsforfait')
                ->select()
                ->where('id_frais', '=', $id_frais)
                ->get();
            return $lesFrais;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function getMontantTotalFraisHorsForfait($id_frai)
    {
        try {
            $montantTotal = DB::table('fraishorsforfait')
                ->where('id_frais', '=', $id_frai)
                ->sum('montant_fraishorsforfait');
            return $montantTotal;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


    public function updateFrais($id_frais, $anneemois, $nbjustificatifs)
    {
        try {
            $dateJour = date("Y-m-d");
            DB::table('frais')
                ->where('id_frais', '=', $id_frais)
                ->update(['anneemois' => $anneemois,
                    'nbjustificatifs' => $nbjustificatifs,
                    'datemodification' => $dateJour]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function updateFraisHorsForfait($id_fraishorsforfait, $date_fraishorsforfait, $montant_fraishorsforfait, $lib_fraishorsforfait)
    {
        try {
            $dateJour = date("Y-m-d");
            DB::table('frais')
                ->where('id_fraishorsforfait', '=', $id_fraishorsforfait)
                ->update([
                    'date_fraishorsforfait' => $date_fraishorsforfait,
                    'montant_fraishorsforfait' => $montant_fraishorsforfait,
                    'lib_fraishorsforfait' => $lib_fraishorsforfait]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function getById($id_frais){
        try {
            $fraisById = DB::table('frais')
                ->select()
                ->where('id_frais', '=', $id_frais)
                ->first();

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
        return $fraisById;
    }

    public function getByIdFraisHorsForfait($id_fraisHorsForfait){
        try {
            $fraisById = DB::table('fraishorsforfait')
                ->select()
                ->where('id_fraisHorsForfait', '=', $id_fraisHorsForfait)
                ->first();

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
        return $fraisById;
    }

    public function insertFrais($anneemois, $nbjustificatifs, $id_visiteur, $montant)
    {
        try {
            $dateJour = date("Y-m-d");
            DB::table('frais')
                ->insert(['anneemois' => $anneemois,
                    'nbjustificatifs' => $nbjustificatifs,
                    'id_etat' => 2,
                    'id_visiteur' => $id_visiteur,
                    'montantvalide' => $montant]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function insertFraisHorsForfait($id_frais, $date_fraishorsforfait, $montant_fraishorsforfait, $lib_fraishorsforfait)
    {
        try {
            $dateJour = date("Y-m-d");
            DB::table('fraishorsforfait')
                ->insert([
                    'id_frais' => $id_frais,
                    'date_fraishorsforfait' => $date_fraishorsforfait,
                    'montant_fraishorsforfait' => $montant_fraishorsforfait,
                    'lib_fraishorsforfait' => $lib_fraishorsforfait]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function deleteFrais($id_frais){
        try {
            DB::table('fraishorsforfait')->where('id_frais', '=', $id_frais)->delete();
            DB::table('frais')->where('id_frais', '=', $id_frais)->delete();
        }catch (QueryException $e){
            throw new MonException($e->getMessage(), 5);
        }



}


}
