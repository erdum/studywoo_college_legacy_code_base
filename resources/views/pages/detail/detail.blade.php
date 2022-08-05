@extends('layouts.header',[
    'title' => $meta_title,
    'meta_description' => $meta_description,
    'meta_keywords' => '',
    'faqs' => $college->faqs
])

@push('style')
	<link href="{{ asset('frontend/css/detail-page.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link href="{{ asset('css/detail-page-min.css') }}" rel="stylesheet" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link href="{{ asset('frontend/css/bootstrap_customized.min.css') }}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link href="{{ asset('frontend/css/style.css') }}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<style>
	    #custom_content * {
            all: revert;
            scroll-margin-top: 2rem;
        }
        
        #custom_content li {
            white-space: normal !important;
        }
        
        table, th, td {
            border: 1px solid gray !important;
            border-collapse: collapse !important;
        }
        
        table {
            width: 100% !important;
        }
        
        tbody tr td {
            text-align: center !important;
            font-weight: bolder !important;
            font-size: 0.8rem !important;
        }
        
        @media (min-width: 1024px) {
            tbody tr td {
                font-size: 1rem !important;
            }
        }
        
        tbody > tr:first-child > td {
            color: white !important;
        }
        
        tbody > tr:first-child > td:first-child {
            background-color: #8BBDC4 !important;
        }
        
        tbody > tr:first-child > td:nth-child(2) {
            background-color: #7C9CAB !important;
        }
        
        tbody > tr:first-child > td:nth-child(3) {
            background-color: #6A8795 !important;
        }
        
        tbody > tr:first-child > td:nth-child(4) {
            background-color: #8BBDC4 !important;
        }
        
        tbody > tr:first-child > td:nth-child(5) {
            background-color: #7C9CAB !important;
        }
        
        tbody > tr:first-child > td:nth-child(6) {
            background-color: #6A8795 !important;
        }
        
        tbody > tr:first-child > td:nth-child(7) {
            background-color: #8BBDC4 !important;
        }
        
        tbody > tr:first-child > td:nth-child(8) {
            background-color: #7C9CAB !important;
        }
        
        tbody > tr:first-child > td:nth-child(9) {
            background-color: #6A8795 !important;
        }
        
        tbody tr:not(:first-child) > td:first-child {
            color: #4FB8DD !important;
        }
        
        tbody tr:nth-child(odd) {
            background-color: #f8f9fa !important;
        }
	</style>
@endpush


@section('main')

	<div itemprop="mainEntity" itemscope itemtype="https://schema.org/CollegeOrUniversity"
		 class="container-fluid  margin_detail">
		<div class="page_header">
			<div class="breadcrumbs">
				<ul itemscope itemtype="http://schema.org/BreadcrumbList">
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="{{ route('homePage') }}">
							<span itemprop="name">Home</span>
							<meta itemprop="position" content="1">
						</a>


					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="{{ route('listingPage') }}">
							<span itemprop="name">Listing</span>
							<meta itemprop="position" content="2">
						</a>


					</li>
					<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active">
						<a itemprop="item" class="active"
						   href="{{ route('collegeDetail', ['college' => $college->slug]) }}">
							<span itemprop="name">{{ $college->name }}</span>
							<meta itemprop="position" content="3">
						</a>


					</li>
				</ul>
			</div>
		</div>
		
		<div class="row" style="margin-bottom: 0px">
			
			<section class="w-full h-auto md:h-32 py-4 md:py-0 bg-white rounded shadow mb-4 mx-4 flex items-center">
			    <article class="w-full relative bg-gray-100 py-4">
			        <img loading="lazy" alt="college logo" src="{{ asset('photos/' . $college->logo_path . '.webp') }}" class="shadow-sm rounded-full w-20 h-20 mx-4 p-1 bg-white object-scale-down absolute top-4 md:top-1/2 md:-translate-y-1/2">
			        <div class="h-full w-full pt-32 md:pt-0 pl-4 md:pl-32 flex flex-col items-stretch justify-start">
			            <h1 itemprop="name" class="text-2xl font-medium text-center md:flex md:justify-start pr-4 md:pr-0">{{ $college->name }}</h1>
			            <p class="mt-8 md:mt-4 text-gray-500 flex flex-col md:flex-row md:items-center text-center md:text-left">
			                
			                <span>
    			                <i class="fa-solid fa-location-dot"></i>
    			                <span itemprop="address" class="mx-2">{{ $college->city->name }}, {{ $college->state->name }}</span>
                            </span>			                
			                
			                <span class="my-4 md:my-0">
    			                <i class="fa-solid fa-clock md:ml-6 mr-1"></i>
    			                <span>{{ $college->estd }}</span>
			                </span>
			                
			                <span>
    			                <span class="md:ml-6 mr-1">Approved by</span>
    			                <span>
    			                    (
    			                    @foreach ($college->affiliated as $aff)
    			                        {{ $aff->name }} |
    			                    @endforeach
    			                    )
    			                </span>
			                </span>
			            </p>
			        </div>
			        <div class="absolute top-10 md:top-6 right-4 w-32 h-10 flex">
			            <div class="w-1/2 h-full text-right text-gray-600">
			                <p itemprop="reviewCount" class="block">{{ $college->reviews->count() }}</p>
    			            <p class="block italic">Reviews</p>
			            </div>
			            <div class="w-1/2 h-full  flex items-center justify-center">
			                <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="w-10 h-10 rounded-full bg-teal-500 text-white text-sm font-semibold flex items-center justify-center">
			                    <meta itemprop="itemReviewed" content="{{ $college->name }}">
			                    <span itemprop="ratingValue">{{ $college->getAverageRating() }}</span>
			                </div>
			            </div>
			        </div>
			    </article>
			</section>

			<div class="w-full h-12 bg-white rounded shadow mb-8 mt-12 overflow-x-hidden md:mt-4 mx-4 px-12 text-slate-600 relative">
			    <div class="w-full h-full flex items-center justify-start overflow-x-auto">
			    @foreach ($college->subPages as $subPage)
    				<a class="text-base mx-4 {{ $subPage->slug == $active_page ? 'text-teal-500' : '' }} hover:text-teal-500"
    				   href="{{ $subPage->slug == 'info' ? route('collegeDetail', ['college' => $college->slug]) : route('collegeDetail', ['college' => $college->slug, 'page' => $subPage->slug]) }}"
        			   data-url="{{ $subPage->tab_name }}">{{ ucwords($subPage->tab_name ?? $subPage->slug) }}</a>
				@endforeach
				</div>

                @if (count($college->subPages) >= 2)
				    @foreach ($college->subPages as $index => $subpage)
				    
				        @if ($subpage->slug == $active_page)
				                @if (($index -1) > 0)
							    <a href="{{ $college->subPages[$index-1]->slug == 'info' ? route('collegeDetail', ['college' => $college->slug]) : route('collegeDetail', ['college' => $college->slug, 'page' => $college->subPages[$index-1]->slug]) }}" class="absolute left-4 top-1/2 -translate-y-1/2 text-lg"><i class="fa-solid fa-arrow-left cursor-pointer hover:text-teal-500"></i></a>
                                @endif            							    
							    
							    @if (($index + 1) < count($college->subPages))
    							    <a href="{{ $college->subPages[$index+1]->slug == 'info' ? route('collegeDetail', ['college' => $college->slug]) : route('collegeDetail', ['college' => $college->slug, 'page' => $college->subPages[$index+1]->slug]) }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-lg"><i class="fa-solid fa-arrow-right cursor-pointer hover:text-teal-500"></i></a>
							    @endif
				        @endif
				    @endforeach
				@endif
			</div>
		
		</div>
		<div class="row">
			<div class="col-lg-9">
				<div class="box_general shadow">
					<div class="tabs_detail">

						<div class="tab-content" role="tablist">
							<div class="overlay__inner">
								<div class="overlay__content"><span class="spinner"></span></div>
							</div>
						
							<div id="pane" class="card tab-pane fade show active content-pane md:px-8" role="tabpanel"
								 aria-labelledby="tab-A">
								<article itemscope itemtype="https://schema.org/Article">
									<meta itemprop="mainEntityOfPage"
										  content="{{ route('collegeDetail', ['college' => $college->slug]) }}">
									<meta itemprop="name headline" content="{{ $college->name }}">

                                    <div class="w-full flex items-stretch justify-start mb-8 relative" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                        <meta itemprop="name" content="{{ $author->name }}">
                                        <a href="{{ route('author-profile', ['author' => str_replace(' ', '-', $author->name) . "-{$author->id}"]) }}" itemprop="url">
                                            <img itemprop="avatar" class="rounded-full w-20 h-20 object-cover" alt="author profile picture" src="{{ $author?->avatar ? asset('photos/' . $author->avatar . '.webp') : asset('img/anonyms-avatar.png') }}">
                                        </a>
                                        <div class="flex flex-col items-start justify-start flex-wrap pl-8 text-xs">
                                            <a class="text-lg text-gray-600" rel="author" itemprop="url" title="view author biography" href="{{ route('author-profile', ['author' => str_replace(' ', '-', $author->name) . "-{$author->id}"]) }}">{{ $author->name ?? 'Author name' }}</a>
                                            <p class="mb-2 text-sm text-gray-500" itemprop="jobTitle">{{ $author->roles ?? 'Content curator' }}</p>
                                            <time>Updated on - {{ $college->updated_at->format('d M Y') }}</time>
                                            <meta itemprop="worksFor" content="{{ SystemConfig::get('app-name') }}">
                                            <meta itemprop="datePublished" content="{{ $college->created_at->format('d M Y') }}">
                                            <meta itemprop="dateModified" content="{{ $college->updated_at->format('d M Y') }}">
                                            <div class="flex items-center justify-evenly mt-8 text-2xl md:text-4xl text-gray-500 md:absolute right-0 top-0">
                                                @if ($author->profile()->facebook ?? null)
    												<a class="mx-2" href="{{ $author->profile()->facebook }}">
    												    <i class="fa-brands fa-facebook"></i>
    												</a>
												@endif
												
												@if ($author->profile()->instagram ?? null)
    												<a class="mx-2" href="{{ $author->profile()->instagram }}">
    												    <i class="fa-brands fa-instagram"></i>
    												</a>
												@endif
												
												@if ($author->profile()->linkedin ?? null)
    												<a class="mx-2" href="{{ $author->profile()->linkedin }}">
    												    <i class="fa-brands fa-linkedin"></i>
    												</a>
												@endif
												
												@if ($author->profile()->twitter ?? null)
    												<a class="mx-2" href="{{ $author->profile()->twitter }}">
    												    <i class="fa-brands fa-twitter"></i>
    												</a>
												@endif
												
												@if ($author->profile()->github ?? null)
    												<a class="mx-2" href="{{ $author->profile()->github }}">
    												    <i class="fa-brands fa-github"></i>
    												</a>
												@endif
                                            </div>
                                        </div>
                                    </div>

									<div itemprop="articleBody">
										@if ($active_page == 'info')
											<section class="w-full">
												<div class="w-full my-8 text-xs text-gray-600 shadow rounded-sm overflow-hidden sm:text-base sm:mx-auto">
													<ul class="w-full">
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																College Name:</p>
															<p class="text-left pl-4">{{ $college->name }}</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																State:</p>
															<p class="text-left pl-4">{{ $college->state->name }}</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Official Website:</p>
															<p class="text-left pl-4">{{ $college->website }}</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																City:</p>
															<p class="text-left pl-4">{{ $college->city->name }}</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Streams:</p>
															<p class="text-left pl-4">
																@foreach($college->stream as $stream)
																	{{ $stream->name . ",   " }}
																@endforeach
															</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Courses:</p>
															<p class="text-left pl-4">
																@foreach($college->courses as $course)
																	{{ $course->name . ",   " }}
																@endforeach
															</p>
														</li>
														
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																College Type:</p>
															<p class="text-left pl-4">
																@foreach($college->collegeType as $type)
																	{{ $type->name . ",   " }}
																@endforeach
															</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Entrance Exams:</p>
															<p class="text-left pl-4">
																@foreach($college->entrance as $exam)
																	{{ $exam->name . ",   " }}
																@endforeach
															</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-black-900">
																Contact Details:</p>
															<p class="text-left pl-4">
																@foreach($college->contacts as $contact)
																	{{ $contact->contact_number . ",   " }}
																@endforeach
															</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Location:</p>
															<p class="text-left pl-4">{{ $college->location }}</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Estd:</p>
															<p class="text-left pl-4">{{ $college->estd }}</p>
														</li>
														<li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
																Affiliates:</p>
															<p class="text-left pl-4">
															    @foreach ($college->affiliated as $aff)
															        {{ $aff->name }} |
															    @endforeach
															</p>
														</li>
														<!--<li class="odd:bg-amber-200 p-4 sm:p-6">Email Address</li>-->
													</ul>
												</div>
											</section>
										@endif
										
										@if ($active_page == 'course')
										    <section class="w-full">
												<div class="w-full my-8 text-xs text-gray-500 shadow rounded-sm overflow-hidden sm:text-base sm:mx-auto">
													<ul class="w-full">
													    @foreach ($college->courses as $index => $course)
                                                            <li class="w-full flex justify-start odd:bg-[#dbdaca] p-4 sm:p-6">
    															<p class="min-w-[4rem] max-w-[4rem] sm:min-w-[8rem] sm:max-w-[8rem] font-semibold text-gray-900">
    																{{ $index + 1 }}</p>
    															<p class="text-left pl-4">{{ $course->name }}</p>
    														</li>													    
													    @endforeach
													</ul>
												</div>
											</section>
										@endif
										
										@include('pages.detail.toc', ['content' => $college->tocMenu ?? null])
										
										<section id="custom_content">
											<h2 style="width: 100%; text-align: center;">{{ $title }}</h2>
											{!! $college->info_page ?? '' !!}
										</section>

                                        <button id="open-comments" class="px-6 py-3 bg-orange-500 text-white font-bold text-lg rounded-lg mt-10 outline-none box-border border-orange-500 transform-colors border-2 hover:bg-white hover:text-orange-500">Comments and Reviews</button>

										@include('comments_and_reviews', ['comments' => $college->comments, 'reviews' => $college->reviews, 'author' => $author, 'posted_on' => $college->slug])

									</div>

									<span style="display: none" itemprop="publisher" itemscope
										  itemtype="https://schema.org/Organization">
										<meta itemprop="name" content="{{ SystemConfig::get('app-name') }}">
										<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
											<meta itemprop="url" content="{{ url('/logo.png') }}">
											<meta itemprop="width" content="320">
											<meta itemprop="height" content="60">
										</span>
									</span>
								</article>
							</div>
						</div>
						<!-- /tab-content -->
					</div>
					<!-- /tabs_detail -->
				</div>
				<!-- /tabs_detail -->
			</div>
			<!-- /box_general -->
			<!-- /col -->
			<div class="col-lg-3" id="sidebar_fixed">
				<ul class="share-buttons">
					<li><a class="fb-share"
						   href="https://www.facebook.com/share.php?u={{ url()->current() }}&title={{ $college->name }}"
						   target="blank"><i class="social_facebook"></i> Share</a></li>
					<li><a class="twitter-share"
						   href="https://twitter.com/intent/tweet?status={{ $college->name }}+{{ url()->current() }}"
						   target="blank"><i class="social_twitter"></i> Share</a></li>
					<li><a class="telegram-share"
						   href="https://t.me/share/url?url={{ url()->current() }}&text={{ $college->name }}"
						   target="blank"><i class="fab fa-telegram"></i> Share</a></li>
					<li><a class="whatsapp-share" href="https://wa.me/?text={{ url()->current() }}"
						   data-action="share/whatsapp/share" target="blank"><i class="fab fa-whatsapp"
																				style=" font-size:14px"></i> Share</a>
					</li>
				</ul>

				<div class="box_general shadow">
					<h5 class="text-center" style="padding: 14px">Courses After 12th</h5>
				</div>

                <div class="w-full mt-8">
                    @if ($widget_html)
                        {!! $widget_html !!}
                    @else
                        <div class="px-6 py-3 bg-orange-500 text-white font-bold text-lg rounded-lg mt-10 outline-none box-border border-orange-500 transform-colors border-2 hover:bg-white hover:text-orange-500"><ul>
	
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/courses-after-12th-science/">Science Courses After 12th</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/courses-after-12th-arts/">Arts Courses List After 12th</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/commerce-courses-after-12th/">Commerce courses after 12th</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/paramedical-courses/">Paramedical Courses After 12th</a></span></li>

</ul>

</div>
                    @endif
                </div>
                
                <div class="w-full mt-8">
                    @if ($widget_html)
                        {!! $widget_html !!}
                    @else
                        <div class="px-6 py-3 bg-blue-500 text-white font-bold text-lg rounded-lg mt-10 outline-none box-border border-blue-500 transform-colors border-2 hover:bg-white hover:text-blue-500"><ul>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/ba/">BA Admission</a>&nbsp;</span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/b-sc-courses/">B.Sc Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/what-is-b-com/">B.Com Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/b-tech/">B.Tech Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/b-arch/">B.Arch Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/bba-courses-after-12th/">BBA Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/bds/">BDS Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/bsw/">BSW Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/bhmct/">BHMCT Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/bpt/">BPT Admission</a></span></li>
	<li style="text-align:justify"><span style="font-size:14px"><a href="https://studywoo.com/bsw/">BSW Admission</a></span></li>
</ul>

</div>
                    @endif
                </div>
                
                
                

                <div class="w-full rounded-md overflow-y-auto flex flex-col items-stretch justify-evenly text-xs py-4">
                    
                    	<div class="box_general shadow">
					<h5 class="text-center" style="padding: 10px">Students Also Visit</h5>
				</div>
                    
                    @foreach ($college->getRelatedCollege() as $collegeDetail)
    					@if ($collegeDetail->slug != $college->slug)
    					    <a href="{{ route('collegeDetail', ['college' => $collegeDetail->slug]) }}" class="flex items-center justify-start rounded shadow h-16 bg-white pr-2 my-4 relative hover:bg-gray-100">
                                <img src="{{ asset('photos/'. $collegeDetail->logo_path .'.webp') }}" class="w-12 h-10 rounded-full mx-3">
                                <div class="h-full w-full flex flex-col justify-start">
                                    <p class="pt-2 text-sm">{{ $collegeDetail->city->name }}</p>
                                    <p class="w-full text-gray-500 text-clip" style="-webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; display: -webkit-box;">{{ $collegeDetail->name }}</p>
                                </div>
                                <div class="absolute top-0 right-0 -translate-y-full bg-teal-500 text-white h-6 w-8 rounded-t flex items-center justify-center font-semibold text-sm">
                                    {{ $collegeDetail->getAverageRating() }}/5
                                </div>
                            </a>
    					@endif
    				@endforeach                    
                </div>
                
			</div>
		</div>
	</div>
@endsection

@push('script')
<script defer>
    document.getElementById("open-comments").addEventListener("click", (e) => {
        e.stopPropagation();
        toggleCommentReviewSection();
    });
</script>
@endpush
