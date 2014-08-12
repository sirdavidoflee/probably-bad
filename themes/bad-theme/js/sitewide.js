(function($) {

	var SITE = {
	
	/* Globals Variables
	=============================================*/	
	scrollPos: null,
	homeNavPos: null,


	/* Methods
	=============================================*/	
		init: function(){
			
			if($('body').hasClass('home') && $(window).width() > 650){
				// NOTE: Uncomment this for phase 2
				$('body.home header').addClass('hidden');
				SITE.home_nav();
			}
			SITE.on_submit();
			
			// function repeatOften() {
			//   // Do whatever
			//   console.log('cat');
			//   requestAnimationFrame(repeatOften);
			// }
			// requestAnimationFrame(repeatOften);
			$('body').on({'touchmove': function(e) { 
				SITE.scrollPos = $(window).scrollTop();
				SITE.homeNavPos = $('.page-hero li.plan h2').offset().top - 65;
					//console.log($(this).scrollTop()); // Replace this with your code.
					//console.log(1);
					// if(SITE.scrollPos <= SITE.homeNavPos){
					//	 //console.log('past');
					//	 $('body.home header').addClass('hidden');
					// }
					SITE.on_scroll();
				}
			});
			
			SITE.mobile_nav();
			SITE.analytics();
			
		},
		home_nav: function(){
			$(window).resize(function(){
				//console.log(SITE.scrollPos, SITE.homeNavPos);
				if($(window).width() > 650 && SITE.scrollPos <= SITE.homeNavPos){
					$('body.home header').addClass('hidden');
				} else {
					$('body.home header').removeClass('hidden');
				}
			});
			
			$(window).scroll(function(){
				SITE.on_scroll();
			});
		},
		mobile_nav: function(){
			$('.mobile-menu').click(function(){
				if($(this).hasClass('open')){
					$('html').removeClass('disabled').css('height', 'auto');
					$(this).removeClass('open');
					$('.mobile-nav').css('right', '-75%');
					$('.mobile-no-nav').css('right', '-75%');
				} else {
					$('html').addClass('disabled');
					$('.coastline').css('height', $(document).outerHeight(true));
					$(this).addClass('open');
					$('.mobile-nav').css('right', '0%');
					$('.mobile-no-nav').css('right', '70%');
				}
				return false;
			});
			$('.mobile-no-nav').click(function(){
				$('html').removeClass('disabled').css('height', 'auto');
				$('.mobile-menu').removeClass('open');
				$('.mobile-nav').css('right', '-75%');
				$('.mobile-no-nav').css('right', '-75%');
			});
		},
		on_scroll: function() {
			SITE.scrollPos = $(window).scrollTop();
			SITE.homeNavPos = $('.page-hero li.plan h2').offset().top - 65;
			
			if(SITE.scrollPos >= SITE.homeNavPos) {
				$('header').removeClass('hidden');
				$('header').css('height', '70px');
			} else {
				$('header').addClass('hidden');
				$('header').css('height', '100px');
			}
		},
		on_submit: function() {
			
			//callback handler for form submit
			$('.submit-btn').click(function(){
				var firstName = $('#firstName');
				var lastName = $('#lastName');
				var email = $('#email');
				linkoff = $('.post-submit a').prop('href');
				
				if(firstName.val() && lastName.val() && email.val()){
					$('.post-submit a').attr('href', linkoff + '?firstName=' + firstName.val() + '&lastName=' + lastName.val() + '&email=' + email.val());
					ga('send', 'event', 'Sign Up Here', 'Button Click', 'Signup');
				}
			});
			
			// $("#newsletterSignup").submit(function(e){
			// 	$.cookie("test", 1);
			//
			//
			// 	ga('send', 'event', 'Sign Up Here', 'Button Click', 'Signup');
			//
			// 	var postData = $(this).serializeArray();
			// 	var formURL = $(this).attr("action");
			// 	$.ajax({
			// 		url : formURL,
			// 		type: "POST",
			// 		data : postData,
			// 		success:function(data, textStatus, jqXHR)
			// 		{
			// 			//data: return data from server
			// 			var height = $('.sign-up').outerHeight(true);
			// 			$('.sign-up').css('height', height);
			// 			$('.sign-up form, .sign-up .pre-submit').fadeOut(500, function(){
			// 				$('.sign-up .post-submit').fadeIn(500);
			// 				var newHeight = $('.sign-up .info').outerHeight(true);
			// 				$('.sign-up').animate({
			// 					height: newHeight
			// 				}, 500);
			// 			});
			// 		},
			// 		error: function(jqXHR, textStatus, errorThrown)
			// 		{
			// 			//if fails
			// 		}
			// 	});
			// 	return false;
			// });
			
			$('#external-newsletter input.submit-btn').click(function(){
				ga('send', 'event', 'Business Solutions Sign Up Here', 'Button Click', 'Signup2');
			});
			
			$('#moreInfoSubmit').submit(function(e){
				ga('send', 'event', 'Business Solutions Sign Up Here', 'Button Click', 'Signup2');
				
				// put more code here when we have it from vendor
			});
			
		},
		analytics: function() {
			
			$('.business-link').click(function(){
				ga('send', 'event', 'Link-off', 'Click', 'Go to USC');
			});
			
			$('.social-outlets a, header .social-share a').click(function(){
				var socialName = $(this).parent().prop('class');
				switch(socialName){
					case 'twitter':
						socialName = 'Twitter';
						break;
					case 'facebook':
						socialName = 'Facebook';
						break;
					case 'google':
						socialName = 'Google +';
						break;
					case 'youtube':
						socialName = 'YouTube';
						break;
				}
				ga('send', 'event', 'Link-off to social property', 'Button Click', socialName);
			});
			
			$('article .social-share a').click(function(){
				var socialName = $(this).parent().prop('class');
				var pageName = $(document).find('title').text();
				pageName = pageName.replace(' | Backing America&#039;s Backbone', '');
				pageName = pageName.replace(" | Backing America's Backbone", "");
				var pageUrl = window.location.href;
				switch(socialName){
					case 'twitter':
						socialName = 'Twitter Share';
						break;
					case 'facebook':
						socialName = 'FB Share';
						break;
					case 'google':
						socialName = 'Google+';
						break;
					case 'youtube':
						socialName = 'YouTube';
						break;
					case 'linkedin':
						socialName = 'LinkedIn';
						break;
					case 'email':
						socialName = 'E-mail';
						break;
				}
				ga('send', 'event', 'Share ' + pageName + ' (' + window.location.href + ')', 'Share', socialName);
			});
			
			
			
			$('.learn-more-links a').click(function(){
				var $type = $(this).parent();
				
				switch($type){
				case 'phone':
					ga('send', 'event', 'Phone Number Click', 'Button Click', 'Call');
					break;
				// case 'store':
				// 	ga('send', 'event', 'Phone Number Click', 'Button Click', 'Call');
				// 	break;
				// case 'online':
				// 	ga('send', 'event', 'Learn More at USC Click', 'Button Click', 'Call');
				// 	break;
				}
			});
			
			$('.podcast a').click(function(){
				ga('send', 'event', 'Listen to Podcast', 'Like', 'Like Story');
			});
			
			$('.rate-article a').click(function(){
				var rating = $(this).prop('class');
				var pageName = $(document).find('title').text();
				pageName = pageName.replace(' | Backing America&#039;s Backbone', '');
				pageName = pageName.replace(" | Backing America's Backbone", "");
				var pageUrl = window.location.href;
				ga('send', 'event', 'Content', rating, pageName + ' (' + window.location.href + ')');
				
				$('.rate-article h4').html('Thank you.');
				$('.rate-article ul').slideUp(500, function(){
					$(this).remove();
				});
				return false;
			});

			$('li.plan a').on('click', function(e) {
				ga('send', 'event', 'Navigation Click', 'Click', 'Plan Pillar');
			});

			$('li.connect a').on('click', function(e) {
				ga('send', 'event', 'Navigation Click', 'Click', 'Connect Pillar');
			});

			$('li.evolve a').on('click', function(e) {
				ga('send', 'event', 'Navigation Click', 'Click', 'Evolve Pillar');
			});

			if($('body').hasClass('search')) {
				var inputValue = $('section.main form input').val();
				if($('body').hasClass('search-no-results')) {
					ga('send', 'event', 'Search Bar Entry', 'No Results', inputValue);
				} else if($('body').hasClass('search-results')) {	
					ga('send', 'event', 'Search Bar Entry', 'Results', inputValue);
				}
			}
		}
	};


	$(function(){
		SITE.init();
	});

})(jQuery);