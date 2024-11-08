<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

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
                        <form method="POST" action="{{ route('Postcreate') }}" autocomplete="off">
                       <!-- <form action="{{ url('posts') }}" method="post" enctype="multipart/form-data"> -->
                            <label for="">
                                제목
                            </label><br>
                            <input type="text" name="title" id="title"><br>
                            <label for="">글쓰기</label><br>
                            <input type="text" name="content" id="content"><br>
                            <input type="submit" value="Save">
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>