<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReservationModel;
use App\Models\LogementModel;
use App\Models\ContientModel;

class MyReservations extends Controller
{

    public function index()
    {
        if (session()->get("id_user") != "") {
            $reservationModel = new ReservationModel();
            $logementModel = new LogementModel();
            $data["header"] = [];

            // Récupération des données de la table 'reservation' :
            $queryReservation = $reservationModel->where("id_client", session()->get("id_user"))->get();
            try {
                $resultReservation = $queryReservation->getResult();
                if ($resultReservation) {
                    foreach ($resultReservation as $rowReservation) {
                        $dataRow = [];
                        $dataRow[] = $rowReservation->date_debut;
                        $dataRow[] = $rowReservation->date_fin;

                        // Récupération des données de la table 'logement' :
                        $queryLogement = $logementModel->where("id", $rowReservation->id_logement)->get();
                        try {
                            $resultLogement = $queryLogement->getResult();
                            if ($resultLogement) {
                                foreach ($resultLogement as $rowLogement) {
                                    $dataRow[] = $rowLogement->lieu;
                                    $dataRow[] = $rowLogement->taille_logement . "m²";
                                    $dataRow[] = $rowLogement->type_logement;
                                }
                            }
                        } catch (\Exception $ex) {
                            echo ($ex);
                        }
                        $dataRow[] = $rowReservation->Prix_Reservation . "€";
                        if ($rowReservation->validation_reservation == "0") {
                            $dataRow[] = "<div class='reservationNonValidee'> Non validée</div>";
                            $dataRow[] = "<form action='" . site_url("MyReservations/annulerReservation") . "' method='post'><input type='hidden' name='idReservation' value='" . $rowReservation->id . "'><input type='submit' value='Annuler'></form>";
                        } else {
                            $dataRow[] = "<div class='reservationValidee'>Validée</div>";
                            $dataRow[] = "Impossible";
                        }
                        $data["header"][] = $dataRow;
                    }
                }
            } catch (\Exception $ex) {
                echo ($ex);
            }

            echo view('MyReservations', $data);
        } else {
            return view('Auth/login');
        }
    }

    public function annulerReservation()
    {
        // Vérifier si la requête POST contient l'identifiant de réservation
        $idReservation = $this->request->getPost('idReservation');
        if ($idReservation) {
            $reservationModel = new ReservationModel();
            // Supprimer la réservation de la base de données
            $deleted = $reservationModel->delete($idReservation);

            if ($deleted) {
                // Stocker le message de succès dans une variable de session
                session()->setFlashdata('success', 'Réservation annulée avec succès.');
            } else {
                // Si la suppression a échoué
                session()->setFlashdata('error', 'Une erreur est survenue lors de l\'annulation de la réservation.');
            }
        } else {
            // Si aucun identifiant de réservation n'est présent, rediriger avec un message d'erreur générique
            session()->setFlashdata('error', 'Une erreur est survenue lors de l\'annulation de la réservation. Veuillez réessayer.');
        }

        // Rediriger vers la page des réservations
        return redirect()->to(base_url('MyReservations'));
    }
}
