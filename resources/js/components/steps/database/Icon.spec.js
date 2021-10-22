import { shallowMount } from '@vue/test-utils';
import Icon from './Icon.vue';

describe('server requirements icon', () => {
  it('contains a svg', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('svg');
  });

  it('contains server requirements text', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('Database Requirements');
  });
});
