<?php
	// Check if they are logged in


	$current_page = "streams";
	require_once("header.php");
	require_once("objects/stream.php");

	$games = Stream::games();
	$leagues = Stream::leagues();
	$champions = Stream::champions();

	$game_html = '';
	foreach($games as $game) {
		$game_html .= <<<HTML
			<select value="{$game->name}">{$game->name}</select>
HTML;
	}

	$league_html = '';
	foreach($leagues as $league) {
		$league_html .= <<<HTML
				<select value="{$league->tier}">{$game->tier}</select>
HTML;
	}

	$champion_html = '';
	foreach($champions as $champion) {
		$champion_html .= <<<HTML
				<select value="{$champion->name}">{$champion->name}</select>
HTML;
	}

	//Form to add a new stream
	echo <<<HTML
	<form>
		<label for="channel_name">Channel Name</label>
		<input type="text" name="channel_name" id="channel_name"/>
		<label for="game">Game</label>
		<option name="game" id="game">
			{$game_html}
		</option>
		<label for="league">League</label>
		<option name="league" id="league">
			{$league_html}
		</option>
		<label for="champion">Champion</label>
		<option name="champion" id="champion">
			{$champion_html}
		</option>
		<input type="submit" value="Add Stream"/>
	</form>
HTML;
