<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json; charset=UTF-8');
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include('../classes/evfolyam.php');
        include_once('../classes/tanulo.php');
        $evfolyam = new Evfolyam('../evfolyam.csv');
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        $sor = "$data->nev;$data->osztaly;$data->matematika;$data->angol;$data->nemet;$data->informatika";
        $tanulo = new Tanulo($sor);
        //echo json_encode($tanulo);
        if ($evfolyam->Create($tanulo))
        {
            http_response_code(201);
            echo json_encode(array('message' => 'Object created.'));        
        }
        else
        {
            http_response_code(500);
            echo json_encode(array('message' => 'Unknown error.'));        
        }
    }
    else
    {
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
    } 

?>