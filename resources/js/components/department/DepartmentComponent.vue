<template>
    <div>
        <div v-if="success" class="alert alert-success">
            {{ success }}
        </div>
        <h2>Departments</h2>
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
                                    style="height: 25px; width: 100%"
                                    class="input-field"
                                    type="text"
                                    placeholder="Search for departments"
                                    v-model="searchQuery"
                                />
                            </div>
                        </div>

                        <div style="display: flex; align-items: center;  justify-content: space-between;">
                        
             <button  class="btn btn-light p-1 btn-icon" style="background-color: lightgrey; color: #76aefd; height: 30px; width:60px">
              All
              <i class="mdi mdi-close" style="font-size: 17px; margin-left: 5px;"></i>
            </button>
              <div style="margin-left: 10px;"></div>

                       <button
                                style="height: 10px"
                                class="btn btn-light p-3 btn-icon"
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
                                        <th></th>
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
                                                {{
                                                    department.partners.length
                                                }}</span
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
                                            <div
                                                v-if="
                                                    department.kpiMetrics &&
                                                    department.kpiMetrics
                                                        .length > 0
                                                "
                                            >
                                                {{
                                                    calculateKpiProgress(
                                                        department.kpiMetrics
                                                    )
                                                }}%
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-success"
                                                        role="progressbar"
                                                        :style="{
                                                            width:
                                                                calculateKpiProgress(
                                                                    department.kpiMetrics
                                                                ) + '%',
                                                        }"
                                                        :aria-valuenow="
                                                            calculateKpiProgress(
                                                                department.kpiMetrics
                                                            )
                                                        "
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                    ></div>
                                                </div>
                                                <span
                                                    v-if="
                                                        calculateKpiProgress(
                                                            department.kpiMetrics
                                                        ) < 50
                                                    "
                                                    class="text-danger"
                                                    >off track</span
                                                >
                                                <span
                                                    v-else-if="
                                                        calculateKpiProgress(
                                                            department.kpiMetrics
                                                        ) >= 50 &&
                                                        calculateKpiProgress(
                                                            department.kpiMetrics
                                                        ) < 80
                                                    "
                                                    class="text-warning"
                                                    >at risk</span
                                                >
                                                <span
                                                    v-else
                                                    class="text-success"
                                                    >on track</span
                                                >
                                            </div>
                                            <div v-else>
                                                0%
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar bg-warning"
                                                        role="progressbar"
                                                        :style="{ width: '0%' }"
                                                        :aria-valuenow="0"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                    ></div>
                                                </div>
                                                off track
                                            </div>
                                        </td>
                                        <td>
                                            <button
                                                class="btn  view-btn"
                                            >
                                             <a
                                                    :href="
                                                        '/departments/' +
                                                        department.id
                                                    "
                                                    class="text-light"
                                                    >
                                                <i
                                                    class="mdi mdi-eye-outline text-light"
                                                ></i>
                                               View Details</a
                                                >
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

import axios from "axios";


export default {


    data() {
        return {
            success: null,
            searchQuery: "",
            base_url: "../",
            showFilters: false,
            departments: [],
            showDepartmentDetail: false,
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
                console.log(this.departments);
            });
        },
        calculateKpiProgress(kpiMetrics) {
            if (!kpiMetrics || kpiMetrics.length === 0) {
                return 0;
            }
            let totalProgress = kpiMetrics.reduce(
                (acc, kpiMetric) => acc + kpiMetric.on_track_value,
                0
            );
            let avgProgress = totalProgress / kpiMetrics.length;
            return Math.round(avgProgress);
        },
    },
};
</script>

<style scoped>

.view-btn {
  cursor: pointer;
  font-size: 12px; /* Adjust font size */
  padding: 5px 10px; /* Adjust padding (top/bottom, left/right) */
  display: flex;
  align-items: center;
  justify-content: center; /* Center the content horizontally */
  border-radius: 8px;
  height: 35px;
  background-color: #0072bb;
}

.btn-icon {
    display: flex;
    align-items: center;
    font-weight: bold;
}

.view-btn a {
  display: flex;
  align-items: center;



}

.view-btn i {
  margin-right: 8px;
}

h2 {

    font-weight: bold;
}

</style>
