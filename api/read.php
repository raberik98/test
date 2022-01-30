<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: application/json; charset=UTF-8');
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        include('../classes/evfolyam.php');
        // $evfolyam = new Evfolyam('../semmi.csv');
        $evfolyam = new Evfolyam('../evfolyam.csv');
        $response = $evfolyam->GetAll();
        if (count($response) > 0)
        {
            http_response_code(200);
            echo json_encode($response);
        }
        else 
        {
            http_response_code(404);
            echo json_encode(array('message' => 'Not found.'));        
        }
    }
    else
    {
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
    } 

?>