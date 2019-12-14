<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

http_response_code($errorCode);

echo json_encode($data);

?>
