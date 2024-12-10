@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thêm Dự Án Mới</h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('carbon-projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Dự Án</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="Nhập tên dự án" 
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Vị Trí</label>
                            <input 
                                type="text" 
                                class="form-control @error('location') is-invalid @enderror" 
                                id="location" 
                                name="location" 
                                value="{{ old('location') }}" 
                                placeholder="Nhập vị trí" 
                                required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Developer -->
                        <div class="mb-3">
                            <label for="developer" class="form-label">Nhà Phát Triển</label>
                            <input 
                                type="text" 
                                class="form-control @error('developer') is-invalid @enderror" 
                                id="developer" 
                                name="developer" 
                                value="{{ old('developer') }}" 
                                placeholder="Nhập tên nhà phát triển" 
                                required>
                            @error('developer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô Tả</label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="4" 
                                placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--Image-->
                        <div>
                            <label for="images">Upload Images:</label>
                            <input type="file" name="images[]" multiple>
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                            <input 
                                type="date" 
                                class="form-control @error('start_date') is-invalid @enderror" 
                                id="start_date" 
                                name="start_date" 
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                            <input 
                                type="date" 
                                class="form-control @error('end_date') is-invalid @enderror" 
                                id="end_date" 
                                name="end_date" 
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Thêm Dự Án</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
