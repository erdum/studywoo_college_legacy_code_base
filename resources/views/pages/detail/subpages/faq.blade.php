

<div  id="faq" style="padding:  30px">
    <h6 style="margin-bottom: 10px">Frequently Asked Questions</h6>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        @foreach ($college->faq as $faq)
            <div class="panel panel-default">
                <div class="panel-heading" id="{{ $faq->faq->id }}" role="tab">
                    <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse"
                            data-parent="#accordion" href="{{ '#id' . $faq->faq->id }}"
                            aria-expanded="false"
                            aria-controls="{{ $faq->faq->id }}">{{ $faq->faq->question }} <i
                                class="fa fa-plus push-right"></i></a></h4>
                </div>
                <div class="panel-collapse collapse" id="{{ 'id' . $faq->faq->id }}" role="tabpanel"
                    aria-labelledby="{{ $faq->faq->id }}">
                    <div class="panel-body">
                        <p>{{ $faq->faq->answer }}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
