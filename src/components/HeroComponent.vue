<script setup>
import ImagesPakIS from '@/assets/pakis.jpeg'
import AboutComponent from './AboutComponent.vue';
</script>

<template>
    <section class="w-full h-auto mb-28">
        <div class="container  mx-auto">
            <div class="grid lg:grid-cols-2 lg:gap-x-8 lg:m-8 gap-y-8">
                <div class=" aspect-square col-start-1  rounded-4xl bg-[#5c524c] flex justify-center">
                    <div class="lg:grid lg:grid-rows-5 lg:p-14 p-7 lg:gap-12 ">
                        <div class="text-white  flex items-center">
                            <h1 class=" font-playfair text-2xl lg:text-4xl font-semibold">MorArt</h1>
                        </div>
                        <div class=" flex lg:justify-center items-start lg:items-center w-full">
                            <h1 class="lg:text-4xl text-lg font-dm text-white">Seni adalah bahasa yang dilihat bukan didengar</h1>
                        </div>
                        <div class="my-4 lg:my-0">
                            <h1 class="text-white text-sm lg:text-lg">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat pariatur rem voluptatem
                                dicta. Nihil mollitia velit corporis a sunt officia aspernatur dignissimos, hic quas
                                laborum cupiditate totam tempore consequuntur voluptatem?
                            </h1>
                        </div>
                        <div class="flex items-center my-6 lg:my-24 lg:w-40 w-20 h-auto rounded-2xl justify-center bg-[#ffab7f]">
                            <div class="text-white rounded-2xl lg:p-2 lg:w-40 p-2 w-20  flex justify-center items-center bg-[#ffab7f]">
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

