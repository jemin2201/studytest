<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const form = useForm({ // form은 객체 이름
    user_id: '',
    title: '',
    content: '',
});

const submitForm = () => { // submitForm은 데이터를 전송하는 함수이름
    form.post(route('Poststore')); // form.post는 useForm에서 제공하는 메서드
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
                            <label for="" class="label1">
                                제목
                            </label><br>
                            <input type="text" name="title" id="title" v-model="form.title"><br>
                            <label for="" class="label2">글쓰기</label><br>
                            <textarea name="content" id="content" placeholder="내용" required v-model="form.content"></textarea><br>
                            <input type="submit" value="Save" class="btn">
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
form{
    width: 1050px;
    height: 600px;
    padding: 20px;
    margin: auto;
}
.label1{
    font-weight: bold;
}

#title{
    width: 1000px;
    margin-bottom: 30px;
    border-radius: 10px;
}

.label2{
    font-weight: bold;
}

#content{
    width: 1000px;
    height: 300px;
    border-radius: 10px;
}

.btn{
    display: block;
    width: 100px;
    height: 40px;
    border: 1px solid #000;
    margin: auto;
    margin-top: 20px;
    border-radius: 25px;
    box-shadow: 3px 3px 3px gray;
    text-shadow: 2px 2px 2px gray;
}

.btn:hover {
    box-shadow: 5px 5px 5px gray;
    text-shadow: 4px 4px 4px gray;
}
</style>