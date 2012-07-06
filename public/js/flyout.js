$(document).ready(function() {

	$('.options').removeClass('nojs');

	$('.options').click(function() {
		$('.flyout').hide();
		$('.flyout', this).fadeIn();
	});

	$('.flyout ul a').addClass('hidden');

	$('.flyout > ul').children().each(function(i, elem) {
		$(elem).find('a:first').removeClass('hidden');
	});

	$('.flyout .title .close').click(function() {
		$(this).parents('.flyout').fadeOut();

		return false;
	});

	$('.flyout li a').click(function() {
		window.location.href = $(this).attr('href');
	});

	$('.flyout li').hover(function() {
		$('i', this).toggleClass('icon-white');
	}).click(function() {
		var element = $(this);
		var parent = $(this).parent();
		var backButton = $(this).parents('.flyout').find('.back');
		var indexTitle = $(this).parents('.flyout').find('.title span');
		var originalTitle = indexTitle.data('title');

		var updateBackButton = function() {
			if(parent.is('ul')) {
				backButton.css({visibility: 'visible'});
			}
			else {
				backButton.css({visibility: 'hidden'});
			}
		};

		var updateTitle = function() {
			if(parent.is('ul')) {
				indexTitle.html(element.data('title'));
			}
			else {
				indexTitle.html(originalTitle);
			}
		};

		backButton.unbind().click(function() {
			$(this).parents('.flyout').find('ul a').addClass('hidden');

			parent.children().each(function(i, elem) {
				$(elem).find('a:first').removeClass('hidden');
			});

			element = parent.parent();
			parent = parent.parent().parent();

			updateBackButton();
			updateTitle();

			return false;
		});

		if($('ul', this).length > 0) {
			updateBackButton();
			updateTitle();

			parent.find('li > a').addClass('hidden');

			$('ul', this).first().children().each(function(i, elem) {
				$(elem).find('a:first').removeClass('hidden');
			});
		}

		return false;
	});

});