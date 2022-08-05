@foreach ($subpages as $subpage)
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <div class="strip">
            <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{ $subpage->featuredImages ? asset('photos/' . json_decode($subpage->featuredImages)[0] . '.webp') : asset('img/lazy-placeholder.png') }}" class="img-fluid lazy" alt="">
                <a href="{{ route('collegeDetail', ['college' => $subpage->slug]) }}"
                    class="strip_info">
                    <div class="item_title">
                        <h6 class="text-white">{{ $subpage->title }} -
                            {{ $subpage->name }}</h6>
                    </div>
                </a>
            </figure>
        </div>
    </div>
@endforeach
