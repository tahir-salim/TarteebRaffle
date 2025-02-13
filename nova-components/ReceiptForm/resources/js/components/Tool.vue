<template>
  <div>
    <div class="text-center">
      <img src="/images/logo.png" style="height: 80px" />
    </div>
    <heading class="mb-6">Create Form</heading>
    <section v-if="isLoaded && countries.length">
      <form
        autocomplete="off"
        @submit.prevent="getCustomerDetails"
        @keydown="clearError($event.target.name)"
        id="get-detail"
      >
        <card class="nova-grid-card-styles">
          <section class="player-detail-section">
            <div class="flex px-4 border-b border-40 pb-6">
              <div class="w-1/3 mt-3 mr-2">
                <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label class="inline-block text-80 pt-2 pb-2 leading-tight"
                      >Select Country<label class="color-red">*</label></label
                    >
                  </div>
                  <div class="w-full" @click="form.cpr = null">
                    <select
                      class="w-full form-control form-select"
                      id="country"
                      v-model="form.country"
                      @change="removeError()"
                      placeholder="Select Country"
                    >
                      <option :value="selected" selected disabled>
                        Please Select
                      </option>
                      <option
                        v-for="list in countries"
                        v-bind:key="list.id"
                        v-bind:value="list"
                      >
                        {{ list.name  }} ({{list.phone_code}})
                      </option>
                    </select>
                    <span
                      class="help-text help-text mt-2 text-danger"
                      v-if="
                        frontEndError.country.required || hasError('country')
                      "
                      >The country field is required.</span
                    >
                  </div>
                </div>
              </div>
              <div class="w-1/3 mt-3 mr-2">
                <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label class="inline-block text-80 pt-2 pb-2 leading-tight"
                      >Phone<label class="color-red">*</label></label
                    >
                  </div>
                  <div
                    class="
                      w-full
                      form-control form-input form-input-bordered
                      flex
                      items-center
                      justify-center
                    "
                  >
                    <span>{{ countryCode }}</span>
                    <input
                      name="phone"
                      id="phone"
                      type="text"
                      placeholder="Phone"
                      required
                      :maxlength="
                        form && form.country && form.country.phone_digits
                      "
                      :minlength="
                        form && form.country && form.country.phone_digits
                      "
                      v-model="form.phone"
                      @keypress="isNumber($event)"
                      class="
                        w-full
                        form-control form-input form-input-bordered
                        custom-input
                      "
                    />
                  </div>
                </div>
                <span
                  class="help-text help-text mt-2 text-danger"
                  v-if="hasError('phone')"
                  v-text="getError('phone')"
                ></span>
                <span
                  class="help-text help-text mt-2 text-danger"
                  v-if="frontEndError.phone.required"
                  >The phone field in required</span
                >
                <span
                  class="help-text help-text mt-2 text-danger"
                  v-if="frontEndError.phone.incomplete"
                  >The phone must be
                  {{ form.country.phone_digits }} digits</span
                >
                <span
                  class="help-text help-text mt-2 text-danger"
                  v-if="frontEndError.phone.invalid"
                  >The phone is invalid</span
                >
              </div>
              <div class="w-1/3 mt-3 mr-2 flex justify-end items-end">
                <button
                  type="button"
                  class="btn btn-default btn-primary"
                  @click="getCustomerDetails()"
                >
                  Find Customer
                </button>
              </div>
            </div>
          </section>
        </card>
      </form>
    </section>

    <!-- Customer Details -->
    <section class="mt-11" v-if="oldCustomerData">
      <card class="nova-grid-card-styles">
        <div class="overflow-hidden overflow-x-auto relative" style="">
          <table
            cellpadding="0"
            cellspacing="0"
            data-testid="resource-table"
            class="table w-full table-default"
          >
            <thead>
              <tr>
                <th class="text-left">
                  <span
                    dusk="sort-receipt_number"
                    class="cursor-pointer inline-flex items-center"
                  >
                    Name
                  </span>
                </th>
                <th class="text-left"><span>CPR/Passport</span></th>
                <th class="text-left" v-if="oldCustomerData && oldCustomerData.nationality"><span>Nationality</span></th>
                <th class="text-left"><span>Email</span></th>
                <th class="text-left"><span>No. Of Entries</span></th>
                <th class="text-left">
                  <span
                    dusk="sort-purchase_date"
                    class="cursor-pointer inline-flex items-center"
                  >
                    No. of Receipt Entered
                  </span>
                </th>
                <th class="text-left"><span>View Detail</span></th>
              </tr>
            </thead>
            <tbody>
              <tr dusk="27-row">
                <td>
                  <div class="text-left text-left">
                    <span class="whitespace-no-wrap">
                      {{ oldCustomerData && oldCustomerData.name }}</span
                    >
                  </div>
                </td>
                <td>
                  <div class="text-left text-left">
                    <span class="whitespace-no-wrap">
                      {{ oldCustomerData && oldCustomerData.cpr }}</span
                    >
                  </div>
                </td>
                <td v-if="oldCustomerData && oldCustomerData.nationality">
                  <div class="text-left text-left">
                    <span class="whitespace-no-wrap">
                      {{ oldCustomerData && oldCustomerData.nationality && oldCustomerData.nationality.name}}</span
                    >
                  </div>
                </td>
                <td>
                  <div class="text-left text-left">
                    <span class="whitespace-no-wrap">
                      {{
                        (oldCustomerData && oldCustomerData.email) || "-"
                      }}</span
                    >
                  </div>
                </td>
                <td>
                  <div class="text-left text-left">
                    <span class="whitespace-no-wrap">
                      {{
                        oldCustomerData && oldCustomerData.raffle_entries_count
                      }}</span
                    >
                  </div>
                </td>
                <td>
                  <div class="text-left text-left">
                    <span class="whitespace-no-wrap">{{
                      oldCustomerData && oldCustomerData.receipts_count
                    }}</span>
                  </div>
                </td>
                <td>
                  <div class="text-left text-left">
                    <span
                      ><span
                        ><a
                          target="_blank"
                          :href="['/resources/customers/' + oldCustomerData.id]"
                          class="no-underline dim text-primary font-bold"
                        >
                          View
                        </a></span
                      ></span
                    >
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </card>
    </section>
    <!--add customer start here-->
    <section
      class="new-application pt-6"
      v-if="isLoaded && countries.length && showAddReceipt"
    >
      <form
        autocomplete="off"
        id="submit-receipt"
        @submit.prevent="addCustomer"
      >
        <card class="nova-grid-card-styles">
          <div
            class="flex px-4 border-b border-40 pb-6"
            v-if="!oldCustomerData"
          >
            <div class="w-1/2 mt-3 mr-2" v-if="!oldCustomerData">
              <div class="nova-grid-wrapper">
                <div class="nova-grid-field-label">
                  <label class="inline-block text-80 pt-2 pb-2 leading-tight"
                    >Full Name<label class="color-red">*</label></label
                  >
                </div>
                <div class="w-full">
                  <input
                    type="text"
                    placeholder="Full Name"
                    name="fullName"
                    v-model="form.name"
                    required
                    @change="removeError()"
                    class="w-full form-control form-input form-input-bordered"
                  />
                  <span
                    class="help-text help-text mt-2 text-danger"
                    v-if="frontEndError.fullName.required"
                    >Name is required</span
                  >
                </div>
              </div>
            </div>
            <div class="w-1/2 mt-3 mr-2" v-if="!oldCustomerData">
              <div class="nova-grid-wrapper">
                <div class="nova-grid-field-label">
                  <label class="inline-block text-80 pt-2 pb-2 leading-tight">
                    {{
                      form.country && form.country.country_code == "BH"
                        ? "CPR"
                        : "Passport Number"
                    }}<label class="color-red">*</label>
                  </label>
                </div>
                <div class="w-full">
                  <input
                    v-if="form.country && form.country.country_code == 'BH'"
                    dusk="cpr"
                    name="cpr"
                    id="cpr"
                    type="text"
                    placeholder="CPR"
                    maxlength="9"
                    required
                    @change="removeError()"
                    @keypress="isNumber($event)"
                    v-model="form.cpr"
                    v-on:blur="checkCprValidation()"
                    class="w-full form-control form-input form-input-bordered"
                  />
                  <input
                    v-if="form.country && form.country.country_code !== 'BH'"
                    id="passportNumber"
                    name="passportNumber"
                    type="text"
                    placeholder="Passport Number"
                    v-model="form.cpr"
                    @change="removeError()"
                    class="w-full form-control form-input form-input-bordered"
                  />
                  <span
                    class="help-text help-text mt-2 text-danger"
                    v-if="
                      hasError('cpr') &&
                      form.country &&
                      form.country.country_code == 'BH'
                    "
                    v-text="getError('cpr')"
                  ></span>
                  <span
                    class="help-text help-text mt-2 text-danger"
                    v-if="frontEndError.cpr.required"
                  >
                    {{
                      form.country && form.country.country_code == "BH"
                        ? ""
                        : "The Passport Number field is required."
                    }}
                  </span>
                  <span
                    class="help-text help-text mt-2 text-danger"
                    v-if="
                      frontEndError.cpr.incomplete &&
                      form.country &&
                      form.country.country_code == 'BH'
                    "
                    >The cpr should be 9 digitsss</span
                  >
                  <span
                    class="help-text help-text mt-2 text-danger"
                    v-if="
                      frontEndError.cpr.monthInvalid &&
                      form.country &&
                      form.country.country_code == 'BH'
                    "
                    >The cpr month is invalid.</span
                  >
                </div>
              </div>
            </div>
            <div class="w-1/2 mt-3 mr-2" v-if="!oldCustomerData">
             <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label class="inline-block text-80 pt-2 pb-2 leading-tight"
                      >Nationality<label class="color-red">*</label></label
                    >
                  </div>
                  <div class="w-full">
                    <select
                      class="w-full form-control form-select"
                      id="country"
                      v-model="form.nationality"
                      required
                      @change="removeError()"
                      placeholder="Select Nationality"
                    >
                      <option :value="selected" selected disabled>
                        Please Select
                      </option>
                      <option
                        v-for="list in countries"
                        v-bind:key="list.id"
                        v-bind:value="list.id"
                      >
                        {{ list.name  }}
                      </option>
                    </select>
                    <span
                      class="help-text help-text mt-2 text-danger"
                      v-if="
                        frontEndError.nationality.required || hasError('nationality')
                      "
                      >Nationality field is required.</span
                    >
                  </div>
                </div>
            </div>
            <div class="w-1/2 mt-3 mr-2" v-if="!oldCustomerData">
              <div class="nova-grid-wrapper">
                <div class="nova-grid-field-label">
                  <label class="inline-block text-80 pt-2 pb-2 leading-tight">
                    Email
                  </label>
                </div>
                <div class="w-full">
                  <input
                    type="email"
                    placeholder="Email"
                    v-model="form.email"
                    @change="removeError()"
                    class="w-full form-control form-input form-input-bordered"
                  />
                  <span
                    class="help-text help-text mt-2 text-danger"
                    v-if="frontEndError.email.required"
                    >Email is required</span
                  >
                </div>
              </div>
            </div>
          </div>
          <div v-for="(entry, index) in formData" :key="index">
            <div class="flex px-4 border-b border-40 pb-6">
              <div class="w-1/2 mt-3 mr-2">
                <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label for="shop" class="inline-block text-80 pt-2 pb-2 leading-tight"
                      >Select Shop<label class="color-red">*</label></label
                    >
                  </div>
                  <div class="w-full">
                    <select
                      class="w-full form-control form-select"
                      id="shop"
                      v-model="entry.shop"
                      placeholder="Select Shop"
                      @change="removeError()"
                      required
                    >
                      <option :value="null" selected disabled>
                        Select Shop
                      </option>
                      <option
                        v-for="list in shops"
                        v-bind:key="list.id"
                        v-bind:value="list"
                      >
                        {{ list.name }}
                      </option>
                    </select>
                    <span
                      class="help-text help-text mt-2 text-danger"
                      v-if="hasError('receipts.' + index + '.shop_id')"
                      v-text="getError('receipts.' + index + '.shop_id')"
                    ></span>
                  </div>
                </div>
              </div>
              <div class="w-1/2 mt-3 mr-2">
                <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label class="inline-block text-80 pt-2 pb-2 leading-tight">
                      Receipt Number<label class="color-red">*</label>
                    </label>
                  </div>
                  <div class="w-full">
                    <input
                      id="receipt"
                      :name="'receipt' + index"
                      type="text"
                      placeholder="Receipt Number"
                      required
                      @change="removeError()"
                      v-model="entry.receipt"
                      class="w-full form-control form-input form-input-bordered"
                    />
                    <span
                      class="help-text help-text mt-2 text-danger"
                      v-if="hasError('receipts.' + index + '.receipt_number')"
                      v-text="getError('receipts.' + index + '.receipt_number')"
                    ></span>
                  </div>
                </div>
              </div>

              <div class="w-1/2 mt-3 mr-2">
                <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label class="inline-block text-80 pt-2 pb-2 leading-tight">
                      Purchase Date<label class="color-red">*</label>
                    </label>
                  </div>
                  <div class="w-full">
                    <flat-pickr
                      v-model="entry.purchaseDate"
                      :config="config"
                      class="w-full form-control form-input-bordered"
                      id="purchasedate"
                      @change="removeError()"
                      placeholder="2022-04-14"
                      name="purchaseDate"
                      required
                    >
                    </flat-pickr>
                    <span
                      class="help-text help-text mt-2 text-danger"
                      v-if="hasError('receipts.' + index + '.purchase_date')"
                      v-text="'Purchase date is required'"
                    ></span>
                  </div>
                </div>
              </div>
            </div>

            <div
              class="
                flex
                px-4
                border-b border-40
                pb-6
                justify-between
                items-end
              "
            >
              <div class="w-1/3 mt-3 mr-2">
                <div class="nova-grid-wrapper">
                  <div class="nova-grid-field-label">
                    <label class="inline-block text-80 pt-2 pb-2 leading-tight">
                      Amount (in BD)<label class="color-red">*</label>
                    </label>
                  </div>
                  <div class="w-full">
                    <input
                      id="amount"
                      :name="'amount' + index"
                      type="text"
                      @keypress="isNumber($event)"
                      placeholder="Amount"
                      required
                      @change="removeError()"
                      v-model="entry.amount"
                      class="w-full form-control form-input form-input-bordered"
                    />
                    <span
                      class="help-text help-text mt-2 text-danger"
                      v-if="hasError('receipts.' + index + '.amount')"
                      v-text="getError('receipts.' + index + '.amount')"
                    ></span>
                  </div>
                </div>
              </div>
              <div
                class="flex items-center mt-6"
                v-if="isLoaded && countries.length"
              >
                <a
                  tabindex="0"
                  class="btn btn-link dim cursor-pointer text-80 ml-auto mr-6"
                  @click="removeRow(index)"
                   v-if="formData.length > 1"
                >
                  Delete
                </a>
                <button
                  type="button"
                  class="
                    btn btn-default btn-primary
                    inline-flex
                    items-center
                    relative
                  "
                  dusk="create-button"
                  v-if="index == formData.length - 1"
                  @click="addRow()"
                >
                  <span class=""> Add More Receipt </span>
                </button>
              </div>
            </div>
          </div>
        </card>
        <div class="flex items-center mt-6" v-if="isLoaded && countries.length">
          <a
            tabindex="0"
            class="btn btn-link dim cursor-pointer text-80 ml-auto mr-6"
            @click="onCancel()"
          >
            Cancel
          </a>
          <button
            type="submit"
            class="
              btn btn-default btn-primary
              inline-flex
              items-center
              relative
            "
            dusk="create-button"
          >
            <span class=""> Submit </span>
          </button>
        </div>
      </form>
    </section>
  </div>
</template>

<script>
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  components: {
    flatPickr,
  },
  metaInfo() {
    return {
      title: "ReceiptForm",
    };
  },
  data() {
    return {
      formConfig: { headers: { "Content-Type": "application/json" } },
      countries: [],
      shops: [],
      countryCode: null,
      isLoaded: false,
      oldCustomerData: null,
      showAddReceipt: false,
      formData: [
        {
          shop: null,
          receipt: null,
          purchaseDate: null,
          amount: null,
          error: "",
        },
      ],
      form: {
        country: null,
        phone: null,
        name: null,
        cpr: null,
        email: null,
        shopName: null,
        purchaseDate: null,
        receiptNumber: null,
        amount: null,
      },
      frontEndError: {
        country: {
          required: false,
        },
        nationality: {
          required: false,
        },
        phone: {
          required: false,
          incomplete: false,
          invalid: false,
        },
        cpr: {
          required: false,
          incomplete: false,
          monthInvalid: false,
          duplicate: false,
        },
        purchaseDate: {
          required: false,
        },
        fullName: {
          required: false,
        },
        email: {
          required: false,
        },
        shop: {
          required: false,
        },
        receiptNumber: {
          required: false,
        },
        purchaseDate: {
          required: false,
        },
        amount: {
          required: false,
        },
      },
      errors: {},
      config: {
        dateFormat: "Y-m-d",
        readonly: false,
        maxDate: new Date(),
      },
    };
  },
  mounted() {
    this.getCountries();
    if (!this.showAddReceipt) {
      document
        .getElementById("get-detail")
        .addEventListener("keyup", function (event) {
          if (event.code === "Enter") {
            event.preventDefault();
            document.querySelector("form").submit();
          }
        });
    }
    if (this.showAddReceipt) {
      document
        .getElementById("submit-receipt")
        .addEventListener("keyup", function (event) {
          if (event.code === "Enter") {
            event.preventDefault();
            document.querySelector("form").submit();
          }
        });
    }
  },
  methods: {
    getCountries: function () {
      Nova.request()
        .get("/nova-vendor/receipt-form/init")
        .then(
          (response) => {
            this.isLoaded = true;
            if (response.data) {
              this.countries = response.data.countries;
              this.form.country = this.countries.find(
                (el) => el.country_code == "BH"
              );
              this.countryCode = this.form.country.phone_code;
              this.shops = response.data.shops;
              this.form.shopName = response.data.shops[0];
            }
          },
          (error) => {}
        );
    },

    onCancel: function () {
      window.history.back();
    },

    addRow: function () {
      this.formData.push({
        shop: "",
        receipt: "",
        purchaseDate: "",
        amount: "",
      });
      console.log(this.formData);
    },

    removeRow: function (index) {
      if (index !== -1) {
        this.formData.splice(index, 1);
      }
    },

    getCustomerDetails: function () {
      let error = false;
      if (
        this.form.country == undefined ||
        this.form.country == null ||
        this.form.country == ""
      ) {
        this.frontEndError.country.required = true;
        this.$toasted.show("The Country is not Selected", { type: "error" });
        error = true;
      } else {
        this.frontEndError.country.required = false;
      }
      if (
        this.form.phone == undefined ||
        this.form.phone == null ||
        this.form.phone == ""
      ) {
        this.frontEndError.phone.required = true;
        this.$toasted.show("Please enter the customer phone", {
          type: "error",
        });
        error = true;
      } else {
        this.frontEndError.phone.required = false;
      }
      if (
        this.form.phone &&
        this.form.phone.length != this.form.country.phone_digits
      ) {
        this.frontEndError.phone.incomplete = true;
        error = true;
      } else {
        this.frontEndError.phone.incomplete = false;
      }

      if (error) {
        return;
      }
      let data = new FormData();
      data.append("phone", this.form.country.phone_code + this.form.phone);
      Nova.request()
        .post("/nova-vendor/receipt-form/customer", data, this.formConfig)
        .then(
          (response) => {
            this.showAddReceipt = true;
            if (response.data.data) {
              this.oldCustomerData = response.data.data;
              if (this.oldCustomerData.name) {
                this.form.name = this.oldCustomerData.name;
              }
              if (this.oldCustomerData.email) {
                this.form.email = this.oldCustomerData.email;
              }
              if (this.oldCustomerData.cpr) {
                this.form.cpr = this.oldCustomerData.cpr;
              }
              if(this.oldCustomerData.nationality){
                this.form.nationality = this.oldCustomerData.nationality;
                this.oldCustomerData.nationality = this.countries.find(el=>el.id == this.oldCustomerData.nationality)
              }
              if(this.oldCustomerData.country_id && !this.oldCustomerData.nationality){
               this.oldCustomerData.nationality = this.countries.find(el=>el.id == this.oldCustomerData.country_id)
              }
              console.log(this.oldCustomerData);
            } else {
              this.$toasted.show("No record found", {
                type: "error",
              });
              this.form.name = null;
              this.form.email = null;
              this.form.cpr = null;
              this.oldCustomerData = null;
            }
          },
          (error) => {}
        );
    },

    addCustomer() {
      let error = false;
      if (!this.form.name) {
        this.frontEndError.fullName.required = true;
        error = true;
      }
      if (!this.form.cpr) {
        this.frontEndError.cpr.required = true;
        this.checkCprValidation();
        error = true;
      }
      if (
        this.form.country == undefined ||
        this.form.country == null ||
        this.form.country == ""
      ) {
        this.frontEndError.country.required = true;
        this.$toasted.show("The Country is not Selected", { type: "error" });
        error = true;
      } else {
        this.frontEndError.country.required = false;
      }
      if (
        this.form.phone == undefined ||
        this.form.phone == null ||
        this.form.phone == ""
      ) {
        this.frontEndError.phone.required = true;
        this.$toasted.show("Please enter the customer phone", {
          type: "error",
        });
        error = true;
      } else {
        this.frontEndError.phone.required = false;
      }
      if (
        this.form.phone &&
        this.form.phone.length != this.form.country.phone_digits
      ) {
        this.frontEndError.phone.incomplete = true;
        error = true;
      } else {
        this.frontEndError.phone.incomplete = false;
      }
      if (error) {
        return;
      }
      this.checkCprValidation();
      console.log(error,this.form.nationality);
      let customerData = {
        country_id: this.form.country.id,
        nationality: this.form.nationality,
        customer_id: this.oldCustomerData ? this.oldCustomerData.id : null,
        name: this.form.name,
        cpr: this.form.cpr,
        phone: this.form.country.phone_code + this.form.phone,
        email: this.form.email || null,
        receipts: [],
      };
      customerData.receipts = this.formData.map((el) => {
        return {
          shop_id: el.shop.id,
          receipt_number: el.receipt,
          purchase_date: el.purchaseDate,
          amount: el.amount,
        };
      });
      console.log(customerData);
      console.log(this.form);
      Nova.request()
        .post(
          "/nova-vendor/receipt-form/create-receipt",
          customerData,
          this.formConfig
        )
        .then((response) => {
          if (
            response.data.status == "error" &&
            response.data.message == "Receipt already exists"
          ) {
            this.$toasted.show(response.data.message, {
              type: "error",
            });
          }
          if (
            response.data.status == "error" &&
            response.data.message.includes("Amount should be greater")
          ) {
            this.$toasted.show(response.data.message, {
              type: "error",
            });
          }
          if (
            response.data.status == "error" &&
            response.data.message == 'Receipt should be unique per shop'
          ) {
            this.$toasted.show(response.data.message, {
              type: "error",
            });
          }

          if (response.data.status == "success" && response.data.data) {
            this.$toasted.show("Record inserted successfully", {
              type: "success",
            });
            setTimeout(() => {
              window.location.reload();
            }, 200);
          }
          console.log(response);
        })
        .catch((error) => {
          console.log("errors:", error);
          if (error.response) {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
              this.$toasted.show("Some Fields are missing", { type: "error" });
            } else if (error.response.status == 413) {
              this.$toasted.show(
                "Some fields may be invalid or file size may be too large",
                { type: "error" }
              );
            } else {
              this.$toasted.show("Server Error", { type: "error" });
            }
          } else if (error.request) {
            console.log("request:", error.request);
            this.$toasted.show("Server not responding", { type: "error" });
          } else {
            console.log("else Error", error.message);
            this.$toasted.show(
              error.message || "Error in request, please contact to support",
              { type: "error" }
            );
          }
        });
    },

    removeError() {
      this.countryCode = this.form.country.phone_code;
      if ((this.frontEndError.country.required = true)) {
        this.frontEndError.country.required = false;
      }
      if ((this.frontEndError.fullName.required = true)) {
        this.frontEndError.fullName.required = false;
      }
      if ((this.frontEndError.shop.required = true)) {
        this.frontEndError.shop.required = false;
      }
      if ((this.frontEndError.receiptNumber.required = true)) {
        this.frontEndError.receiptNumber.required = false;
      }
      if ((this.frontEndError.purchaseDate.required = true)) {
        this.frontEndError.purchaseDate.required = false;
      }
      if ((this.frontEndError.amount.required = true)) {
        this.frontEndError.amount.required = false;
      }
      if ((this.frontEndError.email.required = true)) {
        this.frontEndError.email.required = false;
      }
      console.log(this.form.country.country_code);
      if (this.form && this.form.country.country_code !== "BH") {
        // this.frontEndError.cpr.required = false;
        this.frontEndError.cpr.incomplete = false;
        this.frontEndError.cpr.monthInvalid = false;
        this.frontEndError.cpr.duplicate = false;
      }
      if ((this.frontEndError.cpr.required = true)) {
        this.frontEndError.cpr.required = false;
      }
    },

    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      let charCode = evt.which ? evt.which : evt.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    //    Validation methods
    hasError(field) {
      return this.errors.hasOwnProperty(field);
    },
    anyError() {
      return Object.keys(this.errors).length > 0;
    },
    getError(field) {
      if (this.errors[field]) {
        return this.errors[field][0];
      }
    },
    recordError(errors) {
      this.errors = errors;
    },
    createError(field, msg) {
      if (Object.keys(this.errors).length === 0) {
        this.errors = {};
      }
      this.errors[field] = [msg];
    },
    clearError(field) {
      if (field) {
        delete this.errors[field];
        if (Object.keys(this.errors).length === 0) {
          this.errors = {};
        }
        if (this.frontEndError[field]) {
          for (let prop in this.frontEndError[field]) {
            this.frontEndError[field][prop] = false;
          }
        }
        return;
      }
    },
    checkCprValidation() {
      let cpr = null;
      if (this.form && this.form.country.country_code == "BH") {
        this.clearError("cpr");
        cpr = this.form.cpr;
        if (cpr === "" || cpr === null || cpr === undefined) {
          // if cpr is undefined
          this.createError("cpr", "The cpr field is Required");
          this.$toasted.show("The cpr field is Required", { type: "error" });
          return;
        }
        if (
          this.form &&
          this.form.country.country_code == "BH" &&
          cpr.length < 9
        ) {
          // if cpr is in complete
          this.createError("cpr", "The cpr should be 9 digit.");
          this.$toasted.show("The cpr should be 9 digit.", { type: "error" });
          return;
        }
        let cprMonth = cpr.slice(2, 4);
        if (cprMonth > 12 || cprMonth < 1) {
          this.createError("cpr", "The cpr month is not valid");
          this.$toasted.show("CPR Month is not valid", { type: "error" });
          return;
        }
      }
    },
  },
};
</script>

<style>
/* Scoped Styles */
</style>
