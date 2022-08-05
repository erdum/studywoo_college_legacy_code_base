<section id="comments-reviews-section" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-11/12 flex flex-col md:w-6/12 aspect-[3/4] md:aspect-[6/4] z-30 shadow-xl rounded-md bg-white transition-transform overflow-hidden scale-0">
    <div class="w-full flex items-center mt-2 py-2 text-gray-500 text-sm md:test-base relative after:content-[''] after:w-1/2 after:absolute after:bottom-0 after:bg-orange-500 after:h-1 after:transition-transform">
        <button class="w-1/2 font-semibold transition-colors text-orange-500 hover:outline-none">Comments</button>
        <button class="w-1/2 font-semibold transition-colors hover:outline-none">Reviews</button>
    </div>
    <div class="w-[200%] flex transition-transform flex-auto">
        <div id="comments-box" class="w-1/2 h-full flex flex-col items-stretch justify-start px-4 md:px-16 pt-8">
        	<form method="POST" action="api/comment" class="h-8 px-3 flex flex-col items-stretch text-sm text-gray-500 border border-gray-400 rounded-lg overflow-x-hidden overflow-y-hidden transition-all focus-within:h-48">
        		<textarea class="focus:outline-none shrink-0 px-1 py-1 resize-none overflow-y-hidden focus:overflow-y-auto" autocomplete="off" rows="3" placeholder="write a comment..." name="body"></textarea>
        		<input type="hidden" name="posted_on" value="{{ $posted_on }}">
        		<div class="flex-auto flex flex-col items-stretch justify-end mb-1">
        			<input class="my-1 px-2 py-0.5 border border-gray-400 rounded-md focus:outline-none" type="email" name="email" placeholder="email">
        			<input class="my-1 px-2 py-0.5 border border-gray-400 rounded-md focus:outline-none" type="text" name="name" placeholder="name">
        			<div class="flex items-center justify-between my-2">
        				<button type="submit" class="px-3 py-0.5 rounded-md box-border border border-orange-500 bg-orange-500 text-white hover:bg-white hover:text-orange-500 transition-colors">Post</button>
        				<button type="reset" class="px-3 py-0.5 rounded-md box-border border border-gray-400 hover:bg-gray-400 hover:text-white transition-colors">Cancel</button>
        			</div>
        		</div>
        	</form>
            <div class="flex-auto mt-4 relative">
        		<div class="absolute top-0 bottom-0 w-full overflow-y-auto flex flex-col items-stretch text-base text-gray-800">
        		    @foreach ($comments as $comment)
                		<div class="mb-4">
                			<div class="w-full flex items-center p-2">
                				<img class="w-8 h-8 rounded-full mr-2" loading="lazy" src="https://avatars.dicebear.com/api/initials/{{ explode('@', $comment->posted_by)[1] }}.svg" alt="user avatar">
                				<p class="flex-auto flex items-center justify-between">{{ explode('@', $comment->posted_by)[1] }}<span class="text-xs mx-2 text-gray-500 leading-tight">{{ $comment->created_at->format('Y-M-d') }}</span></p>
                			</div>
                			<p class="w-full px-12 text-gray-600">{{ $comment->body }}</p>
                		</div>
                		@if (!($comment->reply == null))
                    		<div class="mb-8 ml-4">
                    			<div class="w-full flex items-center p-2">
                    				<img class="w-8 h-8 rounded-full mr-2" loading="lazy" src="https://avatars.dicebear.com/api/initials/{{ $author->name }}.svg" alt="user avatar">
                    				<p class="flex-auto flex items-center justify-between">{{ $author->name }}<span class="text-xs mx-2 text-gray-500 leading-tight">{{ $comment->updated_at->format('Y-M-d') }}</span></p>
                    			</div>
                    			<p class="w-full px-12 text-gray-600">{{ $comment->reply }}</p>
                    		</div>
                    	@endif
                    @endforeach
        		</div>
        	</div>
        </div>
        <div id="reviews-box" class="w-1/2 h-full flex flex-col items-stretch justify-start px-4 md:px-16 pt-8">
        	<form method="POST" action="api/review" class="h-8 px-3 flex flex-col items-stretch text-sm text-gray-500 border border-gray-400 rounded-lg overflow-x-hidden overflow-y-hidden transition-all focus-within:h-56">
        		<textarea class="focus:outline-none shrink-0 px-1 py-1 resize-none overflow-y-hidden focus:overflow-y-auto" autocomplete="off" rows="3" placeholder="write a review..." name="body"></textarea>
        		<input type="hidden" name="posted_on" value="{{ $posted_on }}">
        		<div class="flex-auto flex flex-col items-stretch justify-end mb-1">
        			<select name="rating" autocomplete="off" class="my-1 px-2 py-0.5 rounded-md focus:outline-none">
        				<option selected disabled value="">Rating</option>
        				<option value="1">1</option>
        				<option value="2">2</option>
        				<option value="3">3</option>
        				<option value="4">4</option>
        				<option value="5">5</option>
        			</select>
        			<input class="my-1 px-2 py-0.5 border border-gray-400 rounded-md focus:outline-none" type="email" name="email" placeholder="email">
        			<input class="my-1 px-2 py-0.5 border border-gray-400 rounded-md focus:outline-none" type="text" name="name" placeholder="name">
        			<div class="flex items-center justify-between my-2">
        				<button type="submit" class="px-3 py-0.5 rounded-md box-border border border-orange-500 bg-orange-500 text-white hover:bg-white hover:text-orange-500 transition-colors">Post</button>
        				<button type="reset" class="px-3 py-0.5 rounded-md box-border border border-gray-400 hover:bg-gray-400 hover:text-white transition-colors">Cancel</button>
        			</div>
        		</div>
        	</form>
        	<div class="flex-auto mt-4 relative">
        		<div class="absolute top-0 bottom-0 w-full overflow-y-auto flex flex-col items-stretch text-base text-gray-800">
                    @foreach ($reviews as $review)        		    
                		<div class="mb-4">
                			<div class="w-full flex items-center p-2">
                				<img class="w-8 h-8 rounded-full mr-2" loading="lazy" src="https://avatars.dicebear.com/api/initials/{{ explode('@', $review->posted_by)[1] }}.svg" alt="user avatar">
                				<p class="flex-auto flex items-center justify-between">{{ explode('@', $review->posted_by)[1] }}<span class="text-xs mx-2 text-gray-500 leading-tight">{{ $review->created_at->format('Y-M-d') }}</span></p>
                			</div>
                			<div class="flex items-center px-12 mb-2 text-yellow-500 text-xs">
                			    @for ($i = 1; $i <= 5; $i++)
                			        @if ($i <= $review->rating)
                        				<i class="fa-solid fa-star"></i>
                        			@else
                        				<i class="fa-regular fa-star"></i>
                    				@endif
                				@endfor
                			</div>
                			<p class="w-full px-12 text-gray-600">{{ $review->body }}</p>
                		</div>
                	@endforeach
        		</div>
            </div>
        </div>
    </div>
</section>

@push('script')
<script type="text/javascript" defer>
const toggleCommentReviewSection = () => {
    const section = document.getElementById("comments-reviews-section");
    section.classList.toggle("scale-100");
    
    if (section.classList.contains("scale-100")) {
        document.body.style.setProperty("overflow-y", "hidden");
    } else {
        document.body.style.setProperty("overflow-y", "auto");
    }
};

const toggleCommentsReviewsTab = (e) => {
    e.stopPropagation();
    const tabContainer = document.querySelector("#comments-reviews-section div");
    const btns = tabContainer.children;
    const contentSection = tabContainer.nextElementSibling;
    tabContainer.classList.toggle("after:translate-x-full");
    btns[0].classList.toggle("text-orange-500");
    btns[1].classList.toggle("text-orange-500");
    contentSection.classList.toggle("-translate-x-1/2");
};

document.querySelector("#comments-reviews-section div").addEventListener("click", toggleCommentsReviewsTab);
document.getElementById("comments-reviews-section").addEventListener("click", (e) => {
    e.stopPropagation();
});
document.addEventListener("click", () => {
    const box = document.getElementById("comments-reviews-section");
    if (box.classList.contains("scale-100")) toggleCommentReviewSection();
});
</script>
@endpush