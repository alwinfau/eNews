<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index(){
        $data = Categories::with(['user'])->latest()->get();
        return view('dashboard.pages.kategori.index',[
            'datas' => $data
        ]);
    }

    public function create(){
        return view('dashboard.pages.kategori.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'categoryname' => 'required',
        ]);
        $data['slug_categoryname'] = Str::slug($data['categoryname']) . '-' . Str::lower(Str::random());
        $data['userid'] = Auth::user()->id;
        Categories::create($data);
        return redirect()->route('categories');
    }

    public function edit($slug){
        $data = Categories::where('slug_categoryname', $slug)->first();
        return view('dashboard.pages.kategori.update', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $slug){
        $data = $request->validate([
            'categoryname' => 'required',
        ]);
        $data['slug_categoryname'] = Str::slug($data['categoryname']) . '-' . Str::lower(Str::random());
        Categories::where('slug_categoryname', $slug)->update($data);
        return redirect()->route('categories');
    }


    public function destory($slug){
        Categories::where('slug_categoryname', $slug)->delete();
        return redirect()->route('categories');
    }

}
