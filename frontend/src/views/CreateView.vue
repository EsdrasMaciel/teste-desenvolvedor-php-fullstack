<script setup>
import { useRouter } from 'vue-router'
import { reactive, ref } from 'vue'
import SectionMain from '@/components/SectionMain.vue'
import CardBox from '@/components/CardBox.vue'
import FormField from '@/components/FormField.vue'
import FormControl from '@/components/FormControl.vue'
import BaseButton from '@/components/BaseButton.vue'
import Layout from '@/layouts/Layout.vue'
import SectionTitleLineWithButton from '@/components/SectionTitleLineWithButton.vue'
import { api } from '@/stores/api.js'
import CardBoxModal from '@/components/CardBoxModal.vue'

const router = useRouter()

const form = reactive({
  cpf_cnpj: '',
  email: '',
  nome_fantasia: '',
  razao_social: '',
  telefone: '',
  endereco: '',
  numero: '',
  bairro: '',
  cidade: '',
  estado: ''
})




const errors = ref({})
var isModalDangerActive = ref(false)

const submit = () => {
  // chamar função submit para a api
  console.log(form.estado.toLocaleUpperCase)

  api
    .post("/create", form)
    .then(() => {
         console.log('Usuário cadastrado com sucesso')
         router.push('/')
    })
    .catch((error) => {
      if (error.code=="ERR_NETWORK") {
        isModalDangerActive.value = true
        return
      }
      if (error.response.status === 422&&error.response!=null) {
        errors.value = error.response.data.errors
      }
      else{
        isModalDangerActive = true
      }
      console.log(error);
    });


}


const formStatusWithHeader = ref(true)

</script>

<template>
  <Layout>
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiBallotOutline" title="Novo Fornecedor" main>

      </SectionTitleLineWithButton>

      <CardBoxModal v-model="isModalDangerActive" title="Error" buttonLabel="OK" button="danger">
        <p><b>Houve um erro na conexão </b></p>
        <p>Por favor verifique sua conexão com a internet.</p>
      </CardBoxModal>
      <CardBox is-form @submit.prevent="submit">
        
        <FormField>
          <FormField label="CPF/CNPJ" >
            <FormControl name="cpf_cnpj" v-model="form.cpf_cnpj" mask="['###.###.###-##', '##.###.###/####-##']" placeholder="CPF ou CNPJ"  :error="errors?.cpf_cnpj" />
          </FormField >
          <FormField label="Email">
            <FormControl v-model="form.email"  type="email"  placeholder="Seu Email" :error="errors?.email" />
          </FormField>
        </FormField>

        <FormField>
          <FormField label="Nome / Nome Fantasia">
            <FormControl v-model="form.nome_fantasia" type="text"  placeholder="Seu Nome" :error="errors?.nome_fantasia" />
          </FormField>
          
          <FormField label="Razão Social">
            <FormControl v-model="form.razao_social" type="text" placeholder="Razão Social" :error="errors?.razao_social" />
          </FormField>
        </FormField>

        <FormField>
          <FormField label="Telefone">
            <FormControl v-model="form.telefone" mask= "['(##) #####-####']"  type="tel" min="10"  placeholder="(99)99905-5688" :error="errors?.telefone" />
          </FormField>
          
          <FormField label="Endereco">
            <FormControl v-model="form.endereco" type="tex"  placeholder="Endereco" :error="errors?.endereco" />
          </FormField>
        </FormField>
        <FormField>
          <FormField label="Número">
            <FormControl v-model="form.numero" type="text" placeholder="Número" :error="errors?.numero" />
          </FormField>
          
          <FormField label="Bairro">
            <FormControl v-model="form.bairro" type="text"  placeholder="Bairro" :error="errors?.bairro" />
          </FormField>
        </FormField>
        <FormField>
          <FormField label="Cidade">
            <FormControl v-model="form.cidade" type="tex"  placeholder="São Paulo" :error="errors?.cidade" />
          </FormField>
          
          <FormField label="Estado">
            <FormControl v-model="form.estado" text mask= "['AA']"   maxlength="2"  placeholder="ES" :error="errors?.estado" />
          </FormField>
        </FormField>

        <template #footer>
          <BaseButton label="Enviar" type="submit" color="info" :error="errors?.cpf_cnpj" />
        </template>
      </CardBox>
    </SectionMain>

  </Layout>
</template>
