<template>
    <div>
        <div v-if="success" class="alert alert-success">
            {{ success }}
        </div>
        <div class="top-header">
            <h2 class="txt-dark">Configurations</h2>
            <p class="txt-gray">
                Configure values used throughout the application.
            </p>
        </div>

        <div class="row configs">
            <div class="col-3">
                <div class="card bg-light mx-3">
                    <div class="card-body">
                        <h5 class="mb-3 text-primary">KPI Setup</h5>
                        <i class="mdi mdi-image-filter-none text-dark h1"></i>
                        <span class="mx-2 text-dark">Metric Types</span>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <h2 class="txt-dark">Metric Types</h2>
                    <p class="txt-gray">
                        Configure metric types used in setting up and measuring
                        KPIs
                    </p>
                    <div class="">
                       

                            <a
                                href=""
                                class="text-light add-link btn btn-primary my-2"
                                data-toggle="modal"
                                data-target="#submitMetricModal"
                                ><span class="plus">+</span> Metric</a>
                            
                        
                    </div>

                    <div class="row">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between my-3"
                            >
                                <div>
                                    <div class="input-container">
                                        <i class="mdi mdi-magnify mdi-icon"></i>
                                        <input
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <p v-if="metrics.length === 0">
                                        No metric found
                                    </p>
                                    <table v-else class="table">
                                        <thead>
                                            <tr>
                                                <th>Metric</th>
                                                <th>Standard unit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="metric in metrics"
                                                :key="metric.id"
                                            >
                                                <td>{{ metric.name }}</td>
                                                <td>{{ metric.unit }}</td>
                                                <td>
                                                    <button
                                                        class="btn btn-pri"
                                                        @click="
                                                            editMetric(metric)
                                                        "
                                                    >
                                                        Edit
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="btn"
                                                    >
                                                        <button
                                                            @click="
                                                                deleteMetric(
                                                                    metric.id
                                                                )
                                                            "
                                                            class="btn btn-sec"
                                                        >
                                                            Delete
                                                        </button>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        <!-- Add pagination buttons here if needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade p-5"
            id="submitMetricModal"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content p-5">
                    <p><i class="mdi mdi-image-filter-none h1"></i></p>
                    <h3>Add Metric type</h3>
                    <form @submit.prevent="submitMetric">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Name</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Enter name"
                                    class="form-control"
                                    type="text"
                                    v-model="newMetric.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.name }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label
                                    for="unit"
                                    class="col-form-label text-md-start"
                                    >Standard unit of measurement</label
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
                                        v-model="newMetric.unit"
                                    >
                                        <option value="">
                                            Select or create standard unit
                                        </option>
                                        <option value="select">
                                            Create standard unit
                                        </option>

                                     <option v-for="unit in units" :key="unit.id" :value="unit.name">{{ unit.name }}</option>

                                        <!-- <option value="count">Count</option>
                                        <option value="currency">
                                            Currency
                                        </option>
                                        <option value="time">Time</option> -->
                                    </select>
                                </div>
                                <span
                                    v-if="errors.unit"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.unit }}</strong>
                                </span>
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
            v-if="metrics.length > 0"
            class="modal fade p-5"
            id="editMetricModal"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content p-5">
                    <p><i class="mdi mdi-image-filter-none h1"></i></p>
                    <h3>Edit Metric type</h3>
                    <form @submit.prevent="updateMetric">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Name</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Enter name"
                                    class="form-control"
                                    type="text"
                                    v-model="selectedMetric.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.name }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label
                                    for="unit"
                                    class="col-form-label text-md-start"
                                    >Standard unit of measurement</label
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
                                        v-model="selectedMetric.unit"
                                    >
                                        <option value="">
                                            Select or create standard unit
                                        </option>
                                        <option value="select">
                                            Create standard unit
                                        </option>
                                        <option value="count">Count</option>
                                        <option value="currency">
                                            Currency
                                        </option>
                                        <option value="time">Time</option>
                                    </select>
                                </div>
                                <span
                                    v-if="errors.unit"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.unit }}</strong>
                                </span>
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
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row configs mt-5">
            <div class="col-3"></div>
            <div class="col-9">
                <div class="row">
                    <h2 class="txt-dark">Standard Units</h2>
                    <p class="txt-gray">
                        Basic Measurument units for metric types
                    </p>
                    <div class="">
                       
                            <a
                                href=""
                                class="text-light add-link btn btn-primary my-2"
                                data-toggle="modal"
                                data-target="#submitStandardUnitModal"
                                ><span class="plus">+</span> Standard Unit</a
                            >
                        
                    </div>

                    <div class="row">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between my-3"
                            >
                                <div>
                                    <div class="input-container">
                                        <i class="mdi mdi-magnify mdi-icon"></i>
                                        <input
                                            class="input-field"
                                            type="text"
                                            placeholder="Search standard units"
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <p v-if="units.length === 0">
                                        No standard unit found
                                    </p>
                                    <table v-else class="table">
                                        <thead>
                                            <tr>
                                                <th>Standard unit</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="unit in units"
                                                :key="unit.id"
                                            >
                                                <td>{{ unit.name }}</td>
                                                <td>{{ unit.type }}</td>
                                                <td>
                                                    <button
                                                        class="btn btn-pri"
                                                        @click="
                                                            editMetric(metric)
                                                        "
                                                    >
                                                        Edit
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="btn"
                                                        >
                                                        <button
                                                            @click="
                                                                deleteMetric(
                                                                    metric.id
                                                                )
                                                            "
                                                            class="btn btn-sec"
                                                        >
                                                            Delete
                                                        </button>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        <!-- Add pagination buttons here if needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade p-5"
            id="submitStandardUnitModal"
            tabindex="-1"
            role="dialog"
              >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
                 >
                <div class="modal-content p-5">
                    <p><i class="mdi mdi-image-filter-none h1"></i></p>
                    <h3>Add standard unit</h3>
                    <form @submit.prevent="submitStandardUnit">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label
                                    for="unit"
                                    class="col-form-label text-md-start"
                                    >Name</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Enter name"
                                    class="form-control"
                                    type="text"
                                    v-model="newStandardUnit.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.name }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label
                                    for="type"
                                    class="col-form-label text-md-start"
                                    >Data type</label
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
                                        name="type"
                                        class="form-select"
                                        v-model="newStandardUnit.type"
                                    >
                                        <option value="">
                                            Select data type
                                        </option>

                                        <option value="integer">Integer</option>
                                        <option value="number">Number</option>
                                        <!-- <option value="date_time">
                                            Date/Time
                                        </option> -->
                                    </select>
                                </div>
                                <span
                                    v-if="errors.unit"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.unit }}</strong>
                                </span>
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
            v-if="metrics.length > 0"
            class="modal fade p-5"
            id="editMetricModal"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content p-5">
                    <p><i class="mdi mdi-image-filter-none h1"></i></p>
                    <h3>Edit Metric type</h3>
                    <form @submit.prevent="updateMetric">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Name</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Enter name"
                                    class="form-control"
                                    type="text"
                                    v-model="selectedMetric.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.name }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label
                                    for="unit"
                                    class="col-form-label text-md-start"
                                    >Standard unit of measurement</label
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
                                        v-model="selectedMetric.unit"
                                    >
                                        <option value="">
                                            Select or create standard unit
                                        </option>
                                        <option value="select">
                                            Create standard unit
                                        </option>
                                        <option value="count">Count</option>
                                        <option value="currency">
                                            Currency
                                        </option>
                                        <option value="time">Time</option>
                                    </select>
                                </div>
                                <span
                                    v-if="errors.unit"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.unit }}</strong>
                                </span>
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
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row configs mt-5">
            <div class="col-3"></div>
            <div class="col-9">
                <div class="row">
                    <h2 class="txt-dark">Tracking Criteria</h2>
                    <p class="txt-gray">
                        Define the percentage off the ideal path for the
                        performance flagging.
                    </p>

                    <div class="row">
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between my-3"
                            >
                                <div>
                                    <div class="input-container">
                                        <i class="mdi mdi-magnify mdi-icon"></i>
                                        <input
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <p v-if="metrics.length === 0">
                                        No metric found
                                    </p>
                                    <table v-else class="table">
                                        <thead>
                                            <tr>
                                                <th>Metric</th>
                                                <th>Standard unit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="metric in metrics"
                                                :key="metric.id"
                                            >
                                                <td>{{ metric.name }}</td>
                                                <td>{{ metric.unit }}</td>
                                                <td>
                                                    <button
                                                        class="btn btn-pri"
                                                        @click="
                                                            editMetric(metric)
                                                        "
                                                    >
                                                        Edit
                                                    </button>
                                                    <button
                                                        type="button"
                                                        class="btn"
                                                    >
                                                        <button
                                                            @click="
                                                                deleteMetric(
                                                                    metric.id
                                                                )
                                                            "
                                                            class="btn btn-sec"
                                                        >
                                                            Delete
                                                        </button>
                                                    </button>
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
        </div>

        <div
            class="modal fade p-5"
            id="submitMetricModal"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content p-5">
                    <p><i class="mdi mdi-image-filter-none h1"></i></p>
                    <h3>Add Metric type</h3>
                    <form @submit.prevent="submitMetric">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Name</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Enter name"
                                    class="form-control"
                                    type="text"
                                    v-model="newMetric.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.name }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label
                                    for="unit"
                                    class="col-form-label text-md-start"
                                    >Standard unit of measurement</label
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
                                        v-model="newMetric.unit"
                                    >
                                        <option value="">
                                            Select or create standard unit
                                        </option>
                                        <option value="select">
                                            Create standard unit
                                        </option>
                                        <option value="count">Count</option>
                                        <option value="currency">
                                            Currency
                                        </option>
                                        <option value="time">Time</option>
                                    </select>
                                </div>
                                <span
                                    v-if="errors.unit"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.unit }}</strong>
                                </span>
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
            v-if="metrics.length > 0"
            class="modal fade p-5"
            id="editMetricModal"
            tabindex="-1"
            role="dialog"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-lg"
                role="document"
            >
                <div class="modal-content p-5">
                    <p><i class="mdi mdi-image-filter-none h1"></i></p>
                    <h3>Edit Metric type</h3>
                    <form @submit.prevent="updateMetric">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label
                                    for="name"
                                    class="col-form-label text-md-start"
                                    >Name</label
                                >
                                <input
                                    id="name"
                                    name="name"
                                    placeholder="Enter name"
                                    class="form-control"
                                    type="text"
                                    v-model="selectedMetric.name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.name }}</strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label
                                    for="unit"
                                    class="col-form-label text-md-start"
                                    >Standard unit of measurement</label
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
                                        v-model="selectedMetric.unit"
                                    >
                                        <option value="">
                                            Select or create standard unit
                                        </option>
                                        <option value="select">
                                            Create standard unit
                                        </option>
                                        <option value="count">Count</option>
                                        <option value="currency">
                                            Currency
                                        </option>
                                        <option value="time">Time</option>
                                    </select>
                                </div>
                                <span
                                    v-if="errors.unit"
                                    class="invalid-feedback"
                                    role="alert"
                                >
                                    <strong>{{ errors.unit }}</strong>
                                </span>
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
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            success: "",
            metrics: [],
            units:[],
            newMetric: {
                name: "",
                unit: "",
            },
            newStandardUnit: {
                name: "",
                type: "",
            },
            selectedMetric: {
                name: "",
                unit: "",
            },
            base_url: "../",
            errors: {},
        };
    },

    mounted() {
        // Fetch metrics data
        this.fetchMetrics();
        this.fetchStandardUnits();
    },

    methods: {
        fetchMetrics() {
            // Perform API call to fetch metrics data
            let uri = this.base_url + "api/v1/metric-list";
            axios.get(uri).then((response) => {
                this.metrics = response.data;
            });
        },


        fetchStandardUnits() {
            // Perform API call to fetch metrics data
            let uri = this.base_url + "api/v1/standardUnit-list";
            axios.get(uri).then((response) => {
                this.units = response.data;
            });
        },

        submitMetric() {
            const formData = new FormData();
            formData.append("name", this.newMetric.name);
            formData.append("unit", this.newMetric.unit);

            let uri = this.base_url + `api/v1/metric-create`;
            axios
                .post(uri, formData)
                .then((response) => {
                    this.success = response.data.success;
                    this.fetchMetrics();

                      Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Metric  created successfully!",
                    }).then(() => {

                      this.newMetric = {
                        // Reset the newMetric object
                        name: "",
                        unit: "",
                    };

                        window.location.reload();
                    });
                 
                 
                    
                    $("#submitMetricModal").modal("hide"); // Close the modal
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        
        submitStandardUnit() {
            const formData = new FormData();
            formData.append("name", this.newStandardUnit.name);
            formData.append("type", this.newStandardUnit.type);

            let uri = this.base_url + `api/v1/standardUnit-create`;
            axios
                .post(uri, formData)
                .then((response) => {
                    
               this.success = response.data.success;
                this.fetchStandardUnits();
                  

                     Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Standard unit created successfully!",
                    }).then(() => {
                        this.newStandardUnit = {
                        // Reset the newMetric object
                        name: "",
                        type: "",
                    };

                        window.location.reload();
                    });
                 
                 
                    
                    $("#submitStandardUnitModal").modal("hide"); // Close the modal
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        editMetric(metric) {
            // Set the selected metric
            this.selectedMetric = { ...metric };

            // Open the edit modal
            $("#editMetricModal").modal("show");
        },

        updateMetric() {
            const formData = new FormData();
            formData.append("name", this.selectedMetric.name);
            formData.append("unit", this.selectedMetric.unit);

            let uri = this.base_url + `api/v1/metric-update`;
            axios
                .post(uri, formData)
                .then((response) => {
                    this.success = response.data.success;
                    this.fetchMetrics(); // Refresh the metrics
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },

        deleteMetric(metricId) {
            if (confirm("Are you sure you want to delete this metric?")) {
                let uri = this.base_url + `api/v1/metric-delete`;
                axios
                    .delete(uri, { data: { id: metricId } })
                    .then((response) => {
                        this.success = response.data.success;
                        this.fetchMetrics(); // Refresh the metrics immediately after deletion
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
        },
    },
};
</script>


<style scoped>
.btn-pri {
    padding: 5px 15px !important;
}


.btn-icon {
    display: flex;
    align-items: center;
    font-weight: bold;
}

</style>
