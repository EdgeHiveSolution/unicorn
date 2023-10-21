<template>
    <div class="welcome">
        <h1 style="font-size: 20px" class="txt-dark">
            Welcome Back, {{ data.loggeduser.name.split(" ")[0] }}
        </h1>
          <div v-if="data.loggeduser.user_role_id === 1">
        <h3 style="font-size: 20px" class="txt-gray">
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
                <span class="mdi mdi-arrow-up txt-danger icon-item"> 0</span>
                <small> vs last month</small>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin">
                <h5 class="mb-2 txt-warning">AT RISK</h5>
                <h6 class="text-primary font-weight-normal lead text-dark">
                    {{ atRisk }}
                </h6>
                <h4 class="mb- txt-dark">PARTNERS</h4>
                <span class="mdi mdi-arrow-down txt-warning icon-item"> 0</span>
                <small> vs last month</small>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin">
                <h5 class="mb-2 txt-success">ON TRACK</h5>
                <h6 class="text-primary font-weight-normal text-dark">
                    {{ onTrack }}
                </h6>
                <h4 class="mb-2 txt-dark">PARTNERS</h4>
                <span class="mdi mdi-arrow-up txt-success icon-item"> 0</span>
                <span class="ml-2"></span>
                <small> vs last month</small>
            </div>
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
                            <div style="margin-left: 20px"></div>

                            <button
                                style="height: 10px"
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
                                    <button class="dropdown-item text-danger" @click="generateReport">
                                        <span
                                            class="fa fa-download mr-2"
                                        ></span
                                        >Report
                                    </button>
                                </div>
                            </div>
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
                                        <th></th>
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
                                                    {{
                                                        calculateActivePeriod(
                                                            partner.created_at
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </td>
                                        <td
                                            v-if="
                                                partner.calculatedProgress > 0
                                            "
                                        >
                                            <div>
                                                {{
                                                    partner.calculatedProgress.toFixed(
                                                        2
                                                    )
                                                }}%
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
                                                <div class="progress-labels">
                                                    <span
                                                        class="status-label off-track-label"
                                                        v-if="
                                                            getStatusClass(
                                                                partner
                                                            ) === 'off-track'
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
        <div v-if="data.loggeduser.user_role_id === 1">
        <div class="my-5">
            <div class="col-12 px-0">
                <h3 class="text-dark">New partners</h3>
                <div class="card" v-if="partnersWithProgress.length > 0">
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="partner in newpartnersWithProgress"
                                        :key="partner.id"
                                    >
                                    <!--<tr v-for="partner in partnersWithProgress"
                                            :key="partner.id">-->
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
                                                    {{
                                                        calculateActivePeriod(
                                                            partner.created_at
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </td>
                                        <td
                                            v-if="
                                                partner.calculatedProgress > 0
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
                                                <div class="progress-labels">
                                                    <span
                                                        class="status-label off-track-label"
                                                        v-if="
                                                            getStatusClass(
                                                                partner
                                                            ) === 'off-track'
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
                <div v-else>
                    <p>There are no new partners.</p>
                </div>
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
            offTrack: 0,
            base_url: "../",
            atRisk: 0,
            onTrack: 0,
            partners: [],
            Newpartners: [],
            currentPage: 1,
            totalPages: 0,
        };
    },

    async created() {
        await this.fetchPartners();
        await this.fetchNewPartners();

        console.log("New Partners are:", JSON.stringify(this.partners));
    },

    mounted() {
        console.log("Data is" + JSON.stringify(this.data));

        this.$store.dispatch("updateLoggedUser", this.data.loggeduser);

        // this.fetchUserWithRelatedData();
    },
    computed: {
        ...mapState(["loggedUser"]),

        offTrack() {
            return this.partnersWithProgress.filter(
                (partner) => this.getStatusClass(partner) === "off-track"
            ).length;
        },
        atRisk() {
            return this.partnersWithProgress.filter(
                (partner) => this.getStatusClass(partner) === "at-risk"
            ).length;
        },
        onTrack() {
            return this.partnersWithProgress.filter(
                (partner) => this.getStatusClass(partner) === "on-track"
            ).length;
        },

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
            return this.partners.map((partner) => ({
                ...partner,
                calculatedProgress: this.calculateKpiProgress(partner.kpis),

                statusClass: this.getStatusClass(partner),
            }));
        },

        /*partnersWithProgress() {
            return this.partners.map((partner) => ({
                ...partner,
                calculatedProgress: this.calculateKpiProgress(partner.kpis),

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
        },*/

        newpartnersWithProgress() {
            return this.Newpartners.map((partner) => ({
                ...partner,
                calculatedProgress: this.calculateKpiProgress(partner.kpis),

                statusClass: this.getStatusClass(partner),
            }));
        },

        activePeriods() {
            const currentDate = new Date();
            return this.partnersWithProgress.map((partner) => {
                const creationDate = new Date(partner.created_at);
                const monthsAgo =
                    currentDate.getMonth() -
                    creationDate.getMonth() +
                    12 *
                        (currentDate.getFullYear() -
                            creationDate.getFullYear());
                return `${monthsAgo} months ago`;
            });
        },

        //   partnersWithProgress() {
        //      console.log("partnersWithProgress method called.");
        //     // Create an empty object to store unique partners
        //     const uniquePartners = {};

        //     // Iterate through partners and calculate progress
        //     this.partners.forEach((partner) => {
        //         const calculatedProgress = this.calculateKpiProgress(
        //             partner.kpis
        //         );
        //         const statusClass = this.getStatusClass(partner);

        //         // Check if the partner name is not already in the uniquePartners object
        //         if (!uniquePartners[partner.name]) {
        //             // If not, create an entry for the partner
        //             uniquePartners[partner.name] = {
        //                 id: partner.id, // Include the id property
        //                 name: partner.name,
        //                 image: partner.image,
        //                 calculatedProgress,
        //                 statusClass,
        //                 members: partner.members,
        //                 departments: partner.departments,
        //             };
        //         } else {
        //             // If the partner name is already in uniquePartners, update progress and status
        //             const existingPartner = uniquePartners[partner.name];
        //             existingPartner.calculatedProgress += calculatedProgress;
        //             existingPartner.statusClass =
        //                 this.getStatusClass(existingPartner);
        //         }
        //     });

        //     // Convert the uniquePartners object values (unique partners) back to an array
        //     return Object.values(uniquePartners);
        // }
            },
    methods: {

    generateReport() {

      if (this.data.loggeduser.user_role_id !== 3) {
        console.error('Unauthorized');
        return;
      }


      const userId = this.data.loggeduser.id;
      let uri = this.base_url + `api/v1/generate-report?user_id=${userId}`;
      axios
        .get(uri)
        .then((response) => {
          const downloadUrl = response.data.url; 
          window.location.href = downloadUrl;
        })
        .catch((error) => {
          console.error('Error generating report:', error);
        });
    },

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
            console.log("Logged User", JSON.stringify(this.data.loggeduser));

            let uri =
                this.base_url +
                `api/v1/partner-list?user_id=${this.data.loggeduser.id}&user_role_id=${this.data.loggeduser.user_role_id}`;
            await axios.get(uri).then((response) => {
                this.partners = response.data;
            });
        },

        // async fetchPartners() {
        //     console.log("Logged Users" , JSON.stringify(this.data.loggeduser));

        //     // const loggedUser

        //     let uri = this.base_url + `api/v1/partner-list`;
        //     await axios.get(uri).then((response) => {
        //         this.partners = response.data;
        //     });
        // },

        async fetchNewPartners() {
            let uri = this.base_url + `api/v1/partner-new?user_id=${this.data.loggeduser.id}&user_role_id=${this.data.loggeduser.user_role_id}`;
            await axios.get(uri).then((response) => {
                this.Newpartners = response.data;
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

        calculateActivePeriod(creationDate) {
            const currentDate = new Date();
            const timeDifference = currentDate - new Date(creationDate);

            // Calculate seconds, minutes, hours, days, and months
            const seconds = Math.floor(timeDifference / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);
            const months = Math.floor(days / 30.44);

            if (months > 0) {
                return `${months} month${months > 1 ? "s" : ""} ago`;
            } else if (days > 0) {
                return `${days} day${days > 1 ? "s" : ""} ago`;
            } else if (hours > 0) {
                return `${hours} hour${hours > 1 ? "s" : ""} ago`;
            } else if (minutes > 0) {
                return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
            } else {
                return `${seconds} second${seconds > 1 ? "s" : ""} ago`;
            }
        },

        getStatusClass(partner) {
            const progressPercentage = parseFloat(partner.calculatedProgress);

            if (isNaN(progressPercentage)) {
                return "N/A"; // Handle the case where progress is not available
            }

            console.log("Progress Percentage is:", progressPercentage);

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
    }}
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
