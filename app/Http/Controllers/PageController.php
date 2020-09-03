<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PageController extends WebDriverController
{
    public function index()
    {
        $data['data'] = Page::orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('page.index', $data);
    }

    public function term()
    {
        $data['data'] = Page::where('type', 'term')->first();
        return view('page', $data);
    }

    public function optimize()
    {
        Artisan::call('optimize');
        return 1;
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
            'summary' => 'required|string',
            'content' => 'required|string',
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
            'summary' => $request->summary,
            'content' => $request->get('content'),
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

    public function delete($id)
    {
        $booking = Page::findOrFail($id);
        $booking->update([
            'status' => '0'
        ]);

        return back()->with(['message' => 'Xoá thành công !']);
    }
}
