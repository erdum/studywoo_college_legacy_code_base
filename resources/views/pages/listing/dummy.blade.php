@extends('layouts.master',[
    'title' => 'Colleges Listing',
    'meta_description' => '',
    'meta_keywords' => '',
    'faqs' => null
])

<aside class="
    hidden

    md:w-3/12
    md:mr-4
    md:shadow-md
    md:bg-white
    md:flex
    md:flex-col
    md:justify-center
    md:rounded-sm
    md:text-sm
    ">
        <div class="p-4 text-gray-400">
            Found <span class="text-gray-700">{{ $count }}</span> Colleges
        </div>

        @foreach ($filter_list as $key => $value)

        <div class="
        px-4
        py-3
        flex
        justify-between
        items-center
        bg-gray-200
        text-gray-700
        relative
        cursor-pointer

        before:absolute
        before:left-0
        before:top-0
        before:h-full
        before:w-1
        before:bg-[{{ rand_color() }}]
    " data-collapse="true" onclick="handleFilterListClick(event);">
            {{ ucfirst($key) }}
            <i class="fas fa-angle-up rotate-180 text-2xl font-light transition-all duration-200 ease-out"></i>
        </div>
        <div class="
        flex
        flex-col
        items-center
        justify-start
        py-2
        px-4
        overflow-hidden
    ">
            <div class="
            w-full
            flex
            items-center
            justify-between
            border
            border-gray-400
            px-2
            py-1
            text-gray-700
            my-2
        ">
                <i class="fas fa-search mr-4 text-gray-400"></i>
                <input class="w-full focus:outline-none" name="{{ $key }}" oninput="searchInput(event);"
                       placeholder="Search {{ ucfirst($key) }}"
                       type="text">
            </div>
            <ul class="
            w-full
            h-40
            flex
            flex-col
            items-center
            justify-start
            my-2
            text-gray-500
            overflow-auto
        ">
                @foreach ($value as $item)
                <li class="w-full">
                    @if (in_array($item->name, explode('/', $prevFilters)))
                    <a class="
                        w-full
                        flex
                        items-center
                        justify-start
                        mb-2
                        cursor-pointer
                        hover:text-orange-400
                    "
                       href="{{ '/listing/' . implode('/', array_diff(explode('/', $prevFilters), array($item->name))) }}">
                        <i class="far fa-square-check text-orange-500 mr-4"></i>
                        {{ $item->name }}
                    </a>
                    @else
                    <a class="
                        w-full
                        flex
                        items-center
                        justify-start
                        mb-2
                        cursor-pointer
                        hover:text-orange-400
                    " href="{{ '/listing/' . $prevFilters . '/' . $item->name }}">
                        <i class="far fa-square mr-4"></i>
                        {{ $item->name }}
                    </a>
                    @endif
                </li>

                @endforeach
            </ul>
        </div>

        @endforeach

    </aside>

@section('extra')
<aside class="h-12 flex justify-even items-stretch text-orange-500 bg-white fixed bottom-0 z-10 divide-x divide-orange-500 md:hidden"
       style="width: 100vw;">
    <button class="grow" onclick="openMobFilterBar();">Filter<i class="fa-solid fa-filter ml-2"></i></button>
    <button class="grow">Sort<i class="fa-solid fa-arrow-down-wide-short ml-2"></i></button>
</aside>

<aside class="fixed top-0 right-0 w-0 h-screen overflow-scroll bg-amber-200 z-20 flex flex-col items-start justify-start md:hidden"
       id="mob-filter-bar">
    <button class="absolute top-0 left-0 text-xl pt-10 pl-6" onclick="closeMobFilterBar();">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    <div class="mt-16 p-4 text-gray-400">
        Found <span class="text-gray-700">{{ $count }}</span> Colleges
    </div>
    <div>

    </div>
    <ul class="w-full">
        @foreach ($filter_list as $key => $value)
        <li class="m-4 bg-white h-40 overflow-scroll">
            <p class="w-full px-2 py-1 bg-gray-300">{{ ucfirst($key) }}</p>
            <ul>
                @foreach ($value as $item)
                @if (in_array($item->name, explode('/', $prevFilters)))
                <li><a class="text-blue-500 mx-2 my-4"
                       href="{{ '/listing/' . implode('/', array_diff(explode('/', $prevFilters), array($item->name))) }}">{{
                    $item->name }}</a></li>
                @else
                <li><a class="text-gray-500 mx-2 my-4" href="{{ '/listing/' . $prevFilters . '/' . $item->name }}">{{
                    $item->name }}</a></li>
                @endif
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</aside>
@stop




@push('style')
    <!-- SPECIFIC CSS -->
    <!--<link href="{{ asset('css/detail-page.css') }}" rel="stylesheet">-->

    <!--<style>-->
    <!--    .profile-image {-->
    <!--        width: 300px;-->
    <!--        height: 300px;-->
    <!--    }-->

    <!--    .holder {-->
    <!--        position: absolute;-->
    <!--        bottom: 0px;-->
    <!--    }-->

    <!--    .score_in {-->
    <!--        text-align: left !important;-->
    <!--    }-->

    <!--</style>-->

    <style>
        .show_spinner {
            display: block !important;
        }

        .overlay__inner {
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);

            display: none;
            background-color: #ffffff7d;
            z-index: 99999;

            width: 100vw;
            height: 100vh;

        }


        .overlay__content {
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner {
            z-index: 99999;
            width: 75px;
            height: 75px;
            display: inline-block;
            border-width: 2px;
            border-color: rgba(255, 255, 255, 0.05);
            border-top-color: rgb(14, 13, 13);
            animation: spin 1s infinite linear;
            border-radius: 100%;
            border-style: solid;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
@endpush

@section('content')

<?php
    function rand_color() {
        return '#' . dechex(rand(0x000000, 0xFFFFFF));
    }
?>

<section class="w-full flex flex-col md:flex-row md:items-start md:px-4 md:my-16">
    
    <aside class="
        hidden
    
        md:w-3/12
        md:mr-4
        md:shadow-md
        md:bg-white
        md:flex
        md:flex-col
        md:justify-center
        md:rounded-sm
        md:text-sm
        ">
        <div class="p-4 text-gray-400">
            Found <span class="text-gray-700">{{ $count }}</span> Colleges
        </div>
        
        @foreach ($filter_list as $key => $value)
        
        <div data-collapse="true" onclick="handleFilterListClick(event);" class="
            px-4
            py-3
            flex
            justify-between
            items-center
            bg-gray-200
            text-gray-700
            relative
            cursor-pointer

            before:absolute
            before:left-0
            before:top-0
            before:h-full
            before:w-1
            before:bg-[{{ rand_color() }}]
        ">
            {{ ucfirst($key) }}
            <i class="fas fa-angle-up rotate-180 text-2xl font-light transition-all duration-200 ease-out"></i>
        </div>
        <div class="
            flex
            flex-col
            items-center
            justify-start
            py-2
            px-4
            overflow-hidden
        ">
            <div class="
                w-full
                flex
                items-center
                justify-between
                border
                border-gray-400
                px-2
                py-1
                text-gray-700
                my-2
            ">
                <i class="fas fa-search mr-4 text-gray-400"></i>
                <input oninput="searchInput(event);" class="w-full focus:outline-none" type="text" name="{{ $key }}" placeholder="Search {{ ucfirst($key) }}">
            </div>
            <ul class="
                w-full
                h-40
                flex
                flex-col
                items-center
                justify-start
                my-2
                text-gray-500
                overflow-auto
            ">
                @foreach ($value as $item)
                    <li class="w-full">
                        @if (in_array($item->name, explode('/', $prevFilters)))
                        <a href="{{ '/listing/' . implode('/', array_diff(explode('/', $prevFilters), array($item->name))) }}" class="
                            w-full
                            flex
                            items-center
                            justify-start
                            mb-2
                            cursor-pointer
                            hover:text-orange-400
                        ">
                            <i class="far fa-square-check text-orange-500 mr-4"></i>
                            {{ $item->name }}
                        </a>
                        @else
                        <a href="{{ '/listing/' . $prevFilters . '/' . $item->name }}" class="
                            w-full
                            flex
                            items-center
                            justify-start
                            mb-2
                            cursor-pointer
                            hover:text-orange-400
                        ">
                            <i class="far fa-square mr-4"></i>
                            {{ $item->name }}
                        </a>
                        @endif
                    </li>
                
                @endforeach
            </ul>
        </div>
        
        @endforeach
        
    </aside>
    
    <section class="w-full mt-16 px-2 flex flex-col items-center justify-evenly flex-wrap md:m-0 md:justify-start">
        
        <div class="
            w-full
            h-12
            bg-white
            shadow-md
            mb-4
            mx-6
            rounded-sm
            flex
            items-center
            justify-end
            px-4
            hidden
            
            md:flex
            mx-0
        ">
            <p class="m-0 mr-auto text-gray-700 text-md">Sort By</p>
            <a href="#" class="mx-4 text-gray-400 text-sm hover:text-orange-400">Highest Fees <i class="fas fa-sort-amount-up"></i></a>
            <a href="#" class="mx-4 text-gray-400 text-sm hover:text-orange-400">Lowest Fees <i class="fas fa-sort-amount-up"></i></a>
            <a href="#" class="mx-4 text-sm text-orange-500 border-b-2 border-orange-500 pb-2">Rating <i class="fas fa-sort-amount-up"></i></a>
        </div>
        
        <section id="college-feed" class="w-full flex flex-col items-center justify-start md:flex-row md:flex-wrap">
            
            @foreach ($colleges as $college)
            
            <article class="w-11/12 sm:w-[330px] h-[120vw] sm:h-[430px] mx-2 relative flex flex-col items-stretch justify-start bg-white shadow-md rounded">
                <div class="w-full flex items-center justify-start relative bg-slate-200 rounded-t">
                    <img src="https://upload.wikimedia.org/wikipedia/en/d/d9/Karachi_University_logo.png" loading="lazy" class="w-20 h-20 rounded-full m-4 bg-white p-2">
                    <div class="text-xs text-slate-700 font-light flex flex-col items-start justify-evenly">
                        <p class="truncate w-20 text-base font-normal">{{ $college->city->name }}</p>
                        <p class="truncate w-20 text-sm">{{ $college->state->name }}</p>
                        <p class="truncate w-20">University</p>
                    </div>
                    <p class="absolute top-4 right-4 rounded-full text-sm text-white bg-slate-500 p-2">4/5</p>
                    <p class="absolute bottom-4 right-4 text-xs py-1 text-white px-2 bg-teal-500 rounded-lg">SW Recommended</p>
                </div>
                <div class="w-full px-4 mt-4">
                    <p class="w-full h-16 text-lg font-medium text-slate-700">Indian Institute Of Management, Bangalore, IIMB</p>
                </div>
                <div class="w-full px-4 text-slate-600 text-sm flex flex-col items-start justify-evenly">
                    <p class="w-full h-8 truncate text-orange-500 py-1"> UGC | AICTE </p>
                    <p class="w-full font-medium pt-2">Tabs</p>
                    <p class="w-full h-8 truncate py-1">
                        <a href="#">Info</a> |
                        <a href="#">Fee Structure</a> |
                        <a href="#">Entrance Exam</a>
                    </p>
                    <p class="w-full py-2 text-light text-slate-700">5 Courses</p>
                </div>
                <div class="w-full absolute bottom-0 flex flex-col items-stretch justify-start">
                    <button class="py-3 bg-orange-500 text-white font-medium">Apply Now</button>
                    <button class="py-3 bg-teal-500 text-white font-medium rounded-b">Download Prospectus</button>
                </div>
            </article>
            
            @endforeach
        </section>
        
    </section>
    
</section>


<div class="overlay__inner">
    <div class="overlay__content"><span class="spinner"></span></div>
</div>
    

@endsection

<aside style="width: 100vw;" class="h-12 flex justify-even items-stretch bg-amber-300 fixed bottom-0 z-10 divide-x divide-stone-600 md:hidden">
    <button onclick="openMobFilterBar();" class="grow">Filter<i class="fa-solid fa-filter ml-2"></i></button>
    <button class="grow">Sort<i class="fa-solid fa-arrow-down-wide-short ml-2"></i></button>
</aside>

<aside id="mob-filter-bar" class="fixed top-0 right-0 w-0 h-screen overflow-scroll bg-amber-200 z-20 flex flex-col items-start justify-start md:hidden">
    <button onclick="closeMobFilterBar();" class="absolute top-0 left-0 text-xl pt-10 pl-6">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    <div class="mt-16 p-4 text-gray-400">
        Found <span class="text-gray-700">{{ $count }}</span> Colleges
    </div>
    <div>
        
    </div>
    <ul class="w-full">
        @foreach ($filter_list as $key => $value)
            <li class="m-4 bg-white h-40 overflow-scroll">
                    <p class="w-full px-2 py-1 bg-gray-300">{{ ucfirst($key) }}</p>
                    <ul>
                        @foreach ($value as $item)
                            @if (in_array($item->name, explode('/', $prevFilters)))
                            <li><a class="text-blue-500 mx-2 my-4" href="{{ '/listing/' . implode('/', array_diff(explode('/', $prevFilters), array($item->name))) }}">{{ $item->name }}</a></li>
                            @else
                            <li><a class="text-gray-500 mx-2 my-4" href="{{ '/listing/' . $prevFilters . '/' . $item->name }}">{{ $item->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
            </li>
        @endforeach
    </ul>
</aside>


@push('script')

    <!-- Infinite scroll script -->
    <script>
    
    let page = 1;
    const total = "{{ $count }}";
    const isFilterActive = {{ $isFilterActive ? true : 0 }};

    function loadDoc(backPosition) {
        if ((page * 5 < total)) {
            page += 1;

            let url = "{{ url()->current() }}";
            url += `/${page}`;
            $.ajax({
                url,
                type: 'GET', // http method
                success: function(data, status, xhr) {
                    $('#college-feed').append(data);
                    spinner.style.setProperty('display', 'none');
        		    loading = false;
        		    window.scrollTo(0, backPosition - 300);
        		    findIncrement(0);
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    page -= 1;
                    spinner.style.setProperty('display', 'none');
        		    loading = false;
                }
            });
        }

    };
    
    const findIncrement = (() => {
        let prevValue = 0;
        const findIncrement = (value) => {
            const holdPrevValue = prevValue;
            prevValue = value + 100;
            return value > holdPrevValue;
        }
        return findIncrement;
    })();
    
    const spinner = document.getElementsByClassName('overlay__inner')[0];
    let loading = false;
    const footerHeight = document.querySelector('footer').clientHeight;
    
    window.addEventListener('scroll', (event) => {
        const { scrollHeight, scrollTop } = document.body;
        
    	if (scrollTop > Number(scrollHeight - footerHeight - 200) && !loading && !isFilterActive) {
            
            if (findIncrement(scrollTop)) {
                console.log('triggered');
    		    spinner.style.setProperty('display', 'block');
    		    loading = true;
    		    loadDoc(scrollTop);
            }
    	}
    });
    
    </script>
    
    
    
    
    <!-- User Menu and features script -->
    <script type="text/javascript">
    
    // const filterSearchText = document.getElementById('mob-filter-search').value;
    // const searchFilter = () => {
    //     console.log(filterSearchText);
    // };
    
    const openMobFilterBar = () => {
        const bar = document.getElementById('mob-filter-bar');
        bar.style.width = "100vw";
    };
    
    const closeMobFilterBar = () => {
        const bar = document.getElementById('mob-filter-bar');
        bar.style.width = '0';
    }
    
    const rotateIcon = (elm, icon) => {
        const nextElm = elm.nextElementSibling;
        if (elm.getAttribute('data-collapse') === 'false') {
            icon.classList.add('rotate-180');
            nextElm.classList.remove('h-0');
            elm.setAttribute('data-collapse', 'true');
        } else {
            icon.classList.remove('rotate-180');
            nextElm.classList.add('h-0');
            elm.setAttribute('data-collapse', 'false');
        }
    }

    const handleFilterListClick = (event) => {
        let elm = event.target;

        if (elm.tagName === 'DIV') {
            const icon = elm.children[0];
            rotateIcon(elm, icon);
        } else if (elm.tagName === 'I') {
            const icon = elm;
            elm = elm.parentElement;
            rotateIcon(elm, icon);
        }
    }
    
    const searchInput = (event) => {
        const input = event.target.value.trim().toLowerCase();
        const list = Array.from(event.target.parentElement.nextElementSibling.children);
        
        if (input && input.length > 0) {
            
            list.forEach((listItem) => {
                listItem.classList.add('hidden');
            });
            
            const filterdList = list.filter((li) => {
                const inputList = Array.from(input);
                return inputList.every((char, index) => {
                    return char === li.innerText.trim().toLowerCase()[index];
                });
            });
            
            filterdList.forEach((listItem) => {
                listItem.classList.remove('hidden');
            });    
            return null;
        }
        
        list.forEach((listItem) => {
            listItem.classList.remove('hidden');
        });
    }
    </script>
@endpush
