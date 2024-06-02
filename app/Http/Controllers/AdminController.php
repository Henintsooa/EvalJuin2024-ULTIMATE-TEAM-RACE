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
use App\Models\Coureur;

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

    public function affecterTemps()
    {
        $idEtape = $_GET['idEtape'];       
        
        $idequipe = session('equipe')['idequipe'];
        $coureurs = DB::table('viewetapecoureur')->where('idetape', $idEtape)->get();
        return view('html.affecterTemps', ['coureurs' => $coureurs, 'idEtape' => $idEtape]);
    }

    public function affectationTemps(Request $request)
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

        if ($heureArrivee < $heureDepart) {
            // Calculate duration from heureDepart to midnight
            $midnight = (clone $heureDepart)->setTime(23, 59, 59);
            $intervalToMidnight = $heureDepart->diff($midnight);

            // Calculate duration from midnight to heureArrivee
            $midnightStart = (clone $heureArrivee)->setTime(0, 0, 0);
            $intervalFromMidnight = $midnightStart->diff($heureArrivee);

            // Combine the intervals
            $totalSeconds = ($intervalToMidnight->h * 3600 + $intervalToMidnight->i * 60 + $intervalToMidnight->s + 1) +
                            ($intervalFromMidnight->h * 3600 + $intervalFromMidnight->i * 60 + $intervalFromMidnight->s);

            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            $duree = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            $interval = $heureDepart->diff($heureArrivee);
            $duree = $interval->format('%H:%I:%S');
        }

        DB::table('resultatcoureur')->insert([
            'idcoureur' => $request->input('idCoureur'),
            'idetape' => $request->input('idEtape'),
            'heuredebut' => $request->input('heureDepart'),
            'heurefin' => $request->input('heureArrivee'),
            'duree' => $duree,
        ]);

        return redirect()->back()->with('success', 'Le temps du coureur a été affecté avec succès.');
    }

    public function insertEtape(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomEtape' => 'required|string|max:255',
            'rang' => 'required|integer',
            'longueur' => 'required|numeric',
            'nbCoureur' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('etape')->insert([
            'nometape' => $request->input('nomEtape'),
            'rang' => $request->input('rang'),
            'longueur' => $request->input('longueur'),
            'nbcoureur' => $request->input('nbCoureur'),
        ]);

        // Renvoyer un message de succès
        return redirect()->back();
    }
    public function coureur()
    {
        $equipes = DB::table('equipe')->get();
        return view('html.coureur', ['equipes' => $equipes]);
    }   
    
    public function insertCoureur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomCoureur' => 'required|string|max:255',
            'numero' => 'required|integer',
            'genre' => 'required|in:M,F',
            'dateNaissance' => 'required|date',
            'idequipe' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idCoureur = DB::table('coureur')->insertGetId([
            'nomcoureur' => $request->input('nomCoureur'),
            'numero' => $request->input('numero'),
            'genre' => $request->input('genre'),
            'datenaissance' => $request->input('dateNaissance'),
            'idequipe' => $request->input('idequipe'),
        ], 'idcoureur');

        $categories = [];
        
        if ($request->input('genre') == 'F') {
            $categories[] = 'Femme';
        } else {
            $categories[] = 'Homme';
        }

        $dateNaissance = new \DateTime($request->input('dateNaissance'));
        $anneeNaissance = $dateNaissance->format('Y');
        if ($anneeNaissance <= 2005) {
            $categories[] = 'Senior';
        } else {
            $categories[] = 'Junior';
        }

        foreach ($categories as $categorie) {
            $categorieId = DB::table('categorie')->where('nomcategorie', $categorie)->value('idcategorie');
            
            DB::table('categoriecoureur')->insert([
                'idcoureur' => $idCoureur,
                'idcategorie' => $categorieId,
            ]);
        }

        
        return redirect()->back();
    }
}
