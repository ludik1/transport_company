/**
 * GLOBAL VARIABLES
 */
var windowWidth = document.body.clientWidth;

/**
 *  EXPANDER MODULE USED IN NEWS
 */
var Expander = (function () {

    var collapsedCSS = {
        height: 62,
        marginBottom: 0
    };
    var COLLAPSED_ACTUALITY_HEIGHT = 125;
    var ANIMATION_SPEED = 200;

    var init = function () {
        $("div.expandable").each(function () {

            var $this = $(this);

			if ($this.height() > COLLAPSED_ACTUALITY_HEIGHT) {
                $this.find(".content").data("height", $this.innerHeight() -  ($this.innerHeight() > 150 ? 60 : 50)).addClass("collapsed").animate(collapsedCSS, ANIMATION_SPEED);
                var expandLink = $("<a/>", {
                    text: "Viac",
                    href: "#",
                    class: "expand metadata flr"
                });
                $this.find('.expand').remove();
                $this.find(".content").after(expandLink);
            }
        });
    };

    var bindEvents = function () {
        $("div.expandable").off("click", "a.expand").on("click", "a.expand", function () {
            var $this = $(this);
            var $content = $this.siblings(".content");
            if ($content.hasClass("collapsed")) {
                $content.animate({
                    height: $content.data("height"),
                    marginBottom: 10
                }, ANIMATION_SPEED).toggleClass("collapsed");
                $this.text("Skryť");
            }
            else {
                $content.animate(collapsedCSS, ANIMATION_SPEED).toggleClass("collapsed");
                $this.text("Viac");
            }
            return false;
        });

        $("#actuality-collapse").on("click", function () {
            $(".expandable .content:not(.collapsed)").each(function () {
                var $this = $(this);
                $this.animate(collapsedCSS, ANIMATION_SPEED).toggleClass("collapsed");
                $this.siblings("a.expand").text("Viac");
            });
            return false;
        });

        $("#actuality-expand").on("click", function () {
            $(".collapsed").each(function () {
                var $this = $(this);
                $this.animate({
                    height: $this.data("height"),
                    marginBottom: 10
                }, ANIMATION_SPEED).toggleClass("collapsed");
                $this.siblings("a.expand").text("Skryť");
            });
            return false;
        });
    }

    return {
        init: init,
        bindEvents: bindEvents
    }
})();


/**
 *  PAGINATOR MODULE
 */
var Paginator = (function () {
    var bindEvents = function () {
        $(".pagination a.ajax").on("click", function () {
            $("body,html").animate({
                scrollTop: $("#content").offset().top
            });
        });
    };

    return {
        bindEvents: bindEvents
    }
})();


/**
 *  MENU MODULE
 */
var Menu = (function () {

    var SWITCH_WIDTH = 800;
    var toggleMenuBtn = $(".toggle-menu");
    var mainMenu = $("#main-menu");

    var init = function () {
        $(window).bind('resize orientationchange', function () {
            windowWidth = document.body.clientWidth;
            Menu.adjustMenu();
        });
    }

    var adjustMenu = function () {
        if (windowWidth < SWITCH_WIDTH) {
            toggleMenuBtn.css("display", "inline-block");
            if (!toggleMenuBtn.hasClass("active")) {
                mainMenu.hide();
            } else {
                mainMenu.show();
            }
            mainMenu.find("li").unbind('mouseenter mouseleave').removeProp('hoverIntent_t').removeProp('hoverIntent_s');
            mainMenu.find("li a.parent").unbind('click').bind('click', function (e) {
                e.preventDefault();
                $(this).parent("li").toggleClass("hover");
            });
        }
        else if (windowWidth >= SWITCH_WIDTH) {

            toggleMenuBtn.css("display", "none");
            mainMenu.show();
            mainMenu.find("li").removeClass("hover");
            mainMenu.find("li a").unbind('click');
            mainMenu.find("li").hoverIntent({
                over: function () {
                    var $this = $(this);
                    $this.siblings().filter('.hover').removeClass('hover');
//                    if (window.hideMenu) clearTimeout(window.hideMenu); // dont hide menu after rehovering
                    if ($this.parent().attr('id') == mainMenu.attr('id')) {
                        mainMenu.find("li.hover").removeClass('hover');
                    }
                    $this.addClass('hover');
                },
                out: function () {
                    var $this = $(this);
                    if ($this.parent().attr('id') == mainMenu.attr('id')) {
//                        window.hideMenu = setTimeout(function () {
                        $this.removeClass('hover');
//                        }, 1000);
                    }
                    else {
                        $this.removeClass('hover');
                    }

                },
                timeout: 500
            });
        }
    }

    mainMenu.find("li a").each(function () {
        if ($(this).next().length > 0) {
            $(this).addClass("parent");
        }
    })

    toggleMenuBtn.click(function (e) {
        e.preventDefault();
        $(this).toggleClass("active");
        mainMenu.toggle();
    });
    adjustMenu();

    return {
        init: init,
        adjustMenu: adjustMenu
    }
})();

/**
 *  MOBILE MODULE
 */
var Mobile = (function () {

    var LEFT_SIDEBAR_TOGGLE_ID = 'left-sidebar-toggle';
    var RIGHT_SIDEBAR_TOGGLE_ID = 'right-sidebar-toggle';
    var buttons = $("#" + LEFT_SIDEBAR_TOGGLE_ID + "," + "#" + RIGHT_SIDEBAR_TOGGLE_ID);
    var content = $("#content");

    var bindEvents = function () {

        buttons.on('click', function () {
            var $this = $(this);
            if ($this[0].id === LEFT_SIDEBAR_TOGGLE_ID) {
                if (content.hasClass("offset-right")) {
                    $("#" + RIGHT_SIDEBAR_TOGGLE_ID).click();
                }
                $("#left-sidebar").toggleClass('open');
                content.toggleClass('offset-left');
            }
            else {
                if (content.hasClass("offset-left")) {
                    $("#" + LEFT_SIDEBAR_TOGGLE_ID).click();
                }
                $("#right-sidebar").toggleClass('open');
                content.toggleClass('offset-right');
            }
            $this.toggleClass('btn-inverse');
            $this.find('i').toggleClass('icon-white');
        });

        $('#main').touchwipe({
            wipeLeft: function (e) {
                e.preventDefault();
                if(content.hasClass("offset-left")) {
                    $("#" + LEFT_SIDEBAR_TOGGLE_ID).click();
                }
                else {
                    $("#" + RIGHT_SIDEBAR_TOGGLE_ID).click();
                }
            },
            wipeRight: function (e) {
                e.preventDefault();
                if (content.hasClass("offset-right")) {
                    $("#" + RIGHT_SIDEBAR_TOGGLE_ID).click();
                }
                else {
                    $("#" + LEFT_SIDEBAR_TOGGLE_ID).click();
                }
            },
            preventDefaultEvents: false,
            min_move_x: 100
        });
    };

    return {
        bindEvents: bindEvents
    }
})();

/**
 * CALENDAR MODULE
 */
var Calendar = (function () {

    var container = $("#snippet-calendar-calendar");

    var bindEvents = function () {
        container.on('mouseenter', 'strong', function () {
            $this = $(this);
            $next = $this.next();
            $offset = $this.position();
            $next.removeClass('visuallyhidden').css({
                position: 'absolute',
                left: ($offset.left + 40) + 'px',
                top: $offset.top + 'px'
            });
        });

        container.on('mouseleave', 'strong', function () {
            $(this).next().addClass('visuallyhidden');
        });
    };

    return {
        bindEvents: bindEvents
    };
})();

function filterContent() {
    if (typeof String.prototype.startsWith !== 'function') {
        String.prototype.startsWith = function (str) {
            return this.slice(0, str.length) === str;
        };
    }
};

$(function () {
    Menu.init();
    Expander.init();
    Expander.bindEvents();
    Paginator.bindEvents();
    Calendar.bindEvents();
    Mobile.bindEvents();

    $.nette.ext('bindModules', {
        success: function () {
            Expander.init();
            Expander.bindEvents();
            Paginator.bindEvents();
            filterContent();
        }
    });

    $('#toggleFilter').click(function () {
        $('#personFilter').slideToggle(400);
        return false;
    });

    $('.init-tooltip').tooltip();

    $('.slideshow').slideshow({timeout: 8000, speed: 1000});

    filterContent();

    var tabsContainer = $("#tabs"), tabs = tabsContainer.find('li');
    if (tabsContainer.length && tabs.length) {
        $(".tab_content:not(:first)").hide();
        tabs.first().addClass('active');
        tabs.click(function () {
            tabs.removeClass('active');
            $(this).addClass("active");
            $(".tab_content").hide();
            var selected_tab = $(this).find("a").attr("href");
            $(selected_tab).fadeIn();
            return false;
        });
    }
});

$(document).ready(function() {
        
    $('.ing_toggleProjectClass').click(function(){  
        var collapse_content_selector = $(this).attr('href');
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle1').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle1').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
    
    $('.ing_toggleDetailsClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        $(collapse_content_selector).toggle(
          function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle2').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle2').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
    
    $('.ing_toggleGridStudentsClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle3').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle3').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
    
    $('.ing_toggleGridOldStudentsClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle4').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle4').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
        
    $('.ing_toggleFileClass').click(function(){
        var collapse_content_selector = $(this).attr('href');
        $(collapse_content_selector).toggle(
        function(){
            if($(this).css('display')=='none'){
                document.getElementById('imgtoggle5').src  = 'http://www.fri.uniza.sk/images/sipka_pravo.jpg';
            }
            else{
                document.getElementById('imgtoggle5').src = 'http://www.fri.uniza.sk/images/sipka_dole.jpg';
            }
        });
    });
 
 
	var friAccordion = $(".fri-accordion");
	if (friAccordion.length) {
		friAccordion.each(function () {
			var $this = $(this);
			$this.find(".legend").append("<span class=\"icon\"></span>");
			if ($this.hasClass('open')) {
				$this.find("span.icon").addClass("icon-chevron-down");
			}
			else {
				$this.find("span.icon").addClass("icon-chevron-right");
				$this.children(":not(.legend)").hide();
			}
		});

		friAccordion.on("click", ".legend", function () {
			var $this = $(this);
			if ($this.parent().hasClass('open')) {
				$this.find("span.icon").removeClass("icon-chevron-down").addClass("icon-chevron-right");
			}
			else {
				$this.find("span.icon").addClass("icon-chevron-down").removeClass("icon-chevron-right");
			}
			$this.parent().toggleClass('open');
			$this.siblings().slideToggle(400);
		});
	}
	
	/**
	 * MENU CATEGORIES
	 */
	$("#frm-newsCategoryFilter input[type=checkbox]").change(function () {
		$(this.form).submit();
	});
 
});