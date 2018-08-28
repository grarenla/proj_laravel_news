<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Slide;
use App\Theloai;
use App\Tintuc;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //
    function __construct()
    {
        $theloai = Theloai::all();
        $slide = Slide::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);
    }

    public function home()
    {
        return view('pages.home');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function category($id)
    {
        $loaitin = Loaitin::find($id);
        $tintuc = Tintuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.category', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    public function news($id)
    {
        $tintuc = Tintuc::find($id);
        $noibat = Tintuc::where('NoiBat', 1)->inRandomOrder()->take(4)->get();
        $lienquan = Tintuc::where('idLoaiTin', $tintuc->idLoaiTin)->inRandomOrder()->take(4)->get();
        return view('pages.detail', ['tintuc' => $tintuc, 'noibat' => $noibat, 'lienquan' => $lienquan]);
    }

    public function loginView()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/home');
        } else {
            return redirect('/login')->with('status', 'Đăng nhập thất bại');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }

    public function accountView()
    {
        if (Auth::check()) {
            $acc = Auth::user();
            return view('pages.account', ['acc' => $acc]);
        } else {
            return redirect('/login')->with('status', 'Bạn chưa đăng nhập');
        }
    }

    public function account(Request $request)
    {
        $user = Auth::user();
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
        $user->save();

        return redirect('/account')->with('status', 'Update ' . $request->name . ' success');
    }

    public function registerView()
    {
        return view('pages.register');
    }

    public function register(Request $request)
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
        $user->quyen = 0;
        $user->save();

        return redirect('/login')->with('success', 'Đăng ký thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $tintuc = Tintuc::where('TieuDe', 'like', "%$keyword%")->orWhere('TomTat', 'like', "%$keyword%")->orWhere('NoiDung', 'like', "%$keyword%")->paginate(5);
        return view('pages.search', ['keyword' => $keyword, 'tintuc' => $tintuc]);
    }
}
