<?php

namespace App\Http\Controllers;

use App\Services\DialectService;
use Illuminate\Http\Request;

class DialectController extends Controller
{
    private $service;

    public function __construct(DialectService $service)
    {
        $this->service = $service;
    }

    public function search(Request $request)
    {
        if ($request->has('q')) {
            $keyword = $request->input('q');
            $zone = $request->input('zone');
            $type = $request->input('type');
            $perPage = 10;

            if (null === $keyword) {
                $items = $this->service->getAllByPage($zone, $type, $perPage);
            } else {
                $items = $this->service->getDialectsByPage($zone, $type, $keyword, $perPage);
            }
        } else {
            $items   = null;
            $keyword = null;
        }

        return view('search', compact('keyword', 'items'));
    }
}
