import { createRouter, createWebHistory } from "vue-router";
import LoginPageView from '../components/LoginPageView.vue'
import DashboardView from '../components/DashboardView.vue'
import CropView from '../components/CropView.vue'
import InventoryView from '../components/InventoryView.vue'
import EmployeeView from '../components/EmployeeView.vue'
import FinanceView from '../components/FinanceView.vue'
import UserAccountsView from '../components/UserAccountsView.vue'
import ProfileView from '../components/ProfileView.vue'

const routes = [
    {
        path: '/',
        name: 'login',
        component: LoginPageView,
        meta: {
            title: 'FarmTrack - Login'
        }
    }, 
    {
        path: '/dashboard',
        name: 'dashboard',
        component: DashboardView,
        meta: {
            title: 'FarmTrack - Dashboard'
        }
    },
    {
        path: '/crops',
        name: 'crops',
        component: CropView,
        meta: {
            title: 'FarmTrack - Crops'
        }
    },
    {
        path: '/inventory',
        name: 'inventory',
        component: InventoryView,
        meta: {
            title: 'FarmTrack - Inventory'
        }
    },
    {
        path: '/employees',
        name: 'employees',
        component: EmployeeView,
        meta: {
            title: 'FarmTrack - Employee'
        }
    },
    {
        path: '/finance',
        name: 'finance',
        component: FinanceView,
        meta: {
            title: 'FarmTrack - Finance'
        }
    },
    {
        path: '/useraccounts',
        name: 'useraccounts',
        component: UserAccountsView,
        meta: {
            title: 'FarmTrack - Users'
        }
    },
    {
        path: '/profile',
        name: 'profile',
        component: ProfileView,
        meta: {
            title: 'FarmTrack - Profile'
        }
    }
]

const router = createRouter ({
    history: createWebHistory(process.env.BASE_URL), routes
})

router.beforeEach((to, from) => {
    document.title = to.meta?.title ?? 'default title'
  })

export default router