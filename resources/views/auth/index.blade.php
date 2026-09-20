@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-base-200 px-4">
    <div class="card w-full max-w-sm shrink-0 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold justify-center mb-2 text-blue-900">Welcome Back</h2>
            <p class="text-center text-sm text-base-content/70 mb-4">Please log in to your account</p>
            @if(session('error'))
            <div role="alert" class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-white">{{ session('error') }}</span>
            </div>
            @endif
            <form method="POST" action="">
                @csrf
                <!-- Email Address -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text font-semibold">Email Address</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                        class="input input-bordered w-full @error('email') input-error @enderror" autofocus />
                    @if($errors->has('email'))
                    <span class="label-text-alt text-error font-medium">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-control mb-2">
                    <label class="label">
                        <span class="label-text font-semibold">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="input input-bordered w-full @error('password') input-error @enderror" />
                    @if($errors->has('password'))
                    <span class="label-text-alt text-error font-medium">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between my-4">
                    <div class="form-control">
                        <label class="label cursor-pointer gap-2">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" />
                            <span class="label-text text-sm">Remember me</span>
                        </label>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="form-control mt-6">
                    <button type="submit" class="btn bg-blue-900 w-full hover:bg-blue-950 border-blue-900 text-white">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
