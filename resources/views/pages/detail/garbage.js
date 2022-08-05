

@push('script')
    {{-- <script src="{{ asset('frontend/js/specific_review.js') }}"></script> --}}
    
    <script type="text/javascript" >
        // Menu handling system
		const closeSidebar = () => {
		    const aside = document.querySelector('aside');
		    enableScroll();
			aside.classList.remove('w-52');
			aside.classList.add('w-0');
		}
		
		const openSidebar = () => {
		    const aside = document.querySelector('aside');
		    disableScroll();
			aside.classList.remove('w-0');
			aside.classList.add('w-52');
		}

		document.addEventListener('click', (event) => {
		    closeSidebar();
		});

		const menuHandler = (event) => {
			openSidebar();
			event.stopPropagation();
		};
		
		const disableScroll = () => {
        	scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        	scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    
    		window.onscroll = function() {
    			window.scrollTo(scrollLeft, scrollTop);
    		};
        };
    
        const enableScroll = () => {
        	window.onscroll = function() {};
        };
    </script>
    
    <script>
        var slug = "{{ $college->slug }}";

        function loadDoc(url) {
            console.log("load")
            url = url.split("/info")[0]
            $(".overlay__inner").addClass("show");
            $.ajax({
                url,
                type: 'GET', // http method
                success: function(data, status, xhr) {
                    $("#pane").empty();
                    $('#pane').append(data);
                    $(".overlay__inner").removeClass("show");
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    $(".overlay__inner").removeClass("show");


                }
            });
        }

        console.log(window.location.href, "{{ route('collegeDetail', ['college' => $college->slug]) }}")
        if (window.location.href != "{{ route('collegeDetail', ['college' => $college->slug]) }}")
            window.onLoad = loadDoc(window.location.href)
        // window.addEventListener("load", loadDoc(window.location.href));
        $(document).on('click', '.tab-route', function(e) {
            e.preventDefault();
            $('.tab-route.active').removeClass("active")
            $(this).addClass("active")
            loadDoc($(this).attr('href'));
            goTo("", "", $(this).attr('href'));
        })

        function goTo(page, title, url) {
            url = url.replace("/info", "")
            if ("undefined" !== typeof history.pushState) {
                history.pushState({
                    page: page
                }, title, url);
            } else {
                window.location.assign(url);
            }
        }
    </script>

    {{-- <script>
        var hidWidth;
        var scrollBarWidths = 40;

        var widthOfList = function() {
            var itemsWidth = 0;
            $('.nav-tabs li').each(function() {
                var itemWidth = $(this).outerWidth();
                itemsWidth += itemWidth;
            });
            return itemsWidth;
        };
 $(document).on('scroll', '.college-list-container' , function() {
            let div = $(this).get(0);
            if (div.scrollTop + div.clientHeight >= div.scrollHeight) {
                // do the lazy loading here
                alert("loadmore")
            }
        });
        var widthOfHidden = function() {
            return (($('.wrapper').outerWidth()) - widthOfList() - getLeftPosi()) - scrollBarWidths;
        };

        var getLeftPosi = function() {
            return $('.nav-tabs').position().left;
        };

        var reAdjust = function() {
            if (($('.wrapper').outerWidth()) < widthOfList()) {
                $('.scroller-right').show();
            } else {
                $('.scroller-right').hide();
            }

            if (getLeftPosi() < 0) {
                $('.scroller-left').show();
            } else {
                $('.item').animate({
                    left: "-=" + getLeftPosi() + "px"
                }, 'slow');
                $('.scroller-left').hide();
            }
        }

        reAdjust();

        $(window).on('resize', function(e) {
            reAdjust();
        });

        $('.scroller-right').click(function() {
            console.log(widthOfHidden())
            $('.scroller-left').fadeIn('slow');
            $('.scroller-right').fadeOut('slow');

            $('.nav-tabs').animate({
                left: "+=" + widthOfHidden() + "px"
            }, 'slow', function() {

            });
        });

        $('.scroller-left').click(function() {

            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');

            $('.nav-tabs').animate({
                left: "-=" + getLeftPosi() + "px"
            }, 'slow', function() {

            });
        });
    </script> --}}


@endpush

@push('script')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('frontend/js/specific_review.js') }}"></script>




    <script>
        const navScroller = function({
            wrapperSelector: wrapperSelector = '.nav-scroller-wrapper',
            selector: selector = '.nav-scroller',
            contentSelector: contentSelector = '.nav-scroller-content',
            buttonLeftSelector: buttonLeftSelector = '.nav-scroller-btn--left',
            buttonRightSelector: buttonRightSelector = '.nav-scroller-btn--right',
            scrollStep: scrollStep = 75
        } = {}) {

            let scrolling = false;
            let scrollingDirection = '';
            let scrollOverflow = '';
            let timeout;

            let navScrollerWrapper;

            if (wrapperSelector.nodeType === 1) {
                navScrollerWrapper = wrapperSelector;
            } else {
                navScrollerWrapper = document.querySelector(wrapperSelector);
            }
            if (navScrollerWrapper === undefined || navScrollerWrapper === null) return;

            let navScroller = navScrollerWrapper.querySelector(selector);
            let navScrollerContent = navScrollerWrapper.querySelector(contentSelector);
            let navScrollerLeft = navScrollerWrapper.querySelector(buttonLeftSelector);
            let navScrollerRight = navScrollerWrapper.querySelector(buttonRightSelector);


            // Sets overflow
            const setOverflow = function() {
                scrollOverflow = getOverflow(navScrollerContent, navScroller);
                toggleButtons(scrollOverflow);
            }


            // Debounce setting the overflow with requestAnimationFrame
            const requestSetOverflow = function() {
                if (timeout) {
                    window.cancelAnimationFrame(timeout);
                }

                timeout = window.requestAnimationFrame(() => {
                    setOverflow();
                });
            }


            // Get overflow value on scroller
            const getOverflow = function(content, container) {
                let containerMetrics = container.getBoundingClientRect();
                let containerWidth = containerMetrics.width;
                let containerMetricsLeft = Math.floor(containerMetrics.left);

                let contentMetrics = content.getBoundingClientRect();
                let contentMetricsRight = Math.floor(contentMetrics.right);
                let contentMetricsLeft = Math.floor(contentMetrics.left);

                // Offset the values by the left value of the container
                let offset = containerMetricsLeft;
                containerMetricsLeft -= offset;
                contentMetricsRight -= offset + 1; // Due to an off by one bug in iOS
                contentMetricsLeft -= offset;

                // console.log (containerMetricsLeft, contentMetricsLeft, containerWidth, contentMetricsRight);

                if (containerMetricsLeft > contentMetricsLeft && containerWidth < contentMetricsRight) {
                    return 'both';
                } else if (contentMetricsLeft < containerMetricsLeft) {
                    return 'left';
                } else if (contentMetricsRight > containerWidth) {
                    return 'right';
                } else {
                    return 'none';
                }
            }


            // Move the scroller with a transform
            const moveScroller = function(direction) {
                if (scrolling === true) return;

                setOverflow();

                let scrollDistance = scrollStep;
                let scrollAvailable;


                if (scrollOverflow === direction || scrollOverflow === 'both') {

                    if (direction === 'left') {
                        scrollAvailable = navScroller.scrollLeft;
                    }

                    if (direction === 'right') {
                        let navScrollerRightEdge = navScroller.getBoundingClientRect().right;
                        let navScrollerContentRightEdge = navScrollerContent.getBoundingClientRect().right;

                        scrollAvailable = Math.floor(navScrollerContentRightEdge - navScrollerRightEdge);
                    }

                    // If there is less that 1.5 steps available then scroll the full way
                    if (scrollAvailable < (scrollStep * 1.5)) {
                        scrollDistance = scrollAvailable;
                    }

                    if (direction === 'right') {
                        scrollDistance *= -1;
                    }

                    navScrollerContent.classList.remove('no-transition');
                    navScrollerContent.style.transform = 'translateX(' + scrollDistance + 'px)';

                    scrollingDirection = direction;
                    scrolling = true;
                }

            }


            // Set the scroller position and removes transform, called after moveScroller()
            const setScrollerPosition = function() {
                var style = window.getComputedStyle(navScrollerContent, null);
                var transform = style.getPropertyValue('transform');
                var transformValue = Math.abs(parseInt(transform.split(',')[4]) || 0);

                if (scrollingDirection === 'left') {
                    transformValue *= -1;
                }

                navScrollerContent.classList.add('no-transition');
                navScrollerContent.style.transform = '';
                navScroller.scrollLeft = navScroller.scrollLeft + transformValue;
                navScrollerContent.classList.remove('no-transition');

                scrolling = false;
            }


            // Toggle buttons depending on overflow
            const toggleButtons = function(overflow) {
                navScrollerLeft.classList.remove('active');
                navScrollerRight.classList.remove('active');

                if (overflow === 'both' || overflow === 'left') {
                    navScrollerLeft.classList.add('active');
                }

                if (overflow === 'both' || overflow === 'right') {
                    navScrollerRight.classList.add('active');
                }
            }


            const init = function() {

                // Determine scroll overflow
                setOverflow();

                // Scroll listener
                navScroller.addEventListener('scroll', () => {
                    requestSetOverflow();
                });

                // Resize listener
                window.addEventListener('resize', () => {
                    requestSetOverflow();
                });

                // Button listeners
                navScrollerLeft.addEventListener('click', () => {
                    moveScroller('left');
                });

                navScrollerRight.addEventListener('click', () => {
                    moveScroller('right');
                });

                // Set scroller position
                navScrollerContent.addEventListener('transitionend', () => {
                    setScrollerPosition();
                });

            };

            // Init is called by default
            init();


            // Reveal API
            return {
                init
            };
        };

        const navScrollerTest = navScroller();
    </script>
@endpush
