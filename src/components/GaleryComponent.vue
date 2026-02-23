<script setup>
import galery1 from '@/assets/one.jpeg'
import galery2 from '@/assets/two.jpeg'
import galery3 from '@/assets/three.jpeg'
import galery4 from '@/assets/four.jpeg'
import galery5 from '@/assets/five.jpeg'
import galery6 from '@/assets/six.jpeg'
import galery7 from '@/assets/seven.jpeg'
import galery8 from '@/assets/eight.jpeg'
import { ref } from 'vue';

const galeriArt = ref ([
    galery1,
    galery2,
    galery3,
    galery4,
    galery5,
    galery6,
    galery7,
    galery8

])



</script>

<template>
    <section class="lg:h-screen container  mx-auto  mb-12">
        <div class="flex font-dm lg:text-4xl text-2xl justify-center lg:my-6">
            <h1 class="text-white">Galeri MorArt</h1>
        </div>
        <div class="grid lg:grid-cols-4 lg:grid-row-2 lg:gap-6 grid-col-1 bg-white rounded-2xl  lg:p-7 p-3 gap-y-5">
            <div v-for="(img, index) in galeriArt" :key="index" class=" aspect-square rounded-2xl  overflow-hidden">
                <img :src="img" alt="" class="object-cover h-full w-full">
            </div>
        </div>
    </section>

</template>
