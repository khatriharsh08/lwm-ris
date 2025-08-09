    <footer class="text-center py-4">
        <script src="<?= base_url('front/swiper/swiper-bundle.min.js') ?>"></script>
        <div class="container">
            <p class="mb-0">&copy; 2025 LWM-RIS. All Rights Reserved.</p>
        </div>
    </footer>
     <script>
        const swiperTrendingProducts = new Swiper('.mySwiper', {
            loop: true,
            loopFillGroupWithBlank: true, 
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            spaceBetween: 10, // better spacing
            autoplay: {
                delay: 3000, // 3 seconds between slides
                disableOnInteraction: false, // keep autoplay after user interaction
            },
            breakpoints: {
                // when window width is >= 0px
                0: {
                    slidesPerView: 1,
                },
                // when window width is >= 768px
                768: {
                    slidesPerView: 2,
                },
                // when window width is >= 1024px
                1024: {
                    slidesPerView: 3,
                }
            }
        });
        </script>
</body>
</html>