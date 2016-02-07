<?php
	require_once('database.php');
	require_once('objects/stream.php');

	if (isset($_POST['action'])) {
		switch($_POST['action']) {
			case 'get_next_streams':
				$filter = array(
					'champions' => isset($_POST['filter']['champions']) ? $_POST['filter']['champions'] : array(),
					'games' => isset($_POST['filter']['games']) ? $_POST['filter']['games'] : array(),
					'leagues' => isset($_POST['filter']['leagues']) ? $_POST['filter']['leagues'] : array(),
					'offset' => isset($_POST['offset']) ? $_POST['offset'] : 0
				);
				echo json_encode(Stream::get_streams($filter));
				break;
		}
	}