@extends('backend.baseLayout')
@section('title',"Sleek | Tags")
@section('main-content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Product Tags</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('adminDashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Tags
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
                                            <h4 class="modal-title" id="myModalLabel33">Add New Tag </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{route('addTag')}}">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Name: </label>
                                                <div class="form-group">
                                                    <input type="text" name="name" placeholder="Enter Category Name" class="form-control" required>
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
                                <h4 class="card-title">All Product Tags</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover-animation table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($tags) > 0)
                                                @foreach($tags as $i=>$tag)
                                                    <tr>
                                                        <th scope="row">{{++$i}}</th>
                                                        <td>{{$tag->name}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1 btn-outline-info waves-effect waves-light float-left btnEdit" id="btnEdit" data-id="{{$tag->id}}"><i class="feather icon-edit-1"></i>&nbsp;Edit</button>
                                                            <a href="{{route('deleteTag',$tag->id)}}" type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1 btn-outline-danger waves-effect waves-light float-right"><i class="feather icon-trash-2"></i>&nbsp;Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <span>No Tag Has Been Added Yet!</span>
                                            @endif
                                            </tbody>
                                        </table>
                                        <div class="modal fade text-left" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="editCategoryModal1">Update Tag </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{route('updateTag')}}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="tag_id" id="tag-id">
                                                            <label>Name: </label>
                                                            <div class="form-group">
                                                                <input type="text" name="name" id="tag-name" placeholder="Enter Tag Name" class="form-control" required>
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
                var tag_id = $(this).data("id");
                $.ajax({
                    url:'{{route('getTag')}}/'+tag_id,
                    type:'GET',
                    success:function (response) {
                        $('#tag-id').val(response.data.id);
                        $('#tag-name').val(response.data.name)
                        $('#editTagModal').modal('show');
                    },
                });

            });
        })
    </script>
@endsection
