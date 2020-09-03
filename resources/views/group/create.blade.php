@extends('layouts.app',['page' => 'group.create','text' => 'Thêm nhóm'])
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
                                Thêm nhóm
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="POST"
                          action="{{ route('admin.group.store') }}">
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section mb-0">
                                <div class="form-group validated">
                                    <label>Tên nhóm:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group validated">
                                    <label>Mô tả:</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5"
                                              name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group form-group-last validated">
                                    <label>Quyền:</label>
                                    @if(session()->has('errors') && !empty(session('errors')->first('error')))
                                        <div class="alert alert-solid-danger alert-bold mb-2" role="alert">
                                            <div class="alert-text">{{session('errors')->first('error') }}</div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        @foreach($roles as $role)
                                            <div class="col-3">
                                                <label class="kt-checkbox">
                                                    <input name="roles[]" value="{{ $role['id'] }}"
                                                           type="checkbox"> {{ $role['note'] }}
                                                    ( {{ $role['name'] }} )
                                                    <span></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Thêm
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
