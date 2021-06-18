@extends('backend.layouts.clinic.master')
@section('title', 'Lab Test create')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lab Test Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('clinic.labTest.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($tests))
                            @foreach($tests as $test)
                                @php
                                    $check = \App\LabTest::where('clinic_or_lab_user_id',Auth::user()->id)
                                            ->where('test_id',$test->id)
                                            ->first();

                                    if(!empty($check->id)){
                                        $checked = 'checked';
                                        //$disabled = 'disabled';
                                    }else{
                                        $checked = '';
                                        //$disabled = '';
                                    }
                                @endphp
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
{{--                                        <input class="form-check-input" {{$checked}} {{$disabled}} type="checkbox" name="test[]" value="{{$test->id}}"> {{$test->name}}--}}
                                        <input class="form-check-input" {{$checked}} type="checkbox" name="test[]" value="{{$test->id}}"> {{$test->name}}
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Previous Price</label>
                                    <div class="col-md-10">
                                        <input type="text" name="lab_test_regular_price[]" value="{{$check['lab_test_regular_price']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Price</label>
                                    <div class="col-md-10">
                                        <input type="text" name="lab_test_price[]" value="{{$check['lab_test_price']}}" class="form-control">
                                    </div>
                                </div>

                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-form-label col-md-2"></label>
                            <div class="col-lg-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('js')

@endpush
