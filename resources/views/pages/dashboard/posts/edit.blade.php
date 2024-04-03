@extends('layouts.app')

@section('title', 'Laravel Companion | Edit')

@section('content')
<main class="container">
    <h1 class="text-center py-3">Edit an existing project</h1>

    <form action="{{ route('dashboard.posts.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                name="title"
                id="title"
                value="{{ old('title') ?? $project->title }}"
                />
        </div>
       @error('title')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control @error('title') is-invalid @enderror"" name="content" id="content" rows="3">{{ old('content') ?? $project->content }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-outline-info">Submit your changes</button>
    </form>

</main>
@endsection
