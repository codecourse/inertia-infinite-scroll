<script setup>
import { Head, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import { useIntersectionObserver } from '@vueuse/core'
import axios from 'axios'

const props = defineProps({
    posts: Object
})

const last = ref(null)

useIntersectionObserver(last, ([{ isIntersecting }]) => {
    if (!isIntersecting) {
        return
    }

    axios.get(`${props.posts.meta.path}?cursor=${props.posts.meta.next_cursor}`).then((response) => {
        props.posts.data = [...props.posts.data, ...response.data.data]
        props.posts.meta = response.data.meta
    })
})
</script>

<template>
    <div class="max-w-2xl mx-auto my-12 space-y-12">
        <div v-for="post in posts.data" :key="post.id">
            <h1 class="font-bold text-3xl">{{ post.id }}: {{ post.title }}</h1>
            <p class="mt-2 text-lg">{{ post.teaser }}</p>
        </div>
        <div ref="last" class="-translate-y-32"></div>
    </div>
    <Head title="Posts" />
</template>
