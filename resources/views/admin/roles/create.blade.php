@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form method="post" id="role_form" data-action="{{route('roles.store')}}">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="inputText">
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Permissions</legend>
                                <div class="col-sm-10">
                                   @if($permissions)
                                   @foreach($permissions as $permission)
                                   <div class="form-check">
                                        <input class="form-check-input permissions_id" type="checkbox" name="permission[]" id="gridCheck1" value="{{$permission->id}}">
                                        <label class="form-check-label" for="gridCheck1">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </fieldset>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary create_role">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
