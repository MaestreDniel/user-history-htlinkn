<script setup>
import Authenticated from '../../Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
</script>

<template>
  <Authenticated>
    <div class="container mx-auto mt-4">
      <div v-if="$page.props.flash.success" class="bg-green-400 border border-green-500 mb-4 p-2 inline-flex rounded" role="alert">
        {{ $page.props.flash.success }}
      </div>
      <table class="table-auto border-collapse border border-slate-500">
        <thead class="bg-gray-300">
          <th class="border border-slate-600 p-2">Código</th>
          <th class="border border-slate-600 p-2">Canjear</th>
        </thead>
        <tbody>
          <tr v-for="codigo in codigos.data" :key="codigo.id" class="bg-gray-200">
            <td class="border border-slate-600 p-2">{{ codigo.codigo }}</td>
            <td class="border border-slate-600 p-2">
              <div v-if="codigo.is_canjeado === 0">
                <Link :href="route('confirma_canjeo', codigo.id)">
                  <BreezeButton>Canjear</BreezeButton>
                </Link>
              </div>
              <div v-else>
                <BreezeButton class="bg-green-500">Canjeado</BreezeButton>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Authenticated>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    codigos: Object,
  },
  components: {
    Link,
  },
}
</script>