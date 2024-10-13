<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller {

    public function index() {
        return view('welcome_message.php');
    }

    public function view($page = 'login') {
        if (!is_file(APPPATH . '/Views/templates/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        echo view('templates/' . $page);
    }

}
