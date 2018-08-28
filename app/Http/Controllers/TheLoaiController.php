<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;

class TheLoaiController extends Controller
{
    //
    public function list()
    {
        $theloai = Theloai::all();
        return view('admin.theloai.list', ['list' => $theloai]);
    }

    public function addView()
    {
        return view('admin.theloai.add');
    }

    public function add(Request $request)
    {
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:50'
            ],
            [
                'Ten.required' => 'Chưa nhập tên',
                'Ten.min' => 'Tên có độ dài từ 3 ~ 100 kí tự',
                'Ten.max' => 'Tên có độ dài từ 3 ~ 100 kí tự'
            ]);
        $theloai = new Theloai();
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('/admin/theloai/add')->with('status', 'Thêm thành công');
    }

    public function editView($id)
    {
        $theloai = Theloai::find($id);
        return view('admin.theloai.edit', ['theloai' => $theloai]);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:50'
            ],
            [
                'Ten.required' => 'Chưa nhập tên',
                'Ten.min' => 'Tên có độ dài từ 3 ~ 100 kí tự',
                'Ten.max' => 'Tên có độ dài từ 3 ~ 100 kí tự'
            ]);
        $theloai = Theloai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('/admin/theloai/edit/' . $id)->with('status', 'Update success');
    }

    public function delete($id)
    {
        $theloai = Theloai::find($id);
        $theloai->delete();
        return redirect('/admin/theloai/list')->with('status', 'Delete '.$theloai->Ten.' success');
    }
}
