@foreach ($colleges as $college)
<article class="
    w-full
    my-8
    flex
    flex-col
    items-center
    justify-start
    shadow-lg
    border
    border-slate-300
    bg-white
    
    md:w-72
    ">
    <div class="w-full flex flex-col items-start justify-around px-4 py-2 bg-teal-400 text-white text-xs">
        <h5 class="font-extrabold pb-2 text-sm min-h-[4rem] w-4/5">{{ $college->name }}</h5>
        <h6>
            <i class="fas fa-map-marker-alt"></i>
            {{ $college->city->name }}
        </h6>
    </div>
    <div class="w-full relative">
        <img src="{{ $college->featuredImages ? '/photos/' . json_decode($college->featuredImages)[0] . '.webp' : '/college_placeholder.webp' }}" class="w-full h-36">
        <span title="Average Rating" class="w-10 h-10 rounded-full bg-white absolute right-4 top-4 flex items-center justify-center text-teal-400 text-xs">{{ $college->getAverageRating() > 0 ? $college->getAverageRating() . '/5' : '0/5' }}</span>
    </div>
    <a href="{{ '/college/' . $college->slug }}" class="
        w-full
        flex
        flex-col
        items-center
        justify-start
        text-gray-700
        ">
        <div class="
            w-full
            flex
            items-center
            justify-between
            px-2
            pt-2
            ">
            <p class="w-44 text-sm">{{ $college->courses[0]->name ?? '' }}</p>
            <!--<small class="text-teal-400"> &#8377; {{ $college->courses[0]->fees ?? '' }}</small>-->
        </div>
        <div class="
            w-full
            flex
            items-center
            justify-between
            px-2
            pb-2
            text-xs
            ">
            <small>{{ count($college->courses) > 0 ? count($college->courses) . ' Courses' : 'No Courses' }}</small>
            <!--<small>Total Fees</small>-->
        </div>
    </a>
    <a href="{{ '/college/' . $college->slug }}" class="w-full p-2 border-y border-slate-300 flex flex-col items-start justify-evenly">
        <p class="text-sm text-gray-800">Reviews {{ count($college->reviews) > 0 ? ' - ' . count($college->reviews) : '' }}</p>
        <p class="text-xs text-gray-800 pt-2 w-full truncate">{{ count($college->reviews) > 0 ? $college->reviews[0]->body : 'No Reviews' }}</p>
        <small class="text-xs text-teal-400">Read more</small>
    </a>
    <p class="py-3 text-xs text-orange-400 italic font-semibold"><i class="fas fa-medal px-2 text-lg"></i>Studywoo Recomended</p>
    <a href="" class="w-full h-11 bg-teal-400 text-white text-md font-semibold flex items-center justify-center">Apply Now</a>
</article>
@endforeach