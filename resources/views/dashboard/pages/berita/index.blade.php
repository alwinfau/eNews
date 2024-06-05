@extends('dashboard.template.template')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-12 d-flex justify-content-between items-center">
                <h4>Daftar Berita</h4>
                <a href="{{ route('add-berita') }}" class="btn btn-danger">+ Berita</a>
            </div>
        </div>

        <div class="row">
            @forelse ($beritas as $item)
                <div class="col-lg-3">
                    <div class="card">
                        <img src="{{ $item->image_url ? Storage::url($item->image_url) : 'https://placehold.co/600x350/png' }}"
                            class="card-img-top object-fit-cover" alt="{{ $item->title }}" height="200">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">{{ $item->title }}</h6>
                            <div class="d-flex justify-content-between items-center">
                                <p class="card-text">
                                    {{ $item->category->categoryname }}
                                </p>
                                <p class="card-text">
                                    {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </p>
                            </div>
                            <p class="card-text">
                                {{ Str::limit($item->description, 100, '...') }}
                            </p>
                        </div>

                        <div class="card-footer d-flex">
                            <a href="{{ route('edit-berita', $item->slug_title) }}" class="btn btn-secondary me-2">Edit</a>
                            <form class="form-inline" action="{{ route('delete-berita', $item->slug_title) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="confirm('Are your sure delete this?')"
                                    class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    <span class="fw-bold h6 text-uppercase">Informasi!!!</span>
                    <p>Kami menemukan data dihalaman ini. silahkan entry data terlebih dahulu.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
