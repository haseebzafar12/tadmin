@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_tool">Add Tool:</h1>
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

                        <form method="post" id="user_form" action="{{ route('tool.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="tool_name" class="col-sm-3 col-form-label">Tool Name</label>
                                    <input type="text" class="form-control" name="tool_name" id="tool_name"
                                        placeholder="Tool name" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="tool_slug" class="col-sm-3 col-form-label">Tool Slug</label>
                                    <input type="text" class="form-control" name="tool_slug" id="tool_slug"
                                        placeholder="Tool slug" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_home_checkbox" type="checkbox"
                                            id="isHome"
                                            onchange="document.getElementById('isHomeHidden').value = this.checked ? 1 : 0;">
                                        <label class="form-check-label" for="isHome">
                                            Is it Home?
                                        </label>
                                    </div>
                                    <input type="hidden" name="is_home" id="isHomeHidden" value="0">
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
                                <div class="col-12 col-md-4">
                                    <label for="languages" class="col-sm-3 col-form-label">Language</label>
                                    <select class="form-select" name="languages" id="languages">
                                        @if ($languages->count() > 0)
                                            @foreach ($languages as $lang)
                                                <option value="{{ $lang->code }}">{{ $lang->name }}
                                                    ({{ $lang->code }})
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="en">English</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="meta_desc" class="col-sm-4 col-form-label">Page Title</label>
                                    <input class="form-control" name="page_title" id="page_title" placeholder="Page Title">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="tools-list" class="col-sm-3 col-form-label">Parent</label>
                                    <select class="form-select" name="tools" id="tools">
                                        <option value="" selected>This is parent</option>
                                        <option>Tool 1</option>
                                        <option>Tool 2</option>
                                        <option>Tool 3</option>
                                        <option>Tool 4</option>
                                        <option>Tool 5</option>
                                    </select>
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
