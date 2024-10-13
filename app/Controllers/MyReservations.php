<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReservationModel;
use App\Models\LogementModel;
use App\Models\ContientModel;

class MyReservations extends Controller {

    public function index() {
        if (session()->get("id_user") != "") {
            $reservationModel = new ReservationModel();
            $logementModel = new LogementModel();
            $data["header"] = [];

            //Récupération des données de la table 'reservation' :
            $queryReservation = $reservationModel->where("id_client", session()->get("id_user"))->get();
            try {
                $resultReservation = $queryReservation->getResult();
                if ($resultReservation) {
                    foreach($resultReservation as $rowReservation) {
                        $dataRow = [];
                        $dataRow[] = $rowReservation->date_debut;
                        $dataRow[] = $rowReservation->date_fin;
                        //Récupération des données de la table 'logement' :
                        $queryLogement = $logementModel->where("id", $rowReservation->id_logement)->get();
                        try {
                            $resultLogement = $queryLogement->getResult();
                            if ($resultLogement) {
                                foreach($resultLogement as $rowLogement) {
                                    $dataRow[] = $rowLogement->lieu;
                                    $dataRow[] = $rowLogement->taille_logement."m²";
                                    $dataRow[] = $rowLogement->type_logement;
                                }
                            }
                        } catch (Exception $ex) {
                            echo($ex);
                        }
                        $dataRow[] = $rowReservation->Prix_Reservation."€";
                        if ($rowReservation->validation_reservation == "0") {
                            $dataRow[] = "<div class='reservationNonValidee'> Non validée</div>";
                            $dataRow[] = "<form action='".site_url("MyReservations/annulerReservation")."' method='post'><input type='hidden' name='idReservation'"
                                    . " value='".$rowReservation->id."'><input type='submit' value='Annulée'></form>";
                        }
                        else {
                            $dataRow[] = "<div class='reservationValidee'>Validée</div>";
                            $dataRow[] = "Impossible";
                        }
                        $data["header"][] = $dataRow;
                    }
                }
            } catch (Exception $ex) {
                echo($ex);
            }

            echo view('MyReservations', $data);
        }
        else {
            return view('Auth/login');
        }
    }
    
public function annulerReservation() {  
    // Vérifier si la requête POST contient l'identifiant de réservation
    if ($this->request->getPost('idReservation')) {
        // Stocker le message dans une variable de session
        session()->setFlashdata('error', 'Contactez l\'administration');
        // Rediriger vers la page principale
        return redirect()->to(base_url('MyReservations/contactez-administration'));
    } else {
        // Si aucun identifiant de réservation n'est présent, rediriger vers la page principale avec un message d'erreur générique
        return redirect()->to(base_url('MyReservations/contactez-administration'))->with('error', 'Une erreur est survenue lors de l\'annulation de la réservation. Veuillez réessayer.');
    }
}


}