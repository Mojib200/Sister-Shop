@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Product/ Product List </a></li>
            </ol>
        </div>
        @can('add_product')
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-danger text-primary">
                    <div class="card-header">
                        <h1> ---Product Information--- </h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product_store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for=""class="form-label">Product Category Name </label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">---Select Category Name---</option>
                                        @foreach ($categorys as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for=""class="form-label">Product Category Name </label>
                                    <select name="subcategory_id" class="form-control " id="subcategory_name">
                                        <option value="">---Select Category Name---</option>

                                    </select>
                                </div>



                            <div class="col-lg-4 mb-3">
                                <label for=""class="form-label">Product name</label>
                                <input type="text" class="form-control" name="product_name">
                            </div>
                            @error('product_name')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror
                            <div class="col-lg-4 mb-3">
                                <label for=""class="form-label">Brand name</label>
                                <select name="brand" class="form-control" id="">
                                    <option value="">---Select Brand Name---</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('brand')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror
                            <div class=" col-lg-4 mb-3">
                                <label for=""class="form-label">Product Slug</label>
                                <input type="text" class="form-control" name="product_slug">
                            </div>
                            @error('product_slug')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror

                            <div class="col-lg-4 mb-3">
                                <label for=""class="form-label">Product Reguler Price</label>
                                <input type="number" class="form-control" name="product_reguler_price">
                            </div>
                            @error('product_reguler_price')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror



                            <div class="col-lg-4 mb-3">
                                <label for=""class="form-label">Product Discount % </label>
                                <input type="number" class="form-control" name="product_discount_price">
                            </div>
                            @error('product_discount_price')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror

                            <div class="col-lg-4 mb-3">
                                <label for=""class="form-label">Product After Discount price</label>
                                <input type="number" class="form-control" name="product_after_discount_price">
                            </div>
                            @error('product_after_discount_price')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror



                            <div class="col-lg-6 mb-3">
                                <label for=""class="form-label">Short Description</label>
                                <input type="text"  class="form-control " name="short_description">
                            </div>
                            @error('short_description')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror

                            <div class="col-lg-6 mb-3">
                                <label for=""class="form-label">Long Description</label>
                                <textarea type="text" class="form-control " id="summernote" name="long_description"></textarea>

                            </div>
                            @error('long_description')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror



                            <div class=" col-lg-6 mb-3">
                                <label for=""class="form-label">Thumbnails</label>
                                <input type="file" class="form-control" name="thumbnails[]" multiple
                                    onchange="document.getElementById('thumbnails').src = window.URL.createObjectURL(this.files[0])">
                                <label for=""class="form-label">Insert thumbnails Show</label>
                              <div class=" mb-3">
                                <img id="thumbnails"src="" alt="" width="150" height="150"
                                class="rounded-circle">
                              </div>
                            </div>

                            @error('thumbnails')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror


                            @if ($products != null)
                            <div class="col-lg-6 mb-3">
                                <label for=""class="form-label">Product Preview</label>
                                <input type="file" class="form-control" name="preview"onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                <label for=""class="form-label">Insert Preview Show</label>
                                <div class="  mb-3">
                                    <img id="preview"src="" alt="" width="150" height="150"
                                    class="rounded-circle">
                                </div>
                            </div>

                            @endif
                            @error('preview')
                                <div class="alert alert-danger mb-3">{{ $message }}
                                </div>
                            @enderror




                        </div>

                            <div class=" col-lg-12 mb-3 pt-2">
                                <button class="btn btn-primary" type="submit">Add Product</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endcan


    </div>
@endsection
@section('footer_script')
<script>
    $('#category_id').change(function(){
        var category_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/product_sub_category',
            data:{'category_id':category_id},
            success:function(data){
                $('#subcategory_name').html(data);
            }
        });
    })
    $(document).ready(function() {
$('#summernote').summernote();
});

</script>
    {{-- <script>
        $('.category_id').change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
               });
               alert(category_id);
            $. ajax({
                type: 'POST',
                url: '/product_sub_category',
                data: {'category_id':category_id},
                success:function(data){

                // $('#subcategory_name').html(data);
            }
            // alert(data);   I
            //     success:function(data){
            //         alert(data);
            //     }
            });

        })
    </script> --}}
@endsection
