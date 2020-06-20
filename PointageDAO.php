<?php
class PointageDAO
{
    private $pdo;
    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=gestionpointage","root","");
    }
    public function addPointage($P){
        $reqPre = $this->pdo->prepare("INSERT INTO pointage ( dateP, heureP,typeP, cinE) VALUES(:D, :H, :T, :ci)");
        $reqPre->execute(array(":D"=>$P->getDateP(), ":H"=>$P->getHeureP(), ":T"=>$P->getTypeP(), ":ci"=>$P->getCinE()));
    }
    public function removePointage($IdPointage){
        $reqPre = $this->pdo->prepare("DELETE FROM pointage WHERE idP = :IP");
        $reqPre->execute(array( ":IP"=>$IdPointage));
    }
    public function editPointage($id,$P){
        $reqPre = $this->pdo->prepare("update pointage set dateP= :dp, heureP = :hp , typeP = :tp, cinE = :ci where idP = :id");
        $reqPre->execute(array(":dp"=>$P->getDateP(), ":hp"=>$P->getHeureP(), ":tp"=>$P->getTypeP(), ":ci"=>$P->getCinE(),":id"=>$id));
    }

    public function getAllPointage(){
        $reqPre = $this->pdo->prepare("SELECT * FROM pointage order by dateP desc");
        $reqPre->setFetchMode(PDO::FETCH_OBJ);
        $reqPre->execute();
        return $reqPre->fetchAll();
    }

    public function getSearchedPointage($filter){
        $reqPre = $this->pdo->prepare("SELECT * FROM pointage WHERE idP LIKE :F OR dateP LIKE :F OR heureP LIKE :F OR typeP like :F or cinE like :F");
        $reqPre->setFetchMode(PDO::FETCH_OBJ);
        $reqPre->execute(array(":F"=>"%".$filter."%"));
        return $reqPre->fetchAll();
    }
    public function getPointageById($id){
        $reqPre = $this->pdo->prepare("SELECT * FROM pointage WHERE idP = :id");
        $reqPre->setFetchMode(PDO::FETCH_OBJ);
        $reqPre->execute(array(":id"=>$id));
        $listP = $reqPre->fetchAll();
        return $listP[0];
    }
}

?>
