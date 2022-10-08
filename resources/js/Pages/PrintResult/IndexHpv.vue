<template>
  <app-layout title="Print HPV">
    <template #header >
      <div class="flex justify-between">
        <breadcrumb :items="breadcrumbs" />
        <breadcrumb :items="breadcrumbs" />
        <breadcrumb :items="breadcrumbs" />
      </div>
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
           <div class="flex flex-row">
             <!-- <a :href="route('downloadPDF',checkPrint)" class="bg-green-800 py-1 px-2 rounded-md text-white cursor-pointer h-8" target="blank" >Export PDF <span class="text-xs m-0 ">({{checkPrint?checkPrint.length:0}})</span></a> -->
              <a :href="route('printMutiHpv',checkPrint)" class="ml-4 bg-blue-800 py-1 px-2 rounded-md text-white cursor-pointer h-8" target="blank" >PrintMulti <span class="text-xs m-0 ">({{checkPrint?checkPrint.length:0}})</span></a>
            </div>
             <div class="flex flex-row w-56 px-4 text-center">
              <a :href="route('exportDS',{'startDate':startDate,'endDate':endDate,'ousentFill':ousentFill,'nametestFill':nametestFill,'resultHpvFill':resultHpvFill })"
               class="py-2 flex flex-row justify-center bg-yellow-400 text-white w-full rounded-md mr-2" >
                <span class="w-full">Export DS trả KQ</span>
              </a>
          </div>
        </div>
      </div>
        <!---/////==================------->
        <!---==================------->
        <hr class="mb-2">
      <div class="flex justify-between">
      <div class="w-96 mx-2">
        <div class="flex flex-row">
          <div class="">
            <span class="w-full text-right">ĐV gửi mẫu:</span>
          </div>
          <div class="flex-1">
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
                  {{ous.id}} - {{ ous.name }}
                </option>
            </select>
          </div>
        </div>
      </div>
      <div class="mx-2">
        <div class="flex flex-row">
          <div class="flex flex-row">
            <span>Từ:</span>
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
            <span>Đến:</span>
            <jet-input
                id="endDate"
                type="date"
                class= "h-8 block w-full bg-yellow-200"
                v-model="endDate"
                autocomplete="endDate"
            />
        </div>
        </div>
      </div>
        <div class="flex flex-row">
            <div class="flex flex-row w-48">
              <span class="">Mã từ:</span>
              <div class="flex-1">
                <jet-input
                  id="starthpv"
                  type="text"
                  class="h-8 block w-full"
                  v-model="starthpv"
                  autocomplete="starthpv"/>
              </div>
            </div>
        <div class="flex flex-row ml-2 w-48">
            <span>Đến:</span>
            <div class="flex-1">
              <jet-input
                  id="tohpv"
                  type="text"
                  class= "h-8 block w-full"
                  v-model="tohpv"
                  autocomplete="tohpv"
              />
            </div>
        </div>
        </div>
        <div class="flex">
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
        <div class="flex">
            <button @click="getPageFill" class="px-4 ml-2 py-2 justify-auto text-white font-bold bg-yellow-400 rounded-md text-sm h-8">
                Fill
            </button>
            <button @click="refreshFill" class="px-2 mx-2 py-2 justify-auto text-white font-bold bg-green-400 rounded-md text-sm h-8">
                Refresh
            </button>
        </div>
      </div>
      <hr class="mt-2">
      <!---==================------->
      <div class="flex justify-between mt-2 my-1">
        <div class=" bg-blue-100">
          <div class=" text-right">
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
        <Table :headers="headers" :addClass="addClass" id="exportMe">
          <tr><td class="text-sm font-bold" colspan="2"><input class="mr-2" type="checkbox" v-model="allSelected" @click="checkAll">CheckAll</td></tr>
          <tr class="hover:bg-gray-300 align-middle" v-for="(bill,i) in billtests.data" :key="i">
            <td><input type="checkbox" :value="bill.id" v-model="checkPrint"></td>
            <td class="border-r-2 text-center">{{i+1}}</td>
            <td class="border-r-2 text-center font-bold">{{bill.hpv_code}}</td>
            <td class="border-r-2 text-sm">{{bill.custommer.name}}</td>
            <td class="border-r-2">
                <span v-if="bill.custommer.gender == 0">Nữ</span>
                <span v-else>Nam</span>
            </td>
            <td class="border-r-2">{{bill.custommer.birthday}}</td>
            <td class="border-r-2 text-center text-sm">
              <span v-if="bill.custommer">{{bill.custommer.address}}, </span>
              <span v-if="bill.ward">{{bill.custommer.ward.name}}, </span>
              <span v-if="bill.custommer.district">{{bill.custommer.district.name}}, </span>
              <span v-if="bill.custommer.province">{{bill.custommer.province.title}}. {{bill.custommer.province.name}}</span>
            </td>
            <td class="border-r-2 text-center" ><span v-if="bill.ousent" class=" text-sm text-center uppercase">{{bill.ousent.name}}</span></td>
            <td class="border-r-2 text-center" ><span>{{bill.doctor_indi}}</span></td>
            <td class="border-r-2 text-center" >
              <span class="text-center">
                {{formatDate(bill.date_receive) }}
              </span>
            </td>
            <td class="border-r-2 text-center" >
              <span class="text-green-800 font-bold" v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
            </td>
            <td class="border-r-2 text-center">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                <span v-if="rs.element_id == 56">
                  <span v-if="rs.result >= 0.5" class="text-red-700 font-bold">
                        {{rs.result}}
                  </span>
                  <span v-else>
                        {{rs.result}}
                  </span>
                </span>
              </span>
            </td>
            <td class="border-r-2 text-center">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                <span v-if="rs.element_id == 57">
                  <span v-if="rs.result >= 0.5" class="text-red-700 font-bold">
                        {{rs.result}}
                  </span>
                  <span v-else>
                      {{rs.result}}
                  </span>
                </span>
              </span>
            </td>
            <td class="border-r-2 text-center">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                <span v-if="rs.element_id == 58">
                  <span v-if="rs.result >= 0.5" class="text-red-700 font-bold">
                        {{rs.result}}
                  </span>
                  <span v-else>
                        {{rs.result}}
                  </span>
                </span>
              </span>
            </td>
            <td class="border-r-2">{{bill.userupdate_id}}</td>
            <td class="border-r-2 w-20">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn v-if="bill.resultHpv"
                  title="Print"
                  class="text-gray-600"
                    @click="printResult(bill)">
                  <svg class="h-8 w-8 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                  </svg>
                </EditBtn>
                <EditBtn v-else
                  title="Print"
                  class="text-gray-600">
                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                  </svg>
                </EditBtn>

              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
          <div class="flex">
            <Pagination :links="billtests.links"/>
          </div>
        </div>
        <DialogModal :show="showModlPrint" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
          <template v-slot:content>
            <div class="text-right w-full flex-row justify-items-between" >
              <button class="px-4 rounded-md mb-1 mr-1  bg-gray-800 text-white cursor-pointer text-md py-1 hover:bg-gray-600" type=""
                  @click="printDiv()" >Print</button>
              <button  @click="closeModalPrint" class="text-white text-md bg-green-500 px-2 py-1 rounded-md hover:bg-green-300">Close</button>
            </div>
            <div>
              <PrintHPV
                :getbilltests="getbilltests"
                :testElements="testElements"
                :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                :ouread="ouread"
                :printDoctor="printDoctor"
                :selectedArray="selectedArray"
                :pathThinLeft='pathThinLeft'
                :eurolab='eurolab'
                :pathLogoOusent='pathLogoOusent'
                :pathLogoEurolab="pathLogoEurolab"
                :pathImageBackground="pathImageBackground"
                :currentDate='currentDate()'/>
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

  name: "Danh sách In HPV(Aptima)",
  props: {
    billtests:'',
    nametests:'',
    testElements:'',
    provinces:'',
    districts:'',
    wards:'',
    ousents:'',
    ouread:'',
    doctors:'',
    readcodes:'',
    custommer:"",
    eurolab:"",
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
    allSelected:'',
    sco:'',
    logo:'',
    testselect:[1],
    checkDPF:[''],
    checkPrint:[],
    url: null,
    getbilltests:'',
     printCustommers:'',
    termSearch:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',
    printNameTest:'',
    selectedArray:'',
    imgeLeft:'',
    ketluan:'',

    output: null,
    ousentFill:this.filters.ousentFill,
    perPage:this.filters.perPage,
    startDate:this.filters.startDate,
    endDate:this.filters.endDate,
    starthpv:this.filters.starthpv,
    tohpv:this.filters.tohpv,
    pathLogoOusent:'/storage/Image_Ousent/',
    pathLogoEurolab:'/images/Logo/logohpv(30_30).png',
    pathImageBackground:'/images/Logo/eurolab.png',
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
computed: {
    breadcrumbs() {
      return [
        {
          label: "Danh sách In HPV (Aptima)",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "Check", class:'w-12 text-center' },
        { name: "#", class:'w-12 text-center' },
         { name: "Mã HPV", class:'border-l-2 text-center font-normal' },
        { name: "Tên khách hàng", class:'border-l-2 text-center w-52 px-2 font-normal' },
        { name: "Giới tính", class:'border-l-2 text-center w-8 px-2 font-normal' },
        { name: "Năm sinh", class:'border-l-2 text-center px-0 font-normal' },
        { name: "Địa chỉ", class:'border-l-2 text-center font-normal' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Bác sỹ chỉ định", class:'border-l-2 text-center font-normal' },

        { name: "Ngày nhận mẫu mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Tên XN", class:'border-l-2 text-center font-thin' },

        { name: "SCO", class:'border-l-2 text-center font-normal' },

        { name: "SCO16", class:'border-l-2 text-center font-normal' },
        { name: "SCO18", class:'border-l-2 text-center font-normal' },
        { name: "User create", class:'border-l-2 text-center font-normal' },
        { name: "Action", class: "text-right border-l-2 font-normal" },
      ];
    },
    addClass() {
      return "bg-blue-200 text-indigo-700 align-middle";
      },
      bgSave(){
        return "bg-red-900 text-white";
      },
      bgEdit(){
        return "bg-green-600 text-white";
      },
    },
  mounted() {},
  methods:{
    async checkAll() {
      if (!this.allSelected) {
        const selected = this.billtests.data.map((u) => u.id);
        this.checkPrint = selected;
      } else {
        this.checkPrint = [];
      }
    },
  //   checkAll() {

  //  this.checkPrint = '';
  //     var arrAll=[];
  //     if(!this.allSelected){

  //      this.billtests.data.forEach((value, index) => {
  //           arrAll.push(value.id);
  //     });
  //       this.checkPrint=arrAll;

  //     }else{

  //        this.billtests.data.forEach((value, index) => {
  //             arrAll.push('');
  //       });
  //         this.checkPrint=!this.checkPrint;

  //     }

  //   },
    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')}
    },
    currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },
    printDiv(){
          window.print();
      },
    closeModalPrint(){
         this.showModlPrint = false;
    },
    printResult(bill){
        this.getbilltests= bill;
        this.printCustommers = bill.custommer;
        this.printOutsent= bill.ousent;
        this.printDoctor = bill.doctor;
        if(bill.testnames){

           let rs =  bill.testnames.map(({ id }) => id)
            this.printNameTest= rs;
        }
        else{
          this.printNameTest='';
        }
        if(bill.ousent.logo){
          this.logo = bill.ousent.logo;
        }
        else{
          this.logo='';
        }
        if(bill.image_left){
          this.imgeLeft = bill.image_left.thinLeft;
        }
        else{
          this.imageLeft='';
        }
        const elementChecked1 = bill.resulthpvs;
        this.printAddress=' '+ bill.custommer.address;
        this.showModlPrint = true;

    },

      search(){
       this.$inertia.get('printHpv',
            {
              term:this.termSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
    getPageFill(){
        this.$inertia.get('printHpv?',
            {
              //alert(ousentFill);
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              startDate:this.startDate,
              endDate:this.endDate,
              starthpv:this.starthpv,
              tohpv:this.tohpv,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    getfilePerpage(){
         this.$inertia.get('printHpv?',
            {  //search:this.search,
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              startDate:this.startDate,
              endDate:this.endDate,
              starthpv:this.starthpv,
              tohpv:this.tohpv,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
     refreshFill(){
            this.perPage=""
             this.ousentFill=""
              this.readcodeFill=""
        this.$inertia.get('printHpv?')
     },
    closeModal(){
      this.reset();
      this.showModal=false;
      this.editMode=false;
    },
    openModal(){
      this.showModal=true;
    },
     reset() {
          this.getOusents=this.ousents,
          this.imgeLeft=null,
            this.form = {

            name: null,
            birthday: null,
            //ousent_id: null,
            //doctor_id: null,
            kinhchot: null,
            phone: "",
            gender: '',
            address: "",
            //getdistricts:null,
            //province_id: null,
            //district_id:null,
           // ward_id:null,
            testname_id:[''],
            selected:[],
            diagnose:'',
                }
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

<style media="print">
@media print {
  /* .noPrint :not(.printMe){
    display:none;
  }*/
    body {
    visibility: hidden;
  }
  #printMe {
    visibility: visible;
    padding:0px;
    margin: 0px;
  }
  @page{
    size: a4;
    margin: 10mm 10mm 10mm 15mm;
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';
    /* font-size: 20px; */
   }
      /* @page :top {
         margin-top: 0.5cm;

      }
     @page :left {
         margin-left: 0.5cm;

      }

      @page :right {

         margin-right: 0.5cm;
      } */

.page-break {page-break-before: always !important; }

}


</style>