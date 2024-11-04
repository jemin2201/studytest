<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    

    <header>
        <nav class="w-2/5 pl-40">
            <template v-if="$page.props.auth.user">
                <Link :href="route('dashboard')" class="rounded-md px-3 py-2">{{ user.name }}</Link>
            </template>
            <template v-else>
                <Link :href="route('login')" class="rounded-md px-3 py-2">로그인</Link>
                <Link :href="route('register')" class="rounded-md px-3 py-2">회원가입</Link>
            </template>
        </nav>
    </header>
    <main>
        
    </main>
</template>

<style>
header{
    width: 100%;
    height: 100px;
    border: 1px solid #000;
}

main{
    width: 100%;
    
}
</style>