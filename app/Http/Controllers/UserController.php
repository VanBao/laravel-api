<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends WebDriverController
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    public function index(Request $request)
    {
        $sql = User::with(['group:id,name', 'city'])->withCount('booking');
        if($request->query('city')){
            $sql = $sql->where('city_id', $request->query('city'));
        }
        $data['data'] = $sql->orderBy('created_at', 'DESC')->get();
        $data['listCity'] = City::all();
        return view('user.index', $data);
    }

    public function delete($id)
    {
        if (auth()->user()->group->type == 'super_admin' && $id != auth()->user()->id) {
            $this->user->deleteUser($id);
        }
        return back();
    }

    public function create()
    {
        $data['groups'] = Group::where('type', '!=', 'super_admin')->get();
        $data['listCity'] = City::all();
        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:255|confirmed',
            'phone' => 'required|between:9,20|unique:users',
            'group_id' => 'required|exists:groups,id',
            'address' => 'nullable|string',
            'city' => 'required|integer',
        ]);

        $super_admin_id = Group::where('type', 'super_admin')->first()->id;

        if ($super_admin_id == (int)$request->group_id) {
            return redirect()->route('admin.user.index');
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'group_id' => (int)$request->group_id,
            'city_id' => (int)$request->city,
        ]);

        $user->save();

        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        $data['data'] = User::with('group')->findOrFail($id);
        if ($data['data']->group->type == 'super_admin' && auth()->user()->group->type != 'super_admin') {
            return redirect()->route('admin.user.index');
        }
        $data['groups'] = Group::where('type', '!=', 'super_admin')->get();
        $data['listCity'] = City::all();
        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6|max:255|confirmed',
            'group_id' => 'required|exists:groups,id',
            'address' => 'nullable|string',
            'city' => 'required|integer'
        ]);

        $instance = User::where('id', $id);
        if (!$instance->exists()) redirect()->route('admin.user.index');
        if ($instance->with('group')->first()->group->type == 'super_admin' && auth()->user()->group->type != 'super_admin') return redirect()->route('admin.user.index');

        $super_admin_id = Group::where('type', 'super_admin')->first()->id;

        if ($super_admin_id == (int)$request->group_id) {
            return redirect()->route('admin.user.index');
        }

        $update = [
            'name' => $request->name,
            'group_id' => $request->group_id,
            'address' => $request->address,
            'city_id' => $request->city
        ];

        if ($request->has('password')) {
            $update['password'] = bcrypt($request->password);
        }

        $instance->update($update);

        return redirect()->route('admin.user.edit', ['id' => $id])->with('success', 'Cập nhật thành công !');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6|max:255',
            'new_password' => 'required|min:6|max:255|confirmed'
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->route('admin.user.profile')->withErrors(['error' => 'Mật khẩu hiện tại không chính xác .'])->withInput();
        }

        User::where('id', auth()->user()->id)->update([
            'password' => bcrypt($request->new_password)
        ]);

        return redirect()->route('admin.user.profile')->with('success', 'Đổi mật khẩu thành công !')->withInput();
    }

    public function updateProfile(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|min:6|max:20|unique:users,phone,' . auth()->user()->id,
            'name' => 'required|max:255|string',
            'address' => 'required|string',
            'avatar' => 'nullable|image|max:5120'
        ]);

        $update = [
            'email' => $request->email,
            'phone' => $request->phone,
            'name' => $request->name,
            'address' => $request->address
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;

            $avatar = str_replace(" ", "", time() . '_' . $file->getClientOriginalName());

            $file->move('uploads', $avatar);

            $update['avatar'] = asset('uploads/' . $avatar);
        }

        User::where('id', auth()->user()->id)->update($update);

        return redirect()->route('admin.user.profile')->with('success', 'Cập nhật thông tin thành công !');
    }
}
