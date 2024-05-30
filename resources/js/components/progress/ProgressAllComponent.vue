<template>
    <div>
        <div class="body-items">
        
            <div id="">
                <!-- KPIs content -->

                <div class="row">
                        <div
                            class="col-12 px-0"
                            v-for="(item, index) in progressData1.progress_data"
                            :key="index"
                        >
                            <div>
                                <div class="card mb-5">
                                    <div
                                        class="d-flex justify-content-between p-4"
                                    >
                                        <div>
                                            <h4>
                                                {{
                                                    item.kpi_metric_member
                                                        .kpi_metric.title
                                                }}
                                            </h4>
                                        </div>
                                        <div  v-if="!loggedUser.user_role_id === 1   &&  !loggedUser.user_role_id === 3">
 
                                        <button 
                                            data-toggle="modal"
                                            class="btn btn-light border"
                                            data-target="#addKpimodal2"
                                        >
                                            + Add Progress
                                        </button>

                                        </div>
                                    </div>

                                    <div
                                        class="card-header d-flex justify-content-between my-3"
                                    >
                                        <div>
                                            <div class="input-container">
                                                <i
                                                    class="mdi mdi-magnify mdi-icon"
                                                ></i>
                                                <input
                                                    style="height: 25px"
                                                    class="input-field"
                                                    type="text"
                                                    placeholder="Search Progress "
                                                />
                                            </div>
                                        </div>
                                        <div>
                                            <button
                                                style="height: 10px"
                                                class="btn btn-light p-3 btn-icon"
                                            >
                                                <i
                                                    class="mdi mdi-sort-variant text-dark"
                                                ></i>
                                                Filters
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body mb-5">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Progress Title</th>
                                                        <th>Current</th>
                                                        <th>Target</th>
                                                        <th>Progress</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Your table data rows here with <td> elements -->
                                                    <tr
                                                        v-for="(
                                                            progressEntry,
                                                            progressIndex
                                                        ) in item
                                                            .kpi_metric_member
                                                            .progress"
                                                        :key="progressIndex"
                                                    >
                                                        <td>
                                                            <div>
                                                                <span>{{
                                                                    progressEntry.title
                                                                }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div>
                                                                {{
                                                                    progressEntry.current_value
                                                                }}
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div>
                                                                {{
                                                                    progressEntry.target_value
                                                                }}
                                                            </div>
                                                        </td>
                                                        <td
                                                            v-if="
                                                                item
                                                                    .kpi_metric_member
                                                                    .progress
                                                                    .length ===
                                                                0
                                                            "
                                                        >
                                                            No Progress found
                                                        </td>
                                                        <td class="stats">
                                                            <p
                                                                class="progress_text text-muted"
                                                            >
                                                                {{
                                                                    calculateProgressPercentage(
                                                                        progressEntry
                                                                    )
                                                                }}%
                                                            </p>
                                                            <div
                                                                class="progress"
                                                            >
                                                                <div
                                                                    :class="
                                                                        getProgressBarClass(
                                                                            progressEntry,
                                                                            item
                                                                                .kpi_metric_member
                                                                                .kpi_metric
                                                                        )
                                                                    "
                                                                    role="progressbar"
                                                                    :style="{
                                                                        width:
                                                                            calculateProgressPercentage(
                                                                                progressEntry
                                                                            ) +
                                                                            '%',
                                                                    }"
                                                                ></div>
                                                            </div>
                                                            <p
                                                                class="progress-status"
                                                            >
                                                                {{
                                                                    calculateProgressStatus(
                                                                        progressEntry,
                                                                        item
                                                                            .kpi_metric_member
                                                                            .kpi_metric
                                                                    )
                                                                }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <button
                                                                class="btn view-btn"
                                                            >
                                                                <a
                                                                    :href="
                                                                        '/progress_detail/' +
                                                                        progressEntry.id
                                                                    "
                                                                    class="text-light add-link text-sm"
                                                                >
                                                                    <i
                                                                        class="mdi mdi-eye-outline text-light"
                                                                    ></i>
                                                                    view</a
                                                                >
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        v-if="
                                                            item
                                                                .kpi_metric_member
                                                                .progress
                                                                .length === 0
                                                        "
                                                    >
                                                        <td
                                                            style="
                                                                text-align: center;
                                                            "
                                                            colspan="5"
                                                        >
                                                            No Progress found
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <pagination
                                                :total="totalPages"
                                                :current="currentPage"
                                                @page-change="handlePageChange"
                                            ></pagination>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                </div>
            </div>
        </div>

       
    </div>
</template>

<script>
import store from "../../store";
import { format } from "date-fns";

export default {
    props: {
        kpimetricId: {
            type: Number,
            required: true,
        },
    },

    data() {
        return {
            progressData1: {},

            searchQuery: "",
            currentPage: 1,
            base_url: "../",
        };
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        // progressPercentage() {
        //     const progressEntry =
        //         this.item.kpi_metric_member.progress[this.progressIndex]; // Make sure to replace these variables with actual data
        //     const current = progressEntry.current_value;
        //     const target = progressEntry.target_value;

        //     if (target === 0) {
        //         return 0; // To avoid division by zero
        //     }

        //     const percentage = (current / target) * 100;
        //     const kpiMetric = progressEntry.kpi_metric_member.kpi_metric;

        //     if (percentage >= parseFloat(kpiMetric.on_track_value)) {
        //         return percentage;
        //     } else if (
        //         percentage >= parseFloat(kpiMetric.at_risk_min) &&
        //         percentage <= parseFloat(kpiMetric.at_risk_max)
        //     ) {
        //         return percentage;
        //     } else {
        //         return percentage;
        //     }
        // },
    },

    async created() {
        await this.fetchProgressDetails();
    },

    mounted() {
        console.log(
            "User Related Data:",
            JSON.stringify(this.$store.state.loggedUser)
        );
    },

    methods: {
        calculateProgressPercentage(progressEntry) {
            if (progressEntry.target_value === 0) {
                return 0;
            }

            const percentage =
                (progressEntry.current_value / progressEntry.target_value) *
                100;
            return percentage.toFixed(2);
        },

        calculateProgressStatus(progressEntry, kpiMetric) {
            const progressPercentage = parseFloat(
                this.calculateProgressPercentage(progressEntry)
            );

            if (progressPercentage >= parseFloat(kpiMetric.on_track_value)) {
                return "On Track";
            } else if (
                progressPercentage >= parseFloat(kpiMetric.at_risk_min) &&
                progressPercentage < parseFloat(kpiMetric.on_track_value)
            ) {
                return "At Risk";
            } else {
                return "Off Track";
            }
        },

        getProgressBarClass(progressEntry, kpiMetric) {
            const progressPercentage =
                this.calculateProgressPercentage(progressEntry);

            if (progressPercentage >= parseFloat(kpiMetric.on_track_value)) {
                return "bg-success"; // On track
            } else if (
                progressPercentage >= parseFloat(kpiMetric.at_risk_min) &&
                progressPercentage < parseFloat(kpiMetric.on_track_value)
            ) {
                return "bg-warning"; // At risk
            } else {
                return "bg-danger"; // Off track
            }
        },

        async fetchProgressDetails() {
            const kpimetricId = this.$props.kpimetricId;

            const uri =
                this.base_url + `api/v1/kpimetrics/${kpimetricId}/progress`;
            await axios
                .get(uri)
                .then((response) => {
                    console.log("Api Response2:", response.data);
                    this.progressData1 = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching member details:", error);
                });
        },

        handleFileUpload(event) {
            // Get the selected files from the event
            this.selectedFiles = Array.from(event.target.files);
        },
    },
};
</script>

<style scoped>
a {
    font-size: 20px;
}

.active-link {
    color: rgb(14, 28, 223);
    border-bottom: 2px solid blue;
}

.add-link {
    font-size: 14px;
}

.p-progress h5 {
    font-size: 1.2rem;
}

.p-progress p {
    font-size: 1.6rem;
    color: brown;
    font-weight: 800;
}

.status h6 {
    font-size: 1rem;
    color: brown;
}
img {
    width: 80px;
    height: 80px;
}

.set-metric input[type="text"] {
    width: 70px;
    height: 30px;
    border-radius: 5px;
    border: 1px solid gray;
}
.member-count {
    background-color: rgba(195, 195, 209, 0.733);
    padding: 7px;
    border-radius: 40%;
    font-size: 0.7rem;
}

.status span {
    background-color: rgba(51, 255, 0, 0.164);
    padding: 8px;
    border-radius: 15px;
}
.depart-tag {
    background-color: rgba(235, 240, 234, 0.685);
    padding: 8px;
    border-radius: 15px;
}
.list-item {
    list-style-type: none;
    border: 1px solid rgba(128, 128, 128, 0.534);
    border-radius: 10px;
    width: 70%;
}

.btn-icon {
    display: flex;
    align-items: center;
    font-weight: bold;
}

.encircle {
    padding: 3px;
    border-radius: 50%;
    background-color: rgba(128, 128, 128, 0.089);
    color: rgba(24, 23, 23, 0.911);
}

.nav-link {
    font-size: 14px;
    font-weight: 600;
}

.view-btn {
    cursor: pointer;
    font-size: 11px; /* Adjust font size */
    padding: 5px 10px; /* Adjust padding (top/bottom, left/right) */
    display: flex;
    background-color: #0072bb;
    align-items: center;
    justify-content: center; /* Center the content horizontally */
    border-radius: 8px;
    height: 35px;
}

.view-btn a {
    display: flex;
    align-items: center;
}

.view-btn i {
    margin-right: 8px;
}

.view-btn a {
    display: flex;
    align-items: center;
}

.view-btn i {
    margin-right: 8px;
}
</style>
