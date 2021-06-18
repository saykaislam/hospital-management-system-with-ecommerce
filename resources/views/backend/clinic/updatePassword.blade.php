@extends('backend.layouts.doctor.master')
@section('title', 'Update PassWord')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-6">

                    <!-- Change Password Form -->
                    <form action="{{route('doctor.update.password')}}" method="post" >
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="old_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password"  name="password"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                    </form>
                    <!-- /Change Password Form -->

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
