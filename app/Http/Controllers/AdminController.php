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

    

class AdminController extends Controller
{
    public function getCoureursByEtape(Request $request)
    {
        $idEtape = $request->input('idEtape');
        $coureurs = DB::select('
        SELECT coureur.idcoureur, coureur.nomcoureur
        FROM etapecoureur
        JOIN coureur ON etapecoureur.idcoureur = coureur.idcoureur
        WHERE etapecoureur.idetape = ?
        ', [$idEtape]);

        return response()->json($coureurs);
    }

    public function affecterTemps(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $validator = Validator::make($request->all(), [
            'idCoureur' => 'required|exists:coureur,idcoureur',
            'idEtape' => 'required|exists:etape,idetape',
            'heureDepart' => 'required|date_format:H:i:s',
            'heureArrivee' => 'required|date_format:H:i:s',
            'lendemain' => 'nullable|boolean'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Calculate the duration between heureDepart and heureArrivee
        $heureDepart = new \DateTime($request->input('heureDepart'));
        $heureArrivee = new \DateTime($request->input('heureArrivee'));
    
        $dureeSeconds = 0;

        if ($heureArrivee < $heureDepart) {
            // Calculate seconds from heureDepart to midnight (24:00:00)
            $midnight = (clone $heureDepart)->setTime(24, 0, 0);
            $dureeSeconds = $midnight->getTimestamp() - $heureDepart->getTimestamp();
            
            // Add seconds from midnight to heureArrivee
            $dureeSeconds += $heureArrivee->getTimestamp() - (clone $heureArrivee)->setTime(0, 0, 0)->getTimestamp();
        } else {
            $dureeSeconds = $heureArrivee->getTimestamp() - $heureDepart->getTimestamp();
        }

        DB::table('resultatcoureur')->insert([
            'idcoureur' => $request->input('idCoureur'),
            'idetape' => $request->input('idEtape'),
            'heuredebut' => $request->input('heureDepart'),
            'heurefin' => $request->input('heureArrivee'),
            'duree' => $dureeSeconds,
            'lendemain' => $request->input('lendemain') ? 1 : 0            
        ]);
    
        return redirect()->back()->with('success', 'Le temps du coureur a été affecté avec succès.');
    }
    
    
}
