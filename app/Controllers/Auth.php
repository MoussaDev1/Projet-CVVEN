<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\auth_model;

class Auth extends Controller {

    public function index() {
        return view("Auth/login.php");
    }

    public function view($page = 'login') {
        if (!is_file(APPPATH . '/Views/Auth/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        echo view('Auth/' . $page);
    }

    public function connexion() {
        $request = service('request');
        $clientModel = new auth_model();

        try {
            $password = $request->getPost('password');
            $email = $request->getPost('email');

            // Utilisez where pour spécifier les conditions de la requête
            $query = $clientModel->where('password', $password)->where('adressemail_client', $email)->get();
            // Utilisez getResult pour obtenir plusieurs résultats ou getRow pour un seul résultat
            $result = $query->getRow();

            if ($result) {
                // Stocker des informations de l'utilisateur dans la session
                session()->set('username', $result->nom_utilisateur);
                session()->set('id_user', $result->id);
                return redirect()->to(site_url('Affichage'));
            } else {
                session()->setFlashdata('error_login', 'Identifiant ou mot de passe de connexion erroné');
                return view('Auth/login');
            }
        } catch (\Exception $ex) {
            // Gérer les erreurs d'une manière appropriée, peut-être journaliser l'erreur
            echo $ex->getMessage();
        }
    }

    public function deconnexion() {
        // Supprimer toutes les données de la session
        session()->destroy(); 
        // Rediriger vers la page de connexion
        return redirect()->to(site_url('Auth/view/login'));
    }

    public function registerForm() {
        // Récupérer l'instance de la requête
        $request = service('request');


        $data = [
            'nom_utilisateur' => $request->getPost('nom_utilisateur'),
            'password' => $request->getPost('password'),
            'nom' => $request->getPost('nom'),
            'prenom' => $request->getPost('prenom'),
            'telephone_client' => $request->getPost('telephone'),
            'adresse_client' => $request->getPost('adresse'),
            'adressemail_client' => $request->getPost('adressemail'),
            'date_client' => $request->getPost('date_client'),
        ];


        $clientModel = new auth_model();

        try {
            // Tentative d'insertion
            $clientModel->insert($data);

            // Succès : stocker un message de succès dans une variable de session
            session()->setFlashdata('success_message', 'L\'utilisateur a été enregistré avec succès.');
            $request->setGlobal('post', []);
            // Charger directement la vue registerConfirmation
            return redirect()->to(site_url('Auth/view/registerConfirmation'));
        } catch (\Exception $e) {
            // Erreur : gérer l'erreur
            $errorMessage = $e->getMessage();
            session()->setFlashdata('error_message', $errorMessage);

            // Afficher un message d'erreur ou rediriger vers une page d'erreur
            return view('Auth/registerConfirmation'); // Assurez-vous que cette vue existe
        }
    }

    public function forgetPassword() {
        $request = service('request');

        if ($request->getPost('email_reset')) {
            $clientModel = new auth_model();
            $emailReset = $request->getPost('email_reset');

            // Stocker l'email dans la session
            session()->set('email_reset', $emailReset);
            $query = $clientModel->where('adressemail_client', $emailReset)->get();
            $result = $query->getRow();
            if ($result !== null) {
                return view('Auth/password_reset_confirmation.php');
            } else {
                session()->setFlashdata('error_message', "L'email n'existe pas");
                return view('Auth/password_reset_confirmation');
            }
        }
    }

    public function formPassword() {
        $request = service('request');
        $clientModel = new auth_model();

        // Récupérer l'email depuis la session
        $emailReset = session()->get('email_reset');
        $passwordReset = $request->getPost('password_reset');

        if ($emailReset && $passwordReset) {
            $data = [
                "password" => $passwordReset,
            ];

            $clientModel->set($data);
            $clientModel->where('adressemail_client', $emailReset);
            $clientModel->update();

            $affectedRows = $clientModel->affectedRows();

            // Supprimer l'email de la session après la mise à jour
            session()->remove('email_reset');

            if ($affectedRows > 0) {
                // Indiquer que le mot de passe a été changé avec succès
                session()->setFlashdata('success_message', 'Le mot de passe a bien été changé');
                return view('Auth/password_reset_confirmation');
            } else {
                session()->setFlashdata('error_message', 'Échec de la mise à jour du mot de passe');
                return view('Auth/password_reset_confirmation');
            }
        }
    }

}
