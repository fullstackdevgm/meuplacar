jQuery(document).ready(function($){
  	$("body").on('click','.menu-home.team-tabs .button:not(.active)',function() {
      $(".menu-home.team-tabs .button.active").removeClass("active");
      $(this).addClass("active");
      if(!$(".tab-team-summary").length || (!$(this).hasClass("summary") && !$(this).hasClass("future-matches")))
        $("#body-team-page").html('<br/><br/><img class="loading" src="'+$("body").attr("data-path-loading")+'" />');
      if($(this).hasClass("summary")){
        if($(".tab-team-summary").length) $(".tab-team-summary").removeClass("hide");
        else {
          $.request('onSummaryAndNextMatchesByTeamAndSeason', {
            data: {team_id: $("#body-team-page").attr("data-team-id"), season_id: $("#body-team-page").attr("data-season-id") },
            update: {teamContentSummaryAndNextMatches: '#body-team-page'}
          });
        }
      } else if($(this).hasClass("latest-matches")){
        $.request('onLastMatchesByTeamAndSeason', {
          data: {team_id: $("#body-team-page").attr("data-team-id"), season_id: $("#body-team-page").attr("data-season-id") },
          update: {teamContentLastMatches: '#body-team-page'}
        });
      } else if($(this).hasClass("future-matches")){
        if($(".tab-team-summary.next-matches").length){
            $(".tab-team-summary").addClass("hide");
            $(".tab-team-summary.next-matches").removeClass("hide");
        } else {
            $.request('onSummaryAndNextMatchesByTeamAndSeason', {
              data: {team_id: $("#body-team-page").attr("data-team-id"), season_id: $("#body-team-page").attr("data-season-id") },
              update: {teamContentSummaryAndNextMatches: '#body-team-page'}
            });
        }
      } else if($(this).hasClass("classifications")){
          $.request('onClassificationBySeason', {
            data: { season_id: $("#body-team-page").attr("data-season-id") },
            update: {teamContentClassifications: '#body-team-page'},
            complete: function() {
              $(".line-team-classification[data-team-id='"+$("#body-team-page").attr("data-team-id") +"']").css("background-color","#ccc");
            }
          });
      } else if($(this).hasClass("team")){
          $.request('onPlayerByTeam', {
            data: { team_id: $("#body-team-page").attr("data-team-id") },
            update: {teamContentPlayers: '#body-team-page'},
            complete: function() {
              $(".coach_name").html($("#coach_name").html());
            }
          });
      }
    });
});
