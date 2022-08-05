<div style="padding:  30px">
    <ul style="list-style: none; margin-bottom:20px;">
        @foreach ($college->courses as $collegeCourse)
            <li style="margin-bottom: 20px">
                <div class="card">
                    <div class="card-header" style="display: block;background-color: rgba(0,0,0,.03);padding:30px">

                        <h5 style="margin-bottom:20px">
                            {{ $collegeCourse->course->name }}
                        </h5>
                        <div class="card-content" style="padding-left:40px">
                            <div class="headers" style="margin-bottom:20px">
                                <div class="inline">
                                    <span>
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $collegeCourse->duration  }} Years</span>
                                    </span>
                                    <span>
                                        <i class="fas fa-graduation-cap"></i>
                                        <span>{{ $collegeCourse->type ?  $collegeCourse->type->name : ""}}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="details">
                                <span>
                                    Entrance Exam :<b> {{ $collegeCourse->entranceExam ?  $collegeCourse->entranceExam->name : ""}}</b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>
