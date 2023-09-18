<template>
    <div>
        <div class="d-flex align-items-center">
            <div class="data-info">
                <div v-if="member.member && member.member.name">
                    <h4>{{ member.member.name }}</h4>
                </div>
                <div v-if="member.member && member.member.is_active">
                    <p>
                        Status:
                        <span class="text-success">
                            {{
                                member.member.is_active ? "Active" : "Inactive"
                            }}</span
                        >
                    </p>
                </div>
            </div>
        </div>
        <div class="module-nav"></div>

        <div class="top-header">
            <div v-if="member.member && member.member.departments">
                <h5>
                    Departments:
                    <span
                        v-for="(department, index) in member.member.departments"
                        :key="index"
                    >
                        {{ department.name }}
                        <span
                            v-if="
                                index !== member.member.departments.length - 1
                            "
                        ></span>
                    </span>
                </h5>
            </div>
        </div>

        <div v-for="partner in getPartner" :key="partner.id">
            <div class="d-flex flex justify-content-between">
                <div class="data-info">
                    <div>
                        <h4>{{ partner.name }}</h4>
                    </div>
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
                <div>
                    <a
                        style="font-size: 18px"
                        class="btn btn-sm btn-light"
                        href=""
                        >View Partner</a
                    >
                </div>
            </div>

            <div class="body-items">
                <div id="kpis">
                    <!-- KPIs content -->

                    <div class="row">
                        <div
                            class="col-12 px-0"
                            v-for="kpiMetricData in member.kpiMetrics"
                            :key="kpiMetricData.kpiMetric.id"
                        >
                            <div class="card mb-5">
                                <div class="d-flex justify-content-between p-4">
                                    <div>
                                        <h4>
                                            {{
                                                kpiMetricData.kpiMetric.kpi
                                                    .title
                                            }}
                                        </h4>
                                        <p>
                                            <b>
                                                Review period:{{
                                                    kpiMetricData.kpiMetric.kpi
                                                        .review_period_range
                                                }}
                                            </b>
                                            <span class="txt-gray"> </span>
                                        </p>
                                    </div>

                                    <div
                                        v-if="
                                            kpiMetricData &&
                                            kpiMetricData.kpiMetric &&
                                            kpiMetricData.progress_sum
                                        "
                                    >
                                        <div>
                                            <span
                                                style="font-weight: bold"
                                                class="txt-dark"
                                                >{{
                                                    getAggregatePercentage(
                                                        kpiMetricData
                                                    )
                                                }}%</span
                                            >
                                        </div>
                                        <div>
                                            {{
                                                getAggregateStatus(
                                                    getAggregatePercentage(
                                                        kpiMetricData
                                                    ),
                                                    kpiMetricData
                                                )
                                            }}
                                        </div>
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
                                                <!-- <tr v-for="progressData in kpiMetricData" :key="progressData.id"> -->
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <!-- <span>{{ kpiMetricData.kpiMetric.title }}</span> -->
                                                            <span>{{
                                                                kpiMetricData
                                                                    .kpiMetric
                                                                    .title
                                                            }}</span>
                                                        </div>
                                                        <div>
                                                            <span>{{
                                                                kpiMetricData
                                                                    .kpiMetric
                                                                    .type
                                                            }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <!-- <div>{{ progressData.progress_sum.current_sum }}</div> -->
                                                        <div>
                                                            <span
                                                                v-if="
                                                                    kpiMetricData
                                                                        .kpiMetric
                                                                        .type ===
                                                                    currency
                                                                "
                                                                >KES</span
                                                            >
                                                            {{
                                                                kpiMetricData
                                                                    .progress_sum
                                                                    .current_sum
                                                            }}
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <!-- <div>{{ progressData.progress_sum.target_sum }}</div> -->
                                                        <div>
                                                            <span
                                                                v-if="
                                                                    kpiMetricData
                                                                        .kpiMetric
                                                                        .type ===
                                                                    currency
                                                                "
                                                                >KES</span
                                                            >
                                                            {{
                                                                kpiMetricData
                                                                    .progress_sum
                                                                    .target_sum
                                                            }}
                                                        </div>
                                                    </td>

                                                    <td class="stats" v-if="calculateProgressPercentage(
                                                                    kpiMetricData.progress_sum
                                                                ) > 0">
                                                        <p
                                                            class="progress_text text-muted"
                                                        >
                                                            {{
                                                                calculateProgressPercentage(
                                                                    kpiMetricData.progress_sum
                                                                )
                                                            }}%
                                                        </p>
                                                        <div class="progress">
                                                            <div
                                                                :class="
                                                                    getProgressBarClass(
                                                                        kpiMetricData.progress_sum,
                                                                        kpiMetricData.kpiMetric
                                                                    )
                                                                "
                                                                role="progressbar"
                                                                :style="{
                                                                    width:
                                                                        calculateProgressPercentage(
                                                                            kpiMetricData.progress_sum
                                                                        ) + '%',
                                                                }"
                                                                aria-valuenow="5"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100"
                                                            ></div>
                                                        </div>
                                                        <p
                                                            class="progress-status"
                                                        >
                                                            {{
                                                                calculateProgressStatus(
                                                                    kpiMetricData.progress_sum,
                                                                    kpiMetricData.kpiMetric
                                                                )
                                                            }}
                                                        </p>
                                                    </td>
                                                    <td v-else>N/A</td>
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
        memberId: {
            type: Number,
            required: true,
        },
    },

    data() {
        return {
            member: {},
            kpiMetrics: [], // Initialize an empty array for KPI metrics
            base_url: "../",
        };
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        getPartner() {
            const member = this.member;

            if (!member || !member.member || !member.member.partners) {
                return [];
            }

            const partners = member.member.partners.map((partner) => {
                // Transform each partner here if needed
                return {
                    // Define the properties you want to include in the transformed partner object
                    name: partner.name,
                    is_active: partner.is_active,
                    // Add more properties as needed
                };
            });

            return partners;
        },

        partnersWithProgress() {
            const partner = this.partner;

            if (!partner) {
                return []; // Return an empty array if partner is not available
            }

            const calculatedProgress = this.calculateKpiProgress(partner.kpis);
            const statusClass = this.getStatusClass(partner);

            return [
                {
                    ...partner,
                    calculatedProgress,
                    statusClass,
                },
            ];
        },

        getAggregatePercentage() {
            return (kpiMetricData) => {
                const totalCurrentSum = kpiMetricData.progress_sum.current_sum;
                const totalTargetSum = kpiMetricData.progress_sum.target_sum;

                if (totalTargetSum === 0) {
                    return 0; // To prevent division by zero
                }

                return ((totalCurrentSum / totalTargetSum) * 100).toFixed(2);
            };
        },

        // aggregatePercentage() {
        // const totalCurrentSum = this.member.kpiMetrics.reduce(
        //   (acc, kpiMetricData) => acc + kpiMetricData.progress_sum.current_sum,
        //   0
        // );

        // const totalTargetSum = this.member.kpiMetrics.reduce(
        //   (acc, kpiMetricData) => acc + kpiMetricData.progress_sum.target_sum,
        //   0
        // );

        // if (totalTargetSum === 0) {
        //   return 0; // To prevent division by zero
        // }

        // return ((totalCurrentSum / totalTargetSum) * 100).toFixed(2);
        // },
    },

    async created() {
        await this.fetchMemberDetails();
    },
    // mounted() {
    //     this.fetchMemberDetails();

    //     console.log(
    //         "User Related Data:",
    //         JSON.stringify(this.$store.state.loggedUser)
    //     );
    // },

    methods: {
        calculateProgressPercentage(progressSum) {
            const currentSum = progressSum.current_sum;
            const targetSum = progressSum.target_sum;
            const percentage = (currentSum / targetSum) * 100;
            return percentage.toFixed(2);
        },
        calculateProgressStatus(progressSum, kpiMetric) {
            const progressPercentage = parseFloat(
                this.calculateProgressPercentage(progressSum)
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
        getProgressBarClass(progressSum, kpiMetric) {
            const progressPercentage = parseFloat(
                this.calculateProgressPercentage(progressSum)
            );

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

        // fetchMemberDetails() {
        //     const uri = this.base_url + `api/v1/members/${this.memberId}`;
        //     axios
        //         .get(uri)
        //         .then((response) => {
        //             console.log("More member details are:", response.data);
        //             this.member = response.data;
        //         })
        //         .catch((error) => {
        //             console.error("Error fetching member details:", error);
        //         });
        // },

        async fetchMemberDetails() {
            const memberId = this.$props.memberId;
            const uri =
                this.base_url + `api/v1/members/${memberId}/kpis-and-metrics`;
            await axios
                .get(uri)
                .then((response) => {
                    console.log("Api Response:", response.data);
                    this.member = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching member details:", error);
                });
        },

        getAggregateStatus(aggregatePercentage, kpiMetricData) {
            const onTrackValue = parseFloat(
                kpiMetricData.kpiMetric.on_track_value
            );
            const offTrackMin = parseFloat(
                kpiMetricData.kpiMetric.off_track_min
            );
            const offTrackMax = parseFloat(
                kpiMetricData.kpiMetric.off_track_max
            );
            const atRiskMin = parseFloat(kpiMetricData.kpiMetric.at_risk_min);
            const atRiskMax = parseFloat(kpiMetricData.kpiMetric.at_risk_max);

            if (aggregatePercentage >= onTrackValue) {
                return "On Track";
            } else if (
                aggregatePercentage >= atRiskMin &&
                aggregatePercentage <= atRiskMax
            ) {
                return "At Risk";
            } else if (
                aggregatePercentage >= offTrackMin &&
                aggregatePercentage <= offTrackMax
            ) {
                return "Off Track";
            } else {
                return "N/A"; // You can add additional handling if needed
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

.status span {
    background-color: rgba(51, 255, 0, 0.164);
    padding: 8px;
    border-radius: 15px;
}
</style>
