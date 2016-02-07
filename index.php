<?php
	$current_page = "streams";
	require_once("header.php");
	require_once("stream.php");

	$games = Stream::top_games();
?>
	<div class="main container">
		<div class="page-content">
			<div class="well col-lg-12 streams-filter">
				<div class="col-lg-4">
					<h4>Top Games</h4>
					<ul class="list-group top-games">
						<!--
									<li class="list-group-item checkbox">
										<img src="/img/logo_original.png" height="30"/> All Games
										<label class="pull-right">
											<input type="checkbox" value="all-games" id="all-games">
										</label>
									</li>
						-->
						<?php
						foreach($games as $game) {
							?>
							<li class="list-group-item checkbox">
								<img src="<?=$game->box?>" height="30"/> <?=$game->name?>
								<label class="pull-right">
									<input type="checkbox" class="game" value="<?=$game->name?>" onchange="setGameFilter(this)">
								</label>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-lg-8">
					<div role="tabpanel">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#lol" aria-controls="lol" role="tab" data-toggle="tab">League of Legends</a></li>
						</ul>
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="lol">
								<ul class="list-group leagues col-lg-6">
									<!--
															<li class="list-group-item checkbox">
																<img src="/img/logo_original.png" height="30"/> All Leagues
																<label class="pull-right">
																	<input type="checkbox" value="all-leagues" id="all-leagues">
																</label>
															</li>
									-->
									<?php
									foreach($leagues as $league) {
										?>
										<li class="list-group-item checkbox">
											<img src="/img/league/<?=$league->id?>.png" height="30"/> <?=$league->tier . " " . $league->division?>
											<label class="pull-right">
												<input type="checkbox" value="<?=$league->id?>" onchange="setLeagueFilter(this)">
											</label>
										</li>
									<?php } ?>
								</ul>
								<ul class="list-group champions col-lg-6">
									<!--
															<li class="list-group-item checkbox">
																<img src="/img/logo_original.png" height="30"/> All Champions
																<label class="pull-right">
																	<input type="checkbox" value="all-champions" id="all-champions">
																</label>
															</li>
									-->
									<?php
									foreach($champions as $champion) {
										?>
										<li class="list-group-item checkbox">
											<img src="<?=$champion->image?>" height="30"/> <?=$champion->name?>
											<label class="pull-right">
												<input type="checkbox" value="<?=$champion->id?>" onchange="setChampionFilter(this)">
											</label>
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="streams-list">
			</div>
		</div>
		<script>
			var offset = 0;

			var stream_filter = {};

			var setChampionFilter = function(){
				offset = 0;
				stream_filter.champions = [];

				$('.streams-list').empty();

				$.each($('.champions input:checked'), function(index, champion) {
					stream_filter.champions.push(champion.value);
				});

				getNextStreams();
			}

			var setGameFilter = function(){
				offset = 0;
				stream_filter.games = [];

				$('.streams-list').empty();

				$.each($('.top-games input:checked'), function(index, game) {
					stream_filter.games.push(game.value);
				});

				getNextStreams();
			}

			var setLeagueFilter = function(){
				offset = 0;
				stream_filter.leagues = [];

				$('.streams-list').empty();

				$.each($('.leagues input:checked'), function(index, league) {
					stream_filter.leagues.push(league.value);
				});

				getNextStreams();
			}

			var getNextStreams = function() {
				$.ajax({
					method: "POST",
					url: "/streams/get_next_streams",
					data: { offset: offset, filter: stream_filter }
				}).done(function(data) {
					var streams = JSON.parse(data),
						league = "";

					$.each(streams, function(index, stream){
						if(stream.game == "League of Legends" && stream.league_number) {
							league = '<img src="/img/league/' + stream.league_number + '.png" height="40" class="pull-left" />';
						} else {
							league = "";
						}

						$('.streams-list').append($.parseHTML(
							'<div class="col-lg-2">'+
							'<a href="/stream/twitch/' + stream.channel_name + '"><img src="'+ stream.preview_medium + '" alt="' + stream.channel_status + '" class="stream_list"></a>'+
							'<p class="stream_caption">' + league +
							'<a href="/stream/twitch/' + stream.channel_name + '\">' + stream.channel_status + '</a>'+
							'<br/>'+
							stream.viewers + ' viewers on ' + stream.channel_display_name +
							'</p></div>'
						));
					});
				});
				offset += 48;
			}

			getNextStreams();

			$(window).scroll(function() {
				if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
					getNextStreams();
				}
			});

			$("#all-games").click(function() {
				var total = $("ul.top-games input.game").length;
				$.each($("ul.top-games input.game"), function(index, game) {
					game.checked = $("#all-games").prop('checked');
					console.log(index+1);
					console.log(total);
					if (index+1 == total) {
						getNextStreams();
					}
				});
			});
		</script>
	</div>
<?php require_once("footer.php"); ?>