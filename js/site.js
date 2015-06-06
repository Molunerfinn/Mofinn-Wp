jQuery(document).ready(function($) {
	// eliminating the 300ms tap delay
	FastClick.attach(document.body);
	
	var $mobileMenuContainer = $('.mobile-menu-container'),
		$mobileMenu = $('.mobile-menu'),
		$mobileSearchContainer = $('.mobile-search-container');
		
	$('.nav-toggle').on('click', function(e) {
		e.preventDefault();
		if($mobileSearchContainer.hasClass('active')) {
			$mobileSearchContainer.removeClass('active');
			$mobileSearchContainer.velocity("slideUp", { display: "none", duration: 200 });
		}
		if($mobileMenuContainer.hasClass('active')) {
			$mobileMenuContainer.removeClass('active');
			$mobileMenuContainer.velocity("slideUp", { display: "none", duration: 200 });
		} else {
			$mobileMenuContainer.addClass('active');
			$mobileMenuContainer.velocity("slideDown", { display: "block", duration: 200 });
		}
	});

	$('.mobile-menu li.hasSubMenu > a').on('click', function(e) {
		e.preventDefault();
		var $subMenu = $(this).parent().find(' > ul');
		if($subMenu.hasClass('active')) {
			$subMenu.removeClass('active');
			$subMenu.velocity("slideUp", { display: "none", duration: 200 });
		} else {
			$subMenu.addClass('active');
			$subMenu.velocity("slideDown", { display: "block", duration: 200 });
		}
	});

	$('.mobile-search-toggle').on('click', function(e) {
		e.preventDefault();
		if($mobileMenuContainer.hasClass('active')) {
			$mobileMenuContainer.removeClass('active');
			$mobileMenuContainer.velocity("slideUp", { display: "none", duration: 200 });
		}
		if($mobileSearchContainer.hasClass('active')) {
			$mobileSearchContainer.removeClass('active');
			$mobileSearchContainer.velocity("slideUp", { display: "none", duration: 200 });
		} else {
			$mobileSearchContainer.addClass('active');
			$mobileSearchContainer.velocity("slideDown", { 
				display: "block", 
				duration: 200,
				complete: function() {
					$('.mobile-search-container #s').focus();
				} 
			});
		}
	});

	/*= Tab posts list widget */
	$('.widget_stream-list').each(function(e) {
		var $links = $(this).find('#filter-toggle-buttons a'),
			$childs = $(this).find('#filter-toggle-buttons li'),
			$tabs = $(this).find('.tab_content');

			$tabs.hide();
			$childs.first().addClass('active');
			firsttab = $links.first().attr('href');
			$(firsttab).show();

		$links.on('click', function(e) {
			e.preventDefault();
			
			$childs.removeClass('active');
			$tabs.hide();
			tab = $(this).attr('href');
			$(this).closest('li').addClass('active');
			$(tab).show();
		});
	});
 	
 	$('.secondary-toggle').on('click', function(event) {
 		event.preventDefault();
 		var $sidebar = $('#secondary.right-column'),
 		    $icon = $(this).find('i');
 		if($sidebar.hasClass('expand')) {
 			$sidebar.removeClass('expand');
 			$icon.removeClass('fa-angle-right').addClass('icon-angle-left');
 		} else {
 			$sidebar.addClass('expand');
 			$icon.removeClass('fa-angle-left').addClass('icon-angle-right');
 		}
 	});

 	// main content min height
 	function update_minheight() {
 		$('.site-content').css({
 			"min-height": $(window).height()
 		});
 	}
 	update_minheight();
 	$(window).resize(function(event) {
 		update_minheight();
 	});
});

// Stay standalone
(function(document,navigator,standalone) {
    // prevents links from apps from oppening in mobile safari
    // this javascript must be the first script in your <head>
    if ((standalone in navigator) && navigator[standalone]) {
        var curnode, location=document.location, stop=/^(a|html)$/i;
        document.addEventListener('click', function(e) {
            curnode=e.target;
            while (!(stop).test(curnode.nodeName)) {
                curnode=curnode.parentNode;
            }
            // Condidions to do this only on links to your own app
            // if you want all links, use if('href' in curnode) instead.
            if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
                e.preventDefault();
                location.href = curnode.href;
            }
        },false);
    }
})(document,window.navigator,'standalone');
