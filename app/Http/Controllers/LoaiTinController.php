<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Theloai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LoaiTinController extends Controller
{
    //
    public function list()
    {
        $loaitin = Loaitin::all();
        return view('admin.loaitin.list', ['list' => $loaitin]);
    }

    public function addView()
    {
        $theloai = Theloai::all();
        return view('admin.loaitin.add', ['theloai' => $theloai]);
    }

    public function add(Request $request)
    {
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:50',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin có độ dài từ 3 ~ 50 kí tự',
                'Ten.max' => 'Tên loại tin có độ dài từ 3 ~ 50 kí tự'
            ]
        );
        $loaitin = new Loaitin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('/admin/loaitin/add')->with('status', 'Add new success');
    }

    public function editView($id)
    {
        $loaitin = Loaitin::find($id);
        $theloai = Theloai::all();
        return view('admin.loaitin.edit', ['loaitin' => $loaitin, 'theloai' => $theloai]);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:50',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin có độ dài từ 3 ~ 50 kí tự',
                'Ten.max' => 'Tên loại tin có độ dài từ 3 ~ 50 kí tự'
            ]
        );
        $loaitin = Loaitin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('/admin/loaitin/edit/'.$id)->with('status', 'Update '.$request->Ten.' success');
    }

    public function delete($id)
    {
        $loaitin = Loaitin::find($id);
        $loaitin->delete();
        return redirect('/admin/loaitin/list')->with('status', 'Delete ' . $loaitin->Ten . ' success');
    }
}
