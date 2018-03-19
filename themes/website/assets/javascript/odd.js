var host = 'http://meuplacar.com';
jQuery(document).ready(function($){
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