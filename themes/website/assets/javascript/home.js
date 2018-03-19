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

    $.fn.checkmenu = function() {
        if($(this).hasClass("fineshed")){
            $(this).addClass("active");
            $(".line-match").show();
            $(".competition-title").hide();
            $(".not-fineshed").hide();
            $(".line-match").each(function() {
                if($(this).is(':visible')) {
                    $(".competition-title[data-id='"+$(this).attr("data-competition-id")+"']").show();
                    $(".competition-title").addClass("has-finesheds");
                }
            });
            //$(".competition-title").not(".has-finesheds").hide();
            if(!$(".competition-title.has-finesheds").length) {
                $(".tab-empty h3").html("Nenhuma partida encerrada até agora.");
                $(".tab-empty").removeClass("hide");
            }
        } else if($(this).hasClass("live")){
            $(this).addClass("active");
            $(".line-match").show();
            $(".competition-title").hide();
            $(".not-live").hide();
            $(".line-match").each(function() {
                if($(this).is(':visible')) {
                    $(".competition-title[data-id='"+$(this).attr("data-competition-id")+"']").show();
                    $(".competition-title").addClass("has-lives");
                }
            });
            //$(".competition-title").not(".has-lives").hide();
            if(!$(".competition-title.has-lives").length) {
                $(".tab-empty h3").html("Nenhuma partida ao vivo nesse momento.");
                $(".tab-empty").removeClass("hide");
            }
        }else if($(this).hasClass("next")){
            $(this).addClass("active");
            $(".line-match").show();
            $(".competition-title").hide();
            $(".started").hide();
            $(".line-match").each(function() {
                if($(this).is(':visible')) {
                    $(".competition-title[data-id='"+$(this).attr("data-competition-id")+"']").show();
                    $(".competition-title").addClass("has-not-starteds");
                }
            });
            //$(".competition-title").not(".has-not-started").hide();
            if(!$(".competition-title.has-not-starteds").length) {
                $(".tab-empty h3").html("Todas as partidas já começaram.");
                $(".tab-empty").removeClass("hide");
            }
        }else {
            $(".competition-title").removeClass("has-finesheds").removeClass("has-lives").removeClass("has-not-starteds");
            $(this).addClass("active");
            $(".not-fineshed").show();
            $(".competition-title").show();
            $(".not-live").show();
            $(".competition-title").show();
        }
    };

    $(".competitions .competition-title img").each(function(){
    	if(!$(this).attr("src").length) $(this).remove();
    });

    $(".menu-home:not(.ismobile)").find(".button:not(.odds)").click(function(){
    	$(".tab-empty").addClass("hide");
    	$(".menu-home .button.active").removeClass("active");
    	$(this).checkmenu();
    });

    $("button[data-click='next-day']").click(function(){
    	//$(this).removeAttr("data-request-data");
        var actualDate = $(".day").val().toString().split("/");
        var adate = new Date();
        var ayear = adate.getFullYear();
        var currentDate = new Date(ayear, (actualDate[1]-1),actualDate[0]);
        var newDate = new Date(currentDate.getTime() + 24 * 60 * 60 * 1000);
        var nyear = newDate.getFullYear();
        var tmonth = newDate.getMonth()+1, nmonth;
        if(tmonth < 10) {
            nmonth = "0"+tmonth;
        }else {
            nmonth = ""+tmonth;
        }
        var tday = newDate.getDate(), nday;
        if(tday < 10) {
            nday = "0"+tday;
        }else {
            nday = ""+tday;
        }
        $(".day").val(nday+"/"+nmonth);

    	//$(this).attr("data-request-data","day: '"+year+"-"+newDate[1]+"-"+newDay+"'");
        $("#competitionsToday").html('<br/><br/><img class="loading" src="themes/website/assets/images/loading.svg" />');
        $.request('onMatchesByDay', {
            data: {day: nyear+"-"+nmonth+"-"+nday},
            update: {competitionsTodayHome: '#competitionsToday'},
            complete: function(data) {
                $('.menu-home .button').each(function() {
                    if($(this).hasClass('active')) {
                        $(this).checkmenu();
                    }
                });
            }
        });
    });

    $("button[data-click='prev-day']").click(function(){
        var actualDate = $(".day").val().toString().split("/");
        var adate = new Date();
        var ayear = adate.getFullYear();
        var currentDate = new Date(ayear, (actualDate[1]-1),actualDate[0]);
        var newDate = new Date(currentDate.getTime() - 24 * 60 * 60 * 1000);
        var nyear = newDate.getFullYear();
        var tmonth = newDate.getMonth()+1, nmonth;
        if(tmonth < 10) {
            nmonth = "0"+tmonth;
        }else {
            nmonth = ""+tmonth;
        }
        var tday = newDate.getDate(), nday;
        if(tday < 10) {
            nday = "0"+tday;
        }else {
            nday = ""+tday;
        }
        $(".day").val(nday+"/"+nmonth);

        //$(this).attr("data-request-data","day: '"+year+"-"+newDate[1]+"-"+newDay+"'");
        $("#competitionsToday").html('<br/><br/><img class="loading" src="themes/website/assets/images/loading.svg" />');
        $.request('onMatchesByDay', {
            data: {day: nyear+"-"+nmonth+"-"+nday},
            update: {competitionsTodayHome: '#competitionsToday'},
            complete: function(data) {
                $('.menu-home .button').each(function() {
                    if($(this).hasClass('active')) {
                        $(this).checkmenu();
                    }
                });
            }
        });
    });
    
    /*$("body").on("click",".competitions .no-link",function() {
    	$("#modalMatchPage").html('<img class="loading" src="themes/website/assets/images/loading.svg" />');
	    $.request('onMatchById', {
	    	data: {id: $(this).attr("data-id")},
	    	update: {matchPageContent: '#modalMatchPage'},
			complete: function() { unifyMatchScores(); }
		});
	});*/

    $('.day').pickadate({
        editable: false,
        today: 'Hoje',
        clear: '',
        close: 'Fechar',
        formatSubmit: 'yyyy-mm-dd',
        format: 'dd/mm',
        monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        weekdaysFull: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
        weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        labelMonthNext: 'Próximo mês',
        labelMonthPrev: 'Mês anterior',
        labelMonthSelect: 'Selecione um mês',
        labelYearSelect: 'Selecione um ano',
        onRender: function(){
            $(".picker__day--outfocus").remove();
        },
        onClose: function() {
            $("button[data-click='next-day']").focus();
        },
        onSet: function(context) {
            $("#competitionsToday").html('<br/><br/><img class="loading" src="themes/website/assets/images/loading.svg" />');
            $.request('onMatchesByDay', {
                data: {day: $("input[name='_submit']").val()},
                update: {competitionsTodayHome: '#competitionsToday'},
                complete: function(data) {
                    $('.menu-home .button').each(function() {
                        if($(this).hasClass('active')) {
                            $(this).checkmenu();
                        }
                    });
                }
            });
        }
    });

    $("body").on('click','.menu-home.match-tabs .button:not(.active,.odds)',function() {
    	$(".menu-home.match-tabs .button.active").removeClass("active");
    	$(this).addClass("active");
    	if(!$(this).hasClass("commentaries"))
    		$("#body-match-page").html('<br/><br/><img class="loading" src="themes/website/assets/images/loading.svg" />');
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
          $(".not-commentaries").hide();
          $(".commentaries-tab").removeClass("hide");
          $(".menu-home.match-tabs.stats-tabs .button").addClass("active");
          $('.match-data').animate({ scrollTop:$('.match-data').position().top + 100}, "slow");
      }
  });

    $("body").on('click','.menu.match-page ul li:not(.active)',function() {
      $(".menu.match-page ul li.active").removeClass("active");
      $(this).addClass("active");
      $("#body-match-page").html('<br/><br/><img class="loading" src="themes/website/assets/images/loading.svg" />');
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
    	$('.match-data').animate({ scrollTop:$('.match-data').position().top + 100 }, "slow");
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
