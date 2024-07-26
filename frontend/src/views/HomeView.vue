<script setup>
import { useRouter } from 'vue-router'
import SectionMain from '@/components/SectionMain.vue'
import CardBox from '@/components/CardBox.vue'
import Table from '@/components/Table.vue'
import Layout from '@/layouts/Layout.vue'
import BaseDivider from '@/components/BaseDivider.vue'
import SectionTitleLineWithButton from '@/components/SectionTitleLineWithButton.vue'
import BaseButton from '@/components/BaseButton.vue'


const router = useRouter()


</script>

<template>
  <Layout>
    <SectionMain>

    </SectionMain>
    
    <SectionMain>
        <SectionTitleLineWithButton  title="Lista de Fornecedores" main>
            <BaseButton  
              color="info"
              label="Criar"
              @click="router.push('/create')" />
        </SectionTitleLineWithButton>

      <BaseDivider />
      <CardBox has-table>
        <Table />
      </CardBox>
    </SectionMain>
  </Layout>
</template>
