<?php
namespace src\handlers;

use \src\models\Aluno;
use \src\models\AlunoCurso;
use \src\models\Curso;
use \src\models\Modulo;
use \src\models\Aula;
use \src\models\Video;
use \src\models\Questionario;

class CursosHandler  {

    public static function isLogged(){
        if(isset($_SESSION['lgaluno']) && !empty($_SESSION['lgaluno'])){
            return true;
        } else {
            return false;
        }
    }

    public static function getCurso($idCurso){
        $curso =  array();

        $data = Curso::select()
            ->where('id', $idCurso)
        ->one();

        if($data){
            $curso = $data; 
        }
        return $curso;
    }

    public static function getModulos($idCurso){
        $array = array();
    
        $data = Modulo::select()
            ->where('id_curso', $idCurso)
        ->get();

        if(count($data)>0){
            $array = $data;
        }

        foreach($array as $chave => $dados){
            $array[$chave]['aulas'] = self::getAulasDoModulo($dados['id']);
        }

        return $array;  
    }  

    public static function getAulasDoModulo($id){
        $array = array();

        $data = Aula::select()
            ->where('id_modulo', $id)
            ->orderBy('ordem')
        ->get();

        if(count($data)>0){
            $array = $data;

            foreach($array as $aulachave => $aula){
                if($aula['tipo'] == 'video'){
                    $data = Video::select('nome')
                        ->where('id_aula', $aula['id'])
                    ->one();
                    $array[$aulachave]['nome'] = $data['nome'];
                }
                else if($aula['tipo'] == 'poll'){
                    $array[$aulachave]['nome'] = 'Questionário';
                }
            }
        }

        return $array;
    }

    public static function getCursoDaAula($idAula){

        $data = Aula::select('id_curso')
            ->where('id', $idAula)
        ->one();

        if(count($data)>0){
            return $data;
        } else {
            return 0;
        }
    }

    public static function getAula($idAula){
        $array = array();

        $data = Aula::select('tipo')
            ->where('id', $idAula)
        ->one(); 

        if(count($data)>0){
            $row = $data;

            if($row['tipo'] == 'video'){
                $data = Video::select()
                    ->where('id_aula', $idAula)
                ->one();
                $array = $data;
                $array['tipo'] = 'video';

            } else if($row['tipo'] == 'poll'){
                $data = Questionario::select()
                    ->where('id_aula', $idAula)
                ->one();
                $array = $data;
                $array['tipo'] = 'poll';
            }
        }

        return $array;
    }

}