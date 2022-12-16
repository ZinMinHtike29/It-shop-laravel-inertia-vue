import Vue from '@inertiajs/inertia-vue3'
import Vuex from 'vuex'


export const store = new Vuex.Store({
    state: {
        cart: [],
        userSaveProduct: 0
    },

    actions: {
        addProduct: ({ state }, value) => state.cart.push(value),
        deleteProduct: ({ state }, index) => state.cart.splice(index, 1),
        clearCart: ({ state }) => state.cart = [],
        setUserSaveCount: ({ state }, value) => state.userSaveProduct = value,
        addUserSavecount: ({ state }) => state.userSaveProduct++
    }

})