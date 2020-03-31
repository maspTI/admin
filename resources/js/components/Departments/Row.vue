<template>
    <tr>
        <td v-text="department.name.toUpperCase()"></td>
        <td
            v-text="
                department.email != null ? department.email : 'Não informado'
            "
        ></td>
        <td v-text="department.status ? 'Ativo' : 'Inativo'"></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn"
                    :class="{
                        'btn-dark': department.status,
                        'btn-success': !department.status
                    }"
                    @click.prevent="send"
                >
                    <i class="far fa-eye" v-if="!department.status"></i>
                    <i class="far fa-eye-slash" v-else></i>
                </button>
                <a
                    :href="`/departments/${department.id}/edit`"
                    class="btn btn-warning"
                    ><i class="far fa-edit"></i
                ></a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["department"],
    data() {
        return {};
    },
    methods: {
        view() {
            window.events.$emit("quick_view", this.department);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/departments/${this.department.id}`, {
                        change_status: this.department.status ? false : true
                    })
                    .then(result => {
                        this.department.status = result.data.status;
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
