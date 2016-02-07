<?php
	$current_page = "streams";
	require_once("header.php");
	require_once("objects/stream.php");
?>
<div class="page-content">
	<div class="stream_player col-lg-9">
		<iframe src="http://player.twitch.tv/?channel=<?php echo $_GET['channel_name']; ?>" frameborder="0" scrolling="no" class="twitch_player"></iframe>
			<div class="stream_stats col-lg-12">
				<div class="col-lg-10">
					<h3 class="summoner-name">Summoner Name</h3>
					<div class="stats-container">
					</div>
				</div>
				<div class="col-lg-2">
					<h4>Wrong Summoner?</h4>
					<hr>
					<div class="form-group">
						<label for="region">Region</label>
						<select class="form-control" id="region" name="region">
							<option value="BR">Brazil</option>
							<option value="EUNE">EU Nordic &amp; East</option>
							<option value="EUW">EU West</option>
							<option value="KR">Korea</option>
							<option value="LAN">Latin America North</option>
							<option value="LAS">Latin America South</option>
							<option value="NA" selected="selected">North America</option>
							<option value="OCE">Oceania</option>
							<option value="RU">Russia</option>
							<option value="TR">Turkey</option>
						</select>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="summoner" name="summoner" placeholder="Summoner...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="change-summoner">Go</button>
                        </span>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="stream_chat_column col-lg-3">
		<iframe src="http://www.twitch.tv/<?php echo $_GET['channel_name']; ?>/chat?popout=" frameborder="0" scrolling="no" height="500px" class="stream_chat"></iframe>
	</div>
</div>
<script type="text/javascript">
	$('.twitch_player').height($(window).innerHeight()-326);
	$('.stream_chat').height($(window).innerHeight()-80);

	$( window ).resize(function() {
		$('.twitch_player').height($(window).innerHeight()-326);
		$('.stream_chat').height($(window).innerHeight()-80);
	});
</script>
<?php require_once("footer.php"); ?>