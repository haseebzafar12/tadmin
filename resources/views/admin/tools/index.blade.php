@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title add_tool">Tools List:</h1>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No.#</th>
                                <th>Tool Name</th>
                                <th>Tool Slug</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                            @if (!@empty($tools))
                                @foreach ($tools as $key => $tool)
                                    <tr class="tool_{{ $tool->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $tool->tool_name }}</td>
                                        <td>{{ $tool->tool_slug }}</td>
                                        <td>{{ $tool->language }}</td>
                                        <td>
                                            <a href="{{ route('tool.edit', $tool->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-tool"
                                                data-id="{{ $tool->id }}">Delete</a>
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
