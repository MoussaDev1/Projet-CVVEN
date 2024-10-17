<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogementModel;
use App\Models\ReservationModel;

class Affichage extends Controller {
    
    public function index() {
        
        if (session()->get("id_user") != "") {
            
            $logementModel = new LogementModel(); 

            try {
                
                $data["logements"] = $logementModel->findAll();
                
            } catch (\Exception $ex) {
                
                echo $ex->getMessage();
            }       
            
            return view('Affichage', $data);
        } else {
            return view('Auth/login');
        }
    }

    public function createReservation() {
    // Vérifier si le formulaire est soumis
    if ($this->request->getMethod() === 'post') {
        // Récupérer l'ID du logement à partir du formulaire
        $id_logement = $this->request->getPost('id_logement');

        // Recherchez le logement correspondant à l'ID du logement dans la base de données
        $logementModel = new LogementModel();
        $logement = $logementModel->find($id_logement);

        // Vérifiez si le logement existe
        if ($logement) {
            // Récupérer le prix du logement
            $Prix_Reservation = $logement['prix_logement'];

            // Récupérer les autres données du formulaire
            $data = [
                'date_debut' => $this->request->getPost('date_debut_reservation'),
                'date_fin' => $this->request->getPost('date_fin_reservation'),
                'id_logement' => $id_logement,
                'id_client' => session()->get('id_user'),
                'Prix_Reservation' => $Prix_Reservation, // Utilisez le prix du logement pour Prix_Reservation
                'validation_reservation' => 0,
            ];

            // Instancier le modèle de réservation
            $reservationModel = new ReservationModel();

            try {
                // Insérer la réservation dans la base de données
                $reservationModel->insert($data);

                // Rediriger avec un message de succès
                return redirect()->to(site_url('Affichage'))->with('success', 'Réservation effectuée avec succès!');
            } catch (\Exception $ex) {
                // Rediriger avec un message d'erreur en cas d'échec de l'insertion
                return redirect()->to(site_url('Affichage'))->with('error', 'Erreur lors de la réservation : ' . $ex->getMessage());
            }
        } else {
            // Rediriger avec un message d'erreur si le logement n'est pas trouvé
            return redirect()->to(site_url('Affichage'))->with('error', 'Logement non trouvé.');
        }
    }
}

        }
