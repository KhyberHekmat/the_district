<!-- la section de header -->
<?php include "page-master/header.php"; ?>


<!--main content goes here-->
<?php
include_once('data-objects/connection.php');

$query = "SELECT * FROM categorie WHERE active='Yes'";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$total_row = $statement->rowCount();

if ($total_row > 0) {
    $output .= '
        <div class="container">';
    foreach ($result as $row) {
        $output .= '
            <div class="card content-fluid my-3 mx-2" style="width: 18rem;">
                <div class="card-header text-center p-2">
                    <h4>' . $row["liblle"] . '<h4>
                </div>
                <div class ="card-body text-center">
                    <a href="details.php?' . $row["id"] . '"><img src="../client/images/category/' . $row["image"] . '" 
                    style="height:14rem; width:14rem"></a>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" name="commande" id="commande"><a href="details.php?' . $row["id"] . '">Details</a></button>
                </div>
            </div>';
    }

    $output .=  '</div>';
    echo $output;
}
?>


<!-- la section de footer -->
<?php include "page-master/footer.php"; ?>