document.addEventListener("DOMContentLoaded", function () {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.product-slide');
    const totalSlides = slides.length;
    const slideButtons = document.querySelectorAll('.slide-btn');

    // Chuyển đến slide tiếp theo
    function showNextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add('active');
        updateSlideButtons();
    }

    // Cập nhật trạng thái của các nút điều khiển
    function updateSlideButtons() {
        slideButtons.forEach((button, index) => {
            if (index === currentSlide) {
                button.style.backgroundColor = "#fab978"; // Màu vàng khi active
            } else {
                button.style.backgroundColor = "rgba(255, 255, 255, 0.5)"; // Màu trắng mờ khi không active
            }
        });
    }

    // Lắng nghe sự kiện click vào nút chuyển đổi slide
    slideButtons.forEach((button, index) => {
        button.addEventListener('click', function () {
            slides[currentSlide].classList.remove('active');
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            updateSlideButtons();
        });
    });

    setInterval(showNextSlide, 3000); // Chuyển mỗi 3 giây
});
