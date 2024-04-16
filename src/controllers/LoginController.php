<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\AlunosHandler;

class LoginController extends Controller {

    public function __construct(){
    }

    public function signin() {
        $dados = array();

        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');

        if(isset($email) && !empty($email)){
            $senha = md5($senha);

            AlunosHandler::fazerLogin($email, $senha);

            $this->redirect('/');
        }


        $this->render('login', $dados);
    }

    public function logout(){
        unset($_SESSION['lgaluno']);
        $this->redirect('/');
    }

}