<?php
header("Access-Control-Allow-Origin: *");
// $dbconn = pg_connect("host=localhost dbname=music");
$dbconn = pg_connect(getenv("DATABASE_URL"));

class Song {
	public $id;
	public $songName;
	public $artistName;
	public $coverArt;
	public $albumName;
	public function __construct($id, $songName, $artistName, $coverArt, $albumName) {
		$this->id = $id;
		$this->songName = $songName;
		$this->artistName = $artistName;
		$this->coverArt = $coverArt;
		$this->albumName = $albumName;
	}
}

class Songs {
	static function all() {
		$songs = array();
		$results = pg_query("SELECT * FROM songs");

		
		$row_object = pg_fetch_object($results);
		while ($row_object) {
			$new_song = new Song (
				intval($row_object->id),
				$row_object->songname,
				$row_object->artistname,
				$row_object->coverart,
				$row_object->albumname
			);
			$songs[] = $new_song;
			$row_object = pg_fetch_object($results);
		}
		return $songs;
	}
	static function create($song){    //put
    	$query = "INSERT INTO songs (songName, artistName, coverArt, albumName) VALUES ($1, $2, $3, $4)";
    	$query_params = array($song->songName, $song->artistName, $song->coverArt, $song->albumName);
    	pg_query_params($query, $query_params);
    	return self::all(); 
	}
	static function update($updated_song){
   		$query = "UPDATE songs SET songName = $1, artistName = $2, coverArt = $3, albumName = $4 WHERE id = $5";
    	$query_params = array($updated_song->songName, $updated_song->artistName, $updated_song->coverArt, $updated_song->albumName,  $updated_song->id);
   		pg_query_params($query, $query_params);
		return self::all();
	}
	static function delete($id){
  		$query = "DELETE FROM songs WHERE id = $1";
    	$query_params = array($id);
    	pg_query_params($query, $query_params);
		return self::all();
	}
}





?>