@extends('admin.layouts.master')
@section('title')
Dashboard | Create Artical
@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Artical</h4><br>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="custom-validation" action="{{route('artical.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control" required placeholder="Title" />
                                    @error('title')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <div>
                                        <textarea name="description" class="form-control" rows="5">{{old('description')}}</textarea>
                                    </div>
                                    @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Category Name</label>
                                    <select name="category_id" class="form-select" id="validationCustom03" required>
                                        <option selected disabled value="">Choose...</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label>Image</label>
                                    <div class="col-lg-12">
                                        <div class="input-group">

                                            <input type="file" name="image" class="form-control" id="image">
                                            <img id="showImage" class="rounded avatar-lg" src="{{asset('backend/assets/images/users/no_image.jpg') }}" style="width: 8%; height:8%;" alt="Artical image">
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Save
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

<script src="{{asset('backend/assets/js/pages/form-validation.init.js')}}"></script>
@endsection
