<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Equipe;
use App\Models\Etape;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

    

class EquipeController extends Controller
{
    public function affecterCoureur()
    {
        $idEtape = $_GET['idEtape'];       
        $nbrCoureur = $_GET['nbrCoureur'];       
        $idequipe = session('equipe')['idequipe'];
        $coureurs = DB::table('coureur')->where('idequipe', $idequipe)->get();
        return view('html.affecterCoureur', ['coureurs' => $coureurs, 'idEtape' => $idEtape, 'nbrCoureur' => $nbrCoureur]);
    }

    public function affectationCoureur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idCoureurs' => 'required', 
            'idEtape' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idCoureurs = $request->input('idCoureurs');
        $idEtape = $request->input('idEtape');

        

        // Filtrer les valeurs nulles
        $idCoureurs = array_filter($idCoureurs, function($idCoureur) {
            return !is_null($idCoureur);
        });

        // Récupérer le nombre maximum de coureurs autorisés pour cette étape
        $etape = DB::table('etape')->where('idetape', $idEtape)->first();
        $maxCoureurs = $etape->nbcoureur;

        $idEquipe = session('equipe')['idequipe'];

        // Récupérer le nombre actuel de coureurs affectés à cette étape pour cette equipe
        $currentCount = DB::select("
        SELECT COUNT(*) as count
        FROM etapecoureur
        JOIN coureur ON etapecoureur.idcoureur = coureur.idcoureur
        WHERE etapecoureur.idetape = :idEtape
        AND coureur.idequipe = :idEquipe
        ", ['idEtape' => $idEtape, 'idEquipe' => $idEquipe]);

        $currentCount = $currentCount[0]->count;

        // Vérifier si l'ajout des nouveaux coureurs dépasse la limite
        if ($currentCount + count($idCoureurs) > $maxCoureurs) {
            return redirect()->back()->withErrors([
                'idCoureurs' => 'Le nombre total de coureurs pour cette étape dépasse la limite autorisée.'
            ])->withInput();
        }
        // pour avoir les doublons
        $existingCoureurs = DB::table('etapecoureur')
        ->join('coureur', 'etapecoureur.idcoureur', '=', 'coureur.idcoureur')
        ->where('etapecoureur.idetape', $idEtape)
        ->whereIn('etapecoureur.idcoureur', $idCoureurs)
        ->where('coureur.idequipe', $idEquipe)
        ->pluck('etapecoureur.idcoureur')
        ->toArray();
//pluck('etapecoureur.idcoureur') :

// Récupère les valeurs de la colonne idcoureur des lignes filtrées.
        if (!empty($existingCoureurs)) {
            return redirect()->back()->withErrors([
                'idCoureurs' => 'Ce coureur est déjà affecté à cette étape pour cette équipe.'
            ])->withInput();
        }
        foreach ($idCoureurs as $idCoureur) {
            DB::table('etapecoureur')->insert([
                'idetape' => $idEtape,
                'idcoureur' => $idCoureur,
            ]);
        }

        return redirect()->route('indexEquipe');  
    }

    
}
