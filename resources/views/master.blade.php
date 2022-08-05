<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- BASE CSS -->
    <link href="{{ asset('css/bootstrap_customized.min.css') }}" rel="stylesheet">


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    @stack('style')

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        .text-white {
            color: white;
        }

        .text-small {
            font-size: 8px;
        }

    </style>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Paris, France",
                "postalCode": "F-75002",
                "streetAddress": "38 avenue de l'Opera"
            },
            "name": "Global Tech Update",
            "url": "https://demo.globaltechupdate.com",
            "legalName": "Global Tech Update",
            "email": "info@globaltechupdate.com",
            "description": "Meta desc of company",
            "faxNumber": " 68 53 01",
            "logo": "https://demo.globaltechupdate.com/logo.png",

            "telephone": "12345678"
        }
    </script>


    <script type="application/ld+json">
        {
            "@context": "http://schema.org",

            "@type": "WebPage",
            "name": "Global Tech Update",
            "alternativeHeadline": "Best Tech News",

            "description": "Some Description of website",

            "relatedLink": [
                "https://globaltechupdate.com"

            ],
            "specialty": "Markup",
            "significantLink": "http://schema.org/WebPage",
            "publisher": {
                "@id": "https://globaltechupdate.com"
            },
            "copyrightYear": "2021",
            "copyrightHolder": {
                "@id": "https://globaltechupdate.com"
            },
            "datePublished": "2021-05-27",
            "reviewedBy": {
                "@id": "https://globaltechupdate.com"
            },
            "locationCreated": {
                "@type": "Place",
                "name": "Office name",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "place",
                    "postalCode": "code",
                    "streetAddress": "location"
                }
            },
            "dateModified": "2021-05-29"

        }
    </script>





</head>


<header class="header clearfix element_to_stick header_in clearfix">
    <div class="container-fluid">
        <div id="logo">
            <a href="{{ route('homePage') }}">
                <img src="" width="140" height="35" alt="" class="logo_normal">
                <img src="" width="120" height="35" alt="" class="logo_sticky">
            </a>
        </div>
        @if (auth()->guard('customer')->check())
            <ul id="top_menu" class="drop_user">
                <li>
                    <div class="dropdown user clearfix">
                        <a href="#" data-toggle="dropdown">
                            <figure><img src="{{ auth()->guard('customer')->user()->customerDetail->avatar }}"
                                    alt=""></figure>
                            {{ auth()->guard('customer')->user()->customerDetail->full_name }}
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-content">
                                <ul>
                                    <li><a href="{{ route('profile') }}"><i class="fa fa-user"></i>Profile</a>
                                    </li>
                                    <li><a href="{{ route('review') }}"><i class="icon_document"></i>Review</a>
                                    </li>

                                    <li><a href="{{ route('logout') }}"><i class="icon_key"></i>Log out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </li>
            </ul>
        @else
            <ul id="top_menu">
                <li><a href="{{ route('login') }}" class="btn_access">Log In</a></li>
                <li><a href="{{ route('register') }}" class="btn_access green">Join Free</a></li>
            </ul>
        @endif

        <!-- /top_menu -->
        <a href="javascript:void(0)" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="javascript:void(0)" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="{{ route('homePage') }}"><img src="" width="120" height="35" alt=""></a>

            </div>
            <ul>
                <li><a href="{{ route('homePage') }}">Home</a></li>
                <li><a href="{{ route('listingPage') }}">Listing</a></li>
                {{-- <li><a href="{{ route('collegeDetail', ['college' => 1]) }}">College Detail</a></li> --}}

                <li>
                    <form class="navbar-form navbar-right navbar-form-search" role="search">
                        <div class="search-form-container hdn" id="search-input-container">
                            <div class="search-input-group">
                                <button type="button" class="btn btn-default" id="hide-search-input-container">
                                    <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                                </button>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-default" id="search-button"><i
                                class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>



<body>
    <header class="header clearfix element_to_stick header_in clearfix">
        <div class="container-fluid">
            <div id="logo">
                <a href="{{ route('home') }}">
                    <img src="" width="140" height="35" alt="" class="logo_normal">
                    <img src="" width="120" height="35" alt="" class="logo_sticky">
                </a>
            </div>
            <ul id="top_menu">
                <li><a href="#" class="btn_access">Log In</a></li>
                <li><a href="#" class="btn_access green">Join Free</a></li>
            </ul>
            <!-- /top_menu -->
            <a href="#0" class="open_close">
                <i class="icon_menu"></i><span>Menu</span>
            </a>
            <nav class="main-menu">
                <div id="header_menu">
                    <a href="#0" class="open_close">
                        <i class="icon_close"></i><span>Menu</span>
                    </a>
                    <a href="{{ route('home') }}"><img src="" width="120" height="35" alt=""></a>
                </div>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('listing') }}">Listing</a></li>
                    <li><a href="{{ route('detail') }}">College Detail</a></li>

                    <li class="submenu">
                        <a href="#0" class="show-submenu">Other Pages</a>
                        <div class="row">
                            <div class="col-6">
                                <ul class="row">
                                    <div class="col-3">
                                        <li><a href="admin_section/index.html" target="_blank">Admin Dashboard</a></li>
                                        <li><a href="404.html">404 Error</a></li>
                                        <li><a href="help.html">Help and Faq</a></li>
                                        <li><a href="modal-login.html">Modal Login</a></li>
                                    </div>
                                    <div class="col-3">
                                        <li><a href="modal-popup.html">Modal Advertise</a></li>
                                        <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                                        <li><a href="pricing-tables-1.html">Pricing Tables 1</a></li>
                                        <li><a href="pricing-tables-2.html">Pricing Tables 2</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="contacts.html">Contacts</a></li>
                                        <li><a href="coming_soon/index.html" target="_blank">Coming Soon</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                                    </div>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="row">
                                    <div class="col-3">
                                        <li><a href="admin_section/index.html" target="_blank">Admin Dashboard</a></li>
                                        <li><a href="404.html">404 Error</a></li>
                                        <li><a href="help.html">Help and Faq</a></li>
                                        <li><a href="modal-login.html">Modal Login</a></li>
                                    </div>
                                    <div class="col-3">
                                        <li><a href="modal-popup.html">Modal Advertise</a></li>
                                        <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                                        <li><a href="pricing-tables-1.html">Pricing Tables 1</a></li>
                                        <li><a href="pricing-tables-2.html">Pricing Tables 2</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="contacts.html">Contacts</a></li>
                                        <li><a href="coming_soon/index.html" target="_blank">Coming Soon</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <ul class="row">
                            <div class="col-3">
                                <li><a href="admin_section/index.html" target="_blank">Admin Dashboard</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="help.html">Help and Faq</a></li>
                                <li><a href="modal-login.html">Modal Login</a></li>
                            </div>
                            <div class="col-3">
                                <li><a href="modal-popup.html">Modal Advertise</a></li>
                                <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                                <li><a href="pricing-tables-1.html">Pricing Tables 1</a></li>
                                <li><a href="pricing-tables-2.html">Pricing Tables 2</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="coming_soon/index.html" target="_blank">Coming Soon</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                            </div>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </header>
    <!-- /header -->

    <main>
        @yield('content')

    </main>
    <!-- /main -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_1">Quick Links</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_1">
                        <ul>
                            <li><a href="#">Join Us</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_2">Categories</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_2">
                        <ul>
                            <li><a href="#">Top Categories</a></li>
                            <li><a href="#">Best Rated</a></li>
                            <li><a href="#">Best Price</a></li>
                            <li><a href="#">Latest Submissions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-3 col-md-6">
                    <h3 data-target="#collapse_4">Keep in touch</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_4">
                        <div id="newsletter">
                            <div id="message-newsletter"></div>
                            {{-- <form method="post" action="#" name="newsletter_form" id="newsletter_form">
                                <div class="form-group">
                                    <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                                    <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                                </div>
                            </form> --}}
                        </div>
                        <div class="follow_us">
                            <ul>
                                @if (SystemConfig::get('facebook'))

                                @endif
                                <li><a href="#0"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="img/twitter_icon.svg" alt="" class="lazy"></a></li>
                                <li><a href="#0"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="img/facebook_icon.svg" alt="" class="lazy"></a></li>
                                <li><a href="#0"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="img/instagram_icon.svg" alt="" class="lazy"></a></li>
                                <li><a href="#0"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="img/youtube_icon.svg" alt="" class="lazy"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row add_bottom_25">

                <div class="offset-lg-6 col-lg-6">
                    <ul class="additional_links">
                        <li><a href="#0">Terms and conditions</a></li>
                        <li><a href="#0">Privacy</a></li>
                        <li><span>© 2021</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->

    <div id="toTop"></div><!-- Back to top button -->

    <div class="layer"></div><!-- Opacity Mask Menu Mobile -->

    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('js/common_func.js') }}"></script>
    <script src="{{ asset('assets/validate.js') }}"></script>

    @stack('script')

</body>

</html>
