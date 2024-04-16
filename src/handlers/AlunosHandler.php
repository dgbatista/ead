<?php
namespace src\handlers;

use \src\models\Aluno;
use \src\models\AlunoCurso;

class AlunosHandler  {

    public static function isLogged(){
        if(isset($_SESSION['lgaluno']) && !empty($_SESSION['lgaluno'])){
            return true;
        } else {
            return false;
        }
    }

    public static function fazerLogin($email, $senha){

        $data = Aluno::select()
            ->where('email', $email)
            ->where('senha', $senha)
        ->one();

        if($data){
            $_SESSION['lgaluno'] = $data['id'];
            return true;
        }
        return false;
    }

    public static function getAluno($id){
        $data = Aluno::select()
            ->where('id', $id)
        ->one();
        if($data){
            $aluno = new Aluno();
            $aluno->id = $data['id'];
            $aluno->nome = $data['nome'];
            $aluno->email = $data['email'];

            return $aluno;
        }        
        return false;
    }

    public static function getCursosDoAluno($id){
        $array = array();

        $data = AlunoCurso::select()
            ->where('id_aluno', $id)
            ->join('cursos', 'cursos.id' , '=', 'alunocursos.id_curso')
        ->get();

        if(count($data) > 0){
            return $data;            
        }
        return false;
    }

    public static function isSubscribe($idCurso, $idAluno){
        
        $data = AlunoCurso::select()
            ->where('id_curso', $idCurso)
            ->where('id_aluno', $idAluno)
        ->one();

        if($data){
            return $data;
        }
        return false;
    }

}