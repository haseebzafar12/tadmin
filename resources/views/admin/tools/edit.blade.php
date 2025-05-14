@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_tool">Edit Tool:</h1>
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
                        <form method="POST" action="{{ route('tool.update', $tool->id) }}" id="user_form">
                            @csrf

                            <!-- Tool Name and Tool Slug -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="tool_name" class="col-sm-3 col-form-label">Tool Name</label>
                                    <input type="text" class="form-control" name="tool_name" id="tool_name"
                                        placeholder="Tool name" value="{{ $tool->tool_name }}" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="tool_slug" class="col-sm-3 col-form-label">Tool Slug</label>
                                    <input type="text" class="form-control" name="tool_slug" id="tool_slug"
                                        placeholder="Tool slug" value="{{ $tool->tool_slug }}">
                                </div>
                            </div>

                            <!-- Checkbox for Is Home -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_home_checkbox" type="checkbox"
                                            id="isHome"
                                            onchange="document.getElementById('isHomeHidden').value = this.checked ? 1 : 0;"
                                            {{ $tool->is_home == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isHome">
                                            Is it Home?
                                        </label>
                                    </div>
                                    <input type="hidden" name="is_home" id="isHomeHidden"
                                        value="{{ $tool->is_home == 1 ? 1 : 0 }}">

                                </div>
                            </div>

                            <!-- Meta Title and Meta Description with counters -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="meta_title" class="col-sm-3 col-form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Meta title" value="{{ $tool->meta_title }}">
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
                                    <textarea class="form-control" name="meta_desc" id="meta_desc" placeholder="Meta description">{{ $tool->meta_description }}</textarea>
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <span class="characters counter">( Character: <b>0</b> )</span>
                                            <span class="words counter">( Word: <b>0</b> )</span>
                                            <span class="spaces counter">( Extra Space: <b>0</b> )</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Language and Parent Tool Dropdowns -->
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label for="languages" class="col-sm-3 col-form-label">Language</label>
                                    <select class="form-select" name="languages" id="languages">
                                        @foreach ($languages as $lang)
                                            <option value="{{ $lang->code }}"
                                                {{ $tool->language == $lang->code ? 'selected' : '' }}>
                                                {{ $lang->name }} ({{ $lang->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="meta_title" class="col-sm-3 col-form-label">Page Title</label>
                                    <input type="text" class="form-control" name="page_title" id="page_title"
                                        placeholder="Page title" value="{{ $tool->page_title }}">
                                    
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="tools" class="col-sm-3 col-form-label">Parent</label>
                                    <select class="form-select" name="tools" id="tools">

                                        <!-- Populate options dynamically -->
                                        @foreach ($tools as $t)
                                            <option value="{{ $t->id }}"
                                                {{ $tool->parent_id == $t->id ? 'selected' : '' }}>
                                                {{ $t->tool_name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                @if(!empty($tool->content))
                                    @php
                                        $content = json_decode($tool->content, true);
                                    @endphp
                                    @foreach ($content as $key => $value)
                                        <div class="row mb-3">
                                            <div class="col-12 col-md-3">
                                                <input type="text" class="form-control" name="key[]"
                                                    value="{{ $key }}">
                                            </div>
                                            <div class="col-12 col-md-7">
                                                @if ($value !== strip_tags($value))
                                                    {{-- <input type="hidden" name="value[]" id="editorContent"> --}}
                                                    {{--<div class="quill-editor" data-content="{{ $value }}">
                                                        <input type="hidden" name="value[]" class="quill-content">
                                                    </div>--}}
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Editor</h5>
                                                            <textarea class="tinymce-editor" name="value[]">
                                                                {{ $value }}
                                                            </textarea><!-- End TinyMCE Editor -->
                                                        </div>
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
