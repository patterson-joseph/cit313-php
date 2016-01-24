<?php
	$current_page = "assignments";
	require_once("../header.php");

	// If they have already voted forward them to the results
	session_start();

	if (isset($_SESSION['has_voted']) and $_SESSION['has_voted']) {
		header('Location: /assignments/php_survey_results');
	}
?>
	<div class="main container">
		<form action="php_survey_results.php" method="post">
			<h3>Favorite Social Network</h3>
			<div class="radio">
				<label>
					<input type="radio" name="socialNetwork" value="Facebook"/>
					Facebook
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="socialNetwork" value="Twitter"/>
					Twitter
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="socialNetwork" value="Instagram"/>
					Instagram
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="socialNetwork" value="LinkedIn"/>
					LinkedIn
				</label>
			</div>
			<h3>Favorite Video Streaming Site</h3>
			<div class="radio">
				<label>
					<input type="radio" name="videoStreaming" value="YouTube">
					YouTube
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="videoStreaming" value="Hulu">
					Hulu
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="videoStreaming" value="Netflix">
					Netflix
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="videoStreaming" value="Twitch.tv">
					Twitch
				</label>
			</div>
			<h3>Favorite Star Wars</h3>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode I">
					Episode I
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode II">
					Episode II
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode III">
					Episode II
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode IV">
					Episode IV
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode V">
					Episode V
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode VI">
					Episode VI
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="starWars" value="Episode VII">
					Episode VII
				</label>
			</div>
			<h3>Favorite News Source</h3>
			<div class="radio">
				<label>
					<input type="radio" name="newsSource" value="CNN">
					CNN
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="newsSource" value="FOX">
					FOX
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="newsSource" value="MSNBC">
					MSNBC
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="newsSource" value="BBC">
					BBC
				</label>
			</div>
			<button type="submit" class="btn btn-primary">Submit Answers</button> -or- <a href="/assignments/php_survey_results">skip to results</a>
		</form>
	</div>
<?php require_once("../footer.php"); ?>