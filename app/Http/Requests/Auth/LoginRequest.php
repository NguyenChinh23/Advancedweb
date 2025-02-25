<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Xác nhận rằng yêu cầu được cho phép.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc xác thực đầu vào.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Xử lý đăng nhập.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('Thông tin đăng nhập không chính xác.'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Kiểm tra giới hạn thử đăng nhập.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('Vui lòng thử lại sau :seconds giây.', ['seconds' => $seconds]),
        ]);
    }

    /**
     * Khóa thử đăng nhập.
     */
    public function throttleKey(): string
    {
        return strtolower($this->input('email')) . '|' . $this->ip();
    }
}
