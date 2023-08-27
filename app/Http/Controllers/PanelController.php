<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\User;

class PanelController extends Controller
{
    public function index(){
        //On va recuperer le total de departement
        $totalDepartements = Departement::all()->count();
        //On va recuperer le total d'employer
        $totalEmployers = Employer::all()->count();
        //On va recuperer le total de admin
        $totaladministrateurs = User::all()->count();

        /* Récupérons la date du jour et comparons-la avec la date de paiement */
        $currentDate = Carbon::now()->day;

        /* On va récupérer la date de paiement, d'abord je veux initialiser dt_pai */
        $dt_pai = null;
        $paymentNotification = '';
        $paymentDate = Configuration::where('type', 'PAYMENT_DATE')->first();

        if ($paymentDate) {
                // Je veux stocker la valeur de la date de paiement dans dt_pai
                $dt_pai = $paymentDate->value;

                // Maintenant je convertis la valeur de dt_pai en un entier
                $dtConverted_pai = intval($dt_pai);

                if ($currentDate < $dtConverted_pai) {
                    $paymentNotification = 'Le paiement doit avoir lieu le ' . $dt_pai . ' de ce mois';
                } else {
                    $nextMonth = Carbon::now()->addMonth();
                    $nextMonthPayment = $nextMonth->format('F');
                    $paymentNotification = "Le prochain paiement doit avoir lieu le " . $dt_pai . " du mois de " . $nextMonthPayment;
                }
                // dd($paymentNotification);
            }
            return view('Panel.dashbord', compact('totalDepartements', 'totalEmployers', 'totaladministrateurs', 'paymentNotification'));
        }
    }

