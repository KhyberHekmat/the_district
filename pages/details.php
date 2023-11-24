<?php
include "page-master/header.php";
include_once('data-objects/connection.php');

$url = $_SERVER["REQUEST_URI"];
$uriArray = explode('?', $url);
$id = $uriArray["1"];

if (!empty($id)) {
    $query = 'SELECT c.liblle AS categorie, p.libelle, p.description, 
        p.image, p.prix FROM categorie c INNER JOIN plat p on p.id_categorie
         = c.id WHERE c.id=:id ORDER BY c.id';
    $statement = $conn->prepare($query);
    $statement->execute(
        [":id" => $id]
    );
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if ($total_row > 0) {
        $output .= '<div class="container">';
        foreach ($result as $row) {
            $output .= '
                <div class="card my-3 mx-2 content-fluid" style="width:24rem">
                    <div class="card-header">
                        ' . $row["libelle"] . '
                    </div>
                    <div class="card-body pl-2 pt-2 pr-0" style="min-height:250px">
                        <div class="row">
                            <div class="col-4">
                                <img src="../client/images/food/' . $row["image"] . '" width="100px" height="100">
                            </div>
                            <div class="col-8">
                                <p justify-content-between>' . $row["description"] . '</p>
                                <br>
                                <p>Prix : ' . $row["prix"] . '</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="post">
                            <button type="submit" class="btn btn-primary" id="commande" name="commande">Commander</button>
                        </form>
                    </div>
                </div>
            ';
        }
        $output .= '</div>';
        echo $output;
    } else {
        header("location: index.php");
    }
}
include "page-master/footer.php";
