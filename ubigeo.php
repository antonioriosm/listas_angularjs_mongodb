<?php
$data = file_get_contents("php://input");
$objData = json_decode($data);

try {
    $m = new Mongo();

    $db = $m->ubigeo;
}
catch( MongoConnectionException $e) {
    echo "Error de Conexión";
    exit();
}

if (isset($objData->cd)) {
    $pro = new MongoCollection($db, 'prov');
    $cursor = $pro->find(array("coddep" => $objData->cd), array("_id" => 0));
}
elseif (isset($objData->cp)) {
    $dis = new MongoCollection($db, 'dist');
    $cursor = $dis->find(array("codpro" => $objData->cp), array("_id" => 0));
}
else {
    $dep = new MongoCollection($db, 'dpto');
    $cursor = $dep->find(array(), array("_id" => 0));
}

$data = array();

foreach ($cursor as $doc) {
    $data[] = $doc;
}

echo json_encode($data);

?>
