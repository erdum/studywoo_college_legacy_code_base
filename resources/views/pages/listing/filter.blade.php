@foreach ($collegeListing as $collegeDetail)
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <div class="strip">
            <figure>
                <img src="/img/lazy-placeholder.png"
                    data-src="{{ $collegeDetail->featuredImage(true) ? asset($collegeDetail->featuredImage(true)) : 'img/lazy-placeholder.png' }}"
                    class="img-fluid lazy" alt="{{ $collegeDetail->name }}" />
                <a href="{{ route('collegeDetail', ['college' => $collegeDetail->slug]) }}" class="strip_info">
                    <div class="item_title">
                        <h6 class="text-white">{{ $collegeDetail->name }} </h6>
                        <small><i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>{{ $collegeDetail->city->name }}
                                ,
                                {{ $collegeDetail->state->name }}</span></small>
                    </div>
                </a>
            </figure>
            <ul>
                {{-- <li>
                <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong>
                </div>
            </li> --}}
            </ul>
        </div>
    </div>
@endforeach
