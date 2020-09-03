<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GroupController extends WebDriverController
{
    public function index()
    {
        $data['data'] = Group::select('id', 'name', 'description', 'created_at', 'type')->orderBy('created_at','DESC')->get();
        return view('group.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $group = Group::with('roles')->findOrFail($id);
        $roles = Role::select('id', 'name', 'note')->get()->toArray();
        return view('group.edit', ['data' => $group, 'roles' => $roles]);
    }

    public function create()
    {
        $data['roles'] = Role::select('id', 'name', 'note')->get()->toArray();
        return view('group.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'roles' => 'array'
        ]);

        if (!$request->has('roles')) {
            return redirect()->route('admin.group.create')->withErrors(['error' => 'Bạn chưa chọn quyền cho nhóm tài khoản này !'])->withInput($request->all());
        }

        $group = new Group([
            'name' => $request->name,
            'description' => $request->description,
            'type' => 'other'
        ]);

        $group->save();

        $group->roles()->attach($request->roles);

        return redirect()->route('admin.group.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'roles' => 'array'
        ]);

        $instance = Group::where('id',$id);
        if(!$instance->exists()) redirect()->route('admin.group.index');

        if (!$request->has('roles')) {
            return redirect()->route('admin.group.edit', ['id' => $id])->withErrors(['error' => 'Bạn chưa chọn quyền cho nhóm tài khoản này !'])->withInput($request->all());
        }

        $group = $instance->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        (Group::find($id))->roles()->sync($request->roles);

        return redirect()->route('admin.group.edit', ['id' => $id])->with('success', 'Cập nhật nhóm thành công !');
    }
}
