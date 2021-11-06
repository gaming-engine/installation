import { shallowMount } from '@vue/test-utils';
import Icon from './Icon.vue';

describe('site details icon', () => {
  it('contains a svg', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('svg');
  });

  it('contains site details text', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('Site Details');
  });
});
