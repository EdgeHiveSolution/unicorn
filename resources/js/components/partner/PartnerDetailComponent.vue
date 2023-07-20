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
                                <span class="member-count">{{members.length }}</span>
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

                <div class="progress-chart card"></div>
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
                                                class="input-field"
                                                type="text"
                                                placeholder="Search KPI metrics"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-light p-3">
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
                                                    v-for="partner in partners"
                                                    :key="partner.id"
                                                >
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <img
                                                                :src="
                                                                    partner.logo
                                                                "
                                                                alt="logo"
                                                            />
                                                            <span
                                                                class="pl-2"
                                                                >{{
                                                                    partner.name
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <span
                                                                class="active-period txt-gray"
                                                                >Active Period:
                                                                {{
                                                                    "8 months ago"
                                                                }}</span
                                                            >
                                                        </div>
                                                    </td>
                                                    <td class="stats">
                                                        <span>{{ "48%" }}</span>
                                                        <div class="progress">
                                                            <div
                                                                class="progress-bar bg-primary"
                                                                role="progressbar"
                                                                :style="{
                                                                    width: '48%',
                                                                }"
                                                                aria-valuenow="5"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100"
                                                            ></div>
                                                        </div>
                                                    </td>
                                                    <td class="td-members">
                                                        <img
                                                            v-for="member in partner.members"
                                                            :key="member.id"
                                                            src="member.image"
                                                            alt="image"
                                                        />
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="department-tag"
                                                            v-for="department in partner.departments"
                                                            :key="department.id"
                                                            >{{
                                                                department.name
                                                            }}</span
                                                        >
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-pri px-1 py-1 d-flex align-items-center"
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
                        </div>
                    </div>
                </div>

                <div class="my-5">
                    <h4>KPI Burndown</h4>
                    <p>A breakdown of each KPI's performance.</p>
                    <div class="row">
                        <div class="col-12 px-0">
                            <div>
                                <h4>{{ "Hardware sales" }}</h4>
                                <p>
                                    Review period {{ "1st June 2021" }} to
                                    {{ "21st Dec 2021" }}
                                </p>
                            </div>
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
                                                class="input-field"
                                                type="text"
                                                placeholder="Search KPI metrics"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-light p-3">
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
                                                    v-for="partner in partners"
                                                    :key="partner.id"
                                                >
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <img
                                                                :src="
                                                                    partner.logo
                                                                "
                                                                alt="logo"
                                                            />
                                                            <span
                                                                class="pl-2"
                                                                >{{
                                                                    partner.name
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <span
                                                                class="active-period txt-gray"
                                                                >Active Period:
                                                                {{
                                                                    "8 months ago"
                                                                }}</span
                                                            >
                                                        </div>
                                                    </td>
                                                    <td class="stats">
                                                        <span>{{ "48%" }}</span>
                                                        <div class="progress">
                                                            <div
                                                                class="progress-bar bg-primary"
                                                                role="progressbar"
                                                                :style="{
                                                                    width: '48%',
                                                                }"
                                                                aria-valuenow="5"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100"
                                                            ></div>
                                                        </div>
                                                    </td>
                                                    <td class="td-members">
                                                        <img
                                                            v-for="member in partner.members"
                                                            :key="member.id"
                                                            src="member.image"
                                                            alt="image"
                                                        />
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="department-tag"
                                                            v-for="department in partner.departments"
                                                            :key="department.id"
                                                            >{{
                                                                department.name
                                                            }}</span
                                                        >
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-pri px-1 py-1 d-flex align-items-center"
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
                        </div>
                    </div>
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
                                                class="input-field"
                                                type="text"
                                                placeholder="Search KPI metrics"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-light p-3">
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
                                                    v-for="partner in partners"
                                                    :key="partner.id"
                                                >
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <img
                                                                :src="
                                                                    partner.logo
                                                                "
                                                                alt="logo"
                                                            />
                                                            <span
                                                                class="pl-2"
                                                                >{{
                                                                    partner.name
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div
                                                            class="d-flex align-items-center"
                                                        >
                                                            <span
                                                                class="active-period txt-gray"
                                                                >Active Period:
                                                                {{
                                                                    "8 months ago"
                                                                }}</span
                                                            >
                                                        </div>
                                                    </td>
                                                    <td class="stats">
                                                        <span>{{ "48%" }}</span>
                                                        <div class="progress">
                                                            <div
                                                                class="progress-bar bg-primary"
                                                                role="progressbar"
                                                                :style="{
                                                                    width: '48%',
                                                                }"
                                                                aria-valuenow="5"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100"
                                                            ></div>
                                                        </div>
                                                    </td>
                                                    <td class="td-members">
                                                        <img
                                                            v-for="member in partner.members"
                                                            :key="member.id"
                                                            src="member.image"
                                                            alt="image"
                                                        />
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="department-tag"
                                                            v-for="department in partner.departments"
                                                            :key="department.id"
                                                            >{{
                                                                department.name
                                                            }}</span
                                                        >
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-pri px-1 py-1 d-flex align-items-center"
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
                        @submit.prevent="formSubmit"
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
                                            v-model="formData.member_email"
                                        />
                                    </div>
                                    <div class="col-md-3">
                                        <select
                                            id="department_id"
                                            class="form-control"
                                            name="department"
                                            v-model="formData.department_id"
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
                                            v-model="formData.role"
                                        >
                                            <option value="">
                                                Select role
                                            </option>
                                            <option value="leader">
                                                Software
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

                                <!-- Display selected items -->
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
                                                {{ item.departmentName }}
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
                                    <button class="btn btn-light border">
                                        Deactivate account
                                    </button>
                                   </div>

                                    <div class="mt-3">
                                        <button class="btn btn-danger">
                                        Close account
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

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
        <p>All members assigned to this partner </p>
    </div>

    <div class="row">
        <div class="col-12 px-0">
            <div class="card">
                <div class="card-header d-flex justify-content-between my-3">
                    <div>
                        <div class="input-container">
                            <i class="mdi mdi-magnify mdi-icon"></i>
                            <input class="input-field" type="text" placeholder="Search members">
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
                                    <th>Member</th>
                                    <th>Status</th>
                                    <th>Departments</th>
                                    <th>Active KPIs progress</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="member in members">
                                    <td>
                                        {{member.email}}
                                    </td>
                                    <td class="status">
                                       <span>
                                        active
                                       </span>
                                    </td>
                                    <td>
                                     {{'Admin'}}
                                    </td>
                                    <td>
                                       {{ 3 }}
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-pri px-2 py-1 d-flex align-items-center"
                                            >
                                                <i
                                                    class="mdi mdi-eye-outline text-light"
                                                ></i>
                                                <a :href="'/members/' + member.id" class="text-light">View</a>
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
                <div class="btn btn-primary my-2">
                    <a href="#" class="text-light add-link" data-toggle="modal" data-target="#addKpimodal">
                        <span class="plus">+</span> Add KPI
                    </a>
                </div>

                <div class="row">
        <div class="col-12 px-0">
          <div class="card">
           <div class="d-flex justify-content-between p-4">
             <div>
                <h4>Hardware sales</h4>
                <p>Review period: {{ "1st August 2022 to 30th October 2022" }}</p>
             </div>
             <div>
                <button data-toggle="modal" data-target="#addKpiMetricModal" class="btn btn-light border">
                   + Add KPI metric
                </button>

             </div>
           </div>
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
                         <img :src="partner.logo" alt="logo" />
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
    <div class="modal fade p-5" id="addKpimodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content p-5">
        <p><i class="mdi mdi-image-filter-none h1"></i></p>
        <h3>Add Metric type</h3>
        <form @submit.prevent="submitKpi">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="col-form-label text-md-start">Kpi Title</label>
                <input id="name" name="name" placeholder="Enter name" class="form-control" type="text">
            </div>
            <div class="col-md-6">
            <label for="unit" class="col-form-label text-md-start">Owner</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="mdi mdi-image-filter-none"></i>
                </span>
                </div>
                <select name="unit" class="form-select">
                <option value="">Select or create standard unit</option>
                <option value="select">Create standard unit</option>
                <option value="count">Count</option>
                <option value="currency">Currency</option>
                <option value="time">Time</option>
                </select>
            </div>

            </div>
        </div>
        <div class="mb-3">
                <label for="name" class="col-form-label text-md-start">Kpi Review Period</label>
                <input id="name" name="name" placeholder="Enter name" class="form-control" type="date">
            </div>
        <div class="text-left">
            <button type="button" class="btn btn-light border-dark btn-action" data-dismiss="modal">Cancel</button>

            <button type="submit" class="btn btn-primary  btn-action">Add</button>
        </div>
        </form>
    </div>
    </div>
    </div>
    <div class="modal fade p-5" id="addKpiMetricModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content p-5">
        <p><i class="mdi mdi-image-filter-none h1"></i></p>
        <h3>Add KPI Metric type</h3>
        <p>Add a performance metric to the <b>{{ 'Hardware sales ' }} KPI</b></p>
        <form @submit.prevent="submitKpi">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="col-form-label text-md-start">Metric title</label>
                <input id="name" name="name" placeholder="Enter name" class="form-control" type="text">
            </div>
            <div class="col-md-6">
            <label for="unit" class="col-form-label text-md-start">Type</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="mdi mdi-image-filter-none"></i>
                </span>
                </div>
                <select name="unit" class="form-select">
                <option value="">Select or create standard unit</option>
                <option value="select">Create standard unit</option>
                <option value="count">Count</option>
                <option value="currency">Currency</option>
                <option value="time">Time</option>
                </select>
            </div>

            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="col-form-label text-md-start">Response Period</label>
            <input id="name" name="name" placeholder="Enter name" class="form-control" type="date">
        </div>
        <div class="row mb-3">
            <label for="name" class="col-form-label text-md-start">Assigned Members</label>
            <div class="col-md-6">

                <input id="name" name="name" placeholder="Enter name" class="form-control" type="text">
            </div>
            <div class="col-md-6">

            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="mdi mdi-image-filter-none"></i>
                </span>
                </div>
                <select name="unit" class="form-select">
                <option value="">Select or create standard unit</option>
                <option value="select">Create standard unit</option>
                <option value="count">Count</option>
                <option value="currency">Currency</option>
                <option value="time">Time</option>
                </select>
            </div>

            </div>
        </div>

            <label for="name" class="col-form-label text-md-start">Tracking criteria</label>
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
                    <td><input type="text" v-model="kpiMetric.onTrackValue" /></td>
                    </tr>
                    <tr>
                    <td>At Risk</td>
                    <td>
                        <input type="text" v-model="kpiMetric.atRiskMin" />
                        -
                        <input type="text" v-model="kpiMetric.atRiskMax" />
                    </td>
                    </tr>
                    <tr>
                    <td>Off Track</td>
                    <td>
                        <input type="text" v-model="kpiMetric.offTrackMin" />
                        -
                        <input type="text" v-model="kpiMetric.offTrackMax" />
                    </td>
                    </tr>
                </tbody>
            </table>


        <div class="text-left">
            <button type="button" class="btn btn-light border-dark btn-action" data-dismiss="modal">Cancel</button>

            <button type="submit" class="btn btn-primary  btn-action">Add</button>
        </div>
        </form>
    </div>
    </div>
    </div>
            </div>
        </div>
    </div>
</template>

<script>
import { format } from "date-fns";

export default {
    props: {
    partner: {
        type: Object,
        required: true
    },
    members: {
        type: Array,
        required: true
    }
    },

    data() {
        return {
            members: this.partner.members,
            success: "",
            searchQuery: "",
            currentPage: 1,
            base_url: "../",
            formattedDate: "",
            partner: {
                name: this.partner.name, // Replace with the actual value from the database
                email: this.partner.email,
                website: this.partner.website,
                logo: this.partner.logo,
                phone: this.partner.phone,
                address: this.partner.address,

                business_type: this.partner.business_type,
                about: this.partner.about,
            },
            kpiMetric: {
                onTrackValue: 0,
                atRiskMin: 10,
                atRiskMax: 45,
                offTrackMin: 10,
                offTrackMax: 45,

            },
            formData: {
                name: "",
                email: "",
                website: "",
                phone: "",
                address: "",
                logo: "",

                business_type: "",
                about: "",
                document_id: "",
                member_email: "",
                department_id: "",
                role: "",

                role_id: "",
            },
        };
    },
    mounted() {
        this.fetchCountries();
        this.formattedDate = format(
            new Date(this.partner.created_at),
            "'Date Joined: ' do MMMM yyyy"
        );
    },
    methods: {
        fetchCountries() {
            let uri = this.base_url + `api/v1/country-list`;
            axios.get(uri).then((response) => {
                this.countries = response.data;
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
.member-count{
    background-color: rgba(195, 195, 209, 0.733);
    padding: 7px;
    border-radius: 50%;
    font-size: .7rem;
}

.status span{
    background-color: rgba(51, 255, 0, 0.164);
    padding: 8px;
    border-radius: 15px;
}

</style>
