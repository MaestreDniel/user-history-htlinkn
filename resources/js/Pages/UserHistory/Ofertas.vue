<template>
  <Authenticated>
    <div class="container mx-auto mt-4">
      <h2>Prueba código: {{ codigo }}, usuario: {{ user_id }}</h2>
      <table class="table-auto border-collapse border border-slate-500">
        <thead class="bg-gray-300">
          <th class="border border-slate-600 p-2">Oferta</th>
          <th class="border border-slate-600 p-2">Descripción</th>
          <th class="border border-slate-600 p-2">Promoción</th>
        </thead>
        <tbody>
          <tr v-for="oferta in ofertas.data" :key="oferta.id">
            <td class="border border-slate-600 p-2">{{ oferta.nombre_oferta }}</td>
            <td class="border border-slate-600 p-2">{{ oferta.descripcion }}</td>
            <td class="border border-slate-600 p-2">
              <form @submit.prevent="submit">
                <input id="codigo" type="hidden" v-model="form.codigo" />
                <input id="user_id" type="hidden" v-model="form.user_id" />
                <BreezeButton>Obtener un código</BreezeButton>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Authenticated>
</template>

<script>
import Authenticated from '../../Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    ofertas: Object,
    codigo: String,
    user_id: Number,
  },
  components: {
    Authenticated,
    BreezeButton,
    Link,
  },
  setup(props) {
    const form = useForm({
      user_id: props.user_id,
      codigo: props.codigo
    });

    function submit() {
      Inertia.post(route('generar', this.form))
    }

    return { form, submit };
  },
}
</script>