<template>
    <tr>
        <td
            class="text-capitalize"
            v-text="`${subdepartment.department.name} - ${subdepartment.name}`"
        ></td>
        <td
            v-text="
                subdepartment.email != null
                    ? subdepartment.email
                    : 'Não informado'
            "
        ></td>
        <td v-text="subdepartment.status ? 'Ativo' : 'Inativo'"></td>
        <td>
            <div class="col-md-12 d-flex justify-content-around flex-wrap">
                <button
                    class="btn"
                    :class="{
                        'btn-dark': subdepartment.status,
                        'btn-success': !subdepartment.status,
                    }"
                    @click.prevent="send"
                >
                    <i class="far fa-eye" v-if="!subdepartment.status"></i>
                    <i class="far fa-eye-slash" v-else></i>
                </button>
                <a
                    :href="`/subdepartments/${subdepartment.id}/edit`"
                    class="btn btn-warning"
                    ><i class="far fa-edit"></i
                ></a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["subdepartment"],
    data() {
        return {};
    },
    methods: {
        view() {
            window.events.$emit("quick_view", this.subdepartment);
        },
        send: _.throttle(
            function() {
                axios
                    .patch(`/subdepartments/${this.subdepartment.id}`, {
                        change_status: this.subdepartment.status ? false : true,
                    })
                    .then((result) => {
                        this.subdepartment.status = result.data.status;
                        window.flash("Função alterada com sucesso!");
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
    },
};
</script>
