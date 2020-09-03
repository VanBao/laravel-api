@extends('layouts.app',['page' => 'rating','text' => 'Chi tiết đánh giá'])
@section('header-action')
    <label class="mr-2">Trạng thái :</label>
    @if($data['is_read'] == 0)
        <span class="text-warning">Chưa xem</span>
    @else
        <span class="text-success">Đã xem</span>
    @endif
{{--    @if($data['is_read'] == 0)--}}
{{--        <a class="btn btn-sm btn-success ml-3" href="{{ route('admin.rating.read',['id' => $data['id']]) }}">Đã xem</a>--}}
{{--    @endif--}}
@endsection
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Row-->
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Chi tiết đánh giá
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="kt-section mb-0">
                            <div class="form-group validated">
                                <label>Đơn hàng: </label>
                                <a href="{{ route('admin.booking.detail',['id' => $data['booking']['id']]) }}">{{ $data['booking']['booking_code'] }}</a>
                            </div>
                            <div class="form-group validated">
                                <label>Người đánh giá: </label>
                                <a href="{{ route('admin.user.edit',['id' => $data['user']['id']]) }}">{{ $data['user']['name'] }}</a>
                            </div>
                            <div class="form-group validated">
                                <label>Kỹ thuật viên: </label>
                                <a href="{{ route('admin.user.edit',['id' => $data['booking']['staff']['id']]) }}">{{ $data['booking']['staff']['name'] }}</a>
                            </div>
                            <div class="form-group validated">
                                <label>Số sao:</label>
                                <span class="kt-font-bolder">{{$data['rating']}}</span>
                            </div>
                            <div class="form-group validated form-group-last">
                                <label>Nội dung:</label>
                                <span class="kt-font-bolder">{!! nl2br(htmlspecialchars($data['note'])) !!}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
        <!--End::Row-->

    </div>
@endsection

