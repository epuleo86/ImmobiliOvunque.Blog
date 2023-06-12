var currentAutocompleteRequest;
var comuni;
var searchInProgress = false;
var spinner = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" aria-hidden="true"></span>';
var $ = jQuery;
var io_page  = 'BLOG';

function isMobile() {
    return (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i));
}

function initDropdownMenu() {
    if (!isMobile()) {
        (jQuery)('.io-dropdown-menu').each(function () {
            (jQuery)(this).removeClass('show');
            (jQuery)(this).children('.dropdown-menu-dark').removeClass('show');
        });
    }
    else {
        (jQuery)('.io-dropdown-menu').each(function () {
            (jQuery)(this).addClass('show');
            (jQuery)(this).children('.dropdown-menu-dark').addClass('show');
        });
    }
}

jQuery(document).ready(function () {
	(jQuery)('.io-dropdown-menu').mouseenter(function () {
		if (!isMobile()) {
			(jQuery)(this).addClass('show');
			(jQuery)(this).children('.dropdown-menu-dark').addClass('show');
		}
	});

	(jQuery)('.io-dropdown-menu').mouseleave(function () {
		if (!isMobile()) {
			(jQuery)(this).removeClass('show');
			(jQuery)(this).children('.dropdown-menu-dark').removeClass('show');
		}
	});

	(jQuery)(window).on('resize', function () {
		initDropdownMenu();
	});

	initDropdownMenu();
	
	
	(jQuery)('.btn-accept-cookie').click(function () {
        var cookieFondamentali = (jQuery)('#cookieFondamentali').is(":checked") ;
        var cookieStatistici = (jQuery)('#cookieStatistici').is(":checked");
        var cookieMarketing = (jQuery)('#cookieMarketing').is(":checked");

        if (!cookieFondamentali) {
            return;
        }

        setCookie('.AspNet.Consent', 'yes', 180);
        setCookie('cookieconsent_status', 'dismiss');
        setCookie('type1', 1, 180);

        if (cookieStatistici) {
            setCookie('type2', 1, 180);
        }
        else {
            eraseCookie('type2');
        }

        if (cookieMarketing) {
            setCookie('type3', 1, 180);
        }
        else {
            eraseCookie('type3');
        }

        (jQuery)('#cookieConsent').remove();
        (jQuery)('.cookies-overlay').remove();

        fireTrackings();
    });
	
	(jQuery)('.btn-reject-cookie').click(function () {
        setCookie('.AspNet.Consent', 'yes', 180);
        setCookie('cookieconsent_status', 'dismiss', 180);
        setCookie('type1', 1, 180);

        (jQuery)('#cookieConsent').remove();
        (jQuery)('.cookies-overlay').remove();
    });

    if (getCookie('.AspNet.Consent') == 'yes') {
        (jQuery)('#cookieConsent').remove();
        (jQuery)('.cookies-overlay').remove();
        fireTrackings();
    }
	else{
		(jQuery)('#cookieConsent').show();
        (jQuery)('.cookies-overlay').show();
	}
	
	listingLinks();
	ioInitAutocomplete();
	(jQuery)('#btn-cerca').click(search);	
});

function fireTrackings() {
    if (getCookie('.AspNet.Consent') != 'yes') {
        return;
    }

    var cookieStatistici = getCookie('type2') == '1';
    var cookieMarketing = getCookie('type3') == '1';

    if (cookieStatistici) {
        if (gtagId != '') {
            gtag('js', new Date());
            gtag('config', gtagId);
        }
    }

    if (cookieMarketing) {
        if (fbPrixelId != '') {
            fbq('init', fbPrixelId);
            fbq('track', 'PageView');
        }

        if (gadsTagId != '') {
            gtag('js', new Date());
            gtag('config', gadsTagId);
        }
    }
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function ioInitAutocomplete(){
	(jQuery)('#comune').autocomplete({
        delay: 500,
        appendTo: (jQuery)('#comune').parent(),
        source: function (request, response) {
            if (currentAutocompleteRequest != null) {
                currentAutocompleteRequest.abort();
            }

            var searchdata = {
                prefix: request.term,
				includeAliasProv: true,
                includeZone: true
            };

            (jQuery)(".ui-autocomplete").css("z-index", "9999");
            currentAutocompleteRequest = (jQuery).ajax({
                url: 'https://www.immobiliovunque.it/ajax/autocomplete-comuni',
                data: JSON.stringify(searchdata),
                dataType: "json",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    comuni = data;
                    response((jQuery).map(data, function (item) {
                        return { label: item.label, value: item.value };
                    }));
                },
                error: function (response) {

                },
                failure: function (response) {

                }
            });
        },
        select: function (e, ui) {
            (jQuery)("#comune").val(ui.item.label);
            (jQuery)("#comune").attr('seo-alias', ui.item.value);

            return false;
        },
        focus: function (event, ui) {
            return false;
        },
        minLength: 1,
        change: function (event, ui) {
            val = (jQuery)(this).val();
			var exists = 0;

            if (comuni !== undefined) {
                comuni.forEach(function (element) {
                    if (element.label == val) exists = 1;
                });
            }

            if (exists == 0) {
                (jQuery)(this).val("");
                (jQuery)("#comune").attr('seo-alias', '');
                return false;
            }
        }
    });

    (jQuery)('#comune').keydown(function (e) {
        if (e.keyCode == 13 && (jQuery)(this).val().length) {
            search();
        }
    });
	
	var data = sessionStorage.getItem('comune');

    if (data != null) {
        var deserialized = JSON.parse(data);

        (jQuery)("#comune").attr('seo-alias', deserialized.alias);
        (jQuery)("#comune").val(deserialized.comune);
        sessionStorage.removeItem('comune');
    }
}

function search() {
    if (searchInProgress) { return; }

    var comune = (jQuery)("#comune").attr('seo-alias');

    if (comune == undefined || comune.length == 0) {
        (jQuery)("#comune").attr('placeholder', 'Inserire un comune');
        (jQuery)("#comune").addClass('required');
        (jQuery)("#comune").focus();
        return;
    }

    (jQuery)("#comune").removeClass('required');
    (jQuery)("#comune").attr('placeholder', 'COMUNE');

    searchInProgress = true;

    (jQuery)('#btn-cerca').html(spinner);

    var tipologia = (jQuery)("#tipologia").val();
    var contratto = (jQuery)("#contratto").val();

    var uri = "https://www.immobiliovunque.it/" + contratto + "-" + tipologia;

    uri += "/" + comune;
	
	var data = {
        comune: (jQuery)("#comune").val(),
        alias: comune
    };

    sessionStorage.setItem('comune', JSON.stringify(data));

    window.location.href = uri.toLowerCase();
}

function listingLinks(){
	(jQuery)('.post-item a').each(function(){
		var aTag = (jQuery)(this).attr('href');

		var parentDiv = (jQuery)(this).parent().closest('.bg-light');        
		parentDiv.click(function(){
			window.location.href = aTag;
		});
	});
}

function calcolaMutuo() {

	var container = (jQuery)('#modal-cacola-mutuo');

	if (container.length > 0) {
		(jQuery)('#rata-mutuo-box').hide();
		(jQuery)('#valore-mutuo').maskMoney('mask', 0);
		(jQuery)('#valore-mutuo').focus();
		(jQuery)('#modal-cacola-mutuo').modal();
		return;
	}

	(jQuery).ajax({
		url: 'https://www.immobiliovunque.it/ajax/modal-calcola-mutuo/-1',
		contentType: 'application/html; charset=utf-8',
		type: 'GET',
		dataType: 'html',
		success: function (result) {
			(jQuery)(document.body).append(result);
			(jQuery)(".euro-suffix").maskMoney({ thousands: '.', decimal: ',', allowZero: true, suffix: '€' });
			(jQuery)('#modal-cacola-mutuo').modal();
			
			setTimeout(function () {
				(jQuery)('#valore-mutuo').maskMoney('mask', 0);
				(jQuery)('#valore-mutuo').focus();
			}, 500);
		}
	});
}

function formatNumber(n) {
    return String(n).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function richiestaSpecifica() {
    if ((jQuery)('#modal-richiesta-specifica').length) {
        (jQuery)('#modal-richiesta-specifica').modal();
        return;
    }

    (jQuery).ajax({
        url: 'https://www.immobiliovunque.it/ajax/modal-richiesta-specifica',
        contentType: 'application/html; charset=utf-8',
        type: 'GET',
        dataType: 'html',
        success: function (result) {
            (jQuery)(document.body).append(result);

            (jQuery)("#invia-richiesta").click(function () {
                sendRichiestaSpecifica();
            });

            (jQuery)("#req_prezzo").maskMoney({ thousands: '.', decimal: ',', allowZero: true, suffix: '€' });


            (jQuery)('#modal-richiesta-specifica').modal();
        }
    });
}

function setSuperficie(selectorTipologia, selectorSuperficie) {
    var val = (jQuery)(selectorTipologia).val();
    (jQuery)(selectorSuperficie + ' option:not(:first)').remove();

    if (val == 'appartamenti' || val == 'locali-commerciali' || val == '1' || val == '2') {
        (jQuery)('<option>').val('0-30').text('0 - 30 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('30-90').text('30 - 90 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('60-120').text('60 - 120 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('90-150').text('90 - 150 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('120-200').text('120 - 200 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('150-250').text('150 - 250 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('250-500+').text('250 - 500+ m²').appendTo(selectorSuperficie);
    }
    else {
        (jQuery)('<option>').val('0-1000').text('0 - 1.000 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('1000-5000').text('1.000 - 5.000 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('5000-10000').text('5.000 - 10.000 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('10000-25000').text('10.000 - 25.000 m²').appendTo(selectorSuperficie);
        (jQuery)('<option>').val('25000-50000+').text('25.000 - 50.000+ m²').appendTo(selectorSuperficie);
    }
}