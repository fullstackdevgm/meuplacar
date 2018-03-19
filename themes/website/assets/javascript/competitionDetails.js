jQuery(document).ready(function($){
   
	$("body").on('click','.menu-home.competition-tabs .button:not(.active)',function() {
    	$(".menu-home.competition-tabs .button.active").removeClass("active");
    	$(this).addClass("active");
    	if($("#body-competition-page").attr("data-tab-actual") != 'summary' && $("#body-competition-page").attr("data-tab-actual") != 'classification'){
    		$("#body-competition-page").html('<br/><br/><img class="loading" src="'+$("body").attr("data-path-loading")+'" />');
	    	if($(this).hasClass("summary")){
		   		$.request('onSummaryAndClassificationBySeason', {
		    		data: {id: $("#body-competition-page").attr("data-season-id")},
		    		update: {competitionContentSummaryAndClassification: '#body-competition-page'},
		    		complete: function() { $("#body-competition-page").attr("data-tab-actual","summary"); }
		    	});
	    	} else if($(this).hasClass("classification")){
		   		$.request('onSummaryAndClassificationBySeason', {
		    		data: {id:  $("#body-competition-page").attr("data-season-id")},
		    		update: {competitionContentSummaryAndClassification: '#body-competition-page'},
		    		complete: function() { 
		    			$("#body-competition-page").attr("data-tab-actual","classification");
		    			$(".tab-competition-summary").addClass("hide");
		    			$(".tab-competition-classification").removeClass("hide");
		    		}
		    	});
	    	} else if($(this).hasClass("games")){
		   		$.request('onGamesBySeason', {
		    		data: {id: $("#body-competition-page").attr("data-season-id")},
		    		update: {competitionContentGamesBySeason: '#body-competition-page'},
		    		complete: function() { $("#body-competition-page").attr("data-tab-actual","games"); }
		    	});
	    	} else if($(this).hasClass("topscorers")){
    			$.request('onTopScorersBySeason', {
					data: {id: $("#body-competition-page").attr("data-season-id")},
				   	update: {competitionContentTopScorersBySeason: '#body-competition-page'},
				});   			
    		}
    	} else {
    		if($(this).hasClass("summary")){
    			$("#body-competition-page").attr("data-tab-actual","summary");
    			$(".tab-competition-summary").removeClass("hide");
    		} else if($(this).hasClass("classification")){
    			$("#body-competition-page").attr("data-tab-actual","classification");
    			$(".tab-competition-summary").addClass("hide");
		    	$(".tab-competition-classification").removeClass("hide");
    		} else if($(this).hasClass("games")){
    			$("#body-competition-page").attr("data-tab-actual","games");
    			$("#body-competition-page").html('<br/><br/><img class="loading" src="'+$("body").attr("data-path-loading")+'" />');
		     	$.request('onGamesBySeason', {
					data: {id: $("#body-competition-page").attr("data-season-id")},
				   	update: {competitionContentGamesBySeason: '#body-competition-page'},
				   	complete: function() { $("#body-competition-page").attr("data-tab-actual","games"); }
				});   			
    		} else if($(this).hasClass("topscorers")){
    			$("#body-competition-page").html('<br/><br/><img class="loading" src="'+$("body").attr("data-path-loading")+'" />');
		     	$.request('onTopScorersBySeason', {
					data: {id: $("#body-competition-page").attr("data-season-id")},
				   	update: {competitionContentTopScorersBySeason: '#body-competition-page'},
				   	complete: function() { $("#body-competition-page").attr("data-tab-actual","topscorers"); }
				});   			
    		}
    	}
    });
    
    $("body").on('click','.more-matches',function() {
    	$("#body-competition-page").html('<br/><br/><img class="loading" src="'+$("body").attr("data-path-loading")+'" />');
    	$(".menu-home.competition-tabs .button.active").removeClass("active");
    	$(".menu-home.competition-tabs .button.games").addClass("active");
    	$.request('onGamesBySeason', {
			data: {id: $("#body-competition-page").attr("data-season-id")},
		   	update: {competitionContentGamesBySeason: '#body-competition-page'},
		   	complete: function() { $("#body-competition-page").attr("data-tab-actual","games"); }
		});
		return false;
    });

});