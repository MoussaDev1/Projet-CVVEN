<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReservationModel;
use App\Models\auth_model;
use App\Models\LogementModel;

class Administration extends Controller {

    public function index() {
        //Seul l'admin (client ayant l'id 34) peut utiliser cette page :
        if (session()->get("id_user") == "34") {
            $reservationModel = new ReservationModel();
            $clientModel = new auth_model();
            $logementModel = new LogementModel();
            $data["header"] = [];
            
            //Récupération des données de la table 'reservation' avec ou sans filtre :
            $request = service('request');
            $idClient = $request->getPost('idClient');
            if (isset($idClient) && $idClient != "") {
                $queryReservation = $reservationModel->where("id_client", $idClient)->get();
            }
            else {
                $queryReservation = $reservationModel->get();
            }
            
            try {
                $resultReservation = $queryReservation->getResult();
                if ($resultReservation) {
                    foreach($resultReservation as $rowReservation) {
                        $dataRow = [];
                        $dataRow[] = $rowReservation->date_debut;
                        $dataRow[] = $rowReservation->date_fin;
                        //Récupération des données de la table 'client' :
                        $queryClient = $clientModel->where("id", $rowReservation->id_client)->get();
                        try {
                            $resultClient = $queryClient->getResult();
                            if ($resultClient) {
                                foreach($resultClient as $rowClient) {
                                    $dataRow[] = $rowClient->id;
                                    $dataRow[] = $rowClient->nom;
                                    $dataRow[] = $rowClient->prenom;
                                    $dataRow[] = $rowClient->adressemail_client;
                                }
                            }
                        } catch (Exception $ex) {
                            echo($ex);
                        }
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
                            $dataRow[] = "<form action='".site_url("Administration/valideeReservation")."' method='post'><input type='hidden' name='idReservation' value='".$rowReservation->id."'><input type='submit' value='Validée'></form>";
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

            echo view('Administration', $data);
        }
        else {
            return view('Auth/login');
        }
    }
    
    public function valideeReservation() {
        try {
            $reservationModel = new ReservationModel();
            $request = service('request');
            $idReservation = $request->getPost('idReservation');
            $reservationModel->set("validation_reservation", 1)->where("id", $idReservation)->update();
            $this->index();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
}