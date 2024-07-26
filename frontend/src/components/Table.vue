<script setup>
import { useRouter } from 'vue-router'
import { computed, ref } from 'vue'
import { useMainStore } from '@/stores/main'
import CardBoxModal from '@/components/CardBoxModal.vue'
import BaseLevel from '@/components/BaseLevel.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import BaseButton from '@/components/BaseButton.vue'
import { api } from '@/stores/api.js'
import { store } from '@/stores/store.js'


const router = useRouter()
const mainStore = useMainStore()

const items = ref([])

const isModalActive = ref(false)

var isModalDangerActive = ref(false)

const perPage = ref(15)

const numPages = ref()

const currentPage = ref(0)

const checkedRows = ref([])

const itemsPaginated = computed(() =>
  items.value.slice(perPage.value * currentPage.value, perPage.value * (currentPage.value + 1))
)


const currentPageHuman = computed(() => currentPage.value + 1)

const pagesList = computed(() => {
  const pagesList = []

  for (let i = 0; i < numPages.value; i++) {
    pagesList.push(i)
  }

  return pagesList
})

const remove = (arr, cb) => {
  const newArr = []

  arr.forEach((item) => {
    if (!cb(item)) {
      newArr.push(item)
    }
  })

  return newArr
}
const delet =  (id)=>{
  api
    .delete(`/delete/${id}`)
    .then((response) => {
          reload()
    })
    .catch((error) => {
      if (error.response.status === 422&&error.response.status!=null) {
        errors.value = error.response.data.errors
      }
      else{
        console.log(error);
      }
      console.log(error);
    });
}

const edit = (id)=>{
  // router.push('/edit');
  store.set(id)

}

const reload =  ()=>{
  api
    .get(`?page=${currentPageHuman}`)
    .then((response) => {
          console.log(response);
          numPages.value = response.data.last_page
          items.value = response.data.data
          
    })
    .catch((error) => {
      console.log(error);
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
      else{
        isModalDangerActive = true
      }
    });
  }
  console.log("!!");
  reload()

</script>

<template>
  <CardBoxModal v-model="isModalActive" title="Sample modal">
    <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
    <p>This is sample modal</p>
  </CardBoxModal>

  <CardBoxModal v-model="isModalDangerActive" title="Please confirm" button="danger" has-cancel>
    <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
    <p>This is sample modal</p>
  </CardBoxModal>
  
  <table>
    <thead>
      <tr>
        <th>N. Fantasia</th>
        <th>Cpf/Cnpj</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="client in itemsPaginated" :key="client.id">
        
        <td data-label="N. Fantasia">
          {{ client.nome_fantasia }}
        </td>
        <td data-label="CPF/CNPJ">
          {{ client.cpf_cnpj }}
        </td>
        <td data-label="Cidade">
          {{ client.cidade }}
        </td>
        <td data-label="Estado" class="lg:w-32">
          {{ client.estado }}
        </td>

        <td class="before:hidden lg:w-1 whitespace-nowrap">
          <BaseButtons type="justify-start lg:justify-end" no-wrap>
            <BaseButton  
              color="info"
              label="Editar"
              :small="true" 
              @click="edit(client.id)" />
            <BaseButton
              color="danger"
              label="Apagar"
              :small="true"
              @click="delet(client.id)"
            />
            
          </BaseButtons>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="p-3 lg:px-6 border-t border-gray-100 dark:border-slate-800">
    <BaseLevel>
      <BaseButtons>
        <BaseButton
          v-for="page in pagesList"
          :key="page"
          :active="page === currentPage"
          :label="page + 1"
          :color="page === currentPage ? 'lightDark' : 'whiteDark'"
          small
          @click="currentPage = page"
        />
      </BaseButtons>
      <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
    </BaseLevel>
  </div>
</template>
