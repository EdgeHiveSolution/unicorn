<template>
    <div>
        <div v-if="success" class="alert alert-success">
            {{ success }}
        </div>
        <h2>Department</h2>
        <p>Manage and track department performance.</p>
        <div class="">
            <div class="btn btn-primary my-4">
                <a class="text-light" href="/departments/create"
                    >+ Add Department</a
                >
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between my-3"
                    >
                        <div>
                            <div class="input-container">
                                <i class="mdi mdi-magnify mdi-icon"></i>
                                <input
                                    class="input-field"
                                    type="text"
                                    placeholder="Search for departments"
                                    v-model="searchQuery"
                                />
                            </div>
                        </div>

                        <div>
                            <button
                                class="btn btn-light p-3"
                                @click="showFilters = !showFilters"
                            >
                                <i class="mdi mdi-sort-variant text-dark"></i>
                                Filters
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <p v-if="departments.length === 0">
                                No department found
                            </p>
                            <table v-else class="table">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Members</th>
                                        <th>Active KPIs</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="department in departments"
                                        :key="department.id"
                                    >
                                        <td>
                                            <span class="txt-dark">
                                                {{ department.name }}</span
                                            >
                                            <br />
                                            <span class="txt-gray">
                                                Partners:
                                                {{ department.partners.length }}</span
                                            >
                                        </td>

                                        <td class="td-members">
                                            <template
                                                v-if="
                                                    department.members.length >
                                                    0
                                                "
                                            >
                                                <img
                                                    v-for="member in department.members"
                                                    :key="member.id"
                                                    src="assets/images/faces/face1.jpg"
                                                    :alt="member.email"
                                                />
                                            </template>
                                            <template v-else> N/A </template>
                                        </td>

                                        <td>
                                        48%
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" :style="{ width: '68%' }"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        on track
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-pri px-2 py-1 d-flex align-items-center"
                                            >
                                                <i
                                                    class="mdi mdi-eye-outline text-light"
                                                ></i>
                                                <a :href="'/departments/' + department.id" class="text-light">View</a>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pagination">
                                <button
                                    class="page-link"
                                    v-if="pagination.previous"
                                    @click="
                                        fetchDepartments(pagination.previous)
                                    "
                                >
                                    Previous
                                </button>
                                <span class="page-number">{{
                                    pagination.current_page
                                }}</span>
                                <button
                                    class="page-link"
                                    v-if="pagination.next"
                                    @click="fetchDepartments(pagination.next)"
                                >
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            success: null,
            searchQuery: "",
            base_url: "../",
            showFilters: false,
            departments: [],
            pagination: {},
        };
    },
    mounted() {
        this.fetchDepartments();
    },
    methods: {
        fetchDepartments() {
            let uri = this.base_url + `api/v1/department-list`;
            axios.get(uri).then((response) => {
                this.departments = response.data;
            });
        },
    },
};
</script>

<style>
/* Add your custom styles here */
</style>
