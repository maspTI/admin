<template>
    <form
        class="container-fluid"
        @keydown="form.errors.clear($event.target.name)"
        @submit.prevent="send"
        enctype="multipart/form-data"
    >
        <div class="row d-flex align-items-end justify-content-center">
            <div class="col-md-8" v-if="department == undefined">
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
            <div class="col-md-8">
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
            <div class="col-md-8">
                <div class="form-group bmd-form-group">
                    <label for="email" class="bmd-label-floating">Email</label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        v-model="form.email"
                        class="form-control"
                        autofocus
                    />
                    <small
                        class="text-danger"
                        v-text="form.errors.get('email')"
                        v-if="form.errors.has('email')"
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
    props: ["department", "http_verb", "url", "message"],
    data() {
        return {
            form: new Form({
                name: "",
                email: ""
            }),
            many: false
        };
    },
    components: {
        SubmitButton
    },
    methods: {
        send() {
            window.events.$emit("loading", true);
            this.form[this.http_verb](this.url)
                .then(result => {
                    window.events.$emit("loading", false);
                    window.flash(this.message);
                    document.querySelector("#name").focus();
                    if (!this.many || this.department != undefined) {
                        window.location = "/departments";
                    }
                })
                .catch(errors => {
                    window.events.$emit("loading", false);
                    window.flash("Algo deu errado.", "danger");
                    console.error(errors);
                });
        }
    },
    created() {
        if (this.department != undefined) {
            this.form = new Form({ ...this.department });
        }
    }
};
</script>
