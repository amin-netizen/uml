<?php ob_start();
error_reporting(0);
?>
<?php include('includes/Header.php') ;
include ('Pointage.php');
include ('PointageDAO.php');
include ('PointageService.php');
include ('Employe.php');
include ('EmployeDAO.php');
include ('EmployeService.php');

$listEmp=array();
$empSev =  new EmployeService();
$listEmp = $empSev->getAllEmployeService();


if( ($_POST["idP"]) and !empty( $_POST["nvDate"]) and !empty($_POST["nvHeure"]) and !empty($_POST["nvtype"])){
    $PointSev->editPointageService($_POST["idP"],$_POST["nvDate"],$_POST["nvHeure"],$_POST["nvtype"],$_POST["nvEmp"]);
    header("location:GestionPointage.php");
}

$resultat= array();
$PointSev = new PointageService();
if(!empty($_POST["date"]) and !empty($_POST["time"]) and !empty($_POST["type"]) and !empty($_POST["emp"])){
    $PointSev->addPointageService($_POST["date"],$_POST["time"],$_POST["type"],$_POST["emp"]);
    header("location:GestionPointage.php");
}

$resultat = $PointSev->getAllPointageService();

if(!empty($_GET["id"]) AND !empty($_GET["action"])){
    if ($_GET["action"] == "remove") {
        $PointSev->RemovePointageService($_GET["id"]);
        header("location:GestionPointage.php");
    }
}

?>

<body class="">
<script>
            let empList = <?php
            echo "[";
            foreach($listEmp as $emp){
                echo "{ firstname :'".$emp->getPrenom()."',lastname :'".$emp->getNom()."',cin :'".$emp->getCIN()."', img:'".$emp->getPhoto()."'},";                
            } 
            echo "];";
            
            ?>
            let pointageList = <?php
            echo "[";
            foreach($resultat as $pnt){
                echo "{ id :'".$pnt->getIdP()."',date :'".$pnt->getDateP()."',time :'".$pnt->getHeureP()."', type:'".$pnt->getTypeP()."',cin:'".$pnt->getCinE()."'},";                            
            }
            echo "];";
            ?>
            pointageList = pointageList.map(el=>{
                return {...el,timeStamp:new Date(`${el.date} ${el.time}`).getTime()}
            })
        </script>
        <!--start header-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <center><h1>Gestion de Pointage</h1></center>
                </div>
            </section>
        <!--end header-->
        <!--start form focntion-->
            <center>
            <div class="card">
                <div class="card-header">
                    <strong>Ajouter Un Pointage </strong>
                </div>                
                <div class="card-body card-block" style="padding-left: 0%;padding-right: 0%;">
                <div class="row  justify-content-center bg-white rounded m-3 p-2 border shadow">
                    <div  class="col-12 col-sm-8 ">
                    <progress></progress>                    
                    <button id="retry" type="button" class="btn btn-success btn-lg btn-block invisible d-none">Retry</button>
                    <div class="invisible d-none">
                        <video class="" width="700px" height="500px"  autoplay>
                        </video>
                    </div>
                    </div>
                </div>
                </div>
                <div class="card-body card-block" style="padding-left: 0%;padding-right: 0%;">
                    <form action="" method="post" id="Pointage">
                        <table  width="80%">
                            <td width="80%">
                                <div class="col col-sm-20" style="width:100%">
                                    <label for="emp" class=" form-control-label">Employé:</label>
                                    <select  id="emp"  disabled="true" name="emp" class="form-control" required style="width:80%" >
                                        <?php
                                            foreach ($listEmp as $E) {
                                                echo "<option value='" . $E->getCIN() . "'>" . $E->getCIN().'  :  '.$E->getNom().' '.$E->getPrenom()."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10" style="width:200px">
                                    <label for="type" class=" form-control-label">Type:</label>
                                    <select  id="type" disabled="true" name="type" class="form-control" required style="width:150px" >
                                        <option  value="Entrée" selected>Entrée</option>
                                        <option value="Sortie">Sortie</option>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10" >
                                    <label for="date" class=" form-control-label">Date:</label>
                                    <input type="date" id="date" name="date" class="form-control" required style="width:150px" value="<?php echo date("Y-m-d");?>" disabled>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-7" style="width:300px">
                                    <label for="heure" class=" form-control-label">Heure:</label>
                                    <input type="time" id="input-small" value="<?php echo date("h:i:s");?>" name="time" style="-moz-appearance: textfield" class="form-control" required style="width:150px" disabled>

                                </div>
                            </td>

                        </table>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm" form="Pointage" name="Ajouter">
                        <i class="fa fa-dot-circle-o"></i> Ajouter
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm" form="Pointage">
                        <i class="fa fa-ban"></i> Annuler
                    </button>
                </div>
            </div>
            </center>
            <!--end form focntion-->
        <?php
        if(!empty($_GET["id"]) AND !empty($_GET["action"])){
        if ($_GET["action"] == "edit") {
        $f = $PointSev->getPointageByIdService($_GET["id"]);
        ?>
        <center>
            <div class="card" style="width: 50%;margin-top: 3%">
                <div class="card-header" >
                    Modifiez le Pointage choisi :
                </div>
                <div class="card-body card-block" >
                    <form action="" method="post" id="modification" class="form-horizontal">
                        <div class="row form-group">
                            <input type="hidden" value="<?php echo $f->getIdP();?>" name="idP">
                            <div class="col col-sm-3"style="padding-right: 0px;margin-left: 8%" >
                                <label for="input-small" class=" form-control-label">Nouveau Employé :</label>
                            </div>
                            <div class="col col-sm-6">
                                <select  id="type"  name="nvEmp" class="form-control" required style="padding-left: 10px;margin-top: 4%;margin-left: 19%;!important;" >
                                    <?php
                                        foreach ($listEmp as $E) {
                                        if($E->getCIN() == $f->getCinE()){
                                            echo "<option value='".$E->getCIN()."' selected>" . $E->getCIN().'  :  '.$E->getNom().' '.$E->getPrenom()."</option>";
                                        }else{
                                            echo "<option value='".$E->getCIN()."'>" . $E->getCIN().'  :  '.$E->getNom().' '.$E->getPrenom()."</option>";
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-3"style="padding-right: 0px;margin-left: 8%" >
                                <label for="input-small" class=" form-control-label">Nouveau Type :</label>
                            </div>
                            <div class="col col-sm-6" style="margin-left: 50px">
                                <select id="type" name="nvtype"   class="form-control" required style="padding-left: 10px">
                                    <?php
                                    if($f->getTypeP()=="Entrée"){
                                        echo "<option selected>Entrée</option>";
                                        echo "<option >Sortie</option>";
                                    }else{
                                        echo "<option selected>Sortie</option>";
                                        echo "<option>Entrée</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-5">
                                <label for="input-small" class=" form-control-label">Nouvelle Date :</label>
                            </div>
                            <div class="col col-sm-6">
                                <input type="date" id="input-small" value="<?php echo $f->getDateP();?>" name="nvDate"  class="input-sm form-control-sm form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-sm-5">
                                <label for="input-small"  class=" form-control-label">Nouvelle Heure :</label>
                            </div>
                            <div class="col col-sm-6">
                                <input type="time" id="input-small" value="<?php echo $f->getHeureP();?>" name="nvHeure" style="-moz-appearance: textfield"  class="input-sm form-control-sm form-control">
                            </div>
                        </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" form="modification">
                                <i class="fa fa-dot-circle-o"></i> Modifier
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm" form="modification">
                                <i class="fa fa-ban"></i> Annuler
                            </button>
                        </div>
                    </form>
                </div>
        </center>
            <?php
        }
        }
        ?>

<script src="js/face-api.min.js"></script>
<script src="js/pointage.js"></script>
</body>

<?php include('includes/Footer.php'); ?>
<?php ob_end_flush() ?>