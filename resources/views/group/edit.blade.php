@extends('layouts.app',['page' => 'group.edit','text' => 'Sửa nhóm'])
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
                                Sửa nhóm: {{ $data['name'] }}
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST"
                          action="{{ route('admin.group.update',['id' => $data->id ]) }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            @if(session()->has('success'))
                                <div class="alert alert-solid-success alert-bold" role="alert">
                                    <div class="alert-text">{{ session()->get('success') }}</div>
                                </div>
                            @endif

                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên nhóm:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $data->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mô tả:</label>
                                    <textarea class="form-control" rows="5"
                                              name="description">{{ $data->description }}</textarea>
                                </div>
                                <div class="form-group form-group-last">
                                    <label>Quyền:</label>
                                    @if(session()->has('errors') && !empty(session('errors')->first('error')))
                                        <div class="alert alert-solid-danger alert-bold mb-2" role="alert">
                                            <div class="alert-text">{{session('errors')->first('error') }}</div>
                                        </div>
                                    @endif
                                    @if($data->type == 'super_admin' || $data->type == 'admin')
                                        <p class="m-0 text-muted">Nhóm này sở hữu đầy đủ quyền</p>
                                    @else
                                        <div class="row">
                                            @foreach($roles as $role)
                                                <div class="col-3">
                                                    <label class="kt-checkbox">
                                                        <input name="roles[]" value="{{ $role['id'] }}"
                                                               @if($data->roles()->where('id',$role['id'])->exists()) checked
                                                               @endif type="checkbox"> {{ $role['note'] }}
                                                        ( {{ $role['name'] }} )
                                                        <span></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-save"></i>
                                    Sửa
                                </button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>
        <!--End::Row-->

    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

        });

    </script>
@endsection
