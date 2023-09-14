<template>
    <div>
        <div class="d-flex align-items-center">
            <div class="data-info">
                <div>
                    <h4>{{ partner.name }}</h4>
                </div>

                <!-- <div>
                    <h4>{{ name }}</h4>
                </div> -->

                <div>
                    <p>
                        Status:
                        <span class="text-success">
                            {{
                                partner.is_active ? "Active" : "Inactive"
                            }}</span
                        >
                    </p>
                </div>
            </div>
        </div>
        <div class="module-nav"></div>

        <div class="body-items">
            <div id="kpis">
                <!-- KPIs content -->

                <div class="row">
                    <div
                        class="col-12 px-0"
                        v-for="kpi in partner.kpis"
                        :key="kpi.id"
                    >
                        <div class="card mb-5">
                            <div class="d-flex justify-content-between p-4">
                                <div>
                                    <h4>{{ kpi.title }}</h4>
                                    <p>
                                        <b
                                            >Review period:
                                            {{ kpi.review_period_range }}</b
                                        >
                                        <span class="txt-gray"></span>
                                    </p>
                                </div>

                                <div>
                                    <span
                                        style="font-weight: bold"
                                        class="txt-dark"
                                    >
                                        {{ getAggregatePercentage(kpi) }}%
                                    </span>
                                    <div>
                                        <span
                                            v-for="status in getAggregateStatus(
                                                kpi
                                            )"
                                            :key="status"
                                        >
                                            {{ status }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="d-flex justify-content-end mt-4">
                                <div>
                                    {{
                                        specificKPIProgress.progressPercentage
                                    }}%
                                </div>
                                <div>
                                    
                                        {{ specificKPIProgress.progressStatus }}
                                
                                </div>
                            </div> -->
                            <div
                                class="card-header d-flex justify-content-between my-3"
                            >
                                <div>
                                    <div class="input-container">
                                        <i class="mdi mdi-magnify mdi-icon"></i>
                                        <input
                                            style="height: 25px"
                                            class="input-field"
                                            type="text"
                                            placeholder="Search Kpi Metrics "
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
                                                <th>KPI Metric</th>
                                                <th>Current</th>
                                                <th>Target</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="kpiMetric in kpi.kpi_metrics"
                                                :key="kpi.id"
                                            >
                                                <td>
                                                    <div>
                                                        <!-- <span>{{ kpiMetricData.kpiMetric.title }}</span> -->
                                                        <span>{{
                                                            kpiMetric.title
                                                        }}</span>
                                                    </div>
                                                    <div>
                                                        <span>{{
                                                            kpiMetric.type
                                                        }}</span>
                                                    </div>
                                                </td>

                                                <td class="">
                                                    <div>
                                                        <span
                                                            v-if="
                                                                kpiMetric.type ===
                                                                currency
                                                            "
                                                            >KES</span
                                                        >
                                                        {{
                                                            calculateCurrentSum(
                                                                kpiMetric
                                                            )
                                                        }}
                                                    </div>
                                                </td>

                                                <td class="">
                                                    <div>
                                                        <span
                                                            v-if="
                                                                kpiMetric.type ===
                                                                currency
                                                            "
                                                            >KES</span
                                                        >
                                                        {{
                                                            calculateTargetSum(
                                                                kpiMetric
                                                            ).toFixed(2)
                                                        }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        {{
                                                            calculateProgressPercentage(
                                                                kpiMetric
                                                            )
                                                        }}%
                                                        <div class="progress">
                                                            <div
                                                                class="progress-bar"
                                                                role="progressbar"
                                                                :class="{
                                                                    'progress-bar-on-track':
                                                                        calculateProgressPercentage(
                                                                            kpiMetric
                                                                        )
                                                                            .label ===
                                                                        'On Track',
                                                                }"
                                                                :style="{
                                                                    width:
                                                                        calculateProgressPercentage(
                                                                            kpiMetric
                                                                        ) + '%',
                                                                }"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                    {{
                                                        calculateProgressStatus(
                                                            kpiMetric
                                                        )
                                                    }}
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
</template>

<script>
import store from "../../store";
import { format } from "date-fns";

export default {
    props: {
        partnerId: {
            type: Number,
            required: true,
        },
    },

    data() {
        return {
            partner: {},
            // kpiMetrics: [], // Initialize an empty array for KPI metrics
            base_url: "../",
        };
    },

    async created() {
        await this.fetchPartnerDetails();

        console.log("Partner is:", JSON.stringify(this.partner));
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        // specificKPIProgress() {
        //     const specificKPI = this.partner;

        //     // Debugging: Log the structure of specificKPI
        //     console.log("specificKPI", specificKPI);

        //     let totalCurrentValue = 0;
        //     let totalTargetValue = 0;

        //     specificKPI.kpis.forEach((kpi) => {
        //         kpi.kpi_metrics.forEach((kpiMetric) => {
        //             kpiMetric.kpi_metric_members.forEach((member) => {
        //                 member.progress.forEach((progress) => {
        //                     totalCurrentValue += progress.current_value;
        //                     totalTargetValue += progress.target_value;
        //                 });
        //             });
        //         });
        //     });

        //     // Calculate progress percentage
        //     let progressPercentage = 0;
        //     if (totalTargetValue !== 0) {
        //         progressPercentage = (
        //             (totalCurrentValue / totalTargetValue) *
        //             100
        //         ).toFixed(2);
        //     }

        //     // Determine the progress status based on progressPercentage
        //     let progressStatus = "";
        //     if (progressPercentage <= 50) {
        //         progressStatus = "Off Track";
        //     } else if (progressPercentage <= 80) {
        //         progressStatus = "At Risk";
        //     } else {
        //         progressStatus = "On Track";
        //     }

        //     // Return an object with progressPercentage and progressStatus
        //     return {
        //         progressPercentage,
        //         progressStatus,
        //     };
        // },

        // aggregatePercentage() {
        //     // Calculate the aggregatePercentage here based on the values in the table
        //     // You can iterate through the KPI metrics and calculate the aggregatePercentage
        //     // Formula: (Sum of Current Values / Sum of Target Values) * 100
        //     let currentSum = 0;
        //     let targetSum = 0;

        //     for (const kpi of this.partner.kpis) {
        //         for (const kpiMetric of kpi.kpi_metrics) {
        //             currentSum += parseFloat(kpiMetric.current);
        //             targetSum += parseFloat(kpiMetric.target);
        //         }
        //     }

        //     if (targetSum === 0) {
        //         return 0; // Handle division by zero if needed
        //     }

        //     return ((currentSum / targetSum) * 100).toFixed(2);
        // },
        // kpiMetricsWithProgress() {
        //     const kpisArray = [];

        //     this.partner.kpis.forEach((kpi) => {
        //         // Create a shallow copy of kpi and add it to the array
        //         kpisArray.push({ ...kpi });
        //     });

        //     return kpisArray;
        // },
    },

    // mounted() {

    //     console.log("Partner ID is:", this.partnerID);

    //   this.fetchPartnerDetails();
    //     console.log("Partner is:" , JSON.stringify(this.partner));
    //     // this.fetchprtnerDetails();

    //     // console.log(
    //     //     "User Related Data:",
    //     //     JSON.stringify(this.$store.state.loggedUser)
    //     // );
    // },

    methods: {
        async fetchPartnerDetails() {
            const partnerId = this.$props.partnerId;

            console.log("partner id is:", partnerId);
            const uri =
                this.base_url + `api/v1/partners/${partnerId}/kpis-and-metrics`;
            await axios
                .get(uri)
                .then((response) => {
                    console.log("Api Response:", response.data);
                    this.partner = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching Partner details:", error);
                });
        },

        calculateCurrentSum(kpiMetric) {
            let currentSum = 0;
            kpiMetric.kpi_metric_members.forEach((kpiMetricMember) => {
                kpiMetricMember.progress.forEach((progressEntry) => {
                    currentSum += progressEntry.current_value;
                });
            });
            return currentSum;
        },

        calculateTargetSum(kpiMetric) {
            let targetSum = 0;
            kpiMetric.kpi_metric_members.forEach((kpiMetricMember) => {
                kpiMetricMember.progress.forEach((progressEntry) => {
                    targetSum += progressEntry.target_value;
                });
            });
            return targetSum;
        },

        calculateProgressPercentage(kpiMetric) {
            const currentSum = this.calculateCurrentSum(kpiMetric);
            const targetSum = this.calculateTargetSum(kpiMetric);
            const percentage = (currentSum / targetSum) * 100;
            return percentage.toFixed(2);
        },

        calculateProgressStatus(kpiMetric) {
            const progressPercentage = parseFloat(
                this.calculateProgressPercentage(kpiMetric)
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

        getAggregatePercentage(kpi) {
            const totalCurrent = kpi.kpi_metrics.reduce((acc, kpiMetric) => {
                return acc + this.calculateCurrentSum(kpiMetric);
            }, 0);

            const totalTarget = kpi.kpi_metrics.reduce((acc, kpiMetric) => {
                return acc + this.calculateTargetSum(kpiMetric);
            }, 0);

            return ((totalCurrent / totalTarget) * 100).toFixed(2);
        },

        getAggregateStatus(kpi) {
            const aggregatePercentage = this.getAggregatePercentage(kpi);

            const aggregateStatuses = kpi.kpi_metrics.map((kpiMetric) => {
                const onTrackValue = parseFloat(kpiMetric.on_track_value);
                const offTrackMin = parseFloat(kpiMetric.off_track_min);
                const offTrackMax = parseFloat(kpiMetric.off_track_max);
                const atRiskMin = parseFloat(kpiMetric.at_risk_min);
                const atRiskMax = parseFloat(kpiMetric.at_risk_max);

                if (aggregatePercentage >= onTrackValue) {
                    return "On Track";
                } else if (aggregatePercentage <= atRiskMax) {
                    return "At Risk";
                } else if (
                    aggregatePercentage >= offTrackMin &&
                    aggregatePercentage <= offTrackMax
                ) {
                    return "Off Track";
                } else {
                    return "N/A"; // Handle cases outside the defined thresholds
                }
            });

            // You can return the aggregate statuses for all kpiMetrics as an array here
            return aggregateStatuses;
        },

        // getAggregateStatus(percentage, kpi) {
        //     const onTrackValue = parseFloat(kpiMetric.on_track_value);
        //     const offTrackMin = parseFloat(kpiMetric.off_track_min);
        //     const offTrackMax = parseFloat(kpiMetric.off_track_max);
        //     const atRiskMin = parseFloat(kpiMetric.at_risk_min);
        //     const atRiskMax = parseFloat(kpiMetric.at_risk_max);

        //     if (percentage >= onTrackValue) {
        //         return "On Track";
        //     } else if (percentage <= atRiskMax) {
        //         return "At Risk";
        //     } else if (percentage >= offTrackMin && percentage <= offTrackMax) {
        //         return "Off Track";
        //     } else {
        //         return "N/A"; // Handle cases outside the defined thresholds
        //     }
        // },
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

.status span {
    background-color: rgba(51, 255, 0, 0.164);
    padding: 8px;
    border-radius: 15px;
}
</style>
