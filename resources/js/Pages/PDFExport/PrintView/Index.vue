<template>
  <app-layout title="Print view">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>

       <div class="w-4xl pl-2" ref="printMe" id="printMe" >
                      <div class="grid grid-cols-8 mx-0 py-0">
                          <div class="col-span-2 py-0">
                              <img
                                class="w-36"
                                :src="pathImageLeft"
                                :alt="LogoThin"
                              />
                          </div>
                          <div class="col-span-4 text-center mt-4">
                              <div class="pt-0 py-0 place-items-center flex flex-col">
                                    <span class="text-center font-bold text-2xl font-sans-Timenew ">PHIẾU XÉT NGHIỆM TẾ BÀO</span>
                                    <div>
                                      <span class="text-center font-bold text-2xl font-sans-Timenew ml-0 pl-0">PAP'S SMEAR - ThinPrep</span>
                                      <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>
                                    </div>
                                    <span class="text-center font-bold text-md font-sans-Timenew ">REQUEST FOR COLLECTION OF SPECIMEN</span>
                                </div>
                          </div>
                          <div class="col-span-2 text-left text-italy text-sm font-bold font-sans-Timenew  mt-8 w-full">
                                <span class="p-0 m-0 w-full text-xs">Số(Number):{{getbilltests['thinprep_code']}}/2022</span>
                          </div>
                      </div>
                        <div class="grid grid-cols-4 leading-6 text-md">
                              <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class=" font-bold">{{printCustommers['name']}}</span></div>
                              <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{printCustommers['birthday']}}</span></div>
                              <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
                          </div>
                          <div class="grid grid-cols-4 text-md">
                              <div class="col-span-3 font-sans-Timenew leading-6 italic">Đia chỉ(Address12313212):<span class="pl-2 font-bold">{{printCustommers['address']}}</span></div>
                              <div class=" font-sans-Timenew leading-6 italic">Số điện thoại:<span class="pl-2 font-bold">???</span></div>
                          </div>
                          <div class="font-sans-Timenew leading-6 italic text-md">Đơn vị gửi(Custommer):<span class="pl-2 font-bold">{{printOutsent['name']}} </span></div>
                          <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic">
                              <div class="font-bold">IUD (Intra-Uterine Devices) <i class="fa fa-square-o mt-2"></i></div>
                              <div class="font-bold text-center">Nội tiết (Hormone) <i class="fa fa-square-o mt-2"></i></div>
                              <div class="font-bold text-center">Xạ (Radiation) <i class="fa fa-square-o mt-2"></i></div>
                              <div class="font-bold text-center">Có thai (Pregnancy) <i class="fa fa-square-o mt-2"></i></div>
                          </div>
                          <div class="grid grid-cols-2 italic text-md">
                              <div class="font-sans-Timenew leading-6">Kinh chót(Last Menstrual Period):<span class="font-bold pl-2">{{getbilltests['kinhchot']}}</span></div>
                              <div class="text-center font-sans-Timenew leading-6">Ngày gửi (Date sent):<span class="font-bold">??</span></div>
                          </div>
                            <div class="grid grid-cols-2 italic text-md">
                              <div class="font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>
                              <div class="font-sans-Timenew leading-6">Bs. Chỉ định(Physician):<span class="font-bold pl-2" v-if="printDoctor"> {{printDoctor['name']}}</span></div>
                          </div>
                      <div>
                            <div class="text-center font-bold text-xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

                            <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                              <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                                <div class="col-span-3 grid grid-cols-2" >
                                  <div class="" v-for="eg1 in testElements" :key="eg1.id">
                                    <span class="font-bold" v-if="eg1.element_group == 1">{{eg1.name}}
                                        <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg1.id" v-model="selectedArray"/>
                                      </span>
                                  </div>
                            </div>
                            </div>
                            <div class="grid grid-cols-1">
                                  <div class="" v-for="eg2 in testElements" :key="eg2.id">
                                      <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">- {{eg2.name}}
                                      <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg2.id" v-model="selectedArray"/>
                                      </span>
                                  </div>
                              </div>
                          <div class="flex flex-cols-5">
                              <div class="" v-for="eg3 in testElements" :key="eg3.id">
                                  <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                                      <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg3.id" v-model="selectedArray"/>
                                  </span>
                              </div>
                          </div>
                          <div class="grid grid-cols-1">
                              <div class="" v-for="eg4 in testElements" :key="eg4.id">
                                  <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg4.element_group == 4">- {{eg4.name}}
                                        <!-- <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg4.id" v-model="form.element_id"/> -->
                                  </span>
                              </div>
                          </div>

                            <div class="col-span-2">
                                  <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                                  <div class="grid grid-cols-2 leading-5 italic">
                                    <div class="flex flex-col">
                                      <div v-for="(eg5, i) in testElements" :key="i">
                                  <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">{{eg5.name}}
                                    <!-- <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg5.id" v-model="form.element_id"/> -->
                                    </span>
                                </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="" v-for="(eg6, i) in testElements" :key="i">
                                        <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                          <!-- <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg6.id" v-model="form.element_id"/> -->
                                        </span>
                                    </div>
                                    </div>

                                  </div>
                              </div>

                            <div class="grid grid-cols-1 mt-2">
                                <div>
                                  <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Tuyến</span>
                                  <div class="flex flex-row leading-5">
                                    <div v-for="eg7 in testElements" :key="eg7.id">
                                      <div v-if="eg7.element_group == 7">
                                        <span class="text-left font-bold text-xs ml-4 mr-6  font-sans-Timenew" >{{eg7.name}}
                                          <!-- <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg7.id" v-model="form.element_id"/> -->
                                          </span>
                                        </div>
                                </div>
                                  </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-2">
                              <div class="font-bold m-0 p-0">Đề nghị (Suggestions):</div>
                              <div class="font-bold col-span-3">
                                <div class="flex flex-rows-2">
                                <div  v-for="eg8 in testElements" :key="eg8.id">
                                    <span class="font-bold text-xs w-full mr-3" v-if="eg8.element_group ==8 && eg8.element_group !==null ">{{eg8.name}}
                                        <!-- <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg8.id" v-model="form.element_id"/> -->
                                    </span>
                                  </div>
                                  </div>
                              </div>
                            </div>
                            <div class="grid grid-cols-2 mt-2 text-center">
                                <div  class="text-center">
                                  <img v-if="imageThinLeft"
                                      class="w-80 max-h-52 "
                                      :src="pathThinLeft+imageThinLeft"
                                      :alt="imageThinLeft"/>

                                  <img v-else
                                      class="w-80 max-h-52 "
                                      :src="pathThinLeft"
                                      alt="imageThinLeft"/>
                                  </div>
                                <div class="text-center">
                                  <img v-if="imageThinLeft"
                                      class="w-80 max-h-52 "
                                      :src="pathThinRight+imageThinLeft"
                                      :alt="LogoThin"/>
                                  <img v-else
                                      class="w-80 max-h-52 "
                                      src="pathThin"
                                      alt="LogoThin"/>
                                  </div>
                            </div>
                            <div class="grid grid-cols-3">
                              <div class="col-span-2">
                                <div class="grid grid-cols-1">
                                  <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                                  <span class="font-bold text-red-700 font-sans-Timenew text-xs uppercase">- Không tổn thương trong biểu mô hay ung thư</span>
                                  <span class="font-bold text-md font-sans-Timenew">- Tế bào cổ tử cung biến đổi do viêm</span>
                                </div>
                              </div>
                              <div class="grid grid-cols-1 text-center">
                                <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả:</span>
                                <span class="mb-16 font-bold font-sans-Timenew text-md" style="margin-bottom:40px">BS/KTV đọc kết quả:</span>
                                <span class="font-bold font-sans-Timenew text-md" v-if="printDoctor">{{printDoctor['name']}}</span>
                                <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
                                <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
                              </div>
                            </div>
                        </div>
      </div>

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

import { BeakerIcon } from '@heroicons/vue/solid'
import { PencilIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import { useForm } from '@inertiajs/inertia-vue3'

import pdfMake from 'pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import htmlToPdfmake from 'html-to-pdfmake';

export default defineComponent({

  name: "Danh sách bệnh nhân",
  props: {
    billtests:'',
    nametests:'',
    testElements:'',
    provinces:'',
    districts:'',
    wards:'',
    ousents:'',
    doctors:'',
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
     PencilIcon,
    CheckIcon,
    BeakerIcon,

  },
data(){
  return{
checkPrint:[],
 url: null,
    getbilltests:'',
     printCustommers:'',
    //printName:'',
    //printAge:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',
    selectedArray:'',
    imgeLeft:'',

  output: null,
    ousentFill:this.filters.ousentFill,
     pathThinLeft:'/storage/imageThinLeft/',
    pathImageLeft:'/images/Logo/Thinprep.jpg',
   // pathThinLeft:'/images/Thinprep/hLeft.jpg',
   // pathThinRight:'/images/Thinprep/hRight.jpg',
    pathThinRight:'/storage/imageThinRight/',

    getdistricts:'',
    getwards:'',
    getdoctors:'',
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
        options: this.nametests.data,
        searchable: true,
        createTag: true,
    },
    formUpload: this.$inertia.form({
      name: null,
      avatar: null,
    }),
    form: this.$inertia.form({
         // "_method": this.edit ? 'PUT' : "",bỉ
        name: "",
        birthday: "123",
        ousent_id: "",
        kinhchot: "",
        phone: "",
        gender: '',
        address: "",
        province_id: "",
        district_id:'',
        ward_id:'',
        testname_id:[''],
        selected:[],
        element_id:[],
        diagnose:'',

      },
        {
          resetOnSuccess: false,
        }
      ),
    }
  },
setup() {
        const form = useForm({
            file: null,
        });

        return { form };
    },

  watch:{
     elementSearch:function(){
       //console.log(this.elementSearch);
       this.getelementSearch(this.elementSearch)
    },
    "form.province_id":function(value){
      // console.log(value);
       this.getDistrictFill(value)
    },
    "form.district_id":function(value){
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
          label: "Danh sách gửi mẫu",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "Check", class:'w-12 text-center' },
        { name: "#", class:'w-12 text-center' },
        { name: "Tên khách hàng", class:'border-l-2 text-center w-52 px-2 font-normal' },
        { name: "Giới tính", class:'border-l-2 text-center w-8 px-2 font-normal' },
        { name: "Năm sinh", class:'border-l-2 text-center px-0 font-normal' },
        { name: "Địa chỉ", class:'border-l-2 text-center font-normal' },
        { name: "Điện thoại", class:'border-l-2 text-center px-1 font-normal' },
        { name: "Tên xét nghiệm", class:'border-l-2 text-center font-normal' },
        { name: "Mã Thinprep", class:'border-l-2 text-center font-normal' },
        { name: "Mã HPV", class:'border-l-2 text-center font-normal' },
        { name: "Bác sỹ chỉ định", class:'border-l-2 text-center font-normal' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Kết quả", class:'border-l-2 text-center font-normal' },
        { name: "Action", class: "text-right border-l-2 font-normal" },
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
    if (this.edit) {
       //this.checkededit=this.labogroups.data.status==1? true:false;
      //this.form.testname_id=[1];
      // //this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      //this.form.name =123;
      // this.form.username =this.user.data.username;
      // this.form.email = this.user.data.email;
      // this.form.phone = this.user.data.phone;
      // this.imageUrl = this.user.data.profile_photo_path;
    }
  },
  methods:{
    exportPDF(){
          this.$inertia.get('/dashboard/printview?',
            {
              billId:this.checkPrint,
              //testName:this.testName,
             // elementSearch:data
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
    dowloadPDF(){
      this.$inertia.get('/dashboard/downloadPDF/');
    },
     printDocument() {
          //get table html
          const pdfTable = document.getElementById('exportMe');
          //html to pdf format
          var html = htmlToPdfmake(pdfTable.innerHTML);

          const documentDefinition = { content: html };
          pdfMake.vfs = pdfFonts.pdfMake.vfs;
          pdfMake.createPdf(documentDefinition).open();

    },

    submitFile() {
            if (this.$refs.photo) {
                this.form.file = this.$refs.photo.files[0];
            }
            this.form.post('/dashboard/importcustommers/');
        },
        previewImage(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },

  // importFile(data) {
  //       this.$inertia.post('/dashboard/importcustommers/',data)
  //     },
     updateCustommer(bill){
        bill._method = 'PUT';
        this.$inertia.post('/dashboard/custommers/'+bill.id, bill);
        this.reset();
        this.closeModal();
    },
      updateOusent(bill){
          this.$inertia.post('/dashboard/updatecustommer/',bill);
          this.closeModal();
        },
    currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },
    printDiv(divName){
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

        if(bill.image_left){
           this.imgeLeft = bill.image_left.thinLeft;
        }
        else{
          this.imageLeft='';
        }
        const elementChecked1 = bill.results;
         let result = elementChecked1.map(({ element_id }) => element_id)
        this.selectedArray = result;
        this.printAddress=' '+ bill.custommer.address;
        this.showModlPrint = true;

    },
    getDoctorFill(doctor){
      //console.log(this.doctors);
     const fillData = this.doctors.filter(function(el){
       return el.ousent_id == doctor;
     });
     //console.log(fillData);
     this.getdoctors = fillData;
      },
    getDistrictFill(province){
      alert(province)
     const fillData = this.districts.filter(function(el){
       return el.province_id == province;
     });
     this.getdistricts = fillData;
      },
    getWardFill(district){
     const fillWards = this.wards.filter(function(el){
       return el.district_id == district;
     });
     this.getwards = fillWards;
      },
   scrollToView(element){
    var offset = element.offset().top;
    if(!element.is(":visible")) {
        element.css({"visibility":"hidden"}).show();
        var offset = element.offset().top;
        element.css({"visibility":"", "display":""});
    }

    var visible_area_start = $(window).scrollTop();
    var visible_area_end = visible_area_start + window.innerHeight;

    if(offset < visible_area_start || offset > visible_area_end){
         // Not in view so scroll to it
         $('html,body').animate({scrollTop: offset - window.innerHeight/3}, 1000);
         return false;
    }
    return true;
  },
    getelementSearch(data){
       this.$inertia.get('testelements?',
            {
              perPage:this.perPage,
              testName:this.testName,
              elementSearch:data
            },
            {
              preserveState:true,
              replace:true            }
            )
      },
    saveCustommer(data) {
      try {
          this.$inertia.post('/dashboard/custommers',data)
          this.closeModal();
      } catch (error) {
        console.log(error);
      }

    },
    getPageFill(){
        this.$inertia.get('custommers?',
            {
              //alert(ousentFill);
              perPage:this.perPage,
              ousentFill:this.ousentFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    getfilePerpage(){
         this.$inertia.get('custommers?',
            {  //search:this.search,
              perpageFill:this.perpageFill,
              ousentFill:this.ousentFill,

            },
            {
              preserveState:true,
              replace:true            }

            )
     },
     refreshFill(){
        this.$inertia.get('custommers?',
             { //perpageFill:this.perpageFill,
             // ousentFill:this.ousentFill
             },
            {
              preserveState:true,
              replace:true            }

            )
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
            this.form = {
            name: null,
            birthday: null,
            ousent_id: null,
            kinhchot: null,
            phone: "",
            gender: '',
            address: "",
            province_id: null,
            district_id:null,
            ward_id:null,
            testname_id:[''],
            selected:[],
            diagnose:'',
                }
            },
    addCustommer(){
            this.showModal = true;
            },
    editCustommer(bill) {

        var bilForm=this.form = Object.assign({}, bill);
        this.checkededit= bilForm.status
        this.form.name=bilForm.custommer.name;
        this.form.gender=bilForm.custommer.gender;
        this.form.birthday=bilForm.custommer.birthday;
        this.form.address=bilForm.custommer.address;
        const tesnameBill=bilForm.testnames;
        this.form.testname_id = tesnameBill[0].id;

         const provinceBill=bilForm.province;
         if(provinceBill){
            this.form.province_id = provinceBill.id;
         }
         const districtBill=bilForm.district;
         if(districtBill){
            this.form.district_id = districtBill.id;
         }
         const wardBill=bilForm.ward;
         if(wardBill){
            this.form.ward_id = wardBill.id;
         }

        this.editMode = true;
        this.showModal=true;
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
  }
   body * {
    visibility: hidden;
  }*/
  #printMe * {
    visibility: visible;
    padding:0px;
    margin: 0px;
  }
  @page{
    size: a4;
    /* margin: 05mm 15mm 5mm 10mm; */
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';
    /* font-size: 20px; */
   }
   @page :left {
         margin-left: 1cm;
         /* margin-right: 2cm; */
      }

      @page :right {
         margin-left: 1cm;
         /* margin-right: 2cm; */
      }
}


</style>