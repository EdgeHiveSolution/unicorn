<template>
    <div>
        <div v-if="success" class="alert alert-success">
            {{ success }}
        </div>
        <h4>Departments</h4>
        <p>Manage and track department performance.</p>
        <div class="">
            <!--<div class="btn primary_button my-4">
                <a class="text-light" href="/departments/create"-->
            <div >
                <a class="text-light btn primary_button my-4" href="/departments/create"
                    >+ Add Department</a
                >
            </div>
<!-- 
            <div v-for="data in this.departments" :key="data.id">
                        {{data.partners}}
            </div> -->
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

                        <div
                            style="
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                            "
                        >
                            <button
                                class="btn btn-light p-1 btn-icon"
                                style="
                                    background-color: lightgrey;
                                    color: #76aefd;
                                    height: 30px;
                                    width: 60px;
                                "
                            >
                                All
                                <i
                                    class="mdi mdi-close"
                                    style="font-size: 17px; margin-left: 5px"
                                ></i>
                            </button>
                            <div style="margin-left: 10px"></div>

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
                                        v-for="department in departmentsWithProgress"
                                        :key="department.id"
                                    >
                                        <td>
                                            <span class="txt-dark">{{
                                                department.name
                                            }}</span
                                            ><br />
                                            <span class="txt-gray"
                                                >Partners:
                                            
                                                   {{ uniquePartnerCount(department.partners)
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
                                            <template v-else>N/A</template>
                                        </td>
                                        <td
                                            v-if="
                                                department.calculatedProgress >
                                                0
                                            "
                                           >
                                            <div>
                                                {{
                                                    department.calculatedProgress.toFixed(
                                                        2
                                                    )
                                                }}%
                                                <div class="progress">
                                                    <div
                                                        class="progress-bar"
                                                        :class="
                                                            getStatusClass(
                                                                department
                                                            )
                                                        "
                                                        :style="{
                                                            width:
                                                                department.calculatedProgress +
                                                                '%',
                                                        }"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                    ></div>
                                                </div>
                                                <div class="progress-labels">
                                                    <span
                                                        class="status-label off-track-label"
                                                        v-if="
                                                            getStatusClass(
                                                                department
                                                            ) === 'off-track'
                                                        "
                                                        >Off Track</span
                                                    >
                                                    <span
                                                        class="status-label at-risk-label"
                                                        v-else-if="
                                                            getStatusClass(
                                                                department
                                                            ) === 'at-risk'
                                                        "
                                                        >At Risk</span
                                                    >
                                                    <span
                                                        class="status-label on-track-label"
                                                        v-else-if="
                                                            getStatusClass(
                                                                department
                                                            ) === 'on-track'
                                                        "
                                                        >On Track</span
                                                    >
                                                </div>
                                            </div>
                                        </td>
                                        <td v-else>No Active Kpis</td>
                                        <td>
                                            <button class="btn view-btn">
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
                                                    View Details
                                                </a>
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

    computed: {
         departmentsWithProgress() {
    const uniqueDepartments = new Set();
    this.departments.forEach((department) => {
      // Create a string based on the properties that should make the department unique
      const uniqueKey = `${department.name}`; // Replace with your criteria
      uniqueDepartments.add(uniqueKey);
    });

    // Convert the Set back to an array of unique departments
    const uniqueDepartmentsArray = Array.from(uniqueDepartments).map((uniqueKey) => {
      const department = this.departments.find((dept) => dept.name === uniqueKey); // Find the department with the unique key
      return {
        ...department,
        calculatedProgress: this.calculateKpiProgress(department.partners),
        statusClass: this.getStatusClass(department),
      };
    });

    return uniqueDepartmentsArray;
  },
    },

    // watch: {
    //     // Watch for changes in the 'departments' array
    //     departments: {
    //         handler(newDepartments) {
    //             console.log("Departments changed:", newDepartments);
    //         },
    //         deep: true, // Watch changes in nested objects within the array
    //     },

    //     // Watch for changes in the 'calculatedProgress' property
    //     "departmentsWithProgress.calculatedProgress": {
    //         handler(newProgress) {
    //             console.log("Calculated Progress changed:", newProgress);
    //         },
    //         deep: true, // Watch changes in nested objects within the array
    //     },
    // },

    methods: {
        fetchDepartments() {
            let uri = this.base_url + `api/v1/department-list`;
            axios.get(uri).then((response) => {
                this.departments = response.data;
                console.log(
                    "Departments are:",
                    JSON.stringify(this.departments, null, 2)
                );
            });
        },


        uniquePartnerCount(partners) {
        const uniqueNames = new Set();
        partners.forEach((partner) => {
            // Assuming partner names are unique, add them to the Set
            uniqueNames.add(partner.name); // Replace 'name' with the actual property name of partner names
        });
        return uniqueNames.size;
    },

        calculateKpiProgress(partners) {
            let totalCurrentValue = 0;
            let totalTargetValue = 0;

            partners.forEach((partner) => {
                partner.kpis.forEach((kpi) => {
                    kpi.kpi_metrics.forEach((kpiMetric) => {
                        totalTargetValue += kpiMetric.timely_value;
                        kpiMetric.kpi_metric_members.forEach((member) => {
                            member.progress.forEach((progress) => {
                                totalCurrentValue += progress.current_value;
                            });
                        });
                    });
                });
            });

            if (totalTargetValue === 0) {
                return 0;
            }

            return (totalCurrentValue / totalTargetValue) * 100;
        },

        getStatusClass(department) {
            const progressPercentage = parseFloat(
                department.calculatedProgress
            );

            for (const partner of department.partners) {
                for (const kpi of partner.kpis) {
                    for (const kpiMetric of kpi.kpi_metrics) {
                        const onTrackValue = parseFloat(
                            kpiMetric.on_track_value
                        );
                        const atRiskMin = parseFloat(kpiMetric.at_risk_min);

                        if (progressPercentage >= onTrackValue) {
                            return "on-track";
                        } else if (progressPercentage >= atRiskMin) {
                            return "at-risk";
                        }
                    }
                }
            }

            return "off-track";
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

.progress-bar {
    width: 10px;
    border-radius: 5px;
}

.on-track {
    /*background-color: #5cb85c;*/
    background-color:  #047a48;
}

.at-risk {
    background-color: #f0ad4e;
}

.off-track {
    background-color: #d9534f;
}


.primary_button{
    background-color: #084bf7;
    font-size: 14px;
    font-weight: 300;
}


::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #9ea4b1;
  font-size: 14px;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #9ea4b1;
  font-size: 14px;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: #9ea4b1;
  font-size: 14px;
}

</style>
