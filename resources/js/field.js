Nova.booting((Vue, router, store) => {
    Vue.component('index-text-choice', require('./components/IndexField'))
    Vue.component('detail-text-choice', require('./components/DetailField'))
    Vue.component('form-text-choice', require('./components/FormField'))
})
