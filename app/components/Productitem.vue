<template>
  <a-spin
      tip='Loading product'
      v-if='product === null'
  >
  </a-spin>
  <a-card
      hoverable
      style='width: 60%'
      v-else
  >
    <template
        class='ant-card-actions'
        #actions
    >
      <a-button
          @click='showAllProducts'
          type='primary'
          style='margin-right: 5px'
          ghost
      >
        Home
      </a-button>
      <a-button
          @click='showEditProductForm'
          style='margin-right: 5px'
      >
        Edit
      </a-button>
      <a-popconfirm
          title='Delete Product? This action cannot be undone'
          @confirm='deleteProduct'
          okText='Delete'
          okType='danger'
      >
        <template #icon>
          <WarningOutlined style='color: red'/>
        </template>
        <a-button danger>
          Delete
        </a-button>
      </a-popconfirm>
    </template>
    <a-card-meta
        :title='product.name'
        :description='product.details'
    >

    </a-card-meta>
    <a-row style='margin-top: 50px'>
      <a-col :span='6'>
        
      </a-col>
      <a-col :span='18'>
      
      </a-col>
    </a-row>
  </a-card>
</template>
<script>
import api from '../api';
import {
  EditOutlined,
  ArrowLeftOutlined,
  WarningOutlined,
  DeleteOutlined
} from '@ant-design/icons-vue';

export default {
  props: ['productId'],
  data() {
    return {
      product: null
    }
  },
  components: {
    EditOutlined,
    ArrowLeftOutlined,
    WarningOutlined,
    DeleteOutlined
  },
  methods: {
    async loadProduct() {
      this.product = await api.helpGet(`products/${this.productId}`);
    },
    showAllProducts() {
      this.$router.push({name: 'products'});
    },
    showEditProductForm() {
      this.$router.push({name: 'product-form', params: {productId: this.productId}});
    },
    async deleteProduct() {
      await api.helpDelete(`product/${this.productId}`);
      this.showAllProducts();
    }
  },
  async mounted() {
    await this.loadProduct();
  }
};
</script>
