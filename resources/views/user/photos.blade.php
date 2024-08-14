@extends('layouts.app')

@section('content')
<style>
    /* geist-sans-latin-600-normal */
    @font-face {
        font-family: "Geist Sans";
        font-style: normal;
        font-display: swap;
        font-weight: 600;
        src: url(https://cdn.jsdelivr.net/fontsource/fonts/geist-sans@latest/latin-600-normal.woff2)
            format("woff2"),
            url(https://cdn.jsdelivr.net/fontsource/fonts/geist-sans@latest/latin-600-normal.woff)
            format("woff");
    }

    /* geist-sans-latin-400-normal */
    @font-face {
        font-family: "Geist Sans";
        font-style: normal;
        font-display: swap;
        font-weight: 400;
        src: url(https://cdn.jsdelivr.net/fontsource/fonts/geist-sans@latest/latin-400-normal.woff2)
            format("woff2"),
            url(https://cdn.jsdelivr.net/fontsource/fonts/geist-sans@latest/latin-400-normal.woff)
            format("woff");
    }

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    .carousel-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh; /* Adjust as needed */
    }

    .carousel {
        width: 300px;
        height: 300px;
        border: solid 1px #27272a;
        position: relative;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
    }

    .carousel__slide-counter {
        position: absolute;
        bottom: -3rem;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.875rem;
        color: #a1a1aa;
    }

    .carousel__slides-container {
        height: 100%;
        overflow: hidden;
    }

    .carousel__btn {
        position: absolute;
        border: solid 1px #27272a;
        background-color: inherit;
        color: inherit;
        top: 50%;
        width: 2.25rem;
        height: 2.25rem;
        cursor: pointer;
        border-radius: 9999px;
        color: #a1a1aa;
        transform: translateY(-50%);
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    .carousel__btn:hover {
        background-color: #27272a;
    }

    .carousel__btn--next {
        right: -3rem;
    }

    .carousel__btn--prev {
        left: -3rem;
    }

    .carousel__slide img {
        object-fit: cover;
        border-radius: 0.75rem;
        width: 300px;
        height: 300px;
        pointer-events: none;
    }

    .bmc-btn {
        position: fixed;
        bottom: 0.5rem;
        right: 0.5rem;
    }
</style>

<div class="carousel-container">
    <div id="carousel"></div>
</div>

<script>
    function renderCarousel(element, slides, showSlideCounter = true) {
        const slideCounter = document.createElement("span");
        slideCounter.classList.add("carousel__slide-counter");
        element.appendChild(slideCounter);

        const slidesContainer = document.createElement("div");
        slidesContainer.classList.add("carousel__slides-container");
        element.appendChild(slidesContainer);

        const nextButton = document.createElement("button");
        nextButton.innerHTML = ">";
        nextButton.classList.add("carousel__btn--next", "carousel__btn");
        nextButton.addEventListener("click", () => changeSlide("next"));
        element.appendChild(nextButton);

        const prevButton = document.createElement("button");
        prevButton.textContent = "<";
        prevButton.classList.add("carousel__btn--prev", "carousel__btn");
        prevButton.addEventListener("click", () => changeSlide("prev"));
        element.appendChild(prevButton);

        let currentSlide = 0;
        let startX = 0;
        let endX = 0;
        let isDragging = false;

        element.classList.add("carousel");

        function filterCurrentSlide() {
            return slides.filter((_, index) => index === currentSlide);
        }

        function renderSlides() {
            slidesContainer.innerHTML = "";
            filterCurrentSlide().forEach((item) => {
                const carouselSlide = document.createElement("div");
                carouselSlide.classList.add("carousel__slide");
                carouselSlide.innerHTML = item;
                slidesContainer.appendChild(carouselSlide);
            });
        }
        renderSlides();

        function renderSlideCounter() {
            slideCounter.textContent = `Slide ${currentSlide + 1} of ${slides.length}`;
        }
        showSlideCounter && renderSlideCounter();

        function changeSlide(type) {
            if (type === "next") {
                currentSlide = (currentSlide + 1) % slides.length;
            } else if (type === "prev") {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            }
            renderSlides();
            showSlideCounter && renderSlideCounter();
        }

        function handleMouseDown(event) {
            startX = event.clientX;
            isDragging = true;
        }

        function handleMouseMove(event) {
            if (!isDragging) return;
            endX = event.clientX;
        }

        function handleMouseUp() {
            if (!isDragging) return;
            isDragging = false;
            if (startX > endX + 50) {
                changeSlide("next");
            } else if (startX < endX - 50) {
                changeSlide("prev");
            }
        }

        slidesContainer.addEventListener("mousedown", handleMouseDown);
        slidesContainer.addEventListener("mousemove", handleMouseMove);
        slidesContainer.addEventListener("mouseup", handleMouseUp);
    }

    const slides = [
        @foreach($posts as $post)
        `<img src='/postimage1/{{$post->image1}}' alt='Image 1'>`,
        `<img src='/postimage2/{{$post->image2}}' alt='Image 2'>`,
        @endforeach
    ];

    renderCarousel(document.querySelector("#carousel"), slides, true);
</script>
@endsection
