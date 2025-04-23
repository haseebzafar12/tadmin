@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_tool">Add Custom Page:</h1>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                        <form method="post" id="user_form" action="{{ route('custom_page.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="page-name" class="col-sm-3 col-form-label">Page Name</label>
                                    <input type="text" class="form-control" name="page_name" id="page-name"
                                        placeholder="Page Name" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="page_slug" class="col-sm-3 col-form-label">Page Slug</label>
                                    <input type="text" class="form-control" name="page_slug" id="page_slug"
                                        placeholder="Page slug" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="meta_title" class="col-sm-3 col-form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Meta title">
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <span class="title_characters counter font-">( Character: <b>0</b> )</span>
                                            <span class="title_words counter">( Word: <b>0</b> )</span>
                                            <span class="title_spaces counter">( Extra Space: <b>0</b> )</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="meta_desc" class="col-sm-4 col-form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_desc" id="meta_desc" placeholder="Meta description"></textarea>
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <span class="characters counter font-">( Character: <b>0</b> )</span>
                                            <span class="words counter">( Word: <b>0</b> )</span>
                                            <span class="spaces counter">( Extra Space: <b>0</b> )</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <div id="fields_container"></div>
                            <div class="row mb-3 d-flex justify-content-end">
                                <div class="col-12 col-md-3 d-flex justify-content-end">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
