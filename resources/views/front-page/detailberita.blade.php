@extends('front-page.master-blade.frontmaster')

@section('title', 'E-Berita')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <h1 class="mb-2">{{ $details->title }}</h1>
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

                <div class="text-justify">
                    <h6> {{ $details->description }} </h6>
                </div>
            </div>


            <div class="card pb-4">
                <div class="card-header">
                    <h6><i class="bi bi-chat"></i>Komentar</h6>
                </div>
                <form action="{{ route('comments') }}" method="post" class="form-inline">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="beritaid" value="{{ $details->id }}">
                        <textarea name="komentar" cols="30" rows="3" class="form-control"
                            placeholder="Silahkan isikan komentar anda disini"></textarea>

                        @if (Auth::user())
                            <button type="submit" class="btn btn-danger mt-2">
                                <i class="bi bi-send"></i>
                                Kirim Komentar
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary mt-2">
                                <i class="bi bi-lock"></i>
                                Silahkan Buat Akun
                            </a>
                        @endif

                    </div>
                </form>
                <hr class="py-1 border-secondary opacity-25">
                @forelse ($komentar as $item)
                    <div class="px-3 d-flex justify-between">
                        <img src="https://ui-avatars.com/api/?name={{ $item->user->name }}"
                            class=" rounded-circle object-fit-cover me-3" width="40" height="40"
                            alt="foto-profile-user">


                        <div class="w-100 border-bottom mb-3 pb-3">
                            <h6 class="m-0 p-0">{{ $item->userid ? $item->user->name : 'User diketahui' }}</h6>
                            <small class="text-sm text-muted">
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </small>
                            <p>{{ $item->komentar }}</p>
                            <span class="d-flex">
                                <button class="btn p-0 m-0 me-2"> <i class="bi bi-hand-thumbs-up"></i> 0 kali</button>
                                <button class="btn p-0 m-0 me-2"><i class="bi bi-hand-thumbs-down"></i> 0 kali</button>
                                <button class="btn p-0 m-0"><i class="bi bi-chat-dots"></i> Balas..</button>
                            </span>

                        </div>
                    </div>
                @empty
                    <span class="h6 text-muted d-flex mx-auto">
                        <i class="bi bi-info-circle"></i>
                        Tidak ada komentar pada berita ini.
                    </span>
                @endforelse
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
