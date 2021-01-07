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
                <h3 class="mb-3">REGISTRASI SAKSI</h3>
                <img
                  src="../../assets/img/Ilustrasi.png"
                  alt="Login"
                  width="250px"
                />
              </div>
              <div class="col-12">
                <form @submit.prevent="register">
                  <div class="form-group">
                    <select
                      class="form-control"
                      id="tps_id"
                      v-model="data.tps_id"
                      :disabled="loading"
                    >
                      <option value="">-- Pilih TPS --</option>
                      <option
                        v-for="(tps, index) in tps"
                        :key="index"
                        :value="tps.id"
                      >
                        {{ tps.tps }} - {{ tps.hamlet }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="data.nik"
                      id="nik"
                      placeholder="NIK"
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.nik">{{
                      errors.nik[0]
                    }}</small>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="data.name"
                      id="name"
                      placeholder="Nama Lengkap"
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.name">{{
                      errors.name[0]
                    }}</small>
                  </div>
                  <div class="form-group">
                    <input
                      v-model="data.address"
                      id="address"
                      class="form-control"
                      placeholder="Alamat"
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.address">{{
                      errors.address[0]
                    }}</small>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="data.wa"
                      id="wa"
                      placeholder="WA/Telepon"
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.wa">{{
                      errors.wa[0]
                    }}</small>
                  </div>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="data.email"
                      id="email"
                      placeholder="Email"
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
                      :disabled="loading"
                    />
                    <small class="text-danger" v-if="errors.password">{{
                      errors.password[0]
                    }}</small>
                  </div>
                  <div class="form-group">
                    <input
                      type="file"
                      class="form-control-file"
                      id="photo_ktp"
                      v-on:change="onPhotoChange"
                      :disabled="loading"
                    />
                    <div v-if="loadingPhoto" class="my-3 text-center">
                      <b-spinner
                        variant="primary"
                        label="Large Spinning"
                        style="width: 5rem; height: 5rem"
                      ></b-spinner>
                    </div>
                    <div v-if="data.photo_ktp" class="my-3 text-center">
                      <img :src="data.photo_ktp" alt="Foto KTP" width="250px" />
                    </div>
                    <small class="text-info my-2"
                      >Masukan Foto KTP anda Dengan Ukuran File Kecil.</small
                    >
                    <br />
                    <small class="text-danger" v-if="errors.photo_ktp">{{
                      errors.photo_ktp[0]
                    }}</small>
                  </div>
                  <button
                    type="submit"
                    class="btn btn-block btn-primary mt-5 mb-3"
                  >
                    <div v-if="loading">
                      <b-spinner small type="grow" v-if="loading"></b-spinner>
                      Loading...
                    </div>
                    <div v-else>Registrasi</div>
                  </button>
                </form>
              </div>
              <div class="col-12 pt-2 text-center">
                <p>
                  Sudah Melakukan Registrasi..??
                  <router-link :to="{ name: 'login' }"
                    >Silahkan Login.</router-link
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
import $axios from "../../api/index";
export default {
  data() {
    return {
      tps: [],
      data: {
        tps_id: "",
        nik: "",
        name: "",
        address: "",
        wa: "",
        photo_ktp: "",
        photo_name: "",
        email: "",
        password: "",
      },
      errors: [],
      loading: false,
      loadingPhoto: false,
    };
  },
  created() {
    $axios.get("/tps").then((response) => {
      this.tps = response.data.data;
    });
  },
  methods: {
    onPhotoChange(e) {
      this.loadingPhoto = true;
      let files = e.target.files || e.dataTransfer.files;
      this.createPhoto(files[0]);
    },
    createPhoto(file) {
      this.data.photo_name = file.name;
      let reader = new FileReader();
      reader.onload = (e) => {
        this.loadingPhoto = false;
        this.data.photo_ktp = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    clearData() {
      this.data.tps_id = "";
      this.data.nik = "";
      this.data.name = "";
      this.data.address = "";
      this.data.wa = "";
      this.data.photo_ktp = "";
      this.data.photo_name = "";
      this.data.email = "";
      this.data.password = "";
    },
    register() {
      this.loading = true;
      $axios
        .post("/register", this.data)
        .then((response) => {
          this.loading = false;
          if (response.data.success) {
            this.clearData();
            this.$swal.fire({
              title: "Sukses",
              text: response.data.message,
              icon: "success",
              timer: 5000,
            });
          } else {
            this.$swal.fire({
              title: "Error",
              text: response.data.message,
              icon: "error",
              timer: 5000,
            });
          }
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
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
  z-index: 9;
}

.login-box {
  margin-top: 50px;
}

.login-box > .card-body > .row > .col-12 > h3 {
  color: #3456ff;
}

.login-box > .card-body > .row > .col-12 > form > div > input,
select {
  border: none !important;
  border-radius: 10px !important;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  color: #3456ff !important;
  font-weight: bold !important;
  height: 40px;
}

.login-box > .card-body > .row > .col-12 > form > div > input[type="file"] {
  box-shadow: none !important;
  margin-top: 30px !important;
}

.login-box
  > .card-body
  > .row
  > .col-12
  > form
  > div
  > input::-webkit-input-placeholder,
select::-webkit-input-placeholder {
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
  > input::-moz-input-placeholder,
select::-moz-input-placeholder {
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
  > input::-o-input-placeholder,
select::-o-input-placeholder {
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