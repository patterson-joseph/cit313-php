<?php
	require_once('objects/stream.php');

	if (isset($_POST['action'])) {
		switch($_POST['action']) {
			case 'get_next_streams':
				$filter = array(
					'champions' => isset($_POST['champions']) ? $_POST['champions'] : false,
					'games' => isset($_POST['games']) ? $_POST['games'] : false,
					'leagues' => isset($_POST['leagues']) ? $_POST['leagues'] : false,
					'offset' => isset($_POST['offset']) ? $_POST['offset'] : 0
				);
				Stream::get_streams($filter);
				break;
		}
	}