<?php
$key = "n5I7iI7fqlOF6s4DEJKRyXtZhJDndTCHS8RIXNgTedQ";
$id = '4414808166466429';
$name = "Proudly";
$adress = 'https://www.linkedin.com/sales/search/company?industry=5';

update($adress, $id, $name, $key);
launch($key, $id);
fetcher($key);

function update($adress, $id, $name, $key){
    $options = array(
        "method" => "POST",
        "header" => "accept: application/json\r\ncontent-type: application/json\r\nX-Phantombuster-Key: $key",
        "content" => json_encode(array(
            "id" => $id,
            "name" => $name,
            "proxyAddress" => $adress
        ))
    );
    
    $context = stream_context_create(array("http" => $options));
    $result = file_get_contents("https://api.phantombuster.com/api/v2/agents/save", false, $context);
    
    if ($result === false) {
        echo "Error: " . error_get_last()["message"] . "\n";
    } else {
        $response = json_decode($result);
        print_r($response);
    }
}

function launch($key, $id){
    $options = array(
        "method" => "POST",
        "header" => "content-type: application/json\r\nX-Phantombuster-Key: $key",
        "content" => json_encode(array("id" => $id))
    );
    
    $context = stream_context_create(array("http" => $options));
    $result = file_get_contents("https://api.phantombuster.com/api/v2/agents/launch", false, $context);
    
    if ($result === false) {
        echo "Error: " . error_get_last()["message"] . "\n";
    } else {
        $response = json_decode($result);
        print_r($response);
    }
}

function fetcher($key){
    $options = array(
        "method" => "GET",
        "header" => "accept: application/json\r\nX-Phantombuster-Key: $key"
    );
    
    $context = stream_context_create(array("http" => $options));
    $result = file_get_contents("https://api.phantombuster.com/api/v2/agents/fetch?id=4414808166466429", false, $context);
    
    if ($result === false) {
        echo "Error: " . error_get_last()["message"] . "\n";
    } else {
        $response = json_decode($result);
        print_r($response);
    }
}
?>