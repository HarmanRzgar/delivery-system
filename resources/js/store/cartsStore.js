// import { createPinia, defineStore } from "pinia";
//
// export const useCartsStore = defineStore("carts", {
//     state: () => ({
//         carts: null,
//     }),
//     actions: {
//         setCarts(carts) {
//             this.carts = carts;
//             localStorage.setItem("carts", JSON.stringify(carts));
//         },
//         addToCart(cart) {
//             if (!this.carts) {
//                 this.carts = [];
//             }
//             this.carts.push(cart);
//             localStorage.setItem("carts", JSON.stringify(this.carts));
//         },
//         restoreCarts() {
//             const cartsStored = localStorage.getItem("carts");
//             if (cartsStored) {
//                 this.carts = JSON.parse(cartsStored);
//             }
//         },
//     },
//
// });
