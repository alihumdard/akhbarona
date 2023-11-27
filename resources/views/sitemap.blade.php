<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($articles as $article)
    <url>
        <loc>{{\App\Helper\Common::article_link($article)}}</loc>
        <lastmod>{{\App\Helper\Common::format_date_atom(($article->last_edited && $article->last_edited != "0000-00-00 00:00:00")?$article->last_edited:$article->created)}}</lastmod>
    </url>
@endforeach
</urlset>
