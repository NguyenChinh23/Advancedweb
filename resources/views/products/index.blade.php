@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Danh sách sản phẩm</h1>

    <!-- Nút Thêm sản phẩm -->
    <div class="text-end mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm mới</a>
    </div>

    <!-- Bảng sản phẩm -->
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Nút Đăng xuất căn phải dưới bảng -->
    <div class="text-end mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
    </div>
</div>
@endsection
