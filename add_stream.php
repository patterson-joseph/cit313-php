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
			<option value="{$game->name}">{$game->name}</option>
HTML;
	}

	$league_html = '';
	foreach($leagues as $league) {
		$league_html .= <<<HTML
				<option value="{$league->tier}">{$league->tier}</option>
HTML;
	}

	$champion_html = '';
	foreach($champions as $champion) {
		$champion_html .= <<<HTML
				<option value="{$champion->name}">{$champion->name}</option>
HTML;
	}

	//Form to add a new stream
	echo <<<HTML
	<form>
		<div class="form-group">
			<label for="channel_name">Channel Name</label>
			<input type="text" name="channel_name" id="channel_name" class="form-control"/>
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
		<button type="submit" class="btn btn-default">Add Stream</button>
	</form>
HTML;
