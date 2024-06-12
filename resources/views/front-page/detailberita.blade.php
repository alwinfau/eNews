@extends('front-page.master-blade.frontmaster')

@section('title', 'E-Berita')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <img src="{{ $details->image_url ? Storage::url($details->image_url) : 'https://placehold.co/600x350/png' }}"
                    class="d-block w-100 object-fit-cover rounded-4 py-2" alt="{{ $details->title }}" height="400">
                <div class="d-flex justify-content-between items-center align-items-center">
                    <label class="text-small">
                        <i class="bi bi-people"></i>
                        {{ $details->user->name }} |
                        {{ $details->category->categoryname }} |
                        <i class="bi bi-eye"></i>
                        {{ $details->views }} dibaca
                    </label>
                    <label class="text-small">
                        {{ \Carbon\Carbon::parse($details->created_at)->diffForhumans() }}
                    </label>
                </div>
                <h1>{{ $details->title }}</h1>

                <div class="text-justify">
                    <h6> {{ $details->description }} </h6>
                </div>

            </div>
        </div>

        <div class="col-lg-3">
            <h6>Berita Lainnya</h6>
            @foreach ($berita as $item)
                <a href="{{ $item->slug_title }}" class="text-decoration-none">
                    <div class="card mb-3 " style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 p-0">
                                <img src="{{ Storage::url($item->image_url) ?? 'https://placehold.co/600x350/png' }}"
                                    class=" h-100 w-100 rounded-start " alt="...">
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
