@extends('layouts.header', [
    'title' => 'Colleges Listing',
    'meta_description' => '',
    'meta_keywords' => '',
    'faqs' => []
])

@push('style')

<link href="{{ asset('frontend/css/booking-sign_up.css') }}" rel="stylesheet">

<style>
    #apply-filters-btn:hover button #filters-display {
        display: block;
    }
    
    #apply-filters-btn:hover button {
        background-color: #E2E8F0;
        color: #F97316;
    }
    
    #apply-filters-btn:hover button #filters-dropdown-animation-icon {
        transform: rotate(180deg);
    }
</style>

@endpush

@section('main')

<dialog id="applynow-dialog" class="z-10 bg-transparent fixed top-1/2 -translate-y-1/2 w-[98%] sm:w-[420px]">
    <div class="box_booking_2">
        <div class="head">
            <div class="title relative">
                <h3 id="apply_college_name"></h3>
                <i onclick="closeApplynowDialog()" class="fa-solid fa-xmark text-2xl cursor-pointer font-semibold absolute right-4 top-1/2 -translate-y-1/2"></i>
            </div>
        </div>
        <!-- /head -->
        <div class="main bg-slate-50">
            <form>
                <input id="collegeId" type="hidden" name="college_id" value="">
                <div class="sign-in-wrapper">
                    <input type="tel" class="w-full my-2 p-2 rounded-lg border-2 border-slate-400" name="phone" id="phone" placeholder="Enter your phone number">
                    <div class="form-group my-2 w-full">
                        <select name="course_id" class="p-2 rounded-lg border-2 border-slate-400 w-full">
                            <option selected disabled>Select Course you want to apply for.</option>
                        </select>
                    </div>
                    <div class="text-center my-4">
                        <!--<input type="submit" value="Apply" class="w-full rounded-md py-2 bg-[#1f2f6a] text-white hover:bg-gray-600">-->
                        <p class="w-full text-center mb-2 text-gray-600 font-semibold">Apply With</p>
                        <button type="submit" formaction="{{ route('socialLogin', 'google') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-gray-700 flex justify-start items-center transition-shadow hover:shadow-none">
                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/Google__G__Logo.svg') }}">
                            Google
                        </button>
                        <button type="submit" formaction="{{ route('socialLogin', 'facebook') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-[#4267B2] text-white flex justify-start items-center transition-shadow hover:shadow-none">
                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/facebook-logo-png-38362.jpg') }}">
                            Facebook
                        </button>
                        <button type="submit" formaction="{{ route('socialLogin', 'twitter') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-sky-400 flex justify-start items-center transition-shadow hover:shadow-none">
                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/twitter_icon.svg') }}">
                            Twitter
                        </button>
                        <button type="submit" formaction="{{ route('socialLogin', 'linkedin') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-[#2867b2] flex justify-start items-center transition-shadow hover:shadow-none">
                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/linkedin.svg') }}">
                            Linkedin
                        </button>
                        <button type="submit" formaction="{{ route('socialLogin', 'github') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-slate-400 text-black flex justify-start items-center transition-shadow hover:shadow-none">
                            <img class="ml-20 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/github_icon.svg') }}">
                            Github
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</dialog>

<section class="w-full flex flex-col md:flex-row md:items-start md:px-4 md:my-16">

    <section class="w-full my-16 px-2 flex flex-col items-center justify-evenly flex-wrap md:m-0 md:justify-start">

        <div class="w-full h-12 bg-white shadow mb-4 mx-6 rounded-sm flex items-center justify-end px-4 hidden md:flex mx-0 relative">
            <p class="m-0 mr-auto text-gray-700 text-md">Filters</p>
            @foreach ($current_filters_list as $active_filter)
                <a href="/listing/{{ preg_replace("/" . $active_filter . "&?/", '', $current_filters_url) }}" title="remove {{ explode('=', $active_filter)[1] }} filter" class="px-2 py-1 mx-2 bg-orange-500 text-white text-sm font-medium rounded-2xl"><i class="fa-solid fa-circle-xmark text-base mr-1"></i>{{ explode('=', $active_filter)[1] }}</a>
            @endforeach
            <div id="apply-filters-btn" class="self-stretch flex items-center cursor-pointer">
                <button title="Apply Filters" class="px-2 py-1 mx-4 bg-orange-500 text-white text-sm font-medium rounded-2xl transition-colors duration-100 ease-out">
                    <i class="fa-solid fa-filter text-base mx-1"></i>
                    Apply Filters
                    <i id="filters-dropdown-animation-icon" class="fa-solid fa-caret-down text-base mx-1 transition-transform duration-200 ease-out"></i>
                    <div id="filters-display" class="hidden overflow-hidden w-1/4 h-[400px] z-10 bg-white text-orange-500 shadow-md absolute right-0 bottom-0 translate-y-full flex flex-col items-stretch justify-start p-4">
                        <div id="filters-btn-wrapper" class="flex items-center justify-start flex-wrap">
                            @foreach ($filter_list as $key => $list)
                                <a id="btn-{{ $key }}" onclick="changeFilter('{{ $key }}')" class="px-2 py-0.5 mx-2 my-1 hover:bg-orange-500 hover:text-white shadow rounded-xl {{ $key == 'stream' ? 'bg-orange-500 text-white' : '' }}">{{ ucfirst($key) }}</a>
                            @endforeach
                        </div>
                        <div id="filters-wrapper" class="w-full h-2/3 mt-8 px-2 flex flex-col items-stretch justify-start relative">
                            <div id="filters-spinner" class="hidden overflow-hidden w-full h-full absolute top-0 left-0 bg-white z-10 flex items-center justify-center">
                                <div class="border-8 border-slate-300 border-t-8 border-t-orange-500 rounded-[50%] w-16 h-16 animate-spin"></div>
                            </div>
                            @foreach ($filter_list as $key => $list)
                            <div id="filter-{{ $key }}" class="{{ $key == 'stream' ? '' : 'hidden' }} w-full h-full flex flex-col items-stretch justify-start overflow-y-scroll">
                                @foreach ($list as $filter)
                                    @if (in_array($key . '=' . $filter->name, $current_filters_list))
                                        <a href="/listing/{{ preg_replace("/" . $key . '=' . $filter->name . "&?/", '', $current_filters_url) }}" class="my-1 w-full rounded-sm text-orange-500 flex items-center justify-start px-2 hover:text-white hover:bg-orange-500"><i class="fa-regular fa-square-check mr-4"></i> {{ $filter->name }}</a>
                                    @else
                                        <a href="/listing/{{ $current_filters_url ? $current_filters_url . '&' : '' }}{{ $key . '=' . $filter->name }}" class="my-1 w-full rounded-sm text-orange-500 flex items-center justify-start px-2 hover:text-white hover:bg-orange-500"><i class="fa-regular fa-square mr-4"></i> {{ $filter->name }}</a>
                                    @endif
                                @endforeach                                
                            </div>
                            @endforeach
                        </div>
                    </div>
                </button>                
            </div>
            <!--<button title="Sort {{ $sort_direction ? 'Descending' : 'Ascending' }}" class="mx-4 text-orange-500 hover:text-orange-400" onclick="changeSortDirection()"><i-->
            <!--        class="fas fa-sort-amount-{{ $sort_direction == 'desc' ? 'up' : 'down' }} ml-2"></i></button>-->
        </div>
        
        <div class="md:hidden w-11/12 min-h-[3rem] bg-white text-teal-500 font-medium text-xl rounded shadow mb-8">
            <span onclick="openMobFilter(event)" class="w-full h-12 px-4 flex items-center justify-between">
                Filters
                <i class="fa-solid fa-circle-chevron-down transition-transform"></i>
            </span>
            
            <div onclick="stopWrapperGoingUp(event)" class="w-full h-0 bg-white text-neutral-500 overflow-hidden transition-all flex flex-col items-stretch justify-start px-6 text-base">
                
                @if (count($current_filters_list) > 0)
                    <ul class="w-full my-4 px-4 py-2 flex items-center justify-start bg-white text-white">
                        @foreach ($current_filters_list as $active_filter)
                            <li class="bg-orange-500 px-2 py-0.5 rounded-3xl">
                                <i class="fa-solid fa-circle-xmark text-base mr-1"></i>
                                <a href="/listing/{{ preg_replace("/" . $active_filter . "&?/", '', $current_filters_url) }}" >{{ explode('=', $active_filter)[1] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                
                <form>
                    <select onchange="changeFilterOnMobile(event)" autocomplete="off" class="px-4 py-2 bg-neutral-500 text-white rounded-md mt-4">
                        @foreach ($filter_list as $key => $item)
                            <option @if($key == 'stream') {{ 'selected' }} @endif>{{ ucfirst($key) }}</option>
                        @endforeach
                    </select>
                </form>
                <ul id="mobile_filter_list" class="text-left mt-8 overflow-y-auto">
                    @foreach ($filter_list as $key => $item)
                        @foreach ($item as $filter)
                            @if ($key == 'stream')
                                <li class="py-1" key="{{ ucfirst($key) }}"><a href="/listing/{{ $key }}={{ $filter->name }}">{{ $filter->name }}</a></li>
                            @else
                                <li class="hidden py-1" key="{{ ucfirst($key) }}"><a href="/listing/{{ $key }}={{ $filter->name }}">{{ $filter->name }}</a></li>
                            @endif
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>

        <section class="w-full flex flex-col items-center justify-start md:flex-row md:flex-wrap md:justify-center" id="college-feed">
            
            @foreach ($colleges as $college)
            <article class="w-11/12 sm:w-[340px] h-[130vw] sm:h-[480px] m-2 relative flex flex-col items-stretch justify-start bg-white shadow-md rounded">
                <div class="w-full pb-10 flex items-center justify-start relative bg-slate-200 rounded-t">
                    <img class="w-20 h-20 rounded-full m-4 bg-white p-2"
                         loading="lazy"
                         src="{{ $college->logo_path ? asset('photos/' . $college->logo_path . '.webp') : asset('photos/placeholder.jpg') }}">
                    <div class="text-xs text-slate-700 font-light mt-4 flex flex-col items-start justify-evenly">
                        <p class="truncate w-32 text-base font-normal">{{ $college->city->name }}</p>
                        <p class="truncate w-32 text-sm">{{ $college->state->name }}</p>
                        <p class="truncate w-32">{{ count($college->collegeType) > 0 ? $college->collegeType[0]->name : '' }}</p>
                    </div>
                    <p class="absolute top-4 right-4 rounded-full text-sm text-white bg-slate-500 p-2">{{ $college->getAverageRating() }}/5</p>
                    <p class="absolute bottom-4 left-4 text-xs py-1 text-white px-2 bg-teal-500 rounded-xl">SW
                        Recommended</p>
                </div>
                <div class="w-full px-4 mt-4">
                    <a id="{{ $college->id }}-name" data-id="{{ $college->id }}" href="{{ route('collegeDetail', ['college' => $college->slug]) }}" class="w-full h-16 text-lg font-medium text-slate-700 hover:text-teal-500">{{ $college->name }}</a>
                </div>
                <div class="w-full px-4 text-slate-600 text-sm flex flex-col items-start justify-evenly">
                    <p class="w-full h-8 truncate text-orange-500 py-1">
                        @foreach ($college->affiliated as $aff)
                        {{ $aff->name }} | 
                        @endforeach
                    </p>
                    <p class="w-full font-medium pt-2 text-white">
                        <a class="bg-teal-500 px-1.5 py-0.5 rounded-2xl transition-colors hover:bg-orange-500 text-xs" href="{{ route('collegeDetail', ['college' => $college->slug, 'page' => 'course']) }}">Courses</a>
                        <a class="ml-2 bg-teal-500 px-1.5 py-0.5 rounded-2xl transition-colors hover:bg-orange-500 text-xs" href="{{ route('collegeDetail', ['college' => $college->slug]) }}">Info</a>
                    </p>
                    <p id="{{ $college->id }}-payload" class="w-full h-8 truncate py-1 mt-2">
                        @foreach ($college->courses as $course)
                        <a data-id="{{ $course->id }}" data-name="{{ $course->name }}">{{ $course->name }} | </a>
                        @endforeach
                    </p>
                    <p class="w-full py-2 text-light text-slate-700">{{ $college->courses->count() }} Courses</p>
                </div>
                <div class="w-full absolute bottom-0 flex flex-col items-stretch justify-start">
                    <a onclick="openApplynowDialog({{ $college->id }})" class="py-3 text-center bg-orange-500 text-white font-medium cursor-pointer">Apply Now</a>
                    <a onclick="openApplynowDialog({{ $college->id }})" class="py-3 text-center bg-teal-500 text-white font-medium rounded-b">Download Prospectus</a>
                </div>
            </article>
            @endforeach
            
        </section>
        
        <div class="w-11/12 md:w-2/6 h-12 flex items-center justify-evenly bg-white rounded-md shadow-md mt-8 md:mt-20 px-4">
            <a href="?page={{ $page - 1 }}" class="text-teal-500 mr-auto"><i class="fa-solid fa-angle-left"></i></a>

            @if ($page == 1)
                @for ($i = 1; $i < 6; $i++)
                    
                    @if ($page == $i)
                        <a class="px-3 py-1 rounded-md bg-teal-500 text-white">{{ $i }}</a>
                    @else
                        <a href="?page={{ $i }}" class="px-3 py-1 rounded-md hover:text-teal-500 text-slate-700">{{ $i }}</a>
                    @endif
                @endfor
            @else
                @for ($i = ($page - 2); $i <= ($page + 2); $i++)
                    
                    @if ($i > 0)
                        @if ($page == $i)
                            <a class="px-3 py-1 rounded-md bg-teal-500 text-white">{{ $i }}</a>
                        @else
                            <a href="?page={{ $i }}" class="px-3 py-1 rounded-md hover:text-teal-500 text-slate-700">{{ $i }}</a>
                        @endif
                    @endif
                @endfor
            @endif

            <a class="px-3 py-1 rounded-md hover:text-teal-500 text-teal-500">...</a>
            
            <a href="?page={{ ($page - 2) + 9 }}" class="px-3 py-1 rounded-md hover:text-teal-500 text-slate-700">{{ ($page - 2) + 9 }}</a>
            
            <a href="?page={{ $page + 1 }}" class="text-teal-500 ml-auto"><i class="fa-solid fa-angle-right"></i></a>
        </div>
    </section>
</section>
@stop

@push('script')
<script>
    const changeFilter = (key) => {
        const btnsWrapper = document.getElementById('filters-btn-wrapper');
        const btns = Array.from(btnsWrapper.children);
        btns.forEach((btn) => {
            btn.classList.remove('bg-orange-500');
            btn.classList.remove('text-white');
            btn.classList.add('hover:bg-orange-500');
            btn.classList.add('hover:text-white');
        });
        const currentBtn = document.getElementById(`btn-${key}`);
        currentBtn.classList.remove('hover:bg-orange-500');
        currentBtn.classList.remove('hover:text-white');
        currentBtn.classList.add('bg-orange-500');
        currentBtn.classList.add('text-white');
        
        const filterWrapper = document.getElementById('filters-wrapper');
        const filters = Array.from(filterWrapper.children);
        filters.forEach((item) => {
            item.classList.add('hidden');
        });
        document.getElementById(`filter-${key}`).classList.remove('hidden');
    };
    
    const openApplynowDialog = (collegeId) => {
        document.getElementById('applynow-dialog').setAttribute('open', true);
        const collegeName = document.getElementById(`${collegeId}-name`).innerText;
        document.getElementById('apply_college_name').innerText = collegeName;
        document.getElementById('collegeId').setAttribute('value', collegeId);
        const coursesRaw = Array.from(document.getElementById(`${collegeId}-payload`).children);
        const courses = coursesRaw.map((course) => {
            return {
                id: course.getAttribute('data-id'),
                name: course.getAttribute('data-name')
            };
        });
        
        const coursesWrapper = document.querySelector("select[name='course_id']");
        const prevCourses = Array.from(coursesWrapper.children);
        prevCourses.forEach((prevCourse) => {
            if (!prevCourse.hasAttribute("disabled")) coursesWrapper.removeChild(prevCourse);
        });
        courses.forEach((course) => {
            const option = document.createElement('option');
            option.setAttribute('value', course?.id);
            option.innerText = course?.name;
            coursesWrapper.appendChild(option);
        });
        
    };
    
    const closeApplynowDialog = () => {
        document.getElementById('applynow-dialog').removeAttribute('open');
    }
    
    const changeFilterOnMobile = ({ target: { value }}) => {
        const list = Array.from(document.getElementById('mobile_filter_list').children);
        list.forEach((item) => {
            const key = item.getAttribute('key');
            if (key === value) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    };
    
    const openMobFilter = (e) => {
        const filterList = e.currentTarget.nextElementSibling;
        const dropIcon = e.currentTarget.children[0];
        
        if (filterList.offsetHeight > 0) {
            filterList.style.setProperty('height', '0');
            dropIcon.style.setProperty('transform', 'rotate(0deg)');
        } else {
            filterList.style.setProperty('height', '22rem');
            dropIcon.style.setProperty('transform', 'rotate(180deg)');
        }
    };
</script>
@endpush
