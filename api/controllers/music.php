<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
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