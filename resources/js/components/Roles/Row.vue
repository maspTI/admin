<template>
    <tr>
        <td v-text="role.name.toUpperCase()"></td>
        <td v-text="role.status ? 'Ativo' : 'Inativo'"></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn"
                    :class="{
                        'btn-dark': role.status,
                        'btn-success': !role.status
                    }"
                    @click.prevent="send"
                >
                    <i class="far fa-eye" v-if="!role.status"></i>
                    <i class="far fa-eye-slash" v-else></i>
                </button>
                <a :href="`/roles/${role.id}/edit`" class="btn btn-warning"
                    ><i class="far fa-edit"></i
                ></a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["role"],
    data() {
        return {};
    },
    methods: {
        view() {
            window.events.$emit("quick_view", this.role);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/roles/${this.role.id}`, {
                        change_status: this.role.status ? false : true
                    })
                    .then(result => {
                        this.role.status = result.data.status;
                        window.flash("Função alterada com sucesso!");
                    })
                    .catch(errors =>
                        window.flash(
                            "Aldo deu errado. Contate o setor de TI",
                            "danger"
                        )
                    );
            },
            500,
            { trailing: false }
        )
    }
};
</script>
