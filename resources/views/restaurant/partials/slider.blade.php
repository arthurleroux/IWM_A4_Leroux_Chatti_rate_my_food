<div class="slider_class">
    <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
            @foreach($pictures as $picture)
                <div class="swiper-slide">
                    <img src="{{ asset($picture->path) }}" alt="">
                </div>
            @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
</div>
