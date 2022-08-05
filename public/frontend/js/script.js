
var INSPIRO = {},
$ = jQuery.noConflict();
(function($) {
"use strict";
// Predefined Global Variables
var $window = $(window),

    //Main
    $body = $("body"),
    $bodyInner = $(".body-inner"),
    $section = $("section"),
    //Header
    $topbar = $("#topbar"),
    $header = $("#header"),
    $headerCurrentClasses = $header.attr("class"),
    //Logo
    headerLogo = $("#logo"),
    //Menu
    $mainMenu = $("#mainMenu"),
    $mainMenuTriggerBtn = $("#mainMenu-trigger a, #mainMenu-trigger button"),
    //Slider

    windowWidth = $window.width();

//Check if header exist
if ($header.length > 0) {
    var $headerOffsetTop = $header.offset().top;
}
var Events = {
    browser: {
        isMobile: function() {
            if (
                navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)
            ) {
                return true;
            } else {
                return false;
            }
        },
    },
};
//Settings
var Settings = {
    isMobile: Events.browser.isMobile,
    submenuLight: $header.hasClass("submenu-light") == true ? true : false,
    headerHasDarkClass: $header.hasClass("dark") == true ? true : false,
    headerDarkClassRemoved: false,
    sliderDarkClass: false,
    menuIsOpen: false,
    menuOverlayOpened: false,
};




INSPIRO.header = {
    functions: function() {

        INSPIRO.header.stickyHeader();
        INSPIRO.header.topBar();
        INSPIRO.header.search();
        INSPIRO.header.mainMenu();
        INSPIRO.header.mainMenuResponsiveShow();
        INSPIRO.header.mainMenuOverlay();
        INSPIRO.header.pageMenu();
        INSPIRO.header.sidebarOverlay();
        INSPIRO.header.dotsMenu();
        INSPIRO.header.onepageMenu();
    },

    stickyHeader: function() {
        var shrinkHeader = $header.attr("data-shrink") || 0,
            shrinkHeaderActive = $header.attr("data-sticky-active") || 200,
            scrollOnTop = $window.scrollTop();
        if ($header.hasClass("header-modern")) {
            shrinkHeader = 300;
        }

        $(window).breakpoints("greaterEqualTo", "lg", function() {
            if (!$header.is(".header-disable-fixed")) {
                if (scrollOnTop > $headerOffsetTop + shrinkHeader) {
                    $header.addClass("header-sticky");
                    if (scrollOnTop > $headerOffsetTop + shrinkHeaderActive) {
                        $header.addClass("sticky-active");
                        if (Settings.submenuLight && Settings.headerHasDarkClass) {
                            $header.removeClass("dark");
                            Settings.headerDarkClassRemoved = true;
                        }
                        INSPIRO.header.logoStatus();
                    }
                } else {
                    $header.removeClass().addClass($headerCurrentClasses);
                    if (Settings.sliderDarkClass && Settings.headerHasDarkClass) {
                        $header.removeClass("dark");
                        Settings.headerDarkClassRemoved = true;
                    }
                    INSPIRO.header.logoStatus();
                }
            }
        });
        $(window).breakpoints("lessThan", "lg", function() {
            if ($header.attr("data-responsive-fixed") == "true") {
                if (scrollOnTop > $headerOffsetTop + shrinkHeader) {
                    $header.addClass("header-sticky");
                    if (scrollOnTop > $headerOffsetTop + shrinkHeaderActive) {
                        $header.addClass("sticky-active");
                        if (Settings.submenuLight) {
                            $header.removeClass("dark");
                            Settings.headerDarkClassRemoved = true;
                        }
                        INSPIRO.header.logoStatus();
                    }
                } else {
                    $header.removeClass().addClass($headerCurrentClasses);
                    if (
                        Settings.headerDarkClassRemoved == true &&
                        $body.hasClass("mainMenu-open")
                    ) {
                        $header.removeClass("dark");
                    }
                    INSPIRO.header.logoStatus();
                }
            }
        });
    },
    //chkd
    topBar: function() {
        if ($topbar.length > 0) {
            $("#topbar .topbar-dropdown .topbar-form").each(function(
                index,
                element
            ) {
                if (
                    $window.width() - ($(element).width() + $(element).offset().left) <
                    0
                ) {
                    $(element).addClass("dropdown-invert");
                }
            });
        }
    },
    search: function() {
        var $search = $("#search");
        if ($search.length > 0) {
            var searchBtn = $("#btn-search"),
                searchBtnClose = $("#btn-search-close"),
                searchInput = $search.find(".form-control");

            function openSearch() {
                $body.addClass("search-open");
                searchInput.focus();
            }

            function closeSearch() {
                $body.removeClass("search-open");
                searchInput.value = "";
            }
            searchBtn.on("click", function() {
                openSearch();
                return false;
            });
            searchBtnClose.on("click", function() {
                closeSearch();
                return false;
            });
            document.addEventListener("keyup", function(ev) {
                if (ev.keyCode == 27) {
                    closeSearch();
                }
            });
        }
    },
    mainMenu: function() {
        if ($mainMenu.length > 0) {
            $mainMenu
                .find(".dropdown, .dropdown-submenu")
                .prepend('<span class="dropdown-arrow"></span>');

            var $menuItemLinks = $(
                    '#mainMenu nav > ul > li.dropdown > a[href="#"], #mainMenu nav > ul > li.dropdown > .dropdown-arrow, .dropdown-submenu > a[href="#"], .dropdown-submenu > .dropdown-arrow, .dropdown-submenu > span, .page-menu nav > ul > li.dropdown > a'
                ),
                $triggerButton = $("#mainMenu-trigger a, #mainMenu-trigger button"),
                processing = false,
                triggerEvent;

            $triggerButton.on("click", function(e) {
                var elem = $(this);
                e.preventDefault();
                $(window).breakpoints("lessThan", "lg", function() {
                    var openMenu = function() {
                        if (!processing) {
                            processing = true;
                            Settings.menuIsOpen = true;
                            if (Settings.submenuLight && Settings.headerHasDarkClass) {
                                $header.removeClass("dark");
                                Settings.headerDarkClassRemoved = true;
                            } else {
                                if (
                                    Settings.headerHasDarkClass &&
                                    Settings.headerDarkClassRemoved
                                ) {
                                    $header.addClass("dark");
                                }
                            }
                            elem.addClass("toggle-active");
                            $body.addClass("mainMenu-open");
                            INSPIRO.header.logoStatus();
                            $mainMenu.animate({
                                "min-height": $window.height(),
                            }, {
                                duration: 500,
                                easing: "easeInOutQuart",
                                start: function() {
                                    setTimeout(function() {
                                        $mainMenu.addClass("menu-animate");
                                    }, 300);
                                },
                                complete: function() {
                                    processing = false;
                                },
                            });
                        }
                    };
                    var closeMenu = function() {
                        if (!processing) {
                            processing = true;
                            Settings.menuIsOpen = false;
                            INSPIRO.header.logoStatus();
                            $mainMenu.animate({
                                "min-height": 0,
                            }, {
                                start: function() {
                                    $mainMenu.removeClass("menu-animate");
                                },
                                done: function() {
                                    $body.removeClass("mainMenu-open");
                                    elem.removeClass("toggle-active");
                                    if (
                                        Settings.submenuLight &&
                                        Settings.headerHasDarkClass &&
                                        Settings.headerDarkClassRemoved &&
                                        !$header.hasClass("header-sticky")
                                    ) {
                                        $header.addClass("dark");
                                    }
                                    if (
                                        Settings.sliderDarkClass &&
                                        Settings.headerHasDarkClass &&
                                        Settings.headerDarkClassRemoved
                                    ) {
                                        $header.removeClass("dark");
                                        Settings.headerDarkClassRemoved = true;
                                    }
                                },
                                duration: 500,
                                easing: "easeInOutQuart",
                                complete: function() {
                                    processing = false;
                                },
                            });
                        }
                    };
                    if (!Settings.menuIsOpen) {
                        triggerEvent = openMenu();
                    } else {
                        triggerEvent = closeMenu();
                    }
                });
            });

            $menuItemLinks.on("click", function(e) {
                $(this).parent("li").siblings().removeClass("hover-active");
                if (
                    $body.hasClass("b--responsive") ||
                    $mainMenu.hasClass("menu-onclick")
                ) {
                    $(this).parent("li").toggleClass("hover-active");
                }
                e.stopPropagation();
                e.preventDefault();
            });

            $body.on("click", function(e) {
                $mainMenu.find(".hover-active").removeClass("hover-active");
            });

            $(window).on("resize", function() {
                if ($body.hasClass("mainMenu-open")) {
                    if (Settings.menuIsOpen) {
                        $mainMenuTriggerBtn.trigger("click");
                        $mainMenu.find(".hover-active").removeClass("hover-active");
                    }
                }
            });

            /*invert menu fix*/
            $(window).breakpoints("greaterEqualTo", "lg", function() {
                var $menuLastItem = $("nav > ul > li:last-child"),
                    $menuLastItemUl = $("nav > ul > li:last-child > ul"),
                    $menuLastInvert = $menuLastItemUl.width() - $menuLastItem.width(),
                    $menuItems = $("nav > ul > li").find(".dropdown-menu");

                $menuItems.css("display", "block");

                $(".dropdown:not(.mega-menu-item) ul ul").each(function(
                    index,
                    element
                ) {
                    if (
                        $window.width() -
                        ($(element).width() + $(element).offset().left) <
                        0
                    ) {
                        $(element).addClass("menu-invert");
                    }
                });

                if ($menuLastItemUl.length > 0) {
                    if (
                        $window.width() -
                        ($menuLastItemUl.width() + $menuLastItem.offset().left) <
                        0
                    ) {
                        $menuLastItemUl.addClass("menu-last");
                    }
                }
                $menuItems.css("display", "");
            });
        }




    },
    mainMenuResponsiveShow: function() {

    },
    mainMenuOverlay: function() {},
    pageMenu: function() {
        var $pageMenu = $(".page-menu");

        if ($pageMenu.length > 0) {
            $(window).breakpoints("greaterEqualTo", "lg", function() {
                var shrinkPageMenu =
                    $pageMenu.attr("data-shrink") || $pageMenu.offset().top + 200;

                if ($pageMenu.attr("data-sticky") == "true") {
                    $window.scroll(function() {
                        if ($window.scrollTop() > shrinkPageMenu) {
                            $pageMenu.addClass("sticky-active");
                            $header.addClass("pageMenu-sticky");
                        } else {
                            $pageMenu.removeClass("sticky-active");
                            $header.removeClass("pageMenu-sticky");
                        }
                    });
                }
            });

            $pageMenu.each(function() {
                $(this)
                    .find("#pageMenu-trigger")
                    .on("click", function() {
                        $pageMenu.toggleClass("page-menu-active");
                        $pageMenu.toggleClass("items-visible");
                    });
            });
        }
    },
    sidebarOverlay: function() {
        var sidebarOverlay = $("#side-panel");
        if (sidebarOverlay.length > 0) {
            sidebarOverlay.css("opacity", 1);
            $("#close-panel").on("click", function() {
                $body.removeClass("side-panel-active");
                $("#side-panel-trigger").removeClass("toggle-active");
            });
        }

        var $sidepanel = $("#sidepanel"),
            $sidepanelTrigger = $(".panel-trigger"),
            sidepanelProcessing = false,
            sidepanelEvent;

        $sidepanelTrigger.on("click", function(e) {
            e.preventDefault();
            var panelOpen = function() {
                if (!sidepanelProcessing) {
                    sidepanelProcessing = true;
                    Settings.panelIsOpen = true;
                    $sidepanel.addClass("panel-open");
                    sidepanelProcessing = false;
                }
            };
            var panelClose = function() {
                if (!sidepanelProcessing) {
                    sidepanelProcessing = true;
                    Settings.panelIsOpen = false;
                    $sidepanel.removeClass("panel-open");
                    sidepanelProcessing = false;
                }
            };
            if (!Settings.panelIsOpen) {
                sidepanelEvent = panelOpen();
            } else {
                sidepanelEvent = panelClose();
            }
        });
    },
    dotsMenu: function() {
        var $dotsMenu = $("#dotsMenu"),
            $dotsMenuItems = $dotsMenu.find("ul > li > a");
        if ($dotsMenu.length > 0) {
            $dotsMenuItems.on("click", function() {
                $dotsMenuItems.parent("li").removeClass("current");
                $(this).parent("li").addClass("current");
                return false;
            });
            $dotsMenuItems.parents("li").removeClass("current");
            $dotsMenu
                .find('a[href="#' + INSPIRO.header.currentSection() + '"]')
                .parent("li")
                .addClass("current");
        }
    },
    onepageMenu: function() {
        if ($mainMenu.hasClass("menu-one-page")) {
            var $currentMenuItem = "current";

            $(window).on("scroll", function() {
                var $currentSection = INSPIRO.header.currentSection();
                $mainMenu
                    .find("nav > ul > li > a")
                    .parents("li")
                    .removeClass($currentMenuItem);
                $mainMenu
                    .find('nav > ul > li > a[href="#' + $currentSection + '"]')
                    .parent("li")
                    .addClass($currentMenuItem);
            });
        }
    },
    currentSection: function() {
        var elemCurrent = "body";
        $section.each(function() {
            var elem = $(this),
                elemeId = elem.attr("id");
            if (
                elem.offset().top - $window.height() / 3 < $window.scrollTop() &&
                elem.offset().top + elem.height() - $window.height() / 3 >
                $window.scrollTop()
            ) {
                elemCurrent = elemeId;
            }
        });
        return elemCurrent;
    },
};


//Load Functions on document ready
$(document).ready(function() {

    INSPIRO.header.functions();

});
//Recall Functions on window scroll
$window.on("scroll", function() {
    INSPIRO.header.stickyHeader();

    INSPIRO.header.dotsMenu();
});
//Recall Functions on window resize
$window.on("resize", function() {
    INSPIRO.header.logoStatus();
    INSPIRO.header.stickyHeader();
    INSPIRO.header.mainMenuResponsiveShow();
});
})(jQuery);
