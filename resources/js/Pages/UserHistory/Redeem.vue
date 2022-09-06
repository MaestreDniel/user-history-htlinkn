<template>
  <Authenticated>
    <div class="container mx-auto mt-4">
      <h3 class="text-xl">Estás a punto de canjear tu código: {{ code.code }} </h3>
      <form @submit.prevent="submit">
        <BreezeButton class="mt-4">Canjear</BreezeButton>
        <input id="code" type="hidden" v-model="form.code" />
        <input id="is_redeemed" type="hidden" v-model="form.is_redeemed" />
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
    code: Object,
  },
  components: {
    Authenticated,
    BreezeButton,
    Link,
  },
  setup(props) {
    const form = useForm({
      code: props.code.id,
      is_redeemed: 1,
    });
    
    function submit() {
      Inertia.post(route('redeem', {
        _method: 'patch',
        code: form.code,
        is_redeemed: form.is_redeemed
      }))
    }

    return { form, submit };
  },
}
</script>
