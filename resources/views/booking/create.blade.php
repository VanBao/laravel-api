@extends('layouts.app',['page' => 'booking.create','text' => 'Tạo đơn hàng'])
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
                        Tạo đơn hàng
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" id="app">
                <div class="mb-3" v-cloak>
                    <button v-if="tab !== 'category'" v-on:click="backTo('category')" type="button"
                            class="btn btn-sm btn-label-brand btn-bold ">Quay lại chuyên mục
                    </button>
                    <button data-toggle="modal" data-target="#kt_modal_4" class="btn btn-sm btn-label-brand btn-bold"
                            type="button"><i class="la la-shopping-cart"></i><% quantity %>
                    </button>
                </div>

                <!-- CATEGORY -->
                <div v-if="tab === 'category'" v-cloak class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Lựa chọn chuyên mục
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget4_tab1_content">
                                <div class="kt-widget4" v-if="categories.length > 0">
                                    <div class="kt-widget4__item" v-for="category in categories">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img v-bind:src="category.avatar" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="javascript:void(0);" v-on:click="selectCategory(category.id)"
                                               class="kt-widget4__username">
                                                <% category.title %>
                                            </a>
                                        </div>
                                        <button v-on:click="selectCategory(category.id)" type="button"
                                                class="btn btn-sm btn-label-brand btn-bold">Chọn
                                        </button>
                                    </div>
                                </div>
                                <div v-else>
                                    <p class="m-0 text-center">Không có chuyên mục nào</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SERVICE -->
                <div v-if="tab === 'service'" v-cloak class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Lựa chọn dịch vụ
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget4_tab1_content">
                                <div class="kt-widget4" v-if="services.length > 0">
                                    <div class="kt-widget4__item" v-for="service in services">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img v-bind:src="service.avatar" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="javascript:void(0);" v-on:click="selectService(service.id)"
                                               class="kt-widget4__username">
                                                <% service.name %>
                                            </a>
                                        </div>
                                        <button v-on:click="selectService(service.id)" type="button"
                                                class="btn btn-sm btn-label-brand btn-bold">Chọn
                                        </button>
                                    </div>
                                </div>
                                <div v-else>
                                    <p class="m-0 text-center">Không có dịch vụ nào</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SERVICE PRICE -->
                <div v-if="tab === 'service_price'" v-cloak
                     class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Lựa chọn giá dịch vụ
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" v-on:click="service_prices_type = 'online'"
                                       data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">
                                        Online
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" v-on:click="service_prices_type = 'offline'" data-toggle="tab"
                                       href="#kt_widget4_tab2_content" role="tab">
                                        Tận nơi
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <div class="kt-prtlet__body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_widget4_tab1_content">
                                <div class="kt-widget4 p-4" v-if="service_prices.length > 0">
                                    <div class="kt-widget4__item" v-for="service_price in service_prices" >
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img v-bind:src="service_price.avatar" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                <% service_price.name %>
                                            </a>
                                            <p class="kt-widget4__text"
                                               v-if="service_price.price_online_type === 'price'">
                                                <% numberFormat(service_price.price_online) %> VNĐ
                                            </p>
                                            <p class="kt-widget4__text" v-else>
                                                Thoả thuận
                                            </p>
                                        </div>
                                        <button v-if="getQuantity(service_price.id,'online') > 0"
                                                v-on:click="decreaseServicePrice(service_price.id,'online')"
                                                type="button"
                                                class="btn btn-sm btn-label-brand btn-bold mr-3"><i
                                                class="la la-minus m-0"></i>
                                        </button>
                                        <button v-else
                                                type="button"
                                                class="btn btn-sm btn-label-brand btn-bold mr-3"><i
                                                class="la la-minus m-0"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-label-brand btn-bold mr-3">
                                            <input v-on:input="quantityChange(service_price.id,'online',$event)"
                                                   class="input-quantity"
                                                   v-bind:value="getQuantity(service_price.id,'online')">
                                        </button>

                                        <button v-on:click="addServicePrice(service_price.id,'online')" type="button"
                                                class="btn btn-sm btn-label-brand btn-bold"><i
                                                class="la la-plus m-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div v-else>
                                    <p class="m-0 text-center">Không có giá dịch vụ nào</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="kt_widget4_tab2_content">
                                <div class="kt-widget4 p-4" v-if="service_prices.length > 0">
                                    <div class="kt-widget4__item" v-for="service_price in service_prices" >
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <img v-bind:src="service_price.avatar" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__username">
                                                <% service_price.name %>
                                            </a>
                                            <p class="kt-widget4__text"
                                               v-if="service_price.price_offline_type === 'price'">
                                                <% numberFormat(service_price.price_offline) %> VNĐ
                                            </p>
                                            <p class="kt-widget4__text" v-else>
                                                Thoả thuận
                                            </p>
                                        </div>
                                        <button v-if="getQuantity(service_price.id,'offline') > 0"
                                                v-on:click="decreaseServicePrice(service_price.id,'offline')"
                                                type="button"
                                                class="btn btn-sm btn-label-brand btn-bold mr-3"><i
                                                class="la la-minus m-0"></i>
                                        </button>
                                        <button v-else
                                                type="button"
                                                class="btn btn-sm btn-label-brand btn-bold mr-3"><i
                                                class="la la-minus m-0"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-label-brand btn-bold mr-3">
                                            <input v-on:input="quantityChange(service_price.id,'offline',$event)"
                                                   class="input-quantity"
                                                   v-bind:value="getQuantity(service_price.id,'offline')">
                                        </button>
                                        <button v-on:click="addServicePrice(service_price.id,'offline')" type="button"
                                                class="btn btn-sm btn-label-brand btn-bold"><i
                                                class="la la-plus m-0"></i>
                                        </button>
                                    </div>
                                </div>
                                <div v-else>
                                    <p class="m-0 text-center">Không có giá dịch vụ nào</p>
                                </div>
                            </div>
                            <div v-if="(quantity > 0 && cart.length > 0)" class="text-right p-4 pt-0">
                                <button v-if="(quantity > 0 && cart.length > 0)"
                                        type="button"
                                        class="btn btn-elevate btn-bold btn-primary" data-toggle="modal" data-target="#kt_modal_4">Thanh toán
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin::Modal-->
                <div class="modal fade" v-cloak id="kt_modal_4" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" v-if="tabModalStep === 1">Giỏ hàng</h5>
                                <h5 class="modal-title" id="exampleModalLabel" v-else-if="tabModalStep === 2">Thông tin
                                    khách hàng</h5>
                                <h5 class="modal-title" id="exampleModalLabel" v-else-if="tabModalStep === 3">Thông tin
                                    đơn hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div v-if="tabModalStep === 1">
                                    <div class="kt-widget4" v-if="cart.length > 0">
                                        <div class="kt-widget4__item" v-for="(_cart,index) in cart">
                                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                                <img v-bind:src="getServicePrice(_cart.service_price_id)['avatar']"
                                                     alt="">
                                            </div>
                                            <div class="kt-widget4__info">
                                                <a href="#" class="kt-widget4__username">
                                                    <% getServicePrice(_cart.service_price_id)['name'] %> <span
                                                        style="font-weight: 400;margin-left: 5px;"
                                                        v-if="_cart.type === 'offline'">( tận nơi )</span>
                                                    <span style="font-weight: 400;margin-left: 5px;"
                                                          v-else>( online )</span>
                                                </a>
                                                <p class="kt-widget4__text"
                                                   v-if="getPriceType(_cart.service_price_id,_cart.type) === 'price'">
                                                    <%
                                                    numberFormat(getServicePrice(_cart.service_price_id)['price_online'])
                                                    %> x <% getQuantity(_cart.service_price_id,_cart.type) %> = <span
                                                        class="kt-font-bolder"><% numberFormat(getServicePrice(_cart.service_price_id)['price_online'] * getQuantity(_cart.service_price_id,_cart.type)) %> VNĐ</span>
                                                </p>
                                                <p class="kt-widget4__text" v-else>
                                                    Thoả thuận
                                                </p>
                                            </div>

                                            <button v-if="getQuantity(_cart.service_price_id,_cart.type) > 0"
                                                    v-on:click="decreaseServicePrice(_cart.service_price_id,_cart.type)"
                                                    type="button"
                                                    class="btn btn-sm btn-label-brand btn-bold mr-3"><i
                                                    class="la la-minus m-0"></i>
                                            </button>
                                            <button v-else
                                                    type="button"
                                                    class="btn btn-sm btn-label-brand btn-bold mr-3"><i
                                                    class="la la-minus m-0"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-label-brand btn-bold mr-3">
                                                <input
                                                    v-on:input="quantityChange(_cart.service_price_id,_cart.type,$event)"
                                                    class="input-quantity"
                                                    v-bind:value="getQuantity(_cart.service_price_id,_cart.type)">
                                            </button>

                                            <button v-on:click="addServicePrice(_cart.service_price_id,_cart.type)"
                                                    type="button"
                                                    class="btn btn-sm btn-label-brand btn-bold"><i
                                                    class="la la-plus m-0"></i>
                                            </button>

                                            <button v-on:click="removeServicePrice(index)"
                                                    type="button"
                                                    class="btn btn-sm btn-label-danger ml-3 btn-bold"><i
                                                    class="la la-trash m-0"></i>
                                            </button>
                                        </div>
                                        <div class="kt-widget4__item">
                                            <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            </div>
                                            <div class="kt-widget4__info align-items-end">
                                                <a href="#" class="kt-widget4__username">
                                                    Tổng tiền
                                                </a>
                                                <span class="kt-widget4__text kt-font-bolder">
                                                    <% numberFormat(total) %> VNĐ
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <p class="text-muted m-0 text-center">Không có sản phẩm !</p>
                                    </div>
                                </div>
                                <div v-else-if="tabModalStep === 2">
                                    <button class="mb-4 btn btn-sm btn-label-brand btn-bold"
                                            v-on:click="tabModalStep = 1">
                                        <i class="la la-arrow-left"></i>Quay lại
                                    </button>
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input type="text" class="form-control form-control-sm" v-model="customer_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control form-control-sm"
                                               v-model="customer_email">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control form-control-sm"
                                               v-model="customer_phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" v-model="customer_address"
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label>Tạo đơn hàng cho tài khoản</label>
                                        <select class="form-control" v-model="uid">
                                            <option value="0">Không chọn tài khoản</option>
                                            <option v-for="user in users" v-bind:value="user.id"><% user.name %>
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ghi chú</label>
                                        <textarea v-model="note" class="form-control form-control-sm"> </textarea>
                                    </div>
                                    <div class="form-group form-group-last text-right">
                                        <label>Tổng tiền</label>
                                        <span class="kt-widget4__text kt-font-bolder">
                                                    <% numberFormat(total) %> VNĐ
                                        </span>
                                    </div>
                                </div>
                                <div v-else-if="tabModalStep === 3">
                                    <p class="result-field"><span>Mã đơn hàng</span> <span class="kt-font-bolder">#<% result.booking_code %></span>
                                    </p>
                                    <p class="result-field"><span>Tên</span> <span class="kt-font-bolder"><% result.customer_name %></span>
                                    </p>
                                    <p class="result-field"><span>Địa chỉ</span> <span class="kt-font-bolder"><% result.customer_address %></span>
                                    </p>
                                    <p class="result-field"><span>Email</span> <span class="kt-font-bolder"><% result.customer_email %></span>
                                    </p>
                                    <p class="result-field"><span>Số điện thoại</span> <span class="kt-font-bolder"><% result.customer_phone %></span>
                                    </p>
                                    <p class="result-field"><span>Ghi chú</span> <span class="kt-font-bolder"><% result.note %></span>
                                    </p>
                                    <p class="result-field mb-0"><span>Tổng tiền</span> <span class="kt-font-bolder"><% numberFormat(result.total_price) %> VNĐ</span>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button v-if="tabModalStep === 1" type="button" class="btn btn-primary"
                                        v-on:click="nextStep()">Tiếp tục
                                </button>
                                <button v-if="tabModalStep === 2" type="button" class="btn btn-primary"
                                        v-on:click="createBooking()">
                                    Tạo đơn hàng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal-->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $("#kt_table_1").on('click', '.btn-show-booking-detail', function () {
            var id = $(this).data('id');
        });
        var app = new Vue({
            el: '#app',
            data: {
                categories: [],
                services: [],
                service_prices: [],
                service_prices_type: 'online',
                tab: 'category',
                cart: [],
                tabModalStep: 1,
                customer_name: "",
                customer_address: "",
                customer_email: "",
                customer_phone: "",
                time_from: "",
                time_to: "",
                note: "",
                service_id: 0,
                users: {!! $users !!},
                uid: 0,
                result: {}
            },
            delimiters: ['<%', '%>'],
            methods: {
                loadCategories: function () {
                    var vm = this;
                    axios.get('{{ route('admin.booking.load',['table' => 'category']) }}').then(function (response) {
                        console.log(response.data);
                        vm.categories = response.data;
                        KTApp.unblock('#app .kt-portlet__body');
                    });
                },
                createBooking: function () {
                    if (this.customer_name && this.customer_email && this.customer_phone && this.customer_address) {
                        const regex = RegExp(/^\d+$/);
                        if (regex.test(this.customer_phone)) {
                            var vm = this;
                            axios.post('{{ route('admin.booking.store') }}', {
                                time_to: "",
                                time_from: "2020-06-05",
                                images: [],
                                payment_method_id: 3,
                                booking_services: this.cart,
                                customer_name: this.customer_name,
                                customer_email: this.customer_email,
                                customer_phone: this.customer_phone,
                                customer_address: this.customer_address,
                                total_price: this.total,
                                total_item: this.quantity,
                                service_id: this.service_id,
                                uid: this.uid === 0 ? null : this.uid,
                                note: this.note
                            }).then(function (response) {
                                var data = response.data;
                                console.log('data', data);
                                if (data.status) {
                                    vm.cart = [];
                                    vm.result = data.data[0];
                                    vm.tabModalStep = 3;
                                    toastr.success("Thành công !", "Tạo đơn hàng thành công !");
                                    KTApp.unblock('#app .kt-portlet__body');
                                } else {
                                    if (response.data.code === 10) {
                                        for (error in response.data.data) {
                                            for (err of response.data.data[error]) {
                                                toastr.error(err, "Đã có lỗi xảy ra !", 10000);
                                            }
                                        }
                                    } else {
                                        toastr.error("Lỗi !", "Đã có lỗi xảy ra !");
                                    }
                                }
                            }).catch(function (errors) {
                                console.log('errors', errors);
                                toastr.error("Lỗi !", "Đã có lỗi xảy ra !");
                            });
                        } else {
                            alert('Số điện thoại không hợp lệ !');
                        }
                    } else {
                        alert('Hãy nhập đầy đủ thông tin người dùng !');
                    }
                },
                selectCategory: function (id) {
                    var vm = this;
                    axios.get('{{ route('admin.booking.load',['table' => 'category']) }}?id=' + id).then(function (response) {
                        vm.services = response.data;
                        vm.tab = 'service';
                        KTApp.unblock('#app .kt-portlet__body');

                    });
                },
                selectService: function (id) {
                    var vm = this;
                    axios.get('{{ route('admin.booking.load',['table' => 'service']) }}?id=' + id).then(function (response) {
                        console.log('sss', response.data);
                        vm.service_prices = response.data;
                        vm.service_id = id;
                        vm.tab = 'service_price';
                        KTApp.unblock('#app .kt-portlet__body');

                    });
                },
                getServicePrice: function (id) {
                    return this.service_prices.filter(function (value) {
                        return value.id === id;
                    })[0];
                },
                removeServicePrice: function (index) {
                    this.cart = this.cart.filter(function (value, key) {
                        return key !== index;
                    });
                },
                quantityChange: function (id, type, event) {
                    if (Number.isInteger(+event.target.value)) {
                        var quantity = +event.target.value;
                        // console.log(quantity);

                        var instance = this.cart.filter(function (value) {
                            return value.service_price_id === id && value.type === type;
                        });
                        if (instance.length === 0) {
                            var _cart = this.service_prices.filter(function (value) {
                                return value.id === id;
                            })[0];

                            var price = (type === 'online') ? _cart.price_online : _cart.price_offline;

                            var itemToAdd = {
                                quantity: 0,
                                price: price,
                                type: type,
                                service_price_id: _cart.id
                            };

                            this.cart.push(itemToAdd);

                            // this.cart.push();
                        }

                        this.cart = this.cart.map(function (value) {
                            if (value.service_price_id === id && value.type === type) {
                                value.quantity = quantity;
                            }
                            return value;
                        });
                    }
                },
                nextStep: function () {
                    if (this.cart.length > 0) {
                        if (this.quantity === 0) {
                            alert('Số lượng sản phẩm ít nhất bằng 1');
                        } else {
                            this.tabModalStep = 2;
                        }

                    } else {
                        alert("Chưa có sản phẩm nào cả");
                    }
                },
                backTo: function (tab) {
                    if (tab === 'category') {
                        if (confirm('Sản phẩm trong giỏ hàng sẽ bị xoá, bạn có chắc ?')) {
                            this.cart = [];
                            this.service_id = 0;
                            this.tabModalStep = 1;
                        } else {
                            return;
                        }
                    }
                    this.tab = tab;
                },
                addServicePrice: function (id, type) {
                    console.log(this.cart);
                    var instance = this.cart.filter(function (value) {
                        return value.service_price_id === id && value.type === type;
                    });
                    if (instance.length === 0) {
                        var _cart = this.service_prices.filter(function (value) {
                            return value.id === id;
                        })[0];

                        var price = (type === 'online') ? _cart.price_online : _cart.price_offline;

                        var itemToAdd = {
                            quantity: 1,
                            price: price,
                            type: type,
                            service_price_id: _cart.id
                        };

                        this.cart.push(itemToAdd);

                        // this.cart.push();
                    } else if (instance.length === 1) {
                        this.cart = this.cart.map(function (value) {
                            if (value.service_price_id === id && value.type === type) {
                                value.quantity = value.quantity + 1;
                            }
                            return value;
                        });
                    }
                },
                getPriceType: function (id, type) {
                    var service_price = this.getServicePrice(id);
                    return service_price['price_' + type + '_type'];
                },
                numberFormat: function (number) {
                    return String(number).replace(/(.)(?=(\d{3})+$)/g, '$1,');
                },
                getQuantity: function (id, type) {
                    var quantity = 0;
                    var cart = this.cart.filter(function (value) {
                        return value.service_price_id === id && value.type === type;
                    });
                    // console.log('cart2',cart);
                    quantity = cart.length !== 0 ? cart[0].quantity : 0;
                    return quantity;
                },
                decreaseServicePrice: function (id, type) {
                    var instance = this.cart.filter(function (value) {
                        return value.service_price_id === id && value.type === type;
                    });

                    if (instance.length === 1) {
                        this.cart = this.cart.map(function (value) {
                            if (value.service_price_id === id && value.type === type) {
                                value.quantity = value.quantity - 1;
                            }
                            return value;
                        });
                    }
                }
            },
            computed: {
                quantity: function () {
                    var quantity = 0;
                    this.cart.forEach(function (value) {
                        quantity += value.quantity;
                    });
                    return quantity;
                },
                total: function () {
                    var total = 0;
                    this.cart.map(function (value) {
                        total += +value.quantity * +value.price;
                    });
                    return total;
                }
            },
            mounted: function () {
                this.loadCategories();
            },
            created() {
                axios.interceptors.request.use((config) => {
                    KTApp.block('#app .kt-portlet__body', {});
                    return config;
                }, (error) => {
                    KTApp.unblock('#app .kt-portlet__body');
                    return Promise.reject(error);
                });
            }
        })
    </script>
@endsection
