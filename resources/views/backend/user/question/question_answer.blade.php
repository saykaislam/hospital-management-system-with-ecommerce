@extends('backend.layouts.user.master')
@section('title', 'Service Order')
@push('css')
    {{--custom css--}}

@endpush
@section('content')
    {{--    @dd($question)--}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="col-md-12 " style="">
                        <table id="question" class="table">
                            <thead>
                            <tr>
                                <th>Recent Quenstions & Answers</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div id="accordion">
                                @foreach($question as $key => $question)
                                    <tr>
                                        <td>
                                            <div class="card">
                                                <div class="card-header" id="headingOne_{{$key}}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                            Question : {{$question->question}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne_{{$key}}" class="collapse" aria-labelledby="headingOne_{{$key}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        @if(empty($question->name))
                                                            <h5>Not answered yet</h5>
                                                        @else
                                                            <div class="mb-3">
                                                                <p class="m-0">Answerd By</p>
                                                                <h5 class="m-0">{{$question->name}}</h5>
                                                            </div>
                                                            <p>Answer : {{$question->answer}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </div>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#question').DataTable();
        } );
    </script>
@endpush
