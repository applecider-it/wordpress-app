<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios, { AxiosError } from 'axios';

interface Props {
  wpNonce: string;
  url: string;
}

const props = defineProps<Props>();

interface FormData {
  name: string;
  email: string;
  subject: string;
  message: string;
}

const formData = ref<FormData>({
  name: '',
  email: '',
  subject: '',
  message: '',
});

// バリデーションエラーの型定義 (WordPress の REST API エラー構造)
interface ApiValidationError {
  code?: string;
  message?: string;
  data?: Record<string, any>;
  errors?: Record<string, string[]>;
}

const isSubmitting = ref<boolean>(false);
const step = ref<'form' | 'complete'>('form');
const errorMessage = ref<string>('');
const errors = ref<Record<string, string[]>>({});

/** 送信処理 */
const submitForm = async (): Promise<void> => {
  isSubmitting.value = true;
  errorMessage.value = '';
  errors.value = {};

  try {
    const response = await axios.post(props.url, formData.value, {
      headers: {
        'X-WP-Nonce': props.wpNonce,
        'Content-Type': 'application/json',
      },
    });

    console.log(response);
    step.value = 'complete';
  } catch (error) {
    // AxiosError 型としてキャッチする
    const axiosError = error as AxiosError<ApiValidationError>;
    const response = axiosError.response;
    
    console.error(response);
    
    if (response?.status === 422) {
      // 422エラーの場合、エラーメッセージ群を格納
      errors.value = response.data?.errors || {};
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
</script>

<template>
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

  <div v-if="step === 'complete'" class="bg-green-100 text-green-700 p-4 rounded mb-4">
    送信が完了しました。
  </div>
</template>