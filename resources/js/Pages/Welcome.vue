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
        <div class="textbox">
            <span>로그인을 해주세요.</span>
        </div>
        <div class="loginbox">
            <Link
                :href="route('login')" id="login"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Log in
            </Link>

            <Link
                    v-if="canRegister"
                :href="route('register')" id="register"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Register
            </Link>
        </div>
                            
</template>
 <style>
.textbox{
    width: 500px;
    height: 100px;
    margin: auto;
}

span{
    display: block;
    width: 500px;
    height: 100px;
    text-align: center;
    line-height: 100px;
    font-size: 20px;
}

.loginbox{
    width: 500px;
    height: 200px;
    border: 1px solid #000;
    border-radius: 25px;
    margin: auto;
    margin-top: 30px;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}

#login{
    display: block;
    width: 100px;
    height: 40px;
    border: 1px solid #000;
    background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
    border-radius: 50px;
    text-align: center;
    line-height: 25px;

}

#login:hover{
    box-shadow: 3px 3px 3px gray;
}

#register{
    display: block;
    width: 100px;
    height: 40px;
    border: 1px solid #000;
    background: linear-gradient(0deg, rgba(0,172,238,1) 0%, rgba(2,126,251,1) 100%);
    border-radius: 50px;
    text-align: center;
    line-height: 25px;
}

#register:hover{
    box-shadow: 3px 3px 3px gray;
}
</style>