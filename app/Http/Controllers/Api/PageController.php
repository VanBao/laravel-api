<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller
{
    public function index($type)
    {
        if ($type === 'intro') $type = 'introduction';
        $pages = Page::where(['type' => $type, 'status' => 1])->get()->toArray();
        return response()->json([
            'status' => true,
            'code' => 0,
            'message' => 'Success.',
            'data' => $pages
        ]);
    }
}
