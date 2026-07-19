<?php

function callAPI($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, [

        CURLOPT_URL => $url,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_FOLLOWLOCATION => true,

        CURLOPT_HTTPHEADER => [

            "Accept: application/json",

            "User-Agent: MangaAPI/1.0 (admin@rxmlsia.fyi)"

        ]

    ]);


    $response = curl_exec($curl);


    if($response === false)
    {
        return [
            "error"=>curl_error($curl)
        ];
    }


    curl_close($curl);


    return json_decode(
        $response,
        true
    );
}



function sendJSON($data)
{
    header("Content-Type: application/json");

    echo json_encode(
        $data,
        JSON_UNESCAPED_UNICODE
    );

    exit;
}

?>