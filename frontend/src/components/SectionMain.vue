<script setup>
import { containerMaxW } from '@/config.js'
</script>

<template>
  <section class="p-5" :class="containerMaxW">
    <slot />
  </section>
</template>
