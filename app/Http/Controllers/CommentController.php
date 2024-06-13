<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){

        $data = $request->validate([
            'komentar' => 'required|max:255',
        ],[
            'komentar.required' => 'Silahkan isi komentar anda terlebih dahulu',
            'komentar.max' => 'Kolom komentar hanya bisa disikan dengan 255 karakter',
        ]);

        $data['beritaid'] = $request->beritaid;
        if (Auth::user()) {
            $data['userid'] = Auth::user()->id;
        }else{
            $data['userid'] = null;
        }
        Comment::create($data);

        return redirect()->back();
    }
}
