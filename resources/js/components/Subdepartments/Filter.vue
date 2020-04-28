<template>
    <div class="row d-flex align-items-end">
        <div class="col-md-4">
            <div class="form-group bmd-form-group">
                <label for="search" class="bmd-label-floating">Busca</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    v-model="filters.search"
                    class="form-control"
                    @keyup="search"
                    autofocus
                />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group">
                <label for="paginate">Itens por página</label>
                <select
                    name="paginate"
                    id="paginate"
                    class="form-control"
                    v-model="filters.paginate"
                    @change="search"
                >
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="all">Todos</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group bmd-form-group">
                <label for="status">Status</label>
                <select
                    name="status"
                    id="status"
                    class="form-control"
                    v-model="filters.status"
                    @change="search"
                >
                    <option value="all">Todos</option>
                    <option value="1">Ativo</option>
                    <option value="2">Inativo</option>
                </select>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            filters: {
                paginate: 10,
                search: "",
                status: "all"
            }
        };
    },
    methods: {
        search: _.debounce(function() {
            window.events.$emit("search", this.filters);
        }, 350)
    }
};
</script>
