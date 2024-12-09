<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: Object
});

const form = useForm({
    title: props.post.title,
    content: props.post.content,
});

const submitForm = () => {
    form.put(route('Posts.update', props.post.id));
};

const deleteForm = () => {
    const check = confirm("삭제 하시겠습니까?");
    if(check) {

        form.delete(route('Posts.destroy', props.post.id));
    }
};
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- 글쓰는 기능 -->
                    <div class="box">
                        <form action="" @submit.prevent="submitForm" @delete.prevent="deleteForm">
                            <label for="" class="label1">
                                제목
                            </label><br>
                            <input type="text" name="title" id="title" v-model="form.title"><br>
                            <label for="" class="label2">글쓰기</label><br>
                            <textarea name="content" id="content" placeholder="내용" required v-model="form.content"></textarea><br>
                            <!-- 수정버튼 취소버튼 -->
                            <div class="btnbox">
                                <input type="submit" value="수정" class="btn">
                                <input type="button" value="삭제" class="btn1" @click="deleteForm">
                                <Link :href="route('PostShow', props.post.id)" class="link btn2">
                                    취소
                                </Link>
                            </div>
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

.btnbox{
    width: 400px;
    height: 100px;
    display: flex;
    justify-content: space-around;
    margin: auto;
}

.btn{
    display: block;
    width: 90px;
    height: 40px;
    border: 1px solid #000; 
    margin-top: 20px;
    border-radius: 25px;
    box-shadow: 3px 3px 3px gray;
    text-shadow: 2px 2px 2px gray;
    background-color: rgb(69, 69, 243);
}

.btn:hover {
    box-shadow: 5px 5px 5px gray;
    text-shadow: 4px 4px 4px gray;
}

.btn1{
    display: block;
    width: 80px;
    height: 40px;
    border: 1px solid #000; 
    background-color: rgb(254, 68, 68);
    text-align: center;
    margin-top: 20px;
    border-radius: 25px;
    box-shadow: 3px 3px 3px gray;
    text-shadow: 2px 2px 2px gray;
    line-height: 40px;
}

.btn1:hover {
    box-shadow: 5px 5px 5px gray;
    text-shadow: 4px 4px 4px gray;
}

.btn2{
    display: block;
    text-align: center;
    line-height: 40px;
    width: 90px;
    height: 40px;
    border: 1px solid #000; 
    margin-top: 20px;
    border-radius: 25px;
    box-shadow: 3px 3px 3px gray;
    text-shadow: 2px 2px 2px gray;
}

.btn2:hover {
    box-shadow: 5px 5px 5px gray;
    text-shadow: 4px 4px 4px gray;
}
</style>