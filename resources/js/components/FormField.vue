<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="mb-4">
                <input
                        :id="field.name"
                        type="text"
                        class="w-full form-control form-input form-input-bordered"
                        :class="errorClasses"
                        :placeholder="field.placeholder"
                        v-model="value"
                />
            </div>

            <div :class="{'flex flex-wrap' : !field.stack}" v-if="field.options">
                <div v-for="(option, val) in field.options" :class="{'mb-2' : field.stack || field.addPadding}"
                     class="mlbz-radio-container">
                    <label :for="`${field.attribute}_${val}`">
                        <input v-model="value" :value="option" :id="`${field.attribute}_${val}`" :name="field.attribute"
                               type="radio">
                        <span class="mblz-radio-label">{{ getOptionLabel(option) }}</span>
                        <span v-if="field.stack && hasOptionHint(option)"
                              class="mlbz-radio-hint mt-1 block text-sm text-80 leading-normal">{{ getOptionHint(option) }}</span>
                    </label>
                </div>
            </div>

            <div v-if="hasError">
                <p class="my-2 text-danger">
                    {{ firstError }}
                </p>
            </div>

        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || ''
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            },
            /**
             * Just determins if the option could potentially have an option.
             */
            hasOptionHint(option) {
                return typeof option === 'object';
            },

            /**
             * Returns back an option if one is found, otherwise void.
             */
            getOptionHint(option) {
                if (this.hasOptionHint(option)) {
                    return option[
                        Object.keys(option).shift()
                        ];
                }
            },
            /**
             * Returns back the label of the option.
             */
            getOptionLabel(option) {
                if (this.hasOptionHint(option)) {
                    return Object.keys(option).shift();
                }

                return option;
            }
        },
    }
</script>
