import { shallowMount } from "@vue/test-utils";
import Complete from "./Complete.vue";

describe("complete status", () => {
    it("contains a svg", () => {
        const wrapper = shallowMount(Complete);

        expect(wrapper.html()).toContain("svg");
    });

    it("contains complete text", () => {
        const wrapper = shallowMount(Complete);

        expect(wrapper.html()).toContain("Complete");
    });
});
