@extends('customer::index')

{{-- @section('title','Category') --}}
@push('style')
<link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
@endpush

@section('content')


<div class="container-fluid">

    <div class="box_general">
        <div class="header_box">
            <h2 class="d-inline-block">Reviews List</h2>

            <div class="filter">
                <select name="orderby" class="selectbox">
                    <option value="Any time">Any time</option>
                    <option value="Latest">Latest</option>
                    <option value="Oldest">Oldest</option>
                </select>
            </div>
        </div>
        <button class="btn btn-sm btn-info" type="button" onclick="change_status(1)">Active</button>
        <button class="btn btn-sm btn-primary" type="button" onclick="change_status(0)">Deactive</button>
        <div class="list_general reviews">
            @csrf
            <ul>

                @foreach ($reviews as $review)
                <li>
                    <span>{{ $review->created_at }}</span>
                    <span class="rating"><strong>Rate: {{ $review->average_rating }}</strong></span>

                    <p><input type="checkbox" id="review-{{$review->id}}" value="{{$review->id}}"><span
                            class="badge badge-info text-white">{{($review->review_status == 1) ? "Active" :
                            "Deactive";}}</span>&nbsp;&nbsp;{{ $review->description }}</p>
                    {{-- <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Reply to this review</a></p> --}}
                </li>
                @endforeach

                {{-- <li>
						<span>June 15 2019</span>
						<span class="rating"><strong>Rate: 9.0</strong></span>
						<figure><img src="img/avatar3.jpg" alt=""></figure>
						<h4><small>by</small> G.Lukas</h4>
						<p>Cum id mundi admodum menandri, eum errem aperiri at. Ut quas facilis qui, euismod admodum persequeris cum at. Summo aliquid eos ut, eum facilisi salutatus ne. Mazim option abhorreant ne his. Mel simul iisque albucius at, probatus indoctum efficiendi mei ei. Veniam percipit ei sea.</p>
						<p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
					</li> --}}
            </ul>
        </div>
    </div>
    <!-- /box_general-->
    {{-- <nav aria-label="...">
        <ul class="pagination pagination-sm add_bottom_30">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav> --}}
    <!-- /pagination-->
</div>
<script>
    function change_status(status){
        const statusID = status;
        let _token = $("input[name=_token]").val();
        var selectedValue = [];
        $("input[type=checkbox]:checked").each(function () {
            selectedValue.push($(this).val());
        });
        var formData = {
            status:statusID,
            _token:_token,
            checkbox_ids:selectedValue
        }
        console.log(JSON.stringify(formData));
        $.ajax({
                type:'POST',
                url:"{{route('review_status')}}",
                data:formData,
                dataType: 'json',
                success: function(result){
                    location.reload();
                }
            });
    }
</script>
<!-- /container-fluid-->
@endsection
