<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function delete($id)
    {
        $cmt = Comment::find($id);
        $cmt->delete();

        return redirect('/admin/tintuc/edit/'.$cmt->idTinTuc)->with('status', 'Delete comment "'.$id .'" success');
    }

    public function post(Request $request, $id)
    {
        $idTinTuc = $id;
        $cmt = new Comment();
        $cmt->idTinTuc = $idTinTuc;
        $cmt->idUser = Auth::user()->id;
        $cmt->NoiDung = $request->NoiDung;
        $cmt->save();

        return redirect('/news/'.$id);
    }
}
