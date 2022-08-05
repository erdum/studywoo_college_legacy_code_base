<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset("sw.png") }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>{{ $title . ' - Studywoo' }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="google-site-verification" content="V-bkTEGG_XvZh92YAIuvYucGmT3hIZUQcXReMnpiMj4" />
    @stack('meta')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    @stack('style')
    
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
            "logo": "{{ url("/") }}/logo.webp",
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
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        button:focus {
            outline: 0 !important;
        }
    </style>
    
</head>

<body class="bg-slate-100">
	
	@yield('header')
	
	<header class="md:hidden w-full h-16 bg-teal-500 flex items-center justify-center relative">
        <i class="fa-solid fa-bars absolute right-0 p-4 text-2xl text-white" onclick="openMobMenu()"></i>
        <img class="h-12" alt="Studywoo logo" src="https://college.studywoo.com/logo.webp"> 
    </header>
    
	<header class="hidden md:flex overflow-hidden w-full h-16 bg-teal-500 text-white text-lg font-medium items-stretch justify-end shadow-md">
         <img class="mr-auto ml-8 my-2" loading="lazy" src="https://college.studywoo.com/logo.webp"  alt="Studywoo logo"> 
        <a class="flex items-center px-6 hover:text-teal-500 hover:bg-white" href="/">Home</a>
        <a class="flex items-center px-6 hover:text-teal-500 hover:bg-white" href="{{ route('listingPage') }}">Listing</a>
        @foreach (['Engineering', 'Medical', 'Science', 'Commerce', 'Arts'] as $stream)
        <nav class="group mx-4 hover:text-teal-500 hover:bg-white">
            <button class="h-full px-2 font-medium">
                {{ $stream }} <i class="fa-solid fa-caret-down"></i>
            </button>
            <section class="hidden overflow-y-auto group-hover:block w-full h-[45vh] absolute left-0 z-10 bg-slate-100 shadow-lg">
                <div class="w-full h-16 bg-white text-xl font-normal pl-10 flex items-stretch">
                    <h2 class="flex items-center">{{ $stream }} Colleges</h2>
                </div>
                <div class="w-full flex items-stretch justify-evenly text-gray-500 text-xs font-normal">
                    <div class="flex flex-col item-stretch justify-start">
                        <h4 class="my-4 font-medium text-sm text-orange-400">Colleges by course</h4>
                        @foreach (Modules\College\Entities\Course::getCoursesByStream($stream) as $item)
                            <a class="py-1 hover:text-orange-500" href="{{ '/listing/stream=' . $stream . '&courses=' . $item->name ?? '' }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                    <div class="flex flex-col item-stretch justify-start">
                        <h4 class="my-4 font-medium text-sm text-orange-400">Colleges by city</h4>
                        @foreach (Modules\College\Entities\City::limit(10)->get() as $item)
                            <a class="py-1 hover:text-orange-500" href="{{ '/listing/stream=' . $stream . '&city=' . $item->name ?? '' }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                    <div class="flex flex-col item-stretch justify-start">
                        <h4 class="my-4 font-medium text-sm text-orange-400">Colleges by state</h4>
                        @foreach (Modules\College\Entities\State::limit(10)->get() as $item)
                            <a class="py-1 hover:text-orange-500" href="{{ '/listing/stream=' . $stream . '&state=' . $item->name ?? '' }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                    <div class="flex flex-col item-stretch justify-start">
                        <h4 class="my-4 font-medium text-sm text-orange-400">Colleges by course type</h4>
                        @foreach (Modules\College\Entities\CourseType::limit(10)->get() as $item)
                            <a class="py-1 hover:text-orange-500" href="{{ '/listing/stream=' . $stream . '&courseType=' . $item->name ?? '' }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                    <div class="flex flex-col item-stretch justify-start">
                        <h4 class="my-4 font-medium text-sm text-orange-400">Colleges by affiliated</h4>
                        @foreach (Modules\College\Entities\Affiliated::limit(10)->get() as $item)
                            <a class="py-1 hover:text-orange-500" href="{{ '/listing/stream=' . $stream . '&affiliated=' . $item->name ?? '' }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>
            </section>
        </nav>        
        @endforeach
    </header>

    <aside id="mob-menu" class="w-0 h-full fixed top-0 left-0 z-10 bg-teal-500 overflow-x-hidden overflow-y-auto flex flex-col items-stretch justify-start transition-all text-lg">
        <div class="flex items-center justify-end px-6 py-4 text-4xl text-white">
            <i onclick="closeMobMenu()" class="fa-solid fa-xmark"></i>
        </div>
        
        <a href="/" class="bg-white text-teal-500 px-6 py-3 my-1.5 flex items-center justify-between font-medium relative">
            Home
        </a>
        <a href="/listing" class="bg-white text-teal-500 px-6 py-3 my-1.5 flex items-center justify-between font-medium relative">
            Listing
        </a>
        
        @foreach (['Engineering', 'Medical', 'Science', 'Commerce', 'Arts'] as $stream)
            <div onclick="toggleDropDownMob(event)" class="bg-white text-teal-500 px-6 py-3 my-1.5 flex items-center justify-between font-medium relative">
                {{ $stream }} Colleges
                <i class="fa-solid fa-chevron-down font-black text-xl transition-transform"></i>
                <nav onclick="stopClickTrigger(event)" class="absolute bottom-0 left-0 translate-y-full w-full h-0 bg-white overflow-x-hidden overflow-y-scroll transition-all flex flex-col items-stretch justify-start px-8 text-sm z-20">
                    
                    <div onclick="toggleDropDownMob(event)" class="bg-white text-teal-500 px-1 py-3 my-1.5 flex items-center justify-between font-medium relative">
                        Colleges by course
                        <i class="fa-solid fa-chevron-down font-black text-md transition-transform"></i>
                        <nav onclick="stopClickTrigger(event)" class="absolute bottom-0 left-0 translate-y-full w-full h-0 bg-white overflow-x-hidden overflow-y-scroll transition-all flex flex-col items-stretch justify-start px-6 text-xs z-20">
                            @foreach (Modules\College\Entities\Course::getCoursesByStream($stream) as $item)
                                <a class="py-1.5" href="{{ '/listing/stream=' . $stream . '&courses=' . $item->name ?? '' }}">{{ $item->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                    
                    <div onclick="toggleDropDownMob(event)" class="bg-white text-teal-500 px-1 py-3 my-1.5 flex items-center justify-between font-medium relative">
                        Colleges by city
                        <i class="fa-solid fa-chevron-down font-black text-md transition-transform"></i>
                        <nav onclick="stopClickTrigger(event)" class="absolute bottom-0 left-0 translate-y-full w-full h-0 bg-white overflow-x-hidden overflow-y-scroll transition-all flex flex-col items-stretch justify-start px-6 text-xs z-20">
                            @foreach (Modules\College\Entities\City::limit(10)->get() as $item)
                                <a class="py-1.5" href="{{ '/listing/stream=' . $stream . '&city=' . $item->name ?? '' }}">{{ $item->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                    
                    <div onclick="toggleDropDownMob(event)" class="bg-white text-teal-500 px-1 py-3 my-1.5 flex items-center justify-between font-medium relative">
                        Colleges by state
                        <i class="fa-solid fa-chevron-down font-black text-md transition-transform"></i>
                        <nav onclick="stopClickTrigger(event)" class="absolute bottom-0 left-0 translate-y-full w-full h-0 bg-white overflow-x-hidden overflow-y-scroll transition-all flex flex-col items-stretch justify-start px-6 text-xs z-20">
                            @foreach (Modules\College\Entities\State::limit(10)->get() as $item)
                                <a class="py-1.5" href="{{ '/listing/stream=' . $stream . '&state=' . $item->name ?? '' }}">{{ $item->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                    
                    <div onclick="toggleDropDownMob(event)" class="bg-white text-teal-500 px-1 py-3 my-1.5 flex items-center justify-between font-medium relative">
                        Colleges by course type
                        <i class="fa-solid fa-chevron-down font-black text-md transition-transform"></i>
                        <nav onclick="stopClickTrigger(event)" class="absolute bottom-0 left-0 translate-y-full w-full h-0 bg-white overflow-x-hidden overflow-y-scroll transition-all flex flex-col items-stretch justify-start px-6 text-xs z-20">
                            @foreach (Modules\College\Entities\CourseType::limit(10)->get() as $item)
                                <a class="py-1.5" href="{{ '/listing/stream=' . $stream . '&courseType=' . $item->name ?? '' }}">{{ $item->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                    
                    <div onclick="toggleDropDownMob(event)" class="bg-white text-teal-500 px-1 py-3 my-1.5 flex items-center justify-between font-medium relative">
                        Colleges by affiliated
                        <i class="fa-solid fa-chevron-down font-black text-md transition-transform"></i>
                        <nav onclick="stopClickTrigger(event)" class="absolute bottom-0 left-0 translate-y-full w-full h-0 bg-white overflow-x-hidden overflow-y-scroll transition-all flex flex-col items-stretch justify-start px-6 text-xs z-20">
                            @foreach (Modules\College\Entities\Affiliated::limit(10)->get() as $item)
                                <a class="py-1.5" href="{{ '/listing/stream=' . $stream . '&affiliated=' . $item->name ?? '' }}">{{ $item->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                </nav>
            </div>
        @endforeach
        
    </aside>
    
	<main class="w-full h-auto m-0 p-0">
        @yield('main')
    </main>
    
    <footer class="bg-slate-200 w-full h-auto pt-6 flex flex-wrap justify-start md:justify-evenly">
        <nav class="w-full flex flex-col items-center text-slate-600 text-left text-sm my-10 px-6 md:px-0 md:w-auto md:items-start">
            <h4 class="font-medium text-xl mb-4">Trending Topics</h4>
            <ul>
	<li><a href="https://studywoo.com/50-difficult-words-with-meanings/">50 Difficult Words with Meanings</a></li>
	<li><a href="https://studywoo.com/arts-subject/">Best Arts Stream Subjects</a></li>
	<li><a href="https://studywoo.com/cgpa-to-percentage-converter/">Convert CGPA to Percentage</a></li>
	<li><a href="https://studywoo.com/bipc-courses/">Courses After BiPC</a></li>
	<li><a href="https://studywoo.com/toughest-courses-in-the-world/">Toughest Courses in the World</a></li>
	<li><a href="https://studywoo.com/asl-topics/">ASL Topics</a></li>
	<li><a href="https://studywoo.com/declaration-in-resume/">Declaration in Resume for Freshers</a></li>
	<li><a href="https://studywoo.com/pmp-certification/">PMP Certification</a></li>
	<li><a href="https://studywoo.com/cybersecurity-and-ethical-hacking-courses/">Hacking Courses</a></li>
	<li><a href="https://studywoo.com/aws-certifications/">AWS Certifications</a></li>
	<li><a href="https://studywoo.com/what-is-ielts/">What Is IELTS</a></li>
</ul>
        </nav>
        <nav class="w-full flex flex-col items-center text-slate-600 text-left text-sm my-10 px-6 md:px-0 md:w-auto md:items-start">
            <h4 class="font-medium text-xl mb-4">Courses After 12th</h4>
           <ul>
	<li><a href="https://studywoo.com/teaching-courses-after-12th/">Teaching Courses after 12th</a></li>
	<li><a href="https://studywoo.com/agriculture-courses-after-12th/" rel="noopener" target="_blank">Agriculture Courses After 12th</a></li>
	<li><a href="https://studywoo.com/hotel-management-courses-after-12th/" rel="noopener" target="_blank">Hotel Management Courses after 12th</a></li>
	<li><a href="https://studywoo.com/law-courses-after-12th/" rel="noopener" target="_blank">Law Courses after 12th</a></li>
	<li><a href="https://studywoo.com/diploma-courses-after-12th/" rel="noopener" target="_blank">Diploma Courses After 12th</a></li>
	<li><a href="https://studywoo.com/best-online-courses-after-12th-2020-2021/" rel="noopener" target="_blank">Online Courses After 12th</a></li>
	<li><a href="https://studywoo.com/aviation-courses-after-12th/" rel="noopener" target="_blank">Aviation Courses After 12th</a></li>
	<li><a href="https://studywoo.com/nursing-courses-after-12th/" rel="noopener" target="_blank">Nursing Courses after 12th 2022</a></li>
	<li><a href="https://studywoo.com/iti-courses-after-12th/" rel="noopener" target="_blank">ITI Courses After 12th</a></li>
	<li><a href="https://studywoo.com/home-science-courses-after-12th/" rel="noopener" target="_blank">Home Science Courses after 12th</a></li>
	<li><a href="https://studywoo.com/computer-courses-after-12th/" rel="noopener" target="_blank">Computer Courses after 12th</a></li>
</ul>

        </nav>
        <nav class="w-full flex flex-col items-center text-slate-600 text-sm my-10 md:w-auto">
            <h4 class="font-medium text-xl mb-4">Top Scholarships To Apply</h4>
  <ul>
	<li><a href="https://studywoo.com/scholarships-for-class-12th-students/">Scholarship after 12th Passed</a></li>
	<li><a href="https://studywoo.com/pm-scholarship-scheme/">PM Scholarship</a></li>
	<li><a href="https://studywoo.com/ssp-scholarship/">SSP Scholarship</a></li>
	<li><a href="https://studywoo.com/up-scholarship/">UP Scholarship</a></li>
	<li><a href="https://studywoo.com/cg-scholarship/">CG Scholarship</a></li>
	<li><a href="https://studywoo.com/best-bihar-scholarships-apply-online-eligibility-and-important-dates/">Bihar Scholarship</a></li>
	<li><a href="https://studywoo.com/inspire/">INSPIRE Scholarship</a></li>
	<li><a href="https://studywoo.com/girls-scholarship/">Scholarship For Girls</a></li>
	<li><a href="https://studywoo.com/mp-scholarship/">MP Scholarship</a></li>
	<li><a href="https://studywoo.com/digital-gujarat-scholarship/">Digital Gujarat Scholarship</a></li>
	<li><a href="https://studywoo.com/punjab-scholarship/">Punjab Scholarship</a></li>
</ul>


        </nav>
        <nav class="w-full flex flex-col items-center text-slate-600 text-left text-sm my-10 px-6 md:px-0 md:w-auto md:items-start">
            <h4 class="font-medium text-xl mb-4">Study in Abroad</h4>
            <ul>
<a href="https://studywoo.com/studying-in-australia-all-you-need-to-know-about-its-cost-and-expenses/" rel="bookmark" data-wpel-link="internal">Studying In Australia</a>
<li><a href="https://studywoo.com/cost-of-studying-in-uk-for-indian-students/" data-wpel-link="internal">Study in UK</a></li>
<li><a href="https://studywoo.com/mbbs-in-the-usa-everything-you-need-to-know/" rel="bookmark" data-wpel-link="internal">MBBS In USA</a></li>
<li><a href="https://studywoo.com/mbbs-in-the-philippines-for-indian-students-in/" rel="bookmark" data-wpel-link="internal">MBBS In Philippines</a></li>
<li><a href="https://studywoo.com/study-in-canada-a-comprehensive-guide-for-students-studying-in-canada/" rel="bookmark" data-wpel-link="internal">Study In Canada</a></li>
<li><a href="https://studywoo.com/studying-in-germany-all-you-need-to-know-about-its-costs-and-expenses/" rel="bookmark" data-wpel-link="internal">Studying In Germany</a></li>
<li><a href="https://studywoo.com/mba-in-canada-without-work-experience/" rel="bookmark" data-wpel-link="internal">MBA In Canada</a></li>
<li><a href="https://studywoo.com/second-mba-abroad/" rel="bookmark" data-wpel-link="internal">Second MBA Abroad</a></li>
<li><a href="https://studywoo.com/mba-in-australia/" rel="bookmark" data-wpel-link="internal">MBA In Australia</a></li>
<li><a href="https://studywoo.com/mba-in-new-zealand/" rel="bookmark" data-wpel-link="internal">MBA In New Zealand</a></li>
<li><a href="https://studywoo.com/what-is-temporary-graduate-visa-subclass-485/" rel="bookmark" data-wpel-link="internal">Temporary Graduate Visa (485)?</a></li>
              </ul>
            </nav>
            <nav>
             <p style="text-align:center"> <a class="hover:text-teal-500" href="https://www.facebook.com/OfficialStudyWoo/"><i class="text-3xl mx-3 fa-brands fa-facebook"></i></a>
                <a class="hover:text-teal-500" href="https://twitter.com/StudyWoo1"><i class="text-3xl mx-3 fa-brands fa-twitter"></i></a>
                <a class="hover:text-teal-500" href="https://www.linkedin.com/company/study-woo/"><i class="text-3xl mx-3 fa-brands fa-linkedin"></i></a>
                <a class="hover:text-teal-500" href="https://www.instagram.com/officialstudywoo/"><i class="text-3xl mx-3 fa-brands fa-instagram"></i></a>
                <a class="hover:text-teal-500" href="https://www.youtube.com/channel/UCxwUVw7O848ULeysA2D65sA/"><i class="text-3xl mx-3 fa-brands fa-youtube"></i></a></p>
                <p><strong><a href="https://studywoo.com/website-usage-policy/">TERMS &amp; CONDITION</a>&nbsp; |&nbsp;&nbsp;<a href="https://studywoo.com/privacy-policy-page/">PRIVACY</a>&nbsp; |&nbsp;&nbsp;<a href="https://studywoo.com/advertise-with-us/">ADVERTISING</a>&nbsp; |&nbsp;&nbsp;<a href="https://studywoo.com/about-us/">About STUDY WOO</a>&nbsp; |&nbsp;&nbsp;<a href="https://studywoo.com/careers/">Careers</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></p>
            </nav>
        </div>
        <div class="w-screen border-t border-slate-400 flex flex items-center justify-center py-6 text-xs text-slate-500 italic">
            
        <p style="text-align:right">Studywoo.com &copy;&nbsp;<span id="copyright_year"></span>&nbsp; |&nbsp; StudyWoo Private Limited.&nbsp;All rights reserved.</p>

        </div>
    </footer>
    
    @yield('footer')
    
    <script>
        (function () {
            const currentYear = new Date().getUTCFullYear();
            const copyrightYearElem = document.getElementById('copyright_year');
            copyrightYearElem.innerText = currentYear;
        })();
    
        const openMobMenu = () => {
    		const mobMenu = document.getElementById('mob-menu');
    		mobMenu.style.setProperty('width', '100%');
    		document.body.style.setProperty('overflow-y', 'hidden');
    	};

    	const closeMobMenu = () => {
    		const mobMenu = document.getElementById('mob-menu');
    		mobMenu.style.setProperty('width', '0');
    		document.body.style.setProperty('overflow-y', 'auto');
    	};
    	
    	const toggleDropDownMob = (e) => {
    	    const childs = e.currentTarget.children;
    	    const dropList = childs[childs.length - 1]
    	    const dropDownIcon = childs[0];
    	    
    	    if (dropList.offsetHeight > 0) {
    	        dropList.style.setProperty('height', '0');
        	    dropDownIcon.style.setProperty('transform', 'rotate(0deg)');
    	    } else {
    	        dropList.style.setProperty('height', '20rem');
        	    dropDownIcon.style.setProperty('transform', 'rotate(180deg)');
    	    }
    	};
    	
    	const stopClickTrigger = (e) => {
    	    e.stopPropagation();
    	};
    	
    	console.log("%c" + "Developed by Adnan & Son IT group Pakistan 🇵🇰", "color: #7289DA; -webkit-text-stroke: 1px black; font-size: 30px; font-weight: bold;");
    </script>
    
    @stack('script')
    
</body>
</html>