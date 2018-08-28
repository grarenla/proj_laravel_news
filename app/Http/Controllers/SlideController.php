<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //
    public function list()
    {
        $slide = Slide::all();
        return view('admin.slide.list', ['list' => $slide]);
    }

    public function addView()
    {
        return view('admin.slide.add');
    }

    public function add(Request $request)
    {
        $this->validate($request,
            [
                'Ten' => 'required|min:3|unique:Slide,Ten',
                'NoiDung' => 'required',
                'Link' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.min' => 'Tên phải lớn hơn 3 kí tự',
                'Ten.unique' => 'Tên đã tồn tại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
                'Link.required' => 'Bạn chưa nhập link'
            ]
        );

        $slide = new Slide();
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->Link;
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('/admin/slide/add')->with('err', 'file not .jpg .png .jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(5) . "_" . $name;
            while (file_exists("images/slide/" . $Hinh)) {
                $Hinh = str_random(5) . "_" . $name;
            }
            $file->move('images/slide/', $Hinh);
            $slide->Hinh = $Hinh;
        } else {
            $slide->Hinh = '';
        }
        $slide->save();

        return redirect('/admin/slide/add')->with('status', 'Add new success');
    }

    public function editView($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit', ['slide' => $slide]);
    }

    public function edit(Request $request, $id)
    {
        $slide = Slide::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|min:3|unique:Slide,Ten',
                'NoiDung' => 'required',
                'Link' => 'required'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.min' => 'Tên phải lớn hơn 3 kí tự',
                'Ten.unique' => 'Tên đã tồn tại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
                'Link.required' => 'Bạn chưa nhập link'
            ]
        );
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->link = $request->Link;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('/admin/slide/add')->with('err', 'file not .jpg .png .jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(5) . "_" . $name;
            while (file_exists("images/slide/" . $Hinh)) {
                $Hinh = str_random(5) . "_" . $name;
            }
            $file->move('images/slide/', $Hinh);
            unlink("images/slide/" . $slide->Hinh);
            $slide->Hinh = $Hinh;
        }
        $slide->save();

        return redirect('/admin/slide/edit/' . $id)->with('status', 'Update ' . $request->Ten . ' success');
    }

    public function delete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('/admin/slide/list')->with('status', 'Delete success');
    }
}
