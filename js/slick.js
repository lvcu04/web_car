document.addEventListener('DOMContentLoaded', function() {
    function initSlider(sliderContainer) {
        const slides = sliderContainer.querySelector('.slides');
        const slide = sliderContainer.querySelectorAll('.slide');
        const next = sliderContainer.querySelector('.next');
        const prev = sliderContainer.querySelector('.prev');
        const brandHeaders = document.querySelectorAll('.change-title-color');
        const brand1 = document.getElementById('VF3');
        const brand2 = document.getElementById('VF5');
        const brand3 = document.getElementById('VF6');
        const brand4 = document.getElementById('VFe34');
        const brand5 = document.getElementById('VF7');
        const brand6 = document.getElementById('VF8');
        const brand7 = document.getElementById('VF9');
        
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

            brandHeaders.forEach((header, i) => {
                header.style.fill = i === currentIndex ?  'blue': '#3C3C3C';
            });
        }

        next.addEventListener('click', function() {
            showSlide(currentIndex + 1);
        });

        prev.addEventListener('click', function() {
            showSlide(currentIndex - 1);
        });

        brand1.addEventListener('click',function(){
            showSlide(0);
        })
        brand2.addEventListener('click',function(){
            showSlide(1);
        })
        brand3.addEventListener('click',function(){
            showSlide(2);
        })
        brand4.addEventListener('click',function(){
            showSlide(3);
        })
        brand5.addEventListener('click',function(){
            showSlide(4);
        })
        brand6.addEventListener('click',function(){
            showSlide(5);
        })
        brand7.addEventListener('click',function(){
            showSlide(6);
        })

        setInterval(() => {
            showSlide(currentIndex + 1);
        }, 60000);

        // Hiển thị slide đầu tiên và đặt màu tiêu đề tương ứng
        showSlide(currentIndex);
    }

    const sliders = document.querySelectorAll('.slider');
    sliders.forEach(initSlider);
});
