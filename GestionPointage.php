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


$resultat= array();
$PointSev = new PointageService();
if(!empty($_POST["date"]) and !empty($_POST["time"]) and !empty($_POST["type"]) and !empty($_POST["emp"])){
    $PointSev->addPointageService($_POST["date"],$_POST["time"],$_POST["type"],$_POST["emp"]);
    header("location:GestionPointage.php");
}

$resultat = $PointSev->getAllPointageService();
if(!empty($_POST["filter"])){
    $resultat = $PointSev->getSerchedPointageService($_POST["filter"]);
}
if( ($_POST["idP"]) and !empty( $_POST["nvDate"]) and !empty($_POST["nvHeure"]) and !empty($_POST["nvtype"])){
    $PointSev->editPointageService($_POST["idP"],$_POST["nvDate"],$_POST["nvHeure"],$_POST["nvtype"],$_POST["nvEmp"]);
    header("location:GestionPointage.php");
}
if(!empty($_GET["id"]) AND !empty($_GET["action"])){
    if ($_GET["action"] == "remove") {
        $PointSev->RemovePointageService($_GET["id"]);
        header("location:GestionPointage.php");
    }
}
?>
    <!--body-->
        <body style="font-size:16px">

            <!--end form focntion-->
        <?php
        if(!empty($_GET["id"]) AND !empty($_GET["action"])){
        if ($_GET["action"] == "edit") {
        $f = $PointSev->getPointageByIdService($_GET["id"]);
        ?>
        <center>
            <div class="card mt-5" style="width: 50%;margin-top: 3%">
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

        <!--Recherche-->
        <div class="col-lg-6" style="margin-left: 12.5%;margin-top: 120px;">
            <div class="card-body card-block">
                <form action="" method="post" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-9">
                            <div class="input-group">
                                <input type="text" id="input1-group2" name="filter" placeholder="" class="form-control">&nbsp;
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <!--Start table des pontages-->
        <div class="table-responsive table-responsive-data2">
            <center>
                <table class="table table-data2" style="font-size:16px;width: 70%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>CIN</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($resultat as $res){
                        echo  "<tr class='tr-shadow'>";
                        echo "<td>".$res->getIdP()."</td>";
                        echo "<td>".$res->getCinE()."</td>";
                        echo "<td>".$res->getDateP()."</td>";
                        echo "<td>".$res->getHeureP()."</td>";
                        echo "<td>".$res->getTypeP()."</td>";
                        echo "<td style='width: 11%'>
                                              <div style='margin-right: 10%'>
                                                    <div class='table-data-feature'>
                                                        <a href='?id=".$res->getIdP()."&action=edit' class='item' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                            <i class='zmdi zmdi-edit'></i>
                                                        </a>
                                                        <a href='?id=".$res->getIdP()."&action=remove' class='item' data-toggle='tooltip' data-placement='top' title='Delete'>
                                                            <i class='zmdi zmdi-delete'></i>
                                                        </a>
                                                    </div>
                                              </div>
                                        </td>
                                       </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </center>
        </div><br>

        <!-- END DATA TABLE -->
        <!-- <script src="js/face-api.min.js"></script>
        <script src="js/pointage.js"></script> -->
        </body>
    <!--end body-->
<?php include('includes/Footer.php'); ?>
<?php ob_end_flush() ?>
