@extends('backend.layouts.clinic.master')
@section('title', 'Doctor')
@push('css')
    {{--custom css--}}
@endpush
@section('content')

        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Doctor List</h3>
                    </div>
{{--                    <div class="col-sm-5 col">--}}
{{--                        <a href="{{route('clinic.doctor.create')}}" class="btn btn-primary float-right mt-2">Add New</a>--}}
{{--                    </div>--}}
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor Speciality</th>
                                    <th>Visit Cost</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clinicDoctors as $key => $clinicDoctor)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$clinicDoctor->doctor_name}}</td>
                                    <td>{{$clinicDoctor->name}}</td>
                                    <td>{{$clinicDoctor->visit_cost}}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Delete Modal -->
        <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-content p-2">
                            <h4 class="modal-title">Delete</h4>
                            <p class="mb-4">Are you sure want to delete?</p>
                            <button type="button" class="btn btn-primary">Save </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Modal -->
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
