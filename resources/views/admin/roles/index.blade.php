@extends('layouts.admin')
@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Role list</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role['name'] }}</td>
                                        <td>
                                            @if (isset($role['permissions']) && count($role['permissions']) > 0)
                                                @foreach ($role['permissions'] as $permission)
                                                    <span class="badge bg-success">{{ $permission['name'] }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-danger">No Permissions</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
