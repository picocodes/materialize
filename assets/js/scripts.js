(function ($) {
	"use strict"

	//Input fields
	$('.hubaga-field')
		.on('focus', function () {
			$(this).addClass('hubaga-is-focused')
		})

		.on('blur', function () {
			$(this).removeClass('hubaga-is-focused')
		})

		.on('keyup', function () {
			if ($(this).val().length === 0) {
				$(this).addClass('hubaga-is-empty');
			} else {
				$(this).removeClass('hubaga-is-empty');
			}
		})

	// Mobile menu
	$('.navbar-collapse').on('click', function (e) {
		e.preventDefault();
		$('#mobile-primary-menu').toggleClass('toggled');
	});

	//Hide menu on click outside
	$(document).on('mouseup', function (e) {
		var menu = $('#mobile-primary-menu');
		if (!menu.is(e.target) && menu.has(e.target).length === 0) {
			menu.removeClass('toggled');
		}
	});

	//Hubaga Plugin JS Begin

	//Extracts ga variables from an element
	var ga_data = function ($el) {
		return {
			'id': $($el).data('product'),
			'name': $($el).data('name'),
			'price': $($el).data('price')
		}
	}

	//Inform google analytics about product impressions
	var $items = [];
	$('.hubaga-buy').each(function (google_product) {
		$items.push(ga_data(this))
	});

	if ($items.length) {
		gtag('event', 'view_item_list', {
			"items": $items
		});
	}

	//Inform google when checkout initiates
	$('.hubaga-buy').on('click', function (e) {
		var that = ga_data(this)
		gtag('event', 'select_content', {
			"content_type": "product",
			"items": [that]
		  });

		  gtag('event', 'begin_checkout', {
			"items": [that],
			"coupon": ""
		  });
	})


	// When a user clicks on the show coupon link...
	$('.hubaga-show-coupon').on('click', function (e) {
		e.preventDefault();
		$(this).closest('form').find('.hubaga-coupon-grid').toggle();
	});

	//Extract coupon ajax  data from the form
	var coupon_data = function (form) {
		return {
			product: form.find('[name="hubaga_buy"]').val(),
			email: form.find('[name="email"]').val(),
			coupon: form.find('.hubaga-coupon-input').val(),
		}
	}

	//Apply a coupon
	var apply_coupon = function (data, form) {
		form.fadeTo(360, 0.5)

		data.action = 'hubaga_apply_coupon';
		data.nonce = i18.nonce;
		var coupon_grid = form.find('.hubaga-coupon-grid');

		//Send an ajax request to apply the coupon
		$.post(i18.ajaxurl, data, function (json) {
			form.fadeTo(360, 1);
			if (json.result == 'success') {

				coupon_grid.hide();
				form.find('.hubaga-order-total').html(json.price);
				coupon_grid.find('.hubaga-coupon-notices').text('');
				form.find('.hubaga-coupon-notice').hide();

				gtag('event', 'checkout_progress', {
					"items": {
						id: data.product,
						price: json.price.substr(1)
					},
					"coupon": data.coupon,
				  });

			} else if (json.result == 'error') {
				coupon_grid.find('.hubaga-coupon-notices').text(json.error);
			} else {
				coupon_grid.find('.hubaga-coupon-notices').text(i18.coupon_error);
			}
		}).fail(function () {
			form.fadeTo(360, 1);
			coupon_grid.find('.hubaga-coupon-notices').text(i18.coupon_error);
		});
	}

	//When a user applies a coupon
	$('.hubaga-coupon-btn').on('click', function (e) {
		e.preventDefault();
		var form = $(this).closest('form'),
			data = coupon_data(form);

		//Make sure a coupon is provided
		if (data.coupon === '') {
			form.find('.hubaga-coupon-notices').text(i18.empty_coupon);
			return;
		}

		//Apply the coupon via ajax
		apply_coupon(data, form)

	});

	//Begin instacheck

	//Whether or not instacheck can be used
	var is_instacheck = function () {
		return $(window).height() > 500 && $(window).width() > 350
	}

	// Prepare the variables needed to start the train
	var checkout = $('.hubaga-instacheck-wrapper'),
		loader = $('.hubaga-loader-wrapper');

	// Init instacheck when a buy button is clicked
	$('.hubaga-buy').on('click', function (e) {

		//Ensure that instacheck is supported
		if (!is_instacheck()) {
			return;
		}

		// Make sure that this is really a buy button
		if ($(this).data('action') != 'hubaga_buy') {
			return;
		}

		// Great! Prevent the default event behaviour
		e.preventDefault();

		// Post data
		var product = $(this).data('product'),
			_link = $(this).attr('href');

		fetchCheckout(product).fail(
			function () {
				window.location = _link;
			}
		);
	});

	/* Helper function to fetch the checkouts */
	var fetchCheckout = function (product, data) {

		if (product) {
			data = {
				nonce: i18.nonce,
				action: 'hubaga_get_checkout',
				fetchedBy: 'instacheck',
				product: product
			}
		}

		// Hide the checkout overlay and display the loader
		$(checkout).hide();
		$(loader).show();

		// Post the data then return a promise
		return $.post(
			i18.ajaxurl,
			data,
			function (html) {

				//If this is JSON....
				if ($.isPlainObject(html)) {
					if (html.action == 'redirect') {
						window.location = html.url
					}
				} else {
					var innerCheckout = $(checkout).find('.hubaga-instacheck-overlay');
					$(innerCheckout).html(html);
					appendCloseButton(innerCheckout, checkout);
					updateCheckoutHandlers(innerCheckout);
				}

				$(loader).hide();
				$(checkout).show();
			});
	}

	// Appends a button to el that closes victim when clicked
	var appendCloseButton = function (el, victim) {
		return $('<span class="hubaga-close">&times;</span>')
			.appendTo(el)
			.on('click.pc_close', function (e) {
				e.preventDefault();
				$(victim).hide();
			});
	}

	//Updates checkout event handlers
	var updateCheckoutHandlers = function (el) {

		var form = $(el).find('.hubaga-checkout-form:not(.instacheck_disabled)');

		//Hide on click outside
		$(document)
			.on('mouseup.hubaga-instacheck', function (e) {
				if (!el.is(e.target) && el.has(e.target).length === 0) {
					$(checkout).hide();
				}
			});

		//Handle form submissions
		$(form).on('submit.hubaga-instacheck', function (e) {
			e.preventDefault();
			var data = $(form).serialize() + '&nonce=' + i18.nonce;
			fetchCheckout(null, data).fail(function (data) {
				form.submit();
			});
		});

		// Input field events
		$(form).
		find('.hubaga-field')
			.on('focus', function () {
				$(this).addClass('hubaga-is-focused')
			})

			.on('blur', function () {
				$(this).removeClass('hubaga-is-focused')
			})

			.on('keyup', function () {
				if ($(this).val().length === 0) {
					$(this).addClass('hubaga-is-empty');
				} else {
					$(this).removeClass('hubaga-is-empty');
				}
			})


		//Submit form when a gateway is clicked
		$(form)
			.find('[name="gateway"]')
			.on('change.hubaga-instacheck', function (e) {
				gtag('event', 'set_checkout_option', {
					"checkout_step": 2,
					"checkout_option": "gateway",
					"value": $(form).find('[name="gateway"]').val()
				  });
				$(form).trigger('submit');
			});

		// When a user clicks on the show coupon link...
		$(form)
			.find('.hubaga-show-coupon')
			.on('click.hubaga-instacheck', function (e) {
				e.preventDefault();
				$(this).closest('form').find('.hubaga-coupon-grid').toggle();
			});


		//When a user applies a coupon
		form.find('.hubaga-coupon-btn').on('click', function (e) {

			e.preventDefault();
			var data = coupon_data(form);

			//Make sure a coupon is provided
			if (data.coupon === '') {
				form.find('.hubaga-coupon-notices').text(i18.empty_coupon);
				return;
			}

			//Apply the coupon via ajax
			apply_coupon(data, form)

		});
	}

})(jQuery);