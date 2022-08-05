<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset("logo.png") }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>{{ $title . ' - Studywoo' }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="google-site-verification" content="V-bkTEGG_XvZh92YAIuvYucGmT3hIZUQcXReMnpiMj4" />

    @stack("style")

    <link href="{{ asset("frontend/css/bootstrap_customized.min.css") }}" rel="stylesheet">
    <link href="{{ asset("frontend/css/style.css") }}" rel="stylesheet">
    <link href="{{ asset("frontend/css/review.css") }}" rel="stylesheet">
    <link href="{{ asset("frontend/css/custom.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        .text-white {
            color: white;
        }

        .text-small {
            font-size: 8px;
        }
    </style>
    
    @stack("meta")

    @if ($faqs)
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
          @foreach ($faqs as $faq)
          {
            "@type": "Question",
            "name": "{{ $faq->question }}",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "{{ $faq->answer }}"
            }
          },
          @endforeach
        ]
    }
    </script>
    
    @endif

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "{{ SystemConfig::get("locality-address") }}",
                "postalCode": "{{ SystemConfig::get("postal-code") }}",
                "streetAddress": "{{ SystemConfig::get("street-address") }}"
            },
            "sameAs": [
                "{{ SystemConfig::get("twitter") ?? "" }}",
                "{{ SystemConfig::get("facebook") ?? "" }}",
                "{{ SystemConfig::get("instagram") ?? "" }}",
                "{{ SystemConfig::get("youtube") ?? "" }}"
            ],
            "name": "{{ SystemConfig::get("app-name") }}",
            "url": "{{ url("/") }}",
            "legalName": "{{ SystemConfig::get("app-name") }}",
            "email": "{{ SystemConfig::get("email") }}",
            "description": "{{ SystemConfig::get("app-slogan") }}",
            "faxNumber": " {{ SystemConfig::get("fax-number") }}",
            "logo": "{{ url("/") }}/logo.png",
            "telephone": "{{ SystemConfig::get("telephone") }}"
        }
    </script>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",

            "@type": "WebPage",
            "name": "{{ SystemConfig::get("app-name") }}",
            "alternativeHeadline": "{{ SystemConfig::get("app-slogan") }}",


            "relatedLink": [
                "{{ url("/") }}",
                100

            ],
            "specialty": "Markup",
            "significantLink": "http://schema.org/WebPage",
            "publisher": {
                "@id": "{{ url("/") }}"
            }

            ,
            "copyrightYear": "`${new Date().getFullYear()}`",
            "copyrightHolder": {
                "@id": "{{ url("/") }}"
            },
            "datePublished": "2021-05-27",
            "reviewedBy": {
                "@id": "{{ url("/") }}"
            },
            "locationCreated": {
                "@type": "Place",
                "name": "{{ SystemConfig::get("app-name") }}",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "{{ SystemConfig::get("locality-address") }}",
                    "postalCode": "{{ SystemConfig::get("postal-code") }}",
                    "streetAddress": "{{ SystemConfig::get("street-address") }}"
                }
            },
            "dateModified": "2021-05-29"
        }
    </script>
    <style>
        .navbar-form-search {
            position: relative;
        }

        .navbar-form-search .form-control {
            width: 100%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .navbar-form-search .btn {
            border: 0;
            background: transparent;
            font-size: 14px;
        }

        .navbar-form-search .btn:active,
        .navbar-form-search .btn:hover,
        .navbar-form-search .btn:focus {
            color: #000;
            outline: none;
            box-shadow: none;
        }

        .navbar-form-search .search-form-container {
            text-align: right;
            position: absolute;
            width: 300px;
            overflow: hidden;
            background: #fff;
            right: 25px;
            top: -10px;
            z-index: 9;
            transition: all 0.3s ease-in-out;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .navbar-form-search .search-form-container.hdn {
            width: 0;
        }

        .navbar-form-search .search-form-container .search-input-group {
            width: 300px;
            margin: 0px
        }

        .form-group {
            margin-bottom: 0rem !important;
        }

        #search-button {
            cursor: pointer;
        }



        .navbar-form-search {
            display: flex;
            align-items: center;
        }

        .nav-container {
            display: flex;
            align-items: center;

        }

        @media (max-width: 1000px) {
            .navbar-form-search {
                display: none
            }

            .nav-container {
                display: block;
                align-items: center;

            }
        }
    </style>

    <style>
        .logo {
            width: 140px !important;
            height: auto;
        }

        *:not(i) {
            font-family: "Open Sans", sans-serif !important;
        }

        .primary-bg {
            background-image: linear-gradient(80deg, #4374b9 17%, #ee424f 96%);
        }

        .nav-container ul li a {
            color: #fff;
        }

        #icon {
            color: #fff;
        }

        footer.primary-bg *,
        footer.primary-bg i,
        footer.primary-bg a {
            color: #fff !important
        }

        #search_id{
            width: 100%;
            height: 15vh;
            font-size:20px;
            padding:5px 15px;
        }

        /* #search_items {
            color: #6d6d6d !important;
            background-color: #fff !important;
            border-bottom: 1px solid #6d6d6d !important;
            transition: all 0.3s ease-in-out;
            font-size: 12px;
            width: 100%;
            height: auto;
            word-wrap: break-word;
        }

        #search_items:hover {
            background-color: #6d6d6d19;
        } */

        #search_college{
            position:fixed!important;
            top:0%;
            z-index: 10000000;
            width:100%;
            display: none;
        }
        table tr{
            cursor: pointer;
        }
        table tr td {
            font-weight: bold!important;
            font-size:16px;
            text-align: left;
        }
    </style>
    
    <style>
        .appBar {
    		background: linear-gradient(45deg, rgb(67, 116, 185), rgb(238, 66, 79));
    	}
	</style>
	
	<script src="https://cdn.tailwindcss.com"></script>
	
</head>

<body class="bg-gray-100" style="overflow-x: hidden;">
    {{-- <img src="{{url("/logo/"."A P Goyal Shimla University Logo.png")}}"> --}}
    <form id="search_college" role="search">
        @csrf
        <div class="search-form-container hdn w-100" id="search-input-container">
            <div class="search-input-group">
                <div class="form-group" style="position:relative;">
                    <input type="text" class="form-control" id="search_id" placeholder="Type and Hit Enter to search..."
                        name="search" onkeyup="search_list(this.value)">
                        <i class="fa fa-3x fa-times" aria-hidden="true" style="position: absolute;top:15%;right:1%;color: rgb(181, 181, 181);cursor:pointer;" onclick="cancel_search()"></i>
                </div>
                <div id="search_trending" style="max-height: 70vh;overflow-y:auto;overflow-x:hidden;background-color:#f8f9fa!important;">
                <h1 class="text-left text-dark my-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trending Search</h1>
                <hr>
                    <table class="table table-info table-borderless table-hover" style="background-color: rgb(250, 250, 250)">
                        <tbody id="search_trends"></tbody>
                    </table>
                </div>
                <div id="display_search table-responsive" style="max-height: 70vh;overflow-y:auto;overflow-x:hidden;">
                    <table class="table table-info table-borderless" style="background-color: rgb(250, 250, 250)">
                        <tbody id="search_items"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
	
	
	
	<section id="closeSearchbox"
	class="
		hidden
		absolute
		top-0
		left-0
		w-screen
		h-screen
		z-10
		bg-teal-800
		text-white
		text-md
		flex
		flex-col
		items-start
		justify-start
		pt-4
		pl-4
		overflow-hidden

		sm:pt-8
		sm:pl-8
	">
		<div class="
			w-full
			flex
			items-center
			justify-end
			px-4
			hover:cursor-pointer

			md:px-8
		"><i onclick="closeSearchbox(event);" class="fas fa-times text-3xl sm:text-5xl"></i>
		</div>
		<div class="
			w-11/12
			place-self-strech
			flex
			items-center
			justify-start
			text-lg
			pb-2
			my-8
			border-b-2

			sm:text-2xl
		">
			<i class="fas fa-search px-1 pr-2 md:pr-4"></i>
			<input
			oninput="handleSearch(event);"
			type="text"
			name="search"
			placeholder="Search Colleges, Admissions..."
			class="
				w-full
				bg-transparent
				placeholder:text-white
				focus:outline-none
			">
		</div>
		<p id="popularSearch" class="text-neutral-400 mb-4">Popular Searches</p>
		<div id="searchSuggestions" class="flex flex-col items-start justify-evenly sm:text-lg">
			<div id="defaultSearches" class="flex flex-col items-start justify-evenly">
				<a class="py-1" href="">CAT Exam</a>
				<a class="py-1" href="">MBA</a>
				<a class="py-1" href="">B.TECH</a>
				<a class="py-1" href="">MBBS</a>
			</div>
			<div id="fetchedSearches" class="flex flex-col items-start justify-evenly">
			</div>
		</div>
	</section>

    <main class="w-full h-auto m-0 p-0">
        @yield('content')
    </main>
    <!-- /main -->

    <footer class="primary-bg">

        <div class="container ">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_1">Quick Links</h3>
                    <div class="dont-collapse-sm links">
                        <ul>
                            <li><a >Join Us</a></li>
                            <li><a >Login</a></li>
                            <li><a >Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="">Categories</h3>
                    <div class=" dont-collapse-sm links">
                        <ul>
                            <li><a href="#">Top Categories</a></li>
                            <li><a href="#">Best Rated</a></li>
                            <li><a href="#">Best Price</a></li>
                            <li><a href="#">Latest Submissions</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h3 data-target="">Categories</h3>
                    <div class=" dont-collapse-sm links">
                        <ul>
                            <li><a href="#">Top Categories</a></li>
                            <li><a href="#">Best Rated</a></li>
                            <li><a href="#">Best Price</a></li>
                            <li><a href="#">Latest Submissions</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-lg-3  col-md-6">
                    <h3>Social Links</h3>
                    <div class="dont-collapse-sm">
                        {{-- <div id="newsletter">
                            <div id="message-newsletter"></div>
                            <form method="post" action="#" name="newsletter_form" id="newsletter_form">
                                <div class="form-group">
                                    <input type="email" name="email_newsletter" id="email_newsletter"
                                        class="form-control" placeholder="Your email">
                                    <button type="submit" id="submit-newsletter"><i
                                            class="arrow_carrot-right"></i></button>
                                </div>
                            </form>
                        </div> --}}
                        <div class="follow_us">
                            <ul>
                                @if (SystemConfig::get('twitter'))
                                <li><a href="{{ SystemConfig::get('twitter') }}" target="__blank"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="{{ asset('img/twitter_icon.svg') }}" alt="" class="lazy"></a>
                                </li>
                                @endif
                                @if (SystemConfig::get('facebook'))
                                <li><a href="{{ SystemConfig::get('facebook') }}" target="__blank"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="{{ asset('img/facebook_icon.svg') }}" alt="" class="lazy"></a>
                                </li>
                                @endif
                                @if (SystemConfig::get('instagram'))
                                <li><a href="{{ SystemConfig::get('instagram') }}" target="__blank"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="{{ asset('img/instagram_icon.svg') }}" alt="" class="lazy"></a>
                                </li>
                                @endif
                                @if (SystemConfig::get('youtube'))
                                <li><a href="{{ SystemConfig::get('youtube') }}" target="__blank"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="{{ asset('img/youtube_icon.svg') }}" alt="" class="lazy"></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </footer>
    <!--/footer-->

    <div id="toTop"></div><!-- Back to top button -->

    <!-- COMMON SCRIPTS -->
    <!--<script src="{{ asset("frontend/js/common_scripts.min.js") }}"></script>-->
    <!--<script src="{{ asset("frontend/js/common_func.js") }}"></script>-->
    <!--<script src="{{ asset("frontend/assets/validate.js") }}"></script>-->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"-->
    <!--    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
    

    @stack("script")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    
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
		
		function disableScroll() {
        	scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        	scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    
    		window.onscroll = function() {
    			window.scrollTo(scrollLeft, scrollTop);
    		};
        }
    
        function enableScroll() {
        	window.onscroll = function() {};
        }
        
        const closeSearchbox = (event) => {
			const searchbox = document.getElementById('closeSearchbox').classList;
			searchbox.remove('flex');
			searchbox.add('hidden');
			event.stopPropagation();
		}

		const openSearchbox = (event) => {
			const searchbox = document.getElementById('closeSearchbox').classList;
			searchbox.remove('hidden');
			searchbox.add('flex');
			event.stopPropagation();
		};
		
		const setLoading = (state) => {
		    const fs = document.getElementById('fetchedSearches');
		    if (state) {
		        renderSearchSuggestions([{ title: 'Searching...', link: '#' }]);
		    } else {
		        fs.innerHTML = "";
		    }
		};
		
		let prevTimer = null;
		const delaySearch = (callback) => {
		    
		    if (prevTimer) {
		        clearTimeout(prevTimer);
		    }
		    prevTimer = setTimeout(callback, 500);
		};

		const handleSearch = (event) => {
			
			if (event.target.value) {
				setSearchSuggestions();
				delaySearch(async () => {
				    setLoading(true);
    				const res = await fetch('https://college.studywoo.com/api/search', {
    				    method: 'post',
    				    headers: {
    				        'Content-Type': 'application/json',
    				        'Accept': 'application/json'
    				    },
    				    body: JSON.stringify({ text: event.target.value })
    				});
    				if (res.status === 200) {
    				    setLoading(false);
    				    const result = await res.json();
    				    renderSearchSuggestions(result);
    				} else {
    				    setLoading(false);
    				}
				});
			} else {
				setSearchSuggestions(true);
			}
		};

		const setSearchSuggestions = (state = false) => {
			const popularSearch = document.getElementById('popularSearch');
			const ds = document.getElementById('defaultSearches');
			popularSearch.style.display = state ? 'block' : 'none';
			ds.style.display = state ? 'flex' : 'none';
		};

		const renderSearchSuggestions = (data) => {
			const fs = document.getElementById('fetchedSearches');
			fs.innerHTML = "";
			data.map((item) => {
				const anc = document.createElement('a');
				anc.classList.add('py-1');
				anc.setAttribute('href', item.link);
				anc.innerText = item.title;
				fs.appendChild(anc);
			});
		};
    </script>

</body>

</html>
