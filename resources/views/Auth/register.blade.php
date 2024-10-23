@extends('layouts.auth')
@section('title')
    Register Page
@endsection
@section('content')
    <div class="relative h-screen md:min-h-[80vh] place-content-center grid">
        <div class="h-full md:h-[50%] w-full bg-primary absolute top-0"></div>

        <form action="{{ route('register') }}" method="POST"
            class="w-full absolute rounded-t-lg bottom-0 md:relative md:min-w-[500px] flex flex-col gap-6 px-5 md:px-16 py-8 shadow-lg  md:rounded z-[50] bg-white">
            @csrf
            <h1 class="font-semibold text-xl md:text-center">Register</h1>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="" class="hidden md:flex">Username</label>
                    <input type="text" name="username" placeholder="username" class="border-gray-400 rounded"
                        value="{{ old('username') }}" />
                    @if ($errors->has('username'))
                        <span class="text-red-500">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="flex flex-col gap-1">
                    <label for="" class="hidden md:flex">password</label>
                    <input type="text" name="password" placeholder="password" class="border-gray-400 rounded"
                        value="{{ old('password') }}" />
                    @if ($errors->has('password'))
                        <span class="text-red-500">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="flex items-center flex-col gap-2">
                <x-button type="submit">Register</x-button>
                <span class="text-sm">Sudah punya akun?<a href="{{ route('login-page') }}"
                        class="text-blue-500 ms-2">login</a></span>
            </div>

        </form>
    </div>
@endsection
