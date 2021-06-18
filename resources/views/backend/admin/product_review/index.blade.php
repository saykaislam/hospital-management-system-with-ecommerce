@extends('backend.layouts.admin.master')
@section("title","Product Review List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/select2/select2.min.css')}}">
    <style>
        li{
            list-style:none;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Product Review List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product Review List</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="callout callout-info">
                            <div class="card card-info" style="padding: 20px 40px 40px 40px;">
                                <form role="form" action="{{route('admin.review.details')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Ratings</label>
                                            <select name="rating" id="" class="form-control select2">
                                                    <option value="5" {{$rating == 5 ? 'selected' : ''}}>5</option>
                                                    <option value="4" {{$rating == 4 ? 'selected' : ''}}>4</option>
                                                    <option value="3" {{$rating == 3 ? 'selected' : ''}}>3</option>
                                                    <option value="2" {{$rating == 2 ? 'selected' : ''}}>2</option>
                                                    <option value="1" {{$rating == 1 ? 'selected' : ''}}>1</option>
                                            </select>
                                        </div>
                                        <div class="col-4" style="margin-top: 30px">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                @if($reviews != null)
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Customer name</th>
                                            <th>Shop name</th>
                                            <th>Product name</th>
                                            <th>Rating</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reviews as $key => $review)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$review->user->name}}</td>
                                                <td>{{$review->shop->name}}</td>
                                                <td>{{$review->product->name}}</td>
                                                <td>{{$review->rating}}</td>
                                                <td>
                                                    <div class="form-group col-md-2">
                                                        <label class="switch" >
                                                            <input onchange="update_review_status(this)" value="{{ $review->id }}" {{$review->status == 1 ? 'checked':''}} type="checkbox" >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-info waves-effect" href="{{route('admin.review.view',encrypt($review->id))}}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center ">
                                        <h2><i class="fa fa-info-circle text-info"></i> Please Select a Rating!!!</h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /Recent Orders -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@stop
@push('js')
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="{{asset('backend/admin/plugins/select2/select2.full.min.js')}}"></script>

    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );

        function update_review_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.review.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
    <script>
        $('.select2').select2();
    </script>
@endpush
