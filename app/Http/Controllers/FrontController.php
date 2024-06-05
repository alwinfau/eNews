<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $categories = Categories::all();
        $berita = Berita::latest()->paginate(20);
        return view('front-page.frontpage',[
            'category' => $categories,
            'berita' => $berita
        ]);
    }
}
