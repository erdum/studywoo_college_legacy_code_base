<div class="box_general" id="comments" style="padding:  30px">
    <h5>Comments</h5>
    <ul>
        @foreach ($college->comments as $comment)
            <li itemscope itemtype="http://schema.org/UserComments">
                <meta itemprop="discusses" content="{{ $college->name }}" />
                <div class="avatar">
                    <a href="#"><img src="{{ asset('img/avatar1.jpg') }}" alt="">
                    </a>
                </div>

                <div class="comment_right clearfix">
                    <div class="comment_info">
                        By <span itemprop="creator">{{ $comment->customer->customerDetail->first_name }}
                            {{ $comment->customer->customerDetail->last_name }}</span><span>|</span><span
                            itemprop="commentTime">{{ substr($comment->created_at, 0, 10) }}</span>
                        {{-- <span>|</span><a href="#">Reply</a> --}}
                    </div>
                    <p itemprop="commentText">
                        {{ $comment->comment }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
    @if (auth()->guard('customer')->check())

        <hr />
        <h5>Leave a comment</h5>
        <form method="post" action="{{ route('saveComment') }}">
            @csrf
            <input type="text" value="{{ $college->id }}" name="college_id" hidden>
            <div class="form-group">
                <textarea class="form-control" id="comments2" rows="6" placeholder="Comment" name="comment"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" id="submit2" class="btn_1 add_bottom_15">Submit</button>
            </div>
        </form>


    @endif

</div>
