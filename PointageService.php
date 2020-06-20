<?php

class PointageService{
    private $pDAO;

    public function __construct(){
        $this->pDAO = new PointageDAO();
    }
    public function addPointageService($date,$heure,$type,$cin){
        $P = new Pointage('',$date,$heure,$type,$cin);
        $this->pDAO->addPointage($P);
    }

    public function editPointageService($oldId,$date,$heure,$type,$cin){
        $P = new Pointage('',$date,$heure,$type,$cin);
        $this->pDAO->editPointage($oldId, $P);
    }

    public function RemovePointageService($id){
        $this->pDAO->removePointage($id);
    }
    public function getAllPointageService(){
        $listp = $this->pDAO->getAllPointage();
        $listPointageObj = array();
        foreach ($listp as $p){
            $listPointageObj[] = new Pointage($p->idP, $p->dateP,  $p->heureP, $p->typeP, $p->cinE);
        }
        return $listPointageObj;
    }
    public function getSerchedPointageService($filter){
        $listPointageDAO = $this->pDAO->getSearchedPointage($filter);
        $listP = array();
        foreach ($listPointageDAO as $p){
            $listP[] = new Pointage($p->idP, $p->dateP,  $p->heureP, $p->typeP, $p->cinE);
        }
        return $listP;
    }
    public function getPointageByIdService($id){
        $p = $this->pDAO->getPointageById($id);
        return new Pointage($p->idP, $p->dateP,  $p->heureP, $p->typeP, $p->cinE);
    }


}
?>