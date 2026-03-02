<script setup>
import images1 from '@/assets/one.jpeg'
import images2 from '@/assets/two.jpeg'
import axios from 'axios'
import { ref, onMounted } from 'vue'




const lukisan = ref(); //menampung data dari api
const url = 'http://localhost:8000/api/photos';
//const url = 'https://morart-bfq2.vercel.app/api/api/lukisan'; //url api untuk mengambil data barang
const dataLukisan = async () => {
    try {
        const response = await axios.get(url,);
        lukisan.value = response.data.data; //menyimpan data dari api ke dalam variable lukisan
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
                    <img :src="item.image_url" alt="" class="object-contain h-full w-full">
                </div>
                <div class=" text-white">
                    <p class="flex justify-center font-bold">{{ item.title }}</p>
                </div> 
            </div>
        </div>
    </div>

</template>