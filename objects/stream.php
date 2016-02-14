<?php
	class Stream {
		public static function add($data) {
			global $db;
			$query = $db->prepare("INSERT INTO stream (game, channel_name, league, champion) VALUES (:game, :channel_name, :league, :champion)");
			$query->bindParam(':game', $data['game']);
			$query->bindParam(':channel_name', $data['channel_name']);
			$query->bindParam(':league', $data['league']);
			$query->bindParam(':champion', $data['champion']);
			$query->execute();
			return $query->rowCount();
		}

		public static function champions() {
			global $db;
			$query = $db->prepare("SELECT * FROM champion ORDER BY `name`");
			$query->execute();
			return $query->fetchAll();
		}

		public static function leagues() {
			global $db;
			$query = $db->prepare("SELECT * FROM league ORDER BY `id`");
			$query->execute();
			return $query->fetchAll();
		}

		public static function get_streams($filter){
			global $db;
			$sql = <<<SQL
				SELECT channel_name, game, league, champion, c.image
				FROM stream
				JOIN champion c ON c.id = stream.champion
SQL;

			$filtered = false;
			$champions = "";
			$games = "";
			$leagues = "";
			$where = "";

			foreach($filter['champions'] as $champion) {
				$filtered = true;
				$champions .= "'$champion',";
			}

			foreach($filter['games'] as $game) {
				$filtered = true;
				$games .= "'$game',";
			}

			foreach($filter['leagues'] as $league) {
				$filtered = true;
				$leagues .= "'$league',";
			}

			if($filtered) {
				$where = " WHERE";
				if($champions) {
					$champions = rtrim($champions, ',');
					$where .= " champion IN ($champions)";
				}

				if($games) {
					$games = rtrim($games, ',');
					$where .= " game IN ($games)";
				}

				if($leagues) {
					$leagues = rtrim($leagues, ',');
					$where .= " league IN ($leagues)";
				}
			}

			$sql .= <<<SQL
				{$where} GROUP BY stream.channel_name
				ORDER BY stream.channel_name DESC
				LIMIT 48
				OFFSET {$filter['offset']}
SQL;

			$query = $db->prepare($sql);

			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function games(){
			global $db;
			$query = $db->prepare("SELECT * FROM stream_top_game ORDER BY viewers DESC");
			$query->execute();
			return $query->fetchAll();
		}
	}