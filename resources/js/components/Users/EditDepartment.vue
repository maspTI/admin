<template>
    <form
        class="container"
        @keydown="form.errors.clear($event.target.name)"
        @submit.prevent="send"
        enctype="multipart/form-data"
    >
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="form-group bmd-form-group">
                    <label for="department">Departamento</label>
                    <multiselect
                        :options="departments"
                        :searchable="true"
                        :allow-empty="false"
                        placeholder="Selecione uma opção"
                        selectLabel="Pressione Enter para selecionar"
                        deselectLabel="Pressione Enter para remover"
                        selectedLabel="Selecionado"
                        track-by="name"
                        label="name"
                        v-model="form.department"
                        @select="select"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('department')"
                        v-if="form.errors.has('department')"
                    ></small>
                </div>
            </div>
            <div class="col-md-8 mb-2" v-if="subdepartments.length">
                <div class="form-group bmd-form-group">
                    <label for="subdepartment">Subdepartamento</label>
                    <multiselect
                        :options="subdepartments"
                        :searchable="true"
                        :allow-empty="false"
                        placeholder="Selecione uma opção"
                        selectLabel="Pressione Enter para selecionar"
                        deselectLabel="Pressione Enter para remover"
                        selectedLabel="Selecionado"
                        track-by="name"
                        label="name"
                        v-model="form.subdepartment"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('subdepartment')"
                        v-if="form.errors.has('subdepartment')"
                    ></small>
                </div>
            </div>
            <div class="col-md-8 mb-2">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating" for="role">Função</label>
                    <input
                        class="form-control"
                        name="role"
                        id="role"
                        v-model="form.role"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('role')"
                        v-if="form.errors.has('role')"
                    ></small>
                </div>
            </div>
            <div class="col-md-8 mb-2">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating" for="cpf_cnpj"
                        >CPF/CNPJ</label
                    >
                    <the-mask
                        class="form-control"
                        name="cpf_cnpj"
                        id="cpf_cnpj"
                        :mask="['###.###.###-##', '##.###.###/####-##']"
                        v-model="form.cpf_cnpj"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('cpf_cnpj')"
                        v-if="form.errors.has('cpf_cnpj')"
                    ></small>
                </div>
            </div>
            <div class="col-md-8 mb-2">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating" for="registration_code"
                        >Matrícula</label
                    >
                    <input
                        class="form-control"
                        name="registration_code"
                        id="registration_code"
                        v-model="form.registration_code"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('registration_code')"
                        v-if="form.errors.has('registration_code')"
                    ></small>
                </div>
            </div>
            <submit-button align="justify-content-center" />
        </div>
    </form>
</template>
<script>
import Form from "../../form-validation/Form";
import { TheMask } from "vue-the-mask";
export default {
    props: ["auth_user"],
    data() {
        return {
            form: new Form({
                department: "",
                subdepartment: "",
                role: "",
                cpf_cnpj: "",
                registration_code: "",
                set_department: true,
            }),
            departments: [],
            subdepartments: [],
        };
    },
    components: {
        TheMask,
    },
    methods: {
        fetch(entity, department = null) {
            this[entity] = [];
            this.form.subdepartment = "";
            axios
                .get(
                    `/${entity}${
                        entity === "subdepartments"
                            ? "?department=" + department.id
                            : ""
                    }`
                )
                .then((result) => {
                    this[entity] = result.data;
                })
                .catch((errors) => {
                    window.flash(
                        "Algo deu errado. Tente recarregar a página.",
                        "danger"
                    );
                    console.error(errors.response.data.message);
                });
        },
        send() {
            window.events.$emit("loading", true);
            this.form
                .patch(`/users/${this.auth_user.id}`)
                .then((result) => {
                    window.flash("Obrigado!");
                    window.location = "/";
                    window.events.$emit("loading", false);
                })
                .catch((errors) => {
                    window.flash("Algo deu errado.", "danger");
                    window.events.$emit("loading", false);
                });
        },
        select(selected) {
            this.fetch("subdepartments", selected);
        },
    },
    created() {
        this.fetch("departments");
    },
};
</script>
