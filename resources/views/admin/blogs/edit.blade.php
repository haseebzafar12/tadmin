@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_page">Edit Blog Page:</h1>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Check if there are any validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data" id="user_form">
                            @csrf
                            @method('PUT')
                            <!-- page Name and page Slug -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="page name" value="{{ $blog->title }}" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="blog_slug" class="col-sm-3 col-form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="blog_slug"
                                        placeholder="page slug" value="{{ $blog->slug }}" readonly>
                                </div>
                            </div>

                            <!-- Meta Title and Meta Description with counters -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="meta_title" class="col-sm-3 col-form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Meta title" value="{{ $blog->meta_title }}">
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <span class="title_characters counter">( Character: <b>0</b> )</span>
                                            <span class="title_words counter">( Word: <b>0</b> )</span>
                                            <span class="title_spaces counter">( Extra Space: <b>0</b> )</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="meta_desc" class="col-sm-4 col-form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_desc" id="meta_desc" placeholder="Meta description">{{ $blog->meta_description }}</textarea>
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <span class="characters counter">( Character: <b>0</b> )</span>
                                            <span class="words counter">( Word: <b>0</b> )</span>
                                            <span class="spaces counter">( Extra Space: <b>0</b> )</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="languages" class="col-sm-3 col-form-label">Language</label>
                                    <select class="form-select" name="languages" id="languages">
                                        @foreach ($languages as $lang)
                                            <option value="{{ $lang->code }}"
                                                {{ $blog->language == $lang->code ? 'selected' : '' }}>
                                                {{ $lang->name }} ({{ $lang->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="image" class="col-sm-2 col-form-label">Image Upload</label>
                                    <div class="col-12 col-sm-6">
                                        <input class="form-control" name="file" type="file" id="formFile">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        @if($blog->image)
                                            <img src="{{url($blog->image)}}" height="50" width="50">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Dynamic Fields Section -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label class="col-sm-3 col-form-label content-label">Content:</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Editor</h5>
                                            <textarea class="tinymce-editor" name="content">
                                                {{ $blog->content }}
                                            </textarea><!-- End TinyMCE Editor -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="row mb-3 d-flex justify-content-end">
                                <div class="col-12 col-md-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
