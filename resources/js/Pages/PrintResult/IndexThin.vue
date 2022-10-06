<template>
  <app-layout title="Print Thinprep">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="text-right text-red-600" v-if="errors">
          <p v-for="(er, i) in errors" :key="i">
            {{ er }}
          </p>
        </div>
        <div class="grid grid-cols-1 mb-2">
          <div class="flex flex-1 justify-between">
            <div class="flex flex-row">
              <!-- <a
                :href="route('downloadPDF', checkPrint)"
                class="
                  bg-green-800
                  py-1
                  px-2
                  rounded-md
                  text-white
                  cursor-pointer
                  h-8
                "
                target="blank"
                >Export PDF
                <span class="text-xs m-0"
                  >({{ checkPrint ? checkPrint.length : 0 }})</span
                ></a
              > -->
              <!-- <button @click="multiPrint(checkPrint)"  class="ml-2 bg-green-600 px-2 py-0 rounded-md float-right cursor-pointer h-8 text-white">Print Multi<span class="text-xs ml-1">({{checkPrint?checkPrint.length:0}})</span></button> -->
              <a
                :href="route('printMutiThin', checkPrint)"
                class="
                  ml-4
                  bg-blue-800
                  py-1
                  px-2
                  rounded-md
                  text-white
                  cursor-pointer
                  h-8
                "
                target="blank"
                >PrintMulti
                <span class="text-xs m-0"
                  >({{ checkPrint ? checkPrint.length : 0 }})</span
                ></a
              >
            </div>
            <div class="flex flex-row w-56 px-4 text-center">
              <a :href="route('exportDsThin',{'startDate':startDate,'endDate':endDate,'ousentFill':ousentFill,'nametestFill':nametestFill})"
               class="py-2 flex flex-row justify-center bg-green-500 text-white w-full rounded-md mr-2" >
                <span class="w-full">Export DS trả KQ </span>
              </a>
            </div>
          </div>

        </div>
        <!---/////==================------->
        <!---==================------->
        <hr class="mb-2" />
        <div class="flex justify-between">
          <div class="">
            <div class="flex flex-row">
              <div class="">
                <span>ĐV gửi mẫu:</span>
              </div>
              <div class=" w-52">
                <select
                  name="testgroup"
                  id="testgroup"
                  class="block py-0 w-full form-input h-8 rounded-lg text-md bg-green-300"
                  v-model="ousentFill"
                >
                  <option value="">All</option>
                  <option v-for="(ous, i) in ousents" :key="i" :value="ous.id">
                    {{ ous.id }} - {{ ous.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class=" mx-2">
            <div class="flex flex-grow">
              <div class="">
                <span>BS đọc KQ(ĐV đọc KQ):</span>
              </div>
              <div class=" w-52">
                <select
                  name="testgroup"
                  id="testgroup"
                  class="block py-0 w-full form-input h-8 rounded-lg text-md"
                  v-model="readcodeFill"
                >
                  <option value="">All</option>
                  <option
                    v-for="(rcd, i) in readcodes"
                    :key="i"
                    :value="rcd.read_code"
                  >
                    {{ rcd.name }} ({{ rcd.read_code }})
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="">
            <div class="flex flex-row">
              <div class="flex flex-row">
                <span>Từ:</span>

                <div class="flex flex-row">
                  <jet-input
                    id="startDate"
                    type="date"
                    class="h-8 block w-full bg-green-300"
                    v-model="startDate"
                    autocomplete="startDate"
                  />
                </div>
              </div>
              <div class="flex flex-row ml-2">
                <span>Đến:</span>

                <jet-input
                  id="endDate"
                  type="date"
                  class="h-8 block w-full bg-green-300"
                  v-model="endDate"
                  autocomplete="endDate"
                />
              </div>
            </div>
          </div>

          <div class=" text-right">
            <button
              @click="getPageFill"
              class="
                px-4
                ml-2
                py-2
                justify-auto
                text-white
                font-bold
                bg-blue-400
                rounded-md
                text-sm
                h-8
              "
            >
              Fill
            </button>
            <button
              @click="refreshFill"
              class="
                px-2
                mx-2
                py-2
                justify-auto
                text-white
                font-bold
                bg-yellow-400
                rounded-md
                text-sm
                h-8
              "
            >
              Refresh
            </button>
          </div>
        </div>
        <hr class="mt-2" />
        <!---==================------->
        <div class="flex justify-between mt-2 my-1">
          <div class="bg-blue-100">
            <div class="text-right">
              <div class="flex mb-2 text-right h-8 px-2">
                <jet-input
                  required
                  id="search"
                  type="text"
                  class="mt-1 block w-full h-8 mr-2"
                  autocomplete="search"
                  v-model="termSearch"
                  @keyup="search"
                />
                <span
                  class="
                    justify-center justify-items-center
                    mt-2
                    cursor-pointer
                  "
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                  </svg>
                </span>
              </div>
            </div>
          </div>
          <div class="">
            <div class="p-0 text-right rounded-sm">
              <div class="flex flex-row justify-end">
                <jet-label
                  class="text-right text-bold text-lg pr-1"
                  for="testgroup"
                  value="perPage:"
                />
                <select
                  name="perPage"
                  id="perPage"
                  class="block py-0 w-24 form-input h-8 rounded-lg"
                  v-model="perPage"
                  @change="getfilePerpage"
                >
                  <option value="1">1</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="150">150</option>
                  <option value="200">200</option>
                  <option value="250">250</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!---//////////==================------->
        <Table :headers="headers" :addClass="addClass" id="exportMe">
          <tr>
            <td class="text-sm font-bold" colspan="2">
              <input
                class="mr-2"
                type="checkbox"
                v-model="allSelected"
                @click="checkAll"
              />CheckAll
            </td>
          </tr>
          <tr
            class="hover:bg-gray-300"
            v-for="(bill, i) in billtests.data"
            :key="i"
          >
            <td>
              <input type="checkbox" :value="bill.id" v-model="checkPrint" />
            </td>
            <td class="border-r-2 text-center">{{ bill.id }}</td>
            <td class="border-r-2 text-center font-bold">{{ bill.thinprep_code }}</td>
            <td class="border-r-2">{{ bill.custommer.name }}</td>
            <td class="border-r-2">
              <span v-if="bill.custommer.gender == 0">Nữ</span>
              <span v-else>Nam</span>
            </td>
            <td class="border-r-2">{{ bill.custommer.birthday }}</td>
            <td class="border-r-2 text-center">
              <span v-if="bill.custommer">{{ bill.custommer.address }}, </span>
              <span v-if="bill.custommer.ward">{{ bill.custommer.ward.name }}, </span>
              <span v-if="bill.custommer.district">{{bill.custommer.district.name}}, </span>
              <span v-if="bill.custommer.province"
                >{{ bill.custommer.province.title }}.
                {{ bill.custommer.province.name }}</span
              >
            </td>
            <td class="border-r-2 text-center" v-if="bill.phone !== null">
              {{ bill.custommer.phone }}
            </td>
            <td class="border-r-2 text-center" v-else></td>
            <td class="border-r-2 text-center">
              <span
                class="text-green-800"
                v-for="(tn, i) in bill.testnames"
                :key="i"
              >
                {{ tn.name }},
              </span>
            </td>

            <td class="border-r-2">
              <span>{{ bill.doctor_indi }}</span>
            </td>
            <td class="border-r-2 text-sm w-40 text-blue-700">
              <span v-if="bill.ousent">{{ bill.ousent.name }}</span>
            </td>
            <td class="border-r-2 text-center">
              <span class="text-center">
                {{ formatDate(bill.date_receive) }}
              </span>
            </td>
            <td class="border-r-2">
              <span>{{ bill.read_code }}</span>
            </td>
            <td class="border-r-2">
              <span v-if="bill.imageleft" class="flex justify-center">
                <AppImageView
                  :imageUrl="pathThinLeft + bill.imageleft.thinLeft"
                />
              </span>
              <span v-else> - </span>
            </td>
            <td class="border-r-2">
              <span v-if="bill.imageleft">
                <AppImageView
                  :imageUrl="pathThinRight + bill.imageleft.thinRight"
                />
              </span>
              <span v-else> - </span>
            </td>
            <td class="border-r-2">
              <span v-for="(rs, i) in bill.results" :key="i">
                <span v-if="rs.element_id == 26" class="text-red-600">
                  {{ rs.result }},
                </span>
              </span>
            </td>

            <td class="border-r-2">{{ bill.userupdate_id }}</td>
            <td class="border-r-2 w-32">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Print"
                  class="text-gray-600"
                  @click="printResult(bill)"
                >
                  <svg
                    class="h-8 w-8"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                    />
                  </svg>
                </EditBtn>
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
          <div class="flex">
            <Pagination :links="billtests.links" />
          </div>
        </div>

        <DialogModal
          :show="showModlPrint"
          class="mb-0 pb-0 bg-green-700"
          :bgHeader="editMode ? bgEdit : bgSave"
          :maxWidth="maxWidth"
        >
          <template v-slot:content>
            <div class="text-right w-full flex-row justify-items-between">
              <button
                class="
                  px-4
                  rounded-md
                  mb-1
                  mr-1
                  bg-gray-800
                  text-white
                  cursor-pointer
                  text-md
                  py-1
                  hover:bg-gray-600
                "
                type=""
                @click="printDiv('printMe')"
              >
                Print
              </button>
              <button
                @click="closeModalPrint"
                class="
                  text-white text-md
                  bg-green-500
                  px-2
                  py-1
                  rounded-md
                  hover:bg-green-300
                "
              >
                Close
              </button>
            </div>
            <div v-if="printOutsent.form_group == 1">
              <PrintviewTudu
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :pathImageLeft="pathImageLeft"
                :pathLogo="pathLogo"
                :pathThinLeft="pathThinLeft"
                :pathThinRight="pathThinRight"
                :selectedArray="selectedArray"
                :ketluan="ketluan"
                :currentDate="currentDate()"
                :imageThinLeft="imgeLeft"
                :imageThinRight="imageRight"
                :doctorread="doctorread"
                :imageGGSqure="imageGGSqure"
                :imagePathBackground="imagePathBackground"
                :eurolab="eurolab"
                :pathLogoEuro="pathLogoEuro"

              />
            </div>
            <div v-if="printOutsent.form_group == 2">
              <PrintviewSaigon
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathImageLeft="pathImageLeft"
                :pathThinLeft="pathThinLeft"
                :pathThinRight="pathThinRight"
                :imageThinRight="imageRight"
                :ketluan="ketluan"
                :currentDate="currentDate()"
                :imageThinLeft="imgeLeft"
                :doctorread="doctorread"
                :pathLogo="pathLogo"
                :imagePathBackground="imagePathBackground"
                :pathLogoEuro="pathLogoEuro"
                :eurolab="eurolab"
              />
            </div>
            <div v-if="printOutsent.form_group == 3">
              <PrintviewMekong
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathThinLeft="pathThinLeft"
                :ketluan="ketluan"
                :pathImageLeft="pathImageLeft"
                :imageThinRight="imageRight"
                :pathThinRight="pathThinRight"
                :currentDate="currentDate()"
                :imageThinLeft="imgeLeft"
                :doctorread="doctorread"
                :pathLogo="pathLogo"
                :imageGGSqure="imageGGSqure"
                :imagePathBackground="imagePathBackground"
                :eurolab="eurolab"
                :pathLogoEuro="pathLogoEuro"
              />
            </div>
            <div v-if="printOutsent.form_group == 4">
              <PrintviewVigor
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathThinLeft="pathThinLeft"
                :ketluan="ketluan"
                :pathImageLeft="pathImageLeft"
                :imageThinRight="imageRight"
                :pathThinRight="pathThinRight"
                :currentDate="currentDate()"
                :imageThinLeft="imgeLeft"
                :doctorread="doctorread"
                :pathLogo="pathLogo"
                :imagePathBackground="imagePathBackground"
                :pathLogoEuro="pathLogoEuro"
                :eurolab="eurolab"
              />
            </div>

            <div v-if="printOutsent.form_group == 5">
              <PrintviewErolab
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathThinLeft="pathThinLeft"
                :ketluan="ketluan"
                :logo="logo"
                :pathLogo="pathLogo"
                :pathImageLeft="pathImageLeft"
                :pathThinRight="pathThinRight"
                :imageThinLeft="imgeLeft"
                :imageThinRight="imageRight"
                :currentDate="currentDate()"
                :doctorread="doctorread"
                :imagePathBackground="imagePathBackground"
                :eurolab="eurolab"
                :pathLogoEuro="pathLogoEuro"
                :imageGGSqure="imageGGSqure"
              />
            </div>
            <div v-if="printOutsent.form_group == 6">
              <PrintviewDHYD
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathThinLeft="pathThinLeft"
                :ketluan="ketluan"
                :logo="logo"
                :pathLogo="pathLogo"
                :pathImageLeft="pathImageLeft"
                :pathThinRight="pathThinRight"
                :imageThinLeft="imgeLeft"
                :imageThinRight="imageRight"
                :currentDate="currentDate()"
                :doctorread="doctorread"
                :imagePathBackground="imagePathBackground"
                :imageGGSqure="imageGGSqure"
                :eurolab="eurolab"
                :pathLogoEuro="pathLogoEuro"
              />
            </div>
            <div v-if="printOutsent.form_group == null">
              <PrintviewGenaral
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathThinLeft="pathThinLeft"
                :ketluan="ketluan"
                :logo="logo"
                :pathLogo="pathLogo"
                :pathImageLeft="pathImageLeft"
                :pathThinRight="pathThinRight"
                :imageThinLeft="imgeLeft"
                :imageThinRight="imageRight"
                :currentDate="currentDate()"
                :doctorread="doctorread"
                :pathLogoEuro="pathLogoEuro"
                :eurolab="eurolab"
              />
            </div>
          </template>
        </DialogModal>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import Table from "@/Components/Table";
import Pagination from "@/Components/Pagination";

import AppImageView from "@/Components/ImageViewSqua";
import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import Modal from "@/Components/Modal";
import DialogModal from "@/Components/DialogModal";
import Button from "@/Jetstream/Button";
import Multiselect from "@vueform/multiselect";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import AppImage from "@/Components/Image";
import { Link } from "@inertiajs/inertia-vue3";
import Checkbox from "@/Jetstream/Checkbox";

import PrintviewTudu from "@/Pages/Prinview/FormTudu";
import PrintviewSaigon from "@/Pages/Prinview/FormSaigon";
import PrintviewMekong from "@/Pages/Prinview/FormMekong";
import PrintviewVigor from "@/Pages/Prinview/FormVigor";
import PrintviewGenaral from "@/Pages/Prinview/FormGenaral";
import PrintHPV from "@/Pages/Prinview/FormHPV";
import PrintviewErolab from "@/Pages/Prinview/FormErolab";
import PrintviewDHYD from "@/Pages/Prinview/FormDHYD";

import { BeakerIcon } from "@heroicons/vue/solid";
import { PencilIcon } from "@heroicons/vue/solid";
import { CheckIcon } from "@heroicons/vue/solid";
import { useForm } from "@inertiajs/inertia-vue3";
import moment from "moment";

export default defineComponent({
  name: "Danh sách Thinprep",
  props: {
    billtests: "",
    nametests: "",
    testElements: "",
    provinces: "",
    districts: "",
    wards: "",
    ousents: "",
    doctors: "",
    readcodes: "",
    custommer: "",
    filters: {},
    eurolab: "",
    errors: Object,
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    Pagination,
    EditBtn,
    DeleteBtn,
    JetButton,
    AppImage,
    Modal,
    DialogModal,
    Button,
    Multiselect,
    JetLabel,
    JetInput,
    AppImageView,
    Link,
    Checkbox,
    PrintviewTudu,
    PrintviewSaigon,
    PrintviewMekong,
    PrintviewVigor,
    PrintviewErolab,
    PrintviewDHYD,
    PrintviewGenaral,
    PencilIcon,
    CheckIcon,
    BeakerIcon,
    PrintHPV,
  },
  data() {
    return {
      pathLogoEuro: "/storage/Image_Eurolab/",
      pathThinLeft: "/storage/ImageThinLeft/",
      pathLogo: "/storage/Image_Ousent/",
      pathThinRight: "/storage/ImageThinRight/",
      imagePathBackground: "/images/Logo/thinprepColor.png",
      imageGGSqure: "/images/Logo/logohpv(30_30).png",
      selected: [],
      allSelected: false,
      userIds: [],
      termSearch: "",
      sco: "",
      logo: "",
      testselect: [1],
      checkDPF: [""],
      checkPrint: [],
      billPrint: "",
      url: null,
      getbilltests: "",
      printCustommers: "",
      //printName:'',
      //printAge:'',
      printAddress: "",
      printOutsent: "",
      printDoctor: "",
      doctorread: "",
      printNameTest: "",
      selectedArray: [1, 4],
      imgeLeft: "",
      imageRight: "",
      ketluan: "",

      output: null,
      ousentFill: this.filters.ousentFill,

      pathThinLeft: "/storage/ImageThinLeft/",
      pathThinRight: "/storage/ImageThinRight/",
      pathLogo: "/storage/Image_Ousent/",
      //pathImageLeft:'/images/Logo/Thinprep.jpg',
      pathImageLeft: "/images/Logo/Thinprep.jpg",

      getOusents: this.ousents,
      getdistricts: this.district,
      getwards: "",
      getdoctors: this.doctors,
      form_errors: [],

      name: "123",
      perPage: "",
      checkededit: "",
      pathImage: "/storage/image_Ousent/",
      userEdit: "",
      showModal: "",
      showModlPrint: false,
      showModlPrintMulti: false,
      editMode: false,
      //titleModal:'Them user',
      maxWidth: "4xl",
      titleHeader: "Edit",
      example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options: this.nametests.data,
        searchable: true,
        createTag: true,
      },
    };
  },
  setup() {
    const form = useForm({
      file: null,
    });

    return { form };
  },

  watch: {},
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Danh sách In ThinPrep",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "Check", class: "w-12 text-center" },
        { name: "#", class: "w-12 text-center" },
        { name: "Mã Thinprep", class: "border-l-2 text-center font-normal" },
        {
          name: "Tên khách hàng",
          class: "border-l-2 text-center w-52 px-2 font-normal",
        },
        {
          name: "Giới tính",
          class: "border-l-2 text-center w-8 px-2 font-normal",
        },
        { name: "Năm sinh", class: "border-l-2 text-center px-0 font-normal" },
        { name: "Địa chỉ", class: "border-l-2 text-center font-normal" },
        {
          name: "Điện thoại",
          class: "border-l-2 text-center px-1 font-normal",
        },
        { name: "Tên xét nghiệm", class: "border-l-2 text-center font-normal" },


        {
          name: "Bác sỹ chỉ định",
          class: "border-l-2 text-center font-normal",
        },
        { name: "Đơn vị gửi mẫu", class: "border-l-2 text-center font-thin" },
        {
          name: "Ngày nhận mẫu mẫu",
          class: "border-l-2 text-center font-thin",
        },
        { name: "Đơn vị đọc", class: "border-l-2 text-center font-thin" },
        { name: "Image Left", class: "border-l-2 text-center font-normal" },
        { name: "Image Right", class: "border-l-2 text-center font-normal" },
        { name: "Kết quả", class: "border-l-2 text-center font-normal" },
        { name: "User create", class: "border-l-2 text-center font-normal" },
        { name: "Action", class: "text-right border-l-2 font-normal" },
      ];
    },
    addClass() {
      return "bg-blue-200 text-indigo-700";
    },
    bgSave() {
      return "bg-red-900 text-white";
    },
    bgEdit() {
      return "bg-green-600 text-white";
    },
  },
  mounted() {},
  methods: {
    async checkAll() {
      if (!this.allSelected) {
        const selected = this.billtests.data.map((u) => u.id);
        this.checkPrint = selected;
      } else {
        this.checkPrint = [];
      }
    },
    search() {
      this.$inertia.get(
        "printThinprep",
        {
          term: this.termSearch,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },

    formatDate(value) {
      if (value) {
        return moment(String(value)).format("DD/MM/YYYY hh:mm");
      }
    },

    currentDate() {
      const current = new Date();
      const date =
        " " +
        `${current.getDate()}/${
          current.getMonth() + 1
        }/${current.getFullYear()}`;
      return date;
    },
    printDiv(divName) {
      window.print();
    },
    closeModalPrint() {
      this.showModlPrint = false;
      this.ketluan = "";
    },

    printResult(bill) {
      this.getbilltests = bill;
      this.printCustommers = bill.custommer;
      this.printOutsent = bill.ousent;
      this.printDoctor = bill.doctor;
      this.doctorread = bill.doctorread;

      if (bill.testnames) {
        let rs = bill.testnames.map(({ id }) => id);
        this.printNameTest = rs;
      } else {
        this.printNameTest = "";
      }
      if (bill.ousent.logo) {
        this.logo = bill.ousent.logo;
      } else {
        this.logo = "";
      }
      if (bill.imageleft) {
        this.imgeLeft = bill.imageleft.thinLeft;
        this.imageRight = bill.imageleft.thinRight;
      } else {
        this.imageLeft = "";
        this.imageRight = "";
      }

      const elementChecked1 = bill.results;
      let results = elementChecked1.map(({ element_id }) => element_id);
      console.log("Heheheheheheheehehehheeheheheh", results);

      let keluanfill = elementChecked1.map(({ result }) => result);

      var ketluanFill = elementChecked1.find((obj) => {
        return obj.element_id == 26;
      });
      this.sco = bill.results.find((obj) => {
        return obj.element_id == 56;
      });

      var last = keluanfill.slice(-1)[0];
      if (ketluanFill) {
        this.ketluan = ketluanFill.result;
      }
      if (results != 26) {
        this.selectedArray = results;
      } else {
        this.selectedArray = [1, 4];
      }

      this.printAddress = " " + bill.custommer.address;
      this.showModlPrint = true;
    },
    getDoctorFill(doctor) {
      const fillData = this.doctors.filter(function (el) {
        return el.ousent_id == doctor;
      });
      //console.log(fillData);
      this.getdoctors = fillData;
    },

    scrollToView(element) {
      var offset = element.offset().top;
      if (!element.is(":visible")) {
        element.css({ visibility: "hidden" }).show();
        var offset = element.offset().top;
        element.css({ visibility: "", display: "" });
      }

      var visible_area_start = $(window).scrollTop();
      var visible_area_end = visible_area_start + window.innerHeight;

      if (offset < visible_area_start || offset > visible_area_end) {
        // Not in view so scroll to it
        $("html,body").animate(
          { scrollTop: offset - window.innerHeight / 3 },
          1000
        );
        return false;
      }
      return true;
    },

    getPageFill() {
      this.$inertia.get(
        "printThinprep?",
        {
          //alert(ousentFill);
          perPage: this.perPage,
          ousentFill: this.ousentFill,
          readcodeFill: this.readcodeFill,
          startDate: this.startDate,
          endDate: this.endDate,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    getfilePerpage() {
      this.$inertia.get(
        "printThinprep?",
        {
          //search:this.search,
          perPage: this.perPage,
          ousentFill: this.ousentFill,
          readcodeFill: this.readcodeFill,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    refreshFill() {
      this.ousentFill = "";
      this.readcodeFill = "";
      this.$inertia.get("printThinprep?");
    },

    printDocument() {
      //get table html
      const pdfTable = document.getElementById("exportMe");
      //html to pdf format
      var html = htmlToPdfmake(pdfTable.innerHTML);

      const documentDefinition = { content: html };
      pdfMake.vfs = pdfFonts.pdfMake.vfs;
      pdfMake.createPdf(documentDefinition).open();
    },


  },
});
</script>

<style>
.modal-body {
  overflow-y: auto;
}
</style>
 <style src="@vueform/multiselect/themes/default.css"></style>


<style media="print">
@media print {
  body {
    visibility: hidden;
  }
  #printMe {
    visibility: visible;
    padding: 0px;
    margin: 0px;
  }

  @page {
    margin: 0.5mm 0.5mm 0.5mm 10mm;
  }

  .fontsizeInfo {
    font-size: 16pt;
    line-height: 1.5;
  }
  .infoText {
    font-size: 18pt;
  }
  .fontsizeElement {
    font-size: 12pt;
    line-height: 1.5;
  }
  .fontsizeTitle {
    font-size: 20pt;
  }
  .fontsizeKQ {
    font-size: 18pt;
  }
  .fontsizeBottom {
    font-size: 18pt;
  }

  .page-footer {
    position: fixed !important;
    bottom: 0;
  }
}
.page-break {
  page-break-after: always !important;
}
.footer {
  position: absolute;
  bottom: 0px;
}
</style>
