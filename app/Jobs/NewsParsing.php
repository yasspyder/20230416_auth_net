<?php

namespace App\Jobs;

use App\Services\XMLParserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $link;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(XMLParserService $xMLParserService)
    {
        $news = new \App\Models\News;
        $category = new \App\Models\Category;

        $data = $xMLParserService->getParse($this->link);

        foreach ($data['news'] as $key) {

            $double_news = $news->firstWhere('title', $key['title']);

            if ((bool) $double_news) {
                continue;
            }

            $double_category = $category->firstWhere('category_name', $key['category']);

            if (!(bool) $double_category) {
                $category->create([
                    'category_name' => $key['category']
                ]);
                $key['category_id'] = \Illuminate\Support\Facades\DB::getPdo()->lastInsertId();
            } else {
                $key['category_id'] = $double_category->id;
            }

            $news->create([
                'title' => (string) $key['title'],
                'text' => (string) $key['description'],
                'category_id' => (int) $key['category_id'],
                'is_private' => false
            ]);
        }
    }
}
