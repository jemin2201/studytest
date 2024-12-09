<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({ // form은 객체 이름
    user_id: '',
    title: '',
    content: '',
    price: '',
    photo: [],
});

const getFileName = (event) => {
    form.photo = event.target.files[0]; // 선텍한 파일을 목록으로 만들어 주고 form.photo로 저장한다.
};

const submitForm = () => { // submitForm은 데이터를 전송하는 함수이름
    form.post(route('secondhand.store')); // form.post는 useForm에서 제공하는 메서드
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                매물 올리기
            </h2>
        </template>

        <!-- 매무 올리기 -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="box">
                        <form action="" @submit.prevent="submitForm">
                            <input type="file" name="photo" id="photo"  @change="getFileName"/> <br><br>
                            <label for="" class="label1">
                                제목
                            </label><br>
                            <input type="text" name="title" id="title" v-model="form.title"><br>
                            <label for="" class="label2">글쓰기</label><br>
                            <textarea name="content" id="content" placeholder="내용" required v-model="form.content"></textarea><br>
                            <div class="pricebox">
                                <label for="" class="label3">가격</label>
                                <input type="number" id="price" name="price" value="0" v-model="form.price" class="price">
                                <span>원</span>
                            </div>
                            
                            <input type="submit" value="저장" class="btn">
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

.label3{
    margin-right: 20px;
    line-height: 40px;
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

.pricebox{
    width: 100%;
    height: 40px;
    display: flex;
    justify-content: center;
}

span{
    line-height: 40px;
}

.price{
    width: 700px;
    border-radius: 10px;
}
</style>