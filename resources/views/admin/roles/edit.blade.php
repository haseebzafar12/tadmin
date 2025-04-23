@extends('layouts.admin')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-12 mx-auto">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Role/edit</h4>
                        </div>                 
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div class="row">
                        <div class="col-lg-6 col-12 mx-auto">
                            <form action="{{ route('roles.update',$role->id) }}" method="POST">
                                @csrf
                                 @method('PUT')
                                <div class="form-group">
                                    <label>role</label>
                                    <input type="text" name="name" class="form-control" value="{{$role->name}}" required>
                                </div>
                                <input type="submit" name="txt" class="mt-2 btn btn-primary" value="Update">
                            </form>
                        </div>                                        
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection