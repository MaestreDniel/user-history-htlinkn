<template>
  <Authenticated>
    <div class="container mx-auto mt-4">
      <h3 class="text-xl">Estás a punto de canjear tu código: {{ codigo.codigo }} </h3>
      <form @submit.prevent="submit">
        <BreezeButton>Canjear</BreezeButton>
        <input id="codigo" type="hidden" v-model="form.codigo" />
        <input id="is_canjeado" type="hidden" v-model="form.is_canjeado" />
      </form>
    </div>
  </Authenticated>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Authenticated from '../../Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';

export default {
  props: {
    codigo: Object,
  },
  components: {
    Authenticated,
    BreezeButton,
    Link,
  },
  setup(props) {
    const form = useForm({
      codigo: props.codigo.id,
      is_canjeado: 1,
    });
    
    function submit() {
      Inertia.post(route('canjear', {
        _method: 'patch',
        codigo: form.codigo,
        is_canjeado: form.is_canjeado
      }))
    }

    return { form, submit };
  },
}
</script>
