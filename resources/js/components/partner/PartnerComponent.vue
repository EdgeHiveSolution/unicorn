<template>
    <div>
        <div class="top-header">
            <h2>Partners</h2>
            <p>Manage and on-board Tactive partners.</p>
        </div>

        <div>
            <div class="btn btn-primary my-3 module-add">
                <a class="text-light" href="/partners/create">+ Add Partner</a>
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
                                    style="height: 25px"
                                    class="input-field"
                                    type="text"
                                    placeholder="Search for partners"
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
                                            v-for="partner in partners"
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
                                                <button class="btn btn-suc">
                                                    <span class="txt-success"
                                                        >Active</span
                                                    >
                                                </button>
                                            </td>
                                            <td>
                                                <span class="txt-dark">{{
                                                    partner.business_type
                                                }}</span
                                                ><br />
                                                <span class="txt-gray">{{
                                                    partner.about
                                                }}</span>
                                            </td>
                                            <td class="td-members">
                                                <img
                                                    v-for="member in partner.members"
                                                    :key="member.id"
                                                    :src="member.image"
                                                    alt="image"
                                                />
                                            </td>
                                            <td>
                                                <div
                                                    v-if="
                                                        partner.kpiMetrics &&
                                                        partner.kpiMetrics
                                                            .length > 0
                                                    "
                                                >
                                                    {{
                                                        calculateKpiProgress(
                                                            partner.kpiMetrics
                                                        )
                                                    }}%
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar bg-warning"
                                                            role="progressbar"
                                                            :style="{
                                                                width:
                                                                    calculateKpiProgress(
                                                                        partner.kpiMetrics
                                                                    ) + '%',
                                                            }"
                                                            :aria-valuenow="
                                                                calculateKpiProgress(
                                                                    partner.kpiMetrics
                                                                )
                                                            "
                                                            aria-valuemin="0"
                                                            aria-valuemax="100"
                                                        ></div>
                                                    </div>
                                                    <span
                                                        v-if="
                                                            calculateKpiProgress(
                                                                partner.kpiMetrics
                                                            ) < 50
                                                        "
                                                        class="text-danger"
                                                        >off track</span
                                                    >
                                                    <span
                                                        v-else-if="
                                                            calculateKpiProgress(
                                                                partner.kpiMetrics
                                                            ) >= 50 &&
                                                            calculateKpiProgress(
                                                                partner.kpiMetrics
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
                                                            :style="{
                                                                width: '0%',
                                                            }"
                                                            aria-valuenow="0"
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
                                            </button>
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

export default {
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
    methods: {
        fetchPartners() {
            let uri = this.base_url + `api/v1/partner-list`;
            axios.get(uri).then((response) => {
                 console.log("API Response:", response.data);
                this.partners = response.data;

                console.log("New Partners:", JSON.stringify(this.partners));
                
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



</style>
