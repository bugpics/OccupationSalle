<?php
// Specify your sqlite database name and path
$datapie = array();
$dbname = "sqlite:/var/www/PIRlog.db";
$db = new PDO($dbname);
$query = "SELECT strftime('%w', timestamp) day, CAST(strftime('%H', timestamp) as INTEGER) hour, sum(motion) value FROM TxOccupationBox GROUP by hour ORDER by hour;";
$result = $db->query($query);

$result->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $result->fetch()) {
	extract($row);
	$datapie[] = array("day" => $day, "hour" => $hour, "value" => $value);
}

$data = json_encode($datapie);
echo $data;
?>
