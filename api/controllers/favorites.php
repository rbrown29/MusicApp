<?php

header('Content-Type: application/json');
include_once __DIR__. '/../models/favorites.php';

if($_REQUEST['action'] === 'index'){
    echo json_encode(Favorites::all());
} elseif ($_REQUEST['action'] === 'post'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_song = new Favorite(null, $body_object->songName, $body_object->artistName, $body_object->coverArt, $body_object->albumName);
    $all_songs = Favorites::create($new_song);
    echo json_encode($all_songs);
}elseif ($_REQUEST['action'] === 'update'){ // put route
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_song = new Favorite($_REQUEST['id'], $body_object->songName, $body_object->artistName, $body_object->coverArt, $body_object->albumName);
    $all_songs = Favorites::update($updated_song);
	echo json_encode($all_songs);

}elseif ($_REQUEST['action'] === 'delete'){ // delete
    $all_songs = Favorites::delete($_REQUEST['id']);
    echo json_encode($all_songs);
}

?>
