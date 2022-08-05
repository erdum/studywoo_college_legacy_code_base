<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Custom imports
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use Modules\College\Entities\CollegeSubpage;

class GenerateSitemap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 7200;

    protected $max_date;
    protected $min_date;
    protected $change_freq;
    protected $url;
    protected $filename;
    protected $disk;

    public function __construct($params)
    {
        $this->max_date = $params['max_date'];
        $this->min_date = $params['min_date'];
        $this->change_freq = $params['change_freq'];
        $this->url = url('/');
        $this->filename = "sitemap-{$this->change_freq}.xml";
        
        $this->disk = Storage::build([
            'driver' => 'local',
            'root' => public_path()
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            
            $this->disk->put($this->filename, '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
            
            $records = CollegeSubpage::whereDate('updated_at', '>=', Carbon::now()->subHours($this->max_date)->format('Y-m-d'))->where('updated_at', '<', Carbon::now()->subHours($this->min_date)->format('Y-m-d'));
            $blogs = Blog::whereDate('updated_at', '>=', Carbon::now()->subHours($this->max_date)->format('Y-m-d'))->where('updated_at', '<', Carbon::now()->subHours($this->min_date)->format('Y-m-d'));

            $records->chunk(100, function ($rows) {
                foreach ($rows as $row)
                {
                    $this->disk->append($this->filename, "<url><loc>{$this->url}/{$row->college->slug}</loc><lastmod>{$row->updated_at->tz('UTC')->format('Y-m-d')}</lastmod></url>");
                }
            });
            
            $blogs->chunk(100, function ($rows) {
                foreach ($rows as $row)
                {
                    $this->disk->append($this->filename, "<url><loc>{$this->url}/blog/{$row->slug}</loc><lastmod>{$row->updated_at->tz('UTC')->format('Y-m-d')}</lastmod></url>");
                }
            });
            
            $this->disk->append($this->filename, '</urlset>');
            
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
