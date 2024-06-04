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
use App\Models\Categorie;

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
        $coureurs = DB::table('detailsetapecoureur')->where('idetape', $idEtape)->get();
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
            'heureArrivee' => 'required|date_format:Y-m-d\TH:i:s',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $heureDebut = DB::table('etape')->where('idetape', $request->input('idEtape'))->value('heuredebut');
        $heureDebut = new \DateTime($heureDebut);
        $heureArrivee = new \DateTime($request->input('heureArrivee'));

        $duree = $heureArrivee->diff($heureDebut)->format('%H:%I:%S');

        DB::table('resultatcoureur')->insert([
            'idcoureur' => $request->input('idCoureur'),
            'idetape' => $request->input('idEtape'),
            'heuredebut' => $heureDebut->format('Y-m-d H:i:s'),
            'heurefin' => $heureArrivee->format('Y-m-d H:i:s'),
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
    public function genererCategorie()
    {
        return view('html.genererCategorie');
    }

    public function genereCategorie()
    {
        // Récupérer tous les coureurs
        $coureurs = DB::table('coureur')->get();

        $now = new \DateTime();
        $adultAge = 18;

        foreach ($coureurs as $coureur) {
            $birthdate = new \DateTime($coureur->datenaissance);
            $age = $now->diff($birthdate)->y;

            $categoriesToInsert = [];

            if ($coureur->genre == 'M') {
                $categoriesToInsert[] = ['nomcategorie' => 'Homme'];
            } else if ($coureur->genre == 'F') {
                $categoriesToInsert[] = ['nomcategorie' => 'Femme'];
            }

            if ($age < $adultAge) {
                $categoriesToInsert[] = ['nomcategorie' => 'Junior'];
            }

            // Insérer les nouvelles catégories dans la table 'categorie'
            foreach ($categoriesToInsert as $category) {
                DB::table('categorie')->updateOrInsert($category);
            }

            // Insérer les relations dans la table 'categoriecoureur'
            foreach ($categoriesToInsert as $category) {
                // Récupérer l'id de la catégorie
                $categoryId = DB::table('categorie')->where('nomcategorie', $category['nomcategorie'])->value('idcategorie');

                // Vérifier si la relation existe déjà
                $existingRelation = DB::table('categoriecoureur')
                    ->where('idcoureur', $coureur->idcoureur)
                    ->where('idcategorie', $categoryId)
                    ->exists();

                // Si la relation n'existe pas, l'insérer
                if (!$existingRelation) {
                    DB::table('categoriecoureur')->insert([
                        'idcoureur' => $coureur->idcoureur,
                        'idcategorie' => $categoryId
                    ]);
                }
            }
        }

        return view('html.genererCategorie');
    }

    public function penalite()
    {
        $etapes = DB::table('etape')->get();
        $equipes = DB::table('equipe')->get();
        $penalites = DB::table('detailspenalite')->get();
        return view('html.penalite',['etapes'=>$etapes,'equipes' => $equipes,'penalites'=>$penalites]);
    }

    public function insertPenalite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idetape' => 'required|integer',
            'idequipe' => 'required|integer',
            'tempsPenalite' => 'required|date_format:H:i:s',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::table('penalite')->insert([
            'idetape' => $request->input('idetape'),
            'idequipe' => $request->input('idequipe'),
            'tempspenalite' => $request->input('tempsPenalite'),
        ]);

        $coureurs = DB::select("
        SELECT coureur.idcoureur 
        FROM etapecoureur
        JOIN coureur ON etapecoureur.idCoureur = coureur.idcoureur
        WHERE etapecoureur.idetape =?
        AND coureur.idequipe =?
        AND EXISTS (
            SELECT 1 FROM resultatcoureur
            JOIN coureur on coureur.idcoureur = resultatcoureur.idcoureur
            WHERE resultatcoureur.idcoureur = coureur.idcoureur
            AND resultatcoureur.idetape =?
        )", [
            $request->input('idetape'),
            $request->input('idequipe'),
            $request->input('idetape') 
        ]);

        // Pour chaque coureur, ajouter une nouvelle ligne dans ResultatCoureur avec la pénalité
        foreach ($coureurs as $coureur) {
        DB::table('resultatcoureur')->insert([
        'idcoureur' => $coureur->idcoureur,
        'idetape' => $request->input('idetape'),
        'heuredebut' => null,
        'heurefin' => null,
        'duree' => $request->input('tempsPenalite')
        ]);
        }   
        return redirect()->back();
    }
    
    public function supprimerPenalite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idpenalite' => 'required|integer',
            'idetape' => 'required|integer',
            'idequipe' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::table('penalite')->where('idpenalite', $request->input('idpenalite'))->delete();

        $coureurs = DB::select("
        SELECT coureur.idcoureur 
        FROM etapecoureur
        JOIN coureur ON etapecoureur.idCoureur = coureur.idcoureur
        WHERE etapecoureur.idetape =?
        AND coureur.idequipe =?
        AND EXISTS (
            SELECT 1 FROM resultatcoureur
            JOIN coureur on coureur.idcoureur = resultatcoureur.idcoureur
            WHERE resultatcoureur.idcoureur = coureur.idcoureur
            AND resultatcoureur.idetape =?
        )", [
            $request->input('idetape'),
            $request->input('idequipe'),
            $request->input('idetape') 
        ]);

        foreach ($coureurs as $coureur) {
            DB::table('resultatcoureur')
            ->where('idcoureur', $coureur->idcoureur)
            ->whereNull('heuredebut')
            ->whereNull('heurefin')
            ->delete();
        }   

        return redirect()->back();
        
    }
    
    public function showCertificat()
    {
        $idequipe = $_GET['idequipe'];       

        $classementGenerale = DB::table('viewclassementgeneral')->where('idequipe', $idequipe)->get();

        return view('html.pdfCertificat',['classementGenerale'=>$classementGenerale]);
    }

}
