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
                            <!--<a
                                href="#progress"
                                class="nav-link"
                                :class="{ 'active-link': currentPage === 1 }"
                                @click="currentPage = 1"
                                >Progress</a>-->

                                <a
                                href="#progress"
                                class="nav-link"
                                :class="{ 'active-link': currentPage === 1 }"
                                @click="handleLinkClick"
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
                            <p v-if="kpiPartnerProgress">
                                {{
                                    kpiPartnerProgress.progress_percentage.toFixed(
                                        2
                                    )
                                }}%
                            </p>
                            <p v-else>N/A</p>
                        </div>
                        <div>
                            <div class="status">
                                <h6 v-if="kpiPartnerProgress">
                                    {{ kpiPartnerProgress.status }}
                                </h6>
                                <h6 v-else>N/A</h6>
                            </div>
                        </div>
                    </div>

                    <p v-if="kpiPartnerProgress">
                        Completion as at: {{ kpiPartnerProgress.formattedDate }}
                    </p>
                    <p v-else>N/A</p>
                </div>
                <div class="my-3">
                    <h4>Progress Burndown</h4>
                    <p>This show the progress to complete KPIs</p>
                </div>
                <div class="card">
                    <div class="">
                        <p>Overall Kpi Progress</p>
                        <p>Review Period:</p>
                    </div>

                    <!--<div style="margin-top: -30px" class="d-flex justify-content-end mx-2">-->
                    <div
                        style="margin-top: -30px"
                        class="d-flex justify-content-end mx-2"
                    >
                        <span v-if="kpiPartnerProgress"
                        
                        :class="{
                         'on-track-header':
                            kpiPartnerProgress.status==='On Track',
                         'at-risk-header':
                          kpiPartnerProgress.status==='At Risk',
                         'off-track-header':
                         kpiPartnerProgress.status=== 'Off Track'    
                        }"
                        >
                            {{
                                kpiPartnerProgress.progress_percentage.toFixed(
                                    2
                                )
                            }}%
                        </span>
                        <p v-else></p>
                    </div>
                    <div
                        style="margin-top: -10px"
                        class="d-flex justify-content-end  mx-2 mt-2"
                        >
                        <span v-if="kpiPartnerProgress" 
                        :class="
                        {'on-track-header':
                            kpiPartnerProgress.status==='On Track',
                         'at-risk-header':
                          kpiPartnerProgress.status==='At Risk',
                         'off-track-header':
                         kpiPartnerProgress.status=== 'Off Track'}"
                        >
                            {{ kpiPartnerProgress.status }}
                        </span>
                        <p v-else></p>
                    </div>

                    <hr />

                    <div
                        id="chart-container"
                        style="width: 100%; height: 500px"
                    >
                        <canvas ref="chart"></canvas>
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
                                                style="height: 10px"
                                                class="input-field"
                                                type="text"
                                                placeholder="Search  metrics"
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
                                                    <th>Metric</th>
                                                    <th>Value</th>
                                                    <th>Top drivers</th>
                                                    <th>Progress</th>
                                                    <th>Key departments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="metric in metricWithProgress"
                                                    :key="metric.id"
                                                >
                                                    <td>
                                                        <div>
                                                            {{ metric.name }}
                                                        </div>
                                                        <div>
                                                            <span
                                                                class="txt-gray"
                                                                >Partners:
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="stats">
                                                        {{
                                                            metric.totalCurrentValue
                                                        }}
                                                    </td>
                                                    <td class="td-members"></td>
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
                                                    <td>{{}}</td>
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

                    <div class="card" v-for="kpi in this.partner.kpis" :key="kpi.id">
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
                                                <label class="active-period txt-gray">{{
                                                    calculateCurrentSum(
                                                        kpiMetric
                                                    ).toFixed(
                                                                2
                                                            )
                                                }}</label>
                                                    
                                            </td>
                                            <td>
                                               <label class="active-period txt-gray"> {{
                                                    calculateTargetSum(
                                                        kpiMetric
                                                    ).toFixed(
                                                                2
                                                            )
                                                }}</label>
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
                                                            :class="{
                                                                'progress-bar-on-track on-track-label':
                                                                calculateProgressStatus(
                                                        kpiMetric
                                                    )== 'On Track',
                                                    'progress-bar-at-risk at-risk-label' :
                                                    calculateProgressStatus(
                                                        kpiMetric
                                                    )=='At Risk',
                                                    'progress-bar-off-track off-track-label' :
                                                    calculateProgressStatus(
                                                        kpiMetric
                                                    ) =='Off Track'
                                                            }"
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
                                                <span
                                                :class="{
                                                    'on-track-label':
                                                    calculateProgressStatus(
                                                        kpiMetric
                                                    )== 'On Track',
                                                    'at-risk-label' :
                                                    calculateProgressStatus(
                                                        kpiMetric
                                                    )=='At Risk',
                                                    'off-track-label' :
                                                    calculateProgressStatus(
                                                        kpiMetric
                                                    ) =='Off Track'
                                                            }"
                                                >{{
                                                    calculateProgressStatus(
                                                        kpiMetric
                                                    )
                                                }}</span>
                                            </td>

                                            <td class="td-members">
                                                 <div class="d-flex flex-row">
                                               <!-- <div class="member_image_plus"
                                                v-for="member in partner.members"
                                                :key="member.id"
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+1</p>
                                                </div>-->
                                               
                                               <template v-for="(member,index) in this.partner.members"
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
                                        
                                                </div>

                                                 <div class="member_image_plus"
                                                 v-else
                                                :src="member.image"
                                                >
                                                <p class="member_image_text">+{{index - 1}}</p>
                                                </div>

                                        
                                                </template>

                                                
                                                </div>
                                                <!--<img
                                                    v-for="member in this
                                                        .partner.members"
                                                    :key="member.id"
                                                    src="assets/images/faces/face1.jpg"
                                                    alt="image"
                                                />-->
                                            </td>
                                            <td>
                                                <span
                                                    class="depart-tag"
                                                    v-for="department in uniqueDepartments"
                                                    :key="department.id"
                                                >
                                                    {{ department.name }}
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
                                                v-for="department in this
                                                    .partner.departments"
                                                :value="department.name"
                                                :key="department.id"
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
                                        :key="index"
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
                                                <td>
                                                   <!-- <span>
                                                        {{
                                                            (member.is_active =
                                                                "Active")
                                                        }}
                                                    </span>-->
                                                    <div class="active_status_container  d-flex flex-row justify-content-center">
                                                    <span class="active_status_text"
                                                        >{{
                                                            (member.is_active =
                                                                "Active")
                                                        }}</span
                                                    >
                                                </div>
                                                </td>
                                                <td>
                                                     <div class="mt-1"><span
                                                        class="department-tag py-1"
                                                        v-for="department in member.departments"
                                                        :key="department.id"
                                                        >{{
                                                            department.name
                                                        }}</span></div>
                                                </td>
                                                <td></td>
                                                <td>
                                                   
                                                <!-- </td>
                                                 
                                                 {{calculateActiveKpiProgress(member)}}

                                                <td>
                                                    <div
                                                        class="progress-percentage"
                                                    >
                                                        {{
                                                            calculateActiveKpiProgress(
                                                                member
                                                            ).percentage
                                                        }}%
                                                    </div>
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar"
                                                            :class="{
                                                                'progress-bar-on-track':
                                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    ).label ===
                                                                    'On Track',
                                                                'progress-bar-at-risk':
                                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    ).label ===
                                                                    'At Risk',
                                                                'progress-bar-off-track':
                                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    ).label ===
                                                                    'Off Track',
                                                            }"
                                                            role="progressbar"
                                                            :style="{
                                                                width:
                                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    )
                                                                        .percentage +
                                                                    '%',
                                                            }"
                                                            :aria-valuenow="
                                                                calculateActiveKpiProgress(
                                                                    member
                                                                ).percentage
                                                            "
                                                            aria-valuemin="0"
                                                            aria-valuemax="100"
                                                        ></div>
                                                    </div>
                                                    <div class="progress-label"
                                                    :class="{'at-risk-label' : 
                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    ).label ===
                                                                    'At Risk',
                                                    'on-track-label' :
                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    ).label ===
                                                                    'On Track',
                                                   'off-track-label' :
                                                    calculateActiveKpiProgress(
                                                                        member
                                                                    ).label ===
                                                                    'Off Track'                                

                                                    }"
                                                    >
                                                        {{
                                                            calculateActiveKpiProgress(
                                                                member
                                                            ).label
                                                        }}
                                                    </div>
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
                                                    </button>-->
                                                   
                                                    <a :href="'/members/' +
                                                                member.id"><button
                                                        class="btn btn-sm px-1 py-1 btn-pri d-flex flex-row justify-content-center align-items-center"
                                                        
                                                    >
                                                        <span
                                                            class="mdi mdi-eye-outline text-light py-0"
                                                        ></span>
                                                        <a
                                                            :href="
                                                                '/members/' +
                                                                member.id
                                                            "
                                                            class="text-light" style="font-size: 14px;padding-left: 5px;"
                                                            >View</a
                                                        >
                                                    </button></a>
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
                <div v-if="loggedUser.user_role_id === 1">
                    <a
                        href="#"
                        class="text-light add-link text-sm btn btn-primary btn-sm my-2"
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
                                    <div v-if="loggedUser.user_role_id === 1">
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
                                                placeholder="Search for Kpi Metrics"
                                                v-model="searchQuery"
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
                                    <div v-if="loggedUser.user_role_id === 1">
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

                                        
                                        <!--<ul>
                                            <li
                                                v-for="(
                                                    item, index
                                                ) in selectedItems"
                                                :key="index"
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
                                        </ul>-->

                                         <template v-for="(item, index) in selectedItems"
                                :key="index"
                                >
                                <div class="d-flex flex-row">
                                <div class="container col-sm-10 bg-white email_container  my-2 rounded p-2 d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row ">
                                    
                                     <span>
                               <!-- <i class="mdi mdi-email-outline"></i>-->
                               <font-awesome-icon
                                icon="fa-regular, fa-user"
                                style="color: #979da9"
                                size="sm"
                                class="mx-auto my-auto"
                            />
                                {{ item.memberEmail }}
                                <span class="btn-suc">
                                   <!-- {{
                                        item.departmentId
                                            ? getDepartmentName(
                                                  item.departmentId
                                              )
                                            : ""
                                    }}-->
                                    sales
                                </span>
                        
                            </span>
                                    </div>    

                                     <label class="text-muted">{{item.memberTarget}}</label>
                                </div>
                                
                                <div class="delete_email container col-sm-1 my-2 p-0 bg-white rounded d-flex flex-column align-items-center"
                                 @click="removeFromList(index)">
                                    <font-awesome-icon
                                icon="fa-solid, fa-trash-can"
                                style="color: #979da9"
                                size="lg"
                                class="mx-auto my-auto"
                            />
                              <!--    <i
                                class="mdi mdi-delete delete-icon"
                                @click="removeFromList(index)"
                            ></i>-->
                                </div>
                                </div>
                                </template>
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
import { Chart } from "chart.js/auto";
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
     components: {
        FontAwesomeIcon,
    },

    data() {
        return {
            loggedUser: {
                user_role_id: null,
            },

            kpiPartnerProgress: {
                progress_percentage: null,
                status: null,
                formattedDate: "",
                // Other properties with default values
            },
            chartData: {
                labels: [],
                datasets: [
                    {
                        label: "KPI Completion",
                        data: [],
                        borderColor: "blue",
                        fill: false,
                    },
                ],
            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100, // Set the maximum value for the Y-axis
                        title: {
                            display: true,
                            text: "KPI Completion (%)",
                        },
                    },

                    x: {
                        // Specify the x-axis configuration
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Duration (Months)", // Label for the x-axis
                        },
                    },
                },

                plugins: {
                    annotation: {
                        annotations: [], // Annotations for review periods will be added here
                    },
                },
            },

            chartLoaded: false,
            countries: [],
            metrics: [],
            members: this.partner.members,
            kpiMetrics: [],
            selectedKpiTitle: "",
            selectedMemberKpi: "",
            selectedKpi: null,
            timelyValue: null,
            selectedType: "",
            kpiMetricsDetails: [],

            searchQuery: "", // Initialize the search query
            originalKpiMetrics: [],

            member: {
                email: "",
                target: "",
                id: "",
            },

            progressData: [],
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
            myChart: null,
            allMonths: null,
            dataPoints: null
        };
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        monthNames() {
            return [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ];
        },

        kpiPartnerProgress() {
            // Check if progressData is empty
            if (this.progressData.length === 0) {
                return null;
            }

            let firstProgress = null;

            // Loop through the progressData to find the first non-null element
            for (const progress of this.progressData) {
                if (progress.month !== null) {
                    firstProgress = progress;
                    break; // Exit the loop after finding the first non-null element
                }
            }

            // If no non-null element is found, return null
            if (!firstProgress) {
                return null;
            }

            // Calculate the status based on progress_percentage and additional fields
            let status = null;

            if (
                firstProgress.progress_percentage >=
                firstProgress.on_track_value
            ) {
                status = "On Track";
            } else if (
                firstProgress.progress_percentage >=
                    firstProgress.off_track_min &&
                firstProgress.progress_percentage <= firstProgress.off_track_max
            ) {
                status = "Off Track";
            } else if (
                firstProgress.progress_percentage >=
                    firstProgress.at_risk_min &&
                firstProgress.progress_percentage <= firstProgress.at_risk_max
            ) {
                status = "At Risk";
            } else {
                status = "NA"; // You can define what to do if it doesn't fall into any category
            }

            // Calculate the formatted date
            const formattedDate = `${firstProgress.day} ${
                this.monthNames[firstProgress.month_created - 1]
            } ${firstProgress.year_created}`;

            // Create a new object with the extracted data, status, and formattedDate
            const kpiProgress = {
                month: firstProgress.month,
                current_value: firstProgress.current_value,
                target_value: firstProgress.target_value,
                progress_percentage: firstProgress.progress_percentage,
                status: status,
                formattedDate: formattedDate,
            };

            return kpiProgress;
        },

        // getpercentage() {

        //     return this.progressData.map((percentage) => ({
        //         ...percentage

        //     }));

        // },

        calculateActiveKpiProgress() {
            return (member) => {
                const kpiMetrics = member.kpis
                    .flatMap((kpi) => kpi.kpi_metrics)
                    .flatMap((metric) => metric.kpi_metric_members) // Navigate to kpi_metric_members
                    .flatMap((member) => member.progress); // Navigate to progress

                console.log(
                    "Kpi Metrics on Members:",
                    JSON.stringify(kpiMetrics)
                );

                const sumCurrentValues = kpiMetrics.reduce((sum, progress) => {
                    return sum + progress.current_value;
                }, 0);

                const sumTargets = kpiMetrics.reduce((sum, progress) => {
                    return sum + progress.target_value;
                }, 0);

                if (sumTargets === 0) {
                    return { percentage: 0, label: "N/A" };
                }

                const percentage = (
                    (sumCurrentValues / sumTargets) *
                    100
                ).toFixed(2);
                let label = "On Track";

                const kpiThresholds = member.kpis
                    .flatMap((kpi) => kpi.kpi_metrics)
                    .find(
                        (metric) =>
                            percentage >= metric.off_track_min &&
                            percentage <= metric.off_track_max
                    );

                if (kpiThresholds) {
                    label = "Off Track";
                } else {
                    const kpiAtRisk = member.kpis
                        .flatMap((kpi) => kpi.kpi_metrics)
                        .find(
                            (metric) =>
                                percentage >= metric.at_risk_min &&
                                percentage <= metric.at_risk_max
                        );
                    if (kpiAtRisk) {
                        label = "At Risk";
                    }
                }

                return { percentage, label };
            };
        },

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

        metricWithProgress() {
            const groupedMetrics = {};

            this.kpiMetricsDetails.forEach((metric) => {
                const id = metric.metric.id;

                if (!groupedMetrics[id]) {
                    groupedMetrics[id] = {
                        id: metric.metric.id,
                        name: metric.metric.name,

                        calculatedProgress: this.calculateMetricProgress(
                            metric.metric.kpi_metric.kpi.kpi_metrics
                        ),

                        totalCurrentValue:
                            this.calculateTotalCurrentValueforMetric(
                                metric.metric.kpi_metric.kpi.kpi_metrics
                            ),

                        // metricTopDrivers: this.getTopDrivers (metric.metric.kpi_metric.kpi.kpi_metrics)

                        // statusClass: this.getStatusClass(metric),
                        partner: metric.metric.kpi_metric.partner,
                        // departments: partner.departments,
                    };
                }
            });

            return Object.values(groupedMetrics);
        },

        remainingCharacters() {
            return this.maxCharacters - this.formData.about.length;
        },
        isOverMax() {
            return this.remainingCharacters < 0;
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

        chartWithReviewPeriods() {
            // Extract data and progress percentages from the API response
            const months = this.progressData.map((item) => item.month);
            const progressPercentages = this.progressData.map(
                (item) => item.progress_percentage
            );

            // Create an array to store the data points for the line chart
            const dataPoints = [];

            // Initialize a variable to keep track of the progress
            let accumulatedProgress = 0;

            // Loop through the progress data and calculate data points
            for (let i = 0; i < months.length; i++) {
                const month = months[i];
                const progressPercentage = progressPercentages[i];

                // Calculate the data point for this month
                accumulatedProgress += progressPercentage;
                dataPoints.push({
                    x: month, // Use the month as the x-axis label
                    y: accumulatedProgress, // Accumulated progress percentage
                });
            }

            // Create annotations for review periods (if needed)
            const annotations = [];

            // Update the annotations in chartOptions (if needed)
            this.chartOptions.plugins.annotation.annotations = annotations;

            return dataPoints;
        },

        uniqueDepartments() {
            const uniqueDepartments = [];

            this.partner.departments.forEach((department) => {
                // Check if the department is not already in the uniqueDepartments array
                const existingDepartment = uniqueDepartments.find(
                    (d) => d.id === department.id
                );
                if (!existingDepartment) {
                    uniqueDepartments.push(department);
                }
            });

            return uniqueDepartments;
        },
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
        await this.fetchKpiMetrics();
        await this.fetchCountries();

        this.formattedDate = format(
            new Date(this.partner.created_at),
            "'Date Joined: ' do MMMM yyyy"
        );

        console.log(
            "KpiMetrics fetch according to metric_id:",
            JSON.stringify(this.kpiMetricsDetails)
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

        console.log("Specific Kpi Metrics:", JSON.stringify(this.kpimetrics));

        const partnerId = this.partnerId;

        const today = new Date();

        // Fetch data from your API endpoint for the last 8 months
        let uri =
            this.base_url +
            // `api/v1/kpi-progress?start_date=${startingDate.toISOString()}&end_date=${today.toISOString()}&partner_id=${partnerId}`;

            `api/v1/kpi-progress/${partnerId}?start_date=${today.toISOString()}&end_date=${today.toISOString()}`;
        await axios
            .get(uri)
            .then((response) => {
                console.log("Chart Data is:", response.data);
                this.progressData = response.data.overall_progress;

                console.log(
                    "Updated Chart Data:" + JSON.stringify(this.progressData)
                );

                // Extract data and progress percentages from the API response
                const months = this.progressData.map((item) => item.month);
                const progressPercentages = this.progressData.map(
                    (item) => item.progress_percentage
                );

                // Create an array of month labels for all 12 months
                const allMonths = Array.from({ length: 12 }, (_, i) => i + 1); // 1 to 12

                // Create an array to store the data points for the line chart
                const dataPoints = [];
                let accumulatedProgress = 0;

                // Loop through all months and populate data based on API response
                allMonths.forEach((month) => {
                    const monthIndex = months.indexOf(month);
                    if (monthIndex !== -1) {
                        // If data is available for this month, use it
                        accumulatedProgress += progressPercentages[monthIndex];
                        console.log("accumulated progress: ",accumulatedProgress);
                        dataPoints.push(accumulatedProgress);
                    } else {
                        // If no data available for this month, use zero or null
                        dataPoints.push(null); // Use null for no data
                    }
                });

                // Create a new Chart instance
                const chartCanvas = this.$refs.chart;
                const ctx = chartCanvas.getContext("2d");

                // Create the chart with dynamic x-axis labels
               
                const myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: allMonths.map((month) => {
                            const monthIndex = month - 1;
                            return [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                            ][monthIndex];
                        }),
                        datasets: [
                            {
                                label: "Remaining",
                                data: dataPoints,
                                borderColor: "blue",
                                fill: false,
                            },
                        ],
                    },
                    options: this.chartOptions,
                });
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    },

    mounted() {
        /*const partnerId = this.partnerId;

        const today = new Date();

        // Fetch data from your API endpoint for the last 8 months
        let uri =
            this.base_url +
            // `api/v1/kpi-progress?start_date=${startingDate.toISOString()}&end_date=${today.toISOString()}&partner_id=${partnerId}`;

            `api/v1/kpi-progress/${partnerId}?start_date=${today.toISOString()}&end_date=${today.toISOString()}`;
        axios
            .get(uri)
            .then((response) => {
                console.log("Chart Data is:", response.data);
                this.progressData = response.data.overall_progress;

                console.log(
                    "Updated Chart Data:" + JSON.stringify(this.progressData)
                );

                // Extract data and progress percentages from the API response
                const months = this.progressData.map((item) => item.month);
                const progressPercentages = this.progressData.map((item) =>
                    item.progress_percentage.toFixed(2)
                );

                // Create an array of month labels for all 12 months
                const allMonths = Array.from({ length: 12 }, (_, i) => i + 1); // 1 to 12

                // Create an array to store the data points for the line chart
                const dataPoints = [];
                let accumulatedProgress = 0;

                // Loop through all months and populate data based on API response
                allMonths.forEach((month) => {
                    const monthIndex = months.indexOf(month);
                    if (monthIndex !== -1) {
                        // If data is available for this month, use it
                        accumulatedProgress += progressPercentages[monthIndex];
                        dataPoints.push(accumulatedProgress);
                    } else {
                        // If no data available for this month, use zero or null
                        dataPoints.push(null); // Use null for no data
                    }
                });

                // Create a new Chart instance
                const chartCanvas = this.$refs.chart;
                const ctx = chartCanvas.getContext("2d");

                // Create the chart with dynamic x-axis labels
               
                const myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: allMonths.map((month) => {
                            const monthIndex = month - 1;
                            return [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                            ][monthIndex];
                        }),
                        datasets: [
                            {
                                label: "Completed",
                                data: dataPoints,
                                borderColor: "blue",
                                fill: false,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                title: {
                                    display: true,
                                    text: "KPI Completion (%)",
                                },
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: "Duration in (Months)",
                                },
                            },
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const label =
                                            context.dataset.label || "";
                                        if (label) {
                                            return `${context.parsed.y}% ${label}`;
                                            return;
                                            //     const labelWithColor = `<span style="color: red;">${context.parsed.y}% ${label}</span>`;
                                            //   labelWithColor;
                                        }
                                        return "";
                                    },
                                },
                            },
                        },
                    },
                });
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });*/
    },

    methods: {
        handleLinkClick() {
            this.currentPage = 1; // Set currentPage to 1
            window.location.reload(); // Reload the current page
        },

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
                kpiMetricMember.progress.forEach((progressEntry1) => {
                    targetSum += progressEntry1.target_value;
                });
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

        // searchKpiMetrics(kpi) {
        //     const searchQuery = this.searchQuery.toLowerCase().trim();
        //     console.log("Search Query:", searchQuery);

        //     if (searchQuery === "") {
        //         // If the search query is empty, reset the KPI metrics to the original values
        //         kpi.kpi_metrics = [...this.originalKpiMetrics];
        //     } else {
        //         // Filter the KPI metrics based on the search query
        //         kpi.kpi_metrics = this.originalKpiMetrics.filter(
        //             (kpiMetric) => {
        //                 const title = kpiMetric.title.toLowerCase();
        //                 console.log("KPI Metric Title:", title);
        //                 return title.includes(searchQuery);
        //             }
        //         );
        //     }

        //     console.log("Filtered KPI Metrics:", kpi.kpi_metrics);
        // },

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

        // calculateActiveKpiProgress(kpiMetricMembers) {
        //     const sumCurrentValues = kpiMetricMembers.reduce(
        //         (sum, member) =>
        //             sum +
        //             member.progress.reduce(
        //                 (memberSum, progress) =>
        //                     memberSum + progress.current_value,
        //                 0
        //             ),
        //         0
        //     );

        //     const sumTargets = kpiMetricMembers.reduce(
        //         (sum, member) =>
        //             sum +
        //             member.progress.reduce(
        //                 (memberSum, progress) =>
        //                     memberSum + progress.target_value,
        //                 0
        //             ),
        //         0
        //     );

        //     if (sumTargets === 0) {
        //         return 0;
        //     }

        //     return ((sumCurrentValues / sumTargets) * 100).toFixed(2);
        // },

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

        async fetchKpiMetrics() {
            try {
                const kpiMetricsDetails = [];

                // Iterate through each KPI of the partner
                for (const kpi of this.partner.kpis) {
                    // Iterate through each kpi_metric of the KPI
                    for (const kpiMetric of kpi.kpi_metrics) {
                        const metricId = kpiMetric.metric_id;
                        const uri =
                            this.base_url + `api/v1/kpi-metrics/${metricId}`;

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

                // Store or process the KPI Metrics data as needed
                this.kpiMetricsDetails = kpiMetricsDetails;
            } catch (error) {
                console.error("Error fetching KPI Metrics:", error);
            }
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
            //const selectedID = this.members.find;

            let newMember = this.members.find((member) => {
                // this.member.id = member.id;
                console.log("Members inside here:", member.email);
                console.log(
                    "Selected Member inside here:",
                    selectedKpiMemberEmail
                );
                return member.email === selectedKpiMemberEmail;
            });

            let selectedID = newMember.id;

            this.member.id = selectedID;

            console.log("New MemberiD:", selectedID);

            console.log("New Member Email:", selectedKpiMemberEmail);

            this.member.id = newMember.id;

            console.log("Target for this member is:", this.member.target);

            this.selectedItems.push({
                memberEmail: selectedKpiMemberEmail,
                memberTarget: selectedKpiTarget,
                memberID: selectedID,
            });

            console.log("Selected ID:", selectedID);
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
            console.log(
                "New Members arrays is",
                JSON.stringify(this.selectedItems)
            );
            const partner = this.partner;
            console.log("Target1 is :", this.formData.target);
            console.log("Target2 is :", this.member.target);
            console.log("Member is:", this.members);
            console.log("Email is:", this.member.email);
            // Create a new FormData object
            const membersWithTarget = {
                members: this.members.map((member) => {
                    // Clone the member object
                    const modifiedMember = { ...member };
                    // Attach the target property to the cloned member object
                    // modifiedMember.target = this.member.target;
                    // modifiedMember.targets = this.selectedItems;

                    return modifiedMember;
                }),

                targets: this.selectedItems,
            };

            //memberWithTarget.targets = this.selectedItems;

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
                formData.append("metric_id", selectedMetric.id);
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

        handleLinkClick() {
        this.currentPage = 1; 
        window.location.reload(); 
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

/*.encircle {
    padding: 3px;
    border-radius: 50%;
    background-color: rgba(128, 128, 128, 0.089);
    color: rgba(24, 23, 23, 0.911);
}*/

.encircle {
    /*padding: 5px;
    border-radius: 100%;
    background-color: rgba(128, 128, 128, 0.089);
    color: rgba(24, 23, 23, 0.911);*/
  /*position: absolute;*/
    top: 0px;
    color: rgba(24, 23, 23, 0.911);
    background-color: rgba(128, 128, 128, 0.089);
    /*width: 25px;
    height: 25px;*/
    border-radius: 50%;
    padding: 3px 6px;
    line-height: 25px;
    font-size: 10px;
    text-align: center;
    cursor: pointer;
    z-index: 999;
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

/* CSS class for "On Track" progress */
.progress-bar-on-track {
    background-color: green;
}

/* CSS class for "At Risk" progress */
.progress-bar-at-risk {
    background-color: #f0ad4e;
}

/* CSS class for "Off Track" progress */
.progress-bar-off-track {
    background-color: red;
}

.no-data-message {
    text-align: center;
    font-size: 16px;
    color: #777;
    margin-top: 20px;
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


.on-track-header{
    font-size: 18px;
    color: #047a48;
    font-weight: 800 !important;
}


.off-track-header {
    /*color: #d9534f;*/
    color: #a5292a;
    font-size: 18px;
    font-weight: 800 !important;
}

.at-risk-header {
    color: #f0ad4e;
    font-size: 18px;
    font-weight: 800 !important;
}


.email_container{
    /*border :1px solid #979da9;*/
    border: 1px solid #e0e3e8;
}

.delete_email{
    border: 1px solid #e0e3e8;
    align-items: center;
    
}

.primary_button{
    background-color: #084bf7;
    font-size: 14px;
    font-weight: 300;
    color: white;
}

.btn-suc {
    /*background-color: #ccccccc5;*/
    background-color: #f3f4f7;
    padding: 5px 10px;
    font-size: 12px;
    margin-right: 5px;
    border-radius: 8px;
}

.member_image{
    width: 35px;
    margin-left: -10px;
    height: 35px;
    border-radius: 50%;
    background-color: #f3f4f7;
    border-color: 1px solid #979da9;
    /*background-color: #d3d3d3;*/
    /*border-color: 1px solid white;*/
}

.member_image_plus{
    width: 35px;
    margin-left: -10px;
    height: 35px;
    border-radius: 50%;
    background-color: #fff7df;
    border: white 1px solid;
    display: flex;
    flex-direction: column;
}

.member_image_text{
    color:#f8b925;
    font-size: 11px;
    margin: auto;
    
}


.btn-pri{
    /*background-color: #0072bb;*/
    background-color: #0072bb;
    font-size: 9px !important;
    border-radius: 8px;
    height: 32px;
    width: 100px;
    color: #eaf3ff;
  

}
</style>
