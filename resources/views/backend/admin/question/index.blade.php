@extends('backend.layouts.admin.master')
@section('title', 'Service Sub Category')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">Question</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Question</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
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
                                            <td>{{ $doctor_speciality = \App\DoctorSpeciality::where('id',$question->doctor_speciality_id)->pluck('name')->first() }}</td>
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
                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.users.question.answer.form',$question->id)}}">
                                                            <i class="fe fe-pencil"></i> Answer Now
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.users.question.answer.update.form',$question->question_answer_id)}}">
                                                            <i class="fe fe-pencil"></i> Update Answer
                                                        </a>
                                                    @endif
                                                    @if($question->question_answer_id != NULL)
                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.users.question.answer.details',$question->id)}}">
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
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->

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
