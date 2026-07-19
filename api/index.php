<?php

include "config.php";
include "functions.php";


$endpoint = $_GET["endpoint"] ?? "";

$id = $_GET["id"] ?? "";



switch($endpoint)
{


case "manga":


    if($id != "")
    {

        // Manga details

        $url =
        MANGADEX_API.
        "/manga/".
        $id.
        "?includes[]=cover_art&includes[]=tags";


    }
    else
    {

        // Manga list

        $params=$_GET;

        unset($params["endpoint"]);


        if(!isset($params["limit"]))
        {
            $params["limit"]=20;
        }


        if(!isset($params["includes"]))
{
    $params["includes[]"]="cover_art";
}


        $url =
        MANGADEX_API.
        "/manga?".
        http_build_query($params);

    }


    sendJSON(
        callAPI($url)
    );

break;



case "feed":


    $url =
    MANGADEX_API.
    "/manga/".
    $id.
    "/feed";


    if(count($_GET)>0)
    {

        $params=$_GET;

        unset($params["endpoint"]);
        unset($params["id"]);


        $url.="?".
        http_build_query($params);

    }


    sendJSON(
        callAPI($url)
    );


break;



case "cover":


    $url =
    MANGADEX_API.
    "/cover/".
    $id;


    sendJSON(
        callAPI($url)
    );


break;



case "server":


    $url =
    MANGADEX_API.
    "/at-home/server/".
    $id;


    sendJSON(
        callAPI($url)
    );


break;

case "tags":


    $url =
    MANGADEX_API.
    "/manga/tag";


    sendJSON(
        callAPI($url)
    );


break;

case "author":


    $url =
    MANGADEX_API.
    "/author/".
    $id;


    sendJSON(
        callAPI($url)
    );


break;

default:


sendJSON([

    "result"=>"ok",

    "message"=>"Manga API online",

    "endpoints"=>[

        "manga",
        "feed",
        "cover",
        "server"

    ]

]);


}

?>
