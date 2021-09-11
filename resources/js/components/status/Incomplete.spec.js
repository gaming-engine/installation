import { shallowMount } from "@vue/test-utils";
import Incomplete from "./Incomplete.vue";

describe("incomplete status", () => {
    it("contains a svg", () => {
        const wrapper = shallowMount(Incomplete);

        expect(wrapper.html()).toContain("svg");
    });

    it("contains incomplete text", () => {
        const wrapper = shallowMount(Incomplete);

        expect(wrapper.html()).toContain("Incomplete");
    });
});
