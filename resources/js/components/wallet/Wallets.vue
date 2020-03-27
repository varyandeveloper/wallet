<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-bold">Wallets</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="wallet in wallets">
                                <div class="row">
                                    <div class="col-6">{{wallet.currency.symbol + ' ' + wallet.name}}</div>
                                    <div class="col-3">{{wallet.balance.toFixed(2) + ' ' + wallet.currency.code}}</div>
                                    <div class="col-3">
                                        <a class="btn btn-info btn-sm" title="Transactions" v-bind:href="'/wallets/' + wallet.id + '/transactions'">
                                            <i class="fa fa-exchange"></i>
                                            <span class="badge badge-light">{{wallet.transactions_count}}</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="/" class="btn btn-light"><i class="fa fa-arrow-left"></i> Dashboard</a>
                        <a href="/wallets/create" class="btn btn-success"><i class="fa fa-plus"></i> Wallet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Wallets",

        props: ['wallets']
    }
</script>

<style scoped>

</style>
