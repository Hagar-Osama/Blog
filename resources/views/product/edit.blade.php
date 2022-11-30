@extends('admin.layouts.master')
@section('title')
Dashboard | Edit Product
@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Product</h4>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="custom-validation" action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                <div class="mb-3">
                                    <label>Product Name</label>
                                    <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Product Name" />
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <div>
                                        <textarea name="description" class="form-control" rows="5">{{$product->description}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Product Quantity</label>
                                        <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control" required placeholder="" />
                                        @error('quantity')
                                        <span class="text-danger" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Product Price</label>
                                        <input type="price" name="price" value="{{$product->price}}" class="form-control" required placeholder="" />
                                        @error('price')
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
                                                <img id="showImage" class="rounded avatar-lg" src="{{(! empty($product->image)) ? asset('storage/products/images/'.$product->image ) : asset('backend/assets/images/users/no_image.jpg') }}" style="width: 8%; height:8%;" alt="Artical image">
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

<script src="{{asset('backend/assets/js/pages/form-validation.init.js')}}"></script>
@endsection
