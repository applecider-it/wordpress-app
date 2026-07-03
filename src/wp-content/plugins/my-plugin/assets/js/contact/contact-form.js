/**
 * 問い合わせ画面
 */
const MypluginContactForm = {
  props: {
    wpNonce: String,
    url: String,
  },

  setup({ url, wpNonce }) {
    const { ref, onMounted } = Vue;

    const formData = ref({
      name: '',
      email: '',
      subject: '',
      message: '',
    });

    const isSubmitting = ref(false);
    const step = ref('form');
    const errorMessage = ref('');
    const errors = ref({});

    /** 送信処理 */
    const submitForm = async () => {
      isSubmitting.value = true;
      errorMessage.value = '';

      try {
        const response = await axios.post(url, formData.value, {
          headers: {
            'X-WP-Nonce': wpNonce, // WordPressが発行する REST API 用の Nonce
            'Content-Type': 'application/json',
          },
        });

        console.log(response);

        step.value = 'complate';
      } catch (error) {
        const response = error.response;
        console.error(response);
        if (response?.status === 422) {
          errors.value = response.data.errors;
        } else {
          errorMessage.value =
            response?.data?.message ||
            '送信に失敗しました。時間をおいて再度お試しください。';
        }
      } finally {
        isSubmitting.value = false;
      }
    };

    onMounted(() => {
      console.log('Mounted!');
    });

    return {
      formData,
      isSubmitting,
      step,
      errorMessage,
      errors,
      submitForm,
    };
  },

  template: `
    <div v-if="step === 'form'">
      <div v-if="errorMessage" class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ errorMessage }}
      </div>

      <form @submit.prevent="submitForm">
        <div class="space-y-3">
          <div>
            <div>名前</div>
            <div><input type="text" v-model="formData.name" class="app-form-input" :disabled="isSubmitting"></div>
            <div v-if="errors.name" class="app-form-error">{{ errors.name[0] }}</div>
          </div>

          <div>
            <div>メール</div>
            <div><input type="text" v-model="formData.email" class="app-form-input" :disabled="isSubmitting"></div>
            <div v-if="errors.email" class="app-form-error">{{ errors.email[0] }}</div>
          </div>

          <div>
            <div>件名</div>
            <div><input type="text" v-model="formData.subject" class="app-form-input" :disabled="isSubmitting"></div>
            <div v-if="errors.subject" class="app-form-error">{{ errors.subject[0] }}</div>
          </div>

          <div>
            <div>内容</div>
            <div><textarea v-model="formData.message" rows="6" class="app-form-input" :disabled="isSubmitting"></textarea></div>
            <div v-if="errors.message" class="app-form-error">{{ errors.message[0] }}</div>
          </div>
        </div>

        <div class="mt-5">
          <button type="submit" class="app-btn-primary" :disabled="isSubmitting">
            <span v-if="isSubmitting">送信中...</span>
            <span v-else>送信</span>
          </button>
        </div>
      </form>
    </div>

    <div v-if="step === 'complate'" class="bg-green-100 text-green-700 p-4 rounded mb-4">
      送信が完了しました。
    </div>
  `,
};
