<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ServiceVisiteur
{
public function login($login, $pwd){
    $connected = false;
    try {
        $visiteur = DB::table('visiteur')
            ->select()
            ->where('login_visiteur', '=', $login)
            ->first();
        if ($visiteur)
            if ($visiteur->pwd_visiteur == $pwd) {
                Session::put('id', $visiteur->id_visiteur);
                Session::put('type', $visiteur->type_visiteur);
                $connected = true;
            }
    } catch (QueryException $e) {
        throw new MonException($e->getMessage(), 5);
    }
    return $connected;
}

public function logout(){
    Session::put('id', 0);
    return view('home');

}
}
