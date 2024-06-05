<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\fileExists;

class BeritaController extends Controller
{
    public function index(){
        $berita = Berita::with(['category'])->latest()->get();
        return view('dashboard.pages.berita.index',with([
            'beritas' => $berita
        ]));
    }

    public function create(){
        $kategori = Categories::all();
        return view('dashboard.pages.berita.create',with([
            'categories' => $kategori
        ]));
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'current_date' => 'required',
            'category_id' => 'required',
            'image_url' => 'required|max:2048|mimes:png,jpeg,jpg',
            'description'=> 'required'
        ],[
            'title.required' => 'Silahkan isikan judul berita',
            'current_date.required' =>'Silahkan pilih tanggal posting berita',
            'category_id.required' => 'Silahkan pilih kategori berita',
            'image_url.max' => 'Ukuran gambar maksimal 2MB tidak boleh lebih',
            'image_url.mimes' => 'Format gambar yang diupload harus png',
            'description.required' => 'Silahkan isikan keterangan atau deskripsi berita'
        ]);

        $data['slug_title'] = Str::slug($data['title']) . '-' . Str::lower(Str::random(80));
        $data['userid'] =  Auth::user()->id;

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('assets/berita-image','public');
        }
        Berita::create($data);
        return redirect()->route('berita');
    }

    public function edit($slug_title){
        $kategori = Categories::all();
        $data = Berita::with(['category'])->where('slug_title', $slug_title)->first();
        return view('dashboard.pages.berita.update',[
            'datas' => $data,
            'categories' => $kategori
        ]);
    }

    public function update(Request $request, $slug_title){
        $data = $request->validate([
            'title' => 'required',
            'current_date' => 'required',
            'category_id' => 'required',
            'image_url' => 'nullable|max:2048|mimes:png,jpeg,jpg',
            'description'=> 'required'
        ],[
            'title.required' => 'Silahkan isikan judul berita',
            'current_date.required' =>'Silahkan pilih tanggal posting berita',
            'category_id.required' => 'Silahkan pilih kategori berita',
            'image_url.max' => 'Ukuran gambar maksimal 2MB tidak boleh lebih',
            'image_url.mimes' => 'Format gambar yang diupload harus png',
            'description.required' => 'Silahkan isikan keterangan atau deskripsi berita'
        ]);

        $data['slug_title'] = Str::slug($data['title']) . '-' . Str::lower(Str::random(80));
        $data['userid'] =  Auth::user()->id;

        // get item news by slug_title
        $items = Berita::with(['category'])->where('slug_title', $slug_title)->first();

        // condisitional check image from images_url
        if ($request->hasFile('image_url')) {
            // condisitional to check image in directory storege
            if (fileExists(storage_path('app/public/' . $items->image_url)) && is_file(storage_path('app/public/' . $items->image_url))) {
                // delete image by image_url From database
                unlink(storage_path('app/public/' . $items->image_url));
            }
            // if user upload a new image from form udpate, execute line code to store url image ini database dan image storag to storage
            $data['image_url'] = $request->file('image_url')->store('assets/berita-image','public');
        }else{
            // if not image from form, using old image
            unset($items->img_url);
        }

        // if user write in form update, execute code to update data by slug_title
        $items->update($data);
        // redirect to route berita after finishing update data
        return redirect()->route('berita');
    }

    public function destroy($slug_title){
        $item = Berita::where('slug_title', $slug_title)->first();
        $oldUrl = storage_path('app/public/'. $item->image_url);
        if (fileExists($oldUrl) && is_file($oldUrl)) {
            unlink($oldUrl);
        }
        $item->delete();
        return redirect()->route('berita');
    }
}
