@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Chỉnh sửa sản phẩm</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control" required>
        </div>

        <!-- Thay đổi màu nút Cập nhật thành đỏ và nút Hủy thành vàng -->
        <button type="submit" class="btn btn-danger">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-warning">Hủy</a>
    </form>
</div>
@endsection
