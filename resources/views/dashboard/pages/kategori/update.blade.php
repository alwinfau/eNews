@extends('dashboard.template.template')

@section('judul', 'Dashboard - ' . $data->categoryname)

@section('content')
    <div class="container">
        <form action="{{ route('udpate-categories', $data->slug_categoryname) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-9">
                    <div class="container">
                        <div class="card bg-white border-light">
                            <div class="card-header bg-white">
                                <a href="{{ route('categories') }}" class="btn btn-light btn-sm me-3">Kembali</a>
                                Udpate Categories
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="">Categoris Name <small class="text-danger">*</small></label>
                                    <input type="text" placeholder="Categories Name" name="categoryname"
                                        value="{{ $data->categoryname ?? '-' }}"
                                        class="form-control @error('categoryname') is-invalid @enderror">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="position-sticky">
                        <div class="card bg-white border-light">
                            <div class="card-header bg-white">
                                Action
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('modal')
@endpush

@push('script')
@endpush
