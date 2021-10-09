import { shallowMount } from '@vue/test-utils';
import Icon from './Icon.vue';

describe('language settings icon', () => {
  it('contains a svg', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('svg');
  });

  it('contains language requirements text', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('Language');
  });
});
