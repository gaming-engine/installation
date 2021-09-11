import { shallowMount } from "@vue/test-utils";
import DownArrow from "./DownArrow.vue";

describe("down arrow", () => {
    it("contains a svg", () => {
        const wrapper = shallowMount(DownArrow);

        expect(wrapper.html()).toContain("svg");
    });

    it("contains expand text", () => {
        const wrapper = shallowMount(DownArrow);

        expect(wrapper.html()).toContain("Expand");
    });
});
