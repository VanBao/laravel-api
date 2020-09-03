@extends('layouts.app',['page' => 'request-support.detail','text' => 'Chi tiết hỗ trợ'])
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/lightbox/css/lightbox.css') }}">
@endsection
@section('header-action')
    <label class="mr-2">Trạng thái :</label>
    @if($data['status'] == 'create')
        <span class="text-warning">Chưa trả lời</span>
    @elseif($data['status'] == 'answer')
        <span class="text-success">Đã trả lời</span>
    @elseif($data['status'] == 'read')
        <span class="text-success">Đã xem</span>
    @endif
    @if($data['status'] == 'create' || $data['status'] == 'read')
        <button data-toggle="modal" class="btn btn-sm btn-success ml-3" data-target="#kt_modal_4">Trả lời</button>
    @endif
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
                                Chi tiết hỗ trợ
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <div class="kt-section mb-0">
                            <div class="form-group validated">
                                <label>Tên:</label>
                                <a href="{{ route('admin.user.edit',['id' => $data['user']['id']]) }}"
                                   class="kt-font-bolder">{{ $data['user']['name'] }}</a>
                            </div>
                            <div class="form-group validated">
                                <label>Email:</label>
                                <span class="kt-font-bolder">{{$data['email']}}</span>
                            </div>
                            <div class="form-group validated">
                                <label>Số điện thoại:</label>
                                <span class="kt-font-bolder">{{$data['phone']}}</span>
                            </div>
                            <div class="form-group validated">
                                <label>Địa chỉ:</label>
                                <span class="kt-font-bolder">{{$data['address']}}</span>
                            </div>
                            <div class="form-group form-group-last">
                                <label>Nội dung:</label>
                                @if($data['content'])
                                    <span class="kt-font-bolder">{!! nl2br(htmlspecialchars($data['content'])) !!}</span>
                                @else
                                    <em>Không có nội dung</em>
                                @endif
                            </div>
                            {{--                            <div class="form-group form-group-last">--}}
                            {{--                                <label>Hình ảnh:</label>--}}
                            {{--                                @php--}}
                            {{--                                    $attached_files = json_decode($data['attached_files'], true);--}}
                            {{--                                @endphp--}}
                            {{--                                @if($attached_files)--}}
                            {{--                                    <div class="row">--}}
                            {{--                                        @foreach($attached_files as $index => $attach_file)--}}
                            {{--                                            <div class="col-3">--}}
                            {{--                                                <a href="{{ $attach_file }}" data-lightbox="attached-files">--}}
                            {{--                                                    <img src="{{ $attach_file }}" class="img-fluid img-thumbnail">--}}
                            {{--                                                </a>--}}
                            {{--                                            </div>--}}
                            {{--                                        @endforeach--}}
                            {{--                                    </div>--}}
                            {{--                                @else--}}
                            {{--                                    <em>Không có hình ảnh</em>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
        <!--End::Row-->

    </div>
    @if($data['status'] == 'create' || $data['status'] == 'read')
        <!--begin::Modal-->
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Gửi thông báo trả lời</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="form-control-label d-block">Hình ảnh:</label>
                                <div class="kt-avatar kt-avatar--outline kt-avatar--circle-"
                                     id="kt_user_edit_avatar">
                                    <div class="kt-avatar__holder"
                                         style=""></div>
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip"
                                           title=""
                                           data-original-title="Change avatar">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="image"
                                               accept=".png, .jpg, .jpeg">
                                    </label>
                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip"
                                          title=""
                                          data-original-title="Cancel avatar">
																				<i class="fa fa-times"></i>
																			</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Tiêu đề:</label>
                                <input type="text" name="title" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="form-control-label">Nội dung:</label>
                                <textarea class="form-control" name="content" rows="5" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="send-notification">Gửi thông báo trả lời</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/custom/user/edit-user.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightbox/js/lightbox.js') }}"></script>
    <script>
        $(document).ready(function () {

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            $("#send-notification").click(function () {
                var title = $("input[name=title]").val();
                var content = $("textarea[name=content]").val();
                var sendIds = [{{ $data['user']['id'] }}]

                if (title && content && sendIds.length > 0) {
                    var file = $('input[name=image]').val();
                    if (file) {
                        var data = new FormData();
                        data.append('image', $('input[name=image]')[0].files[0]);
                        $.ajax({
                            url: '{{ route('admin.notification.upload-image') }}',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            success: function (data) {
                                if (data) {
                                    $.ajax({
                                        url: '{{ route('admin.notification.send') }}',
                                        type: 'POST',
                                        data: {
                                            title: title,
                                            content: content,
                                            send_id: sendIds,
                                            private_id: {{ $data['id'] }},
                                            image: data
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (response) {
                                            console.log('response', response);
                                            if (response) {
                                                $('#kt_modal_4').modal('hide');
                                                swal.fire("Thành công !", "Trả lời hỗ trợ thành công !", "success").then(function () {
                                                    window.location.reload();
                                                });
                                            }
                                        },
                                        error: function (errors) {
                                            console.log(errors);
                                            errors = errors.responseJSON.errors;
                                            for (let error in errors) {
                                                toastr.error('Lỗi !', errors[error][0]);
                                            }
                                        }
                                    });
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ route('admin.notification.send') }}',
                            type: 'POST',
                            data: {
                                title: title,
                                content: content,
                                send_id: sendIds,
                                private_id: {{ $data['id'] }}
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                console.log('response', response);
                                if (response) {
                                    $('#kt_modal_4').modal('hide');
                                    swal.fire("Thành công !", "Trả lời hỗ trợ thành công !", "success").then(function () {
                                        window.location.reload();
                                    });
                                }
                            },
                            error: function (errors) {
                                console.log(errors);
                                errors = errors.responseJSON.errors;
                                for (let error in errors) {
                                    toastr.error('Lỗi !', errors[error][0]);
                                }
                            }
                        })
                    };
                } else {
                    toastr.warning('Lỗi !', 'Hãy nhập đầy đủ thông tin !');
                }

            });

        });
    </script>
@endsection
