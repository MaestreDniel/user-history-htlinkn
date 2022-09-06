<template>
  <Authenticated>
    <div class="container mx-auto mt-4">
      <table class="table-auto border-collapse border border-slate-500">
        <thead class="bg-gray-300">
          <th class="border border-slate-600 p-2">Oferta</th>
          <th class="border border-slate-600 p-2">Descripción</th>
          <th class="border border-slate-600 p-2">Promoción</th>
        </thead>
        <tbody>
          <tr v-for="offer in offers.data" :key="offer.id">
            <td class="border border-slate-600 p-2">{{ offer.offer_name }}</td>
            <td class="border border-slate-600 p-2">{{ offer.description }}</td>
            <td class="border border-slate-600 p-2">
              <form @submit.prevent="submit">
                <input id="code" type="hidden" v-model="form.code" />
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
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    offers: Object,
    code: String,
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
      code: props.code
    });

    function submit() {
      Inertia.post(route('store', this.form));
    }

    return { form, submit };
  },
}
</script>