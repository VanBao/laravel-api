<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            // Dashhboard
            [
                'name' => 'dashboard',
                'note' => 'Xem thống kê',
                'created_at' => now()
            ],
            [
                'name' => 'dashboard-chart',
                'note' => 'Xem thống kê qua biểu đồ',
                'created_at' => now()
            ],
            // Request Support
            [
                'name' => 'request-support',
                'note' => 'Xem danh sách hỗ trợ từ khách hàng',
                'created_at' => now()
            ],
            [
                'name' => 'request-support-detail',
                'note' => 'Xem chi tiết hỗ trợ khách hàng',
                'created_at' => now()
            ],
            [
                'name' => 'request-support-answer',
                'note' => 'Trả lời hỗ trợ khách hàng',
                'created_at' => now()
            ],
            // Page
            [
                'name' => 'page',
                'note' => 'Xem trang',
                'created_at' => now()
            ],
            [
                'name' => 'page-create',
                'note' => 'Hiển thị form tạo trang',
                'created_at' => now()
            ],
            [
                'name' => 'page-store',
                'note' => 'Tạo trang',
                'created_at' => now()
            ],
            [
                'name' => 'page-edit',
                'note' => 'Hiển thị form chỉnh sửa trang',
                'created_at' => now()
            ],
            [
                'name' => 'page-update',
                'note' => 'Cập nhật chỉnh sửa trang',
                'created_at' => now()
            ],
            // Notification
            [
                'name' => 'notification',
                'note' => 'Xem danh sách thông báo đã gửi',
                'created_at' => now()
            ],
            [
                'name' => 'notification-send',
                'note' => 'Gửi thông báo',
                'created_at' => now()
            ],
            [
                'name' => 'notification-upload-image',
                'note' => 'Upload ảnh gửi thông báo',
                'created_at' => now()
            ],
            // Upload ảnh
            [
                'name' => 'upload',
                'note' => 'Upload ảnh',
                'created_at' => now()
            ],
            // Category
            [
                'name' => 'category',
                'note' => 'Xem danh sách chuyên mục',
                'created_at' => now()
            ],
            [
                'name' => 'category-create',
                'note' => 'Show form tạo chuyên mục',
                'created_at' => now()
            ],
            [
                'name' => 'category-edit',
                'note' => 'Show form chỉnh sửa chuyên mục',
                'created_at' => now()
            ],
            [
                'name' => 'category-store',
                'note' => 'Tạo chuyên mục',
                'created_at' => now()
            ],
            [
                'name' => 'category-update',
                'note' => 'Sửa chuyên mục',
                'created_at' => now()
            ],
            [
                'name' => 'category-delete',
                'note' => 'Xóa chuyên mục',
                'created_at' => now()
            ],
            // Booking
            [
                'name' => 'booking',
                'note' => 'Xem danh sách đơn hàng',
                'created_at' => now()
            ],
            [
                'name' => 'booking-detail',
                'note' => 'Chi tiết đơn hàng',
                'created_at' => now()
            ],
            [
                'name' => 'booking-assign',
                'note' => 'Giao việc',
                'created_at' => now()
            ],
            [
                'name' => 'booking-reject',
                'note' => 'Từ chối đơn hàng',
                'created_at' => now()
            ],
            [
                'name' => 'booking-update-deal-price',
                'note' => 'Cập nhật giá thỏa thuận của đơn hàng',
                'created_at' => now()
            ],
            // Service
            [
                'name' => 'service',
                'note' => 'Xem danh sách dịch vụ',
                'created_at' => now()
            ],
            [
                'name' => 'service-create',
                'note' => 'Show form tạo dịch vụ',
                'created_at' => now()
            ],
            [
                'name' => 'service-edit',
                'note' => 'Show form sửa dich vụ',
                'created_at' => now()
            ],
            [
                'name' => 'service-store',
                'note' => 'Tạo dịch vụ',
                'created_at' => now()
            ],
            [
                'name' => 'service-update',
                'note' => 'Chỉnh sửa dịch vụ',
                'created_at' => now()
            ],
            [
                'name' => 'service-delete',
                'note' => 'Xóa dịch vụ',
                'created_at' => now()
            ],
            // Group
            [
                'name' => 'group',
                'note' => 'Xem danh sách nhóm',
                'created_at' => now()
            ],
            [
                'name' => 'group-create',
                'note' => 'Show form tạo nhóm',
                'created_at' => now()
            ],
            [
                'name' => 'group-edit',
                'note' => 'Show form sửa nhóm',
                'created_at' => now()
            ],
            [
                'name' => 'group-store',
                'note' => 'Tạo nhóm',
                'created_at' => now()
            ],
            [
                'name' => 'group-update',
                'note' => 'Chỉnh sửa nhóm',
                'created_at' => now()
            ],
            // User
            [
                'name' => 'user',
                'note' => 'Xem danh sách tài khoản',
                'created_at' => now()
            ],
            [
                'name' => 'user-create',
                'note' => 'Show form tạo tài khoản',
                'created_at' => now()
            ],
            [
                'name' => 'user-edit',
                'note' => 'Show form sửa tài khoản',
                'created_at' => now()
            ],
            [
                'name' => 'user-store',
                'note' => 'Tạo tài khoản',
                'created_at' => now()
            ],
            [
                'name' => 'user-update',
                'note' => 'Chỉnh sửa tài khoản',
                'created_at' => now()
            ],
            [
                'name' => 'user-profile',
                'note' => 'Xem thông tin tài khoản của mình',
                'created_at' => now()
            ],
            [
                'name' => 'user-update-profile',
                'note' => 'Cập nhật thông tin tài khoản của mình',
                'created_at' => now()
            ],
            [
                'name' => 'user-change-password',
                'note' => 'Thay đổi mật khẩu',
                'created_at' => now()
            ],
            // Role
            [
                'name' => 'rule',
                'note' => 'Xem danh sách luật',
                'created_at' => now()
            ],
            [
                'name' => 'rule-create',
                'note' => 'Show form tạo luật',
                'created_at' => now()
            ],
            [
                'name' => 'rule-edit',
                'note' => 'Show form sửa luật',
                'created_at' => now()
            ],
            [
                'name' => 'rule-store',
                'note' => 'Tạo luật',
                'created_at' => now()
            ],
            [
                'name' => 'rule-update',
                'note' => 'Chỉnh sửa luật',
                'created_at' => now()
            ],
            [
                'name' => 'rule-delete',
                'note' => 'Xóa luật',
                'created_at' => now()
            ],
            // Staff
            [
                'name' => 'staff',
                'note' => 'Trang quản trị của kỹ thuật viên',
                'created_at' => now()
            ],
            [
                'name' => 'staff-detail',
                'note' => 'Xem chi tiết booking của kỹ thuật viên đó',
                'created_at' => now()
            ],
            [
                'name' => 'staff-update',
                'note' => 'Cập nhật trạng thái booking của kỹ thuật viên đó',
                'created_at' => now()
            ],
            [
                'name' => 'staff-load-messages',
                'note' => 'Xem tin nhắn',
                'created_at' => now()
            ],
            [
                'name' => 'staff-send-message',
                'note' => 'Gửi tin nhắn',
                'created_at' => now()
            ],
            [
                'name' => 'staff-upload-image',
                'note' => 'Gửi hình ảnh',
                'created_at' => now()
            ],
            // Setting
            [
                'name' => 'setting',
                'note' => 'Xem cài đặt của hệ thống',
                'created_at' => now()
            ],
            [
                'name' => 'setting',
                'note' => 'Cập nhật cài đặt của hệ thống',
                'created_at' => now()
            ],
        ]);
    }
}
