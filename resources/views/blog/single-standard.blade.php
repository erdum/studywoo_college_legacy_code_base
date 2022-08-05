@extends('layouts.header', [
    'title' => $blog->meta_title,
    'meta_description' => $blog->meta_description,
    'meta_keywords' => '',
    'faqs' => $blog->faqs
])

@section('main')

    <section class="
		w-full
		p-6
	">
		<article class="
			w-full
			flex
			flex-col
			items-center
		">
			<div class="
				w-full
				my-4
				mb-12

				md:my-8
			">
				<h1 class="
					w-full
					text-black
					text-4xl
					font-medium
					text-center

					md:text-5xl
				">{{ $blog->title }}</h1>
				<time class="
					inline-block
					w-full
					text-center
					text-gray-500
					my-2

					md:my-4
				">{{ $blog->created_at->format('d M Y') }}</time>
			</div>
			{!! html_entity_decode($blog->body) !!}
			<!--                        USER Data Required here                         -->
			<div class="
				w-full
				flex
				flex-col
				items-center
				justify-start
				my-20
			">
				<img class="
					w-16
					h-16
					rounded-full

					md:w-24
					md:h-24
				" src="{{ $blog->user->avatar ? asset('photos/' . $blog->user->avatar . '.webp') : 'https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png' }}" alt="author avatar">
				<h4 class="
                	text-black
                	my-6
                	font-medium
                	text-lg

                	md:text-2xl
                ">
					<a href="#0">{{ $blog->user->name }}</a>
				</h4>
				<p class="
                	w-full
                	text-center
                	text-gray-600
                	leading-7

                	md:w-4/5

                	lg:w-3/5
                ">{!! $blog->user->profile()->about !!}
				</p>
				<!--Social links-->
			</div>
			
			@if ($nextPost || $prevPost)
			<div class="
            	w-full
            	flex
            	flex-col
            	items-center
            	justify-between
            	divide-y
            	border-y

            	md:w-4/5
            ">
			    @if ($prevPost)
				<a href="#0" rel="prev" class="
                	w-full
                	py-4
                	my-1
                	flex
                	items-center
                	justify-between
                	text-gray-800

                	md:py-6
                	md:text-xl
                ">
					<i class="fa-solid fa-arrow-left"></i>
					<p>
						{{ $prevPost->title }}
					</p>
				</a>
				@endif
				
				@if ($nextPost)
				<a href="#0" rel="next" class="
                	w-full
                	py-4
                	my-1
                	flex
                	items-center
                	justify-between
                	text-gray-800

                	md:py-6
                	md:text-xl
                ">
					<p>
						{{ $nextPost->title }}
					</p>
					<i class="fa-solid fa-arrow-right"></i>
				</a>
				@endif
			</div>
			@endif
		</article>
	</section>

    @include('comments_and_reviews', ['comments' => $blog->comments, 'reviews' => $blog->reviews, 'author' => $blog->user])

@endsection
