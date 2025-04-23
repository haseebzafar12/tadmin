@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_blog">Blogs List:</h1>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No.#</th>
                                <th>blog Name</th>
                                <th>blog Slug</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                            @if (!@empty($blogs))
                                @foreach ($blogs as $key => $blog)
                                    <tr class="blog_{{ $blog->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->slug }}</td>
                                        <td>{{ $blog->language }}</td>
                                        <td>
                                            <a href="{{ route('blogs.edit', $blog->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-blog"
                                                data-id="{{ $blog->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
