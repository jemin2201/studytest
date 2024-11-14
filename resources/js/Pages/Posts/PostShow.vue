<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    post: Object
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="box">
                        <tr  v-for="post in post" :key="post.id">
                            <td class="td1">{{ post.id }}</td>
                            <td class="td2">{{ post.user?.name }}</td>
                            <td class="td3">{{ post.title }}</td>
                            <td>{{ post.content }}</td>
                            <td class="td4">{{ post.created_at }}</td>
                        </tr>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>