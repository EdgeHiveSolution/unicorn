<template>
    <div>
        <div class="body-items">
            <div id="">
                <!-- KPIs content -->

                <div class="row">
                    <div
                        class="col-12 px-0"
                        v-for="(item, index) in progressData.progress_data"
                        :key="index"
                    >

                    
                        <div>
                        
                            <div class="card mb-5">
                            
                                <div class="d-flex justify-content-between p-4">
                                    <div>
                                        <h4>
                                            {{
                                                item.kpi_metric_member
                                                    .kpi_metric.title
                                            }}
                                        </h4>
                                    </div>

                                     
                            <button
                                data-toggle="modal"
                                class="btn btn-light border"
                                data-target="#addKpimodal2"
                            >
                                + Add Progress
                            </button>
                      
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

                                                    <!-- <th>Assigned to</th>
                                                <th>Departments</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <div v-if="member.member  && member.member.kpiMetrics"> -->
                                                <!-- <tr
                                                v-for="progressData in kpiMetricData.progress"
                                                :key="progressData.id"
                                            > -->
                                                <tr
                                                    v-for="(
                                                        progressEntry,
                                                        progressIndex
                                                    ) in item.kpi_metric_member
                                                        .progress"
                                                    :key="progressIndex"
                                                >
                                                    <td>
                                                        <div>
                                                            <span>
                                                                {{
                                                                    progressEntry.title
                                                                }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div>
                                                            {{
                                                                progressEntry.current_value
                                                            }}
                                                            <!-- Display KPI target, assuming target is a property of the KPI -->
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
                                                                .length === 0
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

                                                        <div class="progress">
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
                                                                        ) + '%',
                                                                }"
                                                            ></div>
                                                        </div>
                                                        
                                                    </td>

                                                    <td></td>
                                                </tr>

                                                <tr
                                                    v-if="
                                                        item.kpi_metric_member
                                                            .progress.length ===
                                                        0
                                                    "
                                                >
                                                    <td
                                                        style="
                                                            text-align: center;
                                                        "
                                                        colspan="4"
                                                    >
                                                        No Progress found
                                                    </td>
                                                </tr>
                                                <!-- </div> -->
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

        // kpiMetricMember: {
        //     type: Object,
        //     required: true,
        // },

        // progress: {
        //     type: Array,
        //     required: true,
        // },

        // members: {
        //     type: Array,
        //     required: true,
        // },

        // kpis: {
        //     type: Array,
        //     required: true,
        // },
        // kpimetrics: {
        //     type: Array,
        //     required: true,
        // },
    },

    data() {
        return {
            progressData: {},
            selectedKpiTitle: "",
            selectedMemberKpi: "",
            selectedKpi: null,
            timelyValue: null,

            selectedKpiMetric: "",

            selectedItems: [],
            departments: [],

            selectedKpiMember: [],

            success: "",
            searchQuery: "",
            currentPage: 1,
            base_url: "../",
            formattedDate: "",

            kpimetric_title: "",
            kpimetric_value: "",
            kpimetric_notes: "",

            kpiMetric: {
                title: "",
                type: "",
                target: "",
                responsePeriod: "",
                members: [],
                onTrackValue: 10,
                atRiskMin: 10,
                atRiskMax: 45,
                offTrackMin: 45,
                offTrackMax: 100,
            },
            formData: {
                name: "",
                email: "",
                website: "",
                phone: "",
                address: "",
                logo: "",
                target: "",

                business_type: "",
                about: "",
                document_id: "",
                member_email: "",
                department_id: "",
                role: "",

                role_id: "",
            },
            kpi_title: "",
            kpi_owner: "",
            showInputs: false,
            review_start_date: null,
            review_end_date: null,
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

    mounted() {
        this.fetchKpiMetricsDetails();
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
        fetchKpiMetricsDetails() {
            const kpimetricId = this.$props.kpimetricId;
            const uri =
                this.base_url + `api/v1/kpimetrics/${kpimetricId}/progress`;
            axios
                .get(uri)
                .then((response) => {
                    console.log("Api Response:", response.data);
                    this.progressData = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching member details:", error);
                });
        },

        submitProgress() {
            const loggedMemberId = store.state.loggedUser.member.id;

            console.log("Member Id:" + JSON.stringify(loggedMemberId));

            // Find the kpi_metric_member associated with the logged-in member
            const kpiMetricMember = this.progressData.progress_data.find(
                (item) => {
                    return item.kpi_metric_member.member_id === loggedMemberId;
                }
            )?.kpi_metric_member;

            if (kpiMetricMember) {
                const kpimetric1 = kpiMetricMember.kpi_metric;

                console.log(
                    "Kpi Metric Member Update:",
                    JSON.stringify(kpiMetricMember)
                );
                console.log(
                    "User Data:",
                    JSON.stringify(store.state.loggedUser)
                );

                const formData = new FormData();
                formData.append("title", this.kpimetric_title);
                formData.append("value", this.kpimetric_value);
                formData.append("notes", this.kpimetric_notes);
                formData.append("kpi_metric_member_id", kpiMetricMember.id);
                formData.append("timely_value", kpiMetricMember.timely_value);
                formData.append("kpi_metric_id", kpimetric1.id);

                const uri = this.base_url + "api/v1/progress";
                axios
                    .post(uri, formData)
                    .then((response) => {
                        console.log(
                            "Response for Progress from server:",
                            response.data
                        );

                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Progress updated successfully!",
                        }).then(() => {
                            this.kpimetric_title = "";
                            this.kpimetric_value = "";
                            this.kpimetric_notes = "";
                            window.location.reload();
                        });
                    })
                    .catch((error) => {
                        console.error("Error submitting the form:", error);
                    });
            } else {
                console.log(
                    "No matching kpi_metric_member found for the logged-in member."
                );
            }
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
