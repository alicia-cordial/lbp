<?php
include("models/Database.php");
// Requête comparant le term avec les données de la bdd
$term = $_GET["term"];

try
{

  $query = $db->query("SELECT titre FROM article WHERE titre LIKE '%$term%' LIMIT 8");
  $tableau = $query->fetchAll(PDO::FETCH_COLUMN, 0);

  echo json_encode($tableau);

}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>