<script setup>
import ImagesPakIS from '@/assets/pakis.jpeg'
import AboutComponent from './AboutComponent.vue';
</script>

<template>
    <section class="w-full h-auto mb-28">
        <div class="container  mx-auto">
            <div class="grid grid-cols-2 gap-x-8 lg:m-8">
                <div class=" aspect-square col-start-1  rounded-4xl bg-[#5c524c] flex justify-center">
                    <div class="grid grid-rows-5 p-14 gap-10">
                        <div class="text-white  flex items-center">
                            <h1 class=" font-playfair text-4xl font-semibold">MorArt</h1>
                        </div>
                        <div class=" flex justify-center items-center w-full">
                            <h1 class="text-4xl font-dm text-white">Seni adalah bahasa yang dilihat bukan didengar</h1>
                        </div>
                        <div class="">
                            <h1 class="text-white">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat pariatur rem voluptatem
                                dicta. Nihil mollitia velit corporis a sunt officia aspernatur dignissimos, hic quas
                                laborum cupiditate totam tempore consequuntur voluptatem?
                            </h1>
                        </div>
                        <div class=" flex items-center">
                            <div class="text-white rounded-2xl p-2 w-40  flex justify-center items-center bg-[#ffab7f]">
                                <h1>Explore</h1>
                            </div>
                        </div>
                        <div class="text-white  flex items-end">
                            <h1 class="">Location</h1>
                        </div>
                    </div>
                </div>
                <div class=" flex justify-center items-center">
                    <img :src="ImagesPakIS" alt="" srcset="" class=" object-center object-fill w-full rounded-2xl">
                </div>
            </div>
        </div>
    </section>
    <AboutComponent/>
</template>

