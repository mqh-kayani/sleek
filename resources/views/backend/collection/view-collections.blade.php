@extends('backend.baseLayout')
@section('title',"Sleek | Categories")
@section('main-content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Product Categories</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('adminDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Collections
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#inlineForm">
                                + Add New
                            </button>
                            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Add New Collection </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{route('addCollection')}}">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Category: </label>
                                                <div class="form-group">
                                                    <select name="category_id" class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1"  aria-hidden="true">
                                                        <option selected disabled>Choose Category</option>
                                                        @if(count($categories) > 0)
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                                <hr>
                                                <label>Name: </label>
                                                <div class="form-group">
                                                    <input type="text" name="name" placeholder="Enter Collection Name" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary col-8 btn-block waves-effect waves-light">+Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Table Hover Animation start -->
                <div class="row" id="table-hover-animation">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Collections</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover-animation table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($collections) > 0)
                                                @foreach($collections as $i=>$collection)
                                                <tr>
                                                    <th scope="row">{{++$i}}</th>
                                                    <td>{{$collection->name}}</td>
                                                    <td>{{$collection->category->name}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1 btn-outline-info waves-effect waves-light float-left btnEdit" id="btnEdit" data-id="{{$collection->id}}"><i class="feather icon-edit-1"></i>&nbsp;Edit</button>
                                                        <a href="{{route('deleteCollection',$collection->id)}}" type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1 btn-outline-danger waves-effect waves-light float-right"><i class="feather icon-trash-2"></i>&nbsp;Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <span>No Collection Has Been Added Yet!</span>
                                            @endif
                                            </tbody>
                                        </table>
                                        <div class="modal fade text-left" id="editCollectionModal" tabindex="-1" role="dialog" aria-labelledby="editCollectionModal1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="editCollectionModal1">Update Category </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{route('updateCollection')}}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="col_id" id="col-id">
                                                            <label>Name: </label>
                                                            <div class="form-group">
                                                                <input type="text" name="name" id="col-name" placeholder="Enter Collection Name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-info col-8 btn-block waves-effect waves-light">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table head options end -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('.btnEdit').each(function () {
            $(this).on('click',function () {
                var collection_id = $(this).data("id");
                $.ajax({
                    url:'{{route('getCollection')}}/'+collection_id,
                    type:'GET',
                    success:function (response) {
                        $('#col-id').val(response.data.id);
                        $('#col-name').val(response.data.name)
                        $('#editCollectionModal').modal('show');
                    },
                });

            });
        })
    </script>
@endsection
