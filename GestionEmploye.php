<?php ob_start();
error_reporting(0);
?>
<?php include('includes/Header.php');

include ('Departement.php');
include ('DepartementDAO.php');
include ('DepartementService.php');

include ('Categorie.php');
include ('CategorieDAO.php');
include ('CategorieService.php');

include ('Fonction.php');
include ('FonctionDAO.php');
include ('FonctionService.php');

include ('Employe.php');
include ('EmployeDAO.php');
include ('EmployeService.php');

$listFonction= array();
$fonctSev = new FonctionService();
$listFonction = $fonctSev->getAllFonctionService();

$listDepart = array();
$deptSev = new DepartementService();
$listDepart = $deptSev->getAllDepartementService();

$listCat = array();
$catSev = new CategorieService();
$listCat = $catSev->getAllCategorieService();

$listEmp=array();
$empSev =  new EmployeService();
$listEmp = $empSev->getAllEmployeService();

if(!empty($_POST["filter"])){
    $listEmp = $empSev->getSearchedEmployeService($_POST["filter"]);
}

if( !empty($_POST["CIN"]) and !empty($_POST["nom"]) and !empty($_POST["prenom"]) and !empty($_POST["dateNais"]) and
    !empty($_POST["tel"]) and !empty($_POST["email"]) and !empty($_POST["passwd"]) and !empty($_POST["adresse"]) and
    !empty($_POST["nbrEnf"]) and !empty($_POST["sexe"]) and
    !empty($_POST["Depart"]) and !empty($_POST["Fonct"]) and !empty($_POST["categ"]) and !empty($_POST["photo"])){
    $hash = sha1($_POST["passwd"]);
    $empSev->addEmployeService(
        $_POST["CIN"],
        $_POST["nom"],
        $_POST["prenom"],
        $_POST["dateNais"],
        $_POST["tel"],
        $_POST["email"],
        $_POST["sexe"],
        $_POST["adresse"],
        $_POST["nbrEnf"],
        $hash,
        $_POST["photo"],
        $_POST["role"],
        $_POST["dateRecrutement"],
        $_POST["Fonct"],
        $_POST["categ"],
        $_POST["Depart"]
    );
    header("location:gestionEmploye.php");
}
if(!empty($_POST["nvcin"]) and !empty($_POST["nvnom"]) and !empty($_POST["nvprenom"]) and !empty($_POST["nvdateNais"]) and
    !empty($_POST["nvtel"]) and !empty($_POST["nvemail"]) and !empty($_POST["nvpasswd"]) and !empty($_POST["nvadresse"]) and
    !empty($_POST["nvsexe"]) and !empty($_POST["nvDepart"]) and !empty($_POST["nvFonct"]) and
    !empty($_POST["nvcateg"])){
    $nvhash = sha1($_POST["nvpasswd"]);
    $empSev->editEmployeService(
        $_POST["nvcin"],
        $_POST["nvnom"],
        $_POST["nvprenom"],
        $_POST["nvdateNais"],
        $_POST["nvtel"],
        $_POST["nvemail"],
        $_POST["nvsexe"],
        $_POST["nvadresse"],
        $_POST["nvnbrEnf"],
        $nvhash,
        $_POST["nvphoto"],
        $_POST["nvrole"],
        $_POST["nvdateRecrutement"],
        $_POST["nvFonct"],
        $_POST["nvcateg"],
        $_POST["nvDepart"]
    );
    header("location:gestionEmploye.php");
}
if(!empty($_GET["cin"]) AND !empty($_GET["action"])){
    if ($_GET["action"] == "remove") {
        $empSev->removeService($_GET["cin"]);
        header("location:gestionEmploye.php");
    }
}

?>
<!--body-->
<body style="font-size:16px">
<!--start header-->
<section class="au-breadcrumb m-t-75" style="background-color: whitesmoke">
    <div class="section__content section__content--p30">
        <center><h1>Gestion des Employes</h1></center>
    </div>
</section>
<!--end header-->
<!--start form focntion-->
<div class="card">
    <div class="card-header">
        <strong>Ajouter Un Employe </strong>
    </div>
    <center>
    <div class="card-body card-block">
        <form action="" method="post" id="Employe">
            <table>
                <tr>
                <td>
                    <div class="col col-sm-10">
                        <label for="nf-email" class=" form-control-label">CIN :</label>
                        <input type="text" id="nf-email" name="CIN" placeholder="Entrer CIN" class="form-control" required>
                    </div>
                </td>
                <td>
                    <div class="col col-sm-10">
                        <label for="nf-Nom" class=" form-control-label">Nom :</label>
                        <input type="text" id="nf-Nom" name="nom" placeholder="Entrer Nom" class="form-control" required>
                    </div>
                </td>
                <td>
                    <div class="col col-sm-10">
                        <label for="nf-prenome" class=" form-control-label">Prénom :</label>
                        <input type="text" id="nf-prenom" name="prenom" placeholder="Entrer Prénom" class="form-control" required style="-moz-appearance: textfield">
                    </div>
                </td>
                </tr>
                <tr>
                    <td>
                        <div class="col col-sm-10">
                            <label for="sexe" class=" form-control-label">Sexe :</label>
                            <select id="sexe" name="sexe"  class="form-control" required>
                                <option>Homme</option>
                                <option>Femme</option>
                        </div>
                    </td>
                    <td>
                        <div class="col col-sm-10">
                            <label for="nf-date" class=" form-control-label">Date de Naissance :</label>
                            <input type="date" id="nf-date" name="dateNais"  class="form-control" required>
                        </div>
                    </td>
                    <td>

                        <div class="col col-sm-10">
                            <label for="telef" class=" form-control-label">Télephone:</label>
                            <input type="tel" id="telef" name="tel"  class="form-control" required>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td>
                        <div class="col col-sm-10">
                            <label for="email" class=" form-control-label">Email:</label>
                            <input type="email" id="email" name="email" placeholder=" Entrer email" class="form-control" required style="-moz-appearance: textfield">
                        </div>
                    </td>
                    <td>
                        <div class="col col-sm-10">
                            <label for="passwd" class=" form-control-label">Password:</label>
                            <input type="password" id="passwd" name="passwd" placeholder=" Entrer Password" class="form-control" required style="-moz-appearance: textfield">
                        </div>
                    </td>
                    <td>
                    <div class="col col-sm-10">
                        <label for="adresse" class=" form-control-label">Adresse :</label>
                        <input type="text" id="adresse" name="adresse" placeholder="Entrer Adresse"  class="form-control" required>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col col-sm-6">
                            <label for="nbrenfant" class=" form-control-label">Nombre Enfants:</label>
                            <input type="number" name="nbrEnf" id="nbrEnf" class="form-control" value="1" min="0" max="10" oninput="nbrOutputId.value = nbrInputId.value">

                        </div>
                    </td>
                    <td>
                        <div class="col col-sm-10">
                            <label for="role" class=" form-control-label">Role:</label>
                            <select id="role" name="role"  class="form-control" >
                                <option>selectionne un role</option>
                                <option>Admin</option>
                                <option>Super Admin</option>
                                <option>Employe</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="col col-sm-10">
                            <label for="dateRecrutement" class=" form-control-label">Date Recrutement :</label>
                            <input type="date" id="dateRecrutement" name="dateRecrutement" class="form-control" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col col-sm-10">
                            <label for="Departement class=" form-control-label">Département:</label>
                            <select id="Departement " name="Depart"  class="form-control" >
                                <option>Choisi un Departement</option>
                                <?php
                                    foreach ($listDepart as $d){
                                        echo "<option value='".$d->getNum()."'>".$d->getNom()."</option>";
                                    }
                                ?>

                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="col col-sm-10">
                            <label for="Fonction" class=" form-control-label">Fonction:</label>
                            <select id="Fonction" name="Fonct"  class="form-control"  >
                                <option>Choisi une Fonction</option>
                                <?php
                                    foreach ($listFonction as $f){
                                        echo "<option value='".$f->getCode()."'>".$f->getNom()."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="col col-sm-10">
                            <label for="categorie" class=" form-control-label">Catégorie:</label>
                            <select id="categorie" name="categ"  class="form-control" >
                                <option>Choisi une Categorie</option>
                                <?php
                                foreach ($listCat as $c){
                                    echo "<option value='".$c->getCode()."'>".$c->getlibelle()."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                       <center><div class="col col-sm-6">
                            <label for="photo" class=" form-control-label" style="margin-left: 0px !important;">Photo :</label>
                            <input type="file" id="photo" name="photo" class="form-control" required  >
                        </div>
                       </center>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </center>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm" form="Employe">
            <i class="fa fa-dot-circle-o"></i> Ajouter
        </button>
        <button type="reset" class="btn btn-danger btn-sm" form="Employe">
            <i class="fa fa-ban"></i> Annuler
        </button>
    </div>
</div>
<!--end form focntion-->

<!-- Start Form Modification-->
<?php
if(!empty($_GET["cin"]) AND !empty($_GET["action"])){
if ($_GET["action"] == "edit") {
$E = $empSev->getEmployeByCINService($_GET["cin"]);
?>
    <center>
    <div class="card" style="width:90%">
        <div class="card-header" >
            Modifiez l'employe choisi :
        </div>
        <div class="card-body card-block" style="border: 2px solid orangered">
            <form action="" method="post" id="modification" class="form-horizontal">
                <div class="row form-group">
                    <table>
                        <tr>
                            <td>
                                <input type="hidden" value="<?php echo $E->getCIN();?>" name="oldcin">
                                <div class="col col-sm-10">
                                    <label for="nf-Nom" class=" form-control-label">CIN :</label>
                                    <input type="text" id="nf-Nom" value="<?php echo $E->getCIN();?>"  name="nvcin" placeholder="Entrer Cin" class="form-control" required>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="nf-Nom" class=" form-control-label">Nom :</label>
                                    <input type="text" id="nf-Nom" value="<?php echo $E->getNom();?>"  name="nvnom" placeholder="Entrer Nom" class="form-control" required>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="nf-prenome" class=" form-control-label">Prénom :</label>
                                    <input type="text" id="nf-prenom" value="<?php echo $E->getPrenom();?>" name="nvprenom" placeholder="Entrer Prénom" class="form-control" required style="-moz-appearance: textfield">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="sexe" class=" form-control-label">Sexe :</label>
                                    <select id="sexe" name="nvsexe"   class="form-control" required>
                                        <?php
                                        if($E->getSexe()=="Femme"){
                                            echo "<option selected>Femme</option>";
                                            echo "<option >Homme</option>";
                                        }else{
                                            echo "<option selected>Homme</option>";
                                            echo "<option>Femme</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="nf-date" class=" form-control-label">Date de Naissance :</label>
                                    <input type="date" id="nf-date" value="<?php echo $E->getDateNaissance();?>" name="nvdateNais"  class="form-control" required>
                                </div>
                            </td>
                            <td>

                                <div class="col col-sm-10">
                                    <label for="telef" class=" form-control-label">Télephone:</label>
                                    <input type="tel" id="telef" name="nvtel" value="<?php echo $E->getTel();?>"  class="form-control" required>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="email" class=" form-control-label">Email:</label>
                                    <input type="email" id="email" name="nvemail"  value="<?php echo $E->getEmail();?>" placeholder=" Entrer email" class="form-control" required style="-moz-appearance: textfield">
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="passwd" class=" form-control-label">Password:</label>
                                    <input type="password" id="passwd" name="nvpasswd" value="" placeholder=" Entrer Nouveau Password" class="form-control" required style="-moz-appearance: textfield">
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="adresse" class=" form-control-label">Adresse :</label>
                                    <input type="text" id="adresse" name="nvadresse" value="<?php echo $E->getAdresse();?>" placeholder="Entrer Adresse"  class="form-control" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="nvnbrenfant" class=" form-control-label">Nombre Enfants:</label>
                                    <input type="number" name="nvnbrEnf" id="nvnbrEnf" value="<?php echo $E->getNbrEnfant();?>" class="form-control" value="1" min="0" max="10" oninput="nbrOutputId.value = nbrInputId.value">
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="role" class=" form-control-label">Role:</label>
                                    <select id="role" name="nvrole"  class="form-control" >
                                        <?php
                                            if($E->getRole()=="Super Admin"){
                                                echo "<option selected>Super Admin</option>";
                                                echo "<option >Admin</option>";
                                                echo "<option >Employe</option>";
                                            }elseif($E->getRole()=="Admin"){
                                                echo "<option >Super Admin</option>";
                                                echo "<option selected>Admin</option>";
                                                echo "<option >Employe</option>";
                                            }elseif($E->getRole()=="Employe"){
                                                echo "<option>Super Admin</option>";
                                                echo "<option>Admin</option>";
                                                echo "<option selected>Employe</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="nvdateRecrutement" class=" form-control-label">Date Recrutement :</label>
                                    <input type="date" id="nvdateRecrutement" name="nvdateRecrutement" value="<?php echo $E->getDateRecrutement();?>"  class="form-control" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col col-sm-10">
                                    <label for="nvDepartement" class=" form-control-label">Département:</label>
                                    <select id="Departement " name="nvDepart"  class="form-control" >
                                        <?php
                                            foreach ($listDepart as $d) {
                                                if ($d->getNum() == $E->getNum()) {
                                                    echo " <option value='".$d->getNum()."' selected>".$d->getNom()."</option>";
                                                } else {
                                                    echo "<option value='".$d->getNum()."'>".$d->getNom()."</option>";
                                                }
                                            }
                                        ?>

                                    </select>
                                </div>
                            </td>

                            <td>
                                <div class="col col-sm-10">
                                    <label for="Fonction" class=" form-control-label">Fonction:</label>
                                    <select id="Fonction" name="nvFonct"  class="form-control"  >
                                        <?php
                                            foreach ($listFonction as $f) {
                                                if ($f->getCode() == $E->getCodeC()) {
                                                    echo "<option value='" . $f->getCode() . "' selected>" . $f->getNom() . "</option>";
                                                } else {
                                                    echo "<option value='" . $f->getCode() . "'>" . $f->getNom() . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>

                            <td>
                                <div class="col col-sm-10">
                                    <label for="categorie" class=" form-control-label">Catégorie:</label>
                                    <select id="categorie" name="nvcateg"  class="form-control" >
                                        <option>Choisi une nouvelle Categorie</option>
                                        <?php
                                        foreach ($listCat as $c){
                                            if ($c->getCode() == $E->getCodeC()) {
                                                echo "<option value='".$c->getCode()."' selected>".$c->getlibelle()."</option>";
                                            } else {
                                                echo "<option value='".$c->getCode()."'>".$c->getlibelle()."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <center><div class="col col-sm-10">
                                        <label for="nvphoto" class=" form-control-label" style="margin-left: 0px !important;">Photo :</label>
                                        <input type="file" id="photo" name="nvphoto" value="<?php echo $E->getPhoto();?>" class="form-control" >
                                    </div>
                                </center>
                            </td>
                        </tr>
                        </table><br>
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
        </div>
    </center>
    <?php
            }
        }
    ?>
<!-- end Form Modification-->
<div style="background-color: whitesmoke">
    <center><br><h4><u>Liste Des Employés</u></h4><br></center>
</div>
<!-- Start Form Recherche-->

<div style="margin-left: 15%;width: 100%">
    <div class="col-lg-6" style="margin-left: 0%; !important">
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

    <!--Start table des -->

    <div class="table-responsive table-responsive-data2"  style="overflow-x:auto; width: 70%">
            <table class="table table-data2" style="font-size:16px;width: 70%">
                <thead>
                <tr>
                    <th>PHOTO</th>
                    <th>CIN</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>AGE</th>
                    <th>SEXE</th>
                    <th>TEL</th>
                    <th>NBR ENFANTS</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>DATE DE RECRUTEMENT</th>
                    <th>DEPARTEMENT</th>
                    <th>FONCTION</th>
                    <th>CATEGORIE</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($listEmp as $res){
                    echo  "<tr class='tr-shadow'>";
                    echo "<td><img src='images/".$res->getPhoto()."'></td>";
                    echo "<td>".$res->getCIN()."</td>";
                    echo "<td>".$res->getNom()."</td>";
                    echo "<td>".$res->getPrenom()."</td>";
                    echo "<td>".$res->getAge()."</td>";
                    echo "<td>".$res->getSexe()."</td>";
                    echo "<td>".$res->getTel()."</td>";
                    echo "<td>".$res->getNbrEnfant()."</td>";
                    echo "<td>".$res->getEmail()."</td>";
                    echo "<td>".$res->getRole()."</td>";
                    echo "<td>".$res->getDateRecrutement()."</td>";
                    $dep = $deptSev->getDepartementByNumService($res->getNum());
                    echo "<td>".$dep->getNom()."</td>";
                    $fon = $fonctSev->getFonctionByCodeService($res->getCodeF());
                    echo "<td>".$fon->getNom()."</td>";
                    $cat = $catSev->getCategorieByCodeService($res->getCodeC());
                    echo "<td>".$cat->getLibelle()."</td>";
                    echo "<td style='width: 11%'>
                                                  <div style='margin-right: 10%'>
                                                        <div class='table-data-feature'>
                                                            <a href='?cin=".$res->getCIN()."&action=edit' class='item' data-toggle='tooltip' data-placement='top' title='Edit'>
                                                                <i class='zmdi zmdi-edit'></i>
                                                            </a>
                                                            <a href='?cin=".$res->getCIN()."&action=remove' class='item' data-toggle='tooltip' data-placement='top' title='Delete'>
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
    </div>
</div>
<br>
<!-- END DATA TABLE -->
</body>
<!--end body-->
<?php include('includes/Footer.php') ?>
<?php ob_end_flush() ?>