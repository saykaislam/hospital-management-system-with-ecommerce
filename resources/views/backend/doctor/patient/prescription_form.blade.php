@extends('backend.layouts.doctor.master')
@section('title', 'Question')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Page Content -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Add Prescription</h4>
        </div>
        <form action="{{URL('prescription-store/'.$slug.'/'.$slot_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <!-- Add Item -->
                <div class="add-more-item text-right">
                    <a href="javascript:void(0);" class="AddMorePrescription"><i class="fas fa-plus-circle"></i> Add Item</a>
                </div>
                <!-- /Add Item -->

                <!-- Prescription Item -->
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center">
                                <thead>
                                    <tr>
{{--                                        <th style="min-width: 80px">Patient Age</th>--}}
                                        <th style="min-width: 200px">Name</th>
                                        <th style="min-width: 80px;">Quantity</th>
                                        <th style="min-width: 80px">Days</th>
                                        <th style="min-width: 100px;">Time</th>
                                        <th style="min-width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody class="showMorePrescription">
                                    <tr>
{{--                                        <td>--}}
{{--                                            <input class="form-control" type="number" name="age">--}}
{{--                                        </td>--}}
                                        <td>
                                            <input class="form-control" type="hidden" name="slug" value="{{$slug}}">
                                            <input class="form-control" type="text" name="name[]">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="quantity[]">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="days[]">
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="morning[0][]" value="morning"> Morning
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="afternoon[0][]" value="afternoon"> Afternoon
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="evening[0][]" value="evening"> Evening
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="night[0][]" value="night"> Night
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Prescription Item -->

                <!-- Signature -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="signature-wrap">
                            <input type="text" class="form-control datetimepicker" name="follow_up_date" placeholder="Select Follow Up Date">
                        </div>
                    </div>
                </div>
                <!-- /Signature -->

                <!-- Submit Section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            <button type="reset" class="btn btn-secondary submit-btn">Clear</button>
                        </div>
                    </div>
                </div>
                <!-- /Submit Section -->

            </div>
        </form>
    </div>
    <!-- /Page Content -->

@endsection
@push('js')
    <script>

        $(".showMorePrescription").on('click','.trash', function () {
            $(this).closest('.morePrescriptionArea').remove();
            return false;
        })

        var row = 1;

        $('.AddMorePrescription').on('click', function (){

            var showMorePrescription = '<tr class="morePrescriptionArea">' +
                '<td>' +
                '<input class="form-control" type="text" name="name[]">' +
                '</td>' +
                '<td>' +
                '<input class="form-control" type="text" name="quantity[]">' +
                '</td>' +
                '<td>' +
                '<input class="form-control" type="text" name="days[]">' +
                '</td>' +
                '<td>' +
                '<div class="form-check form-check-inline">' +
                '<label class="form-check-label">' +
                '<input class="form-check-input" type="checkbox" name="morning['+row+'][]" value="morning"> Morning' +
                '</label>' +
                '</div>' +
                '<div class="form-check form-check-inline">' +
                '<label class="form-check-label">' +
                '<input class="form-check-input" type="checkbox" name="afternoon['+row+'][]" value="afternoon"> Afternoon' +
                '</label>' +
                '</div>' +
                '<div class="form-check form-check-inline">' +
                '<label class="form-check-label">' +
                '<input class="form-check-input" type="checkbox" name="evening['+row+'][]" value="evening"> Evening' +
                '</label>' +
                '</div>' +
                '<div class="form-check form-check-inline">' +
                '<label class="form-check-label">' +
                '<input class="form-check-input" type="checkbox" name="night['+row+'][]" value="night"> Night' +
                '</label>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<a href="#" class="btn bg-danger-light trash"><i class="far fa-trash-alt"></i></a>' +
                '</td>' +
                '</tr>';
            $('.showMorePrescription').append(showMorePrescription);
            row ++
            return false;

        })

        // Date Time Picker

        if($('.datetimepicker').length > 0) {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                icons: {
                    up: "fas fa-chevron-up",
                    down: "fas fa-chevron-down",
                    next: 'fas fa-chevron-right',
                    previous: 'fas fa-chevron-left'
                }
            });
        }
    </script>
@endpush
