<?php

namespace App\Http\Controllers;

use MongoDB\Driver\Exception\Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\metier\Visiteur;
use App\dao\ServiceFrais;

use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;

class VisiteurController extends Controller
{

    public function getLogin()
    {
        $erreur = "";
        try {
            $erreur = "";
            return view('Vues/formLogin', compact('erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        } catch (\Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));

        }
    }

    public function signIn(){
        $erreur = "";
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                $erreur = "";
                if (Session::get('type') === 'p') {
                    return view('Vues/homePraticien',  compact('erreur'));
                } else {
                    return view('home',   compact('erreur'));
                }
            } else {
                $erreur = "login ou mot de passe inconnu";
                return view('Vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        }
    }

    public function signOut(){
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }

}
