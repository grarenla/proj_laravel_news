<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Theloai;
use App\Tintuc;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    //
    public function list()
    {
        $tintuc = Tintuc::all();
        return view('admin.tintuc.list', ['list' => $tintuc]);
    }

    public function addView()
    {
        $theloai = Theloai::all();
        $loaitin = Loaitin::all();
        return view('admin.tintuc.add', ['theloai' => $theloai, 'loaitin' => $loaitin]);
    }

    public function add(Request $request)
    {
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'LoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Tiêu đề phải lớn hơn 3 kí tự',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]
        );

        $tintuc = new Tintuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('/admin/tintuc/them')->with('err', 'file not .jpg .png .jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(5) . "_" . $name;
            while (file_exists("images/tintuc/" . $Hinh)) {
                $Hinh = str_random(5) . "_" . $name;
            }
            $file->move('images/tintuc/', $Hinh);
            $tintuc->Hinh = $Hinh;
        } else {
            $tintuc->Hinh = '';
        }
        $tintuc->save();

        return redirect('/admin/tintuc/add')->with('status', 'Add new success');
    }

    public function editView($id)
    {
        $theloai = Theloai::all();
        $tintuc = Tintuc::find($id);
        $loaitin = Loaitin::where('idTheLoai', $tintuc->loaitin->idTheLoai)->get();
        return view('admin.tintuc.edit', ['tintuc' => $tintuc, 'loaitin' => $loaitin, 'theloai' => $theloai]);
    }

    public function edit(Request $request, $id)
    {
        $tintuc = Tintuc::find($id);
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'LoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Tiêu đề phải lớn hơn 3 kí tự',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]
        );
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('/admin/tintuc/them')->with('err', 'file not .jpg .png .jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(5) . "_" . $name;
            while (file_exists("images/tintuc/" . $Hinh)) {
                $Hinh = str_random(5) . "_" . $name;
            }
            $file->move('images/tintuc/', $Hinh);
            unlink("images/tintuc/" . $tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save();

        return redirect('/admin/tintuc/edit/' . $id)->with('status', 'Update ' . $request->TieuDe . ' success');
    }

    public function delete($id)
    {
        $tintuc = Tintuc::find($id);
        $tintuc->delete();
        return redirect('/admin/tintuc/list')->with('status', 'Delete "' . $tintuc->TieuDe . '" success');
    }
}
