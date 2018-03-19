var host = 'http://meuplacar.com';
function unifyMatchScores() {
	var score_ht, score_ft, i = 0, j = 0;
	$(".ht_score").each(function(){
		score_ht = $(this).html();
		i++; $(this).attr("data-i",i);
	});
	var half_ht = i/2;
	if(half_ht<1) half_ht = 1; else if((half_ht % 2) != 0) half_ht = (half_ht+1).toString().substr(0,1);
	$(".ht_score").html('&nbsp;');
	$(".ht_score[data-i='"+half_ht+"']").html(score_ht);

	$(".ft_score").each(function(){
		score_ft = $(this).html();
		j++; $(this).attr("data-j",j);
	});
	var half_ft = j/2;
	if(half_ft<1) half_ft = 1; else if((half_ft % 2) != 0) half_ft = (half_ft+1).toString().substr(0,1);
	$(".ft_score").html('&nbsp;');
	$(".ft_score[data-j='"+half_ft+"']").html(score_ft);
}
jQuery(document).ready(function($){
    unifyMatchScores();

    $("body").on('click','.menu-home.match-tabs .button:not(.active,.odds)',function() {
    	$(".menu-home.match-tabs .button.active").removeClass("active");
    	$(this).addClass("active");
    	if(!$(this).hasClass("commentaries"))
    		$("#body-match-page").html('<br/><br/><img class="loading" src="'+host+'/themes/website/assets/images/loading.svg" />');
    	if($(this).hasClass("sumary")){
	   		$.request('onMatchById', {
	    		data: {id: $(".match-data").attr("data-id")},
	    		update: {matchPageContentSumary: '#body-match-page'},
	    		complete: function() { unifyMatchScores(); }
	    	});
    	} else if($(this).hasClass("stats")){
	   		$.request('onMatchByIdOnlyStats', {
	    		data: {id: $(".match-data").attr("data-id")},
	    		update: {matchPageContentStats: '#body-match-page'}
	    	});
    	} else if($(this).hasClass("teams")){
	   		$.request('onMatchByIdOnlyLineup', {
	    		data: {id: $(".match-data").attr("data-id")},
	    		update: {matchPageContentTeams: '#body-match-page'}
	    	});
    	} else if($(this).hasClass("commentaries")){
        if($(".commentaries-tab").length){
          $(".not-commentaries").hide();
          $(".commentaries-tab").removeClass("hide");
          $(".menu-home.match-tabs.stats-tabs .button").addClass("active");
          $('.match-data').animate({ scrollTop:$('.match-data').position().top + 100}, "slow");
        } else {
            $("#body-match-page").html('<br/><br/><img class="loading" src="'+host+'/themes/website/assets/images/loading.svg" />');
            $.request('onComentariesByMatchId', {
              data: {id: $(".match-data").attr("data-id")},
              update: {matchPageContentComentaries: '#body-match-page'}
            });
        }
    	}
    });

    $("body").on('click','.menu.match-page ul li:not(.active)',function() {
		$(".menu.match-page ul li.active").removeClass("active");
    	$(this).addClass("active");
    	$("#body-match-page").html('<br/><br/><img class="loading" src="'+host+'/themes/website/assets/images/loading.svg" />');
    	if($(this).hasClass("classifications")){
    		$(".menu-home.match-tabs").hide();
	   		$.request('onStandingsById', {
	    		data: {id: $(".match-data").attr("data-season-id")},
	    		update: {matchPageContentClassifications: '#body-match-page'}
	    	});
    	} else if($(this).hasClass("live-centre")){
    		$.request('onMatchById', {
	    		data: {id: $(".match-data").attr("data-id")},
	    		update: {matchPageContentLiveCentre: '#body-match-page'},
	    		complete: function() {
	    			$(".menu-home.match-tabs").show();
	    			unifyMatchScores();
	    		}
	    	});
    	} else if($(this).hasClass("videos")){
    		$(".menu-home.match-tabs").hide();
    		$.request('onMatchByIdOnlyVideos', {
	    		data: {id: $(".match-data").attr("data-id")},
	    		update: {matchPageContentVideos: '#body-match-page'}
	    	});
    	} else if($(this).hasClass("h2h")){
    		$(".menu-home.match-tabs").hide();
    		$.request('onHead2HeadByTeams', {
	    		data: {home_id: $(".match-data").attr("data-home-team-id"), away_id: $(".match-data").attr("data-away-team-id")},
	    		update: {matchPageContentH2H: '#body-match-page'}
	    	});
    	} else if($(this).hasClass("odds")){
    		$(".menu-home.match-tabs").hide();
    		$.request('onOddsComparisonByMatchId', {
	    		data: {id: $(".match-data").attr("data-id")},
	    		update: {matchPageContentOdds: '#body-match-page'}
	    	});
    	}
    });

    $("body").on('click','.more-comments',function() {
    	$(".menu-home.match-tabs .button.active").removeClass("active");
    	$(".not-commentaries").hide();
    	$(".button.commentaries").removeClass("hide").addClass("active");
    	$(".commentaries-tab").removeClass("hide");
    	$(".menu-home.match-tabs.stats-tabs .button").addClass("active");
    	$('.match-data').animate({ scrollTop:$('.match-data').position().top }, "slow");
    	return false;
    });

    $("body").on('click','.iframeBlocker',function() {
    	$("a[data-lity][data-index='"+$(this).attr("data-index")+"']").trigger("click");
    });

    $("body").on('click','.menu-home .button.odds[data-type]:not(.active)',function() {
    	var type = $(this).attr("data-type");
    	$(".menu-home.match-tabs .button.odds.active").removeClass("active");
    	$(this).addClass("active");
    	$(".competition-title div[data-type]").addClass("hide");
    	$(".competition-title div[data-type='"+type+"']").removeClass("hide");
    	$(".div-line-bookmakers, .div-line-bookmakers div[data-type='bonus']").addClass("hide");
    	$(".div-line-bookmakers[data-type='"+type+"']").removeClass("hide");
    	if(type != 'HT/FT Double')
    		$(".competition-title div[data-type='bonus'], .div-line-bookmakers div[data-type='bonus']").removeClass("hide");
    });

    $("body").on('click','.odds-sort-icon i.fa-sort-asc',function() {
	    var div = $('.odds-lines');
		  div.children().each(function(i,li){ div.prepend(li); });
		  $(this).addClass("fa-sort-desc").removeClass("fa-sort-asc");
	  });

  	$("body").on('click','.odds-sort-icon i.fa-sort-desc',function() {
  	    var div = $('.odds-lines');
  		div.children().each(function(i,li){ div.prepend(li); });
  		$(this).addClass("fa-sort-asc").removeClass("fa-sort-desc");
  	 });
});
