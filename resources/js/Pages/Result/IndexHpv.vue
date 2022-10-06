<template>
  <app-layout title="Nhập KQ HPV">
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
        <div class="px-2 grid grid-cols-1 mb-2 bg-gray-200">
          <div class="flex justify-between">
              <div class="w-1/4">
                <div class="flex flex-row">
                    <div class="">
                        <span>ĐV gửi mẫu:</span>
                      </div>
                    <div class="col-span-2 flex-1">
                          <select
                              name="testgroup"
                              id="testgroup"
                              class="block py-0 w-full form-input h-8 rounded-lg text-md"
                              v-model="ousentFill">
                              <option value="">--</option>
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
                              <option value=""></option>
                              <option value="--">--</option>
                              <option value="negative">Negative (-)</option>
                              <option value="positive">Positive (+)</option>
                          </select>
                    </div>
                  </div>
              </div>
              <div class="col-span-1 text-right">
                    <button @click="getPageFill" class="px-4 ml-2 py-2 justify-auto text-white font-bold bg-blue-400 rounded-md text-sm h-8">
                        Fill
                    </button>
                    <button @click="refreshFill" class="px-2 mx-2 py-2 justify-auto text-white font-bold bg-yellow-400 rounded-md text-sm h-8">
                        Refresh
                    </button>
              </div>
          </div>
  <hr class="mt-2">
          <div class="flex justify-between mt-2">

            <div class=" bg-blue-100">
              <div class=" text-right">
                <div class="flex mb-2 text-right h-8 px-2 w-full">
                            <jet-input
                              placeholder="...Nhập Mã XN"
                              id="search"
                              type="text"
                              class="mt-1 block w-full h-8 mr-2"
                              autocomplete="search"
                              v-model="termSearch"
                               @keyup="search"
                            />
                        <span class="justify-center justify-items-center mt-2 cursor-pointer" >
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                        </span>
                  </div>
                </div>
            </div>
            <div>
              <form @submit.prevent="submitFile">
                <div class="flex flex-row">
                    <div class=" p-0 w-56">
                      <input type="file"
                        class=" px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                        @change="previewImage" ref="photo" />

                    </div>
                    <div class="flex items-center mt-0">
                      <button class="px-2 py-1 text-white bg-gray-900  rounded">Upload kết quả Hpv</button>
                    </div>
                </div>
              </form>
            </div>
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
                          <option value="5">2</option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="100">150</option>
                          <option value="200">200</option>
                          <option value="200">250</option>
                        </select>

                </div>
            </div>
          </div>
        </div>
         <Table :headers="headers" :addClass="addClass" v-if="billtests.data.length>0">
          <tr class="hover:bg-blue-300" v-for="(bill ,i) in billtests.data" :key="i">
            <td class="border-r-2 text-center"><input type="checkbox" class="w-3 h-3 cursor-pointer"/></td>
            <td class="border-r-2 text-center">{{i+1}}</td>
            <td class="border-r-2 font-bold">{{bill.hpv_code}}</td>
            <td class="border-r-2">{{bill.custommer.name}}</td>

            <td class="border-r-2">{{bill.custommer.birthday}}</td>
            <td class="border-r-2">{{bill.ousent.name}}</td>
             <td class="border-r-2">
              <span v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
            </td>
           <td class="border-r-2" >{{bill.doctor_indi}}</td>
            <td class="border-r-2">{{formatDate(bill.date_receive)}}</td>

            <td class="border-r-2 text-center">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                  <span v-if="(rs.element_id==56)">
                    <span v-if="rs.result>=0.5" class="text-red-700 font-bold text-lg">{{rs.result}}</span>
                    <span v-else>{{rs.result}}</span>
                  </span>
              </span>
            </td>
            <td class="border-r-2 text-center">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                  <span v-if="(rs.element_id==57)">
                    <span v-if="rs.result>=1" class="text-red-700 font-bold text-lg">{{rs.result}}</span>
                    <span v-else>{{rs.result}}</span>
                  </span>
              </span>
            </td>
            <td class="border-r-2 text-center">
              <span v-for="(rs,i) in bill.resulthpvs" :key="i">
                  <span v-if="(rs.element_id==58)">
                    <span v-if="rs.result>=1" class="text-red-700 font-bold text-lg">{{rs.result}}</span>
                    <span v-else>{{rs.result}}</span>
                  </span>
              </span>
            </td>
            <td class="border-r-2">
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
                <div v-if=" (bill.resulthpvs.find((result) => result.element_id === '56').result == null) || !(bill.resulthpvs.find((result) => result.element_id === '56'))" class="text-blue-800 font-bold">
                 Chưa có kết quả
                </div>

              </div>
              </div>
            </td>

            <td class="border-r-2 w-32">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                v-show="bill.resultHpv==1"
                  title="Edit"
                  class="text-green-800"
                    @click="editResult(bill)"
                  >
                   <svg
                    class="w-6 h-6 text-blue-800 cursor-pointer"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    ></path></svg>
                </EditBtn>
                 <EditBtn v-if="bill.resultHpv ==1" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                      <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                </EditBtn>
                <EditBtn title="Nhập KQ" v-else class="" @click="addResult(bill)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-800" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                      <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                </EditBtn>
              </div>
            </td>
          </tr>

        </Table>
        <Table v-else :headers="headers" :addClass="addClass">
          <tr><td colspan="14" class="text-center text-red-600 tesxt-lg ">Không có dữ liệu</td></tr>
        </Table>
         <div class="mt-4">
            <div class="flex">
              <Pagination :links="billtests.links"/>
          </div>
        </div>
          <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
            <template v-slot:title >
               <div class="flex justify-between text-blue-900 font-bold border-b-1 border-blue-200">
                <h3 v-show="!editMode" >Nhập kết quả  </h3>
                <h3 v-show="editMode">Cập nhật kết quả </h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
            <template v-slot:content>
             <div>
                <h1 class="text-bold text-xl text-red-600">Nhập Kết quả HPV</h1>
                 <div class="px-4 pb-0">
                    <div class="grid grid-cols-4 leading-6 mb-2">
                         <div class="col-span-2  font-sans-Timenew italic underline underline_offset-1">Họ và tên (Name): <span class="font-bold">  {{name}}</span></div>
                        <div class="  font-sans-Timenew italic underline underline-offset-1">Test Id:<span ref="" class="font-bold">{{test_id}}</span> </div>
                        <div class="  font-sans-Timenew italic underline underline-offset-1">Mã HPV:<span ref="span_thin" class="font-bold">{{hpv_code}}</span> </div>
                    </div>
                    <hr>
                    <form
                        class="py-1 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                        @submit.prevent="saveResultHPV(form)">
                           <div class="grid grid-cols-4">
                          <template v-for="(elm,i) in testElementsHpv" :key="i">
                                 <div class="w-full px-2">
                                  <span class="font-bold" >{{elm.name}} </span>
                                    <span>
                                      <JetInput  type="text" class="w-full rounded-md h-10"   v-model="form.elment_hpv[elm.id]"/>
                                    </span>
                                </div>
                          </template>
                        </div>
                        <div class="mt-4 text-center mb-1" >
                              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                  <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                      Save
                                    </button>
                                  </span>
                                  <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                      v-show="editMode" @click.prevent="updateResultHpv(form)">
                                      Update
                                    </button>
                                  </span>
                        </div>
                    </form>
                  </div>
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
import Checkbox from "@/Jetstream/Checkbox";

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
import FormTuduVigor from "./FormTuduVigor.vue";
import moment from 'moment'
import { useForm } from '@inertiajs/inertia-vue3'
import Pagination from "@/Components/Pagination";

export default defineComponent({

  name: "Nhập Kết quả HPV Edit",
  props: {
    errors:'',
    billtests:'',
    testElements:'',
    testElementsHpv:'',
    ousents:'',
    doctors:'',
    filters:'',
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
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
    Checkbox,
    FormTuduVigor,
    Pagination

  },

data(){
  return{
    resultFill:this.filters.resultFill,
    ousentFill:this.filters.ousentFill,
    startDate:this.filters.startDate,
    endDate:this.filters.endDate,
    perPage:50,
    doctor_id:'',
    getdoctors:this.doctors,
    termSearch:'',
    doctorFill:'',

    testData:'',
    viewInfo:'',
    viewSCO:true,
    elementHpv:[],
    checkedElement:[],
    ket_luan:[],
    ketluan:'',
    viewOutsent:'',
    name:'',
    test_id:'',
    thinprep_code:'',
    hpv_code:'',
    userEdit:'',
    showModal:'',
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",
    titleHeader:'Nhập kết quả HPV',
    example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options: '',
        searchable: true,
        createTag: true,
    },

    form: this.$inertia.form({
          //element_id:[],
          elment_hpv:[],
          //ket_luan:[],
          bill_id:'',
          //thin_code:'',
          hpv_code:'',
          file: '',
      },
        {
          resetOnSuccess: false,
        }
      ),

    }
  },
  watch:{
    "ousentFill":function(value){
       this.getDoctorFill(value)
    },
  },

   computed: {
    breadcrumbs() {
      return [
         {
          label: "Nhập kết quả HPV Edit",
          class: "text-white",
        },
      ];
    },
   headers() {
      return [
        { name: "Select", class:'w-12  text-center' },
        { name: "#", class:'w-12 border-l-2 text-center' },
        { name: "Mã HPV", class:'border-l-2 text-center' },
        { name: "Tên Bệnh nhân", class:'border-l-2' },

        { name: "Năm sinh", class:'border-l-2 text-center' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center' },
        { name: "Chỉ định XN", class:'border-l-2 text-center' },
        { name: "BS chỉ định", class:'border-l-2 text-center' },
        { name: "Ngày nhận mẫu", class:'border-l-2 text-center' },

        { name: "SCO", class:'border-l-2 text-center' },

        { name: "SCO16", class:'border-l-2 text-center' },
        { name: "SCO18", class:'border-l-2 text-center' },
        { name: "Kết luận", class:'border-l-2 text-center w-72' },
        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-gray-300";
      },
      bgSave(){
        return "bg-gray-600 text-white";
      },
      bgEdit(){
        return "bg-green-500 text-white";
      },
      thin(){
        return this.thinprep_code;
      }
    },
  methods:{
    formatDate(value) {
        if (value) {
            return moment(String(value)).format('DD/MM/YYYY hh:mm')}
        },
    getDoctorFill(doctor){
     const fillData = this.doctors.filter(function(el){
       return el.ousent_id == doctor;
     });
     //console.log(fillData);
     this.getdoctors = fillData;
      },
     search(){
       this.$inertia.get('/dashboard/inputhpv?',
            {
              term:this.termSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
    submitFile() {
            if (this.$refs.photo) {
                this.form.file = this.$refs.photo.files[0];
            }
            //this.form.post('/dashboard/importcustommers/');
            this.form.post(route('importResult'));
            this.$refs.photo.value=null;
            this.form.file = ""
        },

    addResult(bill){
              const getBill = Object.assign({}, bill)

              this.viewOutsent= bill.ousent.id;
              this.name = getBill.custommer.name;
              this.thinprep_code = getBill.thinprep_code;
              this.hpv_code = getBill.hpv_code;

              this.test_id = getBill.id;

              this.viewInfo = getBill;

              this.showModal=true;
            },
    saveResultHPV(data) {
            const data2 = {
              'hpv_code': this.hpv_code,
              'bill_id': this.test_id,
                };
                const data3 = {...data, ...data2 }
                    this.$inertia.post('/dashboard/inputhpv',data3)
                   // this.reset();
                    this.closeModal();
                },
    editResult(bill) {
              this.form = Object.assign({}, bill);

               this.viewOutsent= bill.ousent.id;
              this.name = bill.custommer.name;
             // const viewInfo =bill.results;
              // var ketluanFill = bill.results.find(obj => {
              //          return obj.element_id ==26
              //        })

                let _result = []
                bill.resulthpvs.map(({element_id, result}) => _result[element_id] = result)
                 //console.log({_result})
                this.form.elment_hpv = _result
                this.editMode = true;
                this.showModal=true;
              },
    updateResultHpv(bill){
      console.log({bill});
             const data2 = {
              'hpv_code': bill.hpv_code,
              'bill_id': bill.id,
              'elment_hpv': bill.elment_hpv,
              };
              const data3 = {...bill, ...data2 }
           //const data = bill;
                data2._method = 'PUT';
                this.$inertia.post('/dashboard/inputhpv/'+bill.id, data2);
                this.reset();
                 this.closeModal();
            },

    getPageFill(){
        this.$inertia.get('inputhpv?',
            {
              //alert(ousentFill);
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              //doctorFill:this.doctorFill,
              startDate:this.startDate,
              endDate:this.endDate,
              resultFill:this.resultFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    getfilePerpage(){
         this.$inertia.get('inputhpv?',
            {  //search:this.search,
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              //doctorFill:this.doctorFill,
              startDate:this.startDate,
              endDate:this.endDate,
              resultFill:this.resultFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
     refreshFill(){
       this.startDate="",
       this.endDate="",
       this.resultFill="",
       this.ousentFill="",

        this.$inertia.get('inputhpv?')
     },
    openModal(){
          this.showModal=true;
        },
    reset() {
              this.form = {
                element_id:[],
                elment_hpv:[],
                ket_luan:'',
                bill_id:'',
                thinprep_code:'',
                hpv_code:'',
                }
            },
    closeModal(){
        this.showModal=false;
        this.editMode=false;
        this.reset();
    },

  },

});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
