<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const props = defineProps({
    item: Array // Array 배열 여러 개의 값을 하나의 변수에 저장할 수 있다
});


</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                중고매물
            </h2>
            <div class="linkbox">
                <Link class="link slink" :href="route('secondhand.create')">
                    매물 올리기
                </Link>
            </div>
        </template>
        <!-- 매물 목록 -->
        <div class="itembox">
            <div class="card cardbox" style="width: 18rem;">
            <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">보기</a>
                </div>
            </div>

            <div class="card cardbox" style="width: 18rem;" v-for="item in item" :key="index">
            <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ item.title }}</h5>
                    <h6>{{ item.user.name }}</h6>
                    <p class="card-text">{{ item.content }}</p>
                    <a href="#" class="btn btn-primary">보기</a>
                </div>
            </div>
        </div>
        
        
    </AppLayout>
</template>

<style>
.cardbox{
    margin-top: 10px;
    margin-left: 10px;
}

.itembox{
    display: flex;
}

.linkbox{
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.slink{
    display: block;
    width: 100px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    border-radius: 10px;
    border: 1px solid #000;
}

.slink:hover{
    box-shadow: 2px 2px 2px gray;
}
</style>