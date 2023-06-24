<template>
    <div class="carousel flex items-center justify-center">
        <button class="carousel__button carousel__button--prev" @click="prevSlide">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm1.707-9.707a1 1 0 0 0-1.414-1.414l-4 4a1 1 0 0 0 0 1.414l4 4a1 1 0 1 0 1.414-1.414L8.414 13H15a1 1 0 1 0 0-2H8.414l3.293-3.293z"></path>
            </svg>
        </button>
        <div class="carousel__slides flex overflow-hidden">
            <div v-for="(slide, index) in slides" :key="index" :class="getSlideClasses(index)">
                <img :src="slide.image" :alt="slide.caption" class="w-full h-auto">
                <div class="carousel__caption">{{ slide.caption }}</div>
            </div>
        </div>
        <button class="carousel__button carousel__button--next" @click="nextSlide">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1.707-9.707a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 1 1 1.414-1.414L8.586 11H5a1 1 0 1 1 0-2h3.586l-1.293-1.293a1 1 0 1 1 1.414-1.414l4 4z"></path>
            </svg>
        </button>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'Carousel',
    setup() {
        const slides = ref([]);
        const currentSlide = ref(0);

        const nextSlide = () => {
            currentSlide.value = (currentSlide.value + 1) % slides.value.length;
        };

        const prevSlide = () => {
            currentSlide.value = (currentSlide.value - 1 + slides.value.length) % slides.value.length;
        };

        const getSlideClasses = (index) => {
            return {
                'carousel__slide': true,
                'carousel__slide--active': index === currentSlide.value,
            };
        };

        const fetchSlides = async () => {
            try {
                const response = await axios.get('https://api.example.com/slides');
                slides.value = response.data;
            } catch (error) {
                console.error('Error fetching slides:', error);
            }
        };

        onMounted(() => {
            fetchSlides();
        });

        return {
            slides,
            currentSlide,
            nextSlide,
            prevSlide,
            getSlideClasses,
        };
    },
};
</script>


