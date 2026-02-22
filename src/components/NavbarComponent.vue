<script setup>
import imageHeader from '../assets/header.png'
import { ref } from 'vue';
const nav = ref([
    'Home', 'Produk', 'Kontak'
])

</script>
<template>
    <div class="bg-black container mx-auto flex justify-between lg:px-8 mb-28">
        <nav class="h-14 w-full relative overflow-hidden flex justify-between items-center">
            <div class="text-white">
                <h1 class=" font-playfair font-semibold text-2xl">MorArt</h1>
            </div>
            <ul class="flex gap-5 justify-center items-center text-white">
                <li v-for="menu in nav" :key="menu">
                    <a href="" class="font-dm text-lg font-semibold tracking-[2px]">{{ menu }}</a>
                </li>
            </ul>
            <div class="p-1 text-white bg-[#3f3f3f] rounded-2xl pr-4 pl-4">
                <h1>Pencarian</h1>
            </div>
        </nav>
    </div>

</template>
<!-- <style>
.dancing-script-srm {
  font-family: "Dancing Script", cursive;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
}
</style> -->