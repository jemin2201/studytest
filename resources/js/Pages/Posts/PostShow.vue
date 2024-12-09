<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

// props는 데이터를 전달하기 위해 사용하는 속성
const props = defineProps({
    post: Object, // Object 키와 값
    user: Number, // Number 숫자
});

const deletepost = () => {
    const check = confirm("삭제 하시겠습니까?");
    if(check) {

        router.delete(route('Posts.destroy', props.post.id));
    }
}
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- 글 자세히 보기 -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ post.title }}
            </h2>
            <div class="linkbox1"  v-if="user == post.user_id">
                <Link :href="route('PostEdit', post.id)" class="link edit">
                    수정
                </Link>
                <Link @click="deletepost" class="link edit">
                    삭제
                </Link>
            </div>
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
.linkbox1{
    width: 100%;
    display: flex;
    justify-content: end
}
p{
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
}
.edit{
    margin-left: 20px;
    display: block;
}

.edit:hover{
    text-shadow: 2px 2px 2px gray;
}
</style>