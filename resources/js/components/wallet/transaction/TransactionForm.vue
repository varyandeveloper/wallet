<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-bold">Add Transaction</h4>
                        <small v-if="errors.general" class="text-danger">{{errors.general}}</small>
                    </div>
                    <form method="post" @submit.prevent="onFormSubmit">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="transaction_type" class="col-form-label">Type</label>
                                <select class="form-control" id="transaction_type" v-model="type">
                                    <option v-for="type in types" :key="type.value" :value="type.value">{{type.label}}</option>
                                </select>
                                <small v-if="errors.type" class="text-danger">{{errors.type}}</small>
                            </div>
                            <div class="form-group">
                                <label for="transaction_currency" class="col-form-label">Currency</label>
                                <select class="form-control" id="transaction_currency" v-model="currency">
                                    <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{currency.name}}</option>
                                </select>
                                <small v-if="errors.currency" class="text-danger">{{errors.currency}}</small>
                            </div>
                            <div class="form-group">
                                <label for="transaction_amount" class="col-form-label">Amount</label>
                                <input v-model="amount" class="form-control" id="transaction_amount" type="number" step="0.01" min="1">
                                <small v-if="errors.amount" class="text-danger">{{errors.amount}}</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a v-bind:href="'/wallets/' + wallet.id + '/transactions'" class="btn btn-light"><i class="fa fa-arrow-left"></i> Transactions</a>
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
        name: "TransactionForm",

        props: ['wallet', 'currencies', 'types'],

        data() {
            return {
                type: 0,
                currency: 0,
                amount: 0,
                errors: {}
            }
        },

        methods: {
            onFormSubmit: function (e) {
                this.errors = {};

                if (this.type < 1) {
                    this.errors.type = 'The Type field is required.';
                }

                if (this.currency < 1) {
                    this.errors.currency = 'The Currency field is required.';
                }

                if (parseInt(this.amount) < 1) {
                    this.errors.amount = 'The Amount should be greater then 1.';
                }


                if (!Object.keys(this.errors).length) {
                    axios.post('/wallets/' + this.wallet.id + '/transactions', {
                        type: this.type,
                        amount: this.amount,
                        currency: this.currency
                    }).then(response => {
                        if (response.data.status === 'success') {
                            window.location.href = '/wallets/' + this.wallet.id + '/transactions';
                        }
                    }, error => {
                        this.errors.general = error.response.data.message;
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
