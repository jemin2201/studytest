<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const props = defineProps({
    item: Object,
    user: Number,
});

const deleteitem = () => {
    router.delete(route('secondhand.destroy', props.item.id));
};
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ item.title }}
            </h2>
            <div class="box">
                <span>
                    {{ item.price }}원
                </span>
                <div class="linkbox" v-if="user == item.user_id">
                    <Link :href="route('secondhand.edit', item.id)" class="link link1">수정</Link>
                    <Link @click="deleteitem" class="link link1">삭제</Link>
                </div>
            </div>

        </template>
        <!-- 매물 보기 -->
        <div class="itemshow">
            <div class="imgbox">
                <img :src="JSON.parse(item.photo)[0]" class="img" alt="...">
            </div>
            <div class="conbox">
                {{ item.content }}
            </div>
            <div class="btnbox">

            </div>
        </div>
        
    </AppLayout>
</template>

<style>
.kmap{
    width: 100%;
    height: 300px;
}
.box{
    display: flex;
    justify-content: space-between;
}

.link1{
    margin-left: 20px;
}
.link1:hover{
    text-shadow: 2px 2px 2px gray;
}

.imgbox{
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100%;
}
.img{
    margin: auto;
    width: 500px;
    box-shadow: 4px 4px 4px gray;
}
.itemshow{
    width: 100%;
}
.conbox{
    background-color: white;
    margin: auto;
    text-align: center;
    width: 90%;
}
</style>