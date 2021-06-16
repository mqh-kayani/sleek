@extends('backend.baseLayout')
@section('title',"Sleek | Add Products")
@section('main-content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Add New Product</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('viewProducts')}}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add New Product</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card" style="height: auto;">
                                <div class="card-header">
                                    <h4 class="card-title">Product Details</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="post" action="{{route('saveProduct')}}" class="form form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Category</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <select name="product_category" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1"  aria-hidden="true">
                                                                    <option selected disabled>Choose Category</option>
                                                                    @if(count($all_categories) > 0)
                                                                        @foreach($all_categories as $category)
                                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @if($errors->has('product_category'))
                                                                    <span style="color: red; font-size: 12px">{{$errors->first('product_category')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Collection</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8 ">
                                                                <select name="product_collection" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1"  aria-hidden="true">
                                                                    <option selected disabled>Choose Category</option>
                                                                    @if(count($collections) > 0)
                                                                        @foreach($collections as $collection)
                                                                            <option value="{{$collection->id}}">{{$collection->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Name</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="product-name" value="{{old('product_name')}}" class="form-control" name="product_name" placeholder="Enter Product Name">
                                                                @if($errors->has('product_name'))
                                                                    <span style="color: red; font-size: 12px">{{$errors->first('product_name')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Size</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select name="product_size" class="select2 form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                                    <option selected disabled>Choose Size</option>
                                                                    <option value="Extra Large">Extra Large</option>
                                                                    <option value="Large">Large</option>
                                                                    <option value="Medium">Medium</option>
                                                                    <option value="Small">Small</option>
                                                                    <option value="Extra Small">Extra Small</option>
                                                                </select>
                                                                @if($errors->has('product_size'))
                                                                    <span style="color: red; font-size: 12px">{{$errors->first('product_size')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Price</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="number" id="product-price" class="form-control" name="product_price" value="{{old('product_price')}}" placeholder="Enter Product Price">
                                                                @if($errors->has('product_price'))
                                                                    <span style="color: red; font-size: 12px">{{$errors->first('product_price')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
{{--                                                    <div class="col-12">--}}
{{--                                                        <div class="form-group row">--}}
{{--                                                            <div class="col-md-4">--}}
{{--                                                                <span>Image</span>--}}
{{--                                                                <span class="float-right" style="color: red; font-size: 10px">* max 1MB (jpg,png,jpeg)</span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-8">--}}
{{--                                                                <div class="custom-file">--}}
{{--                                                                    <input type="file" name="product_image" class="custom-file-input" id="inputGroupFile01">--}}
{{--                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
{{--                                                                    @if($errors->has('product_image'))--}}
{{--                                                                        <span style="color: red; font-size: 12px">{{$errors->first('product_image')}}</span>--}}
{{--                                                                    @endif--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Video URL</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="product_video_url" value="{{old('product_video_url')}}" placeholder="Past Product Video URL">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Description</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control" name="product_description" id="basicTextarea" rows="3" placeholder="Enter Product Description">{{old('product_description')}}</textarea>
                                                                @if($errors->has('product_description'))
                                                                    <span style="color: red; font-size: 12px">{{$errors->first('product_description')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Color</span>
                                                                <span class="float-right" style="color: red">*</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type='color' name='color2' value='' />                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Images</span>
                                                                <span class="float-right" style="color: red; font-size: 10px">* max 1MB (jpg,png,jpeg)</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="input-field" style="width: 100% !important;">
                                                                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                                                                    @if($errors->has('images'))
                                                                        <span style="color: red; font-size: 12px">{{$errors->first('images')}}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Tags</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select name="product_tags[]" class="select2 form-control select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true">
                                                                    @if(count($all_tags) > 0)
                                                                        @foreach($all_tags as $i=>$tag)
                                                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Horizontal form layout section end -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.input-images-1').imageUploader();

            $("#custom").spectrum({
                color: tinycolor,
                flat: bool,
                showInput: bool,
                showInitial: bool,
                allowEmpty: bool,
                showAlpha: bool,
                disabled: bool,
                localStorageKey: string,
                showPalette: bool,
                showPaletteOnly: bool,
                togglePaletteOnly: bool,
                showSelectionPalette: bool,
                clickoutFiresChange: bool,
                cancelText: string,
                chooseText: string,
                togglePaletteMoreText: string,
                togglePaletteLessText: string,
                containerClassName: string,
                replacerClassName: string,
                preferredFormat: string,
                maxSelectionSize: int,
                palette: [[string]],
                selectionPalette: [string]
            });
        });
    </script>
@endsection
