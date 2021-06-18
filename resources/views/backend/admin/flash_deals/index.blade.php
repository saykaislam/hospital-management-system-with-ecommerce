
@extends('backend.layouts.admin.master')
@section("title","Brand")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Product Brand</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product Brand</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('admin.flash_deals.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                    <thead>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Published</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fashDeals as $key => $fashDeal)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$fashDeal->title}}</td>
                                            <td>{{ date('d-m-Y', $fashDeal->start_date_time) }}</td>
                                            <td>{{ date('d-m-Y', $fashDeal->end_date_time) }}</td>
                                            <td>
                                                <label class="switch">
                                                    <input onchange="update_flash_deal_status(this)" value="{{ $fashDeal->id }}" type="checkbox" <?php if($fashDeal->status == 1) echo "checked";?> >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input onchange="update_flash_deal_feature(this)" value="{{ $fashDeal->id }}" type="checkbox" <?php if($fashDeal->featured == 1) echo "checked";?> >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="bg-info dropdown-item" href="{{route('admin.flash_deals.edit',encrypt($fashDeal->id))}}">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a class="bg-warning dropdown-item" href="{{route('admin.flash_deals.products.edit',encrypt($fashDeal->id))}}">
                                                            <i class="fas fa-edit"></i> Products Edit
                                                        </a>
                                                        <form id="delete-form-{{$fashDeal->id}}" action="{{route('admin.products.destroy',$fashDeal->id)}}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Published</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        //sweet alert
        function deleteProduct(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
        function update_flash_deal_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.flash_deals.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
        function update_flash_deal_feature(el){
            if(el.checked){
                var featured = 1;
            }
            else{
                var featured = 0;
            }
            $.post('{{ route('admin.flash_deals.update_featured') }}', {_token:'{{ csrf_token() }}', id:el.value, featured:featured}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

    </script>
@endpush
