import './bootstrap';
import store from './store.js';


import { createApp } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
 //import  BootstrapVue  from 'bootstrap-vue';


const app = createApp({});

import DashboardComponent from './components/DashboardComponent.vue';

import PartnerComponent from './components/partner/PartnerComponent.vue';
import PartnerCreateComponent from './components/partner/PartnerCreateComponent.vue';
import PartnerDetailComponent from './components/partner/PartnerDetailComponent.vue';
import ProgressComponent from './components/progress/ProgressComponent.vue';
import ProgressDetailComponent from './components/progress/ProgressDetailComponent.vue';
import ConfigurationComponent from './components/configuration/ConfigurationComponent.vue';
import DepartmentComponent from './components/department/DepartmentComponent.vue';
import DepartmentCreateComponent from './components/department/DepartmentCreateComponent.vue';
import DepartmentDetailComponent from './components/department/DepartmentDetailComponent.vue';
import ProfileEditComponent from './components/profile/ProfileEditComponent.vue';
import MemberComponent from './components/member/MemberComponent.vue';
import DepartmentPartnerDetailComponent from './components/department_partner/DepartmentPartnerDetailComponent.vue';
import DepartmentMemberComponent from './components/department_member/DepartmentMemberComponent.vue';

// app.use(BootstrapVue);

app.component('dashboard-component', DashboardComponent);
app.component('partner-component', PartnerComponent);
app.component('partner-detail-component', PartnerDetailComponent);
app.component('progress-component', ProgressComponent);
app.component('progress-detail-component', ProgressDetailComponent);
app.component('profile-edit-component', ProfileEditComponent);
app.component('partner-create-component', PartnerCreateComponent);
app.component('configuration-component', ConfigurationComponent)
app.component('department-component', DepartmentComponent);
app.component('department-create-component', DepartmentCreateComponent);
app.component('department-detail-component', DepartmentDetailComponent);
app.component('member-component', MemberComponent);
app.component('department-partner-detail-component', DepartmentPartnerDetailComponent);
app.component('department-member-component', DepartmentMemberComponent);



app.component('font-awesome-icon', FontAwesomeIcon);
app.use(store); 
app.mount('#app');

