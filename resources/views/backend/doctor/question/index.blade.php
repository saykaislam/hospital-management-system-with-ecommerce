@extends('backend.layouts.doctor.master')
@section('title', 'Question')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Question</h3>
                        <div class="table-responsive">
                            <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doctor Speciality</th>
                                    <th>Search Title</th>
                                    <th>Question</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $key => $question)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        {{ $doctor_speciality = \App\DoctorSpeciality::where('id',$question->doctor_speciality_id)->pluck('name')->first() }}
                                    </td>
                                    <td>{{$question->search_title}}</td>
                                    <td>{{$question->question}}</td>
                                    <td>
                                        @if($question->status == 0)
                                        <form method="POST" action ="{{route('user.question.status')}}">
                                            @csrf
                                            <input type = "hidden" name="question_id" value="{{$question->id}}">
                                            <select name="status" class="form-control delivery" onchange="this.form.submit()">
                                                <option value="1" {{$question->status == '1' ? 'selected' : ''}}>Approved</option>
                                                <option value="0" {{$question->status == '0' ? 'selected' : ''}}>Pending</option>
                                            </select>
                                        </form>
                                        @else
                                            Approved
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="actions">
                                            @if($question->question_answer_id == NULL)
                                                <a class="btn btn-sm bg-success-light" href="{{route('doctor.users.question.answer.form',$question->id)}}">
                                                    <i class="fe fe-pencil"></i> Answer Now
                                                </a>
                                            @else
                                                <a class="btn btn-sm bg-success-light" href="{{route('doctor.users.question.answer.update.form',$question->question_answer_id)}}">
                                                    <i class="fe fe-pencil"></i> Update Answer
                                                </a>
                                            @endif
                                            @if($question->question_answer_id != NULL)
                                                <a class="btn btn-sm bg-success-light" href="{{route('doctor.users.question.answer.details',$question->id)}}">
                                                    <i class="fe fe-eye"></i> Answer View
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- /Page Wrapper -->


{{--        <!-- Add Modal -->--}}
{{--        <div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">--}}
{{--            <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title">Add Brands</h5>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <form>--}}
{{--                            <div class="row form-row">--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Brand Name</label>--}}
{{--                                        <input type="text" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Image</label>--}}
{{--                                        <input type="file"  class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /ADD Modal -->--}}

{{--        <!-- Edit Details Modal -->--}}
{{--        <div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">--}}
{{--            <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title">Edit Specialities</h5>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <form>--}}
{{--                            <div class="row form-row">--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Specialities</label>--}}
{{--                                        <input type="text" class="form-control" value="Cardiology">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Image</label>--}}
{{--                                        <input type="file"  class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /Edit Details Modal -->--}}

        <!-- Delete Modal -->
        <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" >
                <div class="modal-content">
                    <!--	<div class="modal-header">
                            <h5 class="modal-title">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>-->
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
