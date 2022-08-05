@push('style')
    <style>
        #container {

            margin: 3px auto;
        }

        .videobox {
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
            width: 100%;
            height: 300px;
            float: left;
            padding: 14px;
            margin-right: 20px;
            margin-bottom: 20px;
        }

        .item:hover {
            box-shadow: 0 1px 2px rgba(0, 0, 0, .3);
        }

        ul {
            list-style-type: none;
        }

    </style>
@endpush

<div id="container">
    <ul class="row">

        @foreach ($college->videos as $v)

        <li class="col-md-6 col-sm-10">
            <div class="videobox">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $v->video->url }}" frameborder="0"
                    allow="autoplay; encrypted-media" allowfullscreen></iframe>

                    {{-- <iframe width="892" height="502" src="https://www.youtube.com/embed/2Bjrr3MrcSk" title="YouTube video player"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}

            </div>
            <h4 style="padding: 5px">{{ $v->video->title }}</h4>
        </li>
        @endforeach
    </ul>
</div>
