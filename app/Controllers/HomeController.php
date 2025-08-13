<?php 

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller{
    public function index(){
        $data = [
            'title' => 'Home Page',
            'content' => 'Welcome to the Home Page!'
        ];

        return $this->render_view('Home', $data);
    }
}