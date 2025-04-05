<?php 
$page = "auth";
$page_css = "auth.css";
include 'app/views/shares/header.php'; 
?>

<!-- Giao diện đăng nhập / đăng ký -->
<div id="authContainer" class="auth-container">
  <!-- Form Đăng ký -->
  <div class="form-container sign-up-container">
    <form action="/hangtho/account/save" method="POST">
      <h1>Đăng ký</h1>
      <input type="text" name="username" placeholder="Tên đăng nhập" required />
      <input type="text" name="fullname" placeholder="Họ và tên" required />
      <input type="password" name="password" placeholder="Mật khẩu" required />
      <input type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu" required />
      <button type="submit">Đăng ký</button>
      <p class="switch">Đã có tài khoản? <a href="javascript:void(0);" id="goSignIn">Đăng nhập</a></p>
    </form>
  </div>

  <!-- Form Đăng nhập -->
  <div class="form-container sign-in-container">
    <form action="/hangtho/account/checkLogin" method="POST">
      <h1>Đăng nhập</h1>
      <input type="text" name="username" placeholder="Tên đăng nhập" required />
      <input type="password" name="password" placeholder="Mật khẩu" required />
      <a href="#" class="forgot">Quên mật khẩu?</a>
      <button type="submit">Đăng nhập</button>
      <p class="switch">Chưa có tài khoản? <a href="javascript:void(0);" id="goSignUp">Đăng ký</a></p>
    </form>
  </div>

  <!-- Overlay -->
  <div class="overlay-container">
    <div class="overlay">
      <div class="overlay-panel overlay-left">
        <h1 style="text-align: center; margin-left: 100px;">Chào mừng trở lại!</h1>
        <p style="margin-left: 100px;">Để đặt hàng, vui lòng đăng nhập với thông tin cá nhân của bạn</p>
        <button class="ghost" id="signIn" style="margin-left: 100px;">Đăng nhập</button>
      </div>
      <div class="overlay-panel overlay-right">
        <h1>Xin chào bạn!</h1>
        <p>Nhập thông tin cá nhân và bắt đầu hành trình cùng chúng tôi</p>
        <button class="ghost" id="signUp">Đăng ký</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Gọi JS xử lý hiệu ứng chuyển đổi -->
<script src="/hangtho/public/js/auth.js"></script>

<?php include 'app/views/shares/footer.php'; ?>
