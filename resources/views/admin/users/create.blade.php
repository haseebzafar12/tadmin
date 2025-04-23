@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form method="post" id="user_form" data-action="{{route('users.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="inputText">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Roles</legend>
                                <div class="col-sm-10">
                                   @if($roles)
                                   @foreach($roles as $index => $role)
                                   <div class="form-check">
                                        <input class="form-check-input roles_id" type="checkbox" name="roles[]" id="role_{{$index}}" value="{{$role->id}}">
                                        <label class="form-check-label" for="role_{{$index}}">
                                            {{$role->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary create_user">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
