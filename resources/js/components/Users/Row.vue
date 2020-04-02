<template>
    <tr>
        <td v-text="user.name"></td>
        <td
            v-text="
                user.department != null
                    ? user.department.name.toUpperCase()
                    : 'Não informado'
            "
        ></td>
        <td v-text="user.status ? 'Ativo' : 'Inativo'"></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn"
                    :class="{
                        'btn-dark': user.status,
                        'btn-success': !user.status,
                    }"
                    @click.prevent="send"
                >
                    <i class="far fa-eye" v-if="!user.status"></i>
                    <i class="far fa-eye-slash" v-else></i>
                </button>
                <a :href="`/users/${user.id}/edit`" class="btn btn-warning"
                    ><i class="far fa-edit"></i
                ></a>
                <button class="btn btn-danger" @click.prevent="destroy">
                    <i class="far fa-trash-alt"></i>
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
            window.events.$emit("quick_view", this.user);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/users/${this.user.id}`, {
                        change_status: true,
                    })
                    .then((result) => {
                        this.user.status = result.data.status;
                        window.flash("Usuario alterado com sucesso!");
                    })
                    .catch((errors) =>
                        window.flash(
                            "Aldo deu errado. Contate o setor de TI",
                            "danger"
                        )
                    );
            },
            500,
            { trailing: false }
        ),
        destroy() {
            window.swal
                .fire({
                    title: "Voce tem certeza?",
                    text: `Voce ira excluir o usuario ${this.user.name}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok",
                    cancelButtonText: "Cancelar",
                })
                .then((result) => {
                    if (result.value) {
                        axios
                            .delete(`users/${this.user.id}`)
                            .then((result) => {
                                window.flash("Usuario excluido com sucesso!");
                                window.events.$emit("remove_user", this.user);
                            })
                            .catch((errors) => {
                                window.flash("Algo deu errado.", "danger");
                                console.error(errors);
                            });
                    }
                });
        },
    },
};
</script>
