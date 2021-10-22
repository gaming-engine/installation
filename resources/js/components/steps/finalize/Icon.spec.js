import { shallowMount } from '@vue/test-utils';
import Icon from './Icon.vue';

describe('finalize icon', () => {
  it('contains a svg', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('svg');
  });

  it('contains finalize text', () => {
    const wrapper = shallowMount(Icon);

    expect(wrapper.html()).toContain('Finalize');
  });
});
