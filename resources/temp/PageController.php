<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends WebDriverController
{
    public function index()
    {
        $data['data'] = Page::all();
        return view('page.index', $data);
    }

    public function create()
    {
        return view('page.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'type' => 'required|string|in:news,introduction,support,thanks,term',
            'avatar' => 'required|image|max:5120',
            'name' => 'required|string',
            'name_en' => 'nullable|string',
            'summary' => 'required|string',
            'summary_en' => 'nullable|string',
            'content' => 'required|string',
            'content_en' => 'nullable|string',
            'sort' => 'required|integer'
        ]);

        $file = $request->avatar;

        $avatar = time() . '_' . $file->getClientOriginalName();

        $avatar = str_replace(" ", "", $avatar);

        $file->move('uploads', $avatar);

        Page::create([
            'type' => $request->type,
            'avatar' => $avatar,
            'name' => $request->name,
            'name_en' => isset($request->name_en) ? $request->name_en : null,
            'summary' => $request->summary,
            'summary_en' => isset($request->summary_en) ? $request->summary_en : null,
            'content' => $request->get('content'),
            'content_en' => $request->has('content_en') ? $request->get('content_en') : null,
            'sort' => $request->sort,
            'status' => 1,
            'created_id' => auth()->user()->id
        ]);

        return redirect()->route('admin.page.index');
    }

    public function edit($id)
    {
        $data['data'] = Page::findOrFail($id);
        return view('page.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|in:news,introduction,support,thanks,term',
            'avatar' => 'nullable|image|max:5120',
            'name' => 'required|string',
            'name_en' => 'nullable|string',
            'summary_en' => 'nullable|string',
            'content_en' => 'nullable|string',
            'summary' => 'required|string',
            'content' => 'required|string',
            'sort' => 'required|integer'
        ]);

        $page = Page::findOrFail($id);

        $update = [
            'type' => $request->type,
            'name' => $request->name,
            'summary' => $request->summary,
            'content' => $request->get('content'),
            'sort' => $request->sort,
            'name_en' => isset($request->name_en) ? $request->name_en : null,
            'summary_en' => isset($request->summary_en) ? $request->summary_en : null,
            'content_en' => $request->has('content_en') ? $request->get('content_en') : null,
            'updated_id' => auth()->user()->id,
            'updated_at' => now()
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;

            $avatar = time() . '_' . $file->getClientOriginalName();

            $avatar = str_replace(" ", "", $avatar);

            $file->move('uploads', $avatar);

            $update['avatar'] = $avatar;
        }

        $page->update($update);

        return redirect()->route('admin.page.index');
    }
}
