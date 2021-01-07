<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-4 mx-auto col-md-6 col-11">
        <div class="card login-box shadow-lg">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <img
                  src="../../assets/img/Vector-1.png"
                  alt=""
                  width="100%"
                  class="vector"
                />
              </div>
              <div class="col-12 text-center mb-5">
                <h2 class="mb-3">LOGIN</h2>
                <img
                  src="../../assets/img/Ilustrasi.png"
                  alt="Login"
                  width="250px"
                />
              </div>
              <div class="col-12">
                <form @submit.prevent="login">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="data.email"
                      id="email"
                      placeholder="Email"
                      :class="{ 'is-invalid': errors.email }"
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.email">{{
                      errors.email[0]
                    }}</small>
                  </div>
                  <div class="form-group">
                    <input
                      type="password"
                      class="form-control"
                      v-model="data.password"
                      id="password"
                      placeholder="Password"
                      :class="{ 'is-invalid': errors.password }"
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.password">{{
                      errors.password[0]
                    }}</small>
                  </div>
                  <button
                    type="submit"
                    :disabled="loading"
                    class="btn btn-block btn-primary my-3"
                  >
                    <div v-if="loading">
                      <b-spinner small type="grow"></b-spinner>
                      Loading...
                    </div>
                    <div v-else>Login</div>
                  </button>
                </form>
              </div>
              <div class="col-12 pt-2 text-center">
                <p>
                  Belum Melakukan Registrasi..??
                  <router-link :to="{ name: 'register' }"
                    >Silahkan Registrasi Terlebih Dahulu.</router-link
                  >
                </p>
              </div>
              <div class="col-12">
                <img
                  src="../../assets/img/Vector-2.png"
                  alt=""
                  width="100%"
                  class="vector"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations, mapState } from "vuex";
export default {
  data() {
    return {
      data: {
        email: "",
        password: "",
        remember_me: false,
      },
    };
  },
  created() {
    if (this.isAuth) {
      this.$router.push({ name: "dashboard" });
    }
  },
  computed: {
    ...mapGetters(["isAuth"]),
    ...mapState(["errors", "loading"]),
  },
  methods: {
    ...mapActions("auth", ["submit"]),
    ...mapMutations(["CLEAR_ERRORS"]),
    login() {
      this.submit(this.data).then(() => {
        if (this.errors.invalid) {
          this.$swal.fire({
            title: "Error",
            text: this.errors.invalid,
            icon: "error",
            timer: 3000,
          });
        }
        if (this.isAuth) {
          this.CLEAR_ERRORS();
          this.$router.push({ name: "dashboard" });
        }
      });
    },
  },
};
</script>

<style>
.container-fluid {
  background: #fff;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9;
}

.login-box {
  margin-top: 20px;
}

.login-box > .card-body > .row > .col-12 > h2 {
  color: #3456ff;
}

.login-box > .card-body > .row > .col-12 > form > div > input {
  border: none !important;
  border-radius: 10px !important;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  color: #3456ff !important;
  font-weight: bold !important;
}

.login-box
  > .card-body
  > .row
  > .col-12
  > form
  > div
  > input::-webkit-input-placeholder {
  color: #3456ff;
  font-weight: bold;
  opacity: 0.6;
}

.login-box
  > .card-body
  > .row
  > .col-12
  > form
  > div
  > input::-moz-input-placeholder {
  color: #3456ff;
  font-weight: bold;
  opacity: 0.6;
}

.login-box
  > .card-body
  > .row
  > .col-12
  > form
  > div
  > input::-o-input-placeholder {
  color: #3456ff;
  font-weight: bold;
  opacity: 0.6;
}

.login-box > .card-body > .row > .col-12 > form > button {
  background: linear-gradient(
    102.65deg,
    #5690ff 38.63%,
    #3456ff 67.43%
  ) !important;
  border-radius: 20px !important;
  box-shadow: 0px 0px 2px black;
  font-weight: bolder;
}

.vector {
  display: none;
}

@media only screen and (max-width: 600px) {
  .login-box {
    margin-top: 0 !important;
    border: none !important;
  }

  .vector {
    display: block;
  }
}
</style>