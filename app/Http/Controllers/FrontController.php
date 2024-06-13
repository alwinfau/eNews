<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use App\Models\Comment;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $categories = Categories::all();
        $berita = Berita::latest()->paginate(20);
        $carousel = Berita::orderBy('views' ,'desc')->take(3)->get();
        return view('front-page.frontpage',[
            'category' => $categories,
            'berita' => $berita,
            'carousel' => $carousel
        ]);
    }

    public function getCategories($slug_categories){
        $categories = Categories::all();
        $getidCategori = Categories::where('slug_categoryname', $slug_categories)->first();
        $getBerita = Berita::where('category_id', $getidCategori->id)->get();
        return view('front-page.bycategory',[
            'beritaItems' => $getBerita,
            'category' => $categories,
        ]);
    }

    public function detailBerita($slug_title){
        $details = Berita::where('slug_title', $slug_title)->first();
        $details->increment('views');
        $categories = Categories::all();
        $berita = Berita::latest()->paginate(20);
        $komentar = Comment::where('beritaid', $details->id)->get();
        return view('front-page.detailberita', [
            'details' => $details,
            'category' => $categories,
            'berita' => $berita,
            'komentar' => $komentar
        ]);
    }
}
