jQuery(document).ready(function($) {


	// FIXED HEADER //

	$(window).scroll(function(){
		$('#site-header-fixed:not(.keep-show)').toggleClass('show', $(window).scrollTop() >= 50);
	});


	// NEWSLETTER //

	$('#newsletter-email').on('keypress', function(e){
		if (e.keyCode == 13)
			$('#subscribe-newsletter').click();
	});

	$('#subscribe-newsletter').click(function() {
	    var email = $('#newsletter-email').val();
	    $.ajax({
			type: "POST",
			url: "https://api.entourage.social/api/v1/newsletter_subscriptions",
			data: { "newsletter_subscription": { "email": email, "active": true } },
			success: function(){
				$('.section-newsletter').addClass('success').html('<p>Vous êtes bien inscrit à notre newsletter ! A bientôt :)</p>');
				ga('send', 'event', 'Engagement', 'Newsletter', 'Website');
				fbq('track', 'CompleteRegistration');
			},
			error: function(){
				alert("Nous n'avons pas pu vous ajouter, vérifiez le format de l'email");
			}
	    });
	});


	// MOBILE NAV //

	$('#site-header-nav-mobile').on('click', function(){
		$('html').toggleClass('nav-open');
	});

});
