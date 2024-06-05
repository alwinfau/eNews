@extends('dashboard.template.template')

@section('content')
    <div class="container">
        <form action="{{ route('post-berita') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Form Isian Berita</h5>
                            <div class="mb-3">
                                <label for="title">Judul Berita</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Judul Berita">
                                @error('title')
                                    <span class="text-sm text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date">Tanggal Posting</label>
                                <input type="date" name="current_date" id="date" value="{{ old('current_date') }}"
                                    class="form-control @error('current_date') is-invalid @enderror">
                                @error('current_date')
                                    <span class="text-sm text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category">Kategori Berita</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="" selected>Silahkan pilih kategori berita</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->categoryname }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="title">Upload Gambar</label>
                                <input type="file" name="image_url" value="{{ old('image_url') }}"
                                    class="form-control @error('image_url') is-invalid @enderror">
                                @error('image_url')
                                    <span class="text-sm text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Keterangan Berita</label>
                                <textarea name="description" id="description" cols="30" rows="10"
                                    placeholder="Keterangan atau Deskripsi Berita" class="form-control @error('img_url') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-sm text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-dark">Kembali</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
