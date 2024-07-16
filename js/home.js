document.addEventListener('DOMContentLoaded', function() {
    function initSlider(sliderContainer) {
        const slides = sliderContainer.querySelector('.slides');
        const slide = sliderContainer.querySelectorAll('.slide');
        const next = sliderContainer.querySelector('.next');
        const prev = sliderContainer.querySelector('.prev');
        let currentIndex = 0;

        function showSlide(index) {
            if (index >= slide.length) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = slide.length - 1;
            } else {
                currentIndex = index;
            }
            slides.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
        }

        next.addEventListener('click', function() {
            showSlide(currentIndex + 1);
        });

        prev.addEventListener('click', function() {
            showSlide(currentIndex - 1);
        });

        setInterval(() => {
            showSlide(currentIndex + 1);
        }, 60000);
    }

    const sliders = document.querySelectorAll('.slider');
    sliders.forEach(initSlider);
});
document.addEventListener('DOMContentLoaded', function() {
    
    const vf3 = document.getElementById('VF3');
    const vf5 = document.getElementById('VF5');
    const vf6 = document.getElementById('VF6');
    const vfe34 = document.getElementById('VFe34');
    const vf7 = document.getElementById('VF7');
    const vf8 = document.getElementById('VF8');
    const slide1 = document.getElementById('slide_vf3');
    
    if (vf3) {
        vf3.addEventListener('click', function() {
            slide1.style.display = 'block'; 
        });
    }

    if (vf5) {
        vf5.addEventListener('click', function() {
            vf5.style.display = 'block';
        });
    }

    if (vf6) {
        vf6.addEventListener('click', function() {
            vf6.style.display = 'block';
        });
    }

    if (vfe34) {
        vfe34.addEventListener('click', function() {
            vfe34.style.display = 'block';
        });
    }

    if (vf7) {
        vf7.addEventListener('click', function() {
            vf7.style.display = 'block';
        });
    }

    if (vf8) {
        vf8.addEventListener('click', function() {
            vf8.style.display = 'block';
        });
    }
});
