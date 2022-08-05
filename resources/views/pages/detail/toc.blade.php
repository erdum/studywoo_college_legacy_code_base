@push('style')

<style>
    .toc-menu > ul {
        width: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .toc-menu > ul > li {
        width: 100%;
        text-align: left;
        background-color: #f7f4f4;
        padding: 0.25rem 0;
        margin-bottom: 0.6rem;
        padding-left: 1rem;
    }

    .toc-menu > ul > li > a {
        color: #3a4d95;
        font-weight: 500;
        font-size: 0.9rem;
    }
</style>

@endpush

<section class="toc-menu w-full flex flex-col my-16">
    <ui class="w-full py-2 mb-4 bg-gray-300 text-black text-md font-semibold text-center">Table of contents</ui>
    {!! $content !!}
</section>