<?php
require_once('model/Model.php');

/**
 * Created by PhpStorm.
 * User: clguilbert
 * Date: 25/11/17
 * Time: 11:51
 */



class CtrlUser
{

    private $model;
    private $categ;
    public function __construct()
    {
        $this->model=new Model();


    }

    public function voirNews(){
        $tabnews=$this->model->voirNews();
        require_once('vues/acceuil.php');

    }

    public function connection(){
    $login = Filtrage::cleanString($_POST['login']);
    $mdp = Filtrage::cleanString($_POST['mdp']);
    try {
        $admin = $this->model->connection($login, $mdp); //RECOIT NEW ADMIN
    } catch (Exception $e) {
        require_once ("/vues/erreur403.html");// accès refusé
    }
    if ($admin != null) {
        require_once ("/vues/acceuilAdmin.php");
    }
    else {
        require_once ("/vues/erreur403.html");
    }

    }
    public function getNewsCateg(string $categ){
            if($categ=='all'){
                $this->voirNews();
            }
            else{
                $tabnews=$this->model->getNewsCateg($categ);
                $link='vues/acceuil.php?categ='.$categ;
                echo $link;
                require_once('vues/acceuil.php');
            }
    }

}

