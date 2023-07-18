<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
    posts: Object
})
</script>

<template>
    <div class="max-w-2xl mx-auto my-12 space-y-12">
        <div v-for="post in posts.data" :key="post.id">
            <h1 class="font-bold text-3xl">{{ post.id }}: {{ post.title }}</h1>
            <p class="mt-2 text-lg">{{ post.teaser }}</p>
        </div>
    </div>
    <Head title="Posts" />
</template>
