<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const form = useForm({
    title: '',
    content: '',
});

const submitForm = () => {
    form.post(route('Poststore'));
};

// 데이터를 정의
// const title = ref('');
// const content = ref('');

// 메서드를 정의
// const submitForm = async () => {
//     Inertia.post(route('Poststore'), { // post는 
//         title: title.value,
//         content: content.value,
//     });
// }
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                글쓰기
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="box">
                        <form action="" @submit.prevent="submitForm">
                            <label for="">
                                제목
                            </label><br>
                            <input type="text" name="title" id="title" v-model="form.title"><br>
                            <label for="">글쓰기</label><br>
                            <input type="text" name="content" id="content" v-model="form.content"><br>
                            <input type="submit" value="Save">
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>