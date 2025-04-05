// Lấy đối tượng container chính
const container = document.getElementById('authContainer');

// Lấy các nút và liên kết chuyển đổi
const signUpButton = document.getElementById('signUp');   // nút ghost "Đăng ký" trên overlay
const signInButton = document.getElementById('signIn');   // nút ghost "Đăng nhập" trên overlay
const goSignUpLink = document.getElementById('goSignUp'); // link "Đăng ký" dưới form đăng nhập
const goSignInLink = document.getElementById('goSignIn'); // link "Đăng nhập" dưới form đăng ký

// Gắn sự kiện click cho nút/liên kết "Đăng ký" -> chuyển sang giao diện Đăng ký
signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});
goSignUpLink.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});

// Gắn sự kiện click cho nút/liên kết "Đăng nhập" -> chuyển về giao diện Đăng nhập
signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});
goSignInLink.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});
