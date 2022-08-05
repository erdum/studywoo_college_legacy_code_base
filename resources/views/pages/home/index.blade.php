@extends('layouts.header',[
    'title' => 'College Studywoo',
    'meta_description' => '',
    'meta_keywords' => '',
    'faqs' => null
])

@push('style')

<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="{{ asset("frontend/css/bootstrap_customized.min.css") }}" rel="stylesheet">
<link href="{{ asset("frontend/css/style.css") }}" rel="stylesheet">

@endpush

@section('main')

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

<main>
    <div class="hero_single version_2 full_height" style="background: #ededed url({{ asset(SystemConfig::get('home-image'))}});">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.75)" style="margin-top: 1rem;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10">
                        <h1>Find a Best College</h1>
                        <p>Some description text here</p>
                        <form>
                            <div class="row no-gutters custom-search-input">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input onclick="openSearchbox();" class="form-control" name="search" type="text" placeholder="Find a best college...">
                                    </div>
                                </div>
                                <!--<div class="col-md-3">-->
                                <!--    <input type="submit" value="Find">-->
                                <!--</div>-->
                            </div>
                            <!-- /row -->

                        </form>
                    </div>
                </div>
                <!-- /row -->
                <a href="#first_section" class="btn_explore"><span class="pulse_bt"><i class="arrow_down"></i></span></a>
            </div>
        </div>
    </div>
    <!-- /hero_single -->

    <div class="bg_gray" id="first_section">
        <div class="container margin_60_40">
            <div class="main_title center">

                <span><em></em></span>
                <h2>Popular Colleges</h2>
                {{-- <p>Some text descriptions</p> --}}
            </div>
            <div class="row">

            </div>
            <!-- /row -->
            <p class="text-center add_top_30"><a class="btn_1 medium">Start
                    Searching</a></p>
        </div>
        <!-- /container -->
    </div>

    <div class="bg_gray">
        <div class="container margin_60_40 how">
            <div class="main_title center">
                <span><em></em></span>
                <h2>How does it work?</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            </div>
            <div class="row justify-content-center align-items-center add_bottom_45">
                <div class="col-lg-5">
                    <div class="box_about">
                        <strong>1</strong>
                        <h3>Search for College</h3>
                        <p>Search over 12.000 verifyed college that match your criteria.</p>
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/arrow_about.png" alt="" class="arrow_1 lazy">
                    </div>
                </div>
                <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                    <figure><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/about_1.svg" alt="" class="img-fluid lazy" width="180" height="180">
                    </figure>
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center add_bottom_45">
                <div class="col-lg-5 pr-lg-5 text-center d-none d-lg-block">
                    <figure><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/about_2.svg" alt="" class="img-fluid lazy" width="180" height="180">
                    </figure>
                </div>
                <div class="col-lg-5">
                    <div class="box_about">
                        <strong>2</strong>
                        <h3>View Your Desire Course</h3>
                        <p>View course introduction and read reviews from other student.</p>
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/arrow_about.png" alt="" class="arrow_2 lazy">
                    </div>
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center add_bottom_25">
                <div class="col-lg-5">
                    <div class="box_about">
                        <strong>3</strong>
                        <h3>Gain Knowledge</h3>
                        <p>Connect with professional teacher and pursue your dreams.</p>
                    </div>
                </div>
                <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                    <figure><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/about_3.svg" alt="" class="img-fluid lazy" width="180" height="180">
                    </figure>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->

    {{-- <div class="call_section lazy" data-bg="url(img/bg_call_section.svg)">
            <div class="container clearfix">
                <div class="col-lg-5 col-md-6 float-right wow">
                    <div class="box_1">
                        <div class="ribbon_promo"><span>Free</span></div>
                        <h3>Are you a Professional Writer?</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum itaque, doloremque sequi
                            laborum
                            architecto iste cumque ipsa laboriosam mollitia incidunt id sed ut excepturi animi amet
                            aperiam soluta
                            labore numquam.</p>
                        <a href="#" class="btn_1">Read more</a>
                    </div>
                </div>
            </div>
        </div> --}}
    <!--/call_section-->

</main>
@endsection

@push('script')

<script>
        
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

@endpush
