@extends('front-page.master-blade.frontmaster')

@section('title', 'E-Berita')

@section('content')

    <div class="row mb-3">
        <div class="col">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($carousel as $key => $item)
                        <div class="carousel-item active">
                            <img src="{{ $item->image_url ? Storage::url($item->image_url) : 'https://placehold.co/600x350/png' }}"
                                class="d-block w-100 object-fit-cover rounded-4" alt="{{ $item->title }}" height="400">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                @foreach ($berita as $item)
                    <div class="col-lg-4 mb-4">
                        <a href="{{ $item->slug_title }}" class="text-decoration-none">
                            <div class="card me-2" style="width:20rem;height:25rem;">
                                <img src="{{ Storage::url($item->image_url) ?? 'https://placehold.co/600x350/png' }}"
                                    class="card-img-top object-fit-cover" alt="{{ $item->title }}" style="height: 220px;">
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
                @endforeach
            </div>
        </div>

        <div class="col-lg-3">
            <h6>Berita Lainnya</h6>
            @foreach ($berita as $item)
                <a href="{{ $item->slug_title }}" class="text-decoration-none">
                    <div class="card mb-3 " style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 p-0">
                                <img src="{{ Storage::url($item->image_url) }}" class=" h-100 w-100 rounded-start "
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body py-0">
                                    <p class="card-text mb-1">
                                        {{ Str::limit($item->description, 40, '...') }}
                                    </p>
                                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
