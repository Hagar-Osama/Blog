@extends('admin.layouts.master')
@section('title')
Dashboard | Edit User
@endsection
@section('css')
<link href="{{asset('backend/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">

@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit User</h4>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="custom-validation" action="{{route('users.update',[ $user->roles->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="userId" value="{{$user->id}}">
                                <div class="mb-3"><br>
                                    <label>User Name</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" required placeholder="User Name" />
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <div>
                                        <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
                                    </div>
                                    @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <div>
                                        <input type="password" name="password" value="" class="form-control">
                                    </div>
                                    @error('password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Role Name</label>
                                    <select name="role_id" class="form-select" id="validationCustom03" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : ""}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="form-label">Assign  Permission</label>

                                    <select class="select2 form-control select2-multiple" name="permissions[]" multiple="multiple" data-placeholder="Choose A Permission...">
                                        <optgroup>
                                            @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}"@selected($user->roles->hasPermission($permission->name))>{{$permission->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('permissions')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                                <br><br>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Update
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script src="{{asset('backend/assets/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<script src="{{asset('backend/assets/js/pages/form-advanced.init.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/form-validation.init.js')}}"></script>
@endsection
