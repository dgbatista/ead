<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\AlunosHandler;

class HomeController extends Controller {

    public function __construct(){

        $alunos = AlunosHandler::isLogged();

        if(!$alunos){
            $this->redirect('/login');
        }
    }

    public function index() {
        $loggedAluno = array();

        $loggedAluno = AlunosHandler::getAluno($_SESSION['lgaluno']);

        $cursos = AlunosHandler::getCursosDoAluno($loggedAluno->id);

        $this->render('home', [
            'loggedAluno' => $loggedAluno,
            'cursos' => $cursos
        ]);
    }

}