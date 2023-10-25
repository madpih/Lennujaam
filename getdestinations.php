<?php
require($_SERVER["DOCUMENT_ROOT"]."/../../config2.php");
global $yhendus;

$q = $_GET['q'];

$kask = $yhendus->prepare("SELECT d.destination
FROM destinations d 
INNER JOIN airline_destinations ad 
ON d.id = ad.destination_id 
INNER JOIN airlines a 
ON ad.airline_id = a.id 
WHERE a.airline = ?");

$kask->bind_param("s", $q);
$kask->execute();
$kask->bind_result($destination);

$options = "";

while ($kask->fetch()) {
    $options .= "<option value='$destination'>$destination</option>";
}

$kask->close();
echo $options;
?>
