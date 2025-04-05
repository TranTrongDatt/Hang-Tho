# Hang Thỏ - Website Bán Cà Phê

## Mô Tả Dự Án
Hang Thỏ là một website bán cà phê, được xây dựng nhằm cung cấp trải nghiệm mua sắm trực tuyến cho khách hàng với các tính năng cơ bản như đăng ký, đăng nhập, quản lý sản phẩm và giỏ hàng. Hệ thống hỗ trợ phân quyền người dùng, phân biệt giữa người dùng bình thường và quản trị viên (admin). Website sử dụng mô hình MVC với giao diện hiện đại, dễ sử dụng và thân thiện với người dùng.

## Các Tính Năng Chính
- **Đăng Ký và Đăng Nhập**: Người dùng có thể tạo tài khoản mới và đăng nhập vào hệ thống. Các thông tin người dùng sẽ được lưu trữ và bảo mật.
- **Phân Quyền Người Dùng**: Hệ thống phân quyền rõ ràng giữa người dùng thường và quản trị viên. Admin có quyền quản lý sản phẩm, trong khi người dùng có thể duyệt và mua sản phẩm.
- **Thay Đổi Giao Diện**: Website cung cấp tính năng thay đổi giao diện giữa hai chế độ:
  - **Giao diện API**: Hiển thị dữ liệu thông qua các endpoint API, cho phép người dùng và các dịch vụ khác truy xuất thông tin sản phẩm.
  - **Giao diện MVC**: Mô hình giao diện truyền thống sử dụng MVC (Model-View-Controller), phù hợp với người dùng muốn trải nghiệm giao diện web đầy đủ.
  
- **Trang Web**:
  - **Trang chủ**: Hiển thị các sản phẩm và thông tin nổi bật.
  - **Giới thiệu**: Cung cấp thông tin về Hang Thỏ.
  - **Sản phẩm**: Hiển thị danh sách các sản phẩm cà phê có sẵn.
  - **Giỏ hàng**: Người dùng có thể thêm sản phẩm vào giỏ và thanh toán.
  - **Tìm kiếm**: Tính năng tìm kiếm giúp người dùng dễ dàng tìm thấy sản phẩm mình muốn.

- **Footer**:
  - **Giới thiệu Hang Thỏ**: Cung cấp thông tin về Hang Thỏ, nơi khách hàng có thể tìm hiểu về không gian cà phê huyền bí và đội ngũ phát triển trang web.
  - **Liên kết nhanh**: Cung cấp các liên kết nhanh đến các trang như danh sách sản phẩm, danh mục sản phẩm, giới thiệu và liên hệ.
  - **Mạng xã hội**: Kết nối người dùng với các trang mạng xã hội như Facebook, Twitter và Instagram.
  - **Bản quyền**: Hiển thị thông tin bản quyền về Hang Thỏ với năm phát hành và thông tin bản quyền.

## Công Nghệ Sử Dụng
- **PHP**: Ngôn ngữ lập trình chính để xử lý các tác vụ phía server.
- **HTML, CSS, Bootstrap**: Được sử dụng để xây dựng giao diện web, tạo ra trải nghiệm người dùng thân thiện và trực quan.
- **JavaScript**: Xử lý các thao tác người dùng như tìm kiếm sản phẩm và tương tác động với giao diện.
- **MySQL**: Cơ sở dữ liệu để lưu trữ thông tin người dùng, sản phẩm và đơn hàng.
- **Laragon**: Môi trường phát triển localhost cho phép chạy dự án PHP một cách dễ dàng.

## Hướng Dẫn Cài Đặt
1. **Cài đặt Laragon**: Cài đặt Laragon phiên bản mới nhất để chạy môi trường PHP, MySQL.
2. **Clone Repository**:
   ```bash
   git clone https://github.com/your-username/hangtho.git
3. **Cấu Hình Cơ Sở Dữ Liệu**:
- Tạo cơ sở dữ liệu hangtho trong MySQL.
- Cập nhật thông tin kết nối cơ sở dữ liệu trong file cấu hình.
4. **Chạy Dự Án**:
  - Mở Laragon và bật Apache và MySQL.
  - Truy cập vào http://localhost/hangtho để xem trang web.
    
## Các Tính Năng Đang Phát Triển
- **Thanh toán trực tuyến** : Đang được phát triển để người dùng có thể thanh toán dễ dàng qua các cổng thanh toán trực tuyến.
- **Quản lý đơn hàng** : Admin sẽ có chức năng theo dõi đơn hàng và tình trạng giao hàng.

# Kết Luận: 
- Dự án Hang Thỏ không chỉ là một website bán cà phê mà còn là một giải pháp tối ưu giúp quản lý sản phẩm và đơn hàng hiệu quả. Với giao diện thân thiện và các tính năng dễ sử dụng, Hang Thỏ là lựa chọn lý tưởng cho những ai yêu thích cà phê.
