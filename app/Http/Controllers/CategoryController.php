<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends WebDriverController
{
    public function index()
    {
        $data['data'] = Category::with('created_user:id,name')->orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('category.index', $data);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'avatar' => 'required|image|max:5120',
            'description' => 'nullable|string',
            'summary' => 'nullable|string',
            'icon' => 'required|image|max:5120',
//            'background' => 'required|image|max:5120',
//            'images' => 'required|array',
//            'images.*' => 'required|image|max:5120'
        ]);


        $file = $request->avatar;

        $avatar = str_replace(" ", "", time() . '_' . $file->getClientOriginalName());

        $file->move('uploads', $avatar);

        $file2 = $request->icon;

        $icon = str_replace(" ", "", time() . '_' . $file2->getClientOriginalName());

        $file2->move('uploads', $icon);

//        $file3 = $request->background;
//
//        $background = time() . '_' . $file3->getClientOriginalName();
//
//        $file3->move('uploads', $background);
//
//        $images = [];
//        if ($request->images) {
//            foreach ($request->images as $index => $image) {
//                $fileName = time() . '_' . $image->getClientOriginalName();
//                $image->move('uploads/', $fileName);
//                $images[] = $fileName;
//            }
//        }

        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'summary' => $request->summary,
//            'background' => $background,
            'avatar' => $avatar,
            'icon' => $icon,
            'status' => 1,
//            'images' => json_encode($images),
            'created_id' => auth()->user()->id,
            'created_at' => now()
        ]);

        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        if (!$id) return redirect()->route('admin.category.index');
        $data['data'] = Category::findOrFail($id);
        return view('category.edit', $data);
    }

    public function delete(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $request->validate([
                'id' => 'required|array',
                'id.*' => 'required|integer|exists:categories,id'
            ]);

            if ($request->id) {
                foreach ($request->id as $id) {
                    Category::where('id', $id)->update([
                        'status' => 0
                    ]);
                }
            }

            return response()->json(true);
        }
        if ($id) {
            $instance = Category::where('id', $id);
            if (!$instance->exists()) return redirect()->route('admin.category.index');
            $instance->update([
                'status' => 0
            ]);
            return redirect()->route('admin.category.index')->with('success', 'Xoá thành công !');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'avatar' => 'image|max:5120',
            'icon' => 'image|max:5120',
            'description' => 'nullable|string',
            'summary' => 'nullable|string',
//            'background' => 'image|max:5120',
//            'images' => 'array',
//            'images.*' => 'image|max:5120'
        ]);
        $instance = Category::where('id', $id);
        if (!$instance->exists()) redirect()->route('admin.category.index');

        $update = [
            'title' => $request->title,
            'description' => $request->description,
            'summary' => $request->summary,
            'updated_id' => auth()->user()->id,
            'updated_at' => now()
        ];


        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $avatar = str_replace(" ", "", time() . '_' . $file->getClientOriginalName());
            $file->move('uploads', $avatar);
            $update['avatar'] = $avatar;
        }

        if ($request->hasFile('icon')) {
            $file = $request->icon;
            $icon = str_replace(" ","",time() . '_' . $file->getClientOriginalName());
            $file->move('uploads', $icon);
            $update['icon'] = $icon;
        }

//        if ($request->hasFile('background')) {
//            $file = $request->background;
//            $background = time() . '_' . $file->getClientOriginalName();
//            $file->move('uploads', $background);
//            $update['background'] = $background;
//        }
//
//        $images = $request->images_old;
//
//        if ($request->images) {
//            foreach ($request->images as $index => $image) {
//                $fileName = time() . '_' . $image->getClientOriginalName();
//                $image->move('uploads/', $fileName);
//                $images[] = $fileName;
//            }
//        }
//
//        $update['images'] = json_encode($images);

        $category = $instance->update($update);
        return redirect()->route('admin.category.edit', ['id' => $id])->with('success', 'Cập nhật thành công !');
    }


}
