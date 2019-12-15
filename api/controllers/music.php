<?php
 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    echo "You have CORS!";
include_once __DIR__. '/../models/music.php';

if($_REQUEST['action'] === 'index'){
    echo json_encode(Songs::all());
} elseif ($_REQUEST['action'] === 'post'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_song = new Song(null, $body_object->songName, $body_object->artistName, $body_object->coverArt, $body_object->albumName); 
    $all_songs = Songs::create($new_song);
    echo json_encode($all_songs);
}elseif ($_REQUEST['action'] === 'update'){ // put route
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_song = new Song($_REQUEST['id'], $body_object->songName, $body_object->artistName, $body_object->coverArt, $body_object->albumName);
    $all_songs = Songs::update($updated_song);
	echo json_encode($all_songs);
	
}elseif ($_REQUEST['action'] === 'delete'){ // delete
    $all_songs = Songs::delete($_REQUEST['id']);
    echo json_encode($all_songs);
}

?>