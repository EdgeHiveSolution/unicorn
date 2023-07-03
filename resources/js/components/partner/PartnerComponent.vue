<template>
    <div>
      <div v-if="success" class="alert alert-success">
        {{ success }}
      </div>

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
            <div class="card-header d-flex justify-content-between my-3">
              <div>
                <div class="input-container">
                  <i class="mdi mdi-magnify mdi-icon"></i>
                  <input class="input-field" type="text" placeholder="Search for partners" v-model="searchQuery">
                </div>
              </div>

              <div>
                <button class="btn btn-light p-3" @click="showFilters">
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
                      <tr v-for="partner in partners" :key="partner.id">
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="assets/images/faces/face1.jpg" alt="image" />
                            <span class="pl-2">{{ partner.name }}</span>
                          </div>
                          <div class="d-flex align-items-center">
                            <span class="active-period txt-gray">Date Joined: {{ partner.created_at }}</span>
                          </div>
                        </td>
                        <td>
                          <button class="btn btn-suc">
                            <span class="txt-success">Active</span>
                          </button>
                        </td>
                        <td>
                          <span class="txt-dark">{{ partner.business_type }}</span><br>
                          <span class="txt-gray">{{ partner.about }}</span>
                        </td>
                        <td class="td-members">
                          <img src="assets/images/faces/face1.jpg" alt="image" />
                          <img src="assets/images/faces/face3.jpg" alt="image" />
                          <img src="assets/images/faces/face4.jpg" alt="image" />
                        </td>
                        <td>
                          48%
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" :style="{ width: '48%' }"
                              aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          off track
                        </td>
                        <td>
                          <button class="btn btn-pri px-2 py-1 d-flex align-items-center">
                            <i class="mdi mdi-eye-outline text-light"></i>
                            <router-link :to="`/partners/${partner.id}`" class="text-light">View</router-link>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <pagination :current-page="currentPage" :total-pages="totalPages" @page-change="fetchPartners" />
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        success: '',
        searchQuery: '',
        partners: [],
        currentPage: 1,
        base_url:'../',
        totalPages: 0
      };
    },
    mounted() {
      this.fetchPartners();
    },
    methods: {
        fetchPartners(){
                let uri =this.base_url+`api/v1/partner-list`;
                axios.get(uri).then((response) => {
                    this.partners = response.data.data;
                });
            },
      showFilters() {
        // Implement your logic to show filters
      }
    }
  };
  </script>

  <style scoped>
  /* Add any necessary CSS styles here */
  </style>

