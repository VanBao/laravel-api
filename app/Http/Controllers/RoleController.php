<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends WebDriverController
{
    public function index()
    {
        $data['data'] = Role::orderBy('created_at','DESC')->get();
        return view('role.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $data['data'] = Role::findOrFail($id);
        return view('role.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'required|max:255'
        ]);
        $instance = Role::where('id',$id);
        if(!$instance->exists()) redirect()->route('admin.role.index');
        $role = $instance->update([
            'name' => $request->name,
            'note' => $request->note
        ]);
        if ($role == 1) return redirect()->route('admin.role.edit', ['id' => $id])->with('success', 'Cập nhật thành công !');
        throw new \Exception('Error while update category.');
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles',
            'note' => 'required|max:255'
        ]);
        $role = new Role([
            'name' => $request->name,
            'note' => $request->note
        ]);

        $role->save();

        return redirect()->route('admin.role.edit', ['id' => $role->id])->with('success', 'Thêm luật thành công !');
    }

    public function delete($id)
    {
        $user = Role::where('id', $id);
        if ($user->exists()) {
            $user->delete();
            return redirect()->route('admin.role.index')->with('success', 'Xoá luật thành công !');
        }
        return redirect()->route('admin.role.index');
    }
}
