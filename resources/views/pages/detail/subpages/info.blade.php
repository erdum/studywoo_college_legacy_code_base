 @push('style')
     <style>
         table {
             border-collapse: collapse;
             background-color: lightgray;
             width: 100%;
             display: block;
             overflow: auto;
         }

         tr {
             border-bottom: 1px solid rgba(0, 0, 0, 0.1);
             ;
             height: 4rem;
             /* 80px */
         }

         tr>td:first-child {
             font-family: Inter;
             font-style: normal;
             font-weight: 600;
             font-size: 1.05rem;
             /* 20px */
             line-height: 1.25rem;
             /* 28px */
             color: #0B131A;

             padding: 0 2rem;
         }

         tr>td:last-child {
             font-family: Inter;
             font-style: normal;
             font-weight: 400;
             font-size: 1rem;
             /* 16px */
             line-height: 1.5rem;
             /* 24px */
             color: #5E5E5E;
             word-wrap: break-word;
             word-break: break-word;
             padding: 0 2rem;


             /* width: 100%; */
         }

         .articleBody {
             margin-top: 30px
         }

         table td {
             overflow: auto;
             /* max-width: 100%; */
             word-wrap: break-word
         }

     </style>

 @endpush






 <article itemscope itemtype="https://schema.org/Article">

     <meta itemprop="mainEntityOfPage" content="{{ url('/') }}">
    

     <meta itemprop="headline" content="{{ $college->name }}">
     <meta itemprop="datePublished" content="{{ $subpage->created_at }}">
     @if ($college->featuredImage(true))
         <meta itemprop="image" content="{{ asset($college->featuredImage(true)) }}" />
     @endif
     <div>
         <div class="main_info_wrapper">
             <section itemprop="author" itemscope itemtype="https://schema.org/Person">
                 <div class="main_info clearfix">
                     <div class="user_thumb">
                         <figure>
                             <a href="{{ route('getAuthor', ['author' => $subpage->author->username]) }}">
                                 <img itemprop="avatar" src="{{ asset($subpage->author->adminDetail->avatar) }}"
                                     alt="">
                             </a>
                         </figure>
                     </div>

                     <div class="row justify-content-between">

                        
                         <div class="col">
                             <div class="score_in">
                                 <div class="follow_us">
                                     <ul>
                                         @if ($subpage->author->facebook)
                                             <li>
                                                 <a href="{{ asset($subpage->author->facebook) }}">
                                                     <img src="{{ asset('img/facebook_icon.svg') }}" alt=""
                                                         class="lazy">
                                                 </a>
                                             </li>
                                         @endif

                                         @if ($subpage->author->twitter)

                                             <li><a href="#0"><img src="{{ asset('img/twitter_icon.svg') }}" alt=""
                                                         class="lazy"></a>
                                             </li>
                                         @endif

                                         @if ($subpage->author->instagram)
                                             <li><a href="#0"><img src="{{ asset('img/instagram_icon.svg') }}" alt=""
                                                         class="lazy"></a>
                                             </li>
                                         @endif

                                         @if ($subpage->author->linkedin)
                                             <li><a href="#0"><img src="{{ asset('img/linkedin.svg') }}" alt=""
                                                         class="lazy"></a>
                                             </li>
                                         @endif

                                         @if ($subpage->author->github)
                                             <li><a href="#0"><img src="{{ asset('img/github.svg') }}" alt=""
                                                         class="lazy"></a>
                                             </li>
                                         @endif


                                         @if ($subpage->author->skype)
                                             <li><a href="#0"><img src="{{ asset('img/skype.svg') }}" alt=""
                                                         class="lazy"></a>
                                             </li>
                                         @endif
                                     </ul>
                                 </div>
                             </div>
                         </div>


                     </div>
                 </div>
             </section>
         </div>


         <div class="row" style="margin-bottom: 0px;">
             <div class="col-12">
                 <div class="box_general" style=" background-color:gray; color:white;">

                     <div class="main_info_wrapper">
                         <div class="main_info clearfix">

                             @if ($subpage->slug == 'info')
                                 <div class="main_info_wrapper">
                                     <div class="main_info">
                                         <table style="overflow-x: scroll !important; padding-right:10px">
                                             <tbody>
                                                 <tr class="companyItem">
                                                     <td>College Name</td>
                                                     <td>{{ $college->name ? $college->name : 'N/A' }}</td>
                                                 </tr>
                                                 <tr>
                                                     <td>State</td>
                                                     <td>{{ $college->state ? $college->state->name : 'N/A' }}
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>City</td>
                                                     <td>{{ $college->city ? $college->city->name : 'N/A' }}
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Stream</td>
                                                     <td>{{ implode(
    ',',
    $college->stream()->pluck('name')->toArray(),
)
    ? implode(
        ',',
        $college->stream()->pluck('name')->toArray(),
    )
    : 'N/A' }}
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Course</td>
                                                     <td>
                                                         @if ($college->courses != [])
                                                             @foreach ($college->courses as $course)
                                                                 {{ $course->course->name }} <br />
                                                             @endforeach
                                                         @else
                                                             N/A
                                                         @endif

                                                     </td>
                                                 </tr>

                                                 <tr>
                                                     <td>Type of College</td>
                                                     <td>
                                                         {{ implode(
    ',',
    $college->collegeType()->pluck('name')->toArray(),
)
    ? implode(
        ',',
        $college->collegeType()->pluck('name')->toArray(),
    )
    : 'N/A' }}

                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Entrance Exam Accepted</td>
                                                     <td>
                                                         {{ implode(
    ',',
    $college->entrance()->pluck('name')->toArray(),
)
    ? implode(
        ',',
        $college->entrance()->pluck('name')->toArray(),
    )
    : 'N/A' }}
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Course Type</td>
                                                     <td>
                                                         {{ implode(
    ',',
    $college->courseType()->pluck('name')->toArray(),
)
    ? implode(
        '<br/>',
        $college->courseType()->pluck('name')->toArray(),
    )
    : 'N/A' }}
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Contact Number</td>
                                                     <td> {{ implode(
    ',',
    $college->contacts()->pluck('contact_number')->toArray(),
)
    ? implode(
        ',',
        $college->contacts()->pluck('contact_number')->toArray(),
    )
    : 'N/A' }}
                                                     </td>
                                                 </tr>

                                                 <tr>
                                                     <td>Website</td>
                                                     <td>
                                                         @if ($college->website)
                                                             <a href="{{ $college->website }}"
                                                                 target="_blank">{{ $college->website }}
                                                             </a>
                                                         @else
                                                             N/A
                                                         @endif
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Address</td>
                                                     <td>{{ $college->location ? $college->location : 'NA' }}
                                                     </td>
                                                 </tr>
                                             </tbody>

                                         </table>
                                     </div>

                                 </div>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <br /><br />
         <div itemprop="articleBody"
             class="">
             {!! $subpage->content !!}
         </div>

         <span style=" display: none"
             itemprop="publisher" itemscope itemtype="https://schema.org/Organization">

             


             <meta itemprop="name" content="{{ SystemConfig::get('app-name') }}">
             <meta itemprop="logo" content="{{ url('/logo.png') }}">
             <!--<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">-->
             <!--    <meta itemprop="url" content="{{ url('/logo.png') }}">-->
             <!--    <meta itemprop="width" content="320">-->
             <!--    <meta itemprop="height" content="60">-->
             <!--</span>-->
             </span>
         </div>

 </article>
