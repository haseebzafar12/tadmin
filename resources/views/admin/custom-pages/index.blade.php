@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_tool">Pages List:</h1>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No.#</th>
                                <th>Page Name</th>
                                <th>Page Slug</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            @if (!@empty($pages))
                                @foreach ($pages as $key => $page)
                                    <tr class="page_{{ $page->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $page->page_name }}</td>
                                        <td>{{ $page->page_slug }}</td>
                                        <td>{{ $page->created_at->format('d F Y') }}</td>
                                        <td>
                                            <a href="{{ route('custom_page.edit', $page->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-page"
                                                data-id="{{ $page->id }}">Delete</a>
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
