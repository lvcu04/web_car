$(document).ready(function() {
    function initSlider($sliderContainer) {
        const $slides = $sliderContainer.find('.slides');
        const $slide = $sliderContainer.find('.slide');
        const $next = $sliderContainer.find('.next');
        const $prev = $sliderContainer.find('.prev');
        const $brandHeaders = $('.change-title-color');
        const $brand1 = $('#VF3');
        const $brand2 = $('#VF5');
        const $brand3 = $('#VF6');
        const $brand4 = $('#VFe34');
        const $brand5 = $('#VF7');
        const $brand6 = $('#VF8');
        const $brand7 = $('#VF9');

        let currentIndex = 0;

        function showSlide(index) {
            if (index >= $slide.length) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = $slide.length - 1;
            } else {
                currentIndex = index;
            }
            $slides.css('transform', 'translateX(' + (-currentIndex * 100) + '%)');

            $brandHeaders.each(function(i) {
                $(this).css('fill', i === currentIndex ? 'blue' : '#3C3C3C');
            });
        }

        $next.on('click', function() {
            showSlide(currentIndex + 1);
        });

        $prev.on('click', function() {
            showSlide(currentIndex - 1);
        });

        $brand1.on('click', function() {
            showSlide(0);
        });
        $brand2.on('click', function() {
            showSlide(1);
        });
        $brand3.on('click', function() {
            showSlide(2);
        });
        $brand4.on('click', function() {
            showSlide(3);
        });
        $brand5.on('click', function() {
            showSlide(4);
        });
        $brand6.on('click', function() {
            showSlide(5);
        });
        $brand7.on('click', function() {
            showSlide(6);
        });

        setInterval(function() {
            showSlide(currentIndex + 1);
        }, 60000);

        // Hiển thị slide đầu tiên và đặt màu tiêu đề tương ứng
        showSlide(currentIndex);
    }

    const $sliders = $('.slider');
    $sliders.each(function() {
        initSlider($(this));
    });
});
