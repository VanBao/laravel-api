@extends('layouts.app',['page' => 'notification','text' => 'Chi tiết thông báo'])
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
                                Chi tiết thông báo
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="kt-section mb-0">
                            <div class="form-group validated">
                                <label>Gửi lúc:</label>
                                <span
                                    class="kt-font-bolder">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$data['created_at'])->format('H:i:s d/m/Y')}}</span>
                            </div>
                            <div class="form-group validated">
                                <label>Tiêu đề:</label>
                                <span class="kt-font-bolder">{{$data['title']}}</span>
                            </div>
                            @if($data['image'])
                                <div class="form-group validated">
                                    <label>Hình ảnh</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <img src="{{ $data['image'] }}" class="img-fluid img-thumbnail" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group validated">
                                <label>Nội dung:</label>
                                <span class="kt-font-bolder">{{$data['content']}}</span>
                            </div>
                            <div class="form-group validated form-group-last">
                                <label class="d-block">Gửi tới:</label>
                                @foreach($data['notification_uid'] as $user)
                                    <span
                                        class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill kt-badge--rounded mt-2">{{ $user['uid']['name'] }}</span>
                                @endforeach
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

