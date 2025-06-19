@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8 px-2">
    <h1 class="text-xl md:text-2xl font-bold mb-8 text-primary text-left">Admin Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('admin.authors.index') }}" class="block bg-white border border-primary rounded-lg p-6 text-center shadow hover:shadow-lg hover:scale-105 hover:bg-primary hover:text-white transition-all duration-200">
            <div class="text-2xl font-bold mb-2">Authors</div>
            <div>Manage Authors</div>
        </a>
        <a href="{{ route('admin.news.index') }}" class="block bg-white border border-primary rounded-lg p-6 text-center shadow hover:shadow-lg hover:scale-105 hover:bg-primary hover:text-white transition-all duration-200">
            <div class="text-2xl font-bold mb-2">News</div>
            <div>Manage News</div>
        </a>
        <a href="{{ route('admin.banners.index') }}" class="block bg-white border border-primary rounded-lg p-6 text-center shadow hover:shadow-lg hover:scale-105 hover:bg-primary hover:text-white transition-all duration-200">
            <div class="text-2xl font-bold mb-2">Banners</div>
            <div>Manage Banners</div>
        </a>
        <a href="{{ route('admin.news-categories.index') }}" class="block bg-white border border-primary rounded-lg p-6 text-center shadow hover:shadow-lg hover:scale-105 hover:bg-primary hover:text-white transition-all duration-200">
            <div class="text-2xl font-bold mb-2">News Categories</div>
            <div>Manage News Categories</div>
        </a>
    </div>
</div>
@endsection 