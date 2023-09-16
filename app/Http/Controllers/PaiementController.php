<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employer;
use App\Models\Paiement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Configuration;

class PaiementController extends Controller
{
    public function index(){
    $paiements = Paiement::latest()->orderBy('id', 'desc')->paginate(5);
    $paymentDate = Configuration::where('type', 'PAYMENT_DATE')->first();
    $dt_pai = $paymentDate->value;
    $dtConverted_pai = intval($dt_pai);
    $date_jour = date('d');
    $dateConverted_jour = intval($date_jour);
    $date_transaction = false;

    if($dateConverted_jour === $dtConverted_pai){
        $date_transaction = true;
    }else{
        $date_transaction = false;
        // dd($date_transaction);
    }
        return view('Paiement.index',compact('paiements','date_transaction'));
    }

    public function initePaiement() {
        $Listemois = [
            'JANUARY' => 'JANVIER',
            'FEBRUARY' => 'FÉVRIER',
            'MARCH' => 'MARS',
            'APRIL' => 'AVRIL',
            'MAY' => 'MAI',
            'JUNE' => 'JUIN',
            'JULY' => 'JUILLET',
            'AUGUST' => 'AOÛT',
            'SEPTEMBER' => 'SEPTEMBRE',
            'OCTOBER' => 'OCTOBRE',
            'NOVEMBER' => 'NOVEMBRE',
            'DECEMBER' => 'DÉCEMBRE'
        ];
        
        // Obtenir le nom du mois actuel en anglais en utilisant Carbon (une bibliothèque pour gérer les dates et heures en PHP)
        $recupMoisEn = strtoupper(Carbon::now()->formatLocalized('%B'));

        // Associer le nom du mois en anglais avec son équivalent en français en utilisant le tableau $Listemois
        // Si le mois en anglais n'est pas trouvé dans le tableau, utiliser une chaîne vide comme valeur par défaut
        $recupMoisFr = $Listemois[$recupMoisEn] ?? '';

        $recupAnnee = Carbon::now()->format('Y');

        //On va simuler tous les paiements des employers mais precisement les employers qui n'ont pas encore ete payer dasn le mois actuel
        $employers = Employer::whereDoesntHave('payments', function
        ($query) use ($recupMoisFr, $recupAnnee)
        {
            $query->where('date_mois', '=', $recupMoisFr);
            $query->where('date_annee', '=', $recupAnnee);
        })->get();
        if($employers->count() == 0 ){
        return redirect()->back()->with('message_alerte', "Tout vos employers ont ete payer pour ce mois de $recupMoisFr");

        }
        foreach($employers as $employer) {
          $employerPayer = $employer->payments()->where('date_mois', '=', $recupMoisFr)->where('date_annee', '=', $recupAnnee)->exists();
            
          if(!$employerPayer){
            $salaire = $employer->montant_journalier * 31;

            $paiement = new Paiement([
                'reference' => strtoupper(Str::random(10)),
                'employer_id' => $employer->id,
                'montant' => $salaire,
                'launch_date' =>now(),
                'done_date' => now(),
                'status'=> 'SUCCESS',
                'date_mois' => $recupMoisFr,
                'date_annee'=> $recupAnnee
            ]);
            $paiement->save();

          }

        }
        return redirect()->back()->with('message_success', "Paiements des employers effectuer avec success pour le mois de $recupMoisFr");

    }
    
}
