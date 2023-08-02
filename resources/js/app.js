
import './bootstrap';


import { createApp } from 'vue';




const app = createApp({});





import DashboardComponent from './components/DashboardComponent.vue';

import PartnerComponent from './components/partner/PartnerComponent.vue';
import PartnerCreateComponent from './components/partner/PartnerCreateComponent.vue';
import PartnerDetailComponent from './components/partner/PartnerDetailComponent.vue';

import ConfigurationComponent from './components/configuration/ConfigurationComponent.vue';
import DepartmentComponent from './components/department/DepartmentComponent.vue';
import DepartmentCreateComponent from './components/department/DepartmentCreateComponent.vue';
import DepartmentDetailComponent from './components/department/DepartmentDetailComponent.vue';
import ProfileEditComponent from './components/profile/ProfileEditComponent.vue';

app.component('dashboard-component', DashboardComponent);
app.component('partner-component', PartnerComponent);
app.component('partner-detail-component', PartnerDetailComponent);

app.component('profile-edit-component', ProfileEditComponent);
app.component('partner-create-component', PartnerCreateComponent);
app.component('configuration-component', ConfigurationComponent)
app.component('department-component', DepartmentComponent);
app.component('department-create-component', DepartmentCreateComponent);
app.component('department-detail-component', DepartmentDetailComponent);



app.mount('#app');

