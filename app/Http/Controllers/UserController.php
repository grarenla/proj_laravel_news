<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function list()
    {
        $user = User::all();
        return view('admin.user.list', ['list' => $user]);
    }

    public function addView()
    {
        return view('admin.user.add');
    }

    public function add(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:5|max:20',
                'passwordAgain' => 'required|same:password'
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->passwordAgain);
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('/admin/user/add')->with('status', 'Add new success');
    }

    public function editView($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user]);
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request,
            [
                'name' => 'required|min:3'
            ]
        );
        $user->name = $request->name;
        if ($request->has('changePassword')) {
            $this->validate($request,
                [
                    'password' => 'required|min:5|max:20',
                    'passwordAgain' => 'required|same:password'
                ]
            );
            $user->password = bcrypt($request->passwordAgain);
        }
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('/admin/user/edit/' . $id)->with('status', 'Update ' . $request->name . ' success');
    }

    public function delete($id)
    {
        $cmt = Comment::where('idUser', $id);
        $cmt->delete();
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user/list')->with('status', 'Delete success');
    }

    public function loginAdminView()
    {
        return view('admin.login');
    }

    public function loginAdmin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin/theloai/list');
        } else {
            return redirect('/admin/login')->with('status', 'Đăng nhập thất bại');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
