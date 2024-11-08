<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    posts: Array
});

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                게시글
            </h2>
            <div class="Upload">
                <Link :href="route('Postcreate')" class="Upbt">
                    글쓰기
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="box">
                        <tr>
                            <td class="td1">번호</td>
                            <td class="td2">작성자</td>
                            <td class="td3">제목</td>
                            <td class="td4">시간</td>
                        </tr>
                        <tr v-for="(data, index) in posts" :key="data.id">
                            <td class="td1">{{ data.id }}</td>
                            <td class="td2">작성자</td>
                            <td class="td3">
                                <Link :href="route('PostShow.show', data.id)">{{ data.title }}</Link></td>
                            <td class="td4">{{ data.created_at }}</td>
                        </tr>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
.box{
    width: 1200px;
    margin: auto;
}

tr{
    width: 1200px;
    height: 50px;
}

td{
    text-align: center;
    line-height: 50px;
    border-bottom: 1px solid;
}

.td1{
    width: 100px;
    height: 50px;
}

.td2{
    width: 150px;
    height: 50px;
}

.td3{
    width: 800px;
    height: 50px;
}

.td4{
    width: 150px;
    height: 50px;
}

.Upload{
    width: 100%;
    height: 40px;
}

.Upbt{
    display: block;
    width: 100px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    border: 1px solid #000;
    margin: auto;
    border-radius: 25px;
}
</style>