<template>
    <div>
        <div class="module-nav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/partners">Partners</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Partner Details
                    </li>
                </ol>
            </nav>
        </div>

        <div class="top-header">
            <h2>Partner Details</h2>
            <div>
                <nav class="navbar navbar-expand-lg navbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a
                                href="#progress"
                                class="nav-link"
                                :class="{ 'active-link': currentPage === 1 }"
                                @click="currentPage = 1"
                                >Progress</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                href="#account"
                                class="nav-link"
                                :class="{ 'active-link': currentPage === 2 }"
                                @click="currentPage = 2"
                                >Account</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                href="#members"
                                class="nav-link"
                                :class="{ 'active-link': currentPage === 3 }"
                                @click="currentPage = 3"
                            >
                                Members
                                <span class="encircle">{{
                                    members.length
                                }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="#kpis"
                                class="nav-link"
                                :class="{ 'active-link': currentPage === 4 }"
                                @click="currentPage = 4"
                                >KPIs</a
                            >
                        </li>
                    </ul>
                </nav>
                <hr class="pt-0" />
            </div>
        </div>

        <div class="body-items">
            <div id="progress" v-if="currentPage === 1">
                <!-- Progress content -->
                <div class="d-flex align-items-center">
                    <img :src="partner.logo" alt="logo" />
                    <span class="pl-2"
                        >{{ partner.name }} <br />
                        {{ formattedDate }}</span
                    >
                </div>

                <div class="col-xl-3 col-sm-6 grid-margin mt-4">
                    <div class="d-flex justify-content-between">
                        <div class="p-progress mr-3">
                            <h5>Progress</h5>
                            <p>{{ "48%" }}</p>
                        </div>
                        <div>
                            <div class="status">
                                <h6>{{ "Offtrack" }}</h6>
                            </div>
                        </div>
                    </div>

                    <p>Completion as at: {{ "18 August 2023" }}</p>
                </div>
                <div class="my-3">
                    <h4>Progress Burndown</h4>
                    <p>This show the progress to complete the KPIs</p>
                </div>
                <div class="card">
                    <div class="progress-chart card">char here</div>
                </div>
                <div class="my-5">
                    <h4>Metrics across portfolio</h4>

                    <div class="row">
                        <div class="col-12 px-0">
                            <div class="card">
                                <div
                                    class="card-header d-flex justify-content-between my-3"
                                >
                                    <div>
                                        <div class="input-container">
                                            <i
                                                class="mdi mdi-magnify mdi-icon"
                                            ></i>
                                            <input
                                                style="height: 10px"
                                                class="input-field"
                                                type="text"
                                                placeholder="Search KPI metrics"
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
                                                    <th>Value</th>
                                                    <th>Top drivers</th>
                                                    <th>Progress</th>
                                                    <th>Key departments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="metric in metrics"
                                                    :key="metric.id"
                                                >
                                                    <td>
                                                        {{ metric.name }}
                                                    </td>
                                                    <td class="stats">
                                                        {{ metric.name }}
                                                    </td>
                                                    <td class="td-members">
                                                        {{ metric.name }}
                                                    </td>
                                                    <td>
                                                        {{ metric.name }}
                                                    </td>
                                                    <td>
                                                        {{ metric.name }}
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

                <div class="my-5">
                    <h4>KPI Breakdown</h4>
                    <p>A breakdown of each KPI performance</p>

                    <div class="card" v-for="kpi in this.partner.kpis">
                        <div class="m-4 mb-0">
                            <h4>{{ kpi.title }}</h4>
                            <p>{{ kpi.review_period_range }}</p>
                            <p></p>
                        </div>
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
                                        placeholder="Search KPI metrics"
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
                                            <th>Assigned To</th>
                                            <th>Departments</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="kpiMetric in kpi.kpi_metrics"
                                            :key="kpiMetric.id"
                                        >
                                            <td>
                                                {{ kpiMetric.title }}
                                            </td>
                                            <td>
                                                {{
                                                    calculateCurrentSum(
                                                        kpiMetric
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                    calculateTargetSum(
                                                        kpiMetric
                                                    )
                                                }}
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

                                            <td class="td-members">
                                                <img
                                                    v-for="member in this
                                                        .partner.members"
                                                    :key="member.id"
                                                    src="assets/images/faces/face1.jpg"
                                                    alt="image"
                                                />
                                            </td>
                                            <td>
                                                <span
                                                    v-for="member in members"
                                                    :key="member.id"
                                                >
                                                    <span
                                                        class="depart-tag"
                                                        v-for="department in member.departments"
                                                        :key="department.id"
                                                    >
                                                        {{ department.name }}
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="account" v-if="currentPage === 2">
                <!-- Account content -->
                <div class="d-flex align-items-center">
                    <img :src="partner.logo" alt="logo" />
                    <div class="partner-info">
                        <h4>{{ partner.name }}</h4>
                        <p>
                            Status:
                            <span class="text-success">{{ " Active" }}</span>
                        </p>
                    </div>
                </div>
                <div
                    class="mt-5 d-flex justify-content-between align-items-end"
                >
                    <div class="p-info">
                        <h4>Partner info</h4>
                        <p>
                            Enter the photo and basic details of the partner
                            here
                        </p>
                    </div>

                    <div class="text-end">
                        <button
                            class="btn btn-light border-dark px-3 py-2 btn-action"
                        >
                            Cancel
                        </button>
                        <button
                            class="btn btn-primary px-3 py-2 btn-action"
                            form="form-submit"
                            type="submit"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
                <hr />
                <div class="form-container">
                    <form
                        id="form-submit"
                        class="row g-3"
                        @submit.prevent="partnerSubmit"
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
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    v-model="partner.name"
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
                                <div class="input-container">
                                    <!-- <span class="mdi mdi-email input-icon"></span> -->
                                    <input
                                        id="email"
                                        type="text"
                                        class="form-control"
                                        name="email"
                                        v-model="partner.email"
                                        autocomplete="email"
                                        autofocus
                                    />
                                </div>
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2 p-3">
                            <label
                                for="website"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "Website" }}</label
                            >

                            <div class="col-md-5 offset-md-0 text-center">
                                <input
                                    id="website"
                                    type="text"
                                    class="form-control"
                                    name="website"
                                    v-model="partner.website"
                                    autocomplete="website"
                                    autofocus
                                />
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2 p-3">
                            <label
                                for="phone"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "Phone Number" }}</label
                            >

                            <div class="col-md-5 offset-md-0 text-center">
                                <input
                                    id="phone"
                                    type="text"
                                    class="form-control"
                                    name="phone"
                                    v-model="partner.phone"
                                    autocomplete="phone"
                                    autofocus
                                />
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2 p-3">
                            <label
                                for="address"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "Address" }}</label
                            >

                            <div class="col-md-5 offset-md-0 text-center">
                                <input
                                    id="address"
                                    type="text"
                                    class="form-control"
                                    name="address"
                                    v-model="partner.address"
                                    autocomplete="address"
                                    autofocus
                                />
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2 p-3">
                            <label
                                for="logo"
                                class="col-md-3 col-form-label text-md-start"
                            >
                                {{ "Partner Logo" }} <br />
                                <span class="txt-gray">{{
                                    "This will be used to identify the partner"
                                }}</span>
                            </label>

                            <div class="col-md-5 offset-md-0 text-center">
                                <div class="row styled">
                                    <div class="col-3">
                                        <img :src="partner.logo" alt="." />
                                    </div>
                                    <div class="col-9">
                                        <input
                                            id="logo"
                                            type="file"
                                            class="form-control-file"
                                            name="logo"
                                            ref="logoInput"
                                            placeholder="text"
                                            @change="handleLogoChange"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2 p-3">
                            <label
                                for="business_type"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "Business type" }} <br /><span
                                    class="txt-gray"
                                >
                                    {{
                                        "Brief description of the main concern of the business e.g Software, Marketing"
                                    }}</span
                                >
                            </label>

                            <div class="col-md-5 offset-md-0 text-center">
                                <select
                                    id="business_type"
                                    class="form-control"
                                    name="business_type"
                                    v-model="partner.business_type"
                                >
                                    <option value="">Business type</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Consulting">
                                        Consulting
                                    </option>
                                    <!-- Add more business types as needed -->
                                </select>
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2 p-3 about">
                            <label
                                for="about"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "About" }} <br /><span class="txt-gray">
                                    {{
                                        "Write a short introduction of the business."
                                    }}</span
                                >
                            </label>

                            <div class="col-md-5 offset-md-0 text-center">
                                <textarea
                                    id="about"
                                    class="form-control"
                                    name="about"
                                    v-model="partner.about"
                                    autocomplete="about"
                                    autofocus
                                ></textarea>
                                <span
                                    v-if="true"
                                    class="text-count"
                                    :class="{ 'text-danger': isOverMax }"
                                    >{{
                                        remainingCharacters + " characters left"
                                    }}</span
                                >
                            </div>
                        </div>
                        <hr />
                        <div class="row mb-2 p-3">
                            <label
                                for="documents"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "Documents" }} <br /><span class="txt-gray">
                                    {{
                                        "Upload any relevant documents related to this business e.g KRA Pin, Company Profile e.t.c"
                                    }}</span
                                >
                            </label>

                            <div class="col-md-5 offset-md-0 text-center">
                                <div class="col-9 styled">
                                    <input
                                        id="documents"
                                        type="file"
                                        class="form-control-file"
                                        name="documents"
                                        ref="logoInput"
                                        placeholder="upload any relevant documents"
                                    />
                                </div>
                            </div>
                        </div>

                        <hr />

                        <div class="row mb-2">
                            <label
                                for="members"
                                class="col-md-3 col-form-label text-md-start"
                            >
                                {{ "Members" }} <br /><span class="txt-gray">
                                    {{
                                        "Invite or select the relevant members to this organisation."
                                    }}
                                </span>
                            </label>

                            <div class="col-md-9 offset-md-0 text-center">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input
                                            class="form-control py-2 pr-5"
                                            autocomplete="member_email"
                                            autofocus
                                            type="email"
                                            placeholder="Enter email address"
                                            name="member_email"
                                            v-model="member.email"
                                        />
                                    </div>
                                    <div class="col-md-3">
                                        <select
                                            id="department_id"
                                            class="form-control"
                                            name="department"
                                            v-model="member.department_id"
                                        >
                                            <option value="">
                                                Select department
                                                <i class="mdi mdi-account"></i>
                                            </option>
                                            <option
                                                v-for="department in departments"
                                                :value="department.id"
                                            >
                                                {{ department.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select
                                            id="role_id"
                                            class="form-control"
                                            name="role"
                                            v-model="member.role"
                                        >
                                            <option value="">
                                                Select role
                                            </option>
                                            <option value="leader">
                                                leader
                                            </option>
                                            <option value="mentor">
                                                Mentor
                                            </option>
                                            <option value="advisor">
                                                Advisor
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button
                                            type="button"
                                            class="btn btn-warning ml-0 text-light mt-md-0 mt-2"
                                            @click.prevent="addToList"
                                        >
                                            Add
                                        </button>
                                    </div>
                                </div>

                                <ul>
                                    <li
                                        v-for="(item, index) in selectedItems"
                                        class="list-item"
                                    >
                                        <span>
                                            <i
                                                class="mdi mdi-email-outline"
                                            ></i>
                                            {{ item.memberEmail }}
                                            <span class="btn-suc">
                                                {{
                                                    item.departmentId
                                                        ? getDepartmentName(
                                                              item.departmentId
                                                          )
                                                        : ""
                                                }}
                                            </span>
                                            <span class="btn-suc">{{
                                                item.roleName
                                            }}</span>
                                        </span>
                                        <i
                                            class="mdi mdi-delete delete-icon"
                                            @click="removeFromList(index)"
                                        ></i>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <hr />
                        <div class="row mb-2 p-3">
                            <label
                                for="documents"
                                class="col-md-3 col-form-label text-md-start"
                                >{{ "Account status" }}
                            </label>

                            <div class="col-md-5 offset-md-0 text-left">
                                <div class="col-9 styled">
                                    <div class="">
                                        <button
                                            type="button"
                                            class="btn btn-light border"
                                            @click="deactivateAccount"
                                        >
                                            Deactivate account
                                        </button>
                                    </div>

                                    <div class="mt-3">
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            @click="closeAccount"
                                        >
                                            Close account
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

                        <div class="align-right mb-5">
                            <div class="text-right mt-3 mb-5">
                                <button
                                    class="btn btn-light border-dark btn-action"
                                >
                                    Cancel
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-action"
                                >
                                    Save changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr />
            </div>
            <div id="members" v-if="currentPage === 3">
                <!-- Members content -->
                <div class="d-flex align-items-center">
                    <img :src="partner.logo" alt="logo" />
                    <div class="partner-info">
                        <h4>{{ partner.name }}</h4>
                        <p>
                            Status:
                            <span class="text-success">{{ " Active" }}</span>
                        </p>
                    </div>
                </div>
                <div class="m-info mt-5">
                    <h4>Members</h4>
                    <p>All members assigned to this partner</p>
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
                                            style="height: 10px"
                                            class="input-field"
                                            type="text"
                                            placeholder="Search members"
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
                                                <th>Member</th>
                                                <th>Status</th>
                                                <th>Departments</th>
                                                <th>Active KPIs progress</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="member in members"
                                                :key="member.id"
                                            >
                                                <td>
                                                    {{ member.email }}
                                                </td>
                                                <td class="status">
                                                    <span>
                                                        {{
                                                            (member.is_active =
                                                                "Active")
                                                        }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="department-tag"
                                                        v-for="department in member.departments"
                                                        :key="department.id"
                                                        >{{
                                                            department.name
                                                        }}</span
                                                    >
                                                </td>
                                                <td>
                                                    {{
                                                        calculateActiveKpiProgress(
                                                            member.kpi_metric_members
                                                        )
                                                    }}%
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
                                                                '/members/' +
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

            <div id="kpis" v-if="currentPage === 4">
                <!-- KPIs content -->
                <div class="d-flex align-items-center">
                    <img :src="partner.logo" alt="logo" />
                    <div class="partner-info">
                        <h4>{{ partner.name }}</h4>
                        <p>
                            Status:
                            <span class="text-success">{{ " Active" }}</span>
                        </p>
                    </div>
                </div>

                <div class="m-info mt-3">
                    <h4>KPIs</h4>
                    <p>Key milestones for {{ partner.name }}</p>
                </div>
                <div class="btn btn-primary btn-sm my-2">
                    <a
                        href="#"
                        class="text-light add-link text-sm"
                        data-toggle="modal"
                        data-target="#addKpimodal"
                    >
                        <span class="plus">+</span> Add KPI
                    </a>
                </div>

                <div class="row">
                    <div v-if="loggedUser.user_role_id === 1">
                        <div
                            class="col-12 px-0"
                            v-for="kpi in kpis"
                            :key="kpi.id"
                        >
                            <div class="card mb-5">
                                <div class="d-flex justify-content-between p-4">
                                    <div>
                                        <h4>{{ kpi.title }}</h4>
                                        <p>
                                            <b> Review period: </b>
                                            <span class="txt-gray">
                                                {{
                                                    kpi.review_period_range
                                                }}</span
                                            >
                                        </p>
                                    </div>
                                    <div>
                                        <button
                                            @click="openAddKpiMetricModal(kpi)"
                                            data-toggle="modal"
                                            class="btn btn-light border"
                                        >
                                            + Add KPI metric
                                        </button>
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
                                                placeholder="Search for metrics"
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
                                                    <th>KPI metric</th>
                                                    <th>Target</th>
                                                    <th>Response period</th>
                                                    <th>Assigned to</th>
                                                    <th>Departments</th>
                                                    <!-- <th></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr
                                                v-for="kpi in partner.kpis"
                                                :key="kpi.id"

                                                 > -->
                                                <tr
                                                    v-for="kpimetric in kpi.kpi_metrics"
                                                    :key="kpimetric.id"
                                                >
                                                    <td>
                                                        <div>
                                                            <span>
                                                                {{
                                                                    kpimetric.title
                                                                }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div>
                                                            {{
                                                                kpimetric.timely_vale
                                                            }}
                                                            <!-- Display KPI target, assuming target is a property of the KPI -->
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div>
                                                            {{
                                                                kpimetric.response_period
                                                            }}
                                                            <!-- Display KPI response_period -->
                                                        </div>
                                                    </td>

                                                    <td class="td-members">
                                                        <img
                                                            v-for="member in partner.members"
                                                            :key="member.id"
                                                            :src="member.photo"
                                                            :alt="member.email"
                                                        />
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="department-tag"
                                                            v-for="department in partner.departments"
                                                            :key="department.id"
                                                        >
                                                            {{
                                                                department.name
                                                            }}
                                                        </span>
                                                    </td>

                                                    <!-- <td>
                                                    <button
                                                        class="btn view-btn"
                                                    >
                                                        <a
                                                            :href="
                                                                '/kpimetrics/' +
                                                                kpimetric.id
                                                            "
                                                            class="text-light add-link text-sm"
                                                        >
                                                            <i
                                                                class="mdi mdi-eye-outline text-light"
                                                            ></i>
                                                            Activity</a
                                                        >
                                                    </button>
                                                </td> -->
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

                    <div v-else-if="loggedUser.user_role_id === 2">
                        <div
                            class="col-12 px-0"
                            v-for="kpi in kpis"
                            :key="kpi.id"
                        >
                            <div class="card mb-5">
                                <div class="d-flex justify-content-between p-4">
                                    <div>
                                        <h4>{{ kpi.title }}</h4>
                                        <p>
                                            <b> Review period: </b>
                                            <span class="txt-gray">
                                                {{
                                                    kpi.review_period_range
                                                }}</span
                                            >
                                        </p>
                                    </div>
                                    <div>
                                        <button
                                            @click="openAddKpiMetricModal(kpi)"
                                            data-toggle="modal"
                                            class="btn btn-light border"
                                        >
                                            + Add KPI metric
                                        </button>
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
                                                placeholder="Search for metrics"
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
                                                    <th>KPI metric</th>
                                                    <th>Target</th>
                                                    <th>Response period</th>
                                                    <!-- <th>Assigned to</th>
                                                    <th>Departments</th> -->
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr
                                                v-for="kpi in partner.kpis"
                                                :key="kpi.id"

                                                 > -->
                                                <tr
                                                    v-for="kpimetric in kpi.kpi_metrics"
                                                    :key="kpimetric.id"
                                                >
                                                    <td>
                                                        <div>
                                                            <span>
                                                                {{
                                                                    kpimetric.title
                                                                }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div>
                                                            {{
                                                                kpimetric.target
                                                            }}
                                                            <!-- Display KPI target, assuming target is a property of the KPI -->
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div>
                                                            {{
                                                                kpimetric.response_period
                                                            }}
                                                            <!-- Display KPI response_period -->
                                                        </div>
                                                    </td>

                                                    <!-- <td class="td-members">
                                                        <img
                                                            v-for="member in partner.members"
                                                            :key="member.id"
                                                            :src="member.photo"
                                                            :alt="member.email"
                                                        />
                                                    </td> -->

                                                    <!-- <td>
                                                        <span
                                                            class="department-tag"
                                                            v-for="department in partner.departments"
                                                            :key="department.id"
                                                        >
                                                            {{
                                                                department.name
                                                            }}
                                                        </span>
                                                    </td> -->

                                                    <td>
                                                        <button
                                                            class="btn view-btn"
                                                        >
                                                            <a
                                                                :href="
                                                                    '/kpimetrics/' +
                                                                    kpimetric.id
                                                                "
                                                                class="text-light add-link text-sm"
                                                            >
                                                                <i
                                                                    class="mdi mdi-eye-outline text-light"
                                                                ></i>
                                                                Activity</a
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

                    <div v-else>
                        <p>No Kpis</p>
                    </div>
                </div>

                <div
                    class="modal fade p-5"
                    id="addKpiMetricModal"
                    tabindex="-1"
                    role="dialog"
                >
                    <div
                        class="modal-dialog modal-dialog-centered modal-lg"
                        role="document"
                    >
                        <div class="modal-content p-5">
                            <p>
                                <i class="mdi mdi-image-filter-none h1"></i>
                            </p>
                            <h3>Add KPI Metric</h3>
                            <p>
                                Add a performance metric to the
                                <b>{{
                                    selectedKpi ? selectedKpi.title : ""
                                }}</b>
                                KPI
                            </p>
                            <form
                                @submit.prevent="submitKpiMetric"
                                method="POST"
                            >
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label
                                            for="name"
                                            class="col-form-label text-md-start"
                                            >Metric title</label
                                        >
                                        <input
                                            id="title"
                                            name="title"
                                            placeholder="Enter metric title"
                                            class="form-control"
                                            type="text"
                                            v-model="kpiMetric.title"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            for="type"
                                            class="col-form-label text-md-start"
                                            >Type
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i
                                                        class="mdi mdi-image-filter-none"
                                                    ></i>
                                                </span>
                                            </div>
                                            <select
                                                name="type"
                                                class="form-select"
                                                v-model="selectedType"
                                            >
                                                <!-- <select
                                                        name="type"
                                                        class="form-select"
                                                       
                                                       > -->
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                >
                                                    Select standard unit
                                                </option>

                                                <option
                                                    :value="metric.name"
                                                    v-for="metric in metrics"
                                                    :key="metric.id"
                                                >
                                                    {{ metric.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label
                                        for="response_period"
                                        class="col-form-label text-md-start"
                                        >Response Period:</label
                                    >
                                    <select
                                        name="response_period"
                                        class="form-select"
                                        v-model="kpiMetric.responsePeriod"
                                    >
                                        <!-- <select
                                                name="response_period"
                                                class="form-select"
                                               
                                            > -->
                                        <option value="" disabled selected>
                                            Select response period
                                        </option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">
                                            Quarterly
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label
                                        for="name"
                                        class="col-form-label text-md-start"
                                        >Assigned Members:</label
                                    >
                                    <div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <select
                                                    name="response_period"
                                                    class="form-select"
                                                    v-model="member.email"
                                                >
                                                    <option
                                                        value=""
                                                        disabled
                                                        selected
                                                    >
                                                        Enter name or email
                                                        address
                                                    </option>
                                                    <option
                                                        :value="member.email"
                                                        :key="member.id"
                                                        v-for="member in members"
                                                    >
                                                        {{ member.email }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <input
                                                    class="form-control py-2 pr-5"
                                                    autocomplete="member_target"
                                                    autofocus
                                                    type="number"
                                                    placeholder="Enter target"
                                                    name="target"
                                                    v-model="member.target"
                                                />
                                            </div>

                                            <div class="col-md-2">
                                                <button
                                                    type="button"
                                                    class="btn btn-warning ml-0 text-light mt-md-0 mt-2"
                                                    @click.prevent="
                                                        selectMember
                                                    "
                                                >
                                                    Add
                                                </button>
                                            </div>
                                        </div>

                                        <ul>
                                            <li
                                                v-for="(
                                                    item, index
                                                ) in selectedItems"
                                                class="list-item my-2"
                                            >
                                                <span>
                                                    <i
                                                        class="mdi mdi-email-outline"
                                                    ></i>
                                                    {{ item.memberEmail }}

                                                    <span class="btn-suc">{{
                                                        item.memberTarget
                                                    }}</span>
                                                </span>
                                                <i
                                                    class="mdi mdi-delete delete-icon"
                                                    @click="
                                                        removeFromList(index)
                                                    "
                                                ></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Tracking criteria</label
                                >
                                <table class="table border set-metric">
                                    <thead>
                                        <tr>
                                            <th>Performance flag</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>On Track</td>
                                            <td>
                                                <input
                                                    type="text"
                                                    v-model="
                                                        kpiMetric.onTrackValue
                                                    "
                                                />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>At Risk</td>
                                            <td>
                                                <input
                                                    type="text"
                                                    v-model="
                                                        kpiMetric.atRiskMin
                                                    "
                                                />
                                                -
                                                <input
                                                    type="text"
                                                    v-model="
                                                        kpiMetric.atRiskMax
                                                    "
                                                />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Off Track</td>
                                            <td>
                                                <input
                                                    type="text"
                                                    v-model="
                                                        kpiMetric.offTrackMin
                                                    "
                                                />
                                                -
                                                <input
                                                    type="text"
                                                    v-model="
                                                        kpiMetric.offTrackMax
                                                    "
                                                />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="text-left">
                                    <button
                                        type="button"
                                        class="btn btn-light border-dark btn-action"
                                        data-dismiss="modal"
                                    >
                                        Cancel
                                    </button>

                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-action"
                                    >
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="modal fade p-5"
                id="addKpimodal"
                tabindex="-1"
                role="dialog"
            >
                <div
                    class="modal-dialog modal-dialog-centered modal-lg"
                    role="document"
                >
                    <div class="modal-content p-5">
                        <p><i class="mdi mdi-image-filter-none h1"></i></p>
                        <h3>Add New KPI</h3>
                        <form
                            id="form-submit"
                            class="row g-3"
                            @submit.prevent="submitKpi"
                            method="POST"
                        >
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label
                                        for="name"
                                        class="col-form-label text-md-start"
                                        >Kpi Title</label
                                    >
                                    <input
                                        id="name"
                                        name="name"
                                        placeholder="Enter KPI name"
                                        class="form-control"
                                        type="text"
                                        v-model="kpi_title"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <label
                                        for="unit"
                                        class="col-form-label text-md-start"
                                        >Owner</label
                                    >
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i
                                                    class="mdi mdi-image-filter-none"
                                                ></i>
                                            </span>
                                        </div>
                                        <select
                                            name="unit"
                                            class="form-select"
                                            v-model="kpi_owner"
                                        >
                                            <option value="">
                                                Select or KPI owner
                                            </option>
                                            <option
                                                v-for="member in members"
                                                :value="member.id"
                                                :key="member.id"
                                            >
                                                {{ member.email }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label
                                    for="review_date"
                                    class="col-form-label text-md-start"
                                    @click="showDateInputs"
                                >
                                    KPI Review period:
                                </label>
                                <div v-if="!showInputs">
                                    <!-- Show the initial input field that disappears when clicked -->
                                    <input
                                        class="form-control"
                                        type="date"
                                        @click="showDateInputs"
                                    />
                                </div>

                                <div v-if="showInputs">
                                    <div class="mb-3">
                                        <div v-if="showInputs" class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label
                                                        for="review_start_date"
                                                        class="col-form-label"
                                                        >Start Date</label
                                                    >
                                                    <input
                                                        id="review_start_date"
                                                        name="review_start_date"
                                                        class="form-control"
                                                        type="date"
                                                        v-model="
                                                            review_start_date
                                                        "
                                                        :min="getCurrentDate()"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label
                                                        for="review_end_date"
                                                        class="col-form-label"
                                                        >End Date</label
                                                    >
                                                    <input
                                                        id="review_end_date"
                                                        name="review_end_date"
                                                        class="form-control"
                                                        type="date"
                                                        v-model="
                                                            review_end_date
                                                        "
                                                        :min="review_start_date"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-left">
                                <button
                                    type="button"
                                    class="btn btn-light border-dark btn-action"
                                    data-dismiss="modal"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-action"
                                >
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div
                class="modal fade p-5"
                id="addKpimodal2"
                tabindex="-1"
                role="dialog"
            >
                <div
                    class="modal-dialog modal-dialog-centered modal-lg"
                    role="document"
                >
                    <div class="modal-content p-5">
                        <h3>Progress Update</h3>
                        <h4></h4>

                        <form
                            id="form-submit"
                            @submit.prevent="
                                submitProgress(
                                    selectedKpiMetric,
                                    selectedKpiMember
                                )
                            "
                            method="POST"
                        >
                            <div class="mb-3">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Title</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Progress Title"
                                    class="form-control"
                                    type="text"
                                    v-model="kpimetric_title"
                                />
                            </div>

                            <div class="mb-3">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Value</label
                                >
                                <input
                                    id="name"
                                    name="value"
                                    placeholder="KES 0"
                                    class="form-control"
                                    type="text"
                                    v-model="kpimetric_value"
                                />
                            </div>

                            <div class="mb-3">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Notes</label
                                >
                                <textarea
                                    id="name"
                                    name="notes"
                                    placeholder="Any extra notes about this update"
                                    class="form-control"
                                    v-model="kpimetric_notes"
                                    style="height: 100px"
                                ></textarea>
                            </div>

                            <div class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-light border-dark btn-action"
                                    data-dismiss="modal"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-action"
                                >
                                    Update
                                </button>
                            </div>
                        </form>
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
        partner: {
            type: Object,
            required: true,
        },

        members: {
            type: Array,
            required: true,
        },

        department: {
            type: Array,
            required: true,
        },

        kpis: {
            type: Array,
            required: true,
        },
        kpimetrics: {
            type: Array,
            required: true,
        },

        partnerId: {
            type: Number,
            required: true,
        },
    },

    data() {
        return {
            countries: [],
            metrics: [],
            members: this.partner.members,
            kpiMetrics: [],
            selectedKpiTitle: "",
            selectedMemberKpi: "",
            selectedKpi: null,
            timelyValue: null,
            selectedType: "",

            member: {
                email: "",
                target: "",
            },

            selectedKpiMetric: "",

            selectedItems: [],
            departments: [],

            selectedKpiMember: [],

            success: "",
            searchQuery: "",
            currentPage: 1,
            base_url: "../",
            formattedDate: "",
            partner: {
                name: this.partner.name,
                email: this.partner.email,
                website: this.partner.website,
                logo: this.partner.logo,
                phone: this.partner.phone,
                address: this.partner.address,

                business_type: this.partner.business_type,
                about: this.partner.about,
                kpis: this.partner.kpis,
                kpi_metrics: this.partner.kpis.kpi_metrics,
            },

            kpimetric_title: "",
            kpimetric_value: "",
            kpimetric_notes: "",

            kpiMetric: {
                title: "",
                type: "",
                target: "",
                responsePeriod: "",
                members: [],
                onTrackValue: 70,
                atRiskMin: 40,
                atRiskMax: 60,
                offTrackMin: 0,
                offTrackMax: 30,
            },
            formData: {
                name: "",
                email: "",
                website: "",
                phone: "",
                address: "",
                logo: "",
                target: "",

                business_type: "",
                about: "",
                document_id: "",
                member_email: "",
                department_id: "",
                role: "",

                role_id: "",
            },
            kpi_title: "",
            kpi_owner: "",
            showInputs: false,
            review_start_date: null,
            review_end_date: null,
        };
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        //   partnersWithProgress() {
        //     return this.kpis.map((partner) => ({
        //         ...partner,
        //         calculatedProgress: this.calculateKpiProgress(partner.kpi_metrics),

        //         statusClass: this.getStatusClass(partner),
        //     }));
        // },

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
        // partnersWithProgress() {
        //     const partner = this.partner;
        //     return {
        //         ...partner,
        //         calculatedProgress: this.calculateKpiProgress(partner.kpis),
        //         statusClass: this.getStatusClass(partner),
        //     };
        // },

        // userProgressItems() {
        //     console.log(
        //         "Items are:",
        //         this.loggedUser.member.kpi_metric_members
        //     );
        //     if (
        //         this.loggedUser &&
        //         this.loggedUser.member &&
        //         this.loggedUser.member.kpi_metric_members
        //     ) {
        //         return this.loggedUser.member.kpi_metric_members;
        //     }
        //     return [];
        // },
    },

    // watch: {
    //     metrics: {
    //         handler(newMetrics) {
    //             console.log("Metrics have changed:", newMetrics);
    //             // Now you can safely use newMetrics when it changes.
    //         },
    //         deep: true,
    //     },
    // },

    async created() {
        await this.fetchMetrics();
        await this.fetchCountries();

        this.formattedDate = format(
            new Date(this.partner.created_at),
            "'Date Joined: ' do MMMM yyyy"
        );
        console.log("Metrics are:", JSON.stringify(this.metrics));
        console.log("Partners prop:", this.partner);
        console.log("Kpi Metrics are:", JSON.stringify(this.partner.kpis));
        console.log("New Kpis are :", JSON.stringify(this.kpis));
        console.log(
            "User Related Data:",
            JSON.stringify(this.$store.state.loggedUser)
        );

        console.log("Members are:", JSON.stringify(this.members));
        console.log("Departments are:", JSON.stringify(this.department));

        // console.log("userProgressItems:", this.userProgressItems);

        //console.log("Kpi Metric Members:", JSON.stringify(this.partner.kpi_metrics));
    },

    //   async mounted() {

    //        await this.fetchMetrics();
    //        await  this.fetchCountries();

    //         this.formattedDate = format(
    //             new Date(this.partner.created_at),
    //             "'Date Joined: ' do MMMM yyyy"
    //         );
    //         console.log("Metrics are:", JSON.stringify(this.metrics));
    //         console.log("Partners prop:", this.partner);
    //         console.log("Kpi Metrics are:", JSON.stringify(this.partner.kpis));
    //         console.log("New Kpis are :", JSON.stringify(this.kpis));
    //         console.log(
    //             "User Related Data:",
    //             JSON.stringify(this.$store.state.loggedUser)
    //         );

    //         console.log("Members are:", JSON.stringify(this.members));
    //         console.log("Departments are:", JSON.stringify(this.department));

    //         // console.log("userProgressItems:", this.userProgressItems);

    //         //console.log("Kpi Metric Members:", JSON.stringify(this.partner.kpi_metrics));
    //     },

    methods: {
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
                targetSum += kpiMetricMember.timely_value;
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

        calculateActiveKpiProgress(kpiMetricMembers) {
            const sumCurrentValues = kpiMetricMembers.reduce(
                (sum, member) =>
                    sum +
                    member.progress.reduce(
                        (memberSum, progress) =>
                            memberSum + progress.current_value,
                        0
                    ),
                0
            );

            const sumTargets = kpiMetricMembers.reduce(
                (sum, member) =>
                    sum +
                    member.progress.reduce(
                        (memberSum, progress) =>
                            memberSum + progress.target_value,
                        0
                    ),
                0
            );

            if (sumTargets === 0) {
                return 0;
            }

            return ((sumCurrentValues / sumTargets) * 100).toFixed(2);
        },

        // getMember(partner) {
        //     const members = partner.members;

        //     return members[0] || null; // Get the first member or return null
        // },

        // calculateKpiProgress(kpi_metrics) {
        //     let totalCurrentValue = 0;
        //     let totalTargetValue = 0;

        //     kpi_metrics.forEach((kpiMetric) => {
        //         kpiMetric.kpi_metric_members.forEach((member) => {
        //             member.progress.forEach((progress) => {
        //                 totalCurrentValue += progress.current_value;
        //                 totalTargetValue += progress.target_value;
        //             });
        //         });
        //     });

        //     if (totalTargetValue === 0) {
        //         return 0;
        //     }

        //     return (totalCurrentValue / totalTargetValue) * 100;
        // },

        // getStatusClass(partner) {
        //     const progressPercentage = parseFloat(partner.calculatedProgress);

        //     for (const kpiMetric of partner.kpi_metrics) {
        //         const onTrackValue = parseFloat(kpiMetric.on_track_value);
        //         const atRiskMin = parseFloat(kpiMetric.at_risk_min);

        //         if (progressPercentage >= onTrackValue) {
        //             return "on-track";
        //         } else if (progressPercentage >= atRiskMin) {
        //             return "at-risk";
        //         }
        //     }

        //     return "off-track";
        // },

        // getKpiMetricTitle(partner) {
        //     const kpiMetric = partner.kpis.flatMap((kpi) =>
        //         kpi.kpi_metrics.map((metric) => metric.title)
        //     );
        //     return kpiMetric[0] || ""; // Get the first title or an empty string
        // },

        openAddKpiMetricModal(kpi) {
            this.selectedKpi = kpi;
            $("#addKpiMetricModal").modal("show");
        },
        showDateInputs() {
            this.showInputs = !this.showInputs;
        },
        async fetchCountries() {
            let uri = this.base_url + `api/v1/country-list`;
            await axios.get(uri).then((response) => {
                this.countries = response.data;
            });
        },
        async fetchMetrics() {
            let uri = this.base_url + `api/v1/metric-list`;
            await axios.get(uri).then((response) => {
                console.log("Metric Response is:", response.data);
                this.metrics = response.data;
            });
        },
        toggleDateInputs(kpiId) {
            this.showInputs[kpiId] = !this.showInputs[kpiId];
        },

        deactivateAccount() {
            this.partner.is_active = 0;

            this.partnerSubmit();
        },
        addToList() {
            const selectedMemberEmail = this.member.email;
            const selectedTarget = this.member.target;

            this.selectedItems.push({
                memberEmail: selectedMemberEmail,
                memberTarget: selectedTarget,
            });

            this.formData.members.push({
                email: selectedMemberEmail,
                department_id: selectedDepartment ? selectedDepartment.id : "",
                role: selectedRole,
            });

            this.member.email = "";
            this.member.department_id = "";
            this.member.role = "";
        },

        removeFromList(index) {
            this.selectedItems.splice(index, 1);
        },

        selectMember() {
            const selectedKpiMemberEmail = this.member.email;
            const selectedKpiTarget = this.member.target;

            this.selectedItems.push({
                memberEmail: selectedKpiMemberEmail,
                memberTarget: selectedKpiTarget,
            });

            this.member.email = "";
            this.member.department_id = "";
            this.member.role = "";
        },

        removeMember(index) {
            this.selectedItems.splice(index, 1);
        },

        closeAccount() {
            let uri =
                this.base_url + `api/v1/partner-delete/${this.partner.id}`;
            axios
                .delete(uri)
                .then((response) => {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Partner account Closed successfully!",
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch((error) => {
                    // Handle errors from the server or API request
                    console.error("Error closing partner account:", error);
                    // You may want to show an error message to the user here
                });
        },

        partnerSubmit() {
            const partnerData = {
                id: this.partner.id,
                name: this.partner.name,
                email: this.partner.email,
                website: this.partner.website,
                phone: this.partner.phone,
                address: this.partner.address,
                logo: this.partner.logo,
                business_type: this.partner.business_type,
                about: this.partner.about,
            };

            let uri = this.base_url + `api/v1/partner-update`;
            axios
                .patch(uri, partnerData)
                .then((response) => {
                    const updatedPartner = response.data;
                    this.partner = updatedPartner;
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Partner created successfully!",
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch((error) => {
                    console.error("Error updating partner:", error);
                });
        },

        submitKpi() {
            // Create a new FormData object
            const formData = new FormData();
            formData.append("title", this.kpi_title);
            formData.append("kpiOwner_id", this.kpi_owner);
            formData.append("review_start_date", this.review_start_date);
            formData.append("review_end_date", this.review_end_date);
            formData.append("partner_id", this.partner.id);

            // Make the POST request using Axios
            const uri = this.base_url + "api/v1/kpi-create";
            axios
                .post(uri, formData)
                .then((response) => {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Kpi created created successfully!",
                    }).then(() => {
                        this.kpi_title = "";
                        this.kpi_owner = "";
                        this.kpi_period = "";

                        window.location.reload();
                    });
                    // Clear the form fields after successful submission
                })
                .catch((error) => {
                    // Handle errors if the request fails
                    console.error("Error submitting the form:", error);
                });
        },

        submitKpiMetric() {
            const partner = this.partner;
            console.log("Target1 is :", this.formData.target);
            console.log("Target2 is :", this.member.target);
            console.log("Member is:", this.members);
            console.log("Email is:", this.member.email);
            // Create a new FormData object
            const membersWithTarget = this.members.map((member) => {
                // Clone the member object
                const modifiedMember = { ...member };
                // Attach the target property to the cloned member object
                modifiedMember.target = this.member.target;

                return modifiedMember;
            });

            console.log(
                "Members array is:" + JSON.stringify(membersWithTarget)
            );
            const formData = new FormData();
            formData.append("title", this.kpiMetric.title);
            const selectedMetric = this.metrics.find(
                (metric) => metric.name === this.selectedType
            );

            console.log("Selected Type is", selectedMetric);
            if (selectedMetric) {
                // Append the selected metric's name to the form data
                formData.append("type", selectedMetric.name);
            }
            // formData.append("target", this.member.target);
            formData.append("response_period", this.kpiMetric.responsePeriod);
            formData.append("partner_id", this.partner.id);
            formData.append("on_track_value", this.kpiMetric.onTrackValue);
            formData.append("off_track_min", this.kpiMetric.offTrackMin);
            formData.append("off_track_max", this.kpiMetric.offTrackMax);
            formData.append("at_risk_min", this.kpiMetric.atRiskMin);
            formData.append("at_risk_max", this.kpiMetric.atRiskMax);
            formData.append("kpi_id", this.selectedKpi.id);

            // formData.append("members", JSON.stringify(this.members));
            formData.append("members", JSON.stringify(membersWithTarget));

            // Make the POST request using Axios
            const uri = this.base_url + "api/v1/kpiMetric-create";
            const headers = { "Content-Type": "application/json" };
            axios
                .post(uri, formData, { headers })
                .then((response) => {
                    console.log(
                        "Response from server:" + JSON.stringify(response.data)
                    );

                    const updatedLoggedUser = {
                        ...this.$store.state.loggedUser,
                    };

                    if (updatedLoggedUser.member !== null) {
                        console.log(
                            "Updated User:" + JSON.stringify(updatedLoggedUser)
                        );

                        updatedLoggedUser.member.kpi_metric_members =
                            response.data.kpi_metric_members;
                        this.$store.dispatch(
                            "updateLoggedUser",
                            updatedLoggedUser
                        );
                    }

                    $("#addKpiMetricModal").modal("hide"); // show the modal
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Kpi Metric created successfully!",
                    }).then(() => {
                        this.kpi_title = "";
                        this.kpi_owner = "";
                        this.kpi_period = "";

                        window.location.href = "/partners/" + partner.id;
                    });
                })
                .catch((error) => {
                    // Handle errors if the request fails
                    console.error("Error submitting the form:", error);
                    console.log("Response:", error.response);
                });
        },

        getCurrentDate() {
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, "0");
            const day = String(currentDate.getDate()).padStart(2, "0");

            const formattedDate = `${year}-${month}-${day}`;
            return formattedDate;
        },

        sendInfo(kpimetric, kpiMember) {
            this.selectedKpiMetric = kpimetric;
            this.selectedKpiMember = kpiMember;
        },

        submitProgress(kpimetric1, kpi1) {
            const partner = this.partner;
            console.log("User Data:", JSON.stringify(store.state.loggedUser));

            console.log("kpimetrics:", this.partner.kpis[0].kpi_metrics);
            console.log("this.partner.kpis:", this.partner.kpis); // Log the entire kpis array
            // console.log("this.partner.kpis[0]:", this.partner.kpis[0]); // Log the first item in the kpis array
            console.log("ID is:", this.partner.kpis[0].kpi_metrics[0].id);
            console.log(
                "Timely Value:",
                this.partner.kpis[0].kpi_metrics[0].timely_value
            );

            let kpi_metric_member1 = this.partner.kpis
                .flatMap((kpi) => kpi.kpi_metrics)
                .flatMap((kpi_metric) => kpi_metric.kpi_metric_members)
                .find(
                    (element) =>
                        element.member_id === store.state.loggedUser.member.id
                );

            // let kpi_metric_member1 =
            //     this.kpis.kpi_metrics.kpi_metric_members.find(
            //         (element) => {
            //             return (
            //                 element.member_id ===
            //                 store.state.loggedUser.member.id
            //             );
            //         }
            //     );

            let kpi_metric_member_id1 = kpi_metric_member1.id;

            let timely_value1 = kpi_metric_member1.timely_value;

            console.log("Timely value:" + timely_value1);
            console.log("Kpi Metric Member:" + kpi_metric_member_id1);
            console.log("Kpi Metric 1:" + JSON.stringify(kpimetric1));
            console.log("Kpi 1:" + JSON.stringify(kpi1));

            console.log("User Data:", JSON.stringify(store.state.loggedUser));
            const formData = new FormData();
            formData.append("title", this.kpimetric_title);
            formData.append("value", this.kpimetric_value);
            formData.append("notes", this.kpimetric_notes);
            formData.append("kpi_metric_member_id", kpi_metric_member_id1);
            formData.append("timely_vale", timely_value1);
            formData.append("kpi_metric_id", kpimetric1.id);
            formData.append("kpi_id", kpi1.id); // Use kpimetric1.id
            // formData.append("target", kpimetric1.timely_value); // Use kpimetric1.timely_value

            // Make the POST request using Axios
            const uri = this.base_url + "api/v1/progress";
            axios
                .post(uri, formData)
                .then((response) => {
                    console.log(
                        "Response for Progress from server:",
                        response.data
                    );

                    // const updatedLoggedUser = {
                    //     ...this.$store.state.loggedUser,
                    // };
                    // updatedLoggedUser.member.kpi_metric_members.progress =
                    //     response.data.progress;
                    // this.$store.dispatch("updateLoggedUser", updatedLoggedUser);
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Progress updated successfully!",
                    }).then(() => {
                        this.kpimetric_title = "";
                        this.kpimetric_value = "";
                        this.kpimetric_notes = "";

                        window.location.reload();
                    });
                    // Clear the form fields after successful submission
                })
                .catch((error) => {
                    // Handle errors if the request fails
                    console.error("Error submitting the form:", error);
                });
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

.on-track {
    background-color: #5cb85c;
}

.at-risk {
    background-color: #f0ad4e;
}

.off-track {
    background-color: #d9534f;
}

select:required:invalid {
    color: gray;
}

option[value=""][disabled] {
    display: none;
}

option {
    color: black;
}
</style>
