<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Payer;
use Illuminate\Http\Request;

class Showmembre extends Controller
{


    public function prix($id){
        $membre = Membre::where('membre_id', $id)->get();
        $payers = Payer::where('membre_id', $id)->orderby('payer_id', 'desc')->first();

        if ($payers) {
            $payers = $payers->get();
        }

        return view('Membres.show', [
            "membres" => $membre,
            "payers" => $payers,
        ]);
    }

}
