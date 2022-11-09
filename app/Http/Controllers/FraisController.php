<?php

namespace App\Http\Controllers;

use App\dao\ServiceFrais;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\metier\Frais;
use App\Exceptions;
use App\Exceptions\MonException;
use function MongoDB\BSON\toRelaxedExtendedJSON;

class FraisController extends Controller
{

    public function getFraisVisiteur()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceFrais = new ServiceFrais();
            $id_visiteur = Session::get('id');
            $mesFrais = $unServiceFrais->getFrais($id_visiteur);
            return view('Vues/listeFrais', compact('mesFrais', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }

    public function getFraisVisiteurHorsForfait($id_frais)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceFrais = new ServiceFrais();
            $id_visiteur = Session::get('id');
            $mesFrais = $unServiceFrais->getFraisHorsForfait($id_frais);
            $montantTotal = $unServiceFrais->getMontantTotalFraisHorsForfait($id_frais);
            return view('Vues/listeFraisHorsForfait', compact('mesFrais', 'montantTotal', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }

    public function updateFrais($id_frais)
    {
        try {
            $monErreur = "";
            $erreur = "";
            $unServiceFrais = new ServiceFrais;
            $unFrais = $unServiceFrais->getById($id_frais);
            $titrevue = "Modification d'une fiche de Frais";
            return view('Vues/formFrais', compact('unFrais', 'titrevue', 'erreur'));

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }

    public function updateFraisHorsForfait($id_fraisfraishorsforfait)
    {
        try {
            $monErreur = "";
            $erreur = "";
            $unServiceFrais = new ServiceFrais;
            $unFrais = $unServiceFrais->getByIdFraisHorsForfait($id_fraisfraishorsforfait);
            $titrevue = "Modification d'une fiche de frais hors Forfait";
            return view('Vues/formFraisHorsForfait', compact('unFrais', 'titrevue', 'erreur'));

        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }

    public function validateFrais()
    {
        try {
            $erreur = "";

            $id_frais = Request::input('id_frais');
            $anneemois = Request::input('anneemois');
            $nbjustificatifs = Request::input('nbjustificatifs');
            $unServiceFrais = new ServiceFrais();
            if ($id_frais > 0) {
                $unServiceFrais->updateFrais($id_frais, $anneemois, $nbjustificatifs);
            } else {
                $montant = Request::input('montant');
                $id_visiteur = Session::get('id');
                $unServiceFrais->insertFrais($anneemois, $nbjustificatifs, $id_visiteur, $montant);
            }
            return redirect('/getListeFrais');
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }

    public function validateFraisHorsForfait()
    {
        try {
            $erreur = "";
            //$id_frais = Session::get('id_frais');
            $id_frais = 1;
            $id_fraishorsforfait = Request::input('id_fraishorsforfait');
            //$id_frais = Request::input('id_frais');
            $lib_fraishorsforfait = Request::input('lib_fraishorsforfait');
            $date_fraishorsforfait = Request::input('date_fraishorsforfait');
            $montant_fraishorsforfait = Request::input('montant_fraishorsforfait');

            $unServiceFrais = new ServiceFrais();
            if ($id_fraishorsforfait > 0) {
                $unServiceFrais->updateFraisHorsForfait($id_frais, $date_fraishorsforfait, $montant_fraishorsforfait, $lib_fraishorsforfait);
            } else {
                $montant = Request::input('montant');
                $id_visiteur = Session::get('id');
                $unServiceFrais->insertFraisHorsForfait($id_frais, $date_fraishorsforfait, $montant_fraishorsforfait, $lib_fraishorsforfait);
            }

            $montant_fraishorsforfait = Request::input('montant_fraishorsforfait');

            $mesFrais = $unServiceFrais->getFraisHorsForfait($id_frais);
            return view('Vues/listeFraisHorsForfait', compact('mesFrais', 'montant_fraishorsforfait'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }

    public function addFrais()
    {
        try {
            $erreur = "";
            $titrevue = "Ajout d'une fiche de Frais";
            $id_visiteur = Session::get('id');
            $unServiceFrais = new ServiceFrais;
            $mesFrais = $unServiceFrais->getFrais($id_visiteur);
            return view('Vues/formAjoutFrais', compact('mesFrais', 'titrevue', 'erreur', 'id_visiteur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }

    public function addFraisHorsForfait($id_frais)
    {
        try {
            $erreur = "";
            $titrevue = "Ajout d'une fiche de Frais";
            $id_visiteur = Session::get('id');

            $unServiceFrais = new ServiceFrais;
            $mesFrais = $unServiceFrais->getFraisHorsForfait($id_frais);
            return view('Vues/formFraisHorsForfait', compact('mesFrais', 'titrevue', 'erreur', 'id_visiteur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }


    public function supprimeFrais($id_frais)
    {
        try {
            $erreur = "";
            $unServiceFrais = new ServiceFrais();
            $unServiceFrais->deleteFrais($id_frais);
            $id_visiteur = Session::get('id');
            $unServiceFrais = new ServiceFrais;
            $mesFrais = $unServiceFrais->getFrais($id_visiteur);
            return view('Vues/listeFrais', compact('mesFrais', 'erreur', 'id_visiteur'));
            //return redirect('/getListeFrais', compact('erreur'));
        } catch (MonException $e) {
            $id_visiteur = Session::get('id');
            $unServiceFrais = new ServiceFrais;
            $mesFrais = $unServiceFrais->getFrais($id_visiteur);
            $erreur = "Impossible de supprimer une fiche ayant des Frais Hors Forfait !";

            return view('Vues/listeFrais', compact('mesFrais', 'erreur', 'id_visiteur'));
        } catch (Exception $e) {
            //$erreur = $e->getMessage();
            Session::put('erreur', 'Impossible de supprimer une fiche ayant des Frais Hors Forfait !');
            //return view('Vues/error', compact('erreur'));
            $id_visiteur = Session::get('id');
            $unServiceFrais = new ServiceFrais;
            $mesFrais = $unServiceFrais->getFrais($id_visiteur);
            return view('Vues/listeFrais', compact('mesFrais', 'erreur', 'id_visiteur'));


        }
    }

    public function __construct(){
        $this->id_frais = 0;
    }
}

