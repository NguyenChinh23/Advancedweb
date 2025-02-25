@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Thêm sản phẩm mới</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>

  
        <button type="submit" class="btn btn-danger">Lưu</button>
        <a href="{{ route('products.index') }}" class="btn btn-warning">Hủy</a>
    </form>
</div>
@endsection
