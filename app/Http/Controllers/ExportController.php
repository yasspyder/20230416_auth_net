<?php

namespace App\Http\Controllers;

use App\Exports\NewsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportNews(Request $request)
    {
        return Excel::download(new NewsExport($request->input()), 'news.xlsx');
    }
}
