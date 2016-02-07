<?php
	class Stream {
		public static function champions() {
			require_once('database.php');
			$query = $db->prepare("SELECT * FROM champion ORDER BY `name`");
			$query->execute();
			return $query->fetchAll();
		}

		public static function leagues() {
			require_once('database.php');
			$query = $db->prepare("SELECT * FROM league ORDER BY `id`");
			$query->execute();
			return $query->fetchAll();
		}

		public static function get_streams($filter){
			require_once('database.php');
			$sql =
				"SELECT stats.league_number, stats.summoner_name, stream.channel_display_name, stream.channel_name, stream.channel_status, stream.game, stream.preview_medium, stream.viewers, MAX(stats.votes)
				FROM stream
				LEFT JOIN stats ON stats.channel_name = stream.channel_name
				WHERE";

			if($filter['champions']) {
				$sql .= " champions IN (?)";
			}

			if($filter['games']) {
				$sql .= " games IN (?)";
			}

			if($filter['leagues']) {
				$sql .= " leagues IN (?)";
			}

			$sql .=
				"ORDER BY stream.viewers DESC
				GROUP BY stream.channel_name
				OFFSET {$filter['offset']}
				LIMIT 48";

			$query = $db->prepare($sql);

			$query->bindParam(1, $filter['champions']);
			$query->bindParam(2, $filter['games']);
			$query->bindParam(3, $filter['leagues']);
			$query->execute();
			return $query->fetchAll();
		}

		public static function top_games(){
			require_once('database.php');
			$query = $db->prepare("SELECT * FROM stream_top_game ORDER BY views DESC");
			$query->execute();
			return $query->fetchAll();
		}
	}