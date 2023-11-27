<?php

namespace App\Console\Commands;

use App\Repositories\Article\EloquentArticle;
use Illuminate\Console\Command;

class SiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate site map';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $articleRepo = new EloquentArticle();
        $articles = $articleRepo->siteMap();
        //dd($articles);
        $content = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $content .= view('sitemap',compact('articles'))->render();
        $myfile = fopen(public_path('sitemap.xml'), "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }
}
