<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Client;
use App\Models\PrixMaison;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;    
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ImportController extends Controller
{
    public function importDonnee()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $user = Auth::user();
        
        return view('html.importDonnee', ['user' => $user]);  
    }

    public function importCsv()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $user = Auth::user();
        
        $file = request()->file('etapesFile');
        $fileContents = file($file->getPathname());
        $row = 0;
        foreach ($fileContents as $line) {
            $row++;
    
            // Si c'est la première ligne, sautez-la
            if ($row == 1) {
                continue;
            } 
            
            $data = str_getcsv($line);
            $data[1] = str_ireplace(',', '.', $data[1]);
            if ($data[1] < 0) {
                // Retourne une erreur ou arrête le processus
                return redirect()->back()->withErrors(['montant' => 'il y a une longueur négative']);
            }
            $formatdDateDepart = Carbon::createFromFormat('d/m/Y H:i:s', $data[4] . ' ' . $data[5])->format('Y-m-d H:i:s');
            // Insérer dans la base de données
            DB::table('importetape')->insert([
                'etape' => $data[0],
                'longueur' => $data[1],
                'nbcoureur' => $data[2],
                'rang' => $data[3],
                'datedepart' => $formatdDateDepart,
                
            ]);
        }
        DB::statement('INSERT INTO etape (nometape,longueur,nbcoureur,rang,heuredebut)
        SELECT DISTINCT im.etape,im.longueur,im.nbcoureur,im.rang,im.datedepart
        FROM importetape im
        WHERE (im.etape,im.longueur,im.nbcoureur,im.rang,im.datedepart) NOT IN (SELECT nometape,longueur,nbcoureur,rang,heuredebut FROM etape)');
        
        $file = request()->file('resultatFile');
        $fileContents = file($file->getPathname());
        $row = 0;
        foreach ($fileContents as $line) {
            $row++;
    
            // Si c'est la première ligne, sautez-la
            if ($row == 1) {
                continue;
            } 
            
            $data = str_getcsv($line);
            
            $formatdDateNaissance = Carbon::createFromFormat('d/m/Y', $data[4])->format('Y-m-d');
            $formatdDateArrivee = Carbon::createFromFormat('d/m/Y H:i:s', $data[6])->format('Y-m-d H:i:s');
            // Insérer dans la base de données
            DB::table('importresultat')->insert([
                'etaperang' => $data[0],
                'numerodossar' => $data[1],
                'nom' => $data[2],
                'genre' => $data[3],
                'datenaissance' => $formatdDateNaissance,
                'equipe' => $data[5],
                'arrivee' => $formatdDateArrivee,
                
            ]);
        }
        DB::statement('INSERT INTO equipe (identifiant,nomequipe,password)
        SELECT DISTINCT im.equipe,im.equipe,im.equipe
        FROM importresultat im
        WHERE (im.equipe,im.equipe,im.equipe) NOT IN (SELECT identifiant,nomequipe,password FROM equipe)');
        
        DB::statement('INSERT INTO coureur (nomcoureur,numero,genre,datenaissance,idequipe)
        SELECT DISTINCT im.nom,im.numerodossar,im.genre,im.datenaissance,e.idequipe
        FROM importresultat im
        INNER JOIN equipe e on e.nomequipe = im.equipe
        WHERE (im.nom,im.numerodossar,im.genre,im.datenaissance,e.idequipe) NOT IN (SELECT nomcoureur,numero,genre,datenaissance,idequipe FROM coureur)');
        
        DB::statement('INSERT INTO etapecoureur (idetape,idcoureur)
        SELECT DISTINCT et.idetape,c.idcoureur
        FROM importresultat im
        INNER JOIN coureur c ON c.nomcoureur = im.nom
        INNER JOIN etape et ON et.rang = im.etaperang
        WHERE (et.idetape,c.idcoureur) NOT IN (SELECT idetape, idcoureur FROM etapecoureur)');

        DB::statement('INSERT INTO resultatcoureur (idcoureur,idetape,heuredebut,heurefin,duree)
        SELECT DISTINCT c.idcoureur,et.idetape,et.heuredebut,im.arrivee,(im.arrivee-heuredebut)::time
        FROM importresultat im
        INNER JOIN coureur c ON c.nomcoureur = im.nom
        INNER JOIN etape et ON et.rang = im.etaperang
        WHERE (c.idcoureur,et.idetape,et.heuredebut,im.arrivee,(im.arrivee-heuredebut)::time) NOT IN (SELECT idcoureur,idetape,heuredebut,heurefin,duree FROM resultatcoureur)');

        return view('html.importDonnee');  
    }
    

    public function importPoints()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $user = Auth::user();
        
        $file = request()->file('pointsFile');
        $fileContents = file($file->getPathname());
        $row = 0;
        foreach ($fileContents as $line) {
            $row++;
    
            // Si c'est la première ligne, sautez-la
            if ($row == 1) {
                continue;
            } 
            
            $data = str_getcsv($line);
    
            // Insérer dans la base de données
            DB::table('importpoint')->insert([
                'classement' => $data[0],
                'points' => $data[1],
            ]);
        }
        DB::statement('INSERT INTO points (rang,points)
        SELECT DISTINCT im.classement,im.points
        FROM importpoint im
        WHERE (im.classement,im.points) NOT IN (SELECT rang,points FROM points)');

        return view('html.importDonnee');  
    }


    // public function importCsv()
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login'); 
    //     }
    //     $user = Auth::user();
        
    //     $file = request()->file('maisonTravauxFile');
    //     $fileContents = file($file->getPathname());
    //     // dd($fileContents);
    //     $row = 0;
    //     foreach ($fileContents as $line) {
    //         $row++;
    
    //         // Si c'est la première ligne, sautez-la
    //         if ($row == 1) {
    //             continue;
    //         } 
            
    //         $data = str_getcsv($line);
    
    //         if ($data[6] < 0) {
    //             // Retourne une erreur ou arrête le processus
    //             return redirect()->back()->withErrors(['prix' => 'il y a un prix négative']);
    //         }
    //         // $data[1] = str_ireplace(',', '.', $data[1]);
    //         $data[2] = str_ireplace(',', '.', $data[2]);
    //         $data[5] = str_ireplace(',', '.', $data[5]);
    //         $data[6] = str_ireplace(',', '.', $data[6]);
    //         $data[7] = str_ireplace(',', '.', $data[7]);
    //         // dd($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);
    //         // Insérer dans la base de données
    //         DB::table('importMaisonTravaux')->insert([
    //             'typeMaison' => $data[0],
    //             'description' => $data[1],
    //             'surface' => $data[2],
    //             'codeTravaux' => $data[3],
    //             'typeTravaux' => $data[4],
    //             'unite' => $data[5],
    //             'prixUnitaire' => $data[6],
    //             'quantite' => $data[7],
    //             'dureeTravaux' => $data[8],
    //         ]);
    //         // dd($data[0], $description, $data[2], $data[3], $data[4], $data[5], $prixUnitaire, $data[7], $data[8]);
    //     }
        
    //     DB::statement('INSERT INTO typeMaison (nomMaison,duree)
    //     SELECT DISTINCT im.typeMaison, im.dureeTravaux
    //     FROM importMaisonTravaux im
    //     WHERE (im.typeMaison, im.dureeTravaux) NOT IN (SELECT nomMaison,duree FROM typeMaison)');
        
    //     DB::statement('INSERT INTO maison (idTypeMaison,description,surface)
    //     SELECT DISTINCT t.idTypeMaison,im.description,im.surface
    //     FROM importMaisonTravaux im 
    //     LEFT JOIN typeMaison t on t.nomMaison = im.typeMaison
    //     WHERE (t.idTypeMaison,im.description,im.surface) NOT IN (SELECT idTypeMaison,description,surface FROM maison)');

    //     DB::statement('INSERT INTO travaux (designation,numero,pu,unite)
    //     SELECT DISTINCT im.typeTravaux, im.codeTravaux,im.prixUnitaire,im.unite
    //     FROM importMaisonTravaux im
    //     WHERE (im.typeTravaux, im.codeTravaux,im.prixUnitaire,im.unite) NOT IN (SELECT designation,numero,pu,unite FROM travaux)');

    //     DB::statement('INSERT INTO devis (idTypeMaison)
    //     SELECT DISTINCT t.idTypeMaison
    //     FROM importMaisonTravaux im
    //     INNER JOIN typeMaison t on t.nomMaison = im.typeMaison
    //     WHERE (im.typeMaison) NOT IN (SELECT idTypeMaison FROM devis)');

    //     DB::statement('INSERT INTO devisDetails (idDevis,idTravaux,quantite,pu,prixTotal)
    //     SELECT distinct d.idDevis,t.idTravaux,im.quantite,im.prixUnitaire,im.prixUnitaire*im.quantite
    //     FROM importMaisonTravaux im
    //     INNER JOIN travaux t ON t.numero = im.codeTravaux
    //     INNER JOIN typeMaison tm ON tm.nomMaison = im.typeMaison
    //     INNER JOIN devis d ON d.idTypeMaison = tm.idTypeMaison
    //     WHERE (d.idDevis,t.idTravaux,im.quantite,im.prixUnitaire,im.prixUnitaire*im.quantite) NOT IN (
    //         SELECT idDevis,idTravaux,quantite,pu,prixTotal FROM devisDetails
    //     )');

    //     return view('html.importDonnee');  
    // }

    // public function importDevis()
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login'); 
    //     }
    //     $user = Auth::user();
        
    //     $file = request()->file('devisFile');
    //     $fileContents = file($file->getPathname());
    //     // dd($fileContents);
    //     $row = 0;
    //     foreach ($fileContents as $line) {
    //         $row++;

    //         // Si c'est la première ligne, sautez-la
    //         if ($row == 1) {
    //             continue;
    //         } 
            
    //         $data = str_getcsv($line);

    //         if ($data[4] < 0) {
    //             // Retourne une erreur ou arrête le processus
    //             return redirect()->back()->withErrors(['pourcentage' => 'il y a un pourcentage négative']);
    //         }
    //         $data[4] = str_ireplace(',', '.', $data[4]);
    //         $data[4] = str_replace('%', '', $data[4]);

    //         $formatdDateDevis = Carbon::createFromFormat('d/m/Y', $data[5])->format('Y-m-d');
    //         $formatdDateDebut = Carbon::createFromFormat('d/m/Y', $data[6])->format('Y-m-d');

    //         // Insérer dans la base de données
    //         DB::table('importDevis')->insert([
    //             'client' => $data[0],
    //             'refDevis' => $data[1],
    //             'typeMaison' => $data[2],
    //             'finition' => $data[3],
    //             'tauxFinition' => $data[4],
    //             'dateDevis' =>$formatdDateDevis,
    //             'dateDebut' =>$formatdDateDebut,
    //             'lieu' => $data[7],
    //         ]);
    //     }
    //     DB::statement('INSERT INTO client (numero)
    //     SELECT DISTINCT im.client
    //     FROM importDevis im
    //     WHERE (im.client) NOT IN (SELECT numero FROM client)');
        
    //     DB::statement('INSERT INTO finition (nomFinition,pourcentage)
    //     SELECT DISTINCT im.finition,im.tauxFinition
    //     FROM importDevis im
    //     WHERE (im.finition,im.tauxFinition) NOT IN (SELECT nomFinition,pourcentage FROM finition)');

    //     DB::statement('INSERT INTO demandeDevis (idTypeMaison,idClient,idFinition,DateDebut,DateFin,DateCreation,lieu,refDevis)
    //     SELECT DISTINCT t.idTypeMaison,c.idClient,f.idFinition,im.tauxFinition,im.dateDebut,DATE_ADD(im.dateDebut, INTERVAL t.duree DAY),im.dateDevis,im.lieu,im.refDevis
    //     FROM importDevis im
    //     INNER JOIN TypeMaison t on t.nomMaison = im.typeMaison
    //     INNER JOIN Client c on c.numero = im.client
    //     INNER JOIN Finition f on f.nomFinition = im.finition
    //     WHERE (t.idTypeMaison,c.idClient,f.idFinition,im.tauxFinition,im.dateDebut,DATE_ADD(im.dateDebut, INTERVAL t.duree DAY),im.dateDevis,im.lieu,im.refDevis) NOT IN (SELECT idTypeMaison,idClient,idFinition,DateDebut,DateFin,DateCreation,lieu,refDevis FROM demandeDevis)');


    //     return view('html.importDonnee');  
    // }
}
