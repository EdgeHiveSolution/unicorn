<template>
    <div>
        <div class="top-header">
            <h4>Partners</h4>
            <p class="subtitle_text">Manage and on-board Tactive partners.</p>
        </div>

        <div v-if="loggedUser.user_role_id === 1">
            <div class="btn btn-primary my-3 module-add">
                <a class="text-light" href="/partners/create">+ Add Partner</a>
            </div>
        </div>

        <div v-else></div>

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
                                    style="height: 25px"
                                    class="input-field"
                                    type="text"
                                    placeholder="Search for partners"
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
                                    background-color: #eaf3ff;
                                    color: #7fb2fe;
                                    height: 30px;
                                    width: 60px;
                                    font-size: 14px;
                                    font-weight: 400;
                                "
                            >
                                All
                                <i
                                    class="mdi mdi-close"
                                    style="font-size: 14px; margin-left: 5px"
                                ></i>
                            </button>
                            <div style="margin-left: 20px"></div>

                            <button
                                style="height: 10px;font-size: 14px;font-weight:400"
                                class="btn btn-light p-3 btn-icon"
                                @click="showFilters = !showFilters"
                            >
                                <i class="mdi mdi-sort-variant text-dark"></i>
                                Filters
                            </button>
                            <div style="margin-left: 20px"></div>

                            <div class="btn-group">
                                <button
                                    class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span
                                        class="fas fa-ellipsis-h icon-dark"
                                    ></span>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item text-danger">
                                        <span
                                            class="fa fa-download mr-2"
                                        ></span
                                        >Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <template v-if="partners.length === 0">
                                <p>No partner found</p>
                            </template>
                            <template v-else>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Partner</th>
                                            <th>Status</th>
                                            <th>About</th>
                                            <th>Members</th>
                                            <th>Active KPIs</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="partner in partnersWithProgress"
                                            :key="partner.id"
                                        >
                                            <td>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <img
                                                        :src="partner.logo"
                                                        alt="logo"
                                                    />
                                                    <span class="pl-2">{{
                                                        partner.name
                                                    }}</span>
                                                </div>

                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <span
                                                        class="active-period txt-gray"
                                                        >Date Joined:
                                                        {{
                                                            partner.formatted_created_at
                                                        }}</span
                                                    >
                                                </div>
                                            </td>
                                            <td>
                                               <!-- <button class="btn btn-suc">
                                                    <span class="txt-success"
                                                        >Active</span
                                                    >
                                                </button>-->

                                                 <div class="active_status_container d-flex flex-row justify-content-center">
                                                    <span class="active_status_text"
                                                        >Active</span
                                                    >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="container-overflow_wrapper"><span class="txt-dark">{{
                                                    partner.business_type
                                                }}</span
                                                ><br />
                                                <span class="table_text txt-gray">{{
                                                    partner.about
                                                }}</span></div>
                                            </td>
                                            <td class="td-members">
                                                <!--<img
                                                    v-for="member in partner.members"
                                                    :key="member.id"
                                                    :src="member.image"
                                                    alt="image"
                                                />-->
                                               <!-- <div class="d-flex flex-row">
                                                <div class="member_image_plus"
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+1</p>
                                                </div>
                                                </div>-->

                                                <div class="d-flex flex-row">
                                               <!-- <div class="member_image_plus"
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+1</p>
                                                </div>-->
                                               
                                               <template v-for="(member,index) in partner.members"
                                               :key="index"
                                               >

                                                 <div class="member_image d-flex flex-column align-items-center"
                                                 v-if="index < 2"
                                                :src="member.image"
                                                >
                                                 <font-awesome-icon
                                                 icon="fa-solid, fa-user"
                                                 style="color: #979da9"
                                                 size="md"
                                                 class="mx-auto my-auto"
                                                  />
                                                <!--<p class="member_image_text">+1</p>-->
                                                </div>

                                                 <div class="member_image_plus"
                                                 v-else
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+{{index - 1}}</p>
                                                </div>

                                                <!-- <div class="member_image_plus"
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+1</p>
                                                </div>-->
                                                </template>

                                                <!--<img
                                                    
                                                    alt="image"
                                                />-->
                                                </div>
                                            </td>
                                            <td
                                                v-if="
                                                    partner.calculatedProgress >
                                                    0
                                                "
                                            >
                                                <div>
                                                   <label class="progress_text"> {{
                                                        partner.calculatedProgress.toFixed(
                                                            2
                                                        )
                                                    }}</label>%
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar"
                                                            :class="
                                                                getStatusClass(
                                                                    partner
                                                                )
                                                            "
                                                            :style="{
                                                                width:
                                                                    partner.calculatedProgress +
                                                                    '%',
                                                            }"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100"
                                                        ></div>
                                                    </div>
                                                    <div
                                                        class="progress-labels"
                                                    >
                                                        <span
                                                            class="status-label off-track-label"
                                                            v-if="
                                                                getStatusClass(
                                                                    partner
                                                                ) ===
                                                                'off-track'
                                                            "
                                                            >Off Track</span
                                                        >
                                                        <span
                                                            class="status-label at-risk-label"
                                                            v-else-if="
                                                                getStatusClass(
                                                                    partner
                                                                ) === 'at-risk'
                                                            "
                                                            >At Risk</span
                                                        >
                                                        <span
                                                            class="status-label on-track-label"
                                                            v-else-if="
                                                                getStatusClass(
                                                                    partner
                                                                ) === 'on-track'
                                                            "
                                                            >On Track</span
                                                        >
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td v-else class="text-muted progress_text">No Active Kpis</td>
                                            <td>
                                                <a :href="
                                                            '/partners/' +
                                                            partner.id
                                                        "><button class="btn view-btn">
                                                    <a
                                                        :href="
                                                            '/partners/' +
                                                            partner.id
                                                        "
                                                        class="text-light"
                                                    >
                                                        <i
                                                            class="mdi mdi-eye-outline text-light"
                                                        ></i>
                                                        View</a
                                                    >
                                                </button></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <pagination
                                    :current-page="currentPage"
                                    :total-pages="totalPages"
                                    @page-change="fetchPartners"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faUser } from "@fortawesome/free-solid-svg-icons";


library.add(
    faUser
);

export default {

    components: {
        FontAwesomeIcon,
    },
    data() {
        return {
            success: "",
            searchQuery: "",
            partners: [],
            currentPage: 1,
            base_url: "../",
            totalPages: 0,
        };
    },
    mounted() {
        this.fetchPartners();
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        partnersWithProgress() {
            return this.partners.map((partner) => ({
                ...partner,
                calculatedProgress: this.calculateKpiProgress(partner.kpis),

                statusClass: this.getStatusClass(partner),
            }));
        },
    },

    methods: {
        fetchPartners() {
            const loggeduser = this.$store.state.loggedUser;

            console.log("Logged User Now:" + JSON.stringify(loggeduser));
            let uri =
                this.base_url +
                `api/v1/partner-list?user_id=${loggeduser.id}&user_role_id=${loggeduser.user_role_id}`;
            axios.get(uri).then((response) => {
                console.log("API Response:", response.data);
                this.partners = response.data;

                console.log("New Partners:", JSON.stringify(this.partners));
            });
        },

        calculateKpiProgress(kpis) {
            let totalCurrentValue = 0;
            let totalTargetValue = 0;

            kpis.forEach((kpi) => {
                kpi.kpi_metrics.forEach((kpiMetric) => {
                    kpiMetric.kpi_metric_members.forEach((member) => {
                        member.progress.forEach((progress) => {
                            totalCurrentValue += progress.current_value;
                            totalTargetValue += progress.target_value;
                        });
                    });
                });
            });

            if (totalTargetValue === 0) {
                return 0;
            }

            return (totalCurrentValue / totalTargetValue) * 100;
        },

        getStatusClass(partner) {
            const progressPercentage = parseFloat(partner.calculatedProgress);

            for (const kpi of partner.kpis) {
                for (const kpiMetric of kpi.kpi_metrics) {
                    const onTrackValue = parseFloat(kpiMetric.on_track_value);
                    const atRiskMin = parseFloat(kpiMetric.at_risk_min);

                    if (progressPercentage >= onTrackValue) {
                        return "on-track";
                    } else if (progressPercentage >= atRiskMin) {
                        return "at-risk";
                    }
                }
            }

            return "off-track";
        },
        // calculateKpiProgress(kpiMetrics) {
        //     if (!kpiMetrics || kpiMetrics.length === 0) {
        //         return 0;
        //     }
        //     let totalProgress = kpiMetrics.reduce(
        //         (acc, kpiMetric) => acc + kpiMetric.on_track_value,
        //         0
        //     );
        //     let avgProgress = totalProgress / kpiMetrics.length;
        //     return Math.round(avgProgress);
        // },
    },
};
</script>

<style scoped>
.card-header {
    background: none;
}

.view-btn {
    cursor: pointer;
    font-size: 12px; /* Adjust font size */
    padding: 5px 10px; /* Adjust padding (top/bottom, left/right) */
    display: flex;
    background-color: #0072bb;
    align-items: center;
    justify-content: center; /* Center the content horizontally */
    border-radius: 8px;
    height: 35px;
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

.on-track {
    /*background-color: #767978;*/
    background-color: #047a48;
}

.at-risk {
    background-color: #f0ad4e;
}

.off-track {
    background-color: #d9534f;
}

.on-track-label{
    font-size: 12px;
    color: #047a48;
}

.at-risk-label{
    font-size: 12px;
    color: #f0ad4e;
}

.off-track-label{
    font-size: 12px;
    color: #d9534f;
}


.primary_button{
    background-color: #084bf7;
    font-size: 14px;
    font-weight: 300;
}

th{
     color: #667085;
    font-size: 14px;
    font-weight: 500;
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
