@extends('backend.layouts.admin.master')
@section("title","Top Rated Shops")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Top Rated Shops</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Top Rated Shops</li>
                        </ul>
                    </div>
{{--                    <div class="col-sm-5 col">--}}
{{--                        <a href="{{route('admin.category.create')}}" class="btn btn-primary float-right mt-2">Add New</a>--}}
{{--                    </div>--}}
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
                                        <th>Name</th>
                                        <th>Ratting</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $key => $review)
                                        @php
                                            $shop = \App\Shop::where('id',$review->shop_id)->first();
                  $fiveStarRev = \App\ProductReview::where('shop_id',$shop->id)->where('rating',5)->where('status',1)->sum('rating');
                  $fourStarRev = \App\ProductReview::where('shop_id',$shop->id)->where('rating',4)->where('status',1)->sum('rating');
                  $threeStarRev = \App\ProductReview::where('shop_id',$shop->id)->where('rating',3)->where('status',1)->sum('rating');
                  $twoStarRev = \App\ProductReview::where('shop_id',$shop->id)->where('rating',2)->where('status',1)->sum('rating');
                  $oneStarRev = \App\ProductReview::where('shop_id',$shop->id)->where('rating',1)->where('status',1)->sum('rating');
                  $rating = (5*$fiveStarRev + 4*$fourStarRev + 3*$threeStarRev + 2*$twoStarRev + 1*$oneStarRev) / ($review->total_rating);
                                        @endphp
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <a href="{{route('shop.details',$shop->slug)}}">{{$shop->name}}</a>
                                            </td>
                                            <td>
                                                {{$totalRatingCount = number_format((float)$rating, 1, '.', '')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
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
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>

        //sweet alert
        function deleteDept(id) {
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
    </script>
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
