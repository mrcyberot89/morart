<script setup>
import images1 from '@/assets/one.jpeg'
import images2 from '@/assets/two.jpeg'
import axios from 'axios'
import { ref, onMounted } from 'vue'

import product1 from '@/assets/lukisan/product1.jpg'
import product2 from '@/assets/lukisan/product2.jpg'
import product3 from '@/assets/lukisan/product3.jpg'
import product4 from '@/assets/lukisan/product4.jpg'
import product5 from '@/assets/lukisan/product5.jpg'
import product6 from '@/assets/lukisan/product6.jpg'
import product7 from '@/assets/lukisan/product7.jpg'
import product8 from '@/assets/lukisan/product8.jpg'


const lukisan = ref(); //menampung data dari api

const url = 'http://localhost:8000/api/lukisan'; //url api untuk mengambil data barang
const dataLukisan = async () => {
    try {
        const response = await axios.get(url,);
        lukisan.value = response.data.lukisan; //menyimpan data dari api ke dalam variable dataBarang
        console.log(lukisan);
    } catch (error) {
        console.log(error);
    }
}
onMounted(() => {
    dataLukisan();
});

</script>
<template>
    <div class="container mx-auto bg-white p-7 rounded-4xl">
        <div class="grid grid-cols-4 gap-6 grid-rows-4">
            <div v-for="(item, index) in lukisan" :key="item.id" class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="item.gambar" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black bg-blend-color  p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product2" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product3" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product4" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product5" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product6" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product7" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
            <div class="bg-black p-3 border rounded-2xl overflow-hidden h-auto">
                <div class="h-[80%]  rounded-2xl overflow-hidden">
                    <img :src="product8" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">Bima Suci</p>
                    <p>Akrilik di kanvas</p>
                    <p>70cm x 100cm</p>
                    <p class="flex justify-end text-amber-300 font-bold">Rp.780900</p>
                </div> 
            </div>
        </div>
    </div>

</template>