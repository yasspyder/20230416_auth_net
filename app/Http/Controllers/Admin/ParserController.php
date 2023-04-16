<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResourcesRequest;
use App\Models\Resources;
use Illuminate\Http\Request;
use App\Services\XMLParserService;
use App\Jobs\NewsParsing;

class ParserController extends Controller
{
    public function index(
        Resources $resources,
        Request $request,
        XMLParserService $xMLParserService
    ) {
        $data = [];
        $parse_link = "";
        if ($request->isMethod('post')) {
            if ((string) $request->input('parse_all') === "get") {

                $url = $resources->all()
                    ->pluck('resource_url');

                foreach ($url as $key) {
                    $request = $request->replace(['parse_link' => $key]);
                    $this->loadParseNews($request);
                }
            } else {

                $validate = $request->validate([
                    'parse_link' => 'required|url'
                ]);

                $data = $xMLParserService->getParse($validate['parse_link']);
                $parse_link = $validate['parse_link'];
            }
        }

        return view('admin.parse', [
            'parse' => $data,
            'resources' => $resources->all(),
            'parse_link' => $parse_link
        ]);
    }

    public function addSource(
        Resources $resources,
        ResourcesRequest $request
    ) {
        if ($request->isMethod('post')) {
            $request = $request->validated();
            $double_url = $resources->firstWhere('resource_url', $request['resource_url']);
            if (!(bool) $double_url) {
                $resources->fill($request);
                $resources->save();
            }
        }

        return redirect()->route('admin.parse');
    }

    public function loadParseNews(Request $request)
    {
        if ($request->isMethod('post')) {
            $validate = $request->validate([
                'parse_link' => 'required|url'
            ]);
            $link = $validate['parse_link'];
        }
        NewsParsing::dispatch($link);
        return redirect()->back();
    }

    public function deleteParseSource(Request $request)
    {
        $resource = Resources::find($request->input('id'));
        if ($resource) {
            $resource->delete();
        }
        return redirect()->back();
    }
}
