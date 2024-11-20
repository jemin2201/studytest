<script setup>
import { Head, Link } from '@inertiajs/vue3';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
<Head title="Welcome" />
        
    <div class="loginbox">
        <Link :href="route('login')" class="link">
            로그인
        </Link>
        <Link :href="route('register')" class="link">
            회원가입
        </Link>
    </div>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                환영합니다.
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                이 페이지를 사용하고 싶다면 로그인을 해주세요!
            </h2>
        

        <!-- 이미지 슬라이드 -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="/images/slideimg1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="/images/slideimg2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="/images/slideimg3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    
</template>
 <style>
 img{
    height: 500px;
 }

.loginbox{
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: end;
}

h2{
    text-align: center;
}

 .link{
    display: block;
    width: 80px;
    height: 50px;
    line-height: 50px;
    color: black;
    text-decoration: none;
    text-align: center;
    margin-right: 10px;
 }
</style>