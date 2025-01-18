// Toge Menu
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');

    menuToggle.addEventListener('click', function () {
        navbar.classList.toggle('active');
        const menuIcon = document.getElementById('menuIcon');
        if (navbar.classList.contains('active')) {
            menuIcon.classList.replace('bx-menu', 'bx-x');
        } else {
            menuIcon.classList.replace('bx-x', 'bx-menu');
        }
    });
});

// Loading
document.addEventListener('DOMContentLoaded', function () {
    const spinner = document.getElementById('loading');

    window.addEventListener('beforeunload', function () {
        spinner.classList.add('show');
    });

    window.addEventListener('load', function () {
        spinner.classList.remove('show');
    });
});

// Captcha
let correctCaptcha = '';
function generateCaptcha() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*()';
    correctCaptcha = '';
    for (let i = 0; i < 6; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        correctCaptcha += characters[randomIndex];
    }
    document.getElementById('captcha-display').value = correctCaptcha;
}

function sendToWhatsApp() {
    const name = encodeURIComponent(document.getElementById('name').value);
    const message = encodeURIComponent(document.getElementById('message').value);
    const captcha = document.getElementById('captcha').value;
    if (captcha !== correctCaptcha) {
        alert('Invalid code! Please try again.');
        return;
    }
    const whatsappURL = `https://wa.me/6282311377490?text=Nama%3A%20${name}%0AMessage%3A%20${message}`;
    window.open(whatsappURL, '_blank');
    correctCaptcha = null;
    generateCaptcha();
}
document.addEventListener("DOMContentLoaded", generateCaptcha);

// Show Password
function togglePassword(icon) {
    const passwordInput = icon.previousElementSibling;
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    icon.classList.toggle('bx-show');
    icon.classList.toggle('bx-hide');
}

// Home swiper galeri
var swiper = new Swiper(".galerisection-gallery-swiper", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centeredSlides: true,
    grabCursor: true,
    autoplay: {
        delay: 1000,
        disableOnInteraction: false,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        520: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        950: {
            slidesPerView: 3,
            spaceBetween: 25,
        },
    },
});

// Swiper and

document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById("image-popup");
    const imgElements = document.querySelectorAll('.card-img');
    const popupImg = document.getElementById("popup-img");
    let currentIndex = 0;
    const images = Array.from(imgElements).map(image => image.src);
    imgElements.forEach((image, index) => {
        image.addEventListener('click', () => {
            popup.style.display = "flex";
            popupImg.src = image.src;
            currentIndex = index;
        });
    });

    const closeBtn = document.querySelector(".close");
    closeBtn.addEventListener('click', () => {
        popup.style.display = "none";
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });

    const prevBtn = document.querySelector('.nav-btn.left');
    const nextBtn = document.querySelector('.nav-btn.right');

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
        popupImg.src = images[currentIndex];
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
        popupImg.src = images[currentIndex];
    });
});
var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
});

