<template>
    <form
        class="container"
        @keydown="form.errors.clear($event.target.name)"
        @submit.prevent="send"
        enctype="multipart/form-data"
    >
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mb-2">
                <div class="form-group bmd-form-group">
                    <label for="department">Departamento</label>
                    <select
                        name="department"
                        id="department"
                        class="form-control"
                        v-model="form.department"
                    >
                        <option value="">SEM DEPARTAMENTO</option>
                        <option
                            v-for="department in departments"
                            :value="department.id"
                            :key="department.id"
                            v-text="department.name.toUpperCase()"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('department')"
                        v-if="form.errors.has('department')"
                    ></small>
                </div>
            </div>
            <submit-button align="justify-content-center" />
        </div>
    </form>
</template>
<script>
import Form from "../../form-validation/Form";
import SubmitButton from "../Utilities/SubmitButton";
export default {
    props: ["auth_user"],
    data() {
        return {
            form: new Form({
                department: "",
                set_department: true
            }),
            departments: []
        };
    },
    components: {
        SubmitButton
    },
    methods: {
        fetch() {
            this.departments = [];
            axios
                .get("/departments")
                .then(result => {
                    this.departments = result.data;
                })
                .catch(errors => {
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
                .then(result => {
                    window.flash("Obrigado!");
                    window.location = "/";
                    window.events.$emit("loading", false);
                })
                .catch(errors => {
                    window.flash("Algo deu errado.", "danger");
                    console.error(errors.response.message);
                    window.events.$emit("loading", false);
                });
        }
    },
    created() {
        this.fetch();
    }
};
</script>
