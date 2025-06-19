@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <form method="POST" action="{{ route('login') }}" class="bg-white p-8 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>
        @if(session('error'))
            <div class="mb-4 text-red-600">{{ session('error') }}</div>
        @endif
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required autofocus>
        </div>
        <div class="mb-6">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit" class="w-full bg-primary text-white py-2 rounded font-semibold">Login</button>
    </form>
</div>
@endsection 