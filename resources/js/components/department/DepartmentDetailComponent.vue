<template>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/partners">Department</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Department Details
                </li>
            </ol>
        </nav>
        <h1>{{ department.name }}</h1>

        <div class="top-header">
            <nav class="navbar navbar-expand-lg navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a
                            href="#performance"
                            class="nav-link"
                            @click="activeTab = 'performance'"
                            :class="{ active: activeTab === 'performance' }"
                            >Performance</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="#partner"
                            class="nav-link"
                            @click="activeTab = 'partner'"
                            :class="{ active: activeTab === 'partner' }"
                            >Partners
                            <span class="encircle">{{
                                partnersWithProgress.length
                            }}</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="#members"
                            class="nav-link"
                            @click="activeTab = 'members'"
                            :class="{ active: activeTab === 'members' }"
                        >
                            Members
                            <span class="encircle">{{ members.length }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="#details"
                            class="nav-link"
                            @click="activeTab = 'details'"
                            :class="{ active: activeTab === 'details' }"
                            >Details</a
                        >
                    </li>
                </ul>
            </nav>
            <hr class="pt-0" />
        </div>

        <div class="dropdown-divider"></div>
        <div v-if="activeTab === 'performance'">
            <h3>Performance Overview</h3>

            <div class="row">
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="mb-2 text-danger">OFF TRACK</h5>
                            <h6
                                class="text-primary font-weight-normal lead text-dark"
                            >
                                {{ offTrack }}
                            </h6>
                            <h5 class="mb-2 text-dark">PARTNERS</h5>
                            <span
                                class="mdi mdi-arrow-up text-danger icon-item"
                            >
                                0</span
                            >
                            <small>vs last month</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="mb-2 text-warning">AT RISK</h5>
                            <h6
                                class="text-primary font-weight-normal lead text-dark"
                            >
                                {{ atRisk }}
                            </h6>
                            <h5 class="mb- text-dark">PARTNERS</h5>
                            <span
                                class="mdi mdi-arrow-down text-warning icon-item"
                            >
                                0</span
                            >
                            <small>vs last month</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="mb-2 text-success">ON TRACK</h5>
                            <h6
                                class="text-primary font-weight-normal lead text-dark"
                            >
                                {{ onTrack }}
                            </h6>
                            <h5 class="mb-2 text-dark">PARTNERS</h5>
                            <span
                                class="mdi mdi-arrow-up text-success icon-item"
                            >
                                0</span
                            >
                            <span class="ml-2"></span>
                            <small>vs last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div
                            class="card-header d-flex justify-content-between my-3"
                        >
                            <div class="input-container">
                                <i class="mdi mdi-magnify mdi-icon"></i>
                                <input
                                    style="height: 10px"
                                    class="input-field"
                                    type="text"
                                    placeholder="Search for partners"
                                />
                            </div>
                            <!-- <div>
                <input class="btn btn-light p-3" type="text" placeholder="search for partners">
              </div> -->
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
                        <div class="card-body">
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
                                        <!-- Replace the static data with dynamic data using v-for directive -->
                                        <tr
                                            v-for="partner in partnersWithProgress"
                                            :key="partner.id"
                                        >
                                            <td>
                                                <img
                                                    :src="partner.logo"
                                                    alt="logo"
                                                />
                                                <span class="pl-2">{{
                                                    partner.name
                                                }}</span>
                                            </td>
                                            <td
                                                v-if="
                                                    partner.calculatedProgress >
                                                    0
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
                                            <td>
                                                <img
                                                    v-for="member in partner.members"
                                                    :src="member.photo"
                                                    alt="member.email"
                                                    :key="member.id"
                                                />
                                            </td>
                                            <td>
                                                <span
                                                    class="department-tag"
                                                    v-for="department in uniqueDepartments"
                                                    :key="department.id"
                                                >
                                                    {{ department.name }}
                                                </span>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-sm px-2 py-2 btn-pri d-flex flex-row justify-content-center align-items-center"
                                                >
                                                    <span
                                                        class="mdi mdi-eye-outline text-light"
                                                    ></span>
                                                    <a
                                                        :href="
                                                            '/department_partners/' +
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
                            </div>
                        </div>
                    </div>

                    <br />

                    <div class="card">
                        <h3>Department Metrics</h3>
                        <div
                            class="card-header d-flex justify-content-between my-3"
                        >
                            <div class="input-container">
                                <i class="mdi mdi-magnify mdi-icon"></i>
                                <input
                                    style="height: 10px"
                                    class="input-field"
                                    type="text"
                                    placeholder="Search KPI Metrics"
                                />
                            </div>
                            <!-- <div>
                <input class="btn btn-light p-3" type="text" placeholder="search for partners">
              </div> -->
                            <div>
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
                                            height: 35px;
                                        "
                                    >
                                        All Departments
                                        <i
                                            class="mdi mdi-close"
                                            style="
                                                font-size: 17px;
                                                margin-left: 5px;
                                            "
                                        ></i>
                                    </button>
                                    <div style="margin-left: 10px"></div>

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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            <th>Current Value</th>
                                            <th>Target</th>
                                            <th>Progress</th>
                                            <th>Top Drivers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Replace the static data with dynamic data using v-for directive -->
                                        <tr
                                            v-for="metric in metricWithProgress"
                                            :key="metric.id"
                                        >
                                            <td>
                                                <div>
                                                    {{ metric.name }}
                                                </div>
                                                <div>
                                                    <span class="txt-gray">
                                                        Partners:
                                                        {{
                                                            metric.partners
                                                                .length
                                                        }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                {{
                                                    metric.totalCurrentValue.toFixed(
                                                        0
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    metric.totalTargetValue.toFixed(
                                                        2
                                                    )
                                                }}
                                            </td>

                                            <td>
                                                {{
                                                    metric.calculatedProgress.toFixed(
                                                        2
                                                    )
                                                }}%

                                                <div class="progress">
                                                    <div
                                                        class="progress-bar"
                                                        :style="{
                                                            width:
                                                                metric.calculatedProgress +
                                                                '%',
                                                        }"
                                                        aria-valuemin="0"
                                                        aria-valuemax="100"
                                                    ></div>
                                                </div>
                                            </td>

                                            <td class="td-members">
                                                <template
                                                    v-for="member in topDrivers"
                                                    :key="member.id"
                                                >
                                                    <img
                                                        v-for="member in member.topDrivers"
                                                        :key="member.id"
                                                        src="assets/images/faces/face1.jpg"
                                                        :alt="member.email"
                                                    />
                                                </template>
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

        <!-- Partner tab content -->
        <div v-else-if="activeTab === 'partner'">
            <!-- Your Partner tab content here -->
            <!-- ... -->
            <div><h3></h3></div>
            <div class="card">
                <div class="card-header d-flex justify-content-between my-3">
                    <div class="input-container">
                        <i class="mdi mdi-magnify mdi-icon"></i>
                        <input
                            style="height: 10px"
                            class="input-field"
                            type="text"
                            placeholder="Search KPI Metrics"
                        />
                    </div>
                    <!-- <div>
                <input class="btn btn-light p-3" type="text" placeholder="search for partners">
              </div> -->
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Partner</th>
                                    <th>Status</th>
                                    <th>About</th>
                                    <th>Members</th>
                                    <th>Active KPIs</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="partner in partnersWithProgress"
                                    :key="partner.id"
                                >
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img
                                                :src="partner.logo"
                                                alt="logo"
                                            />
                                            <span class="pl-2">{{
                                                partner.name
                                            }}</span>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <span class="active-period txt-gray"
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
                                    <td v-if="partner.calculatedProgress > 0">
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
                                                        getStatusClass(partner)
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

                                    <td v-else>No Active Kpis</td>
                                    <td>
                                        <button
                                            class="btn btn-sm px-2 py-2 btn-pri d-flex flex-row justify-content-center align-items-center"
                                        >
                                            <span
                                                class="mdi mdi-eye-outline text-light"
                                            ></span>
                                            <a
                                                :href="
                                                    '/department_partners/' +
                                                    partner.id
                                                "
                                                class="text-light"
                                                >View</a
                                            >
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <table class="table">
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
                                    v-for="kpiMetric in kpiMetricsWithProgress"
                                    :key="kpiMetric.id"
                                  >
                                    <td>
                                        {{ kpiMetric.title }}
                                    </td>
                                    <td>
                                        {{ kpiMetric.currentSum}}
                                    </td>
                                    <td>
                                        {{ kpiMetric.targetSum }}
                                    </td>
                                    <td>
                                        <div>
                                            {{
                                                kpiMetric.progressPercentage
                                            }}%
                                            <div class="progress">
                                                <div
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    :style="{
                                                        width:
                                                            kpiMetric.progressPercentage + '%',
                                                    }"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                ></div>
                                            </div>
                                        </div>
                                        {{ kpiMetric.progressStatus }}
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Members tab content -->
        <div v-else-if="activeTab === 'members'">
            <!-- Your Members tab content here -->
            <!-- ... -->

            <div><h3>Department Members</h3></div>

            <div>
                The progress of all members in the
                {{ department.name }} department.
            </div>
            <br />
            <div class="card">
                <div class="card-header d-flex justify-content-between my-3">
                    <div class="input-container">
                        <i class="mdi mdi-magnify mdi-icon"></i>
                        <input
                            style="height: 10px"
                            class="input-field"
                            type="text"
                            placeholder="Search Members"
                        />
                    </div>
                    <!-- <div>
                <input class="btn btn-light p-3" type="text" placeholder="search for partners">
              </div> -->
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
                                color: blue;
                                height: 35px;
                            "
                        >
                            All
                            <i
                                class="mdi mdi-close"
                                style="font-size: 17px; margin-left: 5px"
                            ></i>
                        </button>
                        <div style="margin-left: 10px"></div>

                        <button
                            style="height: 10px"
                            class="btn btn-light p-3 btn-icon"
                        >
                            <i class="mdi mdi-sort-variant text-dark"></i>
                            Filters
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Status</th>
                                    <th>Partners</th>
                                    <th>Partners At Risk/Off Track</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Replace the static data with dynamic data using v-for directive -->
                                <tr v-for="member in members">
                                    <td>
                                        {{ member.email }}
                                    </td>
                                    <td class="status">
                                        <span>
                                            {{ (member.is_active = "Active") }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            v-for="partner in partnersWithProgress"
                                            :key="partner.id"
                                        >
                                            {{ partner.name }}
                                        </span>
                                    </td>

                                    <td>{{ totalOffTrackAndAtRisk }}</td>

                                    <td>
                                        <button
                                            class="btn btn-sm px-2 py-2 btn-pri d-flex flex-row justify-content-center align-items-center"
                                        >
                                            <span
                                                class="mdi mdi-eye-outline text-light"
                                            ></span>
                                            <a
                                                :href="
                                                    '/department_members/' +
                                                    member.id
                                                "
                                                class="text-light"
                                                >View</a
                                            >
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details tab content -->
        <div v-else-if="activeTab === 'details'">
            <!-- Your Details tab content here -->
            <!-- ... -->
            <div class="d-flex justify-content-between">
                <div>
                    <h3 style="font-size: 16px">Department Info</h3>
                    <p>Enter the details of the department here.</p>
                </div>
                <div class="btn-icon">
                    <button
                        type="button"
                        class="btn btn-light border-dark p-3 btn-action cancel-btn"
                    >
                        Cancel
                    </button>
                    <button
                        class="btn btn-primary p-3 btn-action add-btn"
                        form="form-submit"
                        type="submit"
                    >
                        Save Changes
                    </button>
                </div>
            </div>

            <form
                id="form-submit"
                class="row g-3"
                @submit.prevent="departmentSubmit"
                method="POST"
            >
                <div class="row mb-2 p-3">
                    <label
                        for="name"
                        class="col-md-3 col-form-label text-md-start"
                        >{{ "Name" }}</label
                    >
                    <div class="col-md-5 offset-md-0 text-center">
                        <input
                            style="height: 10px"
                            id="name"
                            name="name"
                            class="form-control form-control-lg"
                            type="text"
                            v-model="department.name"
                            autocomplete="name"
                            autofocus
                        />
                    </div>
                </div>
                <hr />
                <div class="row mb-2 p-3">
                    <label
                        for="email"
                        class="col-md-3 col-form-label text-md-start"
                        >{{ "Email Address" }}</label
                    >
                    <div class="col-md-5 offset-md-0 text-center">
                        <input
                            style="height: 10px"
                            id="email"
                            name="email"
                            class="form-control form-control-lg"
                            type="email"
                            v-model="department.email"
                            autocomplete="email"
                            autofocus
                        />
                    </div>
                </div>
                <hr />

                <div class="row mb-2 p-3">
                    <label
                        for="about"
                        class="col-md-3 col-form-label text-md-start"
                        >{{ "About" }} <br /><span class="text-muted"
                            >Write a brief of the department.</span
                        ></label
                    >
                    <div class="col-md-5 offset-md-0 text-center">
                        <div class="d-flex m-3 justify-content-space-between">
                            <select
                                style="width: 300px; height: 45px"
                                class="form-select form-control form-select-lg mb-3"
                                aria-label=".form-select-lg example"
                            >
                                <option value="normal_text">Normal Text</option>
                                <option value="long_text">Long Text</option>
                                <option value="short_text">Short Text</option>
                            </select>

                            <i
                                ><span
                                    class="text-muted mx-3 h3 text-gray"
                                    id="bold"
                                    ><b>B</b></span
                                ></i
                            >
                            <i
                                ><span
                                    class="text-muted mdi mdi-format-italic mx-3 h3 text-gray"
                                    id="italic"
                                    ><i></i></span
                            ></i>

                            <i
                                class="mx-3 h3 mdi mdi-link text-gray"
                                id="link"
                            ></i>
                            <i
                                class="mx-3 h3 mdi mdi-format-list-bulleted text-gray"
                                id="dotted"
                            ></i>

                            <i
                                class="mx-3 h3 mdi mdi-format-list-numbered text-gray"
                                id="dotted"
                            ></i>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea
                                class="form-control"
                                name="about"
                                placeholder="Write company about here"
                                style="height: 100px"
                                v-model="department.about"
                            ></textarea>
                            <label></label>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row mb-2 p-3">
                    <label
                        for="email"
                        class="col-md-3 col-form-label text-md-start"
                        >{{ "Members" }} <br /><span class="text-muted"
                            >Invite or select the relevant members to this
                            department</span
                        ></label
                     >
                    <div class="col-md-5 offset-md-0 text-center">
                        <div class="row">
                            <div class="input-group">
                                <input
                                    style="
                                        border-radius: 10px;
                                        width: 200px;
                                        height: 40px;
                                    "
                                    placeholder="Select team member or enter email address"
                                    list="memberEmails"
                                    id="email"
                                    class="form-control"
                                    name="email"
                                    v-model="member.email"
                                />
                                <div class="input-group-append mx-3">
                                    <button
                                        style="color: white"
                                        class="btn btn-warning"
                                        @click.prevent="addMemberToList"
                                    >
                                        Add
                                    </button>
                                </div>
                            </div>
                            <datalist id="memberEmails">
                                <option
                                    v-for="member in this.members"
                                    :value="member.email"
                                >
                                    {{ member.email }}
                                </option>
                            </datalist>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-10">
                                <ul class="list-group">
                                    <li
                                        class="list-group-item my-2 p-0"
                                        v-for="(
                                            member, index
                                        ) in departmentMembers"
                                        :key="index"
                                    >
                                        {{ member.email }}
                                        <!-- Check if the member is active to decide which button to display -->
                                        <button
                                            
                                            class="btn btn-sm txt-gray float-end"
                                            @click.prevent="
                                                removeMemberFromList(member.id)
                                            "
                                        >
                                            <i
                                                class="mx-3 h3 mdi mdi-delete text-gray"
                                                id="dotted"
                                            ></i>
                                        </button>
                                        <!-- Display a different indicator for deactivated members -->
                                       
                                    </li>
                                </ul>

                                <!-- <ul class="list-group">
                                    <li
                                        class="list-group-item my-2 p-0"
                                        v-for="(
                                            member, index
                                        ) in departmentMembers"
                                        :key="index"
                                    >
                                        {{ member.email }}
                                        <button
                                            v-if="member.is_active"
                                            class="btn btn-sm txt-gray float-end"
                                            @click.prevent="
                                                removeMemberFromList(member.id)
                                            "
                                        >
                                            <i
                                                class="mx-3 h3 mdi mdi-delete text-gray"
                                                id="dotted"
                                            ></i>
                                        </button>

                                        <div v-else>
                                            <span class="text-muted"
                                                >Deactivated</span
                                            >
                                        </div>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row mb-2 p-3">
                    <label
                        for="email"
                        class="col-md-3 col-form-label text-md-start"
                        >{{ "Remove Department" }}</label
                    >
                    <div class="col-md-5 offset-md-0 text-center">
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="closeAccount"
                        >
                            Remove Department
                        </button>
                    </div>
                </div>

                <div class="text-right mt-3 mb-5">
                    <div class="btn-icon justify-content-end">
                        <button
                            type="button"
                            style="border: lightgrey"
                            class="btn btn-light border-dark p-3 btn-action cancel-btn"
                        >
                            Cancel
                        </button>
                        <button
                            class="btn btn-primary p-3 btn-action add-btn"
                            form="form-submit"
                            type="submit"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>

                <div class="dropdown-divider mb-5"></div>
            </form>
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
            newPartners: [],
            kpiMetricsDetails: [],
            selectedMembers: [],
            departmentMembers: [],
            base_url: "../",
            department: {
                name: this.department.name,
            },

            member: {
                email: "",
            },

            memberDepartment: {
                email: "",
            },

            partnerCount: 6,
            memberCount: 6,
            offTrackCount: 3,
            atRiskCount: 1,
            onTrackCount: 6,
            activeTab: "performance",

            department: {
                id: this.department.id,
                name: this.department.name,
                email: this.department.email,
                about: this.department.about,
            },
        };
    },

    async created() {
        await this.fetchKpiMetrics();

        console.log(
            "KpiMetrics Detail:",
            JSON.stringify(this.kpiMetricsDetails)
        );
    },

    mounted() {
        this.fetchDepartmentMembers();

        // Assuming this.partners contains your data
        const data = this.partners;

        // Create a new array containing distinct partner names
        const newPartners = [];
        const partnerNamesSet = new Set(); // Use a Set to store distinct names

        data.forEach((item) => {
            const partnerName = item.name;
            if (!partnerNamesSet.has(partnerName)) {
                partnerNamesSet.add(partnerName);
                newPartners.push(partnerName);
            }
        });

        // Assign the newPartners array to the component's data property
        this.newPartners = newPartners;
        console.log("Is active Members:", this.departmentMembers);
        console.log("New Partners are:", this.newPartners);
        console.log("Members are", this.members);
        console.log("Departments are", this.department);
        console.log("Partners are", this.partners);
        console.log("Department is", this.department.name);
        // Log the contents of the "members" prop to the console
    },

    // computed: {
    //     // partnersWithProgress() {
    //     //     return this.partners.map((partner) => ({
    //     //         ...partner,
    //     //         calculatedProgress: this.calculateKpiProgress(partner.kpis),

    //     //         statusClass: this.getStatusClass(partner),
    //     //     }));
    //     // },

    computed: {
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

        metricWithProgress() {
            return this.kpiMetricsDetails.map((metric) => ({
                ...metric,
                calculatedProgress: this.calculateMetricProgress(
                    metric.partners.flatMap((partner) =>
                        partner.kpis.flatMap((kpi) => kpi.kpi_metrics)
                    )
                ),
                totalCurrentValue: this.calculateTotalCurrentValueforMetric(
                    metric.partners.flatMap((partner) =>
                        partner.kpis.flatMap((kpi) => kpi.kpi_metrics)
                    )
                ),
                totalTargetValue: this.calculateTotalTargetValueforMetric(
                    metric.partners.flatMap((partner) =>
                        partner.kpis.flatMap((kpi) => kpi.kpi_metrics)
                    )
                ),
            }));
        },

        topDrivers() {
            return this.metricWithProgress.map((metric) => {
                const topDrivers = metric.partners
                    .flatMap((partner) =>
                        partner.kpis.flatMap((kpi) =>
                            kpi.kpi_metrics.flatMap((kpiMetric) =>
                                kpiMetric.kpi_metric_members.flatMap(
                                    (member) => {
                                        // Find the member with matching member_id within the partner's members
                                        const matchingMember =
                                            partner.members.find(
                                                (m) => m.id === member.member_id
                                            );

                                        if (matchingMember) {
                                            return {
                                                member_id: matchingMember.id,
                                                name: matchingMember.name,
                                                email: matchingMember.email,
                                                current_value:
                                                    member.progress
                                                        .current_value,
                                            };
                                        }

                                        return null; // Return null if no matching member found
                                    }
                                )
                            )
                        )
                    )
                    .filter((member) => member !== null) // Remove null entries
                    .reduce((topDrivers, progressItem) => {
                        if (
                            !topDrivers[progressItem.member_id] ||
                            progressItem.current_value >
                                topDrivers[progressItem.member_id].current_value
                        ) {
                            topDrivers[progressItem.member_id] = progressItem;
                        }
                        return topDrivers;
                    }, {});

                const sortedTopDrivers = Object.values(topDrivers).sort(
                    (a, b) => b.current_value - a.current_value
                );

                return {
                    metricName: metric.name,
                    metricValue: metric.totalCurrentValue,
                    topDrivers: sortedTopDrivers,
                    calculatedProgress: metric.calculatedProgress.toFixed(2),
                };
            });
        },

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


   totalOffTrackAndAtRisk() {
    return this.offTrack + this.atRisk;
  },

        // partnersWithProgress() {
        //     return this.partners.map((partner) => ({
        //         ...partner,
        //         calculatedProgress: this.calculateKpiProgress(partner.kpis),

        //         statusClass: this.getStatusClass(partner),
        //     }));
        // },

        partnersWithProgress() {
            const groupedPartners = {};

            this.partners.forEach((partner) => {
                const id = partner.id;

                if (!groupedPartners[id]) {
                    groupedPartners[id] = {
                        id: partner.id,
                        name: partner.name,
                        logo: partner.logo,
                        formatted_created_at: partner.formatted_created_at,
                        about: partner.about,
                        business_type: partner.business_type,
                        calculatedProgress: this.calculateKpiProgress(
                            partner.kpis
                        ),
                        statusClass: this.getStatusClass(partner.kpis),
                        members: partner.members,
                        departments: partner.departments,
                        kpis: partner.kpis,
                    };
                }
            });

            return Object.values(groupedPartners);
        },

        kpiMetricsWithProgress() {
            const uniqueKpiMetrics = {};

            this.partners.forEach((partner) => {
                partner.kpis.forEach((kpi) => {
                    kpi.kpi_metrics.forEach((kpiMetric) => {
                        // Use a unique identifier for each KPI metric, e.g., id
                        const identifier = kpiMetric.id;

                        if (!uniqueKpiMetrics[identifier]) {
                            uniqueKpiMetrics[identifier] = {
                                // Add properties of the KPI metric
                                id: kpiMetric.id,
                                title: kpiMetric.title,
                                // Include other properties you need
                                currentSum: this.calculateCurrentSum(kpiMetric), // Example: Adding calculated current sum
                                targetSum: this.calculateTargetSum(kpiMetric), // Example: Adding calculated target sum
                                progressPercentage:
                                    this.calculateProgressPercentage(kpiMetric),
                                progressStatus:
                                    this.calculateProgressStatus(kpiMetric),
                            };
                        }
                    });
                });
            });

            return Object.values(uniqueKpiMetrics);
        },

        // kpiMetricsWithProgress() {
        //     const kpiMetricsArray = [];

        //     this.partners.forEach((partner) => {
        //         partner.kpis.forEach((kpi) => {
        //             kpi.kpi_metrics.forEach((kpiMetric) => {
        //                 // Create a shallow copy of kpi_metric and add it to the array
        //                 kpiMetricsArray.push({ ...kpiMetric });
        //             });
        //         });
        //     });

        //     return kpiMetricsArray;
        // },

        // partnersWithKpiProgress() {
        //     return this.partners.map((partner) => ({
        //         ...partner,
        //         calculatedKpiMetricProgress: this.calculateKpiMetricProgress(
        //             partner.kpis
        //         ),

        //         statusClass1: this.getStatusClass1(partner),
        //     }));
        // },
    },

    watch: {
        // Watch for changes in the 'partners' array
        partners: {
            handler(newPartners) {
                console.log("Partners changed:", newPartners);
            },
            deep: true, // Watch changes in nested objects within the array
        },

        // Watch for changes in the 'calculatedProgress' property
        "partnersWithKpiProgress.calculateKpiMetricProgress": {
            handler(newProgress) {
                console.log("Calculated Progress changed:", newProgress);
            },
            deep: true, // Watch changes in nested objects within the array
        },
    },

    methods: {
        calculateKpiProgress(kpis) {
            let totalCurrentValue = 0;
            let totalTargetValue = 0;

            //  console.log("Total Current value is:",totalCurrentValue);
            // console.log("Total Target value is:",totalTargetValue);

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

            console.log("Total Current value is:", totalCurrentValue);
            console.log("Total Target value is:", totalTargetValue);

            if (totalTargetValue === 0) {
                return 0;
            }

            return (totalCurrentValue / totalTargetValue) * 100;
        },

        // calculateKpiMetricProgress(partners) {
        //     let totalProgress = 0;
        //     let totalTargets = 0;

        //     partners.forEach((partner) => {
        //         partner.kpis.forEach((kpi) => {
        //             kpi.kpi_metrics.forEach((kpiMetric) => {
        //                 kpiMetric.kpi_metric_members.forEach((member) => {
        //                     member.progress.forEach((progress) => {
        //                         totalProgress += progress.current_value;
        //                         totalTargets += progress.target_value;
        //                     });
        //                 });
        //             });
        //         });
        //     });

        //     if (totalTargets === 0) {
        //         return 0;
        //     }

        //     return (totalProgress / totalTargets) * 100;
        // },

        getStatusClass(partner) {
            console.log("Who is this partner:", partner);
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

        calculateCurrentSum(kpiMetric) {
            let currentSum = 0;

            if (kpiMetric && kpiMetric.kpi_metric_members) {
                kpiMetric.kpi_metric_members.forEach((kpiMetricMember) => {
                    if (kpiMetricMember && kpiMetricMember.progress) {
                        kpiMetricMember.progress.forEach((progressEntry) => {
                            // Accumulate the current_value for each progress entry
                            currentSum += progressEntry.current_value;
                        });
                    }
                });
            }

            return currentSum;
        },

        // calculateCurrentSum(kpiMetric) {
        //     let currentSum = 0;
        //     kpiMetric.kpi_metric_members.forEach((kpiMetricMember) => {
        //         kpiMetricMember.progress.forEach((progressEntry) => {
        //             currentSum += progressEntry.current_value;
        //         });
        //     });
        //     return currentSum;
        // },

        calculateTargetSum(kpiMetric) {
            let targetSum = 0;

            if (kpiMetric && kpiMetric.kpi_metric_members) {
                kpiMetric.kpi_metric_members.forEach((kpiMetricMember) => {
                    if (kpiMetricMember && kpiMetricMember.progress) {
                        kpiMetricMember.progress.forEach((progressEntry) => {
                            // Accumulate the target_value for each progress entry
                            targetSum += progressEntry.target_value;
                        });
                    }
                });
            }

            return targetSum;
        },

        calculateMetricProgress(kpi_metrics) {
            let totalCurrentValue = 0;
            let totalTargetValue = 0;

            //  console.log("Total Current value is:",totalCurrentValue);
            // console.log("Total Target value is:",totalTargetValue);

            kpi_metrics.forEach((kpiMetric) => {
                kpiMetric.kpi_metric_members.forEach((member) => {
                    member.progress.forEach((progress) => {
                        totalCurrentValue += progress.current_value;
                        totalTargetValue += progress.target_value;
                    });
                });
            });

            console.log("Total Current value is:", totalCurrentValue);
            console.log("Total Target value is:", totalTargetValue);

            if (totalTargetValue === 0) {
                return 0;
            }

            return (totalCurrentValue / totalTargetValue) * 100;
        },

        calculateTotalCurrentValueforMetric(metricCurrentTotal) {
            let totalCurrentValue = 0;

            metricCurrentTotal.forEach((kpiMetric) => {
                kpiMetric.kpi_metric_members.forEach((member) => {
                    member.progress.forEach((progress) => {
                        totalCurrentValue += progress.current_value;
                    });
                });
            });
            return totalCurrentValue;
        },

        calculateTotalTargetValueforMetric(metricTargetTotal) {
            let totalTargetValue = 0;

            metricTargetTotal.forEach((kpiMetric) => {
                kpiMetric.kpi_metric_members.forEach((member) => {
                    member.progress.forEach((progress) => {
                        totalTargetValue += progress.target_value;
                    });
                });
            });
            return totalTargetValue;
        },

        // getTopDrivers(topdriver) {
        //     let topDriver = null;
        //     let highestValue = -Infinity;

        //     topdriver.forEach((kpiMetric) => {
        //         kpiMetric.kpi_metric_members.forEach((member) => {
        //             member.progress.forEach((progress) => {
        //                 if (progress.current_value > highestValue) {
        //                     highestValue = progress.current_value;
        //                     topDriver = member;
        //                 }
        //             });
        //         });
        //     });

        //     if (topDriver !== null) {
        //         return topDriver.member.name; // Assuming member has a "name" property
        //     } else {
        //         return "N/A"; // No members found
        //     }
        // },

        // calculateTargetSum(kpiMetric) {
        //     let targetSum = 0;
        //     kpiMetric.kpi_metric_members.forEach((kpiMetricMember) => {
        //         kpiMetricMember.progress.forEach((progressEntry) => {
        //             targetSum += progressEntry.target_value;
        //         });
        //     });
        //     return targetSum;
        // },
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

        async fetchKpiMetrics() {
            try {
                const kpiMetricsDetails = [];

                // Iterate through each KPI of the partner
                for (const partner of this.partners) {
                    // Iterate through each kpi_metric of the KPI
                    for (const kpi of partner.kpis) {
                        for (const kpiMetric of kpi.kpi_metrics) {
                            const metricId = kpiMetric.metric_id;

                            const uri =
                                this.base_url +
                                `api/v1/kpi-metrics/${metricId}`;

                            // Make an API request for each KPI Metric
                            const response = await axios.get(uri);

                            // Handle the response data as needed
                            console.log(
                                "API Response for KPI Metric:",
                                response.data
                            );

                            // Push the KPI Metric data into the array
                            kpiMetricsDetails.push(response.data);
                        }
                    }
                }

                // Store or process the KPI Metrics data as needed
                this.kpiMetricsDetails = kpiMetricsDetails;
            } catch (error) {
                console.error("Error fetching KPI Metrics:", error);
            }
        },

        closeAccount() {
            let uri =
                this.base_url +
                `api/v1/department-delete/${this.department.id}`;
            axios
                .delete(uri)
                .then((response) => {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Department account Closed successfully!",
                    }).then(() => {
                        window.location.href = "/departments/";
                    });
                })
                .catch((error) => {
                    // Handle errors from the server or API request
                    console.error("Error closing Department account:", error);
                    // You may want to show an error message to the user here
                });
        },

        // addMemberToList() {
        //     const email = this.member.email.trim();
        //     if (email !== "" && !this.selectedMembers.includes(email)) {
        //         this.selectedMembers.push(email);
        //         this.member.email = "";
        //     }
        // },
        // removeMemberFromList(index) {
        //     this.selectedMembers.splice(index, 1);
        // },

        departmentSubmit() {
            // Create a departmentData object with the department properties and selected members
            const departmentData = {
                id: this.department.id,
                name: this.department.name,
                email: this.department.email,
                about: this.department.about,
                members: this.selectedMembers,
            };

            // Define the URI for the PATCH request
            let uri = `${this.base_url}api/v1/department-update/${this.department.id}`;

            // Make the PATCH request to update the department
            axios
                .patch(uri, departmentData)
                .then((response) => {
                    // Handle the successful response
                    const updatedPartner = response.data;
                    this.partner = updatedPartner;
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Department Updated successfully!",
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch((error) => {
                    // Handle errors from the server or API request
                    console.error("Error updating department:", error);
                    // You may want to show an error message to the user here
                });
        },

        fetchDepartmentMembers() {
            // Build the URI
            const uri = `${this.base_url}api/v1/department-members/${this.department.id}`;

            // Make an API request to fetch existing department members from the server
            axios
                .get(uri)
                .then((response) => {
                    console.log("Member Response is:", response.data);
                    this.departmentMembers = response.data;
                    console.log("Is active Members:", this.departmentMembers); // Move the log here
                })
                .catch((error) => {
                    console.error("Error fetching department members:", error);
                });
        },

        addMemberToList() {
            const email = this.member.email.trim();
            if (
                email !== "" &&
                !this.departmentMembers.some((member) => member.email === email)
            ) {
                // Check if the email is not already in the department members list
                // Also want to check if the email is in the 'members' list
                // before adding it to 'departmentMembers'
                this.departmentMembers.push({
                    email: email,
                    id: null, // Replace with the actual ID if available
                });
                this.member.email = ""; // Clear the input field
            }
        },
        removeMemberFromList(memberId) {
            // Find the member in the departmentMembers list by their ID
            const memberIndex = this.departmentMembers.findIndex(
                (member) => member.id === memberId
            );

            if (memberIndex !== -1) {
                const member = this.departmentMembers[memberIndex];

                // Check if the member has progress records
                axios
                    .get(
                        `${this.base_url}api/v1/member-progress-records/${member.id}`
                    )
                    .then((response) => {
                        const hasProgressRecords =
                            response.data.hasProgressRecords;

                        if (hasProgressRecords) {
                            // Member has progress records, deactivate them
                            member.is_active = false;
                        } else {
                            // Member has no progress records, remove them from the list
                            this.departmentMembers.splice(memberIndex, 1);

                            // Also, make an API call to remove the member from the backend
                            axios
                                .delete(
                                    `${this.base_url}api/v1/remove-member/${member.id}`
                                )
                                .then(() => {
                                    console.log("Member removed from backend");
                                })
                                .catch((error) => {
                                    console.error(
                                        "Error removing member from backend:",
                                        error
                                    );
                                });
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error checking progress records:",
                            error
                        );
                    });
            }
        },

        //  removeMemberFromList(memberId) {
        //   const index = this.departmentMembers.findIndex((member) => member.id === memberId);
        //   if (index !== -1) {
        //     this.departmentMembers.splice(index, 1);
        //   }
        // },
        // getStatusClass1(partner) {
        //     const progressKpiMetricPercentage = parseFloat(
        //         partner.calculatedKpiMetricProgress
        //     );

        //     for (const kpi of partner.kpis) {
        //         for (const kpiMetric of kpi.kpi_metrics) {
        //             const onTrackValue = parseFloat(kpiMetric.on_track_value);
        //             const atRiskMin = parseFloat(kpiMetric.at_risk_min);

        //             if (progressKpiMetricPercentage >= onTrackValue) {
        //                 return "on-track";
        //             } else if (progressKpiMetricPercentage >= atRiskMin) {
        //                 return "at-risk";
        //             }
        //         }
        //     }

        //     return "off-track";
        // },

        // getKpiMetricTitles(partner) {
        //     const kpiTitles = partner.kpis.flatMap((kpi) =>
        //         kpi.kpi_metrics.map((metric) => metric.title)
        //     );
        //     return kpiTitles || []; // Return an array of titles or an empty array
        // },

        // getCurrentValuesForKpiMetrics(partner) {
        //     const currentValues = partner.kpis.flatMap((kpi) =>
        //         kpi.kpi_metrics.flatMap((metric) =>
        //             metric.kpi_metric_members.flatMap((member) =>
        //                 member.progress.map((entry) => entry.current_value)
        //             )
        //         )
        //     );
        //     return currentValues || []; // Return an array of current values or an empty array
        // },

        // getTargetValuesForKpiMetrics(partner) {
        //     const targetValues = partner.kpis.flatMap((kpi) =>
        //         kpi.kpi_metrics.map((metric) => metric.timely_value)
        //     );
        //     return targetValues || []; // Return an array of target values or an empty array
        // },
    },
};
</script>

<style scoped>
.encircle {
    padding: 3px;
    border-radius: 50%;
    background-color: rgba(128, 128, 128, 0.089);
    color: rgba(24, 23, 23, 0.911);
}

.btn-icon {
    display: flex;
    align-items: center;
    font-weight: bold;
}

h3 {
    font-weight: bold;
}

.nav-link.active {
    border-bottom: 2px solid blue; /* Add an underline to the active tab */
    /* You can also change the background color or any other styles to indicate the active tab */
}

nav-link {
    font-size: 14px;
    font-weight: 600;
}

.btn-action {
    padding: 2px 5px; /* Adjust the padding as needed */
    line-height: 0.2; /* Set line-height to 1 to remove any extra spacing */
}

.cancel-btn:hover {
    /* Set any hover styles to 'initial' or 'none' to remove the effect */
    background-color: initial;
    color: initial;
    border-color: initial;
    border: 1px solid grey;
    border: 1px solid rgba(0, 0, 0, 0.5); /* Adjust the opacity (last value) as needed */

    /* Add any other styles you want to reset on hover */
}

.text-gray {
    font-size: 20px;
}

.status span {
    background-color: rgba(51, 255, 0, 0.164);
    padding: 8px;
    border-radius: 15px;
}

.on-track {
    background-color: #5cb85c;
}

.at-risk {
    background-color: #f0ad4e;
}

.off-track {
    background-color: #d9534f;
}
</style>
