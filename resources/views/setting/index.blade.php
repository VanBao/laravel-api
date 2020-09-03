@extends('layouts.app',['page' => 'setting','text' => 'Cấu hình hệ thống'])
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect opacity="0.200000003" x="0" y="0" width="24" height="24"/>
        <path
            d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z"
            fill="#000000" opacity="0.3"/>
        <path
            d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z"
            fill="#000000"/>
    </g>
</svg>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Cấu hình hệ thống
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" method="POST" action="{{ route('admin.setting.update') }}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Cần đăng nhập để vào hệ thống</label>
                        <div class="col-3">
														<span class="kt-switch kt-switch--icon">
															<label>
																<input type="checkbox" class="setting_switch"
                                                                       name="need_login"
                                                                       @if(setting('need_login') == 'on') checked @endif>
																<span></span>
															</label>
														</span>
                        </div>
                        <label class="col-3 col-form-label">Bảo trì</label>
                        <div class="col-3">
														<span class="kt-switch kt-switch--icon">
															<label>
																<input type="checkbox" class="setting_switch"
                                                                       name="is_maintenance"
                                                                       @if(setting('is_maintenance') == 'on') checked @endif>
																<span></span>
															</label>
														</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Hotline</label>
                        <div class="col-3">
                            <input type="text" name="phone" class="form-control" value="{{ setting('phone') }}">
                        </div>
                        <label class="col-3 col-form-label">Email</label>
                        <div class="col-3">
                            <input type="text" name="email" class="form-control" value="{{ setting('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Hướng dẫn chuyển khoản
                            <span class="text-muted d-block mt-2">
                            [booking_code]: Mã đơn hàng <br/>
                            [customer_name]: Tên khách hàng
                        </span>
                        </label>

                        <div class="col-9">
                            <textarea name="transfer_text" class="form-control"
                                      style="min-height: 150px;">{{ setting('transfer_text') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Nội dung bảo trì
                        </label>

                        <div class="col-9">
                            <textarea name="maintenance_text" class="form-control"
                                      style="min-height: 150px;">{{ setting('maintenance_text') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-last row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-elevate btn-success">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            /*$(".setting_switch").change(function () {
                var val = $(this).is(':checked');
                var name = $(this).attr('name');
                var status = val ? 'on' : 'off';
                $.ajax({
                    url: '{{ route('admin.setting.update') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    data: { code: name, value: status },
                    success: function (data) {
                        if (data) toastr.success('Cập nhật cài đặt hệ thống thành công !')
                        else toastr.error('Đã có lỗi xảy ra !');
                    },
                    error: function(err) {
                        toastr.error('Đã có lỗi xảy ra !',err.responseJSON.message);
                    }
                });
            });*/
        });
    </script>
@endsection
