<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-light">
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="mb-5 text-center">
                                    <h4>Register Here</h4>
                                </div>

                                <!-- Hiển thị lỗi nếu có -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <!-- Nhập tên -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                                    </div>

                                    <!-- Nhập email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                                    </div>

                                    <!-- Nhập mật khẩu -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>

                                    <!-- Xác nhận mật khẩu -->
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="confirm_password" required>
                                    </div>

                                    <div class="d-grid">
                                        <button class="btn btn-primary py-3" type="submit">Register Now</button>
                                    </div>
                                </form>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="text-decoration-none">Click here to login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
