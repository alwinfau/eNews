@extends('front-page.master-blade.frontmaster')

@section('content')
    <div class="row">
        @forelse ($beritaItems as $item)
            <div class="col-lg-3 mb-4">
                <a href="{{ route('detailBerita', $item->slug_title) }}" class="text-decoration-none">
                    <div class="card me-2" style="width:20rem;height:25rem;">
                        <img src="{{ Storage::url($item->image_url) ?? 'https://placehold.co/600x350/png' }}"
                            class="card-img-top object-fit-cover" alt="{{ $item->title }}" style="height: 220px;">
                        <div class="card-img-overlay">
                            <div class="badge bg-info">Dibaca: {{ $item->views ?? '0' }} kali</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <div class="d-flex justify-content-between">
                                <small class="card-subtitle mb-2 text-muted ">
                                    {{ $item->category->categoryname }}
                                </small>
                                <small class="card-subtitle mb-2 text-muted ">
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForhumans() }}
                                </small>
                            </div>
                            <p class="card-text">
                                {{ Str::limit($item->description, 60, '...') }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="alert bg-danger">
                <i class="bi bi-info"></i> tidak ada berita.
            </div>
        @endforelse
    </div>
@endsection
