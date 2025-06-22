@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <form id="register-form" class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register Pembaca</h2>

        <div id="error-message" class="mb-4 text-red-600 hidden"></div>

        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" id="name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" id="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-6">
            <label class="block mb-1">Password</label>
            <input type="password" id="password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-primary text-white py-2 rounded font-semibold">Daftar</button>

        {{-- Link ke login --}}
        <div class="mt-4 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('user.login') }}" class="text-blue-500 hover:underline">Masuk di sini</a>
        </div>
    </form>
</div>

<script>
document.getElementById("register-form").addEventListener("submit", async function(e) {
    e.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    try {
        const response = await fetch("/api/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ name, email, password })
        });

        const data = await response.json();

        if (!response.ok) {
            const message = data.message || (data.errors ? Object.values(data.errors).flat().join(", ") : "Register gagal");
            document.getElementById("error-message").innerText = message;
            document.getElementById("error-message").classList.remove("hidden");
        } else {
            alert("Register berhasil! Silakan login.");
            window.location.href = "{{ route('user.login') }}";
        }

    } catch (error) {
        document.getElementById("error-message").innerText = "Terjadi kesalahan saat register.";
        document.getElementById("error-message").classList.remove("hidden");
    }
});
</script>
@endsection
