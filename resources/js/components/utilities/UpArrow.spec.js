import { shallowMount } from "@vue/test-utils";
import UpArrow from "./UpArrow.vue";

describe("up arrow", () => {
    it("contains a svg", () => {
        const wrapper = shallowMount(UpArrow);

        expect(wrapper.html()).toContain("svg");
    });

    it("contains collapse text", () => {
        const wrapper = shallowMount(UpArrow);

        expect(wrapper.html()).toContain("Collapse");
    });
});
