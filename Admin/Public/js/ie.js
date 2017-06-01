var ua = navigator.userAgent; 
        var s = "MSIE"; 
        var i = ua.indexOf(s)          
        if (i >= 0) { 
           //获取IE版本号 
            var ver = parseFloat(ua.substr(i + s.length)); 
           // alert("你的浏览器是IE"+ver);
           handleSidebarMenu ();
        } 
        else {
            //其他情况，不是IE 
            // alert("你的浏览器不是IE");
        } 

            function handleSidebarMenu () {
		        $('.page-sidebar').on('click.menu', 'li > a', function (e) {
		                if ($(this).next().hasClass('sub-menu') == false) {
		                    if ($('.btn-navbar').hasClass('collapsed') == false) {
		                        $('.btn-navbar').click();
		                    }
		                    return;
		                }

		                var parent = $(this).parent().parent();

		                parent.children('li.open').children('a').children('.arrow').removeClass('open');
		                parent.children('li.open').children('.sub-menu').slideUp(200);
		                parent.children('li.open').removeClass('open');

		                var sub = $(this).next();
		                if (sub.is(":visible")) {
		                    $('.arrow', $(this)).removeClass("open");
		                    $(this).parent().removeClass("open");
		                    sub.slideUp(200, function () {
		                            handleSidebarAndContentHeight();
		                        });
		                } else {
		                    $('.arrow', $(this)).addClass("open");
		                    $(this).parent().addClass("open");
		                    sub.slideDown(200, function () {
		                            handleSidebarAndContentHeight();
		                        });
		                }
		                e.preventDefault();
		            });

		        
		    }

			function handleSidebarAndContentHeight () {
				var content = $('.page-content');
				var sidebar = $('.page-sidebar');
				var body = $('body');
				var height;

				if (body.hasClass("page-footer-fixed") === true && body.hasClass("page-sidebar-fixed") === false) {
					var available_height = $(window).height() - $('.footer').height();
					if (content.height() <  available_height) {
					content.attr('style', 'min-height:' + available_height + 'px !important');
					}
				} else {
					if (body.hasClass('page-sidebar-fixed')) {
						height = _calculateFixedSidebarViewportHeight();
					} else {
						height = sidebar.height() + 20;
					}
					if (height >= content.height()) {
						content.attr('style', 'min-height:' + height + 'px !important');
					} 
				}          
			}
