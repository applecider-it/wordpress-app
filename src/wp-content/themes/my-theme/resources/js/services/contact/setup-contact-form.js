
import { createApp } from 'vue';

import ContactForm from './vue/ContactForm.vue';

const el = document.getElementById('my-contact-app');

if (el) {
  const all = JSON.parse(el.dataset.all);

  console.log(all);

  createApp(ContactForm, {
    wpNonce: all.wpNonce,
    url: all.url,
  }).mount(el);
}
