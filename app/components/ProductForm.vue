<template>
  <a-card
      hoverable
      style='width: 100%'
      :loading='loading'
  >
    <a-form
        :model='product'
        :label-col='labelCol'
        :wrapper-col='wrapperCol'
        :rules='rules'
    >
      <a-form-item
          label='Product name'
          v-bind='validationErrors.name'
      >
        <a-input
            v-model:value='product.name'
        />
      </a-form-item>
      <a-form-item
          label='Product Details'
          v-bind='validationErrors.details'
      >
        <a-input
            v-model:value='product.details'
        />
      </a-form-item>
   
      <a-form-item
          :wrapper-col='{ span: 14, offset: 4 }'
      >
        <a-button
            size='large'
            type='primary'
            @click='handleSubmit'
        >
          {{ isEdit ? 'Update' : 'Create' }}
        </a-button>
        <a-button
            size='large'
            style='margin-left: 10px'
            @click='resetFields'
            v-if='!isEdit'
        >
          Reset
        </a-button>
        <a-button
            size='large'
            style='margin-left: 10px'
            @click='showAllProducts'
            danger
        >
          Cancel
        </a-button>
      </a-form-item>
    </a-form>
  </a-card>
</template>
<script>
import api from '../api';
import {Form} from 'ant-design-vue';
import {reactive} from 'vue';
import {useRouter} from 'vue-router'

const {useForm} = Form;

export default {

  setup(props) {
    let product = reactive({
      name: '',
      details: '',
     
    });

    const rules = reactive({
      name: [
        {
          required: true,
          message: 'Please provide product name',
          trigger: 'blur'
        },
      ],
      details: [
        {
          required: true,
          message: 'Please provide product details',
          trigger: 'blur'
        },
      ],
    });

    const {
      resetFields,
      validate,
      validateInfos: validationErrors
    } = useForm(product, rules);

    const router = useRouter();

    const handleSubmit = () => {
      validate()
          .then(
              async () => {
                const {productId} = props;
                const updatedProduct = !!productId ?
                    await api.helpPatch(`products/${productId}`, product) :
                    await api.helpPost('products', product);
                Object.assign(product, updatedProduct);
                router.push({name: 'product-item', params: {productId: product.id}});
              }
          )
          .catch(() => {
          });
    }

    return {
      resetFields,
      validationErrors,
      product,
      handleSubmit,
      rules
    };
  },
  props: ['productId'],
  data() {
    return {
      isEdit: !!this.productId,
      loading: !!this.productId,
      labelCol: {span: 4},
      wrapperCol: {span: 14},
    }
  },
  methods: {
    async loadProduct() {
      Object.assign(this.product, await api.helpGet(`products/${this.productId}`));
      this.loading = false;
    },
    showAllProducts() {
      this.$router.push({name: 'products'});
    },
  },
  async mounted() {
    if (this.isEdit) {
      await this.loadProduct();
    }
  }
};
</script>
