@extends('backend.layouts.service_provider.master')
@section('title', 'Order')
@push('css')

@endpush
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="doc-review review-listing">

            <!-- Review Listing -->
            <ul class="comments-list">
                <!-- Comment List -->
                @if(count($reviews) > 0)
                <li>
                    @foreach($reviews as $review)
                        <div class="comment">
                            <div class="comment-body">
                                <div class="meta-data">
                                    <p class="comment-author">
                                        {{$user_name = \App\User::where('id',$review->user_id)->pluck('name')->first()}}
                                    </p>
                                </div>
                                <div class="review-count rating" >
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    {{--                                        <span class="small">({{ $review }})</span>--}}
                                </div>
                                <p class="recommended"><i class="far fa-thumbs-up"></i>{{$review->problem}}</p>
                                <p class="comment-content">
                                    {!! $review->description !!}
                                </p>

                            </div>
                        </div>
                    @endforeach
                </li>
                @else
                <li>No Review Found!</li>
                @endif
                <!-- /Comment List -->

            </ul>
            <!-- /Comment List -->

        </div>
    </div>
@stop
@push('js')

@endpush
