<script setup>
import profile from '@/assets/me.png'
</script>

<template>
    <section class="container mx-auto  text-white mb-28 lg:px-8">
        <div class="grid grid-cols-2 gap-x-16  justify-items-center">
            <div class="grid grid-rows-1 gap-y-6  md:p-12 ">
                <h1 class="text-4xl font-playfair font-bold  flex justify-start items-center ">
                    Tentang Kami
                </h1>
                <div class="grid grid-rows-2 gap-y-6 ">
                    <h1 class=" font-dm text-xl ">
                        Kami adalah tim profesional penyedia jasa lukisan dinding dan mural di Klaten, yang berdedikasi
                        untuk mengubah ruang biasa menjadi karya seni yang hidup dan bermakna. Dengan sentuhan
                        kreativitas dan keahlian seniman berpengalaman, kami mewujudkan imajinasi Anda menjadi lukisan
                        dinding yang unik, estetis, dan tahan lama.<br>
                    </h1>
                    <h1 class="font-dm text-xl">
                        Selain jasa lukisan dan mural, kami juga melayani jual beli lukisan original dari seniman lokal.
                        Tersedia berbagai karya seni siap pajang dalam berbagai gaya abstrak, realis, kontemporer,
                        hingga tema lokal yang dapat melengkapi dekorasi rumah, kantor, atau sebagai hadiah istimewa.</h1>
                </div>
            </div>
            <div class=" flex justify-center items-center aspect-square  ">
                <img :src="profile" alt="" class=" rounded-4xl">
            </div>
        </div>

    </section>

</template>