<?php
	class Stream {
		public static function top_games(){
			require_once('database.php');
			$query = $db->prepare("SELECT * FROM stream_top_game");
			$query->execute();
			return $query->fetchAll();
		}
	}