<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-bold">Create Wallet</h4>
                        <small v-if="errors.general" class="text-danger">{{errors.general}}</small>
                    </div>
                    <form method="post" @submit.prevent="onFormSubmit">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="wallet_type" class="col-form-label">Type</label>
                                <select class="form-control" id="wallet_type" v-model="type">
                                    <option v-for="type in types" :key="type.value" :value="type.value">{{type.label}}</option>
                                </select>
                                <small v-if="errors.type" class="text-danger">{{errors.type}}</small>
                            </div>
                            <div class="form-group">
                                <label for="wallet_currency" class="col-form-label">Currency</label>
                                <select class="form-control" id="wallet_currency" v-model="currency">
                                    <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{currency.name}}</option>
                                </select>
                                <small v-if="errors.currency" class="text-danger">{{errors.currency}}</small>
                            </div>
                            <div class="form-group">
                                <label for="wallet_name" class="col-form-label">Name</label>
                                <input class="form-control" type="text" id="wallet_name" v-model="name">
                                <small v-if="errors.name" class="text-danger">{{errors.name}}</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/wallets" class="btn btn-light"><i class="fa fa-arrow-left"></i> Wallets</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WalletForm",

        props: ['types', 'currencies'],

        data () {
            return {
                errors: {},
                name: '',
                type: 0,
                currency: 0
            }
        },

        methods: {
            onFormSubmit: function (e) {
                this.errors = {};

                if (!this.type) {
                    this.errors.type = 'The Type field is required.';
                }

                if (!this.currency) {
                    this.errors.currency = 'The Currency field is required.';
                }

                if (this.name.trim() === '') {
                    this.errors.name = 'The Name field is required.';
                }

                if (!Object.keys(this.errors).length) {
                    axios.post('/wallets', {
                        name: this.name,
                        type: this.type,
                        currency: this.currency
                    }).then(response => {
                        if (response.data.status === 'success') {
                            window.location.href = '/wallets';
                        }
                    }, error => {
                        this.errors.general = error.response.data.message;
                    })
                }
            }
        }
    }
</script>

<style>

</style>
