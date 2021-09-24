import { createApp } from 'vue';
import Wizard from './components/Wizard.vue';
import Complete from './components/status/Complete.vue';
import Incomplete from './components/status/Incomplete.vue';
import UpArrow from './components/utilities/UpArrow.vue';
import DownArrow from './components/utilities/DownArrow.vue';
import DropDownList from './components/form/DropDownList.vue';
import InputField from './components/form/InputField.vue';
import PasswordField from './components/form/PasswordField.vue';
import FormButton from './components/form/FormButton.vue';

require('./bootstrap');

const app = createApp({});

app.component('wizard', Wizard);

app.component('complete', Complete);
app.component('incomplete', Incomplete);

app.component('up-arrow', UpArrow);
app.component('down-arrow', DownArrow);

app.component('drop-down', DropDownList);
app.component('input-field', InputField);
app.component('password-field', PasswordField);
app.component('form-button', FormButton);

const cleanse = (component) => component
  .split(/(?=[A-Z])/)
  .join('-')
  .toLowerCase();

const steps = require.context('./components/steps', true, /\.vue$/i);
steps.keys().forEach((key) => {
  const [, identifier, fileName] = key.toLowerCase().split('/');
  const type = fileName.split('.')[0];
  app.component(
    cleanse(
      `${identifier}-${type}`,
    ), steps(key).default,
  );
});

app.mount('#app');
