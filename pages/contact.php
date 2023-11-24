<?php 
    include_once 'data-objects/connection.php';
    include "page-master/header.php";
    $message = "";
    if(isset($_POST["submit"])) {

        $formdata = array() ;
        if (empty($_POST["nom"]) && empty($_POST["prenom"]) && empty($_POST["email"]) && empty($_POST["telephon"])) {
            $message .= "<li>S'il vous plaît remplez les champs blancs</li>";
        }else{
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                $message .= "<li>S'il vous plaît corriegez l'email</li>";
            }else{
                $formdata["nom"] = $_POST["nom"];
                $formdata["prenom"] = $_POST["prenom"];
                $formdata["email"] = $_POST["email"];
                $formdata["telephone"] = $_POST["telephone"];
                $formdata["votredemande"] = $_POST["votredemande"];
            }
            if($message ==''){
                $data = array(':nom'=> $formdata['nom'],':prenom'=> $formdata['prenom'],
                    ':email'=> $formdata['email'],':telephone'=> $formdata['telephone'],
                    ':votredemande'=> $formdata['votredemande']);
                    $result = "insert into contact(nom,prenom,email,telephone,votredemande) 
                        VALUES (:nom,:prenom,:email,:telephone,:votredemande)";
                    $statement =$conn->prepare($result);
                    $statement->execute($data);
                       
            }
        }
    }

?>

<div class="d-flex align-items-center justify-content-center mt-5">
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            Contact
        </div>
        <div class="card-body">
            <form action="contact.php" method="post">
                
                <div class="row">
                    <div class="col mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>
                    <div class="col mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" name="prenom" id="prenom" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="nom@nom.com">
                    </div>
                    <div class="col mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="votredemande" class="form-label">Votre demande</label>
                        <textarea name="votredemande" id="votredemande" class="form-control" rows="3"></textarea>
                    </div>
                    
                </div>
                <div class="row text-center">
                    <div class="col mb-3">
                        <button type="submit" value="submit" class="btn btn-primary btn-submit">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


   
</div>

<?php include "page-master/footer.php";?>