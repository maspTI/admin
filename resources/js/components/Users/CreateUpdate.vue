<template>
    <form
        class="container-fluid"
        @keydown="form.errors.clear($event.target.name)"
        @submit.prevent="send"
        enctype="multipart/form-data"
    >
        <div class="row d-flex align-items-end">
            <div class="col-md-8" v-if="user == undefined">
                <div class="form-check">
                    <label class="form-check-label">
                        <input
                            class="form-check-input"
                            name="many"
                            id="many"
                            type="checkbox"
                            v-model="many"
                        />
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                        <label for="many">Vários</label>
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="name" class="bmd-label-floating">Nome</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="form.name"
                        class="form-control"
                        autofocus
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('name')"
                        v-if="form.errors.has('name')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="email" class="bmd-label-floating">Email</label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        v-model="form.email"
                        class="form-control"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('email')"
                        v-if="form.errors.has('email')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="department">Departamento</label>
                    <multiselect
                        v-model="form.department"
                        :options="departments"
                        :multiple="false"
                        :close-on-select="true"
                        :clear-on-select="false"
                        :preserve-search="true"
                        placeholder="Selecione um departamento"
                        :custom-label="customLabel"
                        track-by="name"
                        :preselect-first="false"
                        selectLabel="Pressione ENTER para selecionar"
                        deselectLabel="Pressione ENTER para remover"
                        selectedLabel="Selecionado"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('department')"
                        v-if="form.errors.has('department')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="role">Funcoes</label>
                    <multiselect
                        v-model="form.roles"
                        :options="roles"
                        :multiple="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        placeholder="Selecione uma funcao"
                        :custom-label="customLabel"
                        track-by="name"
                        :preselect-first="false"
                        selectLabel="Pressione ENTER para selecionar"
                        deselectLabel="Pressione ENTER para remover"
                        selectedLabel="Selecionado"
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('roles')"
                        v-if="form.errors.has('roles')"
                    ></small>
                </div>
            </div>
            <submit-button />
        </div>
    </form>
</template>
<script>
import Form from "../../form-validation/Form";
import Multiselect from "vue-multiselect";
import SubmitButton from "../Utilities/SubmitButton";
export default {
    props: ["user", "http_verb", "url", "message"],
    data() {
        return {
            form: new Form({
                name: "",
                email: "",
                department: "",
                roles: [],
            }),
            departments: [],
            roles: [],
            many: false,
        };
    },
    components: {
        Multiselect,
        SubmitButton,
    },
    methods: {
        send() {
            window.events.$emit("loading", true);
            this.form[this.http_verb](this.url)
                .then((result) => {
                    window.events.$emit("loading", false);
                    window.flash(this.message);
                    document.querySelector("#name").focus();
                    if (!this.many || this.user != undefined) {
                        window.location = "/users";
                    }
                })
                .catch((errors) => {
                    window.events.$emit("loading", false);
                    window.flash("Algo deu errado.", "danger");
                    console.error(errors);
                });
        },
        fetch(data) {
            this[data] = [];
            axios
                .get(`/${data}`)
                .then((result) => {
                    this[data] = result.data;
                })
                .catch((errors) => {
                    window.flash(
                        "Algo deu errado. Tente recarregar a página.",
                        "danger"
                    );
                    console.error(errors.response.data.message);
                });
        },
        customLabel(data) {
            return `${data.name.toUpperCase()}`;
        },
    },
    created() {
        this.fetch("departments");
        this.fetch("roles");
        if (this.user != undefined) {
            this.form = new Form({ ...this.user });
        }
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
