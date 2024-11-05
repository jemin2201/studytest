<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const posts = ref([]);

onMounted(async () => {
    try {
        const post = await axios.get('/Posts');
        posts.value = post.data;
    } catch (error) {
        console.error("데이터를 가져오는 중 오류가 발생했습니다.", error);
    }
});
</script>

<template>
    <div class="box">
        <tr>
            <td class="td1">번호</td>
            <td class="td2">작성자</td>
            <td class="td3">제목</td>
            <td class="td4">시간</td>
        </tr>
        <tr v-for="post in posts" :key="post.id">
            <td class="td1">{{ post.id }}</td>
            <td class="td2">작성자</td>
            <td class="td3">{{ post.title }}</td>
            <td class="td4">{{ post.created_at }}</td>
        </tr>
    </div>
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
</style>