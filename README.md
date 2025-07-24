# Website Chia Sẻ Công Thức Nấu Ăn

## Giới thiệu
Đây là dự án website chia sẻ và quản lý công thức nấu ăn. Người dùng có thể đăng ký, đăng nhập, tìm kiếm, lưu món ăn yêu thích và quản trị nội dung món ăn qua giao diện admin.

## Chức năng chính
- Đăng ký, đăng nhập tài khoản người dùng
- Tìm kiếm món ăn theo tên hoặc loại món
- Xem chi tiết công thức món ăn
- Lưu món ăn yêu thích
- Quản lý món ăn, thể loại, tài khoản (dành cho admin)

## Công nghệ sử dụng
- PHP 8.2 + Apache
- MySQL 8
- HTML, CSS, JavaScript (UIkit, Bootstrap, ...)
- Docker, Docker Compose

## Hướng dẫn chạy bằng Docker
1. Cài đặt Docker và Docker Compose
2. Clone repo về máy:
   ```sh
   git clone https://github.com/CNPMTanTime/CNPM.git
   cd CNPM
   ```
3. Chạy lệnh:
   ```sh
   docker-compose up --build
   ```
4. Truy cập website tại: [http://localhost:8080](http://localhost:8080)

- Tài khoản admin mẫu:
  - Username: `admin`
  - Password: `123456` (hoặc xem trong file `cooking.sql`)

## Cấu trúc thư mục
- `admin/`         : Trang quản trị
- `config/`        : Cấu hình kết nối CSDL
- `template/`      : Giao diện (CSS, JS, hình ảnh)
- `uploads/`       : Ảnh upload
- `cooking.sql`    : File khởi tạo database mẫu

## Đóng góp
Mọi đóng góp, báo lỗi hoặc ý tưởng mới đều được hoan nghênh!
