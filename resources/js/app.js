import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import DashboardComponent from './components/DashboardComponent.vue';
import PartnerComponent from './components/partner/PartnerComponent.vue';
import PartnerCreateComponent from './components/partner/PartnerCreateComponent.vue';
import ConfigurationComponent from './components/configuration/ConfigurationComponent.vue';
import DepartmentComponent from './components/department/DepartmentComponent.vue';
import DepartmentCreateComponent from './components/department/DepartmentCreateComponent.vue';
import ProfileEditComponent from './components/profile/ProfileEditComponent.vue';

app.component('dashboard-component', DashboardComponent);
app.component('partner-component', PartnerComponent);
app.component('profile-edit-component', ProfileEditComponent);
app.component('partner-create-component', PartnerCreateComponent);
app.component('configuration-component', ConfigurationComponent)
app.component('department-component', DepartmentComponent);
app.component('department-create-component', DepartmentCreateComponent);

app.mount('#app');

