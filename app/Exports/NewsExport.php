<?php

namespace App\Exports;

use App\Models\News;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewsExport implements FromCollection
{
    private array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $news = News::all()
            ->where('category_id', $this->request['category'])
            ->toArray();
        $header = array_keys(array_shift($news));
        return collect($news)->prepend($header);
    }
}
