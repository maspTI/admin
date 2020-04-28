<template>
    <div class="row">
        <div class="col-md-12">
            <filter-component />
        </div>
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <table-row
                            v-if="subdepartments.length"
                            v-for="subdepartment in subdepartments"
                            :key="subdepartment.id"
                            :subdepartment="subdepartment"
                        />
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <paginator v-if="paginate.last_page > 1" :paginate="paginate" />
        </div>
    </div>
</template>
<script>
import TableRow from "./Row";
import FilterComponent from "./Filter";
import Paginator from "../Utilities/Paginator";
export default {
    data() {
        return {
            subdepartments: [],
            paginate: {},
            filters: {
                department: "all",
                paginate: 10,
                search: "",
                status: "all",
            },
        };
    },
    components: {
        TableRow,
        FilterComponent,
        Paginator,
    },
    methods: {
        fetch(url = null) {
            axios
                .get(
                    url === null
                        ? `/subdepartments?paginate=${this.filters.paginate}&search=${this.filters.search}&status=${this.filters.status}`
                        : url
                )
                .then((result) => {
                    this.subdepartments = result.data.data;
                    delete result.data.data;
                    this.paginate = result.data;
                })
                .catch((errors) => {
                    window.flash(
                        "Algo deu errado. Tente recarregar a página.",
                        "danger"
                    );
                    console.error(errors.response.data.message);
                });
        },
    },
    created() {
        this.fetch();
        window.events.$on("search", (filter) => {
            this.filters = filter;
            this.fetch();
        });

        window.events.$on("page", (url) => {
            this.fetch(
                `${url}&paginate=${this.filters.paginate}&search=${this.filters.search}&status=${this.filters.status}`
            );
        });
    },
};
</script>
