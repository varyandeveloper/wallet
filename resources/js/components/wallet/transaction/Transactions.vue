<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-bold">{{wallet.name}} Transactions</h4>
                    </div>
                    <div class="card-body">
                        <table v-if="transactions.length" class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="transaction in transactions">
                                    <td>{{transaction.type === 1 ? 'Credit' : 'Debit'}}</td>
                                    <td>
                                        <span v-if="transaction.type === 1" class="px-2 badge badge-success">{{transaction.amount}}</span>
                                        <span v-if="transaction.type === 2" class="px-2 badge badge-danger">{{transaction.amount}}</span>
                                    </td>
                                    <td>{{transaction.currency.code}}</td>
                                    <td>{{transaction.transaction_date}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row" v-if="!transactions.length">
                            <div class="col-12">
                                <h5 class="text-info">No transaction found for {{wallet.name}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/wallets" class="btn btn-light"><i class="fa fa-arrow-left"></i> Wallets</a>
                        <a v-bind:href="'/wallets/' + wallet.id + '/transactions/create'" class="btn btn-success"><i class="fa fa-plus"></i> Transaction</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Transactions",

        props: ['wallet', 'transactions']
    }
</script>

<style scoped>

</style>
