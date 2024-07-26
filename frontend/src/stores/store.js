import { reactive } from 'vue'


export const store = reactive({
    id: 0,
    set(id){
      this.count = id
    }
  })

  export const sucess = reactive({
    sucess: false,
    change(){
      this.sucess = true
        }
  })