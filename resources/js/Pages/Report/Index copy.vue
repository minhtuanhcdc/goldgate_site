<template>
  <app-layout title="Report Full">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
    <div>
        <div class="text-right text-red-600 " v-if="errors">
            <p v-for="(er,i) in errors" :key="i">
              {{er}}
            </p>
        </div>
      <div class="flex justify-between mb-2">
        <div class="flex flex-1 justify-between">
          <div class="flex flex-row w-56 px-4">
              <a :href="route('exportbill',{'startDate':startDate,'endDate':endDate,'ousentFill':ousentFill,'readcodeFill':readcodeFill,'nametestFill':nametestFill,'resultHpvFill':resultHpvFill })" class="py-2 flex flex-row justify-center bg-blue-600 text-white w-full rounded-md mr-2" >
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg>
              <span class="w-full">Export Excel Full</span>
            </a>
          </div>
      </div>
        <div class="flex flex-row align-middle">
              <div class="">
                    <span class="text-blue-800">ĐV gửi mẫu:</span>
              </div>
              <div class="flex-1 ">
                <!----===========================================================================---->
                 <div id="app_checkbox" class="checkbox-select">
                  <div class="checkbox-select__trigger" :class="{ isActive: activeTrigger }" @click="showDropdown">
                    <span class="checkbox-select__title">Select property type</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"><path d="M121.3 34.6c-1.6-1.6-4.2-1.6-5.8 0l-51 51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8 0-1.6 1.6-1.6 4.2 0 5.8l53.9 53.9c.8.8 1.8 1.2 2.9 1.2 1 0 2.1-.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2.1-5.8z"/></svg>
                  </div>
                  <div id="dropdown" class="checkbox-select__dropdown" :class="{ activeSearch: showLoader }">
                    <div class="checkbox-select__search-wrapp">
                      <input type="text" @focus="showLoader = true" @blur="showLoader = false" placeholder="search filters..." v-model="search">
                    </div>
                    <div class="checkbox-select__col">
                      <!-- //<div class="checkbox-select__select-all" v-model="selectAll"> -->
                      <div class="checkbox-select__select-all">
                        <label for="selectAll">{{selectAllText}}</label>
                        <input type="checkbox" id="selectAll" @click="selectAll" v-model="allSelected">
                      </div>
                      <div class="checkbox-select__info">{{checkedFilters.length}} SELECTED</div>
                    </div>
                    <ul id="customScroll" class="checkbox-select__filters-wrapp">
                    <!-- <ul id="customScroll" class="checkbox-select__filters-wrapp" data-simplebar-auto-hide="false"> -->
                      <li v-for="(filter, index) in ousents" :key="index">
                        <div class="checkbox-select__check-wrapp">
                          <input :id="index" class="conditions-check" v-model="checkedFilters" :value="filter" type="checkbox">
                          <label :for="index">{{filter}}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>  -->

                <!----===========================================================================---->
              </div>

        </div>
      </div>
        <!---/////==================------->
        <!---==================------->
        <hr class="mb-2">
      <div class="flex justify-between ">

          <div class="flex flex-row align-middle">
              <div class="">
                    <span class="text-blue-800">ĐV gửi mẫu:</span>
              </div>
              <div class="w-56 ">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md bg-yellow-200"
                        v-model="ousentFill"
                      >
                        <option value="">All</option>
                        <option
                          v-for="(ous,i) in ousents"
                          :key="i"
                          :value="ous.id"
                        >
                          {{ous.id}}-{{ ous.name }}
                        </option>
                    </select>
              </div>

        </div>
         <div class=" mx-2">
          <div class="flex flex-grow">
            <div class="">
                  <span class="text-blue-800">Xét nghiệm:</span>
                </div>
              <div class="col-span-2 w-52">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="nametestFill"
                      >
                        <option value="">All</option>
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
        <div class="  mx-2">
          <div class="flex flex-grow">
            <div class="">
                  <span class="text-blue-800">BS đọc KQ:</span>
                </div>
              <div class="col-span-2">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="readcodeFill"
                      >
                        <option value="">All</option>
                        <option
                          v-for="(rcd,i) in readcodes"
                          :key="i"
                          :value="rcd.read_code"
                        >
                          {{ rcd.name }} ({{rcd.read_code}})
                        </option>
                    </select>
              </div>
              </div>
          </div>

        <div class="">
          <div class="flex flex-row">
              <div class="flex flex-row">
                  <span class="text-blue-800">Từ:</span>
                      <div class="flex flex-row">
                          <jet-input
                          id="startDate"
                          type="date"
                          class="h-8 block w-full bg-yellow-200"
                          v-model="startDate"
                          autocomplete="startDate"/>
                      </div>
                </div>
              <div class="flex flex-row ml-2">
                  <span class="text-blue-800">Đến:</span>
                      <jet-input
                        id="endDate"
                        type="date"
                        class= "h-8 block w-full bg-yellow-200 "
                        v-model="endDate"
                        autocomplete="endDate"/>
              </div>
          </div>
        </div>
         <div class=" ">
          <div class="flex flex-row">
              <div class="">
                    <span class="text-blue-800 font-bold">Kết quả HPV:</span>
                </div>
              <div class="2">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md bg-yellow-200"
                        v-model="resultHpvFill"
                      >
                        <option value="">All</option>
                        <option value="negative">Âm (-)</option>
                        <option value="positive">Dương(+)</option>

                    </select>
              </div>
            </div>
        </div>
      <div class=" text-right">
            <button @click="getPageFill" class="px-4 ml-1 py-2 justify-auto text-white font-bold bg-blue-400 rounded-md text-sm h-8">
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
                          <option value="150">150</option>
                          <option value="200">200</option>
                          <option value="250">250</option>
                        </select>

                </div>
                </div>
          </div>
      </div>
      <!---//////////==================------->
    </div>
      <Table :headers="headers" :addClass="addClass" id="exportMe">
         <!-- <tr><td class="text-sm font-bold" colspan="2"><input class="mr-2" type="checkbox" v-model="allSelected" @click="checkAll">CheckAll</td></tr> -->
          <tr class="hover:bg-gray-300 " v-for="(bill,i) in billtests.data" :key="i">
             <!-- <td><input type="checkbox" :value="bill.id" v-model="checkPrint"></td> -->
            <td class="border-r-2 text-center">{{i+1}}</td>
             <td class="border-r-2 text-center font-bold">{{bill.thinprep_code}}</td>
              <td class="border-r-2 text-center font-bold">{{bill.hpv_code}}</td>
               <td class="border-r-2" ><span>{{bill.read_code}}</span></td>
             <td class="border-r-2">{{bill.custommer.name}}</td>
             <td class="border-r-2">
               <span v-if="bill.custommer.gender==0">Nữ</span>
               <span v-else>Nam</span>
              </td>
             <td class="border-r-2">{{bill.custommer.birthday}}</td>
              <td class="border-r-2 text-center">
                <span v-if="bill.custommer">{{bill.custommer.address}}, </span>
                <span v-if="bill.custommer.ward">{{bill.custommer.ward.name}}, </span>
                 <span v-if="bill.custommer.district">{{bill.custommer.district.name}}, </span>
                <span v-if="bill.custommer.province">{{bill.custommer.province.title}}. {{bill.custommer.province.name}}</span>
              </td>
            <td class="border-r-2 text-center" v-if="bill.phone!==null">{{bill.custommer.phone}}</td>
            <td class="border-r-2 text-center" v-else></td>
            <td class="border-r-2 text-center" >
              <span class="text-green-800 " v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
              </td>

             <td class="border-r-2" ><span >{{bill.doctor_indi}}</span></td>
            <td class="border-r-2" ><span v-if="bill.ousent">{{bill.ousent.name}}</span></td>
            <td class="border-r-2 text-center" >
              <span class="text-center">
                {{formatDate(bill.date_receive) }}
              </span>
            </td>
            <td class="border-r-2 max-width-40" >
              <div v-if=" bill.resulthpvs">
                <div class="text-red-700" v-if=" bill.resulthpvs.find((x) => x.element_id === '56')">
                  <div class="text-red-700" v-if=" bill.resulthpvs.find((x) => x.element_id === '56').result >= 0.5">
                      <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '57') != null && bill.resulthpvs.find((result) => result.element_id === '58') == null)" >
                          <div  v-if="bill.resulthpvs.find((result) => result.element_id === '57').result >=1">
                              <span class="text-red-700 ">Genotype HPV 16 Dương</span>
                          </div>
                      </div>
                      <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '57') == null && bill.resulthpvs.find((result) => result.element_id === '58') != null)" >
                          <div  v-if="bill.resulthpvs.find((result) => result.element_id === '58').result >=1">
                              <span class="text-red-700 ">Genotype HPV 18/45 Dương</span>
                          </div>
                      </div>
                      <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '57') != null && bill.resulthpvs.find((result) => result.element_id === '58') != null)" >
                          <div  v-if="bill.resulthpvs.find((result) => result.element_id === '57').result >=1 && bill.resulthpvs.find((result) => result.element_id === '58').result < 1 ">
                              <span class="text-red-700 ">Genotype HPV 16 Dương</span>
                          </div>

                          <div  v-if=" bill.resulthpvs.find((result) => result.element_id === '57').result >=1 && bill.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                              <p class="text-red-700 ">Genotype HPV 16 Dương</p>
                              <p class="text-red-700 ">Genotype HPV 18/45 Dương</p>
                          </div>
                          <div  v-if=" bill.resulthpvs.find((result) => result.element_id === '57').result < 1 && bill.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                              <span class="text-red-700 ">Genotype HPV 18 Dương</span>
                          </div>

                          <div  v-if=" bill.resulthpvs.find((result) => result.element_id === '57').result < 1 && bill.resulthpvs.find((result) => result.element_id === '58').result < 1">
                              <span class="text-red-700 "> 11 Other HPV High-Risk Dương tính</span>
                          </div>
                        </div>


                  </div>
                 <div  v-if=" (bill.resulthpvs.find((result) => result.element_id === '56').result < 0.5) && (bill.resulthpvs.find((result) => result.element_id === '56').result != null)" class="text-blue-800 ">
                 Âm tính
                </div>
                <div v-if=" (bill.resulthpvs.find((result) => result.element_id === '56').result == null) || !(bill.resulthpvs.find((result) => result.element_id === '56'))" class="text-blue-800">
                 Chưa có kết quả
                </div>

              </div>
              </div>
            </td>
            <td class="border-r-2 max-width-40" >
              <div v-for="(rs,i) in bill.results" :key="i">
                <span v-if="rs.element_group ==5 || rs.element_group ==6 || rs.element_group ==7 || rs.element_group ==13
                || rs.element_group ==14|| rs.element_group ==15|| rs.element_group ==16 || rs.element_group ==21" class="text-blue-600">
                 <p> - {{rs.name}}</p>
                </span>
              </div>
            </td>
             <td class="border-r-2">{{bill.userupdate_id}}</td>
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
import Input from "../../Jetstream/Input.vue";

export default defineComponent({

  name: "Danh sách(Report Full)",
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
    PrintHPV,
    Input

  },
data(){
  return{
      search: "",
      checkedFilters: [],
      allSelected: false,
      selectAllText: 'Select All',
      activeTrigger: false,
      dropdown: false,
      showLoader: false,
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
    perPage:this.filters.perPage,
    resultHpvFill:this.filters.resultHpvFill,
    ousentFill:this.filters.ousentFill,
    nametestFill:this.filters.nametestFill,
    readcodeFill:this.filters.readcodeFill,
    startDate:this.filters.startDate,
    endDate:this.filters.endDate,
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
        //mode: "multiple",
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
     filteredList() {
      return this.ousents.filter(item => {
        return item.toLowerCase().includes(this.search.toLowerCase());
      });
    },
    breadcrumbs() {
      return [
        {
          label: "Danh sách(Report All)",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#", class:'w-12 text-center' },
        { name: "Mã Thinprep", class:'border-l-2 text-center font-normal' },
        { name: "Mã HPV", class:'border-l-2 text-center font-normal' },
         { name: "Đơn vị đọc", class:'border-l-2 text-center font-thin' },
        { name: "Tên khách hàng", class:'border-l-2 text-center w-52 px-2 font-normal' },
        { name: "Giới tính", class:'border-l-2 text-center w-8 px-2 font-normal' },
        { name: "Năm sinh", class:'border-l-2 text-center px-0 font-normal' },
        { name: "Địa chỉ", class:'border-l-2 text-center font-normal' },
        { name: "Điện thoại", class:'border-l-2 text-center px-1 font-normal' },
        { name: "Tên xét nghiệm", class:'border-l-2 text-center font-normal' },
        { name: "Bác sỹ chỉ định", class:'border-l-2 text-center font-normal' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Ngày nhận mẫu mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Kết quả HPV", class:'border-l-2 text-center font-normal' },
        { name: "Kết quả Thinprep", class:'border-l-2 text-center font-normal' },
        { name: "User create", class:'border-l-2 text-center font-normal' },

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
  mounted() {

  },
  // created: function () {
  //         const customScroll = new SimpleBar(document.getElementById('customScroll'));
  // },

  methods:{
    showDropdown: function(){
      if(this.dropdown == false){
        this.dropdown = true;
        this.activeTrigger = true;
        TweenMax.fromTo(
          "#dropdown",
          0.55,
          {
            autoAlpha: 0,
            y: -10
          },
          {
            autoAlpha: 1,
            y: 0,
            ease: Power2.easeOut
          }
        );
      }else{
        this.dropdown = false;
        this.activeTrigger = false;
         TweenMax.to(
          "#dropdown",
          0.2,
          {
            autoAlpha: 0,
            y: -10,
            ease: Power2.easeOut
          });
      }

    },

    selectAll: function() {
      this.checkedFilters = [];
      this.selectAllText = this.selectAllText == "Select All" ? 'Clear All' : 'Select All';
      if (this.allSelected) {
        for (filter in this.filters) {
          this.checkedFilters.push(this.filters[filter].toString());
        }
      }
    },
     search(){
       this.$inertia.get('reports',
            {
              term:this.elementSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },

     async checkAll() {
      if (!this.allSelected) {
        const selected = this.billtests.data.map((u) => u.id);
        this.checkPrint = selected;
      } else {
        this.checkPrint = [];
      }
    },
    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')}
    },

    currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },

    getPageFill(){
        this.$inertia.get('reports?',
            {
              //alert(ousentFill);
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              nametestFill:this.nametestFill,
              readcodeFill:this.readcodeFill,
              startDate:this.startDate,
              endDate:this.endDate,
              resultHpvFill:this.resultHpvFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    getfilePerpage(){
         this.$inertia.get('reports?',
            {  //search:this.search,
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              nametestFill:this.nametestFill,
              readcodeFill:this.readcodeFill,
              startDate:this.startDate,
              endDate:this.enDate,
              resultHpvFill:this.resultHpvFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    refreshFill(){
      this.perPage = '',
      this.ousentFill='',
      this.readcodeFill=''
      this.resultHpvFill=''
      this.$inertia.get('reports?')
     },
  }
});
</script>

<style>
.modal-body {
    overflow-y: auto;
}
</style>
 <style src="@vueform/multiselect/themes/default.css"></style>



