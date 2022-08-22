<template>
  <div class='container'>
    <a-typography-title>Vue yii CRUD TEST</a-typography-title>
    <router-view></router-view>
  </div>
</template>

<script>
import ProductList from './components/ProductList.vue';
import Productitem from './components/Productitem';

export default {
  components: {
    ProductList,
    Productitem
  }
}
</script>

<style scoped>
.container {
  padding: 2%;
}
</style>
