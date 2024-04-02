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
        <!-- table container start -->
        <div class="">
          <div class="text-right">
            <button @click="makeFormVisible" :class="{'hidden': isVisible}" class="bg-primaryColor font-bold uppercase rounded-lg p-2 px-4 mb-4 text-white">add item</button>
          </div>
          <!-- table start -->
          <table :class="{'hidden': isVisible}" class="w-full text-center shadow-lg table-auto">
            <!-- table caption start -->
            <caption class="bg-lightGray p-3">
              <div class="flex text-center">
                <h2 class="uppercase font-bold text-lg text-left text-primaryColor">manage crops</h2>
                <form @submit.prevent="searchCrop" action="" class="ml-auto">
                  <div class="flex items-center justify-center">
                    <input v-model="searchKeyword" @input="searchCrop" class="px-2 py-1 rounded-l-lg outline-none" type="search" name="" placeholder="Search...">
                    <button type="submit">
                      <span class="bg-primaryColor py-1 px-2 rounded-r-lg text-white">
                        <i class="bx bx-search"></i>
                      </span>
                    </button>
                  </div>
                </form>
              </div>
            </caption>
            <!-- table caption end -->
            <!-- table header start -->
            <thead class="text-sm uppercase bg-gray-200">
              <tr class="border border-gray-400">
                <th class="p-4 border border-gray-400">#</th>
                <th class="p-4 border border-gray-400">crop name</th>
                <th class="p-4 border border-gray-400">crop type</th>
                <th class="p-4 border border-gray-400">planting date</th>
                <th class="p-4 border border-gray-400">harvesting date</th>
                <th class="p-4 border border-gray-400">actions</th>
              </tr>
            </thead>
            <!-- table header end -->
            <!-- table body start -->
            <tbody class="capitalize text-lg bg-white">
              <tr v-for="(item, index ) in cropDetails.data" :key="item.id" class="border border-gray-400">
                <td class="p-2 border border-gray-400">{{ index + 1 }}</td>
                <td class="p-2 border border-gray-400">{{ item.crop_name }}</td>
                <td class="p-2 border border-gray-400">{{ item.crop_type }}</td>
                <td class="p-2 border border-gray-400">{{ item.planting_date }}</td>
                <td class="p-2 border border-gray-400">{{ item.harvesting_date }}</td>
                <td>
                  <button @click="editFormVisible (item)">
                    <span class="mr-6"><i class="bx bx-edit"></i></span>
                  </button>
                  <button @click="deleteCrop (item.id)">
                    <span class="text-red-600"><i class="bx bx-trash"></i></span>
                  </button>
                </td>
              </tr>
            </tbody>
            <!-- table body end -->
            <!-- table footer start -->
            <tfoot class="bg-gray-200">
              <tr >
                <td colspan="6" class="p-3 border border-gray-400">
                  <div class="">
                    <TailwindPagination
                      :data="cropDetails"
                      @pagination-change-page="fetchCrops"
                    >
                  </TailwindPagination>
                  </div>
                </td>
              </tr>
            </tfoot>
            <!-- table footer end -->
          </table>
          <!-- table end -->
        </div>
        <!-- table container end -->
        <!-- collect data form start -->
        <div v-if="isVisible" class="center-form">
          <form @submit.prevent.self="addNewCrop" class="max-w-md mx-auto mb-8 bg-white p-8 rounded-lg shadow-lg">
            <div class="text-2xl font-bold mb-6 text-center text-primaryColor capitalize">
              <h1>add crop record</h1>
            </div>
            <div>
              <label for="crop_name" class="block text-lg font-semibold mb-2 capitalize">crop name</label>
              <input v-model="newCrop.crop_name" id="crop_name" class="w-full p-2 border border-gray-300 rounded outline-primaryColor placeholder:capitalize mb-4" type="text" name="" placeholder="enter crop name" required>
            </div>
            <div>
              <label for="crop_type" class="block text-lg font-semibold mb-2 capitalize">crop_type</label>
              <input v-model="newCrop.crop_type" id="crop_type" class="w-full p-2 border border-gray-300 rounded outline-primaryColor placeholder:capitalize mb-4" type="text" name="" placeholder="enter crop type" required>
            </div>
            <div>
              <label for="planting_date" class="block text-lg font-semibold mb-2 capitalize">planting date</label>
              <input v-model="newCrop.planting_date" id="planting_date" class="w-full p-2 border border-gray-300 rounded outline-primaryColor placeholder:capitalize mb-4" type="date" name="" placeholder="" required>
            </div>
            <div>
              <label for="total" class="block text-lg font-semibold mb-2 capitalize">harvesting date</label>
              <input v-model="newCrop.harvesting_date" id="total" class="w-full p-2 border border-gray-300 rounded outline-primaryColor placeholder:capitalize mb-4" type="date" name="" placeholder="" required>
            </div>
            <div class="flex justify-between">
              <button class="bg-primaryColor text-white capitalize px-4 py-2 rounded font-bold mt-4" type="submit">submit</button>
              <button @click="closeForm" class="bg-gray-300 text-gray-700 capitalize font-bold px-4 py-2 rounded mt-4">cancel</button>
            </div>
          </form>
        </div>
        <!-- collect data form end -->
        <!-- edit records form -->
        <div v-if="isFormVisible" class="fixed inset-0 bg-gray-800 bg-opacity-50 w-full flex items-center justify-center">
          <div class="bg-white p-8 max-w-md rounded-md">
            <h2 class="text-xl text-primaryColor font-bold mb-4">Edit Record</h2>
            <form @submit.prevent="saveChanges">
              <!-- form fields  -->
          <div class="mb-4">
            <label class="block text-sm font-bold text-black capitalize">crop name</label>
            <input v-model="newCrop.crop_name" type="text" class="mt-1 p-2 w-full border outline-primaryColor rounded-md">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-bold text-black capitalize">crop type</label>
            <input v-model="newCrop.crop_type" type="text" class="mt-1 p-2 w-full border outline-primaryColor rounded-md">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-bold text-black capitalize">planting date</label>
            <input v-model="newCrop.planting_date" type="date" class="mt-1 p-2 w-full border outline-primaryColor rounded-md">
          </div>
          <div class="mb-4">
            <label class="block text-sm font-bold text-black capitalize">harvesting date</label>
            <input v-model="newCrop.harvesting_date" type="date" class="mt-1 p-2 w-full border outline-primaryColor rounded-md">
          </div>
          <div class="flex justify-end">
            <button @click="closeEditForm" type="button" class="mr-2 rounded-sm bg-gray-300  text-gray-700 px-4 py-2">Cancel</button>
            <button type="submit" class="bg-primaryColor rounded-sm text-white px-4 py-2">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
    <!-- edit records form end -->
      </div>
    </main>
    <!-- main content end -->
  </div>
  <!-- content area end -->
</div>
<!-- page wrapper end -->
</template>
<script>
import Swal from 'sweetalert2/dist/sweetalert2.all.min.js';
import 'sweetalert2/dist/sweetalert2.min.css';
import { TailwindPagination } from 'laravel-vue-pagination';
// import { ref } from 'vue';

// const cropDetails = ref({});

export default {
  components: {
    TailwindPagination
  },
  data () {
    return {
      newCrop: {
        crop_name: '',
        crop_type: '',
        planting_date: '',
        harvesting_date: ''
      },
      cropDetails: {
        data: []
      },
      currentDateTime: '',
      formDropped: false,
      sidebarToggle: false,
      isVisible: false,
      isFormVisible: false,
      searchKeyword: '',
      newUser: {}
    }
  },
  mounted () {
    this.updateDateTime()
    setInterval(() => this.updateDateTime(), 1000)
    this.fetchCrops()
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

    // display edit form
    editFormVisible (item) {
      this.newCrop = { ...item }
      this.isFormVisible = true
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

    // display form method
    makeFormVisible () {
      this.isVisible = true
    },

    // close popup form method
    closeForm () {
      this.isVisible = false
      this.newCrop = {}
    },

    // close edit form method
    closeEditForm () {
      this.isFormVisible = false
      this.newCrop = {}
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

    // add record method
    async addNewCrop () {
      try {
        const response = await axios.post('/api/crops', this.newCrop)
        this.cropDetails.data.push(response.data.crops)
        this.closeForm()
        this.newCrop = { crop_name: '', crop_type: '', planting_date: '', harvesting_date: '' }

        await Swal.fire({
          title: "Added",
          text: "Record has been added successfully",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
      } catch (error) {
        console.error('error in adding item', error)
      }
    },

    // get crop data in the db method
    async fetchCrops (page = 1) {
      try {
        const response = await axios.get(`/api/crops?page=${page}`);
        this.cropDetails = response.data.crops
      } catch (error) {
        console.error('error fetching crops', error)
      }
    },

    // search records method
    async searchCrop () {
      try {
        let url = '/api/crops'

        if (this.searchKeyword.trim() !== '') {
          url += `/search/${this.searchKeyword}`
        } else {
          this.fetchCrops()
        }

        const response = await axios.get(url)
        this.cropDetails = response.data.crops
      } catch (error) {
        console.error('search failed', error)
      }
    },

    // save edited record method
    async saveChanges () {
      try {
        const response = await axios.put(`/api/crops/${this.newCrop.id}`, this.newCrop)
        this.cropDetails = response.data.crops
        this.closeEditForm()
        this.fetchCrops()

        await Swal.fire({
          title: "Updated",
          text: "Your record has been updated successfully",
          icon: "success",
          showConfirmButton: false,
          timer: 1500,
        });
      } catch (error) {
        console.error('record not saved', error)
      }
    }, 

    // delete record method
    async deleteCrop (id) {
      try {
        const result = await Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to recover this record",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Delete",
          confirmButtonColor: "#FF0000",
          cancelButtonText: "Cancel",
          cancelButtonColor: "#008000",
          reverseButtons: true
        });

        if (result.isConfirmed) {
          await axios.delete(`/api/crops/${id}`)
          this.cropDetails = this.cropDetails.data.filter(item => item.id !== id)
          this.fetchCrops()

          await Swal.fire({
            title: "Deleted!",
            text: "Your record has been deleted successfully.",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,   
          })
        }
      } catch (error) {
        console.error('failed to delete crop item', error)
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
    }
  }
}
</script>
<style>
</style>
