-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 08, 2020 lúc 12:58 AM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `netvas`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double(20,2) NOT NULL,
  `total_item` int(11) NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `booking_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` bigint(20) UNSIGNED DEFAULT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` double(20,2) DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_from` datetime NOT NULL,
  `time_to` datetime DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `is_rated` tinyint(4) NOT NULL DEFAULT 0,
  `costs_incurred` double(20,2) NOT NULL DEFAULT 0.00,
  `city_id` int(11) DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`id`, `booking_code`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `note`, `total_price`, `total_item`, `payment_method_id`, `booking_status`, `uid`, `staff_id`, `discount_code`, `discount_price`, `images`, `time_from`, `time_to`, `service_id`, `is_rated`, `costs_incurred`, `city_id`, `admin_note`, `created_at`, `updated_at`) VALUES
(11, 'XHQPPC', 'Vu Linh', 'vlinh12300@gmail.com', '0902411129', '08 Hoa Hong test', NULL, 180000.00, 1, 3, 'create', 2, NULL, '', 0.00, NULL, '2020-06-30 00:10:19', NULL, 31, 0, 0.00, 7, NULL, '2020-07-01 08:43:07', '2020-07-07 17:10:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_activity`
--

CREATE TABLE `booking_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `column` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_rating`
--

CREATE TABLE `booking_rating` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_service`
--

CREATE TABLE `booking_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_price_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(20,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_service`
--

INSERT INTO `booking_service` (`id`, `service_price_id`, `booking_id`, `type`, `quantity`, `price`, `created_at`) VALUES
(11, 154, 11, 'online', 1, 180000.00, '2020-07-01 08:43:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `updated_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `status`, `description`, `summary`, `avatar`, `icon`, `background`, `images`, `created_id`, `updated_id`, `created_at`, `updated_at`) VALUES
(1, 'Hỗ trợ máy tính', 1, 'Cá nhân', '- Kiểm tra, anti-virus, trạng thái PC-Workstation.(CPU, RAM, HDDs) Cài đặt lại hệ điều hành, ứng dụng theo yêu cầu. Monitor cảnh báo hư phần cứng, fix lỗi phần mềm trên máy tính.\r\nBảo trì / sửa chữa thiết\r\n- Quá trình xác định lỗi, NetVAS chủ động đề xuất và liên hệ nhà cung cấp phần cứng hoặc phần mềm, chi phí thỏa thuận với đơn vị thứ 3.\r\n- Hỗ trợ tại chỗ / xử lý từ xa\r\n- Toàn bộ các lỗi sẽ được hỗ trợ từ xa, trường hợp không thể xử lý từ xa – NetVAS sẽ Onsite tại Khách hàng. Không giới hạn số lần hỗ trợ từ xa và onsite.\r\n- Cam kết bảo mật thông tin\r\n- NetVAS cam kết bảo mật hệ thống, dữ liệu của khách hàng tuyệt đối.', '1592368313_Ellipse7.png', '1592368313_Group10793.png', NULL, NULL, 1, 1, '2020-06-17 04:31:53', '2020-06-29 03:17:47'),
(2, 'Dịch vụ IT định kỳ', 1, 'Doanh nghiệp', 'Dịch vụ bảo trì máy tính cho doanh nghiệp trọn gói.\r\n1. Dịch vụ bảo trì máy tính văn phòng TP HCM\r\n2. Dịch vụ quản trị hệ thống mạng tại Doanh Nghiệp\r\n3. Dịch vụ quản trị server (máy chủ) tại doanh nghiệp\r\n4. Quản trị camera, máy in, fax, photo, máy chấm công….', '1592368800_Ellipse8.png', '1592368800_Group10794.png', NULL, NULL, 1, 1, '2020-06-17 04:40:00', '2020-06-29 03:14:30'),
(3, 'Hệ thống mạng', 1, 'Doanh nghiệp', 'Dịch vụ bảo trì hệ thống mạng – Maintenance Services.\r\n- Tư vấn triển khai hà tầng mạng Internet.\r\n- Khắc phục sự cố mạng\r\n- Cho thuê thiết bị mạng\r\n- Nhận bảo trì hệ thống mạng trọn gói', '1592368849_Ellipse9.png', '1592368849_Path11551.png', NULL, NULL, 1, 1, '2020-06-17 04:40:49', '2020-06-29 03:20:51'),
(4, 'Quản trị máy chủ', 1, 'Doanh nghiệp', 'Mô tả chi tiết công việc\r\nDịch vụ quản trị máy chủ là hình thức cung cấp dịch vụ quản lý kỹ thuật thực hiện tất cả các thao tác quản trị thuộc trách nhiệm của bộ phận tương đương vị trí Quản trị hệ thống của khách hàng. Khi thuê dịch vụ quản trị máy chủ, khách hàng sẽ được cài đặt, cấu hình, tối ưu, theo dõi và xử lý các vấn đề kỹ thuật và lỗi phát sinh trên máy chủ nhằm đảm bảo máy chủ hoạt động trong trạng thái ổn định và hiệu suất cao nhất.\r\n\r\nQuản trị máy chủ gồm:\r\n– Cài đặt mới hoặc cài lại hệ điều hành miễn phí (nhưng tối đa không quá 3 lần/tháng).\r\n– Cài đặt các phần mềm bản quyền do NETVAS cung cấp khi khách thuê kèm miễn phí.\r\n– Cài đặt tường lửa cơ bản.\r\n– Backup và chuyển dữ liệu từ nhà cung cấp cũ.\r\n– Cập nhật các phiên bản ứng dụng mới nhất cho hệ thống.\r\n– Cài đặt server giúp ngăn chặn, hạn chế tấn công và lỗi bảo mật phổ biến.\r\n– Cài đặt backup dữ liệu cho server.\r\n– Cài đặt các ứng dụng bổ sung giúp tăng tốc độ, tăng mức tải của hệ thống.\r\n– Tối ưu hóa hệ thống (Apache, MySQL, mod_security,…)\r\n– Theo dõi hoạt động của hệ thống, kiểm tra định kỳ.\r\nVà thực hiện các công việc quản trị theo từng yêu cầu riêng của khách hàng.\r\n\r\nTẠI SAO KHÁCH HÀNG CHỌN CTY NETVAS?\r\n– Có kiến thức chuyên môn về CNTT, internet, thiết bị văn phòng (máy tính, máy in, máy scan, máy photocopy,…)\r\n– Nhiệt tình, lịch sự, biết lắng nghe, chịu khó.\r\n– Nhân sự linh hoạt\r\n– Trung thực, có trách nhiệm trong công việc.\r\n– Lưu trữ hồ sơ, công văn, tài liệu, giấy tờ theo chức năng và công việc đảm nhiệm.\r\n– Bảo mật thông tin, tài liệu, bí mật kinh doanh của Khách hàng.', '1592368918_Ellipse10.png', '1592368918_Group10795.png', NULL, NULL, 1, 1, '2020-06-17 04:41:58', '2020-06-29 03:23:01'),
(5, 'Dịch vụ cho thuê', 1, 'Server, máy tính', 'Bảng giá dịch vụ Máy Chủ Riêng\r\nTham khảo báo giá tại NetVAS\r\nNetVAS cung cấp dịch vụ cho thuê máy chủ riêng như:\r\n– Dell R620, Dell R630, Dell R730, Dell R640, Dell R740…\r\n– HP G8, G9, G10', '1592368965_Ellipse11.png', '1592368965_Group10796.png', NULL, NULL, 1, 1, '2020-06-17 04:42:45', '2020-07-01 08:50:18'),
(6, 'Dịch vụ IT', 0, 'Doanh Nghiệp', 'Dịch vụ bảo trì máy tính cho doanh nghiệp trọn gói.\r\n1. Dịch vụ bảo trì máy tính văn phòng TP HCM\r\n2. Dịch vụ quản trị hệ thống mạng tại Doanh Nghiệp\r\n3. Dịch vụ quản trị server (máy chủ) tại doanh nghiệp\r\n4. Quản trị camera, máy in, fax, photo, máy chấm công', '1592368997_ITDoanhnghiep.png', '1592368997_ITDoanhnghiep.png', NULL, NULL, 1, NULL, '2020-06-17 04:43:17', '2020-06-29 03:15:35'),
(7, 'Cloud Computing', 1, 'Web, Email, Backup', NULL, '1592369017_Ellipse12.png', '1592369017_Path11552.png', NULL, NULL, 1, 1, '2020-06-17 04:43:37', '2020-07-01 08:48:34'),
(8, 'Tư vấn giải pháp', 1, 'Mạng, Server, Máy tính', NULL, '1592369059_Ellipse14.png', '1592369059_Group10797.png', NULL, NULL, 1, 1, '2020-06-17 04:44:19', '2020-06-29 03:33:39'),
(9, 'Shop thiết bị', 1, 'Mua bán thiết bị', NULL, '1592369121_Ellipse13.png', '1592369121_Group10798.png', NULL, NULL, 1, 1, '2020-06-17 04:45:21', '2020-06-29 03:42:14'),
(10, 'test', 0, 'test', 'test', '1593070023_1591409180_Group10497.png', '1593070023_1591409180_Group10497.png', NULL, NULL, 1, NULL, '2020-06-25 07:27:03', '2020-06-25 07:27:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `city`
--

INSERT INTO `city` (`id`, `name`, `location`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Thành phố Hà Nội', '21.0277644-105.8341598', NULL, 'Thành phố Trung ương', '2020-07-07 07:42:05', '2020-07-07 07:42:05'),
(2, 'Tỉnh Hà Giang', '22.7662056-104.9388853', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(3, 'Tỉnh Cao Bằng', '22.635689-106.2522143', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(4, 'Tỉnh Bắc Kạn', '22.3032923-105.876004', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(5, 'Tỉnh Tuyên Quang', '22.1726708-105.3131185', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(6, 'Tỉnh Lào Cai', '22.3380865-104.1487055', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(7, 'Tỉnh Điện Biên', '21.8042309-103.1076525', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(8, 'Tỉnh Lai Châu', '22.3686613-103.3119085', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(9, 'Tỉnh Sơn La', '21.1022284-103.7289167', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(10, 'Tỉnh Yên Bái', '21.6837923-104.4551361', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(11, 'Tỉnh Hoà Bình', '20.6861265-105.3131185', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(12, 'Tỉnh Thái Nguyên', '21.5613771-105.876004', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(13, 'Tỉnh Lạng Sơn', '21.8563705-106.6291304', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(14, 'Tỉnh Quảng Ninh', '21.006382-107.2925144', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(15, 'Tỉnh Bắc Giang', '21.3014947-106.6291304', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(16, 'Tỉnh Phú Thọ', '21.268443-105.2045573', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(17, 'Tỉnh Vĩnh Phúc', '21.3608805-105.5474373', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(18, 'Tỉnh Bắc Ninh', '21.121444-106.1110501', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(19, 'Tỉnh Hải Dương', '20.9385958-106.3206861', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(20, 'Thành phố Hải Phòng', '20.8449115-106.6880841', NULL, 'Thành phố Trung ương', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(21, 'Tỉnh Hưng Yên', '20.8525711-106.0169971', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(22, 'Tỉnh Thái Bình', '20.5386936-106.3934777', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(23, 'Tỉnh Hà Nam', '20.5835196-105.92299', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(24, 'Tỉnh Nam Định', '20.2791804-106.2051484', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(25, 'Tỉnh Ninh Bình', '20.2129969-105.92299', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(26, 'Tỉnh Thanh Hóa', '20.1291279-105.3131185', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(27, 'Tỉnh Nghệ An', '19.2342489-104.9200365', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(28, 'Tỉnh Hà Tĩnh', '18.2943776-105.6745247', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(29, 'Tỉnh Quảng Bình', '17.6102715-106.3487474', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(30, 'Tỉnh Quảng Trị', '16.7943472-106.963409', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(31, 'Tỉnh Thừa Thiên Huế', '16.467397-107.5905326', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(32, 'Thành phố Đà Nẵng', '16.0544068-108.2021667', NULL, 'Thành phố Trung ương', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(33, 'Tỉnh Quảng Nam', '15.5393538-108.019102', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(34, 'Tỉnh Quảng Ngãi', '15.0759838-108.7125791', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(35, 'Tỉnh Bình Định', '14.1665324-108.902683', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(36, 'Tỉnh Phú Yên', '13.0881861-109.0928764', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(37, 'Tỉnh Khánh Hòa', '12.2585098-109.0526076', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(38, 'Tỉnh Ninh Thuận', '11.6738767-108.8629572', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(39, 'Tỉnh Bình Thuận', '11.0903703-108.0720781', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(40, 'Tỉnh Kon Tum', '14.661167-107.83885', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(41, 'Tỉnh Gia Lai', '13.8078943-108.109375', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(42, 'Tỉnh Đắk Lắk', '12.7100116-108.2377519', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(43, 'Tỉnh Đắk Nông', '12.2646476-107.609806', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(44, 'Tỉnh Lâm Đồng', '11.5752791-108.1428669', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(45, 'Tỉnh Bình Phước', '11.7511894-106.7234639', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(46, 'Tỉnh Tây Ninh', '11.3494766-106.0640179', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(47, 'Tỉnh Bình Dương', '11.3254024-106.477017', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(48, 'Tỉnh Đồng Nai', '11.0686305-107.1675976', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(49, 'Tỉnh Bà Rịa - Vũng Tàu', '10.5417397-107.2429976', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(50, 'Thành phố Hồ Chí Minh', '10.8230989-106.6296638', NULL, 'Thành phố Trung ương', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(51, 'Tỉnh Long An', '10.695572-106.2431205', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(52, 'Tỉnh Tiền Giang', '10.4493324-106.3420504', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(53, 'Tỉnh Bến Tre', '10.1081553-106.4405872', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(54, 'Tỉnh Trà Vinh', '9.812741-106.2992912', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(55, 'Tỉnh Vĩnh Long', '10.0861281-106.0169971', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(56, 'Tỉnh Đồng Tháp', '10.4937989-105.6881788', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(57, 'Tỉnh An Giang', '10.5215836-105.1258955', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(58, 'Tỉnh Kiên Giang', '9.8249587-105.1258955', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(59, 'Thành phố Cần Thơ', '10.0451618-105.7468535', NULL, 'Thành phố Trung ương', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(60, 'Tỉnh Hậu Giang', '9.757898-105.6412527', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(61, 'Tỉnh Sóc Trăng', '9.6003688-105.9599539', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(62, 'Tỉnh Bạc Liêu', '9.2515555-105.5136472', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06'),
(63, 'Tỉnh Cà Mau', '8.9624099-105.1258955', NULL, 'Tỉnh', '2020-07-07 07:42:06', '2020-07-07 07:42:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super_admin', 'Super Admin', '2020-05-28 09:39:18', NULL),
(2, 'Admin', 'admin', 'Admin', '2020-05-28 09:39:18', NULL),
(3, 'Staff', 'staff', 'Staff', '2020-05-28 09:39:18', '2020-06-25 04:21:17'),
(4, 'User', 'user', 'User', '2020-05-28 09:39:18', NULL),
(5, 'tét', 'other', 'nhan vien', '2020-06-25 03:34:43', '2020-06-25 03:38:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_role`
--

CREATE TABLE `group_role` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_role`
--

INSERT INTO `group_role` (`group_id`, `role_id`) VALUES
(5, 1),
(5, 2),
(5, 5),
(5, 9),
(5, 14),
(5, 18),
(5, 22),
(5, 13),
(5, 17),
(5, 21),
(5, 25),
(5, 29),
(5, 37),
(5, 39),
(5, 41),
(5, 43),
(5, 45),
(5, 47),
(5, 49),
(5, 50),
(5, 51),
(5, 53),
(5, 57),
(5, 61),
(5, 65),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52),
(3, 38),
(3, 39),
(3, 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` bigint(20) UNSIGNED NOT NULL,
  `to` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `message`, `is_read`, `type`, `from_type`, `booking_id`, `created_at`, `updated_at`) VALUES
(12, 1, 2, 'asdasd', 0, 'text', 'staff', 11, '2020-07-01 08:45:06', '2020-07-01 08:45:06'),
(13, 2, NULL, 'fjfjfd', 1, 'text', 'user', 11, '2020-07-01 08:45:23', '2020-07-01 08:45:52'),
(14, 2, NULL, 'dhhdhhdd', 1, 'text', 'user', 11, '2020-07-01 08:45:39', '2020-07-01 08:45:52'),
(15, 2, NULL, 'dhehhd', 1, 'text', 'user', 11, '2020-07-01 08:45:40', '2020-07-01 08:45:52'),
(16, 2, NULL, 'thf', 1, 'text', 'user', 11, '2020-07-01 08:46:06', '2020-07-01 08:46:25'),
(17, 1, 2, 'asdasdasdasd', 0, 'text', 'staff', 11, '2020-07-01 08:46:40', '2020-07-01 08:46:40'),
(18, 2, NULL, 'sgjshs', 1, 'text', 'user', 11, '2020-07-01 08:52:35', '2020-07-01 08:53:23'),
(19, 2, NULL, 'dtffggg', 1, 'text', 'user', 11, '2020-07-01 08:52:58', '2020-07-01 08:53:23'),
(20, 2, NULL, 'gbsnsbsgg', 1, 'text', 'user', 11, '2020-07-01 08:53:12', '2020-07-01 08:53:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(303, '2014_10_12_000000_create_users_table', 1),
(304, '2014_10_12_100000_create_password_resets_table', 1),
(305, '2019_08_19_000000_create_failed_jobs_table', 1),
(306, '2020_05_14_090548_create_groups_table', 1),
(307, '2020_05_14_090839_create_categories_table', 1),
(308, '2020_05_14_091243_create_services_table', 1),
(309, '2020_05_14_091514_create_service_prices_table', 1),
(310, '2020_05_14_091915_create_pages_table', 1),
(311, '2020_05_14_092401_create_payment_methods_table', 1),
(312, '2020_05_14_092529_create_request_supports_table', 1),
(313, '2020_05_14_092754_create_request_support_activity_table', 1),
(314, '2020_05_14_092918_create_booking_rating_table', 1),
(315, '2020_05_14_093119_create_booking_table', 1),
(316, '2020_05_14_093740_create_booking_service_table', 1),
(317, '2020_05_14_093926_create_booking_activity_table', 1),
(318, '2020_05_14_094101_create_settings_table', 1),
(319, '2020_05_14_094300_create_user_setting_table', 1),
(320, '2020_05_14_094635_add_category_id_fr_to_services_table', 1),
(321, '2020_05_14_094943_add_service_id_fr_to_service_prices_table', 1),
(322, '2020_05_14_095201_add_request_id_fr_to_request_support_activity_table', 1),
(323, '2020_05_14_095354_add_payment_method_id_fr_to_booking_table', 1),
(324, '2020_05_14_095615_add_booking_id_fr_to_booking_rating_table', 1),
(325, '2020_05_14_095948_add_booking_id_and_service_id_fr_to_booking_service_table', 1),
(326, '2020_05_14_100312_add_booking_id_fr_to_booking_activity_table', 1),
(327, '2020_05_14_100501_add_setting_code_fr_to_user_setting_table', 1),
(328, '2020_05_15_015123_add_group_id_fr_to_users_table', 1),
(329, '2020_05_15_015354_add_created_id_and_updated_id_fr_to_categories_table', 1),
(330, '2020_05_15_015557_add_created_id_and_updated_id_fr_to_pages_table', 1),
(331, '2020_05_15_015845_add_uid_fr_to_request_supports_table', 1),
(332, '2020_05_15_022644_create_roles_table', 1),
(333, '2020_05_15_022746_create_group_role_table', 1),
(334, '2020_05_15_023054_add_group_id_and_role_id_fr_to_group_role_table', 1),
(335, '2020_05_15_135949_create_password_resets_code_table', 1),
(336, '2020_05_27_140304_create_messages_table', 1),
(337, '2020_05_27_141428_add_from_to_booking_id_fr_to_messages_table', 1),
(338, '2020_05_28_154453_add_service_id_fr_to_booking_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `image`, `title`, `content`, `created_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'test', 'test', 2, '2020-06-23 07:00:54', '2020-06-23 07:00:54'),
(2, NULL, 'Xin chào!', 'Cafe mà uống gì', 1, '2020-06-24 03:00:04', '2020-06-24 03:00:04'),
(3, NULL, 'FFrom admin', 'From Hỗ Trợ', 1, '2020-06-24 07:54:04', '2020-06-24 07:54:04'),
(4, NULL, 'tesst', 'test', 1, '2020-06-27 11:23:13', '2020-06-27 11:23:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification_uid`
--

CREATE TABLE `notification_uid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `notification_uid`
--

INSERT INTO `notification_uid` (`id`, `uid`, `notification_id`, `is_read`) VALUES
(1, 5, 1, 0),
(2, 8, 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `updated_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `type`, `avatar`, `name`, `summary`, `content`, `created_id`, `updated_id`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'term', '1593427793_netvas.PNG', 'Điều khoản sử dụng', 'Điều khoản sử dụng của Netvas', '<p><b>Điều khoản sử dụng của Netvas</b></p><ol><li>Không abc</li><li>Hãy abc</li><li>bla bla<br><br></li></ol>', 1, 1, 1, 1, '2020-06-17 06:40:31', '2020-06-29 10:49:53'),
(2, 'introduction', '1593427849_netvas4002.png', 'Chào mừng Bạn đến với NetVAS Co,.LTD', 'Chào mừng Bạn đến với NetVAS Co,.LTD', 'Chào mừng Bạn đến với NetVAS Co,.LTD', 1, 1, 1, 1, '2020-06-20 02:54:40', '2020-07-01 07:35:55'),
(3, 'introduction', '1593427872_netvas.PNG', 'Chào mừng Bạn đến với NetVAS Co,.LTD', 'Chào mừng Bạn đến với NetVAS Co,.LTD', 'Chào mừng Bạn đến với NetVAS Co,.LTD', 1, 1, 2, 1, '2020-06-20 02:55:17', '2020-07-01 07:35:49'),
(4, 'news', '1593577042_news.png', 'Tin Tức Mới', 'Tổng hợp tin tức mới', '<p>Tin Tức Mới<br></p>', 1, 1, 4, 1, '2020-07-01 04:17:22', '2020-07-01 07:37:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `times` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets_code`
--

CREATE TABLE `password_resets_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `times` tinyint(4) NOT NULL DEFAULT 0,
  `is_used` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `name_en`, `code`, `status`, `type`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'ViettelPay ( đang phát triển )', 'ViettelPay ( developing )', 'viettelpay', 0, 'online', 'MaskGroup39.png', '2020-05-28 09:39:18', NULL),
(2, 'Momo ( đang phát triển )', 'Momo ( developing )', 'momo', 0, 'online', 'MaskGroup40.png', '2020-05-28 09:39:18', NULL),
(3, 'Thanh toán trực tiếp', 'Direct Payment', 'direct', 1, 'offline', 'Path10906.png', '2020-05-28 09:39:18', NULL),
(4, 'Chuyển khoản ngân hàng', 'Bank Transfer', 'transfer', 1, 'online', 'Group10650.png', '2020-06-11 03:12:27', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request_supports`
--

CREATE TABLE `request_supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `attached_files` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `request_supports`
--

INSERT INTO `request_supports` (`id`, `email`, `phone`, `address`, `content`, `uid`, `attached_files`, `status`, `created_at`) VALUES
(1, 'Anhnn@eplatform.vn', '0908918039', '101 Trần Hưng Đạo', 'em kêu thằng Trung sếp của em đi uống cafe với anh', 8, '[]', 'answer', '2020-06-24 02:45:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request_support_activity`
--

CREATE TABLE `request_support_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'Xem thống kê', '2020-06-03 02:10:53', NULL),
(2, 'dashboard-chart', 'Xem thống kê qua biểu đồ', '2020-06-03 02:10:53', NULL),
(3, 'page', 'Xem trang', '2020-06-03 02:10:53', NULL),
(4, 'page-create', 'Hiển thị form tạo trang', '2020-06-03 02:10:53', NULL),
(5, 'page-store', 'Tạo trang', '2020-06-03 02:10:53', NULL),
(6, 'page-edit', 'Hiển thị form chỉnh sửa trang', '2020-06-03 02:10:53', NULL),
(7, 'page-update', 'Cập nhật chỉnh sửa trang', '2020-06-03 02:10:53', NULL),
(8, 'notification', 'Xem danh sách thông báo đã gửi', '2020-06-03 02:10:53', NULL),
(9, 'notification-send', 'Gửi thông báo', '2020-06-03 02:10:53', NULL),
(10, 'upload', 'Upload ảnh', '2020-06-03 02:10:53', NULL),
(11, 'category', 'Xem danh sách chuyên mục', '2020-06-03 02:10:53', NULL),
(12, 'category-create', 'Show form tạo chuyên mục', '2020-06-03 02:10:53', NULL),
(13, 'category-edit', 'Show form chỉnh sửa chuyên mục', '2020-06-03 02:10:53', NULL),
(14, 'category-store', 'Tạo chuyên mục', '2020-06-03 02:10:53', NULL),
(15, 'category-update', 'Sửa chuyên mục', '2020-06-03 02:10:53', NULL),
(16, 'category-delete', 'Xóa chuyên mục', '2020-06-03 02:10:53', NULL),
(17, 'booking', 'Xem danh sách đơn hàng', '2020-06-03 02:10:53', NULL),
(18, 'booking-detail', 'Chi tiết đơn hàng', '2020-06-03 02:10:53', NULL),
(19, 'booking-assign', 'Giao việc', '2020-06-03 02:10:53', NULL),
(20, 'booking-reject', 'Từ chối đơn hàng', '2020-06-03 02:10:53', NULL),
(21, 'booking-update-deal-price', 'Cập nhật giá thỏa thuận của đơn hàng', '2020-06-03 02:10:53', NULL),
(22, 'service', 'Xem danh sách dịch vụ', '2020-06-03 02:10:53', NULL),
(23, 'service-create', 'Show form tạo dịch vụ', '2020-06-03 02:10:53', NULL),
(24, 'service-edit', 'Show form sửa dich vụ', '2020-06-03 02:10:53', NULL),
(25, 'service-store', 'Tạo dịch vụ', '2020-06-03 02:10:53', NULL),
(26, 'service-update', 'Chỉnh sửa dịch vụ', '2020-06-03 02:10:53', NULL),
(27, 'service-delete', 'Xóa dịch vụ', '2020-06-03 02:10:53', NULL),
(28, 'group', 'Xem danh sách nhóm', '2020-06-03 02:10:53', NULL),
(29, 'group-create', 'Show form tạo nhóm', '2020-06-03 02:10:53', NULL),
(30, 'group-edit', 'Show form sửa nhóm', '2020-06-03 02:10:53', NULL),
(31, 'group-store', 'Tạo nhóm', '2020-06-03 02:10:53', NULL),
(32, 'group-update', 'Chỉnh sửa nhóm', '2020-06-03 02:10:53', NULL),
(33, 'user', 'Xem danh sách tài khoản', '2020-06-03 02:10:53', NULL),
(34, 'user-create', 'Show form tạo tài khoản', '2020-06-03 02:10:53', NULL),
(35, 'user-edit', 'Show form sửa tài khoản', '2020-06-03 02:10:53', NULL),
(36, 'user-store', 'Tạo tài khoản', '2020-06-03 02:10:53', NULL),
(37, 'user-update', 'Chỉnh sửa tài khoản', '2020-06-03 02:10:53', NULL),
(38, 'user-profile', 'Xem thông tin tài khoản của mình', '2020-06-03 02:10:53', NULL),
(39, 'user-update-profile', 'Cập nhật thông tin tài khoản của mình', '2020-06-03 02:10:53', NULL),
(40, 'user-change-password', 'Thay đổi mật khẩu', '2020-06-03 02:10:53', NULL),
(41, 'rule', 'Xem danh sách luật', '2020-06-03 02:10:53', NULL),
(42, 'rule-create', 'Show form tạo luật', '2020-06-03 02:10:53', NULL),
(43, 'rule-edit', 'Show form sửa luật', '2020-06-03 02:10:53', NULL),
(44, 'rule-store', 'Tạo luật', '2020-06-03 02:10:53', NULL),
(45, 'rule-update', 'Chỉnh sửa luật', '2020-06-03 02:10:53', NULL),
(46, 'rule-delete', 'Xóa luật', '2020-06-03 02:10:53', NULL),
(47, 'staff', 'Trang quản trị của kỹ thuật viên', '2020-06-03 02:10:53', NULL),
(48, 'staff-detail', 'Xem chi tiết booking của kỹ thuật viên đó', '2020-06-03 02:10:53', NULL),
(49, 'staff-update', 'Cập nhật trạng thái booking của kỹ thuật viên đó', '2020-06-03 02:10:53', NULL),
(50, 'chat-load-messages', 'Xem tin nhắn', '2020-06-03 02:10:53', NULL),
(51, 'chat-send-message', 'Gửi tin nhắn', '2020-06-03 02:10:53', NULL),
(52, 'chat-upload-image', 'Gửi hình ảnh', '2020-06-03 02:10:53', NULL),
(53, 'setting', 'Xem cài đặt của hệ thống', '2020-06-03 02:10:53', NULL),
(54, 'setting-update', 'Cập nhật cài đặt của hệ thống', '2020-06-03 02:10:53', NULL),
(55, 'user-change-password', 'Thay đổi mật khẩu bản thân', '2020-06-08 04:37:10', NULL),
(56, 'notification-detail', 'Xem chi tiết thông báo', '2020-06-16 17:00:00', NULL),
(57, 'notification-upload-image', 'Upload hình để gửi thông báo', '2020-06-16 17:00:00', NULL),
(58, 'request-support', 'Xem danh sách hỗ trợ từ khách hàng', '2020-06-16 17:00:00', NULL),
(59, 'request-support-detail', 'Xem chi tiết hỗ trợ từ khách hàng', '2020-06-16 17:00:00', NULL),
(60, 'request-support-update', 'Cập nhật trạng thái hỗ trợ', '2020-06-16 17:00:00', NULL),
(61, 'request-support-answer', 'Trả lời hỗ trợ từ khách hàng', '2020-06-16 17:00:00', NULL),
(62, 'ranking', 'Xem bảng xếp hạng staff', '2020-06-16 17:00:00', NULL),
(63, 'rating', 'Xem danh sách đánh già từ khách hàng', '2020-06-16 17:00:00', NULL),
(64, 'rating-detail', 'Xem chi tiết đánh giá', '2020-06-16 17:00:00', NULL),
(65, 'booking-create', 'Tạo đơn hàng', '2020-06-16 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `districts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `updated_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `summary`, `content`, `avatar`, `background`, `images`, `districts`, `cities`, `status`, `category_id`, `created_id`, `updated_id`, `created_at`, `updated_at`) VALUES
(1, 'Cài đặt office (Trọn bộ)', 'NetVAS nhận cài đặt trọn bộ gói office 2010, 2013, 2016, 2019, office 365...', '<p>Cài đặt trọn bộ gói office 2010, 2013, 2016, 2019, office 365... bằng hình thức online.</p><p>Quý khách vui lòng cài đặt phần mềm teamviewer / ultraviewer vào máy tính.<br></p><p><img style=\"width: 50%;\" src=\"https://support.netvas.vn/uploads/1592369541_teamviewer14-1.bmp\"></p><p>Vui lòng gửi Your ID và Password cho nhân viên kỹ thuật của NetVAS.<br></p>', '1592369883_office1.jpg', '1592369883_office2.jpg', '[\"1592369883_offic3.jpg\"]', NULL, NULL, 1, 1, 1, 1, '2020-06-17 04:58:03', '2020-07-01 13:37:22'),
(2, 'Cài đặt phần mềm thiết kế đồ hoạ', 'NetVAS nhận cài Adobe Photoshop (Ps), Illustrator, CorelDRAW, Adobe InDesign,', '<p>Như vậy tôi vừa giới thiệu cho các bạn về những Phần mềm thiết kế đồ hoạ\r\n phổ biến. Không có bất kì phần mềm nào tốt hoặc xấu. để có thể trở \r\nthành một design chuyện nghiệp, buộc bạn phải nỗ lực và có kế hoạch \r\ntrinh phục từ phần mềm một. Mong rằng với những gì chúng tôi chia sẻ cho\r\n bạn, sẽ giúp bạn có cách nhìn tổng quan hơn về lĩnh vực thiết kế đồ \r\nhoạ. Cũng như giúp bạn có được cách nhìn tổng quan và lộ trình rõ ràng \r\nđể trinh phục lĩnh vực này.</p>', '1592371338_thietke1.jpg', '1592371338_thietke3.jpg', '[\"1592371338_thietke4.jpg\"]', NULL, NULL, 1, 1, 1, NULL, '2020-06-17 05:22:18', '2020-06-17 05:22:18'),
(3, 'Kiểm tra bảo mật máy tính', 'Kiểm tra lỗ hỏng bảo mật máy tính cá nhân từ xa.', '<p>Để máy tính luôn được bảo mật và an toàn tuyệt đối, hãy cùng điểm qua 5 bước cơ bản giúp bảo mật máy tính cũng như thông tin cá nhân của chính bạn.</p><p>1. Sử dụng tường lửa (Firewall)<br></p><p>Tường lửa thường là phần mềm hệ thống được đính kèm sẵn theo mỗi phiên bản Windows, nó có tác dụng như một biên giới giúp ngăn chặn, hoặc chọn lọc những kẻ xâm nhập không mong muốn trên Internet vào máy tính cá nhân của người khác. Nhưng đôi khi bức tường này tỏ ra không hiệu quả và dễ dàng bị qua mặt, việc sử dụng phần mềm bên thứ 3 là giải pháp hữu hiệu để khắc phục vấn đề này. Tuy nhiên đừng quá tin tưởng vào Firewall, đây chỉ là một mẹo rất nhỏ trong công cuộc bảo vệ chiếc máy tính của bạn.<br></p><p>2. Sử dụng các phần mềm Antivirus<br></p><p>Antivirus có rất nhiều ích lợi trong việc phát hiện, loại bỏ các loại virus cũng như khắc phục phần nào hậu quả do chúng gây ra. Tuy nhiên nhiều người lại phớt lờ và bỏ qua quá trình này, dẫn đến hậu quả là chiếc máy tính của họ thường xuyên xảy ra lỗi hệ thống hay nghiêm trọng hơn có thể làm lộ các thông tin cá nhân lên mạng Internet. Vì vậy, mỗi người nên cài đặt và thường xuyên cập nhật các chương trình Antivirus để bảo vệ dữ liệu của mình. Hiện nay bên cạnh các phần mềm yêu cầu trả tiền, vẫn có rất nhiều chương trình mạnh mẽ nhưng miễn phí như Avast, Avira,…<br></p><p>3. Sử dụng mật khẩu phức tạp<br></p><p>Thói quen đặt mật khẩu cho các tài liệu quan trọng là việc làm hết sức đúng đắn, tuy nhiên để mật khẩu quá đơn giản lại là “con dao hai lưỡi” khiến điều này phản tác dụng. Đối với những hacker dày dạn kinh nghiệm, việc sử dụng phần mềm thử kết hợp tất cả các ký tự, hay còn gọi là thủ thuật Bruteforce để mở khoá là điều khá đơn giản. Do vậy, người dùng nên thường xuyên thay đổi mật khẩu của mình, sử dụng các mật khẩu dài từ 8 đến 9 ký tự trở lên, bao gồm cả chữ, số hay ký tự đặc biệt, hành động nhỏ này sẽ giúp dữ liệu luôn được an toàn.<br></p><p>4. Thường xuyên cập nhật phần mềm<br></p><p>Bên trong mỗi hệ điều hành hay các phần mềm thường vẫn còn rất nhiều lỗi chưa được phát hiện, từ những lỗi đó hacker có thể dễ dàng xâm nhập và chiếm quyền điều khiển máy tính cá nhân. Vì thế, nên kiểm tra và update thường xuyên chương trình của mình lên phiên bản mới nhất, ngoài việc đảm bảo an toàn nó còn giúp phần mềm chạy trơn tru và mượt mà hơn.<br></p><p>5. Luôn luôn cảnh giác<br></p><p>Cuối cùng, để tránh các trường hợp đáng tiếc xảy ra, cá nhân mỗi người nên có ý thức và thận trọng hơn khi tiếp xúc với Internet. Không nên tải và cài đặt mọi thứ. Cần tìm hiểu kỹ nguồn gốc, xuất xứ của các phần mềm cũng như đường link trang web trước khi truy cập vào và cài đặt.<br></p>', '1593402668_password.jpg', '1593402668_antivirus.png', '[\"1593402668_firewall2.jpg\"]', NULL, NULL, 1, 1, 1, NULL, '2020-06-29 03:51:08', '2020-06-29 03:51:08'),
(4, 'Máy tính không kết nối được Wifi (với mạng không dây)', 'NetVAS có nhân viên kỹ thuật đến tại nhà (nơi làm việc) để xử lý máy tính không kết nối được Wifi (với mạng không dây)', '<p><b>Máy tính không kết nối được Wifi (với mạng không dây):</b></p><p>Lỗi này cũng là lỗi khá phổ biến, đôi lúc do người cài đặt chỉnh sai các thông số hay cũng có thể do lỗi modem… Căn cứ tùy thuộc vào từng dòng máy tính hoặc hệ điều hành mà khi máy tính cài đặt ta có thể khắc phục sự cố. Ban đầu chúng ta phải kiểm tra để chắc chắn mạng wifi đang hoạt động, rồi kiểm tra lại địa chỉ IP xem máy tính đã cấu hình đúng hay chưa. Một vài máy có nút tắt bật wifi ngay bên trên bàn phím, chúng ta cần phải kiểm tra xem đã wifi đã được bật hay chưa. Nếu trường hợp làm hết tất cả những thao tác trên máy tính mà wifi vẫn không bắt được thì chúng ta phải xem xét cấu hình lại modem hay router của các nhà mạng cung cấp mạng.<br></p>', '1593403305_may-tinh-bi-loi-2.jpg', '1593403305_cach-khac-phuc-may-tinh-khong-nhan-wifi-sau-khi-cai-win-1-1.jpg', '[\"1593403305_cach-khac-phuc-may-tinh-khong-nhan-wifi-sau-khi-cai-win-1-1.jpg\"]', NULL, NULL, 1, 1, 1, 1, '2020-06-29 04:01:45', '2020-06-29 04:15:06'),
(5, 'Bàn phím lỗi (Bad keyboard)', 'Nhận viên kỹ thuật NetVAS sẽ xử lý online khi bàn phím lỗi (Bad keyboard)', '<p><font color=\"#333333\" face=\"Roboto, sans-serif\"><span style=\"font-size: 14px;\"><b>Bàn phím lỗi (Bad keyboard)</b></span></font><br></p><p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\">Máy tính sử dụng lâu dài làm cho bàn phím bị cũ hỏng, bị lung lay không chắc chắn hay bị tuột phím. Giải pháp tốt nhất đó chính là chúng ta nên thay một bàn phím mới, điều đáng chú ý ở đây là lúc thay bàn phím ta cần phải chọn đúng kiểu bàn phím đồng bộ cùng với hãng của máy tính để tránh các lỗi xung khắc driver hay các phần mềm điều khiển nó.</span><br></p>', '1593403603_phìm.jpg', '1593403603_phim.png', '[\"1593403603_banphim.jpg\"]', NULL, NULL, 1, 1, 1, 1, '2020-06-29 04:06:43', '2020-06-29 04:06:59'),
(6, '(Hỗ trợ) Máy tính bị treo, bị đơ, bị chạm', 'Hỗ trợ xử lý máy tính bị treo, bị đơ, bị chạm', '<p><font color=\"#333333\" face=\"Roboto, sans-serif\"><span style=\"font-size: 14px;\"><b>(Hỗ trợ) Máy tính bị treo, bị đơ, bị chạm:</b></span></font><br></p><p><span style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\">Khi sử dụng laptop đây là lỗi khá phổ biến trong khoảng thời gian sử dụng lâu dài. Nguyên nhân của lỗi này thường do sự xung đột của các phần mềm khi cài đặt hoặc chạy nhiều chương trình cùng một lúc, có khi cũng do driver máy bị lỗi. Các lỗi của phần mềm khắc phục khá đơn giản, dễ hiểu bạn chỉ cần có đĩa cài đặt cho vào trong máy và cài lại những phần mềm đó. Khi bị lỗi này chúng ta chỉ gỡ CPU ra và vệ sinh, lau chùi lại các bộ phận như gắn kết làm mát ổ cứng, quạt tản nhiệt, Ram…</span><br></p>', '1593403890_windows-chay-cham.jpg', '1593403890_may-tinh-bi-do-lam-the-nao-1.jpg', '[\"1593403890_maxresdefault.jpg\"]', NULL, NULL, 1, 1, 1, NULL, '2020-06-29 04:11:31', '2020-06-29 04:11:31'),
(7, 'Bảo trì máy tính bàn, laptop, Mac, iMac', 'Dịch vụ bảo trì trọn gói Bảo trì máy tính bàn, laptop, Mac, iMac cho Doanh nghiệp', '<p><b><u>Thực hiện:</u></b></p><p>- Kiểm tra, anti-virus</p><p>- Kiểm tra trạng thái PC-Workstation (CPU, RAM, HDDs)&nbsp;</p><p>- Cài đặt lại hệ điều hành, ứng dụng theo yêu cầu.</p><p>- Cài đặt, hỗ trợ fix lỗi liên qua đến email, file, phần mềm.</p><p>- Bảo trì / sửa chữa thiết (liên hệ nhà cung cấp phần cứng hoặc phần mềm, chi phí khách hàng tự trả)</p><p>- Hỗ trợ dịch vụ từ xa: không giới hạn</p><p>- Hỗ trợ dịch vụ tại chỗ: không giới hạn (Trường hợp không thể hỗ trợ từ xa)</p><p>- Kiểm tra nâng cấp phần mềm theo yêu cầu. ( Trường hợp phần mềm phát sinh chi phí sẽ báo lại với khách hàng )</p><div><br></div>', '1593412884_dich-vu-it-support-cho-thue-it-support-0.jpg', '1593412884_dich-vu-it-helpdesk-chuyen-nghiep-tron-goi-1.jpg', '[\"1593412884_it-support-services.png\"]', NULL, NULL, 1, 2, 1, NULL, '2020-06-29 06:41:24', '2020-06-29 06:41:24'),
(8, 'Dịch vụ bảo trì hệ thống mạng', 'Dịch vụ bảo trì hệ thống mạng – Maintenance Services', '<p><b><u>Dịch vụ bảo trì hệ thống mạng – Maintenance Services</u></b></p><p>Dịch vụ bảo trì bảo dưỡng “Maintenance Services” thực hiện việc bảo dưỡng phòng ngừa (Preventive Maintenance), bảo trì, khắc phục sự cố (Incident Maintenance), dịch vụ thay thế phần cứng dựa trên các tiêu chuẩn cung cấp dịch vụ và tuân thủ các quy trình để đáp ứng yêu cầu cam kết dịch vụ SLAs (Service Level Agreement).</p><p><b><u>Xác định:</u></b></p><p>Sơ đồ sau đây mô tả quy trình dịch vụ bảo trì để đảm bảo các sự gián đoạn được nhanh chóng được xác định và sửa chữa.</p><p>Sơ đồ sau đây mô tả quy trình duy trì và thay thế phần cứng tạm thời để đảm bảo các sự cố được xác định và sửa chữa một cách nhanh chóng.</p>', '1593413097_thi-cong-he-thong-mang.jpg', '1593413097_Lan.jpg', '[\"1593413097_h\\u1ec7-th\\u1ed1ng.jpg\"]', NULL, NULL, 1, 2, 1, NULL, '2020-06-29 06:44:57', '2020-06-29 06:44:57'),
(9, 'Quản Trị Máy Chủ tại Doanh Nghiệp', 'Dịch vụ Quản Trị Máy Chủ tại Doanh Nghiệp', '<p><b><u>Quản Trị Máy Chủ tại Doanh Nghiệp</u></b></p><p><b>Mô tả chi tiết công việc:</b></p><p>Dịch vụ quản trị máy chủ là hình thức cung cấp dịch vụ quản lý kỹ thuật thực hiện tất cả các thao tác quản trị thuộc trách nhiệm của bộ phận tương đương vị trí Quản trị hệ thống của khách hàng. Khi thuê dịch vụ quản trị máy chủ, khách hàng sẽ được cài đặt, cấu hình, tối ưu, theo dõi và xử lý các vấn đề kỹ thuật và lỗi phát sinh trên máy chủ nhằm đảm bảo máy chủ hoạt động trong trạng thái ổn định và hiệu suất cao nhất.</p><p><b>Quản trị máy chủ gồm:</b><br></p><p>– Cài đặt mới hoặc cài lại hệ điều hành miễn phí (nhưng tối đa không quá 3 lần/tháng).</p><p>– Cài đặt các phần mềm bản quyền do NETVAS cung cấp khi khách thuê kèm miễn phí.</p><p>– Cài đặt tường lửa cơ bản.</p><p>– Backup và chuyển dữ liệu từ nhà cung cấp cũ.</p><p>– Cập nhật các phiên bản ứng dụng mới nhất cho hệ thống.<br></p><p>– Cài đặt server giúp ngăn chặn, hạn chế tấn công và lỗi bảo mật phổ biến.</p><p>– Cài đặt backup dữ liệu cho server.</p><p>– Cài đặt các ứng dụng bổ sung giúp tăng tốc độ, tăng mức tải của hệ thống.</p><p>– Tối ưu hóa hệ thống (Apache, MySQL, mod_security,…)</p><p>– Theo dõi hoạt động của hệ thống, kiểm tra định kỳ.</p>', '1593413399_sau-khi-thue-cho-dat-server-lam-sao-de-quan-ly-may-chu-1.jpg', '1593413399_quanservermaychu1.png', '[\"1593413399_quan-tri-may-chu.jpg\"]', NULL, NULL, 1, 2, 1, NULL, '2020-06-29 06:49:59', '2020-06-29 06:49:59'),
(10, 'Quản lý Camera, máy chấm công', 'Dịch vụ quản lý Camera, máy chấm công', '<p>Sử dụng camera đang là phương án quản lý tài sản, nhân sự của hầu hết các doanh nghiệp, công ty lớn. Tuy nhiên, với các doanh nghiệp sở hữu chuỗi cửa hàng, quán ăn, hay ngân hàng có số lượng lớn các trụ ATM… việc theo dõi cùng lúc nhiều camera tại tất cả các nơi đang gặp nhiều khó khăn… Giải pháp quản lý camera tập trung sẽ giúp doanh nghiệp giải quyết những vấn đề trên. Giải pháp Quản lý tập trung tất cả Camera tại tất cả các chi nhánh về trụ sở chính áp dụng cho việc triển khai tại những công ty, ngân hàng, nhà máy có nhiều trụ sở đặt tại nhiều nơi.<br></p>', '1593413694_camera-quan-sat-wifi.png', '1593413694_goi-camera-tan-binh.jpg', '[\"1593413694_unnamed.jpg\"]', NULL, NULL, 1, 2, 1, 1, '2020-06-29 06:54:54', '2020-06-29 06:55:28'),
(11, 'Quản lý máy in, Photocopy', 'Dịch vụ quản lý máy in, photocopy', '<p>NetVAS hỗ trợ kết nối máy tính người dùng đến máy in. Liên hệ đối tác thay thế linh kiện và thay mực.</p><p><br></p>', '1593413969_3291_may_in_hp_laserjet_pro_m404dw.jpg', '1593413969_18338_p2035_ce461a_ha4.jpg', '[\"1593413969_428fdw.jpg\"]', NULL, NULL, 1, 2, 1, NULL, '2020-06-29 06:59:29', '2020-06-29 06:59:29'),
(12, 'Dịch vụ tổng đài', 'Khắc phục sự cố tổng đài VOIP và tổng đài analog.', '<p>Khắc phục sự cố tổng đài VOIP và tổng đài analog.</p><p><br><br></p>', '1593414200_dich-vu-voip.png', '1593414200_tong-dai-ao.jpg', '[\"1593414200_vpbx.png\"]', NULL, NULL, 1, 2, 1, NULL, '2020-06-29 07:03:20', '2020-06-29 07:03:20'),
(13, 'Dịch vụ bảo trì hệ thống mạng định kỳ', 'Dịch vụ bảo trì hệ thống mạng – Maintenance Services', '<p><b><u>Dịch vụ bảo trì hệ thống mạng – Maintenance Services</u></b></p><p>Dịch vụ bảo trì bảo dưỡng “Maintenance Services” thực hiện việc bảo dưỡng phòng ngừa (Preventive Maintenance), bảo trì, khắc phục sự cố (Incident Maintenance), dịch vụ thay thế phần cứng dựa trên các tiêu chuẩn cung cấp dịch vụ và tuân thủ các quy trình để đáp ứng yêu cầu cam kết dịch vụ SLAs (Service Level Agreement).</p><p><b><u>Xác định:</u></b></p><p>Sơ đồ sau đây mô tả quy trình dịch vụ bảo trì để đảm bảo các sự gián đoạn được nhanh chóng được xác định và sửa chữa.</p><p>Sơ đồ sau đây mô tả quy trình duy trì và thay thế phần cứng tạm thời để đảm bảo các sự cố được xác định và sửa chữa một cách nhanh chóng.</p>', '1593414989_hệ-thống.jpg', '1593414989_thi-cong-he-thong-mang.jpg', '[\"1593414989_h\\u1ec7-th\\u1ed1ng.jpg\"]', NULL, NULL, 1, 3, 1, NULL, '2020-06-29 07:16:29', '2020-06-29 07:16:29'),
(14, 'Thi công hệ thống mạng', 'Bảng giá thi công mạng lan, cách đi dây mạng văn phòng, thi công hệ thống mạng tại TPHCM.', '<p><b>THI CÔNG DÂY MẠNG - DÂY ĐIỆN THOẠI - MẠNG LAN - Ổ CẮM ĐIỆN MẠNG VĂN PHÒNG</b></p><p><b>1. HỆ THỐNG DÂY MẠNG MÁY TÍNH</b></p><p>Bạn cần thi công hệ thống dây mạng INTERNET cho văn phòng mới, dây mạng máy tính bị cũ hư(mất tín hiệu), ...bạn cần cải tạo hệ thống để vận hành ổn định hơn.</p><p>Bạn muôn xây dựng hệ thống mạng(server), hệ thống internet chạy ổn định và các hạng mục khác liên quan đến mạng bạn đừng do dự hãy liên hệ để được tư vấn 0908 31 15 19 - 0916 74 79 76&nbsp;</p><p>Hình ảnh một số dự án thi công thực tế mạng LAN&nbsp; internet đang thi công và đã hoàn thành</p><p><b>2. HỆ THỐNG TỔNG ĐÀI ĐIỆN THOẠI</b></p><p>Công ty bạn cần thiết kế tổng đài truyền thống hoặc tổng đài IP</p><p><b>3. HỆ THỐNG Ổ CẮM ĐIỆN NHẸ</b></p><p>Công ty bạn cần thiết kế Ổ CẮM ĐIỆN</p><p><b>4. HỆ THỐNG WIFI CHUYÊN NGHIỆP</b></p><p>Hệ thống wifi đang là điều bất cập của các doanh nghiệp, liệu số lượng nhân viên lên cả 100 users wifi sao đáp ứng, hãy gọi cho chúng tôi để được tư vấn nhé!</p><p><b>5. THI CÔNG CAMERA(CCTV) NHÀ XƯỞNG</b></p><p>Chúng tôi nhận thầu và thi công các dự án camera an ninh, mạng máy tính và điện thoại nhà xưởng các tỉnh thành trong cả nước, hãy liên hệ với chúng tôi</p><p><b>6. NGOÀI RA CHÚNG TÔI CÒN NHIỀU HỆ THỐNG KHÁC NHƯ:</b></p><p>Thi công hệ thống vân tay chấm công</p><p>Thi công hệ thống access control</p><p>Thi công hệ thống báo trôm báo cháy</p><p>Thi công cáp quang</p><p><b>7. QUI TRÌNH THI CÔNG HỆ THỐNG GẦM CÁC BƯỚC</b></p><p>Để thi công các hệ thống được tốt nhất, đòi hỏi nhân viên thi công&nbsp; phải có tay nghề cao, kinh nghiệm của đơn vị đảm nhận thi công. Đơn vị thi công tốt sẽ giúp cho hệ thống mạng của doanh nghiệp đảm bảo ổn định, tính thẩm mỹ cao, giảm thiểu sự cố phát sinh trong quá trình vận hành và tiết kiệm tối đa chi phí lắp đặt.</p><p><b>CÁC BƯỚC TIẾP NHẬN</b></p><p>- Tiến hành khảo sát địa điểm dự kiến thi công.</p><p>- Tiếp nhận bản vẽ(nếu có) từ chủ đầu tư</p><p>- Lên các phương án dự kiến sẽ triển khai để khách hàng lựa chọn.</p><p>- Vẽ sơ đồ chi tiết hệ thống, báo giá sơ bộ số lượng các vật tư thi công.</p><p>- Thương thảo và Ký hợp đồng.</p><p>- Tiến hành thi công.</p><p>- Nghiệm thu, bàn giao các thiết bị thi công, hướng dẫn khách hàng sử dụng.</p><p>- Làm các thủ tục thanh toán.</p><p>- Bảo hành, bảo trì mạng. Hỗ trợ và chăm sóc khách hàng.</p>', '1593415441_unnamed(3).jpg', '1593415441_unnamed(2).jpg', '[\"1593415441_unnamed(1).jpg\"]', NULL, NULL, 1, 3, 1, NULL, '2020-06-29 07:24:01', '2020-06-29 07:24:01'),
(15, 'Quản Trị Máy Chủ', 'Dịch vụ Quản Trị Máy Chủ tại Doanh Nghiệp', '<p><b><u>Quản Trị Máy Chủ tại Doanh Nghiệp</u></b></p><p><b>Mô tả chi tiết công việc:</b></p><p>Dịch vụ quản trị máy chủ là hình thức cung cấp dịch vụ quản lý kỹ thuật thực hiện tất cả các thao tác quản trị thuộc trách nhiệm của bộ phận tương đương vị trí Quản trị hệ thống của khách hàng. Khi thuê dịch vụ quản trị máy chủ, khách hàng sẽ được cài đặt, cấu hình, tối ưu, theo dõi và xử lý các vấn đề kỹ thuật và lỗi phát sinh trên máy chủ nhằm đảm bảo máy chủ hoạt động trong trạng thái ổn định và hiệu suất cao nhất.</p><p><b>Quản trị máy chủ gồm:</b><br></p><p>– Cài đặt mới hoặc cài lại hệ điều hành miễn phí (nhưng tối đa không quá 3 lần/tháng).</p><p>– Cài đặt các phần mềm bản quyền do NETVAS cung cấp khi khách thuê kèm miễn phí.</p><p>– Cài đặt tường lửa cơ bản.</p><p>– Backup và chuyển dữ liệu từ nhà cung cấp cũ.</p><p>– Cập nhật các phiên bản ứng dụng mới nhất cho hệ thống.<br></p><p>– Cài đặt server giúp ngăn chặn, hạn chế tấn công và lỗi bảo mật phổ biến.</p><p>– Cài đặt backup dữ liệu cho server.</p><p>– Cài đặt các ứng dụng bổ sung giúp tăng tốc độ, tăng mức tải của hệ thống.</p><p>– Tối ưu hóa hệ thống (Apache, MySQL, mod_security,…)</p><p>– Theo dõi hoạt động của hệ thống, kiểm tra định kỳ.</p>', '1593415669_tảixuống.jpg', '1593415669_maychu.jpg', '[\"1593415669_may-chu-la-gi-server-la-gi-1.jpg\"]', NULL, NULL, 1, 4, 1, NULL, '2020-06-29 07:27:49', '2020-06-29 07:27:49'),
(16, 'Quản trị máy chủ phần mềm kế toán', 'Quản trị máy chủ phần mềm kế toán:', '<p><b>Quản trị máy chủ phần mềm kế toán:</b></p><p><b>Thực hiện:</b></p><p>- Kiểm tra logs</p><p>- Kiểm tra trạng thái server (CPU, RAM, HDDs)</p><p>- Kiểm tra tình trạng hoạt động của các dịch vụ, chức năng trên server,</p><p>- Kiểm tra, anti-virus,</p><p>- Kiểm tra backup,</p><p>- Xử lý lỗi phát sinh (Nếu có)</p><p>- Cài đặt lại hệ điều hành, ứng dung</p><p>- Cấu hình backup theo yêu cầu</p><p>- Cấu hình, cài đặt ứng dụng theo yêu cầu (Nếu có)</p><p>- Thời gian thực hiện định kỳ</p><div><br></div>', '1593416124_Anh_1.png', '1593416124_img1.png', '[\"1593416124_unnamed(1).png\"]', NULL, NULL, 1, 4, 1, 1, '2020-06-29 07:35:24', '2020-06-29 07:39:58'),
(17, 'Quản trị máy chủ Email Server', 'Email Server', '<p><b>Quản trị máy chủ Email Server:</b></p><p><b>Thực hiện:</b></p><p>- Kiểm tra logs</p><p>- Kiểm tra trạng thái server (CPU, RAM, HDDs)</p><p>- Kiểm tra tình trạng hoạt động của các dịch vụ, chức năng trên server,</p><p>- Kiểm tra, anti-virus,</p><p>- Kiểm tra backup,</p><p>- Xử lý lỗi phát sinh (Nếu có)</p><p>- Cài đặt lại hệ điều hành, ứng dung</p><p>- Cấu hình backup theo yêu cầu</p><p>- Cấu hình, cài đặt ứng dụng theo yêu cầu (Nếu có)</p><p>- Thời gian thực hiện định kỳ</p><div><br></div>', '1593416332_email-server-la-gi.png', '1593416332_email-server.png', '[\"1593416333_mailserver.jpg\"]', NULL, NULL, 1, 4, 1, NULL, '2020-06-29 07:38:53', '2020-06-29 07:38:53'),
(18, 'Quản trị máy chủ ERP', 'Máy chủ ERP cho Doanh Nghiệp', '<p><b>Thực hiện:</b></p><p>- Kiểm tra logs</p><p>- Kiểm tra trạng thái server (CPU, RAM, HDDs)</p><p>- Kiểm tra tình trạng hoạt động của các dịch vụ, chức năng trên server,</p><p>- Kiểm tra, anti-virus,</p><p>- Kiểm tra backup,</p><p>- Xử lý lỗi phát sinh (Nếu có)</p><p>- Cài đặt lại hệ điều hành, ứng dung</p><p>- Cấu hình backup theo yêu cầu</p><p>- Cấu hình, cài đặt ứng dụng theo yêu cầu (Nếu có)</p><p>- Thời gian thực hiện định kỳ</p><div><br></div>', '1593427010_mo-hinh-mang-server-erp.jpg', '1593427010_so-do-ERP-SERVER.jpg', '[\"1593427010_erp1.jpg\"]', NULL, NULL, 1, 4, 1, NULL, '2020-06-29 10:36:50', '2020-06-29 10:36:50'),
(19, 'Quản trị máy chủ Database', 'Máy chủ Database', '<p><b>Thực hiện:</b></p><p>- Kiểm tra logs</p><p>- Kiểm tra trạng thái server (CPU, RAM, HDDs)</p><p>- Kiểm tra tình trạng hoạt động của các dịch vụ, chức năng trên server,</p><p>- Kiểm tra, anti-virus,</p><p>- Kiểm tra backup,</p><p>- Xử lý lỗi phát sinh (Nếu có)</p><p>- Cài đặt lại hệ điều hành, ứng dung</p><p>- Cấu hình backup theo yêu cầu</p><p>- Cấu hình, cài đặt ứng dụng theo yêu cầu (Nếu có)</p><p>- Thời gian thực hiện định kỳ</p><div><br></div>', '1593427230_Remote-SQL-backup.png', '1593427230_step-1-login-to-the-SQL-Server.png', '[\"1593427230_0e1c3139-4b66-4f11-a261-7a62c1ead897.png\"]', NULL, NULL, 1, 4, 1, 1, '2020-06-29 10:40:30', '2020-06-29 10:40:45'),
(20, 'Quản trị máy chủ Website', 'Máy chủ Website', '<p><b>Thực hiện:</b></p><p>- Kiểm tra logs</p><p>- Kiểm tra trạng thái server (CPU, RAM, HDDs)</p><p>- Kiểm tra tình trạng hoạt động của các dịch vụ, chức năng trên server,</p><p>- Kiểm tra, anti-virus,</p><p>- Kiểm tra backup,</p><p>- Xử lý lỗi phát sinh (Nếu có)</p><p>- Cài đặt lại hệ điều hành, ứng dung</p><p>- Cấu hình backup theo yêu cầu</p><p>- Cấu hình, cài đặt ứng dụng theo yêu cầu (Nếu có)</p><p>- Thời gian thực hiện định kỳ</p><div><br></div>', '1593427381_thue-may-chu-1.jpg', '1593427381_may-chu-ao-vps-thuong-duoc-dung-vao-muc-dich-nao-1.jpg', '[\"1593427381_sudungwebservercanluuyvemaytinhvavitridathethong.png\"]', NULL, NULL, 1, 4, 1, NULL, '2020-06-29 10:43:01', '2020-06-29 10:43:01'),
(21, 'Tư vấn hệ thống Wifi Mesh', 'Hệ thống Wifi Mesh', '<p><b>Mô hình Kết nối Mạng Lưới (Mesh)</b></p><p>Mạng mesh vô tuyến (Wireless Mesh Networking) là một cách cung cấp kết nối vô tuyến dễ dàng với hiệu quả chi phítrên một khu vực lớn sử dụng “các node” mạng lưới vô tuyếngiao tiếp với nhau để trãi rộng mạng. Mạng Wi-Fi truyền thống dựa vào một số lượng nhỏ các điểm truy cập gắn dây để cung cấp&nbsp; hostpot cho người sử dụng khi kết nối với mạng trong khi với mạng mesh chỉ có ít nhất một nodeđể kết nối dây. Sự kết nối Ethernet đối với các node khác là kết nối với nó thông qua các node láng giềng.</p><p>- Những ứng dụng phổ biến của mạng mesh bao gồm:</p><p>+ Phủ kết nối toàn thành phố, mạng trực thuộc chính quyền cho phép các dịch vụ khẩn cấp và công khai để duy trì kết nối với mạng riêng của họ vào mọi lúc ở tất cả mọi địa điểm.<br></p><p>+ Mạng mesh triển khai toàn khu vực các trường Cao đẳng và Đại học cung cấp kết nối lân cận xung quanh khuôn viên trường cho truy cập Internet và mạng nội bộ indoor hoặc outdoor.<br></p><p>+ Mạng mesh cho dịch vụ khách sạn và y tế có thể được thiết lập trong các tòa nhà lớn cung cấp truy cập Internet và truy cập mạng cho nhân viên và khách hàng khi mạng Wi-Fi thông thường sẽ gặp khó khăn trong điều hướng bố trí cấu trúc phức tạp.<br></p><p>+ Mạng lưới tạm thời có thể được tạo ra tại các địa điểm diễn ra sự kiện hoặc công trình xây dựng để cung cấp kết nối mạng cho các cán bộ và nhân viên an ninh.<br></p>', '1593486988_Mesh-2.jpg', '1593486988_mo-hinh-ket-noi-mang-luoi(1).jpg', '[\"1593486988_mo-hinh-ket-noi-mang-luoi(1).jpg\"]', NULL, NULL, 1, 3, 1, 1, '2020-06-30 03:16:28', '2020-06-30 03:16:47'),
(22, 'Tư vấn Wifi Marketing', 'Wifi Marketing', '<p><b>Wifi Marketing</b> là sự kết hợp giữa Social Media và Wifi Marketing. </p><p>Có thể hiểu đơn giản về hình thức Wifi Marketing là, khi chúng ta truy cập vào một WiFi miễn phí nào đó tại một cửa hàng, địa điểm hoặc có thể mạng WiFi của một tổ chức doanh nghiệp nào đó, trên màn hình sẽ xuất hiện giao diện của pop-up quảng cáo sản phẩm, thượng hiệu cũng như thông tin về doanh nghiệp đó. Quảng cáo này được đặt trên một trang web.<br></p>', '1593487315_WiFi-Marketing-dia-diem-rong.jpg', '1593487315_WiFi-Marketing-toc-do-nhanh.jpg', '[\"1593487315_WiFi-Marketing-toc-do-nhanh.jpg\",\"1593487315_WiFi-Marketing-dia-diem-rong.jpg\",\"1593487315_WiFi-Marketing-quang-cao.jpg\"]', NULL, NULL, 1, 3, 1, NULL, '2020-06-30 03:21:55', '2020-06-30 03:21:55'),
(23, 'Dịch vụ WiFi công cộng ngoài trời', 'WiFi công cộng', '<p><b>Ưu điểm vs tiềm năng giải pháp wifi công cộng do NetVAS đem đến.</b></p><p>- Dễ dàng tạo thêm tài khoản và in vé truy cập internet.<br></p><p>- An ninh mạng được đảm bảo.</p><p>- Bảo mật xuyên suốt cho các thiết bị khi di chuyển trong khu vực trực thuộc hệ thống.</p><p>- Phương pháp thanh toán linh hoạt.</p><p>- Góp phần quảng bá thương hiệu doanh nghiệp.</p><p>- Dễ dàng cấu hình để truy cập.</p><p>- Đóng vai trò quan trọng trong việc quản lý truy cập và quản lý đường truyền Internet.</p><p>- Theo dõi và báo cáo cho nhân viên quản trị mạng.</p>', '1593487553_avata.jpg', '1593487553_wifi-cong-cong.jpg', '[\"1593487553_avata.jpg\"]', NULL, NULL, 1, 3, 1, NULL, '2020-06-30 03:25:53', '2020-06-30 03:25:53'),
(24, 'Thuê máy chủ Dell', 'Cho thuê Máy chủ Dell (Đơn giá tính theo tháng)\r\nQuý khách muốn nâng cấp cấu hình vui lòng chọn mục dưới cùng.\r\nMáy chủ được đặt tại DC Viettel, VNPT, FPT, NETNAM', '<p>Dịch vụ cho thuê máy chủ dell&nbsp;</p>', '1593488610_27486_MaychuDellPowerEdgeT30Minitower-1.jpg', '1593488610_dell-poweredge-r730xd_1__eb6c4ef7349a44c798eb5f2c48c3da8e.jpg', '[\"1593488610_DELL-POWEREDGE-T30-fpt-3.png\",\"1593488610_maychuhanoi-image-1462666028.jpg\",\"1593488902_dell-poweredge-r730xd_1__eb6c4ef7349a44c798eb5f2c48c3da8e.jpg\"]', NULL, NULL, 1, 5, 1, 1, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(25, 'Thuê máy chủ HP', 'Cho thuê Máy chủ HP (Đơn giá tính theo tháng)\r\nQuý khách muốn nâng cấp cấu hình vui lòng chọn mục dưới cùng.\r\nMáy chủ được đặt tại DC Viettel, VNPT, FPT, NETNAM', '<p>thuê máy chủ HP<br></p>', '1593491022_HP.jpg', '1593491022_HP1.jpg', '[\"1593491022_Dl380pG8giare.jpg\",\"1593491022_maxresdefault(2).jpg\",\"1593491022_HP1.jpg\"]', NULL, NULL, 1, 5, 1, NULL, '2020-06-30 04:23:42', '2020-06-30 04:23:42'),
(26, 'Máy tính sách tay', 'Dịch vụ cho thuê máy tính xách tay\r\nĐơn giá tính theo tháng, chưa gồm VAT\r\nMáy mới 100%, Hợp đồng thuê tối thiểu 12 tháng', '<p>thuê máy tính<br></p>', '1593578570_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', '1593578570_16825-laptop-dell-inspiron-n5593a-p90f002-1.jpg', '[\"1593578570_16825-laptop-dell-inspiron-n5593a-p90f002-1.jpg\",\"1593578570_201405261501286935_Hinh-11.jpg\",\"1593578570_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg\"]', NULL, NULL, 1, 5, 1, 1, '2020-07-01 04:42:50', '2020-07-01 04:49:18'),
(27, 'Cho thuê máy Workstation Dell', 'Dịch vụ cho thuê máy Workstation Dell\r\nĐơn giá tính theo tháng, chưa gồm VAT\r\nMáy mới 100%, Hợp đồng thuê tối thiểu 12 tháng', '<p>Dịch vụ cho thuê máy Workstation Dell<br></p>', '1593579477_dell-workstation-t1650-core-i5-2400-3-.jpg', '1593579477_Dell-Precision-T7920-Workstation-Main.jpg', '[\"1593579477_Dell-Precison-M5540-1563356779.jpg\",\"1593579477_Dell-Precision-T7920-Workstation-Main.jpg\",\"1593579477_1476_PDP_Precision_Tower_5820_01.jpg.webp\"]', NULL, NULL, 1, 5, 1, NULL, '2020-07-01 04:57:57', '2020-07-01 04:57:57'),
(28, 'Cloud Server', 'Dịch vụ Cloud Server\r\nBảng giá dịch vụ cloud server đặt tại IDC Viettel. Giá trên chưa bao gồm 10% VAT. Hợp đồng 12 tháng / thanh toán tối thiểu 03 tháng.', '<p>Dịch vụ Cloud Server<br></p>', '1593589283_cloud-server.png', '1593589283_tt-cloud-sever1.png', '[\"1593589283_6-920x720.png\",\"1593589283_CloudServerl\\u00e0g\\u00ec.jpg\",\"1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg\"]', NULL, NULL, 1, 7, 1, 1, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(29, 'Cloud Backup & Restore', 'Dich vụ Cloud Backup & Restore (Backup as a service (BaaS))\r\nBảng giá tính theo tháng và chưa bao gồm VAT 10%', '<p>Dich vụ Cloud Backup &amp; Restore (Backup as a service (BaaS))<br></p>', '1593590588_cloud-backup.jpg', '1593590588_cloud-backup_orig.jpg', '[\"1593590588_local-backup-vs-remote-backup-in-kansas-city-1-638.jpg\",\"1593590588_datacentrix-backup-recovery.jpg\",\"1593590588_backup-du-lieu-la-gi-local-backup-va-online-backup-1.jpeg\"]', NULL, NULL, 1, 7, 1, NULL, '2020-07-01 08:03:08', '2020-07-01 08:03:08'),
(30, 'Dịch vụ CDN', 'Dịch vụ CDN tại NetVAS:\r\n- Cổng băng thông mở rộng không giới hạn, đáp ứng cho số lượng người xem cực khổng lồ. Mặc khác, hệ thống sẽ giúp truyền tải nội dung media chất lượng cao, nhanh chóng và ổn định trên nhiều thiết bị.\r\n- Tối ưu hoá Download đáp ứng hàng triệu lượt download trong cùng một thời điểm, tiết kiệm được chi phí đầu tư hạ tầng hoặc ảnh hưởng bởi các yếu tố như: đường truyền không ổn định, file lớn, lượng người dùng cao\r\n-  NetVAS cung cấp giải pháp đơn giản và tối ưu nhất để tăng tốc độ truy cập website giúp load nội dung nhanh, giảm thiểu độ trễ, giật hình khi truy cập và xem các website (Movies, Video clip, TVC,..)\r\n\r\nMẠNG LƯỚI CDN\r\n- Mạng lưới trong nước và quốc tế\r\n- Hệ thống CDN với hơn 200 POPs quốc tế thuộc 113 thành phố trên 43 quốc gia và 11 POPs trong nước trải rộng khắp 2 miền: Hà Nội, HCM với các nhà mạng lớn như VNPT, Viettel, FPT.\r\n- Trung tâm dữ liệu chuẩn Tier 3+\r\n- Hệ thống CDN được đặt tại các Trung tâm dữ liệu lớn đạt mức tiêu chuẩn Tier 3+ đảm bảo khả năng cung cấp độc lập, dự phòng, ISO 27001 với cam kết băng thông mạnh nhất Việt Nam.\r\n- Hệ thông phân tải nội dung lớn\r\n- Với khả năng cung cấp hệ thống trong nước và quốc tế rộng lớn, doanh nghiệp hoàn toàn chủ động lựa chọn sử dụng theo từng khu vực theo thị trường mục tiêu nhanh và hiệu quả.', '<p><b>Dịch vụ CDN tại NetVAS:</b></p><p>- Cổng băng thông mở rộng không giới hạn, đáp ứng cho số lượng người xem cực khổng lồ. Mặc khác, hệ thống sẽ giúp truyền tải nội dung media chất lượng cao, nhanh chóng và ổn định trên nhiều thiết bị.</p><p>- Tối ưu hoá Download đáp ứng hàng triệu lượt download trong cùng một thời điểm, tiết kiệm được chi phí đầu tư hạ tầng hoặc ảnh hưởng bởi các yếu tố như: đường truyền không ổn định, file lớn, lượng người dùng cao</p><p>-&nbsp; NetVAS cung cấp giải pháp đơn giản và tối ưu nhất để tăng tốc độ truy cập website giúp load nội dung nhanh, giảm thiểu độ trễ, giật hình khi truy cập và xem các website (Movies, Video clip, TVC,..)</p><p><b>MẠNG LƯỚI CDN</b><br></p><p>- Mạng lưới trong nước và quốc tế</p><p>- Hệ thống CDN với hơn 200 POPs quốc tế thuộc 113 thành phố trên 43 quốc gia và 11 POPs trong nước trải rộng khắp 2 miền: Hà Nội, HCM với các nhà mạng lớn như VNPT, Viettel, FPT.</p><p>- Trung tâm dữ liệu chuẩn Tier 3+</p><p>- Hệ thống CDN được đặt tại các Trung tâm dữ liệu lớn đạt mức tiêu chuẩn Tier 3+ đảm bảo khả năng cung cấp độc lập, dự phòng, ISO 27001 với cam kết băng thông mạnh nhất Việt Nam.</p><p>- Hệ thông phân tải nội dung lớn</p><p>- Với khả năng cung cấp hệ thống trong nước và quốc tế rộng lớn, doanh nghiệp hoàn toàn chủ động lựa chọn sử dụng theo từng khu vực theo thị trường mục tiêu nhanh và hiệu quả.</p>', '1593591471_cdn.jpeg', '1593591471_1468400480228.png', '[\"1593591471_image.png\",\"1593591471_CDN.png\",\"1593591471_1468400480228.png\"]', NULL, NULL, 1, 7, 1, NULL, '2020-07-01 08:17:51', '2020-07-01 08:17:51'),
(31, 'Cloud Email Doanh Nghiệp', 'Dịch vụ Cloud Email sử dụng tên miền riêng của doanh nghiệp và tổ chức\r\nCloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.\r\nBảng giá trên chưa bao gốm 10% VAT', '<p>Việc kinh doanh của bạn dù lớn hay nhỏ đều phải cần Email, nhất là khi mà độ tin cậy của Email trở thành một trong những yếu tố quan trọng để bạn tiếp cận khách và giao dịch với khách hàng. Một thư tín không đến kịp lúc hay thất lạc đều có thể gây tổn hại đến doanh số hay xấu hơn là gây hiểu lầm giữa đôi bên.&nbsp;</p><p><b>Tạo sự tin cậy và chuyên nghiệp</b></p><p>Một email với đuôi tên miền website của bạn luôn luôn tạo sự tin cậy, sự chuyên nghiệp với đối tác của bạn</p><p><b>Giao diện thân thiện người dùng</b><br></p><p>Ngoài giao diện Desktop, WebMail có giao diện dành riêng qua điện thoại thông minh. Trình bày đơn giản, dễ thao tác tiết kiệm lưu lượng dữ liệu di động</p><p><b>Kiểm tra email mọi nơi mọi lúc</b><br></p><p>Thông qua tài khoản email của bạn tại BizMaC, bạn có thể dễ dàng kiểm tra quản lý các Email mọi lúc, mọi nơi qua internet</p><p><b>Đơn giản khi sử dụng</b><br></p><p>Gói Email sử dụng được hầu hết các phần mềm email như Outlook, Outlook Express, Webmail, Mobile</p>', '1593592270_phan-biet-cloud-email-va-email-thong-thuong.jpg', '1593592270_1519894405-cloudemail.png', '[\"1593592270_email-hosting.jpg\",\"1593592270_phan-biet-cloud-email-va-email-thong-thuong.jpg\",\"1593592270_unnamed(4).jpg\"]', NULL, NULL, 1, 7, 1, 1, '2020-07-01 08:31:10', '2020-07-01 08:32:52'),
(32, 'Giải pháp máy chủ dành cho doanh nghiệp nhỏ', 'Giải pháp máy chủ dành cho doanh nghiệp nhỏ:\r\nVới những tiềm lực mà điện toán đám mây (Cloud Computing) có thể mang lại, nhu cầu sử dụng server của các doanh nghiệp ngày càng tăng, nhất là đối với DN vừa và nhỏ. Chọn Server phù hợp với các doanh nghiệp vừa và nhỏ là điều đang được quan tâm rất nhiều.\r\n\r\nMáy chủ đối với doanh nghiệp\r\nNhờ có dịch vụ máy chủ, thay vì phải cài đặt một phần mềm ứng dụng nào đó lên từng máy tính trong công ty, các máy tính chỉ cần kết nối vào một mạng chung là có thể đồng bộ hóa tất cả. Khi cần lưu trữ một thông tin từ máy tính khác sẽ không cần dùng đến USB hay các thiết bị lưu trữ thông tin mà chỉ cần đưa lên server và cho biết nguồn truy cập là tất cả máy tính trong hệ thống có thể lấy thông tin dễ dàng. Việc xây dựng một hệ thống máy chủ trên nền công nghệ điện toán đám mây giúp ích rất nhiều cho các doanh nghiệp có quy mô vừa và nhỏ trong việc quản lý cũng như phát triển kinh doanh.\r\n\r\nĐảm bảo hoạt động hiệu quả\r\nMáy chủ có cấu hình mạnh cùng với khả năng nâng cấp cũng như mở rộng cao nên hoạt động bền bỉ và ổn định hơn, đảm bảo hoạt động của doanh nghiệp luôn luôn liên tục, không bị gián đoạn. Khi doanh nghiệp mở rộng hoạt động có thể dễ dàng nâng cấp máy chủ mà không tốn nhiều thời gian. Với hệ thống máy chủ ảo thì nhân viên trong doanh nghiệp có thể dễ dàng làm việc nhóm với nhau mà không cần phải có mặt đầy đủ các thành viên, từ đó tăng độ linh hoạt trong công việc và giúp tiết kiệm được rất nhiều thời gian. Khi có nhu cầu công việc cần được giải quyết nhanh chóng thì tất cả những thứ cần có là một  thiết bị công nghệ có khả năng kết nối mạng Internet là có thể giải quyết ổn thỏa.', '<p>Giải pháp máy chủ dành cho doanh nghiệp nhỏ:</p><p>Với những tiềm lực mà điện toán đám mây (Cloud Computing) có thể mang lại, nhu cầu sử dụng server của các doanh nghiệp ngày càng tăng, nhất là đối với DN vừa và nhỏ. Chọn Server phù hợp với các doanh nghiệp vừa và nhỏ là điều đang được quan tâm rất nhiều.</p><p><b>Máy chủ đối với doanh nghiệp</b><br></p><p>Nhờ có dịch vụ máy chủ, thay vì phải cài đặt một phần mềm ứng dụng nào đó lên từng máy tính trong công ty, các máy tính chỉ cần kết nối vào một mạng chung là có thể đồng bộ hóa tất cả. Khi cần lưu trữ một thông tin từ máy tính khác sẽ không cần dùng đến USB hay các thiết bị lưu trữ thông tin mà chỉ cần đưa lên server và cho biết nguồn truy cập là tất cả máy tính trong hệ thống có thể lấy thông tin dễ dàng. Việc xây dựng một hệ thống máy chủ trên nền công nghệ điện toán đám mây giúp ích rất nhiều cho các doanh nghiệp có quy mô vừa và nhỏ trong việc quản lý cũng như phát triển kinh doanh.</p><p><b>Đảm bảo hoạt động hiệu quả</b><br></p><p>Máy chủ có cấu hình mạnh cùng với khả năng nâng cấp cũng như mở rộng cao nên hoạt động bền bỉ và ổn định hơn, đảm bảo hoạt động của doanh nghiệp luôn luôn liên tục, không bị gián đoạn. Khi doanh nghiệp mở rộng hoạt động có thể dễ dàng nâng cấp máy chủ mà không tốn nhiều thời gian. Với hệ thống máy chủ ảo thì nhân viên trong doanh nghiệp có thể dễ dàng làm việc nhóm với nhau mà không cần phải có mặt đầy đủ các thành viên, từ đó tăng độ linh hoạt trong công việc và giúp tiết kiệm được rất nhiều thời gian. Khi có nhu cầu công việc cần được giải quyết nhanh chóng thì tất cả những thứ cần có là một&nbsp; thiết bị công nghệ có khả năng kết nối mạng Internet là có thể giải quyết ổn thỏa.</p>', '1593593064_server-cho-doanh-nghiep-vua-va-nho-1.JPG', '1593593064_server-cho-doanh-nghiep-vua-va-nho-3.png', '[\"1593593064_server-cho-doanh-nghiep-vua-va-nho-1.JPG\",\"1593593064_server-cho-doanh-nghiep-vua-va-nho-2.png\",\"1593593064_server-cho-doanh-nghiep-vua-va-nho-3.png\"]', NULL, NULL, 1, 8, 1, 1, '2020-07-01 08:44:24', '2020-07-01 08:46:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_prices`
--

CREATE TABLE `service_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_online` double(20,2) DEFAULT NULL,
  `price_online_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_offline` double(20,2) DEFAULT NULL,
  `price_offline_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_id` bigint(20) UNSIGNED NOT NULL,
  `updated_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `service_prices`
--

INSERT INTO `service_prices` (`id`, `service_id`, `name`, `avatar`, `content`, `price_online`, `price_online_type`, `price_offline`, `price_offline_type`, `created_id`, `updated_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cài đặt office (Trọn bộ)', '1592369883_office.jpg', NULL, 300000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-17 04:58:03', '2020-07-01 13:37:22'),
(2, 2, 'Cài đặt phần mềm thiết kế đồ hoạ', '1592371338_thietke.jpg', NULL, 500000.00, 'price', 700000.00, 'price', 1, NULL, 1, '2020-06-17 05:22:18', NULL),
(3, 3, 'Kiểm tra bảo mật máy tính', '1593402668_firewall2.jpg', NULL, 100000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 03:51:08', NULL),
(4, 4, 'Máy tính không kết nối được Wifi', '1593403305_wifi.jpg', NULL, 100000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-29 04:01:45', '2020-06-29 04:15:06'),
(5, 5, 'Bàn phím lỗi (Bad keyboard)', '1593403603_phim3.jpg', NULL, 100000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-29 04:06:43', '2020-06-29 04:06:59'),
(6, 5, 'Bàn phím lỗi (Bad keyboard)', '1593403603_phim3.jpg', NULL, 100000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 04:06:59', NULL),
(7, 6, '(Hỗ trợ) Máy tính bị treo, bị đơ, bị chạm:', '1593403891_122_anh_1.png', NULL, 200000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 04:11:31', NULL),
(8, 4, 'Máy tính không kết nối được Wifi', '1593403305_wifi.jpg', NULL, 100000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 04:15:06', NULL),
(9, 7, 'Bảo trì máy tính bàn, laptop, Mac, iMac', '1593412884_it-support-services.png', NULL, 100000.00, 'price', 250000.00, 'price', 1, NULL, 1, '2020-06-29 06:41:24', NULL),
(10, 8, 'Dịch vụ bảo trì hệ thống mạng', '1593413097_hệ-thống.jpg', NULL, 300000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 06:44:57', NULL),
(11, 9, 'Quản Trị Máy Chủ tại Doanh Nghiệp', '1593413399_quanservermaychu1.png', NULL, 700000.00, 'price', 1500000.00, 'price', 1, NULL, 1, '2020-06-29 06:49:59', NULL),
(12, 10, 'Camera, máy chấm công', '1593413694_goi-camera-tan-binh.jpg', NULL, 50000.00, 'price', 500000.00, 'price', 1, NULL, 0, '2020-06-29 06:54:54', '2020-06-29 06:55:28'),
(13, 10, 'Camera, máy chấm công', '1593413694_goi-camera-tan-binh.jpg', NULL, 50000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 06:55:28', NULL),
(14, 11, 'Dịch vụ máy in, photocopy', '1593413969_18338_p2035_ce461a_ha4.jpg', NULL, 0.00, 'price', 0.00, 'price', 1, NULL, 1, '2020-06-29 06:59:29', NULL),
(15, 12, '200000', '1593414200_tong-dai-ao.jpg', NULL, NULL, 'price', 500000.00, 'price', 1, NULL, 1, '2020-06-29 07:03:20', NULL),
(16, 13, 'Dịch vụ bảo trì hệ thống mạng – Maintenance Services', '1593414989_Lan.jpg', NULL, 500000.00, 'price', 1200000.00, 'price', 1, NULL, 1, '2020-06-29 07:16:29', NULL),
(17, 14, 'Thi công hệ thống mạng', '1593415441_thi-cong-mang-lan-van-phong-5.jpg', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-06-29 07:24:01', NULL),
(18, 15, 'Quản Trị Máy Chủ', '1593415669_quan-tri-may-chu.jpg', NULL, 1500000.00, 'price', 1500000.00, 'price', 1, NULL, 1, '2020-06-29 07:27:49', NULL),
(19, 16, 'Quản trị máy chủ phần mềm kế toán', '1593416124_unnamed.png', NULL, 500000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-29 07:35:24', '2020-06-29 07:39:58'),
(20, 17, 'Quản trị máy chủ Email Server', '1593416333_email-server.png', NULL, 1500000.00, 'price', 1500000.00, 'price', 1, NULL, 1, '2020-06-29 07:38:53', NULL),
(21, 16, 'Quản trị máy chủ phần mềm kế toán', '1593416124_unnamed.png', NULL, 500000.00, 'price', NULL, 'price', 1, NULL, 0, '2020-06-29 07:39:45', '2020-06-29 07:39:58'),
(22, 16, 'Quản trị máy chủ phần mềm kế toán', '1593416124_unnamed.png', NULL, 500000.00, 'price', NULL, 'price', 1, NULL, 1, '2020-06-29 07:39:58', NULL),
(23, 18, 'Quản trị máy chủ ERP', '1593427010_erp1.jpg', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-06-29 10:36:50', NULL),
(24, 19, 'Quản trị máy chủ Database', NULL, NULL, 2500000.00, 'price', 2500000.00, 'price', 1, NULL, 0, '2020-06-29 10:40:30', '2020-06-29 10:40:45'),
(25, 19, 'Quản trị máy chủ Database', 'uploads', NULL, 2500000.00, 'price', 2500000.00, 'price', 1, NULL, 1, '2020-06-29 10:40:45', NULL),
(26, 20, 'Quản trị máy chủ Website', '1593427381_web-server.png', NULL, 2000000.00, 'price', 2000000.00, 'price', 1, NULL, 1, '2020-06-29 10:43:01', NULL),
(27, 21, 'Tư vấn hệ thống Wifi Mesh', '1593486988_Nen-chon-wifi-extender-hay-mesh-wifi.jpg', NULL, NULL, 'deal', NULL, NULL, 1, NULL, 0, '2020-06-30 03:16:28', '2020-06-30 03:16:47'),
(28, 21, 'Tư vấn hệ thống Wifi Mesh', '1593486988_Nen-chon-wifi-extender-hay-mesh-wifi.jpg', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-06-30 03:16:47', NULL),
(29, 22, 'Wifi Marketing', '1593487315_WiFi-Marketing-toc-do-nhanh.jpg', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-06-30 03:21:55', NULL),
(30, 23, 'Dịch vụ WiFi công cộng ngoài trời', '1593487553_wifi-041214-1417659408401.jpg', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-06-30 03:25:53', NULL),
(31, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', NULL, NULL, 2500000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(32, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 2000000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(33, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 4500000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(34, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 4000000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(35, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 7500000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(36, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'input', NULL, NULL, 1, NULL, 0, '2020-06-30 03:43:30', '2020-06-30 04:28:21'),
(37, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 03:46:51', '2020-06-30 04:28:21'),
(38, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:46:51', '2020-06-30 04:28:21'),
(39, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 03:46:51', '2020-06-30 04:28:21'),
(40, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:46:51', '2020-06-30 04:28:21'),
(41, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 03:46:51', '2020-06-30 04:28:21'),
(42, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 03:46:51', '2020-06-30 04:28:21'),
(43, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 03:48:22', '2020-06-30 04:28:21'),
(44, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:48:22', '2020-06-30 04:28:21'),
(45, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 03:48:22', '2020-06-30 04:28:21'),
(46, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:48:22', '2020-06-30 04:28:21'),
(47, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 03:48:22', '2020-06-30 04:28:21'),
(48, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 03:48:22', '2020-06-30 04:28:21'),
(49, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 03:50:26', '2020-06-30 04:28:21'),
(50, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:50:26', '2020-06-30 04:28:21'),
(51, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 03:50:26', '2020-06-30 04:28:21'),
(52, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:50:26', '2020-06-30 04:28:21'),
(53, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 03:50:26', '2020-06-30 04:28:21'),
(54, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 03:50:26', '2020-06-30 04:28:21'),
(55, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 03:51:56', '2020-06-30 04:28:21'),
(56, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:51:56', '2020-06-30 04:28:21'),
(57, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 03:51:56', '2020-06-30 04:28:21'),
(58, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 03:51:56', '2020-06-30 04:28:21'),
(59, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 03:51:56', '2020-06-30 04:28:21'),
(60, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 03:51:56', '2020-06-30 04:28:21'),
(61, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(62, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(63, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(64, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(65, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(66, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(67, 24, 'Nâng cấp SSD 480GB Samsung', '1593489751_316d615b51b7c963cd2fca9cb6c7e871.jpg', NULL, 300000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(68, 24, 'Nâng cấp thêm 16GB Ram ECC', '1593489751_b35ca3186eeb913f793d966570e9e974&hangmaytinh.com.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(69, 24, 'Phí  nâng cấp 100Mbps trong nước', '1593489751_internet-1-1592180180167.jpg', NULL, 2000000.00, 'price', NULL, 'deal', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(70, 24, 'Phí nâng cấp 1Mbps quốc tế', '1593489751_internet-1-1592180180167.jpg', NULL, 1800000.00, 'price', NULL, 'deal', 1, NULL, 0, '2020-06-30 04:02:31', '2020-06-30 04:28:21'),
(71, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(72, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(73, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(74, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(75, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(76, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(77, 24, 'Nâng cấp SSD 480GB Samsung', '1593489751_316d615b51b7c963cd2fca9cb6c7e871.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(78, 24, 'Nâng cấp thêm 16GB Ram ECC', '1593489751_b35ca3186eeb913f793d966570e9e974&hangmaytinh.com.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(79, 24, 'Phí  nâng cấp 100Mbps trong nước', '1593489751_internet-1-1592180180167.jpg', NULL, 2000000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(80, 24, 'Phí nâng cấp 1Mbps quốc tế', '1593489751_internet-1-1592180180167.jpg', NULL, 1800000.00, 'price', 1800000.00, 'price', 1, NULL, 0, '2020-06-30 04:03:42', '2020-06-30 04:28:21'),
(81, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(82, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(83, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(84, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(85, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(86, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(87, 24, 'Nâng cấp SSD 480GB Samsung', '1593489751_316d615b51b7c963cd2fca9cb6c7e871.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(88, 24, 'Nâng cấp thêm 16GB Ram ECC', '1593489751_b35ca3186eeb913f793d966570e9e974&hangmaytinh.com.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(89, 24, 'Phí  nâng cấp 100Mbps trong nước', '1593489751_internet-1-1592180180167.jpg', NULL, 2000000.00, 'price', 2000000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(90, 24, 'Phí nâng cấp 1Mbps quốc tế', '1593489751_internet-1-1592180180167.jpg', NULL, 1800000.00, 'price', 1800000.00, 'price', 1, NULL, 0, '2020-06-30 04:04:57', '2020-06-30 04:28:21'),
(91, 25, 'HP G8 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593491022_HP1.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(92, 25, 'HP G9 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593491022_HP1.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(93, 25, 'HP G10 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593491022_HP1.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(94, 25, 'Nâng cấp SSD 480GB Samsung', '1593491022_316d615b51b7c963cd2fca9cb6c7e871.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(95, 25, 'Nâng cấp thêm 16GB Ram ECC', '1593491022_b35ca3186eeb913f793d966570e9e974&hangmaytinh.com.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(96, 25, 'Phí  nâng cấp 100Mbps trong nước', '1593491022_internet-1-1592180180167.jpg', NULL, 2000000.00, 'price', 2000000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(97, 25, 'Phí nâng cấp 1Mbps quốc tế', '1593491022_internet-1-1592180180167.jpg', NULL, 1800000.00, 'price', 1800000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(98, 25, 'Nâng cấp thêm Xeon Silver 4210', '1593491022_15066999862048.jpg', NULL, 1500000.00, 'price', 1500000.00, 'price', 1, NULL, 1, '2020-06-30 04:23:42', NULL),
(99, 24, 'Dell R620 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488811_maychuhanoi-image-1462666028.jpg', NULL, 2500000.00, 'price', 2000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(100, 24, 'Dell R630 (2 x E5-2670V3/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(101, 24, 'Dell R640 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 6500000.00, 'price', 6000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(102, 24, 'Dell R720 (2 x E5-2620/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 3500000.00, 'price', 3000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(103, 24, 'Dell R730 (2 x E5-2670V2/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 5500000.00, 'price', 5000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(104, 24, 'Dell R740 (Xeon Silver 4210/2 x 480GB SSD/ 16GB Ram/BW 100Mbps, 10Mbps)', '1593488610_maychuhanoi-image-1462666028.jpg', NULL, 8500000.00, 'price', 8000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(105, 24, 'Nâng cấp SSD 480GB Samsung', '1593489751_316d615b51b7c963cd2fca9cb6c7e871.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(106, 24, 'Nâng cấp thêm 16GB Ram ECC', '1593489751_b35ca3186eeb913f793d966570e9e974&hangmaytinh.com.jpg', NULL, 300000.00, 'price', 300000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(107, 24, 'Phí  nâng cấp 100Mbps trong nước', '1593489751_internet-1-1592180180167.jpg', NULL, 2000000.00, 'price', 2000000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(108, 24, 'Phí nâng cấp 1Mbps quốc tế', '1593489751_internet-1-1592180180167.jpg', NULL, 1800000.00, 'price', 1800000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(109, 24, 'Nâng cấp thêm Xeon Silver 4210', '1593491301_15066999862048.jpg', NULL, 1500000.00, 'price', 1500000.00, 'price', 1, NULL, 1, '2020-06-30 04:28:21', NULL),
(110, 26, 'Dell latitude 3400_L3400-i58265U-4-500G', '1593578570_201405261501286935_Hinh-11.jpg', 'Intel Core i5-8265U (6M Cache, up to 3.90 GHz)/Intel UHD 620 Graphics / 14.0\" HD (1366x768) /4GB DDR4/ 2.5\" 500GB/Camera. Wireless AC 9560, Bluetooth/ 3 Cell /Windows 10 Pro (64bit)', 500000.00, 'price', 500000.00, 'price', 1, NULL, 0, '2020-07-01 04:42:50', '2020-07-01 04:49:18'),
(111, 26, 'Dell latitude 3500_L3500-i58265U-4-1T', '1593578570_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i5-8265U(6M Cache, up to 3.90 GHz)/ Intel UHD 620 Graphics  /15.6\" HD (1366 x 768)/4GB, DDR4/ 2.5\" 1T Camera. Wireless AC 9560, Bluetooth/ 3 Cell /Ubuntu Linux 18.04/', 500000.00, 'price', 500000.00, 'price', 1, NULL, 0, '2020-07-01 04:42:50', '2020-07-01 04:49:18'),
(112, 26, 'Dell latitude 3400_L3400-i58265U-4-500G', '1593578570_201405261501286935_Hinh-11.jpg', 'Intel Core i5-8265U (6M Cache, up to 3.90 GHz)/Intel UHD 620 Graphics / 14.0\" HD (1366x768) /4GB DDR4/ 2.5\" 500GB/Camera. Wireless AC 9560, Bluetooth/ 3 Cell /Windows 10 Pro (64bit)', 500000.00, 'price', 500000.00, 'price', 1, NULL, 0, '2020-07-01 04:46:49', '2020-07-01 04:49:18'),
(113, 26, 'Dell latitude 3500_L3500-i58265U-4-1T', '1593578570_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i5-8265U(6M Cache, up to 3.90 GHz)/ Intel UHD 620 Graphics  /15.6\" HD (1366 x 768)/4GB, DDR4/ 2.5\" 1T Camera. Wireless AC 9560, Bluetooth/ 3 Cell /Ubuntu Linux 18.04/', 500000.00, 'price', 500000.00, 'price', 1, NULL, 0, '2020-07-01 04:46:49', '2020-07-01 04:49:18'),
(114, 26, 'Dell Latitude 3510_ L3510-i510210U-4-1TB-Fedora-U-1Y', '1593578809_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i5-10210U (4 Core, 6M cache, base 1.6GHz, up to4.2GHz)/ 15.6\" HD (1366 x 768) , Cam & Mic /4GB DDR4  / 1TB 2.5\"  /3 Cell / Fedora Linux/ 1 Keep Your HDD+ 1Y Pro', 500000.00, 'price', 500000.00, 'price', 1, NULL, 0, '2020-07-01 04:46:49', '2020-07-01 04:49:18'),
(115, 26, 'Dell latitude 5500 -L5500-i78665U-8-256G-W10P-U-1Y', '1593578809_201405261501286935_Hinh-11.jpg', 'Intel Core i7-8665U Processor (8MB Cache,1.9GHz) /15.6\" FHD WVA (1920 x 1080),Camera & Mic,/8GB, 1x8GB, DDR4 Non-ECC /M.2 256GB SATA /Wireless AC 9560 (802.11ac) 2x2 + Bluetooth 5.0/4 Cell /Windows 10 Pro (64bit) English/1Yr Keep Your Hard Drive/ 1Yr ProSupport.', 1500000.00, 'price', 1500000.00, 'price', 1, NULL, 0, '2020-07-01 04:46:49', '2020-07-01 04:49:18'),
(116, 26, 'Dell latitude 7300', '1593578809_16825-laptop-dell-inspiron-n5593a-p90f002-1.jpg', 'Intel Core i5-8265U Processor (4MB Cache,1.6GHz)/13.3\" FHD (1920 x 1080) / Camera &Mic/8GB, 1x8GB, DDR4/ M.2 256GB PCIe NVMe/Wireless QCA61x4A 802.11ac + Bluetooth 4.2/4 cell,/Ubuntu Linux 18.4/1 Yr Keep Your Hard Drive/ 3Yr ProSupport.', 1600000.00, 'price', 1600000.00, 'price', 1, NULL, 0, '2020-07-01 04:46:49', '2020-07-01 04:49:18'),
(117, 26, 'Dell latitude 3301', '1593578809_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i7-8665U Processor (8MB Cache,1.9GHz) /13.3\" FHD (1920 x 1080)/ Camera &Mic/8GB, 1x8GB, DDR4/ M.2 256GB PCIe/Wireless + Bluetooth /4 cell,/Windows 10 Pro/1 Yr Keep Your Hard Drive/ 3Yr ProSupport.', 1400000.00, 'price', 1400000.00, 'price', 1, NULL, 0, '2020-07-01 04:46:49', '2020-07-01 04:49:18'),
(118, 26, 'Dell latitude 3400_L3400-i58265U-4-500G', '1593578570_201405261501286935_Hinh-11.jpg', 'Intel Core i5-8265U (6M Cache, up to 3.90 GHz)/Intel UHD 620 Graphics / 14.0\" HD (1366x768) /4GB DDR4/ 2.5\" 500GB/Camera. Wireless AC 9560, Bluetooth/ 3 Cell /Windows 10 Pro (64bit)', 500000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-07-01 04:49:18', NULL),
(119, 26, 'Dell latitude 3500_L3500-i58265U-4-1T', '1593578570_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i5-8265U(6M Cache, up to 3.90 GHz)/ Intel UHD 620 Graphics  /15.6\" HD (1366 x 768)/4GB, DDR4/ 2.5\" 1T Camera. Wireless AC 9560, Bluetooth/ 3 Cell /Ubuntu Linux 18.04/', 500000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-07-01 04:49:18', NULL),
(120, 26, 'Dell Latitude 3510_ L3510-i510210U-4-1TB-Fedora-U-1Y', '1593578809_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i5-10210U (4 Core, 6M cache, base 1.6GHz, up to4.2GHz)/ 15.6\" HD (1366 x 768) , Cam & Mic /4GB DDR4  / 1TB 2.5\"  /3 Cell / Fedora Linux/ 1 Keep Your HDD+ 1Y Pro', 500000.00, 'price', 500000.00, 'price', 1, NULL, 1, '2020-07-01 04:49:18', NULL),
(121, 26, 'Dell latitude 5500 -L5500-i78665U-8-256G-W10P-U-1Y', '1593578809_201405261501286935_Hinh-11.jpg', 'Intel Core i7-8665U Processor (8MB Cache,1.9GHz) /15.6\" FHD WVA (1920 x 1080),Camera & Mic,/8GB, 1x8GB, DDR4 Non-ECC /M.2 256GB SATA /Wireless AC 9560 (802.11ac) 2x2 + Bluetooth 5.0/4 Cell /Windows 10 Pro (64bit) English/1Yr Keep Your Hard Drive/ 1Yr ProSupport.', 1500000.00, 'price', 1500000.00, 'price', 1, NULL, 1, '2020-07-01 04:49:18', NULL),
(122, 26, 'Dell latitude 7300', '1593578809_16825-laptop-dell-inspiron-n5593a-p90f002-1.jpg', 'Intel Core i5-8265U Processor (4MB Cache,1.6GHz)/13.3\" FHD (1920 x 1080) / Camera &Mic/8GB, 1x8GB, DDR4/ M.2 256GB PCIe NVMe/Wireless QCA61x4A 802.11ac + Bluetooth 4.2/4 cell,/Ubuntu Linux 18.4/1 Yr Keep Your Hard Drive/ 3Yr ProSupport.', 1600000.00, 'price', 1600000.00, 'price', 1, NULL, 1, '2020-07-01 04:49:18', NULL),
(123, 26, 'Dell latitude 3301', '1593578809_10019814-LAPTOP-DELL-INSPIRON-14-3442-_062GW2_-01.jpg', 'Intel Core i7-8665U Processor (8MB Cache,1.9GHz) /13.3\" FHD (1920 x 1080)/ Camera &Mic/8GB, 1x8GB, DDR4/ M.2 256GB PCIe/Wireless + Bluetooth /4 cell,/Windows 10 Pro/1 Yr Keep Your Hard Drive/ 3Yr ProSupport.', 1400000.00, 'price', 1400000.00, 'price', 1, NULL, 1, '2020-07-01 04:49:18', NULL),
(124, 27, 'Dell Precision Tower 3430 CTO', '1593579477_1476_PDP_Precision_Tower_5820_01.jpg.webp', '• Processor : Intel Xeon E-2124G, 4 Core HT, 8MB Cache, 3.3Ghz, 4.3GHz Turbo • Ram : 8GB 2x4GB 2666MHz DDR4 • HDD: 1T • Graphics :NVIDIA Quadro P620, 2GB, 4 mDP, HDMI• Optical Drive :8x DVD+/-RW• Nic: Intel Ethernet Connection I219-LM 10/100/1000 • Dell optical Mouse & Keyboard', 2200000.00, 'price', 2200000.00, 'price', 1, NULL, 1, '2020-07-01 04:57:57', NULL),
(125, 27, 'Precision 5820 Tower XCTO Base', '1593579477_Dell-Precision-T7920-Workstation-Main.jpg', '* Processor: Intel Xeon W-2123 3.6GHz, 3.9GHz Turbo, 4C, 8.25M Cache, HT, (120W) * Ram: 16GB (2x8GB) 2666MHz DDR4 RDIMM ECC* Hard Drive:  3.5\" 1TB 7200rpm SATA Hard Drive/ Integrated Intel AHCI SATA chipset controller (8x 6.0Gb/s), SW RAID 0,1,5,10/* Optical Driver: 8X DVD+/-RW Slimline * Graphics: NVIDIA Quadro P600, 2GB, 4 mDP (5820T)/ Dell Optical Mouse MS116 Black/ Dell Multimedia Keyboard KB216 Black (English)/ Windows 10 Pro for Workstations (up to 4 Cores) English/ 3Yr Keep Your Hard Drive-VN,PK,PH,BN,SL,BD / 3Yr ProSupport', 3500000.00, 'price', 3500000.00, 'price', 1, NULL, 1, '2020-07-01 04:57:57', NULL),
(126, 27, 'Dell Precision Tower 3630 CTO BASE', '1593579477_Dell-Precision-T7920-Workstation-Main.jpg', '• Processor : Intel Xeon E-2146G, 6 Core HT, 12MB Cache, 3.5GHz, 4.5Ghz Turbo • Mainboard : Intel® C246 Chipset • Ram : 16GB (2x8GB) 2666MHz DDR4• Hard Drive : 3.5 inch 2TB 7200rpm SATA • Graphics :NVIDIA Quadro P2200, 5GB, 4 DP, HDMI • Optical Drive :8x DVD+/-RW • Nic : Intel Ethernet Connection I219-LM 10/100/1000   • Dell Optical Mouse & Keyboard  • OS : Fedora• Waranty : 3 year Prosupport• C/O :  Malaysia', 3000000.00, 'price', 3000000.00, 'price', 1, NULL, 1, '2020-07-01 04:57:57', NULL),
(127, 27, 'Precision 7820 Tower XCTO Base', '1593579477_201405261501286935_Hinh-11.jpg', '• Processor: Intel Xeon Bronze 3104 1.7GHz, 6C, 9.6GT/s 2UPI, 8M Cache *Ram: 16GB (2x8GB) 2666MHz DDR4 RDIMM ECC *HDD: 3.5\" 2TB 7200rpm SATA / *Raid: SW RAID 0,1,5,10 *Optical:  8X DVD-ROM Slimline *Rraphics: NVIDIA Quadro P2000, 5GB, 4 DP (7X20T) / Dell Optical Mouse MS116 Black/ Dell Multimedia Keyboard KB216 Black (English) /Unbutu/3Yr Keep Your Hard Drive / 3Yr ProSupport', 4500000.00, 'price', 4500000.00, 'price', 1, NULL, 1, '2020-07-01 04:57:57', NULL),
(128, 28, 'Cloud N1: 1vCPU,20GB,2GB', '1593589283_cloud-server.png', '1vCPU E5 – 2600 V4 / 20GB SSD S3 Storage / 2GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 350000.00, 'price', 350000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(129, 28, 'Cloud N2: 2vCPU,40GB,4GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '2vCPU E5 – 2600 V4 / 40GB SSD S3 Storage / 4GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 650000.00, 'price', 650000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(130, 28, 'Cloud N3: 4vCPU,60GB,6GB', '1593589283_6-920x720.png', '4vCPU E5 – 2600 V4 / 60GB SSD S3 Storage / 6GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 10500000.00, 'price', 10500000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(131, 28, 'Cloud N4: 6vCPU,100GB,10GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '6vCPU E5 – 2600 V4 / 100GB SSD S3 Storage / 10GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 1550000.00, 'price', 1550000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(132, 28, 'Cloud N5: 8vCPU,150GB,12GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '8vCPU E5 – 2600 V4 / 150GB SSD S3 Storage / 12GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 1800000.00, 'price', 1800000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(133, 28, 'Cloud N6: 10vCPU,250GB,16GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '10vCPU E5 – 2600 V4 / 250GB SSD S3 Storage / 16GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 2500000.00, 'price', 2500000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(134, 28, 'Nâng cấp Ram 2GB', '1593589283_cloud.png', 'Add thêm 2GB bộ nhớ Ram vào cụm Cloud', 200000.00, 'price', 200000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(135, 28, 'Tăng thêm 20GB S3 Storage', '1593589283_cloud.png', 'Add thêm 20GB S3 Storage', 300000.00, 'price', 300000.00, 'price', 1, NULL, 0, '2020-07-01 07:41:23', '2020-07-01 07:42:31'),
(136, 28, 'Cloud N1: 1vCPU,20GB,2GB', '1593589283_cloud-server.png', '1vCPU E5 – 2600 V4 / 20GB SSD S3 Storage / 2GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 350000.00, 'price', 350000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(137, 28, 'Cloud N2: 2vCPU,40GB,4GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '2vCPU E5 – 2600 V4 / 40GB SSD S3 Storage / 4GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 650000.00, 'price', 650000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(138, 28, 'Cloud N3: 4vCPU,60GB,6GB', '1593589283_6-920x720.png', '4vCPU E5 – 2600 V4 / 60GB SSD S3 Storage / 6GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 1050000.00, 'price', 1050000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(139, 28, 'Cloud N4: 6vCPU,100GB,10GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '6vCPU E5 – 2600 V4 / 100GB SSD S3 Storage / 10GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 1550000.00, 'price', 1550000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(140, 28, 'Cloud N5: 8vCPU,150GB,12GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '8vCPU E5 – 2600 V4 / 150GB SSD S3 Storage / 12GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 1800000.00, 'price', 1800000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(141, 28, 'Cloud N6: 10vCPU,250GB,16GB', '1593589283_cloud-server-la-may-chu-ao-hoat-dong-dua-tren-nen-tang-cloud-computing.jpg', '10vCPU E5 – 2600 V4 / 250GB SSD S3 Storage / 16GB Ram Dedicated / 100Mbps BW trong nước 10Mbps BW quốc tế / Support Tel/email/zalo', 2500000.00, 'price', 2500000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(142, 28, 'Nâng cấp Ram 2GB', '1593589283_cloud.png', 'Add thêm 2GB bộ nhớ Ram vào cụm Cloud', 200000.00, 'price', 200000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(143, 28, 'Tăng thêm 20GB S3 Storage', '1593589283_cloud.png', 'Add thêm 20GB S3 Storage', 300000.00, 'price', 300000.00, 'price', 1, NULL, 1, '2020-07-01 07:42:31', NULL),
(144, 29, 'Cloud Backup #1 500GB', '1593590588_desk_CB-trimmed.png', 'Giải pháp của NetVAS mang đến tính sẵn sàng cao cho dữ liệu, cho phép khôi phục tức thời, không cần mất hàng giờ để kiểm tra tính toàn vẹn dữ liệu.', 950000.00, 'price', 950000.00, 'price', 1, NULL, 1, '2020-07-01 08:03:08', NULL),
(145, 29, 'Cloud Backup #2 1,000GB', '1593590588_cloud-backup_orig.jpg', 'Giải pháp của NetVAS mang đến tính sẵn sàng cao cho dữ liệu, cho phép khôi phục tức thời, không cần mất hàng giờ để kiểm tra tính toàn vẹn dữ liệu.', 1650000.00, 'price', 1650000.00, 'price', 1, NULL, 1, '2020-07-01 08:03:08', NULL),
(146, 29, 'Cloud Backup #3 2,000GB', '1593590588_local-backup-vs-remote-backup-in-kansas-city-1-638.jpg', 'Giải pháp của NetVAS mang đến tính sẵn sàng cao cho dữ liệu, cho phép khôi phục tức thời, không cần mất hàng giờ để kiểm tra tính toàn vẹn dữ liệu.', 3200000.00, 'price', 3200000.00, 'price', 1, NULL, 1, '2020-07-01 08:03:08', NULL),
(147, 29, 'Cloud Backup #4 5,000GB', '1593590588_datacentrix-backup-recovery.jpg', 'Giải pháp của NetVAS mang đến tính sẵn sàng cao cho dữ liệu, cho phép khôi phục tức thời, không cần mất hàng giờ để kiểm tra tính toàn vẹn dữ liệu.', 7800000.00, 'price', 7800000.00, 'price', 1, NULL, 1, '2020-07-01 08:03:08', NULL),
(148, 29, 'Cloud Backup #5 10,000GB', '1593590588_desk_CB-trimmed.png', 'Giải pháp của NetVAS mang đến tính sẵn sàng cao cho dữ liệu, cho phép khôi phục tức thời, không cần mất hàng giờ để kiểm tra tính toàn vẹn dữ liệu.', 16000000.00, 'price', 16000000.00, 'price', 1, NULL, 1, '2020-07-01 08:03:08', NULL),
(149, 30, 'Thuê dịch vụ CND', '1593591472_CDN.png', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-07-01 08:17:52', NULL),
(150, 31, 'Net Basic: 20User (20GB)', '1593592271_email-hosting.jpg', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 180000.00, 'price', 180000.00, 'price', 1, NULL, 0, '2020-07-01 08:31:11', '2020-07-01 08:32:52'),
(151, 31, 'Net Basic: 30User (30GB)', '1593592271_1519894405-cloudemail.png', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 350000.00, 'price', 350000.00, 'price', 1, NULL, 0, '2020-07-01 08:31:11', '2020-07-01 08:32:52'),
(152, 31, 'Net Basic: 50User (50GB)', '1593592271_phan-biet-cloud-email-va-email-thong-thuong.jpg', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 550000.00, 'price', 550000.00, 'price', 1, NULL, 0, '2020-07-01 08:31:11', '2020-07-01 08:32:52'),
(153, 31, 'Net Basic: 100User (100GB)', '1593592271_phan-biet-cloud-email-va-email-thong-thuong.jpg', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 850000.00, 'price', 850000.00, 'price', 1, NULL, 0, '2020-07-01 08:31:11', '2020-07-01 08:32:52'),
(154, 31, 'Net Basic: 20User (20GB)', '1593592271_email-hosting.jpg', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 180000.00, 'price', 180000.00, 'price', 1, NULL, 1, '2020-07-01 08:32:52', NULL),
(155, 31, 'Net Plus: 30User (30GB)', '1593592271_1519894405-cloudemail.png', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 350000.00, 'price', 350000.00, 'price', 1, NULL, 1, '2020-07-01 08:32:52', NULL),
(156, 31, 'Net Advanced: 50User (50GB)', '1593592271_phan-biet-cloud-email-va-email-thong-thuong.jpg', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 550000.00, 'price', 550000.00, 'price', 1, NULL, 1, '2020-07-01 08:32:52', NULL),
(157, 31, 'Net Professional: 100User (100GB)', '1593592271_phan-biet-cloud-email-va-email-thong-thuong.jpg', 'Cloud Email theo tên miền riêng john@tencongty.com. Hiệu quả với chi phí thấp nhất.', 850000.00, 'price', 850000.00, 'price', 1, NULL, 1, '2020-07-01 08:32:52', NULL),
(158, 32, 'Tư vấn giải pháp máy chủ', '1593593064_server-cho-doanh-nghiep-vua-va-nho-1.JPG', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 0, '2020-07-01 08:44:24', '2020-07-01 08:46:47'),
(159, 32, 'Tư vấn giải pháp máy chủ', '1593593064_server-cho-doanh-nghiep-vua-va-nho-1.JPG', NULL, NULL, 'deal', NULL, 'deal', 1, NULL, 1, '2020-07-01 08:46:47', NULL),
(160, 1, 'Cài đặt office (Trọn bộ)', '1592369883_office.jpg', NULL, 300000.00, 'price', NULL, 'price', 1, NULL, 0, '2020-07-01 13:23:51', '2020-07-01 13:37:22'),
(161, 1, 'Cài đặt office (Trọn bộ)', '1592369883_office.jpg', NULL, 300000.00, 'price', NULL, 'price', 1, NULL, 1, '2020-07-01 13:37:22', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `code`, `type`, `value`, `created_at`) VALUES
(1, 'expires_token', 'system', '7', '2020-05-28 09:39:18'),
(2, 'need_login', 'system', 'off', '2020-05-28 09:39:18'),
(3, 'is_maintenance', 'system', 'off', '2020-05-28 09:39:18'),
(4, 'onesignal_user_id', 'user', NULL, '2020-05-28 09:39:18'),
(5, 'fcm_token', 'user', NULL, '2020-05-30 03:47:29'),
(6, 'notification_status', 'user', NULL, '2020-06-04 08:30:26'),
(8, 'language', 'user', NULL, '2020-06-06 03:08:38'),
(9, 'transfer_text', 'system', 'Nội dung chuyển khoản : [booking_code] + [customer_name]\r\n\r\nThông tin chuyển khoản cá nhân\r\nNgân hàng : Vietcombank - Chi nhánh Bến Thành\r\nSố tài khoản: 0071003273172\r\nChủ tài khoản: NGUYEN NGOC TRUNG\r\nChức vụ: Giám đốc\r\n\r\nThông tin chuyển khoản công ty:\r\nNgân hàng : Vietcombank - Chi nhánh Phú Nhuận\r\nSố tài khoản: 0921000728056\r\nChủ tài khoản: CTY TNHH NETVAS', '2020-06-08 05:48:25'),
(10, 'phone', 'system', '028-77792969', '2020-06-11 06:31:42'),
(11, 'email', 'system', 'Email: info@netvas.vn', '2020-06-11 06:31:55'),
(12, 'maintenance_text', 'system', 'Nội dung bảo trì 2', '2020-07-01 09:27:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `address`, `phone`, `email_verified_at`, `password`, `group_id`, `token`, `city_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'https://support.netvas.vn/assets/media/users/default.jpg', 'Uvvuvvuuvvy', '0909090909', NULL, '$2y$10$uQLVJgKjvZn8yXpOTguGeuQ.zSr7DJjfY5jWbjeOTH9G0bcus4WzG', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xOTIuMTY4LjEuNDRcL25ldHZhc1wvcHVibGljXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNTk0MTE2MzUxLCJleHAiOjE1OTUzMjU5NTEsIm5iZiI6MTU5NDExNjM1MSwianRpIjoicUJoR0VQc1Y2SGVMaTdjMiIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.nTKNmNCZ_aO8wmAIobKpDX8hkpwY23uLifMMSGe3B4c', 1, NULL, '2020-06-17 04:25:22', '2020-07-07 10:05:51'),
(2, 'Vũ Hoàng Lĩnh', 'vlinh12300@gmail.com', NULL, NULL, '0902411129', NULL, '$2y$10$LGWi6R1nDIvWz.DOzA7hB.GNTcW5lD7i6ZjemOEKM.SiEiHyYpHyW', 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc3VwcG9ydC5uZXR2YXMudm5cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTM1OTI1NDYsImV4cCI6MTU5NDgwMjE0NiwibmJmIjoxNTkzNTkyNTQ2LCJqdGkiOiJHWEEzdXBJdjlDMXU0dXhYIiwic3ViIjoyLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Q7pc8A2eVKBgdlQQDZL9IxZj8mGs0vHUYbFSHEoB9bo', 1, NULL, '2020-06-17 06:14:23', '2020-07-01 08:35:46'),
(3, 'test01', 'test01@gmail.com', NULL, 'hoa mai', '0379721811', NULL, '$2y$10$sH3CG2JEjID5FHWzvqKNg.z6rNB99O7t8f5D6qbphVxKxYX7gLolq', 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc3VwcG9ydC5uZXR2YXMudm5cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTI5Mzg3NDIsImV4cCI6MTU5NDE0ODM0MiwibmJmIjoxNTkyOTM4NzQyLCJqdGkiOiJxS1lyV1pUdUF0V1VkMlk1Iiwic3ViIjozLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0._ezPeHsSaN0tbZ6VXrHj4WIJ9x34YAevH1SxHf2sIbc', 1, NULL, '2020-06-22 09:54:44', '2020-06-23 18:59:02'),
(4, 'dasdas', 'dsadkasj@gmail.com', NULL, 'dsadasdsa', '0909090931', NULL, '$2y$10$NuHZWl.gzsCxiyt5Td4S2evB1HtpEyqPD562kCuICYFXXksnnGzI2', 4, NULL, 1, NULL, '2020-06-23 06:35:48', '2020-06-23 06:35:48'),
(5, 'Android', 'Androidnzn@gmail.com', NULL, 'Sbus', '0909090912', NULL, '$2y$10$y0YByIOAzdq4XerfbKsV/eIBG4GnRh2xOHk0BnF0fUTF6GCc337aS', 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc3VwcG9ydC5uZXR2YXMudm5cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTI4OTU1ODEsImV4cCI6MTU5NDEwNTE4MSwibmJmIjoxNTkyODk1NTgxLCJqdGkiOiJ4UXNTSFg4M3BlWVM5M0hGIiwic3ViIjo1LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.3uXi7X_kvKFEfHw6ZarsLSZe_5NiNJLoLUSIi3zBMaE', 1, NULL, '2020-06-23 06:59:32', '2020-06-23 06:59:41'),
(6, 'John Doe', 'playstorecnx1505@gmail.com', NULL, 'Abc', '6364908572', NULL, '$2y$10$uUb800vZsqHHK2lBY.DwGu0uZ3Ihr0p.QmEZHh41kbGyB8K0iCdqC', 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc3VwcG9ydC5uZXR2YXMudm5cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTI5MDQ1NjYsImV4cCI6MTU5NDExNDE2NiwibmJmIjoxNTkyOTA0NTY2LCJqdGkiOiJDc0FCTTdwS2NvUVc2NjZiIiwic3ViIjo2LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.18U82ur0WlyOErZJ2w7f5d0TP47a2dXpYXmaVQJWEpw', 1, NULL, '2020-06-23 09:29:05', '2020-06-23 09:29:26'),
(8, 'EPS', 'Anhnn@eplatform.vn', NULL, '101 Trần Hưng Đạo, Quận 1', '0908918039', NULL, '$2y$10$RHBwo3Kpuq.J4kyZepZdt.t8XO7mUiFsKEU6Vvh3pCOkWxTtA98QC', 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc3VwcG9ydC5uZXR2YXMudm5cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTI5NjY1NjYsImV4cCI6MTU5NDE3NjE2NiwibmJmIjoxNTkyOTY2NTY2LCJqdGkiOiIySFloYTJTN3U4MXNhb2MyIiwic3ViIjo4LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.vGpourjizaHmQPZu6pjLR6F9srXzceQFDcNBy4jOEn8', 1, NULL, '2020-06-24 02:42:26', '2020-06-24 02:42:46'),
(9, 'John', 'playstorecnx13@gmail.com', NULL, 'Bangalore', '6364908551', NULL, '$2y$10$EwB1y.2nY57HeFxb9N5A1ud0ZBKLXJzX8I846frgZnDY/w/tor9Au', 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc3VwcG9ydC5uZXR2YXMudm5cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTI5NzQ1MTYsImV4cCI6MTU5NDE4NDExNiwibmJmIjoxNTkyOTc0NTE2LCJqdGkiOiIxdlN3aGoxM28yRU16UDJmIiwic3ViIjo5LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.LqGYG2CJvrErrxhtMHkHrqIPegsHEjfylcZKxhsCCYs', 1, NULL, '2020-06-24 04:54:43', '2020-06-24 04:55:16'),
(16, 'hihihihi', 'hiadmin@gmail.com', NULL, '123 Hiasdajsd', '1231233244', NULL, '$2y$10$RM4RGEp6osYWsWIoy1VMQ.mE0uTpS0UOD6jqczhVWg7MkT4Q1iEi6', 3, NULL, 1, NULL, '2020-07-01 23:54:27', '2020-07-07 08:36:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_setting`
--

CREATE TABLE `user_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `setting_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_setting`
--

INSERT INTO `user_setting` (`id`, `uid`, `setting_code`, `value`, `created_at`) VALUES
(1, 1, 'onesignal_user_id', '620cdda0-27e4-444f-ab58-9dff8a404f1b', '2020-07-01 09:13:17'),
(3, 3, 'language', 'vi', '2020-06-22 09:54:58'),
(4, 3, 'fcm_token', 'c5jnjDWtQEZ5sIHLFGUF6m:APA91bFWNy9C29QlgGKbrkYxjMhU1PzIeh_PzFm-uOhBgIZ2hRZF-2ny0PwTcKot3b2ItFTpwIU0W3aTQ8hJVZB36a-Hw4UjOYT53QwJejlzAHqMoUauf1royBDcZnscgH-IkbdZXQr5', '2020-06-23 06:28:56'),
(6, 1, 'language', 'vi', '2020-06-23 06:34:40'),
(8, 5, 'fcm_token', 'enMk-NgvBAE:APA91bG2YiedPhAaOTVG6eoXb2PyaJ7nOppTJ-LGpnHvoPJZlhJQi6AHGu3UQ7L882xNgPEOGiUM8DWItLcmFaXUjaEEar6efl0GvEfM63Sux2WAzVfitzZ9pkqcOhIgROy7lFzvtuno', '2020-06-23 06:59:41'),
(9, 5, 'language', 'vi', '2020-06-23 06:59:41'),
(10, 6, 'fcm_token', 'csj1OE3aQmc:APA91bGTolLB0oDoWjbJjIVJSApY5jXYI0yR8EK2uSl1rc5EV-4T09DevYtDurZhP_c8hFQCqTibzWDWjdKjYwHBHX_bgrWDEDetUQPe5JyxfsprguTn2VzjKCQ4UjvUYHowbHI3PP0Y', '2020-06-23 09:29:26'),
(11, 6, 'language', 'en', '2020-06-23 09:29:26'),
(15, 8, 'fcm_token', 'dXV2XgU2obk:APA91bHLGTOapoe5xGLP3yemgTZGMZayTYP1nRshFb3xO8lcHtvUGDxzLCw1mDSnMGHbvS75QLQ-j0KXB53IhH6tqz_o--QxTACs-QQQ9PcJbtwjq3yNIFeg-luQ4J4JeQvf7iP0ZASC', '2020-06-24 02:42:46'),
(16, 8, 'language', 'vi', '2020-06-24 02:42:46'),
(17, 9, 'fcm_token', 'ebELCiuMW_w:APA91bGovswsELaylYwrx-QARVpt40dXGVR5I8CTCc9RMVGk8uHsmURr-csZ7tlwp9ov4lZPKlFjJ1hVnpIti1IlulET2V3m8tsiViM5fMEtk9SyVErHBs0ogBcaqWYCSSLzf0cgBgXZ', '2020-06-24 04:55:16'),
(18, 9, 'language', 'en', '2020-06-24 04:55:16'),
(30, 2, 'fcm_token', 'cwupR0IDDrw:APA91bF6VgUavNv6xF_kgrwb8nU_TMDNebCjAxSqQAAYS1qACoZUMPoKeyjRkc2pzlqbo4j2t2tAGPQ3X2pNsgwYW-lJMLm_4SEOi7zeoajepL5MzU-Yr53o1M5XlQSWH4e1jeLhLis5', '2020-07-01 08:29:04'),
(31, 2, 'language', 'vi', '2020-07-01 08:29:04'),
(33, 1, 'fcm_token', 'eLAhqX2TNF4:APA91bHQevM7J2_tLkoeg7Ry4KxrcabAQ5JyuMmvFTCGqL3iboQ5yO28MH41JMs0EB19x-9dpA5hQT2_KvUkCeO8oPNxDz8NBtEmxZmzgKi2xCXphXjq_TSCWnKcEyK5qWQdsz9_4Ndd', '2020-07-07 10:05:51');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `booking_uid_foreign` (`uid`),
  ADD KEY `booking_staff_id_foreign` (`staff_id`),
  ADD KEY `booking_service_id_foreign` (`service_id`);

--
-- Chỉ mục cho bảng `booking_activity`
--
ALTER TABLE `booking_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_activity_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_activity_created_id_foreign` (`created_id`);

--
-- Chỉ mục cho bảng `booking_rating`
--
ALTER TABLE `booking_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_rating_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_rating_uid_foreign` (`uid`);

--
-- Chỉ mục cho bảng `booking_service`
--
ALTER TABLE `booking_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_service_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_service_service_price_id_foreign` (`service_price_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_id_foreign` (`created_id`),
  ADD KEY `categories_updated_id_foreign` (`updated_id`);

--
-- Chỉ mục cho bảng `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_type_unique` (`type`);

--
-- Chỉ mục cho bảng `group_role`
--
ALTER TABLE `group_role`
  ADD KEY `group_role_group_id_foreign` (`group_id`),
  ADD KEY `group_role_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_from_foreign` (`from`),
  ADD KEY `messages_to_foreign` (`to`),
  ADD KEY `messages_booking_id_foreign` (`booking_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_created_id_foreign` (`created_id`);

--
-- Chỉ mục cho bảng `notification_uid`
--
ALTER TABLE `notification_uid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_uid_uid_foreign` (`uid`),
  ADD KEY `notification_uid_notification_id_foreign` (`notification_id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_created_id_foreign` (`created_id`),
  ADD KEY `pages_updated_id_foreign` (`updated_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `password_resets_code`
--
ALTER TABLE `password_resets_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_code_email_index` (`email`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `request_supports`
--
ALTER TABLE `request_supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_supports_uid_foreign` (`uid`);

--
-- Chỉ mục cho bảng `request_support_activity`
--
ALTER TABLE `request_support_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_support_activity_request_id_foreign` (`request_id`),
  ADD KEY `request_support_activity_uid_foreign` (`uid`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_foreign` (`category_id`),
  ADD KEY `services_created_id_foreign` (`created_id`),
  ADD KEY `services_updated_id_foreign` (`updated_id`);

--
-- Chỉ mục cho bảng `service_prices`
--
ALTER TABLE `service_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_prices_service_id_foreign` (`service_id`),
  ADD KEY `service_prices_created_id_foreign` (`created_id`),
  ADD KEY `service_prices_updated_id_foreign` (`updated_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_code_unique` (`code`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_group_id_foreign` (`group_id`);

--
-- Chỉ mục cho bảng `user_setting`
--
ALTER TABLE `user_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_setting_setting_code_foreign` (`setting_code`),
  ADD KEY `user_setting_uid_foreign` (`uid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `booking_activity`
--
ALTER TABLE `booking_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `booking_rating`
--
ALTER TABLE `booking_rating`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `booking_service`
--
ALTER TABLE `booking_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `notification_uid`
--
ALTER TABLE `notification_uid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `password_resets_code`
--
ALTER TABLE `password_resets_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `request_supports`
--
ALTER TABLE `request_supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `request_support_activity`
--
ALTER TABLE `request_support_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `service_prices`
--
ALTER TABLE `service_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `user_setting`
--
ALTER TABLE `user_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `booking_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `booking_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `booking_activity`
--
ALTER TABLE `booking_activity`
  ADD CONSTRAINT `booking_activity_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `booking_activity_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `booking_rating`
--
ALTER TABLE `booking_rating`
  ADD CONSTRAINT `booking_rating_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `booking_rating_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `booking_service`
--
ALTER TABLE `booking_service`
  ADD CONSTRAINT `booking_service_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `booking_service_service_price_id_foreign` FOREIGN KEY (`service_price_id`) REFERENCES `service_prices` (`id`);

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `categories_updated_id_foreign` FOREIGN KEY (`updated_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `group_role`
--
ALTER TABLE `group_role`
  ADD CONSTRAINT `group_role_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `group_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `messages_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_to_foreign` FOREIGN KEY (`to`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `notification_uid`
--
ALTER TABLE `notification_uid`
  ADD CONSTRAINT `notification_uid_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`),
  ADD CONSTRAINT `notification_uid_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_updated_id_foreign` FOREIGN KEY (`updated_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `request_supports`
--
ALTER TABLE `request_supports`
  ADD CONSTRAINT `request_supports_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `request_support_activity`
--
ALTER TABLE `request_support_activity`
  ADD CONSTRAINT `request_support_activity_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `request_supports` (`id`),
  ADD CONSTRAINT `request_support_activity_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `services_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `services_updated_id_foreign` FOREIGN KEY (`updated_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `service_prices`
--
ALTER TABLE `service_prices`
  ADD CONSTRAINT `service_prices_created_id_foreign` FOREIGN KEY (`created_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `service_prices_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `service_prices_updated_id_foreign` FOREIGN KEY (`updated_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Các ràng buộc cho bảng `user_setting`
--
ALTER TABLE `user_setting`
  ADD CONSTRAINT `user_setting_setting_code_foreign` FOREIGN KEY (`setting_code`) REFERENCES `settings` (`code`),
  ADD CONSTRAINT `user_setting_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
