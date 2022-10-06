<template>
  <app-layout title="DS HPV">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="text-right text-red-600 " v-if="errors">
            <p v-for="(er,i) in errors" :key="i">
              {{er}}
            </p>
        </div>

      <div class="grid grid-cols-1 mb-2">
        <div class="flex flex-1 justify-between">
            <div class="flex flex-row w-full">
                <!-- <a :href="route('hpvexport',{'startDate':startDate,'endDateFill':endDateFill,'ousentFill':ousentFill })" class="py-2 flex justify-center bg-blue-600 text-white w-48 rounded-md text-center" > -->
               <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg>
              <span class="w-full">Export Excel HPV</span>
            <!-- </a> -->

          </div>
      </div>
      </div>
        <!---/////==================------->
        <!---==================------->
        <hr class="mb-2">
      <div class="grid grid-cols-10">

        <div class="col-span-2 w-full">
          <div class="flex flex-row">
              <div class="">
                  <span>ĐV gửi mẫu:</span>
                </div>
              <div class="col-span-2 w-72">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="ousentFill"
                      >
                        <option value="all">All</option>
                        <option
                          v-for="(ous,i) in ousents"
                          :key="i"
                          :value="ous.id"
                        >
                          {{ ous.name }}
                        </option>
                    </select>
              </div>
            </div>
        </div>
        <div class="col-span-2  mx-2">
          <div class="flex flex-grow">
            <div class="">
                  <span>Xét nghiệm:</span>
                </div>
              <div class="col-span-2 w-52">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="nametestFill"
                      >
                        <option value="">--</option>
                        <option value="all">All</option>
                        <option
                          v-for="(nt,i) in nametests.data"
                          :key="i"
                          :value="nt.id"
                        >
                          {{ nt.name }}
                        </option>
                    </select>
              </div>
          </div>
          </div>
           <div class="col-span-2 ">
            <div class="flex flex-row">
              <div class="">
                  <span>Kết quả:</span>
                </div>
              <div class="col-span-2 w-52">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="resultFill">

                        <option  value="">All</option>
                        <option value="2">--</option>
                        <option value="-1">Negative (-)</option>
                         <option value="1">Positive (+)</option>

                    </select>
              </div>
            </div>
        </div>
        <div class="col-span-2">
          <div class="flex flex-row">
              <div class="flex flex-row">
                  <span>Từ:</span>

                      <div class="flex flex-row">

                          <jet-input
                          id="startDate"
                          type="date"
                          class="h-8 block w-full"
                          v-model="startDate"
                          autocomplete="startDate"/>
                      </div>

                </div>
              <div class="flex flex-row ml-2">
                  <span>Đến:</span>
                      <jet-input
                        id="endDate"
                        type="date"
                        class= "h-8 block w-full"
                        v-model="endDate"
                        autocomplete="endDate"/>
              </div>
          </div>
        </div>
      <div class="col-span-2 text-right">
            <button @click="getPageFill" class="px-4 ml-2 py-2 justify-auto text-white font-bold bg-blue-400 rounded-md text-sm h-8">
                Fill
            </button>
            <button @click="refreshFill" class="px-2 mx-2 py-2 justify-auto text-white font-bold bg-yellow-400 rounded-md text-sm h-8">
                Refresh
            </button>
          </div>
      </div>
      <hr class="mt-2">
      <!---==================------->
      <div class="grid grid-cols-5 mt-2 my-1">
        <div>
        </div>
        <div></div>
        <div></div>
        <div class=" bg-blue-100">
              <div class=" text-right">
                <div class="flex mb-2 text-right h-8 px-2">
                            <jet-input
                              required
                              id="search"
                              type="text"
                              class="mt-1 block w-full h-8 mr-2"
                              autocomplete="search"
                              v-model="elementSearch"
                              @keyup="search"
                            />
                        <span class="justify-center justify-items-center mt-2 cursor-pointer">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                        </span>
                  </div>
                </div>
          </div>
        <div class="">
         <div class="p-0 text-right rounded-sm">
                <div class="flex flex-row justify-end">
                        <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="perPage:" />
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
                          <option value="all">All</option>
                        </select>

                </div>
                </div>
          </div>
      </div>
      <!---//////////==================------->
      <Table :headers="headers" :addClass="addClass" id="exportMe">
          <tr class="hover:bg-gray-300 " v-for="(bill,i) in billtests.data" :key="i">
            <td class="border-r-2 text-center">{{bill.id}}</td>
            <td class="border-r-2 text-center w-20">{{bill.hpv_code}}</td>
            <td class="border-r-2 text-center w-35">{{bill.custommer.name}}</td>
            <td class="border-r-2 text-center w-16">{{bill.custommer.birthday}}</td>
            <td class="border-r-2 w-80">
                <span v-if="bill.custommer">{{bill.custommer.address}}</span>
                <span v-if="bill.custommer.district">{{bill.custommer.district.name}}</span>
                <span v-if="bill.custommer.province">{{bill.custommer.province.title}}. {{bill.custommer.province.name}}</span>
            </td>
            <td class="border-r-2 text-center w-32" >
              <span class="text-green-800 font-bold" v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
              </td>
            <td class="border-r-2 font-bold w-80" ><span v-if="bill.ousent">{{bill.ousent.name}}</span></td>
            <td class="border-r-2 text-center w-44" >
              <span class="text-center">
                {{formatDate(bill.date_receive) }}
              </span>
            </td>
            <td class="border-r-2 text-center w-16">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                  <span v-if="(rs.element_id==56)">
                    <span v-if="rs.result>=1" class="text-red-700 font-bold text-lg">{{rs.result}}</span>
                    <span v-else>{{rs.result}}</span>
                  </span>
              </span>
            </td>
            <td class="border-r-2 text-center w-16">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                  <span v-if="(rs.element_id==57)">
                    <span v-if="rs.result>=1" class="text-red-700 font-bold text-lg">{{rs.result}}</span>
                    <span v-else>{{rs.result}}</span>
                  </span>
              </span>
            </td>
            <td class="border-r-2 w-16">
               <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                <span v-if="(rs.element_id==58)">
                    <span v-if="rs.result>=1" class="text-red-700 font-bold text-lg">{{rs.result}}</span>
                    <span v-else>{{rs.result}}</span>
                  </span>

                  </span>

            </td>
            <td class="border-r-2 w-48 text-center" >
              <div v-if=" bill.resulthpvs">
                <div class="text-red-700" v-if=" bill.resulthpvs.find((x) => x.element_id === '56')">
                  <div class="text-red-700" v-if=" bill.resulthpvs.find((x) => x.element_id === '56').result >= 0.5">
                      <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '57') != null && bill.resulthpvs.find((result) => result.element_id === '58') == null)" >
                          <div  v-if="bill.resulthpvs.find((result) => result.element_id === '57').result >=1">
                              <span class="text-red-700 font-bold">Genotype HPV 16 Dương</span>
                          </div>

                      </div>
                      <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '57') == null && bill.resulthpvs.find((result) => result.element_id === '58') != null)" >
                          <div  v-if="bill.resulthpvs.find((result) => result.element_id === '58').result >=1">
                              <span class="text-red-700 font-bold">Genotype HPV 18/45 Dương</span>
                          </div>

                      </div>


                      <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '57') != null && bill.resulthpvs.find((result) => result.element_id === '58') != null)" >
                          <div  v-if="bill.resulthpvs.find((result) => result.element_id === '57').result >=1 && bill.resulthpvs.find((result) => result.element_id === '58').result < 1 ">
                              <span class="text-red-700 font-bold">Genotype HPV 16 Dương</span>
                          </div>

                          <div  v-if=" bill.resulthpvs.find((result) => result.element_id === '57').result >=1 && bill.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                              <p class="text-red-700 font-bold">Genotype HPV 16 Dương</p>
                              <p class="text-red-700 font-bold">Genotype HPV 18/45 Dương</p>
                          </div>
                          <div  v-if=" bill.resulthpvs.find((result) => result.element_id === '57').result < 1 && bill.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                              <span class="text-red-700 font-bold">Genotype HPV 18/45 Dương</span>
                          </div>

                          <div  v-if=" bill.resulthpvs.find((result) => result.element_id === '57').result < 1 && bill.resulthpvs.find((result) => result.element_id === '58').result < 1">
                              <span class="text-red-700 font-bold"> 11 Other HPV High-Risk Dương tính</span>
                          </div>
                        </div>


                  </div>

                  <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '56').result < 0.5) && (bill.resulthpvs.find((result) => result.element_id === '56').result != null)" class="text-blue-800 font-bold">
                    Âm tính
                    </div>
                  <div v-if=" (bill.resulthpvs.find((result) => result.element_id === '56').result == null)" class="text-blue-800 font-bold">
                    Chưa có kết quả
                    </div>

              </div>

              </div>


            </td>
          </tr>
      </Table>
         <div class="mt-4">
          <div class="flex">
              <Pagination :links="billtests.links"/>
          </div>
          </div>

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

import AppImageView from "@/Components/ImageView";
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
import Checkbox from '@/Jetstream/Checkbox';

import PrintviewTudu from '@/Pages/Prinview/FormTudu'
import PrintviewSaigon from '@/Pages/Prinview/FormSaigon'
import PrintviewVigor from '@/Pages/Prinview/FormVigor'
import PrintviewGenaral from '@/Pages/Prinview/FormGenaral'
import PrintHPV from '@/Pages/Prinview/FormHPV'

import { BeakerIcon } from '@heroicons/vue/solid'
import { PencilIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import { useForm } from '@inertiajs/inertia-vue3'
import moment from 'moment'

export default defineComponent({

  name: "Danh sách HPV",
  props: {

    billtests:'',
    nametests:'',
    testElements:'',
    provinces:'',
    districts:'',
    wards:'',
    ousents:'',
    doctors:'',
    readcodes:'',
    custommer:"",
    filters:{},
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
    PrintviewVigor,
    PrintviewGenaral,
     PencilIcon,
    CheckIcon,
    BeakerIcon,
    PrintHPV

  },
data(){
  return{
     startDate:this.filters.startDate,
    endDate:this.filters.endDate,
    elementSearch:'',
    allSelected:false,
    sco:'',
    logo:'',
    testselect:[1],
    checkDPF:[''],
    checkPrint:[],
    url: null,
    getbilltests:'',
     printCustommers:'',
    //printName:'',
    //printAge:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',
    printNameTest:'',
    selectedArray:'',
    imgeLeft:'',
    ketluan:'',

    output: null,
    resultFill:this.resultFill,
    nametestFill:'',
    ousentFill:this.filters.ousentFill,
    pathThinLeft:'/storage/imageThinLeft/',
    pathLogo:'/storage/Image_Ousent/',
    pathImageLeft:'/images/Logo/Thinprep.jpg',
   // pathThinLeft:'/images/Thinprep/hLeft.jpg',
   // pathThinRight:'/images/Thinprep/hRight.jpg',
    pathThinRight:'/storage/imageThinRight/',
    getOusents:this.ousents,
    getdistricts:this.district,
    getwards:'',
    getdoctors:this.doctors,
    form_errors:[],

    name:'123',
    perPage:'',
    checkededit:'',
    pathImage:'/storage/image_Ousent/',
    userEdit:'',
    showModal:'',
    showModlPrint:false,
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",
    titleHeader:'Edit',
     example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options:this.nametests.data,
        searchable: true,
        createTag: true,
    },
    }
  },
setup() {
        const form = useForm({
            file: null,
        });

        return { form };
    },

  watch:{

    "form.province_id":function(value){

      // console.log(value);
      //alert(he-Province);
       this.getDistrictFill(value)
    },
    "form.district_id":function(value){
      //alert(value);
       this.getWardFill(value)
    },
    "form.ousent_id":function(value){
       this.getDoctorFill(value)
    },
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Danh sách HPV",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#", class:'w-12 text-center' },
        { name: "Mã HPV", class:'border-l-2 text-center font-normal' },
        { name: "Tên khách hàng", class:'border-l-2 text-center w-52 px-2 font-normal' },
        { name: "Năm sinh", class:'border-l-2 text-center px-0 font-normal' },
        { name: "Địa chỉ", class:'border-l-2 text-center font-normal' },
        { name: "Tên xét nghiệm", class:'border-l-2 text-center font-normal' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Ngày nhận mẫu mẫu", class:'border-l-2 text-center font-thin' },
        { name: "SCO", class:'border-l-2 text-center' },
        { name: "HPV 16", class:'border-l-2 text-center' },
        { name: "HPV 18", class:'border-l-2 text-center' },
        { name: "Kết quả", class:'border-l-2 text-center' },

      ];
    },
    addClass() {
      return "bg-blue-200 text-indigo-700";
      },
      bgSave(){
        return "bg-red-900 text-white";
      },
      bgEdit(){
        return "bg-green-600 text-white";
      },
    },
  methods:{
        getfilePerpage(){
         this.$inertia.get('reporthpvs?',
            {  //search:this.search,
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              resultFill:this.resultFill,
              readcodeFill:this.readcodeFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
     search(){

       this.$inertia.get('reporthpvs',
            {
              term:this.elementSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
    exportExcelt(data){
          this.$inertia.get('reporthpvs?',
            {
              ousentFill:this.ousentFill,
              //readcodeFill:this.readcodeFill,
              startDate:this.startDate,
              endDate:this.endDate,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },

    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    },
    currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },
    getPageFill(){
        this.$inertia.get('reporthpvs?',
            {
              //alert(ousentFill);
              resultFill:this.resultFill,
              nametestFill:this.nametestFill,
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              readcodeFill:this.readcodeFill,
              startDate:this.startDate,
              endDate:this.endDate,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },

     refreshFill(){

      this.resultFill = '',
      this.perPage = '',
      this.ousentFill='',
      this.nametestFill='',
      this.startDate='',
      this.endDate=''

        this.$inertia.get('reporthpvs?')

        },



  }
});
</script>
