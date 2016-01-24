<?php
	$current_page = "assignments";
	require_once("../header.php");

	$results_file_name = 'survey_results.json';
	$survey_results = [];

	if (file_exists($results_file_name)) {
		// Get our results data
		$survey_results = file_get_contents($results_file_name);
		$survey_results = json_decode($survey_results, true);
	}

	// If they submitted the form add their answers here
	if (isset($_POST)) {
		// Mark that they have voted in our session
		session_start();
		$_SESSION['has_voted'] = true;

		if(isset($_POST['socialNetwork'])) {
			if (isset($survey_results['socialNetwork'][$_POST['socialNetwork']])) {
				$survey_results['socialNetwork'][$_POST['socialNetwork']] += 1;
			} else {
				$survey_results['socialNetwork'][$_POST['socialNetwork']] = 1;
			}
		}

		if(isset($_POST['videoStreaming'])) {
			if (isset($survey_results['videoStreaming'][$_POST['videoStreaming']])) {
				$survey_results['videoStreaming'][$_POST['videoStreaming']] += 1;
			} else {
				$survey_results['videoStreaming'][$_POST['videoStreaming']] = 1;
			}
		}

		if(isset($_POST['starWars'])) {
			if (isset($survey_results['starWars'][$_POST['starWars']])) {
				$survey_results['starWars'][$_POST['starWars']] += 1;
			} else {
				$survey_results['starWars'][$_POST['starWars']] = 1;
			}
		}

		if(isset($_POST['newsSource'])) {
			if (isset($survey_results['newsSource'][$_POST['newsSource']])) {
				$survey_results['newsSource'][$_POST['newsSource']] += 1;
			} else {
				$survey_results['newsSource'][$_POST['newsSource']] = 1;
			}
		}

		file_put_contents($results_file_name, json_encode($survey_results));
	}
?>
	<div class="main container">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Favorite Social Network</h3>
				<?php
					if(is_array($survey_results['socialNetwork'])) {
						echo get_results_display($survey_results['socialNetwork']);
					}
				?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Favorite Video Streaming Site</h3>
				<?php
					if(is_array($survey_results['videoStreaming'])) {
						echo get_results_display($survey_results['videoStreaming']);
					}
				?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Favorite Star Wars</h3>
				<?php
					if(is_array($survey_results['starWars'])) {
						echo get_results_display($survey_results['starWars']);
					}
				?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Favorite News Source</h3>
				<?php
					if(is_array($survey_results['newsSource'])) {
						echo get_results_display($survey_results['newsSource']);
					}
				?>
			</div>
		</div>
	</div>
<?php
	require_once("../footer.php");

	function get_results_display($results) {
		// valid style options
		$progress_bar_styles = array('progress-bar-success', 'progress-bar-info', 'progress-bar-warning', 'progress-bar-danger', '');

		// Get total votes so we can calculate percentages
		$total_votes = array_sum($results);

		$results_display = '';

		// Select our style
		$style = 0;

		foreach($results as $key => $value) {
			// Calculate our percentage
			$percentage = round(($value/$total_votes)*100);

			// Add our progress bar
			$results_display .= <<<HTML
				$key
				<div class="progress">
					<div class="progress-bar $progress_bar_styles[$style] progress-bar-striped" role="progressbar" aria-valuenow="$percentage" aria-valuemin="0" aria-valuemax="100" style="width: $percentage%">
						$percentage% ($value votes)
					</div>
				</div>
HTML;
			// Reset our style selector if we have maxed out other wise iterate our selected style
			if($style >= 4) {
				$style = 0;
			} else {
				$style++;
			}
		}

		// Send back our results display for
		return $results_display;
	}