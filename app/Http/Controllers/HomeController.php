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
use App\Models\ViewClassementGenerale;
use App\Models\ViewClassementGeneraleEtape;

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
        $etapes = DB::table('etape')->orderBy('rang', 'asc')->get();
        return view('html.index',['etapes'=>$etapes]);   
    }

    public function classement()
    {
        if (!Auth::check() && !$idequipe = session('equipe')['idequipe']) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter en tant qu\'administrateur ou comme un client pour accéder à cette page.');
        }
        $classementGenerales = ViewClassementGenerale::all();
        $classementGeneraleEtapes = ViewClassementGeneraleEtape::all();
        return view('html.classement', ['classementGenerales' => $classementGenerales, 'classementGeneraleEtapes' => $classementGeneraleEtapes]);
    }

    public function reset()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = DB::select('SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = ? AND table_type = "BASE TABLE"', [env('DB_DATABASE')]);
        foreach ($tables as $table) {
            if ($table->TABLE_NAME == 'users') {
                continue;
            }
            DB::table($table->TABLE_NAME)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect()->back()->with('success', 'La base de données a été réinitialisée avec succès.');
    }
}
