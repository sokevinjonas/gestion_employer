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
        // Récupère les paiements les plus récents, les ordonne par 'id' de manière décroissante et les pagine par lots de 5.
        $paiements = Paiement::latest()->orderBy('id', 'desc')->paginate(5);
    
        // Récupère la date de paiement à partir de la table 'Configuration' où le type est 'PAYMENT_DATE'.
        $paymentDate = Configuration::where('type', 'PAYMENT_DATE')->first();
    
        // Convertit la valeur de la date de paiement en un entier.
        $dt_pai = $paymentDate->value;
        $dtConverted_pai = intval($dt_pai);
    
        // Obtient le jour actuel du mois.
        $date_jour = date('d');
        $dateConverted_jour = intval($date_jour);
    
        $date_transaction = false;
    
        // Vérifie si le jour actuel du mois correspond à la date de paiement configurée.
        if ($dateConverted_jour === $dtConverted_pai) {
            $date_transaction = true;
        } else {
            $date_transaction = false;
            // Si les dates ne correspondent pas, vous pouvez ajouter un message de débogage avec 'dd($date_transaction)'.
        }
    
        // Retourne la vue 'Paiement.index' avec les paiements et l'indicateur de date de transaction.
        return view('Paiement.index', compact('paiements', 'date_transaction'));
    }
    
    public function initePaiement() {
        // Initialise un tableau de correspondance entre les noms des mois en anglais et en français.
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
        
        // Vous pouvez maintenant utiliser le tableau $Listemois pour faire des traductions entre les noms des mois en anglais et en français.
    
    
        
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
