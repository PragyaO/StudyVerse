@extends('layouts.master')

@section('title', 'Edit Category')

@section('content')

<div>
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Edit Category</h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <form action="{{ url('admin/update-faculty/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="mb-1">Category Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="mb-1">Slug</label>
                        <input type="text" value="{{ $category->slug }}" name="slug" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="mb-1">Description</label>
                        <textarea name="description" id="mySummernote" class="form-control" rows="3">{{ $category->description }}</textarea>
                    </div>

                    <h6>Level Type</h6>
                    <div class="row mb-4">
                         <div class="col-md-3 md3">
                            <input type="radio" name="levelType" value="1" {{ $category->levelType == 1 ? 'checked' : '' }}>
                            <label for="levelType">is Semester</label>
                         </div>

                         <div class="col-md-3 md3">
                            <input type="radio" name="levelType" value="2" {{ $category->levelType == 2 ? 'checked' : '' }}>
                            <label for="levelType">is Year</label>
                         </div>
                    </div>

                    <div class="mt-4 mb-3">
                        <h5>SEO Tags</h5>
                    </div>

                    <div class="mb-3">
                        <label for="meta_title" class="mb-1">Meta Title</label>
                        <input type="text" value="{{ $category->meta_title }}" name="meta_title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="mb-1">Meta Description</label>
                        <input type="text" value="{{ $category->meta_description }}" name="meta_description" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="meta_keyword" class="mb-1">Meta Keyword</label>
                        <input type="text" value="{{ $category->meta_keyword }}" name="meta_keyword" class="form-control">
                    </div>

                    <h6>Status Mode</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <input type="checkbox" name="navbar_status" {{ $category->navbar_status == '1' ? 'checked' : '' }}>
                            <label for="Navbar Status">Navbar Status</label>
                        </div>

                        <div class="col-md-3 mb-3">
                            <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked' : '' }}>
                            <label for="Status">Status</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
