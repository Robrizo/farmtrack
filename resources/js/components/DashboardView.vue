<template>
  <!-- page wrapper start -->
  <div class="flex h-screen overflow-hidden bg-color">
    <!-- SIDEBAR START -->
    <aside  :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'" class="absolute left-0 top-0 z-10 flex h-screen w-52 flex-col overflow-y-hidden bg-secondaryColor duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0 -translate-x-full">
      <!-- SIDEBAR HEADER -->
      <div class="flex items-center bg-primaryColor justify-between gap-2 h-[76px] px-3 py-5.5 lg:py-6.5">
        <router-link to="/dashboard" class="text-xl px-2 tracking-widest text-white font-bold uppercase">
          <!-- <img src="" alt=""> -->
          farm<span class="text-gray-800">Track</span>
        </router-link>
        <button @click.stop="toggleSidebar" class="block lg:hidden text-2xl text-lightGray"><span><i class="bx bx-arrow-back"></i></span></button>
      </div>
      <!-- SIDEBAR HEADER -->
      <div class="no-scrollbar flex flex-col overflow-y-auto  duration-300 ease-linear">
        <!-- sidebar menu -->
        <nav class="mt-5 px-4 lg:mt-4 lg:px-4">
          <div>
            <ul class="mb-6 flex flex-col gap-1.5">
              <!-- menu items -->
              <li v-for="(route, index) in routes" :key="index">
                <router-link :to="route.path" class="group relative flex items-center gap-2.5 rounded-lg py-2 font-medium duration-300 ease-in-out hover:bg-primaryColor hover:text-white text-lightGray uppercase transform hover:translate-x-3 transition-transform" :class="{ 'active': isActive(route.path) }">
                  <span class="pl-2 text-xl"><i :class="route.icon"></i></span>
                  {{ route.name }}
                </router-link>
              </li>
            </ul>
          </div>
        </nav>
        <!-- side menu end -->
      </div>
    </aside>
    <!-- sidebar end -->
    <!-- content area start -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <!-- header start -->
      <header class="sticky top-0 z-999 flex w-full bg-white shadow-lg h-[76px]  dark:bg-lightGray dark:drop-shadow-none">
        <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11">
          <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
            <button @click.stop="toggleSidebar" class="z-99999 block rounded-lg border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden">
              <span class="text-lg"><i class="bx bx-menu"></i></span>
            </button>
            <router-link to="/dashboard" class="text-xl text-primaryColor tracking-wider font-bold uppercase">farm<span class="text-gray-800">Track</span></router-link>
          </div>
          <div class="left-0 hidden lg:block">
            <h2 class="font-bold text-primaryColor">{{ currentDateTime }}</h2>
          </div>
          <!-- user area -->
          <div class="relative">
            <a @click.prevent="dropdownOpen" href="#" class="flex items-center gap-4">
              <span class="text-left">
                <span class="block text-sm font-bold text-primaryColor dark:text-white">Welcome</span>
                <span class="block text-base font-bold text-primaryColor capitalize">{{ newUser.name }}</span>
              </span>
              <span :class="formDropped && 'rotate-180'" class="text-2xl"><i class="bx bx-chevron-down"></i></span>
            </a>
            <!-- drop down start -->
            <div v-show="formDropped"  class="absolute right-0 mt-4 flex w-52 flex-col rounded-lg border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark" style="display: none;">
              <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-2 dark:border-lightGray">
                <!-- user list start -->
                <li>
                  <router-link to="/profile" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primaryColor lg:text-base capitalize">
                    <span><i class="bx bx-user"></i></span>my profile
                  </router-link>
                </li>
                <!-- user list end -->
                <!-- user list start -->
                <li>
                  <a href="#" class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primaryColor lg:text-base capitalize">
                    <span><i class="bx bx-cog"></i></span>account settings
                  </a>
                </li>
                <!-- user list end -->
              </ul>
              <button @click="logout" class="flex items-center gap-3.5 py-4 px-6 text-sm font-medium duration-300 ease-in-out hover:text-primaryColor lg:text-base capitalize">
                <span><i class="bx bx-log-out"></i></span>logout
              </button>
            </div>
            <!-- drop down end -->
          </div>
          <!-- user area end -->
        </div>
      </header>
      <!-- header end -->
      <!-- main content start -->
      <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <!-- dashboard elements start -->
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7">
            <!-- dashboard card start -->
            <div class="rounded-sm border border-stroke bg-white px-7 py-6 shadow-lg">
              <div class="flex h-11 w-11 items-center justify-center rounded-full bg-green-200">
                <span>
                  <i class="bx bx-dollar-circle text-xl text-primaryColor"></i>
                </span>
              </div>
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h3 class="text-2xl font-bold text-black">MK {{ formatNumber(totals.total) }}</h3>
                  <span class="text-gray-400 text-sm font-medium capitalize">total input cost</span>
                </div>
              </div>
            </div>
            <!-- dashboard card end -->
            <!-- dashboard card start -->
            <div class="rounded-sm border border-stroke bg-white px-7 py-6 shadow-lg">
              <div class="flex h-11 w-11 items-center justify-center rounded-full bg-green-200">
                <span>
                  <i class="bx bx-dollar-circle text-xl text-primaryColor"></i>
                </span>
              </div>
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h3 class="text-2xl font-bold text-black">MK {{ formatNumber(payments.amount) }}</h3>
                  <span class="text-gray-400 text-sm font-medium capitalize">total payments</span>
                </div>
              </div>
            </div>
            <!-- dashboard card end -->
            <!-- dashboard card start -->
            <div class="rounded-sm border border-stroke bg-white px-7 py-6 shadow-lg">
              <div class="flex h-11 w-11 items-center justify-center rounded-full bg-green-200">
                <span>
                  <i class="bx bx-spreadsheet text-xl text-primaryColor"></i>
                </span>
              </div>
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h3 class="text-2xl font-bold text-black">{{ totalInputs }}</h3>
                  <span class="text-gray-400 text-sm font-medium capitalize">total inputs</span>
                </div>
              </div>
            </div>
            <!-- dashboard card end -->
            <!-- dashboard card start -->
            <div class="rounded-sm border border-stroke bg-white px-7 py-6 shadow-lg">
              <div class="flex h-11 w-11 items-center justify-center rounded-full bg-green-200">
                <span>
                  <i class="bx bx-user-plus text-xl text-primaryColor"></i>
                </span>
              </div>
              <div class="mt-4 flex items-end justify-between">
                <div>
                  <h3 class="text-2xl font-bold text-black">{{ totalEmployee }}</h3>
                  <span class="text-gray-400 text-sm font-medium capitalize">total employees</span>
                </div>
              </div>
            </div>
            <!-- dashboard card end -->
          </div>
          <!-- dashboard elements end -->
        </div>
      </main>
      <!-- main content end -->
    </div>
    <!-- content area end -->
  </div>
  <!-- page wrapper end -->
</template>
<script>
import axios from 'axios'

export default {
  data () {
    return {
      currentDateTime: '',
      formDropped: false,
      sidebarToggle: false,
      isVisible: false,
      totals: 0,
      payments: 0,
      totalEmployee: 0,
      totalInputs: 0,
      newUser: {}
    }
  },
  mounted () {
    this.updateDateTime()
    setInterval(() => this.updateDateTime(), 1000)
    this.sumTotals()
    this.sumPayment()
    this.countEmployees()
    this.countInputs()
    this.fetchUser()
  },

  computed: {
    routes () {
      // Routes, menu names, icons
      return [
        { path: '/dashboard', name: 'dashboard', icon: 'bx bx-home' },
        { path: '/inventory', name: 'inventory', icon: 'bx bx-spreadsheet' },
        { path: '/crops', name: 'crop', icon: 'bx bx-spa' },
        { path: '/employees', name: 'employee', icon: 'bx bx-notepad' },
        { path: '/finance', name: 'finance', icon: 'bx bx-dollar-circle' },
        { path: '/useraccounts', name: 'users', icon: 'bx bx-user-plus' },
        { path: '/profile', name: 'profile', icon: 'bx bx-user' }
      ]
    }
  },

  methods: {
    isActive (path) {
      return this.$route.path === path
    },

    // user dropdown method
    dropdownOpen () {
      this.formDropped = !this.formDropped
    },
    // toggle sidebar method
    toggleSidebar () {
      this.sidebarToggle = !this.sidebarToggle
    },

    // dispay current time method
    updateDateTime () {
      const now = new Date()
      const options = {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
      }
      this.currentDateTime = now.toLocaleString(undefined, options)
    },

    //function to display user
    async fetchUser() {
      try {
        const response = await axios.get('api/getuser');
        this.newUser = response.data.user;
      } catch (error) {
        console.error('Error fetching user data', error);
      }
    },

    // get total input cost method
    async sumTotals () {
      try {
        const response = await axios.get('/api/farm')
        this.totals = response.data.totals
      } catch (error) {
        console.error('failed to get totals', error)
      }
    },

    // get total payment method
    async sumPayment () {
      try {
        const response = await axios.get('/api/payment')
        this.payments = response.data.payments
      } catch (error) {
        console.error('failed to get payments', error)
      }
    },

    // get total employees method
    async countEmployees () {
      try {
        const response = await axios.get('/api/employee')
        this.totalEmployee = response.data.employees
      } catch (error) {
        console.error('failed to get total employees', error)
      }
    },

    // get total inputs method
    async countInputs () {
      try {
        const response = await axios.get('/api/inputs')
        this.totalInputs = response.data.inputs
      } catch (error) {
        console.error('failed to get total inputs', error)
      }
    },

    // logout method
    async logout () {
      try {
        const response = await axios.post('/api/signout')
         
        if (response.data.redirect) {
          window.location.href = response.data.redirect
          console.log('logout successful')
        } else {
          console.error('logout failed', response)
        }
      } catch (error) {
        console.error('logout failed', error)
      }
    },

    formatNumber (number) {
      // Check if number is valid
      if (isNaN(number)) {
        return '';
      }
      // Convert number to locale formatted string with commas
      return number.toLocaleString();
    }
  }
}
</script>
<style>
.bg-color {
  background: #ecf7ed;
}

.active {
  background-color: rgb(0, 128, 0);
  color: #fff;
  border-right: 3px  solid #ecf7ed;
}
</style>
