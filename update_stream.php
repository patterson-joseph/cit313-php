<?php
	$current_page = "streams";
	require_once("header.php");
	require_once("objects/stream.php");

	$message = '';

	if ($_POST) {
		$result = Stream::update($_POST);

		if ($result) {
			$message = '<div class="alert alert-success" role="alert">Stream updated!</div>';
		} else {
			$message = '<div class="alert alert-danger" role="alert">Problem adding stream...</div>';
		}
	}

	$games = Stream::games();
	$leagues = Stream::leagues();
	$champions = Stream::champions();

	$selected_game = $_GET['game'] || '';
	$selected_champion = $_GET['champion'] || '';
	$selected_league = $_GET['league'] || '';

	$game_html = '';
	foreach($games as $game) {
		$checked = '';
		if($selected_game == $game->name) {
			$checked = ' checked="checked"';
		}
		$game_html .= <<<HTML
			<option value="{$game->name}"{$checked}>{$game->name}</option>
HTML;
	}

	$league_html = '';
	foreach($leagues as $league) {
		$checked = '';
		if($selected_league == $league->id) {
			$checked = ' checked="checked"';
		}

		$league_html .= <<<HTML
				<option value="{$league->id}"{$checked}>{$league->tier} {$league->division}</option>
HTML;
	}

	$champion_html = '';
	foreach($champions as $champion) {
		$checked = '';
		if($selected_champion == $champion->id) {
			$checked = ' checked="checked"';
		}

		$champion_html .= <<<HTML
				<option value="{$champion->id}"{$checked}>{$champion->name}</option>
HTML;
	}

	$channel_name = $_GET['channel_name'] || '';

	//Form to add a new stream
	echo <<<HTML
	{$message}
	<form method="post">
		<div class="form-group">
			<label for="channel_name">Channel Name</label>
			<input type="text" name="channel_name" id="channel_name" class="form-control" value="{$channel_name}"/>
		</div>
		<div class="form-group">
			<label for="game">Game</label>
			<select name="game" id="game" class="form-control">
				{$game_html}
			</select>
		</div>
		<div class="form-group">
			<label for="league">League</label>
			<select name="league" id="league" class="form-control">
				{$league_html}
			</select>
		</div>
		<div class="form-group">
			<label for="champion">Champion</label>
			<select name="champion" id="champion" class="form-control">
				{$champion_html}
			</select>
		</div>
		<input type="hidden" name="update" />
		<button type="submit" class="btn btn-default">Update Stream</button>
	</form>
HTML;
