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
use App\Models\ViewClassementGeneraleCoureur;
use App\Models\ViewClassementGenerale;
use App\Models\ViewPointsCoureurEtape;
use App\Models\ViewEtapeCoureur;
use App\Models\ViewClassementEquipeCategorie;
use App\Models\ViewClassementGeneralEquipe;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

    

class HomeController extends Controller
{
    // public function index()
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login'); 
    //     }
            
    //         return view('html.index'); 
    // }

    public function admin()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $coureurs = DB::table('coureur')->get();
        $etapes = DB::table('etape')->orderBy('rang', 'asc')->get();
        return view('html.adminIndex',['etapes'=>$etapes,'coureurs'=>$coureurs]); 
    }

    public function user()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        
        return view('html.index'); 
    }

    public function loginEquipe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'equipe' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('equipe')) {
                return redirect()->back()->withErrors([
                    'identifiant' => "L'identifant de l'équipe doit etre renseigné"
                ])->withInput();
            } else if ($errors->has('password')) {
                return redirect()->back()->withErrors([
                    'mdp' => "Le mot de passe doit étre renseigné"
                ])->withInput();
            }
        }
    
        $equipe = Equipe::where([
            ['identifiant', $request->equipe],
            ['password', $request->password]
        ])->first();
        if (!$equipe) {
            $equipeExists = Equipe::where('identifiant', $request->equipe)->exists();
            if ($equipeExists) {
                return redirect()->back()->withErrors([
                    'mdp' => "Le mot de passe est incorrect"
                ])->withInput();
            } else {
                return redirect()->back()->withErrors([
                    'identifiant' => "L'identifiant de l'équipe est incorrect"
                ])->withInput();
            }
        }
        Session::put('equipe', $equipe);
        return redirect()->route('indexEquipe');  

    }
    public function indexEquipe()
    {
        $nomequipe = session('equipe')['nomequipe'];
        $etapes = DB::table('etape')->orderBy('rang', 'asc')->get();
        $equipecoureurs=DB::table('viewetapecoureur')->where('idequipe',session('equipe')['idequipe'])->orderBy('rang', 'asc')->get();
        $chronocoureurs=DB::table('viewresultatcoureur')->where('idequipe',session('equipe')['idequipe'])->get();
        // Organiser les chronos par étape
        $chronosParEtape = [];
        foreach ($chronocoureurs as $chronocoureur) {
            $chronosParEtape[$chronocoureur->idetape][] = $chronocoureur;
        }
        return view('html.index',['etapes'=>$etapes,'equipecoureurs'=>$equipecoureurs,'nomequipe'=>$nomequipe,'chronosParEtape'=>$chronosParEtape]);   
    }

    public function classement()
    {
        if (!Auth::check() && !$idequipe = session('equipe')['idequipe']) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter en tant qu\'administrateur ou comme un client pour accéder à cette page.');
        }
        $classementGeneraleEquipes = ViewClassementGeneralEquipe::all();
        $classementGeneraleCoureurs = ViewClassementGeneraleCoureur::all();
        $classementGeneraleEtapes = DB::table('viewpointscoureuretape')->orderBy('rangetape')->orderBy('classement')->get();
        $classementParEtape = $classementGeneraleEtapes->groupBy('rangetape');
        return view('html.classement', ['classementGeneraleCoureurs' => $classementGeneraleCoureurs,'classementGeneraleEquipes' => $classementGeneraleEquipes,'classementGeneraleEtapes' => $classementGeneraleEtapes]);
    }
    public function classementEquipe()
    {
        if (!Auth::check() && !$idequipe = session('equipe')['idequipe']) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter en tant qu\'administrateur ou comme un client pour accéder à cette page.');
        }
        $categorie= DB::table('categorie')->first();
        if (request()->input('nomcategorie')) {
            $classementGeneraleCategories = DB::table('viewclassementequipecategorie')->where('nomcategorie',request()->input('nomcategorie'))->get();
        }else{
            $classementGeneraleCategories = DB::table('viewclassementequipecategorie')->where('nomcategorie',$categorie->nomcategorie)->get();
        }
        $classementGenerales = ViewClassementGenerale::all();
        $categories = DB::table('categorie')->get();
        return view('html.classementEquipe', ['classementGenerales' => $classementGenerales,'classementGeneraleCategories' => $classementGeneraleCategories,'categories' => $categories]);
    }
    public function reset()
    {
        // Désactiver temporairement les triggers (qui incluent les vérifications de clé étrangère) pour PostgreSQL
        $tables = DB::select('SELECT tablename FROM pg_tables WHERE schemaname = ?', ['public']);

        foreach ($tables as $table) {
            if ($table->tablename == 'users') {
                continue;
            }

            // Désactiver les triggers (contraintes) avant de tronquer la table
            DB::statement('ALTER TABLE ' . $table->tablename . ' DISABLE TRIGGER ALL');
            DB::table($table->tablename)->truncate();
            // Réactiver les triggers (contraintes) après avoir tronqué la table
            DB::statement('ALTER TABLE ' . $table->tablename . ' ENABLE TRIGGER ALL');
        }

        return redirect()->back()->with('success', 'La base de données a été réinitialisée avec succès.');
    }

}
