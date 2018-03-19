jQuery(document).ready(function($){
	$.request('onLoadLastestGames', {
		data: {id: $(".player-lastest-games").attr("data-player-id")},
		update: {playerLatestGames: '#player-lastest-games'}
	});
});
