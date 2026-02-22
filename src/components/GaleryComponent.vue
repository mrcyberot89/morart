<script setup>
import galery1 from '@/assets/one.jpeg'
import galery2 from '@/assets/two.jpeg'
import { ref } from 'vue';

const galeriArt = ref ([
    '/src/assets/one.jpeg',
    '/src/assets/three.jpeg',
    '/src/assets/two.jpeg',
    '/src/assets/four.jpeg',
    '/src/assets/five.jpeg',
    '/src/assets/six.jpeg',
    '/src/assets/seven.jpeg',
    '/src/assets/eight.jpeg'

])



</script>

<template>
    <section class="h-screen container  mx-auto">
        <div class="flex font-dm text-4xl justify-center my-6">
            <h1 class="text-white">Galeri MorArt</h1>
        </div>
        <div class="grid grid-cols-4 grid-row-2 gap-6 bg-white rounded-2xl  p-7">
            <div v-for="(img, index) in galeriArt" :key="index" class=" aspect-square rounded-2xl  overflow-hidden">
                <img :src="img" alt="" class="object-cover h-full w-full">
            </div>
        </div>
    </section>

</template>
