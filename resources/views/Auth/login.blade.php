@extends('layouts.auth')
@section('title')
    Login Page
@endsection
@section('content')
    <div class="relative h-screen md:min-h-[80vh] md:place-content-center grid">
        <div class="h-full md:h-[50%] w-full bg-primary absolute top-0"></div>

        <form action="{{ route('login') }}" method="POST"
            class="w-full absolute rounded-t-lg bottom-0 md:relative md:min-w-[500px] flex flex-col gap-6 px-5 md:px-16 py-8 shadow-lg  md:rounded z-[50] bg-white">
            @csrf
            <h1 class="font-semibold text-xl md:text-center">Login</h1>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="" class="hidden md:flex">Username</label>
                    <input type="text" name="username" placeholder="username" class="border-gray-400 rounded" />
                    @if ($errors->has('username'))
                        <span class="text-red-500">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="flex flex-col gap-1">
                    <label for="" class="hidden md:flex">password</label>
                    <input type="text" name="password" placeholder="password" class="border-gray-400 rounded" />
                    @if ($errors->has('password'))
                        <span class="text-red-500">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="flex items-center flex-col gap-2">
                <x-button type="submit">Login</x-button>
                <div class="flex gap-4 w-full mt-3"><a href="/auth/google/redirect"
                        class="border shadow py-2 justify-center items-center w-full flex "><i
                            class='bx bxl-google'></i></a>
                    <a href="/auth/github/redirect" class="border shadow py-2 justify-center items-center w-full flex "><i
                            class='bx bxl-github me-3'></i></a>
                </div>
                <span class="text-sm">Belum punya akun?<a href="{{ route('register-page') }}"
                        class="text-blue-500 ms-2">register</a></span>
            </div>

        </form>
    </div>
@endsection
