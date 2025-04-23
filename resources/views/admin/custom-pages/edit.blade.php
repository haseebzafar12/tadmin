@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_page">Edit Custom Page:</h1>
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
                        <form method="POST" action="{{ route('custom_page.update', $page->id) }}" id="user_form">
                            @csrf

                            <!-- page Name and page Slug -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="page_name" class="col-sm-3 col-form-label">page Name</label>
                                    <input type="text" class="form-control" name="page_name" id="page_name"
                                        placeholder="page name" value="{{ $page->page_name }}" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="page_slug" class="col-sm-3 col-form-label">page Slug</label>
                                    <input type="text" class="form-control" name="page_slug" id="page_slug"
                                        placeholder="page slug" value="{{ $page->page_slug }}" disabled>
                                </div>
                            </div>

                            <!-- Meta Title and Meta Description with counters -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="meta_title" class="col-sm-3 col-form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Meta title" value="{{ $page->meta_title }}">
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
                                    <textarea class="form-control" name="meta_desc" id="meta_desc" placeholder="Meta description">{{ $page->meta_description }}</textarea>
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <span class="characters counter">( Character: <b>0</b> )</span>
                                            <span class="words counter">( Word: <b>0</b> )</span>
                                            <span class="spaces counter">( Extra Space: <b>0</b> )</span>
                                        </div>
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
                                <div class="col-12 col-md-6">
                                    <select class="form-select" id="input_type">
                                        <option value="">Select input type</option>
                                        <option value="input">Input Field</option>
                                        <option value="textarea">Textarea</option>
                                        <option value="editor">Rich text editor</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <button type="button" class="btn btn-success btn-sm" id="add_field">Add row</button>
                                </div>
                            </div>
                            <div id="fields_container">
                                @if(!empty($page->content))
                                    @php
                                        $content = json_decode($page->content, true);
                                    @endphp
                                    @foreach ($content as $key => $value)
                                        <div class="row mb-3">
                                            <div class="col-12 col-md-3">
                                                <input type="text" class="form-control" name="key[]"
                                                    value="{{ $key }}">
                                            </div>
                                            <div class="col-12 col-md-7">
                                                @if ($value !== strip_tags($value))
                                                    <input type="hidden" name="value[]" id="editorContent">
                                                    <div class="quill-editor" data-content="{{ $value }}">
                                                        <input type="hidden" name="value[]" class="quill-content">
                                                    </div>
                                                @else
                                                    <input type="text" class="form-control" name="value[]" value="{{ $value }}">
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <i class="bi bi-x-circle text-danger remove_field"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
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
