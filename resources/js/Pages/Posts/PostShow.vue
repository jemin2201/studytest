<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

// props는 데이터를 전달하기 위해 사용하는 속성
const props = defineProps({
    post: Object, // Object 키와 값
    user: Number, // Number 숫자
});
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- 글 자세히 보기 -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ post.title }}
            </h2>
            <Link :href="route('PostEdit', post.id)" class="link edit" v-if="user == post.user_id">
                수정
            </Link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="box">
                        <p>{{ post.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
p{
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
}
.edit{
    margin: auto;
    display: block;
    width: 60px;
    height: 30px;
    border: 1px solid #000;
    text-align: center;
    line-height: 30px;
    border-radius: 10px;
}

.edit:hover{
    box-shadow: 3px 3px 3px gray;
    text-shadow: 2px 2px 2px gray;
}
</style>