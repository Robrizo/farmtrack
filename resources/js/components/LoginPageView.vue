<template>
    <!-- page wrapper start -->
    <div class="flex h-screen overflow-hidden items-center justify-center bg-image">
        <!-- form container start -->
        <div class="m-6">
            <form @submit.prevent="handleLogin" class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="text-3xl text-center text-primaryColor font-bold mb-10 capitalize">
                    <h1>farm<span class="text-gray-800">Track</span></h1>
                </div>
                <div class="mb-6">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bx bx-envelope"></i>
                        </span>
                        <input v-model="email" class="border w-full py-3 px-3 pl-8 leading-tight focus:shadow-outline outline-primaryColor" type="email" placeholder="youremail@mail.com" required>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bx bx-lock"></i>
                        </span>
                        <input v-model="password" class="border w-full py-3 px-3 pl-8 leading-tight focus:shadow-outline outline-primaryColor" :type="showPassword ? 'text' : 'password'" placeholder="••••••••" required>
                        <span @click="makePasswordVisible" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-400 ">
                            <i :class="showPassword ? 'bx bx-hide' : 'bx bx-show'"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-6">
                    <button class="w-full bg-primaryColor hover:opacity-90 text-white text-lg font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase" type="submit">login</button>
                </div>
                <div class="text-center text-lg">
                    <p>
                        For support contact <a href="#" class="text-primaryColor capitalize hover:underline">systems administrator</a>
                    </p>
                </div>
            </form>
        </div>
        <!-- form container end -->
    </div>
    <!-- page wrapper end -->
</template>
<script>
import Swal from 'sweetalert2/dist/sweetalert2.all.min.js';
import 'sweetalert2/dist/sweetalert2.min.css';
import AuthService from '@/components/AuthService.vue'

export default {
  data () {
    return {
      showPassword: false,
      email: '',
      password: ''
    }
  },
  methods: {
    // show or hide password method
    makePasswordVisible () {
      this.showPassword = !this.showPassword
    },

    // handle login function
    async handleLogin () {
        try {
            const { token, user, redirect } = await AuthService.login(this.email, this.password);

            console.log('login successful', token, user);

            if (redirect) {
                this.$router.push(redirect);
            }

            // sweetAlert successful login
            await Swal.fire({
                position: 'top-end',
                // icon: 'success',
                title: 'Login successful',
                showConfirmButton: false,
                timer: 1500
            });
        } catch (error) {
            console.error('Login failed', error.message);

            //sweetAlert failed login
            await Swal.fire({
                // icon: 'error',
                title: 'Login failed',
                text: 'Invalid email or password',
                confirmButtonColor: '#008000'
            })
        }
    }
  }
}
</script>
<style scoped>
.bg-image {
  background: linear-gradient(rgba(0,128,0,0.2),rgba(0,128,0,0.6)) ,url('../../images/background.jpg') center/cover no-repeat fixed;
}
</style>
