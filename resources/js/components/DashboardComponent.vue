<template>
    <div class="welcome">
        <h1 style="font-size: 20px" class="txt-dark">
            Welcome Back, {{ data.loggeduser.name.split(" ")[0] }}
        </h1>
        <h3 style="font-size: 20px; font-weight: lighter" class="txt-gray">
            Track and manage the team’s overall performance.
        </h3>
        <h4 style="font-size: 20px; font-weight: semi-bold" class="txt-dark">
            Performance Overview
        </h4>

        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin">
                <h5 class="mb-2 txt-danger">OFF TRACK</h5>
                <h6 class="text-primary font-weight-normal lead text-dark">
                    {{ offTrack }}
                </h6>
                <h4 class="mb-2 txt-dark">PARTNERS</h4>
                <span class="mdi mdi-arrow-up txt-danger icon-item"> 40%</span>
                <small> vs last month</small>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin">
                <h5 class="mb-2 txt-warning">AT RISK</h5>
                <h6 class="text-primary font-weight-normal lead text-dark">
                    {{ atRisk }}
                </h6>
                <h4 class="mb- txt-dark">PARTNERS</h4>
                <span class="mdi mdi-arrow-down txt-warning icon-item">
                    -100%</span
                >
                <small> vs last month</small>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin">
                <h5 class="mb-2 txt-success">ON TRACK</h5>
                <h6 class="text-primary font-weight-normal text-dark">
                    {{ onTrack }}
                </h6>
                <h4 class="mb-2 txt-dark">PARTNERS</h4>
                <span class="mdi mdi-arrow-up txt-success icon-item">
                    +50%</span
                >
                <span class="ml-2"></span>
                <small> vs last month</small>
            </div>
        </div>

        <div class="row">
            <div class="col-12 px-0">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between my-3"
                    >
                        <div>
                            <div class="input-container">
                                <i class="mdi mdi-magnify mdi-icon"></i>
                                <input
                                    class="input-field"
                                    style="height: 10px"
                                    type="text"
                                    placeholder="Search for partners"
                                />
                            </div>
                        </div>
                        <div>
                            <button
                                style="height: 10px"
                                class="btn btn-light p-3 btn-icon"
                            >
                                <i class="mdi mdi-sort-variant text-dark"></i>
                                Filters
                            </button>
                        </div>
                    </div>
                    <div class="card-body mb-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Partner</th>
                                        <th>Progress</th>
                                        <th>Members</th>
                                        <th>Departments</th>
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
                                                    >Active Period:
                                                    {{ "8 months ago" }}</span
                                                >
                                            </div>
                                        </td>
                                       <td
                                                v-if="
                                                    partner.calculatedProgress >
                                                    0
                                                "
                                               >
                                                <div>
                                                    <label class="progress_text">{{
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
                                            <td v-else>N/A</td>
                                        <td class="td-members">
                                            <!--<img
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                src="member.image"
                                                alt="image"
                                            />-->
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
                                        <td>
                                            <span
                                                class="department-tag"
                                                v-for="department in uniqueDepartments"
                                                :key="department.id"
                                                >{{ department.name }}</span
                                            >
                                        </td>
                                        <td>
                                            <button class="btn view-btn">
                                                <a
                                                    :href="
                                                        '/partners/' +
                                                        partner.id
                                                    "
                                                    class="text-light"
                                                >
                                                    <i
                                                        class="mdi mdi-eye-outline text-light mx-2"
                                                    ></i>
                                                    View Details</a
                                                >
                                            </button>
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

        <div class="my-5">
            <div class="col-12 px-0">
                <h3 class="text-dark">New partners</h3>
                <div class="card" v-if="Newpartners.length > 0">
                    <div
                        class="card-header d-flex justify-content-between my-3"
                    >
                        <div>
                            <div class="input-container">
                                <i class="mdi mdi-magnify mdi-icon"></i>
                                <input
                                    class="input-field"
                                    type="text"
                                    placeholder="Search for partners"
                                />
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-light p-3">
                                <i class="mdi mdi-sort-variant text-dark"></i>
                                Filters
                            </button>
                        </div>
                    </div>
                    <div class="card-body mb-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Partner</th>
                                        <th>Progress</th>
                                        <th>Members</th>
                                        <th>Departments</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="partner in Newpartners"
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
                                                    >Active Period:
                                                    {{ "8 months ago" }}</span
                                                >
                                            </div>
                                        </td>
                                        <td class="stats">
                                            <p class="progress_text text-muted">
                                                {{ "48%" }}
                                            </p>
                                            <div class="progress">
                                                <div
                                                    class="progress-bar bg-primary"
                                                    role="progressbar"
                                                    :style="{ width: '48%' }"
                                                    aria-valuenow="5"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                ></div>
                                            </div>
                                        </td>
                                        <td class="td-members">
                                           <!-- <img
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                src="member.image"
                                                alt="image"
                                            />-->
                                            <div class="d-flex flex-row">
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
                                                </template></div>
                                            <!--<div class="d-flex flex-row">
                                                <div class="member_image_plus"
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+1</p>
                                                </div>
                                                </div>-->
                                        </td>
                                        <td>
                                            <span
                                                class="department-tag"
                                                v-for="department in uniqueDepartments"
                                                :key="department.id"
                                                >{{ department.name }}</span
                                            >
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-pri d-flex align-items-center"
                                            >
                                                <i
                                                    class="mdi mdi-eye-outline text-light mx-2"
                                                ></i>
                                                <a
                                                    :href="
                                                        '/partners/' +
                                                        partner.id
                                                    "
                                                    class="text-light"
                                                    >View Details</a
                                                >
                                            </button>
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
                <div v-else>
                    <p>There are no new partners.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from "../store";
import { mapState } from "vuex";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faTrashCan } from "@fortawesome/free-solid-svg-icons";
import { faUser } from "@fortawesome/free-solid-svg-icons";


library.add(
    faTrashCan,
    faUser
);

export default {
    props: {
        user: {
            type: Object,
            required: true,
        },

        data: {
            type: Object,
            required: true,
        },
    },
    components: {
        FontAwesomeIcon,
    },
    data() {
        return {
            offTrack: 3,
            base_url: "../",
            atRisk: 1,
            onTrack: 6,
            partners: [],
            Newpartners: [],
            currentPage: 1,
            totalPages: 0,
        };
    },

    async created() {

       await this.fetchPartners();
       await  this.fetchNewPartners();

       
        console.log("New Partners are:",JSON.stringify(this.partners));
    },

    mounted() {
        console.log("Data is" + JSON.stringify(this.data));

        this.$store.dispatch("updateLoggedUser", this.data.loggeduser);
        // this.fetchUserWithRelatedData();
        

    },
    computed: {
        ...mapState(["loggedUser"]),

        uniqueDepartments() {
            const uniqueDepartments = [];
            this.partners.forEach((partner) => {
                partner.departments.forEach((department) => {
                    // Check if the department is not already in the uniqueDepartments array
                    const existingDepartment = uniqueDepartments.find(
                        (d) => d.id === department.id
                    );
                    if (!existingDepartment) {
                        uniqueDepartments.push(department);
                    }
                });
            });
            return uniqueDepartments;
        },


          partnersWithProgress() {
            // Create an empty object to store unique partners
            const uniquePartners = {};

            // Iterate through partners and calculate progress
            this.partners.forEach((partner) => {
                const calculatedProgress = this.calculateKpiProgress(
                    partner.kpis
                );
                const statusClass = this.getStatusClass(partner);

                // Check if the partner name is not already in the uniquePartners object
                if (!uniquePartners[partner.name]) {
                    // If not, create an entry for the partner
                    uniquePartners[partner.name] = {
                        id: partner.id, // Include the id property
                        name: partner.name,
                        image: partner.image,
                        calculatedProgress,
                        statusClass,
                        members: partner.members,
                        departments: partner.departments,
                    };
                } else {
                    // If the partner name is already in uniquePartners, update progress and status
                    const existingPartner = uniquePartners[partner.name];
                    existingPartner.calculatedProgress += calculatedProgress;
                    existingPartner.statusClass =
                        this.getStatusClass(existingPartner);
                }
            });

            // Convert the uniquePartners object values (unique partners) back to an array
            return Object.values(uniquePartners);
        },

    },
    methods: {

           

        async fetchUserWithRelatedData() {
            let uri = this.base_url + `api/v1/user`;
            try {
                const response = await axios.get(uri);
                const user = response.data.user;
                console.log("Response is:" + JSON.stringify(user));
                this.$store.dispatch("updateLoggedUser", user);
            } catch (error) {
                console.error("Error fetching user data:", error);
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
        },

        async fetchPartners() {
            let uri = this.base_url + `api/v1/partner-list`;
          await  axios.get(uri).then((response) => {
                this.partners = response.data;
            });
        },
        async fetchNewPartners() {
            let uri = this.base_url + `api/v1/partner-new`;
          await  axios.get(uri).then((response) => {
                this.Newpartners = response.data;
            });
        },



         calculateKpiProgress(kpis) {
            let totalCurrentValue = 0;
            let totalTargetValue = 0;

            kpis.forEach((kpi) => {
                kpi.kpi_metrics.forEach((kpiMetric) => {
                    totalTargetValue += kpiMetric.timely_value;
                    kpiMetric.kpi_metric_members.forEach((member) => {
                        member.progress.forEach((progress) => {
                            totalCurrentValue += progress.current_value;
                            
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

            if (Array.isArray(partner.kpis)) {
                for (const kpi of partner.kpis) {
                    if (Array.isArray(kpi.kpi_metrics)) {
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
            }

            return "off-track";
        },

    },
};
</script>

<style scoped>
.btn-icon {
    display: flex;
    align-items: center;
    font-weight: bold;
}

.view-btn {
    cursor: pointer;
    font-size: 12px; /* Adjust font size */
    background-color: #0072bb;
    display: flex;
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

/*.progress_text {
    color: #000;
}*/


.on-track {
    background-color: #5cb85c;
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


.off-track-label {
    color: #d9534f;
    font-size: 12px;
}

.at-risk-label {
    color: #f0ad4e;
    font-size: 12px;
}

.on-track-status{
  font-size: 14px;
    color: #047a48;
}

.off-track-status{
  color: #d9534f;
  font-size: 14px;
}

.at-risk-label{
  color: #f0ad4e;
  font-size: 14px;
}
</style>
