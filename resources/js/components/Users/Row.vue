<template>
    <tr>
        <td v-text="user.name"></td>
        <td
            v-text="user.department != null ? user.email : 'Não informado'"
        ></td>
        <td v-text="user.status ? 'Ativo' : 'Inativo'"></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn"
                    :class="{
                        'btn-dark': user.status,
                        'btn-success': !user.status
                    }"
                    @click.prevent="send"
                >
                    <i class="fas fa-user-shield" v-if="!user.status"></i>
                    <i class="fas fa-user" v-else></i>
                </button>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["user"],
    data() {
        return {};
    },
    methods: {
        view() {
            window.events.$emit('quick_view', this.user);
        },
        send: _.throttle(function () {
            axios
                .patch(`/users/${this.user.id}`, {
                    change_status: this.user.status ? false : true
                })
                .then(result => {
                    this.user.status = result.data.status;
                    window.flash("Função alterada com sucesso!");
                })
                .catch(errors =>
                    window.flash(
                        "Aldo deu errado. Contate o setor de TI",
                        "danger"
                    )
                );
        }, 500, { 'trailing': false })
    }
};
</script>
