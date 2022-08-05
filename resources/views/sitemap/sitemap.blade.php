<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>{{url('/')}}/{{ $post->college->slug }}</loc>
            <priority>1.0</priority>
            <changefreq>daily</changefreq>
            <lastmod>{{ $today = date("Y-m-d"); }}</lastmod>
        </url>
    @endforeach
</urlset>