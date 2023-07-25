<template>
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/partners">Department</a></li>
          <li class="breadcrumb-item active" aria-current="page">Department Details</li>
        </ol>
      </nav>
      <h1>{{ department.name }}</h1>

      <div class="top-header">
        <nav class="navbar navbar-expand-lg navbar">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="#performance" class="nav-link">Performance</a>
            </li>
            <li class="nav-item">
              <a href="#partner" class="nav-link">Partner <span class="encircle">{{ partners.length }}</span></a>
            </li>
            <li class="nav-item">
              <a href="#members" class="nav-link">
                Members
                <span class="encircle">{{ members.length }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#details" class="nav-link">Details</a>
            </li>
          </ul>
        </nav>
        <hr class="pt-0" />
      </div>

      <div class="dropdown-divider"></div>
      <h3>Performance Overview</h3>

      <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
          <div class="card bg-light">
            <div class="card-body">
              <h5 class="mb-2 text-danger">OFF TRACK</h5>
              <h6 class="text-primary font-weight-normal lead text-dark">{{ offTrackCount }}</h6>
              <h5 class="mb-2 text-dark">PARTNERS</h5>
              <span class="mdi mdi-arrow-up text-danger icon-item"> 40%</span> <small>vs last month</small>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
          <div class="card bg-light">
            <div class="card-body">
              <h5 class="mb-2 text-warning">AT RISK</h5>
              <h6 class="text-primary font-weight-normal lead text-dark">{{ atRiskCount }}</h6>
              <h5 class="mb- text-dark">PARTNERS</h5>
              <span class="mdi mdi-arrow-down text-warning icon-item"> -100%</span> <small>vs last month</small>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
          <div class="card bg-light">
            <div class="card-body">
              <h5 class="mb-2 text-success">ON TRACK</h5>
              <h6 class="text-primary font-weight-normal lead text-dark">{{ onTrackCount }}</h6>
              <h5 class="mb-2 text-dark">PARTNERS</h5>
              <span class="mdi mdi-arrow-up text-success icon-item"> +50%</span> <span class="ml-2"></span>
              <small>vs last month</small>
            </div>
          </div>
        </div>
      </div>

      <div class="row ">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-header d-flex justify-content-between my-3">
              <div>
                <input class="btn btn-light p-3" type="text" placeholder="search for partners">
              </div>
              <div>
                <button class="btn btn-light p-3">
                  <i class="mdi mdi-format-align-bottom text-dark"></i>
                  Filters
                </button>
              </div>
            </div>
            <div class="card-body">
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
                    <!-- Replace the static data with dynamic data using v-for directive -->
                    <tr v-for="(partner, index) in partners" :key="index">
                      <td>
                        <img :src="partner.image" alt="image" />
                        <span class="pl-2">{{ partner.name }}</span>
                      </td>
                      <td>
                        <div class="progress">
                          <div
                            class="progress-bar"
                            :style="{ width: partner.progress + '%' }"
                            role="progressbar"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          >
                            {{ partner.progress }}%
                          </div>
                        </div>
                      </td>
                      <td>
                        <img v-for="member in partner.members" :src="member.image" :alt="member.name" :key="member.name" />
                      </td>
                      <td>
                        <span
                          class="bg-warning p-2 border-3 m-2"
                          v-for="department in partner.departments"
                          :key="department"
                        >
                          {{ department }}
                        </span>
                      </td>
                      <td>
                        <div class="btn btn-primary p-2">View details</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
        department: {
            type: Object,
            required: true,
        },
        members: {
            type: Array,
            required: true,
        },
        partners: {
            type: Array,
            required: true,
        },
    },
    data() {
      return {
        department: {
          name: this.department.name, 
        },
        partnerCount: 6,
        memberCount: 6,
        offTrackCount: 3,
        atRiskCount: 1,
        onTrackCount: 6,
        partners: [
          {
            name: "Ranson Labs",
            image: "assets/images/faces/face1.jpg",
            progress: 48,
            members: [
              { name: "Member 1", image: "assets/images/faces/face1.jpg" },
              { name: "Member 2", image: "assets/images/faces/face3.jpg" },
              { name: "Member 3", image: "assets/images/faces/face4.jpg" },
            ],
            departments: ["Accounting", "Admin", "Sales", "..."],
          },
          {
            name: "Popote",
            image: "assets/images/faces/face2.jpg",
            progress: 18,
            members: [
              { name: "Member 4", image: "assets/images/faces/face1.jpg" },
              { name: "Member 5", image: "assets/images/faces/face5.jpg" },
              { name: "Member 6", image: "assets/images/faces/face6.jpg" },
            ],
            departments: ["Admin", "Marketing", "Sales"],
          },
          {
            name: "Soko Digi",
            image: "assets/images/faces/face9.jpg",
            progress: 56,
            members: [
              { name: "Member 7", image: "assets/images/faces/face9.jpg" },
              { name: "Member 8", image: "assets/images/faces/face6.jpg" },
              { name: "Member 9", image: "assets/images/faces/face1.jpg" },
            ],
            departments: ["Marketing", "Sales"],
          },
        ],
      };
    },
  };
  </script>
<style>
.encircle {
  padding: 3px;
  border-radius: 50%;
  background-color: rgba(128, 128, 128, 0.089);
  color: rgba(24, 23, 23, 0.911);
}
</style>
