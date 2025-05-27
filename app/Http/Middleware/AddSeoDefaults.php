<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use romanzipp\Seo\Structs\{Meta, Link, Meta\OpenGraph, Meta\Twitter};
use Symfony\Component\HttpFoundation\Response;

class AddSeoDefaults
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $title = 'Blip Computer School - ';
        $description = 'Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria';
        $site_name = 'blip.school';
        $img_url = asset('img/apple-touch-icon.png');

        if (!is_staging()) {

            // seo()->charset();
            // seo()->viewport();

            seo()->title($title);
            seo()->description($description);

            seo()->csrfToken();

            seo()->addMany([

                Meta::make()->name('copyright')->content('Telage Concepts'),

                Link::make()->rel('icon')->href(asset('img/favicon.png')),
                Link::make()->rel('apple-touch-icon')->href($img_url),

                OpenGraph::make()->property('title')->content($title),
                OpenGraph::make()->property('site_name')->content($site_name),
                OpenGraph::make()->property('locale')->content('en'),
                OpenGraph::make()->property('image')->content($img_url),

                Twitter::make()->name('card')->content('summary'),
                Twitter::make()->name('site')->content("@{$site_name}"),
                Twitter::make()->name('creator')->content('@telage_concepts'),
                Twitter::make()->name('image')->content($img_url, false)

            ]);
        }

        return $next($request);
    }
}
