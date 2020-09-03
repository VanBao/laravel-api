@extends('layouts.app',['page' => 'notification','text' => 'Danh sách thông báo'])
@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 width="24px" height="24px" viewBox="0 0 24 24"
                                                 version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
													<path
                                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                        fill="#000000" opacity="0.3"/>
												</g>
											</svg>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Danh sách thông báo
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <button
                                data-toggle="modal" data-target="#kt_modal_4"
                                class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-bell"></i>
                                Gửi thông báo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Gửi lúc</th>
                        <th width="10%" class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $index => $notification)
                        <tr>
                            <td>{{ $notification['id'] }}</td>
                            <td>{{ ++$index }}</td>
                            <td>{{ $notification['title'] }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$notification['created_at'])->format('H:i:s d/m/Y') }}</td>
                            <td class="text-center">
                                <a title="Edit details"
                                   href="{{ route('admin.notification.detail',['id' => $notification['id']]) }}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md"> <i
                                        class="la la-search"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gửi thông báo</h5>
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
                        <div class="form-group form-send-to">
                            <label for="message-text" class="form-control-label">Gửi đến:</label>
                            <button type="button" class="btn btn-primary d-block mb-3 btn-sm" id="select_all">Gửi tất
                                cả
                            </button>
                            <select class="form-control kt-select2" id="kt_select2_3" name="send-to"
                                    multiple="multiple">
                                @foreach($users as $user)
                                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="send-notification">Gửi thông báo</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection

@section('scripts')
    <script>
        var PAGE_LENGTH = 50;
    </script>
    <script src="{{ asset('assets/js/pages/custom/user/edit-user.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script>
        $('#kt_select2_3').select2({
            placeholder: "Chọn người gửi thông báo",
        });

        $(document).ready(function () {
            $('#select_all').click(function () {
                // $('#kt_select2_3 option').prop('selected', true);
                $('#kt_select2_3').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            });

            $("#send-notification").click(function () {
                var title = $("input[name=title]").val();
                var content = $("textarea[name=content]").val();
                var sendIds = $("#kt_select2_3").val();

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
                                            image: data
                                        },
                                        beforeSend: function() {
                                            KTApp.block('#kt_modal_4 .modal-body', {});

                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (response) {
                                            console.log('response', response);
                                            if (response) {
                                                KTApp.unblock('#kt_modal_4 .modal-body');
                                                $('#kt_modal_4').modal('hide');
                                                swal.fire("Thành công !", "Gửi thông báo thành công !", "success").then(function () {
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
                                send_id: sendIds
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend:function() {
                                KTApp.block('#kt_modal_4 .modal-body', {});
                            },
                            success: function (response) {
                                console.log('response', response);
                                if (response) {
                                    KTApp.unblock('#kt_modal_4 .modal-body');
                                    $('#kt_modal_4').modal('hide');
                                    swal.fire("Thành công !", "Gửi thông báo thành công !", "success").then(function () {
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
                } else {
                    toastr.warning('Lỗi !', 'Hãy nhập đầy đủ thông tin !');
                }

            });
        });
    </script>

@endsection
