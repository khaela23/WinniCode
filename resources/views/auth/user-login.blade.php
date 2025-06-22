@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <form id="login-form" class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login Pembaca</h2>

        <div id="error-message" class="mb-4 text-red-600 hidden"></div>

        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" id="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-6">
            <label class="block mb-1">Password</label>
            <input type="password" id="password" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-primary text-white py-2 rounded font-semibold">Login</button>

        {{-- Link ke register --}}
        <div class="mt-4 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('user.register') }}" class="text-blue-500 hover:underline">Daftar di sini</a>
        </div>
    </form>
</div>

<script>
document.getElementById("login-form").addEventListener("submit", async function(e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    try {
        const response = await fetch("/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (!response.ok) {
            const message = data.message || "Login gagal";
            document.getElementById("error-message").innerText = message;
            document.getElementById("error-message").classList.remove("hidden");
        } else {
            localStorage.setItem("token", data.token); // Simpan token
            console.log("Login berhasil! Redirect ke halaman landing...");
            // ✅ redirect ke route landing
            window.location.href = "{{ route('landing') }}";
        }

    } catch (error) {
        document.getElementById("error-message").innerText = "Terjadi kesalahan saat login.";
        document.getElementById("error-message").classList.remove("hidden");
    }
});
</script>

@endsection
