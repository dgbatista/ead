<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\AlunosHandler;
use \src\handlers\CursosHandler;

class CursosController extends Controller {
    
    private $loggedAluno;

    public function __construct(){
        $this->loggedAluno = AlunosHandler::getAluno($_SESSION['lgaluno']);

        $alunos = AlunosHandler::isLogged();

        if(!$alunos){
            $this->redirect('/login');
        }
    }

    public function index($args) {
        $curso = array();
        $modulos = array();

        if(isset($args['id'])){
            $idCurso = $args['id'];            
        
            $isSubscribe = AlunosHandler::isSubscribe($idCurso, $this->loggedAluno->id);

            if($isSubscribe){
                
                $curso = CursosHandler::getCurso($idCurso);
                $modulos = CursosHandler::getModulos($idCurso);

            } else {
                $this->redirect('/');                
            }
        } else{
            $this->redirect('/');
        }

        $this->render('cursos', [
            'id' =>$idCurso, 
            'curso' => $curso,
            'modulos' => $modulos,
            'loggedAluno' => $this->loggedAluno]
        );
    }

    public function aula($args){
        $id = $args['id'];

        $idCurso = CursosHandler::getCursoDaAula($id)['id_curso'];

        $curso = array();
        $modulos = array();
        $aula = array();

        if($idCurso != 0){
            
            $isSubscribe = AlunosHandler::isSubscribe($idCurso, $this->loggedAluno->id);

            if($isSubscribe){
                
                $curso = CursosHandler::getCurso($idCurso);
                $modulos = CursosHandler::getModulos($idCurso);
                $aula = CursosHandler::getAula($id);

                if($aula['tipo']== 'video'){
                    $view = 'curso-aula-video';
                } else {
                    $view = 'curso-aula-poll';
                }

            } else {
                $this->redirect('/');                
            }
        } else{
            $this->redirect('/');
        }

        $this->render($view, [
            'id' =>$idCurso, 
            'curso' => $curso,
            'modulos' => $modulos,
            'loggedAluno' => $this->loggedAluno]
        );

    }

}