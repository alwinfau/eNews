@extends('dashboard.template.template')

@section('judul', 'Dashboard | Kategori')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-4 bg-white border-light">
                    <div class="card-header rounded-top-4 bg-white d-flex justify-content-between">
                        List Categories
                        <a href="{{ route('add-categories') }}" class="btn btn-sm btn-outline-danger">
                            Add Categories
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <th>No</th>
                            <th>Categories Name</th>
                            <th>Created By</th>
                            <th>Date & Time</th>
                            <th>Action</th>

                            @php
                                $no = 1;
                            @endphp
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->categoryname }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d M Y, H:i T') }}
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('edit-category', $item->slug_categoryname) }}"
                                            class="btn btn-danger me-1">Edit</a>

                                        <form class="form-inline"
                                            action="{{ route('delete-categories', $item->slug_categoryname) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('modal')
@endpush

@push('script')
@endpush
