(function( $ ) {
	$( document).ready(function(){

		/* pre-settings (noscript support) hide sidebar if js disabled - rewrite css rules */
		$( '.mcrblg-sidebar-container' ).hide();
		$( '.mcrblg-sidebar-container-normal' ).show();
		$( '.mcrblg-searchform-container' ).hide();
		$( '.mcrblg-latest-posts' ).show();
		$( '.mcrblg-searchsubmit' ).hide();
		$( '.mcrblg-search-button' ).show();

		/*styles to mobile or normal sidebar*/
		if ( '666' < $( window ).width() ) {
			$( '.mcrblg-fixed' ).addClass( 'mcrblg-fullheight-sidebar' );
		}
		else{
			$( '.mcrblg-fixed' ).addClass( 'mcrblg-fullwidth-sidebar' );
			$( '#mcrblg_close_button' ).click();
			/*setup sidebar size*/
			$( '.mcrblg-fullwidth-sidebar' ).height(function () {
				var sidebarsize = $( '.mcrblg-customize-header' ).height();
				if ( sidebarsize > 50 ) {
					$( '.mcrblg-header-image' ).css( 'margin-top', 40 + sidebarsize + 'px' );
					return sidebarsize + 30;
				}
				return 100;
			});
		}

		/*hide navigation if nav link not exists*/
		if ( ! $( '.mcrblg-next-post-button > a, .mcrblg-previous-post-button > a' ).length ){
			$( '.mcrblg-nav-container' ).hide();
		}
	  /*end pre-settings*/

		var template_url = microblog_localization.mcrblg_template_url; /*get teplate url*/

		/*hide searchform on click non-focus. check for cursor leave searchbutton.*/
		$( '.mcrblg-shadow-box' ).on( 'mouseenter mouseleave', function() {
					$( this ).toggleClass( 'hover' );
				}
		);

		$( document ).click(function( event ) {

			/*hide serchform on click out*/
			if ( ! $( '.mcrblg-shadow-box' ).hasClass( 'hover' ) ) {
				$( '.mcrblg-searchform-container' ).hide();
				$( '.mcrblg-latest-posts' ).show();
				$( '.mcrblg-search-button' ).show();
				$( '.mcrblg-searchsubmit' ).removeClass( 'mcrblg-inline-block' );
			}
			/*end hide serchform*/

			/*hide sidebar on click in content*/
			if ( $( event.target ).closest( ".mcrblg-fixed" ).length){
				return(event);
			}
			else{
				$( '#mcrblg_close_button' ).click();
				event.stopPropagation();
			}
		});

		/*disable body scroll on IE if sidebar hovered, show lines on header*/
		if ( $.browser.msie  && parseInt($.browser.version, 10) === 7 ){

			/*show headers lines*/
			$( '.mcrblg-ie-hr' ).removeClass( 'mcrblg-display-none' );
			$( '.mcrblg-head-content' ).removeClass( 'mcrblg-disable-overflow' );
			$( '.mcrblg-shadow-box' ).removeClass( 'mcrblg-disable-overflow' );

			/*disable scroll*/
			$( '.mcrblg-fixed' ).on( 'mouseenter', function(){
				$( 'html, body' ).addClass( 'mcrblg-disable-overflow' );
			});

			/*enable scroll*/
			$( '.mcrblg-fixed' ).on( 'mouseleave', function(){
				$( 'html, body' ).removeClass( 'mcrblg-disable-overflow' );
			});
		}
		else{

			/*enable styler in non-IE browsers*/
			$( '.mcrblg-widget-container select' ).styler({
				singleSelectzIndex: '2',
				onSelectOpened: function() {
					$( '.jq-selectbox__select' ).addClass( 'mcrblg-disable-bottom-radius' ); /*change border if select opened*/
				},
				onSelectClosed: function() {
					$( '.jq-selectbox__select' ).removeClass( 'mcrblg-disable-bottom-radius' ); /*add border if select closed*/
				}
			});
		}

		/*show sidebar on menu button click*/
		$( '#mcrblg_menu_button' ).click(function () {
			$( '.mcrblg-sidebar-container-normal' ).hide();
			$( '.mcrblg-sidebar-container' ).show();
			$( '.mcrblg-userinfo' ).addClass( 'mcrblg-zindex5' );

			/*mobile version*/
			if ( $( '.mcrblg-fixed' ).hasClass( 'mcrblg-fullwidth-sidebar' ) ) {
				$( '.mcrblg-fixed' ).removeClass( 'mcrblg-fullwidth-sidebar' ).addClass( 'mcrblg-fullwidth-open-sidebar' );
				$( '.mcrblg-content-container').hide();
				$( '.mcrblg-userinfo' ).show();
			}
		});
		/*end show sidebar*/

		/*close sidebar. close button action*/
		$( '#mcrblg_close_button' ).click(function close() {
			$( '.mcrblg-sidebar-container' ).hide();
			$( '.mcrblg-sidebar-container-normal' ).show();
			$( '.mcrblg-userinfo' ).removeClass( 'mcrblg-zindex5' );

			/*mobile sidebar*/
			if ( $( '.mcrblg-fixed').hasClass( 'mcrblg-fullwidth-open-sidebar' ) ) {
				$( '.mcrblg-fixed').removeClass( 'mcrblg-fullwidth-open-sidebar' ).addClass( 'mcrblg-fullwidth-sidebar' );
				$( '.mcrblg-content-container').show();
				$( '.mcrblg-userinfo' ).hide();
			}
		});
		/*end close sidebar*/

		/*show searchform on click search button*/
		$( '.mcrblg-search-button' ).click(function () {
			$ ( '.mcrblg-search-button' ).hide();
			$( '.mcrblg-latest-posts' ).hide();
			$( '.mcrblg-searchform-container' ).show();
			/*placeholder is translation-ready*/
			if( $.browser.msie && $( '#s' ).val() == '' ){
				$( '#s' ).val( microblog_localization.placeholder_string );
			}
			else{
				$( '#s' ).attr( 'placeholder' , microblog_localization.placeholder_string );
			}
			$( '.mcrblg-searchsubmit' ).addClass( 'mcrblg-inline-block' );
		});
		/*end show searchform*/

		/*remove placeholder*/
		$( '#s' ).click(function () {
			var placeholder = $( '#s' );
			if ( placeholder.val() == microblog_localization.placeholder_string ) {
				placeholder.val( '' );
			}
		});
		/*end remove placeholder*/

		/*styles for couners on categories, tags, menu in sidebar find and wrap counters in categories widget*/
		var classnames = $( "[class ~= 'cat-item']" );

		/*declare variables to cycles*/
		var i, max;
		for ( i = 0, max = classnames.length; i < max; i++ ) {
			var outer = classnames[i].outerHTML.split( "(" );
			if ( outer[1] != undefined ) {
				var count = parseInt( outer[1] );
				classnames[i].outerHTML = outer[0].split( "</a>" )[0] + "<span class='mcrblg-count-categories'>" + count + "</span></a>";
			}
		}

		/*find and wrap counters on tagcloud widget. add li to this widget*/
		var tagnames = $( "[class *= 'tag-link-']" );

		for ( i = 0, max = tagnames.length ; i < max; i++ ) {
			var inner = tagnames[i].innerHTML;
			var count_tags = parseInt( tagnames[i].getAttribute( 'title' ) );
			tagnames[i].innerHTML = inner + "<span class='mcrblg-count-categories'> " + count_tags + "</span>";
			tagnames[i].removeAttribute( 'class' );
			$( tagnames[i] ).css({ 'font-size':'' });
			tagnames [i].outerHTML = '<li class="cat-item tags">' + tagnames [i].outerHTML + '</li>';
		}

		$( '.tagcloud' ).html(function(){return '<ul>' + $ ( this ).html() + '</ul>';});

		var menuItem = $( "[class *= 'menu-'] a" );	/*add points to menu items*/

		for ( i = 0, max = menuItem.length; i < max; i++ ) {
			inner = menuItem[i].innerHTML;
			inner = inner.split( '</a>' );
			if ( menuItem[i].getAttribute( 'href' ) == document.location.href){
				inner += '<span class="mcrblg-menu-pointer" style="display:inline;">&#9679</span></a>'	/*add style to change color current menu item point*/
			}
			inner += '<span class="mcrblg-menu-pointer">&#9679</span></a>'
			menuItem[i].innerHTML = inner;
		}
		/*end styles for counters on categories, tags, menu in sidebar*/

		/*point on menu item change color on hover*/
		menuItem.hover( function(){
					$( this ).children().addClass( 'mcrblg-white' );
		},
			function(){
					$( this ).children().removeClass( 'mcrblg-white' );
			}
		);
		/*end change color for menu-item point*/

		/*add class to archives*/
		$( '.mcrblg-archives-link' ).parent().parent().parent().html(function(){
			var output  = $( this ).html();
			output = output.replace( '<ul>','<div class="mcrblg-archives-list"><ul>' );
			output = output.replace( '</ul>','</ul></div>' );
			return output;
		});

		/*add icon to archives itile*/
		$( '.mcrblg-archives-list' ).parent().children().first().html( function(){
			return '<img class="mcrblg-archives-icon" src="' + template_url + '/images/archives_icon.png"></img>' + $( this ).html();
		});

		/*apply rules to hover counters*/
		$( " [class ~= 'cat-item'] a, .mcrblg-archives-list a" ).hover(function () {
			var current = $( this ).children()[0];
			$( current ).addClass( 'mcrblg-hover-counter' );
		}, function () {
			var current = $( this ).children()[0];
			$( current ).removeClass( 'mcrblg-hover-counter' );
		});

		/*fix displayed header shadow in IE, disable -ms-clear*/
		if ( !!navigator.userAgent.match( /Trident\/7\./ ) || ( $.browser.msie ) ) {
			$( 'head' ).append( '<style>input::-ms-clear {display: none; }</style>' );
			$( '.mcrblg-shadow-box').addClass( 'mcrblg-ie-shadow' );
		}

		/*settings for PIE*/
		if ( ( $.browser.msie && $.browser.version == '7.0'  ) || ( $.browser.msie && $.browser.version == '8.0' ) ) {
			$( '.mcrblg-count-categories' ).addClass( 'mcrblg-ie-counters' );
			$( '.avatar' ).css({
				'behavior': 'url( /wp-content/themes/microblog/js/pie/PIE.htc )',
				'top':'0px'
			});
			$( '.mcrblg-searchsubmit' ).css({
				'behavior': 'url( /wp-content/themes/microblog/js/pie/PIE.htc )',
				'display': 'block'
			});
		}

		if ( '8.0' == $.browser.msie && $.browser.version ) {
			$( ".mcrblg-count-categories, .mcrblg-content-container > hr" ).css({
				'behavior': 'url( /wp-content/themes/microblog/js/pie/PIE.htc )'
			});
		}

		/*mobile sidebar on resize*/
		$( window ).resize(function () {

			/*styles to mobile or normal sidebar*/
			if ( '666' < $( window ).width() ) {
				$( '.mcrblg-fullwidth-sidebar').css( 'height', '' );
				$( '.mcrblg-header-image' ).css( 'margin-top', '' );
				$( '.mcrblg-fixed' ).removeClass( 'mcrblg-fullwidth-sidebar' ).addClass( 'mcrblg-fullheight-sidebar' );
			}
			else{
				$( '.mcrblg-fixed' ).removeClass( 'mcrblg-fullheight-sidebar' ).addClass( 'mcrblg-fullwidth-sidebar' );
				/*close sidebar if resize window*/
				$( '#mcrblg_close_button' ).click();
				/*setup sidebar size*/
				$( '.mcrblg-fullwidth-sidebar' ).height(function () {
					var sidebarsize = $( '.mcrblg-customize-header' ).height();
					if ( sidebarsize > 50 ) {
						$( '.mcrblg-header-image' ).css( 'margin-top', 40 + sidebarsize + 'px' );
						return sidebarsize + 30;
					}
					return 100;
				});
			}
		});

		/*few additional rules*/
		if ( $( '.mcrblg-content-container > hr' ) ){

			/*remove last hr in content container*/
			$( '.mcrblg-content-container > hr' ).last().remove();
		}

		/*wrap rsswidget as widget*/
		if( $( '.rsswidget' ) ){
			$( '.rsswidget' ).parent().parent().wrapAll('<div class="mcrblg-widget-container"></div>');
		}

		/*show all social button in one line*/
		$( '.fcbk_share, .gglplsn_share, .twttr_button' ).addClass( 'social_button' );

		 $( '.social_button' ).next().html(function(){

			 /*add clear both after block of social buttons*/
			 if ( ! $(this).hasClass( 'social_button' )){
				 $( this ).before('<div class="mcrblg-block-div" style="clear: both"></div>');
			 }
		 });
	});
})( jQuery );
