@extends('layouts.admin')
@section('content')
    <div class="pagetitle">
        <h1>Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Permission</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Permission list</h5>
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($permissions))
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>

                                            <td class="text-center">
                                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-check-circle text-primary">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                    </svg></a>
                                                <a href="javascript:void(0);" class="removePermission"
                                                    data-id="{{ $permission->id }}" data-toggle="tooltip"
                                                    data-placement="top" title="Delete" data-original-title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-x-circle text-danger">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="15" y1="9" x2="9" y2="15">
                                                        </line>
                                                        <line x1="9" y1="9" x2="15" y2="15">
                                                        </line>
                                                    </svg>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
