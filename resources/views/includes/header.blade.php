<header class="z-0 w-screen h-16 flex justify-start items-center px-4 relative appBar text-white text-2xl sm:h-24 sm:px-8 sm:text-4xl md:hidden">
		<button onclick="menuHandler(event);" aria-lable="menu"><i class="fas fa-bars"></i></button>
		<img class="h-12 w-32 absolute left-1/2 -translate-x-1/2 sm:h-20 sm:w-40" src="{{ asset('logo.png') }}" alt="studywoo.com logo"></img>
	</header>
	<aside class="md:hidden absolute left-0 top-0 h-screen w-0 bg-teal-300 z-10 transition-all duration-350 ease-out">
	    <nav class="appBar w-full h-full overflow-hidden flex flex-col items-center justify-start text-white font-semibold text-md">
			<a class="px-4 py-4 pt-12" href="/colleges">Colleges</a>
			<a class="px-4 py-4" href="/courses">Courses</a>
			<a class="px-4 py-4" href="/exams">Exams</a>
			<a class="px-4 py-4" href="/boards">Boards</a>
			<a class="px-4 py-4" href="/admission">Admission</a>
			<a class="px-4 py-4" href="/study-abroad">Study Abroad</a>
			<a class="px-4 py-4" href="/resources">Resources</a>
			<a class="px-4 py-4" href="/reviews">Reviews</a>
			<a class="px-4 py-4" href="/news">News</a>
			<a class="px-4 py-1 bg-teal-500 rounded" href="/write-review">Write a Review</a>
			<a class="px-4 py-4" href="/login">Login or Signup ?</a>
		</nav>
	</aside>
	<header class="hidden md:block z-10 appBar w-screen min-h-max py-1">
		<nav class="w-full h-full flex items-center justify-end flex-wrap text-white font-semibold text-md">
			<a class="px-4 py-2" href="/colleges">Colleges</a>
			<a class="px-4 py-2" href="/courses">Courses</a>
			<a class="px-4 py-2" href="/exams">Exams</a>
			<a class="px-4 py-2" href="/boards">Boards</a>
			<a class="px-4 py-2" href="/admission">Admission</a>
			<a class="px-4 py-2" href="/study-abroad">Study Abroad</a>
			<a class="px-4 py-2" href="/resources">Resources</a>
			<a class="px-4 py-2" href="/reviews">Reviews</a>
			<a class="px-4 py-2" href="/news">News</a>
			<a class="px-4 py-1 bg-teal-500 rounded" href="/write-review">Write a Review</a>
			<a class="px-4 py-2" href="/login">Login or Signup ?</a>
		</nav>
	</header>