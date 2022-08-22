<template>
  <a-button
      type='primary'
      style='margin-bottom: 8px'
      @click='showAddProductForm'
  >
    Add Product
  </a-button>
  <a-table
      :dataSource='products'
      :columns='columns'
      rowKey='id'
      bordered
  >
    <template #action='{ record }'>
      <div>
        <a-button
            type='primary'
            @click='showProduct(record.id)'
            style='margin-right: 5px'
            ghost
        >
          View
        </a-button>
        <a-button
            @click='showEditProductForm(record.id)'
            style='margin-right: 5px'
        >
          Edit
        </a-button>
        <a-popconfirm
            title='Delete product? This action cannot be undone'
            @confirm='deleteProduct(record.id)'
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
      </div>
    </template>
  </a-table>
</template>
<script>
import api from '../api';
import {
  PlusOutlined,
  EyeOutlined,
  EditOutlined,
  DeleteOutlined,
  WarningOutlined
} from '@ant-design/icons-vue';

export default {
  components: {
    PlusOutlined,
    EditOutlined,
    EyeOutlined,
    DeleteOutlined,
    WarningOutlined
  },
  data() {
    return {
      products: [],
      columns: [
        {
          title: 'Name',
          dataIndex: 'name',
          key: 'nalme',
          ellipsis: true
        },
        {
          title: 'details',
          dataIndex: 'details',
          key: 'details',
        },
        {
          title: 'Action',
          key: 'action',
          slots: {customRender: 'action'},
        },
      ]
    };
  },
  methods: {
    async deleteProduct(productId) {
      await api.helpDelete(`products/${productId}`);
      this.products = this.products.filter(({id}) => id !== productId);
    },
    showProduct(productId) {
      this.$router.push({name: 'product-item', params: {productId}});
    },
    showAddProductForm() {
      this.$router.push('/product/add');
    },
    showEditProductForm(productId) {
      this.$router.push({name: 'product-form', params: {productId}});
    }
  },
  async mounted() {
    this.products = await api.helpGet('products');
  }
};
</script>
