<script setup>
import Authenticated from '../../Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
</script>

<template>
  <Authenticated>
    <div class="container mx-auto mt-4">
      <table class="table-auto border-collapse border border-slate-500">
        <thead class="bg-gray-300">
          <th class="border border-slate-600 p-2">Código</th>
          <th class="border border-slate-600 p-2">Canjear</th>
        </thead>
        <tbody>
          <tr v-for="codigo in codigos.data" :key="codigo.id">
            <td class="border border-slate-600 p-2">{{ codigo.codigo }}</td>
            <td class="border border-slate-600 p-2">
              <BreezeButton>
                Canjear
              </BreezeButton>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Authenticated>
</template>

<script>
export default {
  props: {
    codigos: Object,
  }
}
</script>