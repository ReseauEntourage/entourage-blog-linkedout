
$(document).ready(function() {

	var paged = 1;

	$(".next-posts-link").on("click", function(e){
		$this = $(this)
		$this.toggleClass("loading");

		paged += 1;

		$.ajax({
  			type: 'GET',
  			url: '/wp-admin/admin-ajax.php',
  			data: {
  				action: 'pagination-load-posts',
  				paged: paged,
  				s: $(this).attr('s'),
  				cat: $(this).attr('s') ? null : $(this).attr('cat')
			},
  			success: function(data){
  				if (data) {
  					$('#posts').append(data);
  					$this.toggleClass("loading");
  				} else {
  					$(".next-posts-link").hide();
  				}
			},
		});
	});

	$("#nav-search").on("keypress", function(e){
		var code = e.keyCode || e.which;
 		if (code != 13) {
 			return;
 		}

		var search = $(this).val();
		if (search.length < 3) {
			return;
		}

		$(".menu-item-object-category.active").toggleClass("active");

		$('#posts').toggleClass("loading");

		$.ajax({
  			type: 'GET',
  			url: '/wp-admin/admin-ajax.php',
  			data: {
  				action: 'search-posts',
  				s: search,
			},
  			success: function(data){
  				if (data) {
  					$('#posts').html(data).toggleClass("loading");
  					$(".next-posts-link").attr('s', search);

  				} else {
  					$('posts').html("no result");
  					$(".next-posts-link").hide();
  				}
			},
		});
	});

	$(".menu-item-object-category").on("click", function(e){
		$(".menu-item-object-category.active").add(this).toggleClass("active");
	});
});
