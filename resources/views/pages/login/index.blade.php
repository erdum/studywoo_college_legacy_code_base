@extends('layouts.header', [
    'title' => 'Login',
    'meta_description' => '',
    'meta_keywords' => '',
    'faqs' => []
])

@section('main')
    <div class="mx-auto my-16 p-8 bg-white w-4/5 shadow-sm rounded-md sm:w-[360px]">
        <form>
            @csrf
            <div>
                <p class="text-center mb-8 text-slate-500 text-xl font-medium">Login</p>
                <button type="submit" formaction="{{ route('socialLogin', 'google') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-gray-700 flex justify-start items-center hover:bg-gray-500 hover:text-white">
                    <img class="ml-12 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/Google__G__Logo.svg') }}">
                    Google
                </button>
                <button type="submit" formaction="{{ route('socialLogin', 'facebook') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-[#4267B2] text-white flex justify-start items-center transition-shadow hover:shadow-none hover:text-white hover:bg-gray-500">
                    <img class="ml-12 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/facebook-logo-png-38362.jpg') }}">
                    Facebook
                </button>
                <button type="submit" formaction="{{ route('socialLogin', 'twitter') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-sky-400 flex justify-start items-center transition-shadow hover:shadow-none hover:text-white hover:bg-gray-500">
                    <img class="ml-12 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/twitter_icon.svg') }}">
                    Twitter
                </button>
                <button type="submit" formaction="{{ route('socialLogin', 'linkedin') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-white text-[#2867b2] flex justify-start items-center transition-shadow hover:shadow-none hover:text-white hover:bg-gray-500">
                    <img class="ml-12 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/linkedin.svg') }}">
                    Linkedin
                </button>
                <button type="submit" formaction="{{ route('socialLogin', 'github') }}" class="my-4 w-full rounded-md shadow-md py-2 bg-slate-400 text-black flex justify-start items-center transition-shadow hover:shadow-none hover:text-white hover:bg-gray-500">
                    <img class="ml-12 mr-8 w-[28px] sm:ml-24" src="{{ asset('img/github_icon.svg') }}">
                    Github
                </button>
            </div>
        </form>
    </div>
@endsection
