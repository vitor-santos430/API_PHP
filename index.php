<?php
    // Dia 28/07/2020 02:07
    // Criando uma API/Servidor JSON com PHP
    
    //Dividindo URL pela /
    $path = explode('/', $_GET['path']);

    //carrega banco 
    $contents = file_get_contents('db.json');

    $json = json_decode($contents, true);

    $method = $_SERVER['REQUEST_METHOD'];

    //saída
    header('Content-type: application/json');
    $body = file_get_contents('php://input');

    if($method === 'GET'){
        //Quando existir algo em Series
        if($json[$path[0]]){
            echo json_encode($json[$path[0]]);
        }else{
            echo '[]';
        }
    }

    if($method === 'POST'){
        $jsonBody = json_decode($body, true);
            
        //Defina ID
        $jsonBody['id'] = time();

        //Quando existir algo em Series
        if(!$json[$path[0]]){
            $json[$path[0]] = [];
        }

        //gravando valores
        $json[$path[0]][] = $jsonBody;

        echo json_encode($jsonBody);
        file_put_contents('db.json', json_encode($json));
    }