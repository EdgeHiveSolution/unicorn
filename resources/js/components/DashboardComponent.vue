<template>
    <div class="welcome">
      <h1 class="txt-dark">Welcome Back, {{ userName }}</h1>
      <h3 class="txt-gray">Track and manage the team’s overall performance.</h3>
      <h4 class="txt-dark">Performance Overview</h4>

      <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin">
          <h5 class="mb-2 txt-danger">OFF TRACK</h5>
          <h6 class="text-primary font-weight-normal lead text-dark">{{ offTrack }}</h6>
          <h4 class="mb-2 txt-dark">PARTNERS</h4>
          <span class="mdi mdi-arrow-up txt-danger icon-item"> 40%</span>
          <small> vs last month</small>
        </div>

        <div class="col-xl-3 col-sm-6 grid-margin">
          <h5 class="mb-2 txt-warning">AT RISK</h5>
          <h6 class="text-primary font-weight-normal lead text-dark">{{ atRisk }}</h6>
          <h4 class="mb- txt-dark">PARTNERS</h4>
          <span class="mdi mdi-arrow-down txt-warning icon-item"> -100%</span>
          <small> vs last month</small>
        </div>

        <div class="col-xl-3 col-sm-6 grid-margin">
          <h5 class="mb-2 txt-success">ON TRACK</h5>
          <h6 class="text-primary font-weight-normal text-dark">{{ onTrack }}</h6>
          <h4 class="mb-2 txt-dark">PARTNERS</h4>
          <span class="mdi mdi-arrow-up txt-success icon-item"> +50%</span>
          <span class="ml-2"></span>
          <small> vs last month</small>
        </div>
      </div>

      <div class="row">
        <div class="col-12 px-0">
          <div class="card">
            <div class="card-header d-flex justify-content-between my-3">
              <div>
                <div class="input-container">
                  <i class="mdi mdi-magnify mdi-icon"></i>
                  <input class="input-field" type="text" placeholder="Search for partners">
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
                    <tr v-for="partner in partners" :key="partner.id">
                      <td>
                        <div class="d-flex align-items-center">
                          <img :src="partner.image" alt="image" />
                          <span class="pl-2">{{ partner.name }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                          <span class="active-period txt-gray">Active Period: {{ '8 months ago' }}</span>
                        </div>
                      </td>
                      <td class="stats">
                        <span>{{ '48%' }}</span>
                        <div class="progress">
                          <div class="progress-bar bg-primary" role="progressbar" :style="{ width: '48%' }" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td class="td-members">
                        <img v-for="member in partner.members" :key="member.id" src="member.image" alt="image" />
                      </td>
                      <td>
                        <span class="department-tag" v-for="department in partner.departments" :key="department.id">{{ department.name }}</span>
                      </td>
                      <td>
                        <button class="btn btn-pri px-1 py-1 d-flex align-items-center">
                          <i class="mdi mdi-eye-outline text-light mx-2"></i>
                          <a :href="'/partners/' + partner.id" class="text-light">View Details</a>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <pagination :total="totalPages" :current="currentPage" @page-change="handlePageChange"></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="my-5">
        <div class="col-12 px-0">
            <h3 class="text-dark">New partners</h3>
          <div class="card">
            <div class="card-header d-flex justify-content-between my-3">
              <div>
                <div class="input-container">
                  <i class="mdi mdi-magnify mdi-icon"></i>
                  <input class="input-field" type="text" placeholder="Search for partners">
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
                    <tr v-for="partner in partners" :key="partner.id">
                      <td>
                        <div class="d-flex align-items-center">
                          <img :src="partner.image" alt="image" />
                          <span class="pl-2">{{ partner.name }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                          <span class="active-period txt-gray">Active Period: {{ '8 months ago' }}</span>
                        </div>
                      </td>
                      <td class="stats">
                        <span>{{ '48%' }}</span>
                        <div class="progress">
                          <div class="progress-bar bg-primary" role="progressbar" :style="{ width: '48%' }" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td class="td-members">
                        <img v-for="member in partner.members" :key="member.id" src="member.image" alt="image" />
                      </td>
                      <td>
                        <span class="department-tag" v-for="department in partner.departments" :key="department.id">{{ department.name }}</span>
                      </td>
                      <td>
                        <button class="btn btn-pri  d-flex align-items-center">
                          <i class="mdi mdi-eye-outline text-light mx-2"></i>
                          <a :href="'/partners/' + partner.id" class="text-light">View Details</a>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <pagination :total="totalPages" :current="currentPage" @page-change="handlePageChange"></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
    userName: {
      type: String,
      required: true,
    },
  },
    data() {
      return {
        user: {
          name: '',
        },
        offTrack: 3,
        base_url:'../',
        atRisk: 1,
        onTrack: 6,
        partners: [],
        currentPage: 1,
        totalPages: 0,
      };
    },
    mounted() {
      this.fetchPartners();
    },
    methods: {
      handlePageChange(page) {
        // Update 'partners' with the data of the requested page
        this.currentPage = page;
      },
      fetchPartners(){
                let uri =this.base_url+`api/v1/partner-list`;
                axios.get(uri).then((response) => {
                    this.partners = response.data;
                });
            },
    },
  };
  </script>

  <style scoped>



  </style>

