<template>

    <template>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class=" m-0 p-0">
      <button class="bg-blue-800 cursor-pointer py-2 px-3 rounded-lg text-white"  @click="printDiv" style="position:fixed; z-index:9999">Print Me</button>
        <div class=" mt-0 pt-0" >
      <div class="printMe m-0 p-0" v-if="this.billGroup_1">
              <PrintviewGroup1
               :getbilltests="this.billGroup_1"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent" :printDoctor="printDoctor"
                :ImageThin="ImageThin"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                :pathLogo='pathLogo'
                :pathAsign='pathAsign'
              />
      </div>
      <div class="printMe m-0 p-0" v-if="this.billGroup_2">
              <PrintviewSaigon
               :getbilltests="this.billGroup_2"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                 :printDoctor="printDoctor"
                :pathImageLeft="pathImageLeft"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogo='pathLogo'
                :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                :pathAsign='pathAsign'
              />
        </div>
      <div class="w-full m-0 p-0" v-if="this.billGroup_3">
              <PrintviewMekong
                 :getbilltests="this.billGroup_3"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent" :printDoctor="printDoctor"
                :pathImageLeft="pathImageLeft"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogo='pathLogo'
                  :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                :pathAsign='pathAsign'
              />
      </div>
      <div class="printMe m-0 p-0" v-if="this.billGroup_4">
              <PrintviewVigor
               :getbilltests="this.billGroup_4"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent"
                 :printDoctor="printDoctor"
                :pathImageLeft="pathImageLeft"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                :pathAsign='pathAsign'
              />
      </div>
      <div class="printMe m-0 p-0" v-if="this.billGroup_5">
              <PrintviewErolab
                 :getbilltests="this.billGroup_5"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent" :printDoctor="printDoctor"
                :pathImageLeft="pathImageLeft"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogo='pathLogo'
                :readcodes='readcodes'
                :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                :pathAsign='pathAsign'
              />
      </div>
         <div class="printMe m-0 p-0" v-if="this.billGroup_6">
              <PrintviewDHYD
               :getbilltests="this.billGroup_6"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent" :printDoctor="printDoctor"
                :ImageThin="ImageThin"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                 :pathLogo='pathLogo'
                 :pathAsign='pathAsign'
              />
          </div>
         <div class="printMe m-0 p-0" v-if="this.billGroup_general">
              <PrintviewGenaral
               :getbilltests="this.billGroup_general"
               :testElements="testElements"
               :printCustommers="printCustommers"
                :printOutsent="printOutsent" :printDoctor="printDoctor"
                :ImageThin="ImageThin"
                :pathThinLeft='pathThinLeft'
                :pathThinRight='pathThinRight'
                :selectedArray='selectedArray'
                :ketluan='ketluan'
                :currentDate='currentDate()'
                :imageThinLeft='imgeLeft'
                :imageThinRight='imageRight'
                :pathLogoEurolab='pathLogoEurolab'
                :eurolab='eurolab'
                 :pathLogo='pathLogo'
                 :pathAsign='pathAsign'
              />
          </div>
        </div>
    </div>

    </Card>
  </Container>

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

import PrintviewGroup1 from '@/Pages/PrinviewMulti/FormGroup_1'
import PrintviewSaigon from '@/Pages/PrinviewMulti/FormSaigon'
import PrintviewMekong from '@/Pages/PrinviewMulti/FormMekong'
import PrintviewVigor from '@/Pages/PrinviewMulti/FormVigor'
import PrintviewGenaral from '@/Pages/PrinviewMulti/FormGenaral'
import PrintHPV from '@/Pages/PrinviewMulti/FormHPV'
import PrintviewErolab from '@/Pages/PrinviewMulti/FormErolab'
import PrintviewDHYD from '@/Pages/PrinviewMulti/FormDHYD'

import { BeakerIcon } from '@heroicons/vue/solid'
import { PencilIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import { useForm } from '@inertiajs/inertia-vue3'
import moment from 'moment'

export default defineComponent({
  name: "Danh sách(Report)",
  props: {
    eurolab:'',
    billGroup_1:'',
    billGroup_2:'',
    billGroup_3:'',
    billGroup_4:'',
    billGroup_5:'',
    billGroup_6:'',
    billGroup_general:'',

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

    PrintviewGroup1,
    PrintviewSaigon,
    PrintviewMekong,
    PrintviewVigor,
    PrintviewDHYD,
    PrintviewGenaral,
     PencilIcon,
    CheckIcon,
    BeakerIcon,
    PrintHPV,
    PrintviewErolab,

  },
data(){
  return{
    sco:'',
    logo:'',
    testselect:[1],
    checkDPF:[''],
    checkPrint:[],
    billPrint:'',
    url: null,
    //getbilltests:this.billtudus,
     printCustommers:'',
    //printName:'',
    //printAge:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',
    printNameTest:'',
    selectedArray:[2,4,5,6],
    imgeLeft:'',
    imageRight:'',
    ketluan:'BT biên đổi do viêm',

    output: null,
    ousentFill:"",

    pathLogoEurolab:'/storage/Image_Eurolab/',

    pathThinLeft:'/storage/imageThinLeft/',
    pathThinRight:'/storage/imageThinRight/',
    pathLogo:'/storage/Image_Ousent/',
    pathAsign:'/storage/Image_Ouread/',

    ImageThin:'/images/Logo/Thinprep.jpg',

    getOusents:this.ousents,
    getdistricts:this.district,
    getwards:'',
    getdoctors:this.doctors,
    form_errors:[],

    name:'123',
    perPage:'',
    checkededit:'',

    userEdit:'',
    showModal:'',
    showModlPrint:false,
    showModlPrintMulti:false,
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",

    }
  },
  computed: {
  },
  methods:{
      printDiv(){
          window.print();
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
    closeModalPrint(){
         this.showModlPrint = false;
    },
  }
});

</script>
<style media="print">
@media print {
  /* .noPrint :not(.printMe){
    display:none;
  }*/
     body {
    visibility: hidden;

  }
  .nofooter{
    visibility: hidden;
  }
  .printMe {
    visibility: visible;
    width: 100%;

  }

 .fontsizeTitle{
    font-size: 14pt;
  }
  .fontsizeKQ{
    font-size: 18pt;
  }
  .fontsizeInfo{
    font-size: 12pt;
    line-height: 1.5;
  }
  .fontsizeName{
    font-size: 10pt;
  }
  .fontsizeElement{
    font-size: 8pt;

  }
  .fontsizeElement2{
    font-size: 7pt;

  }

  .fontsizeBottom{
    font-size: 16pt;
  }

  @page{
    size: a4;
   margin: 10mm 0.5mm 0.5mm 0.5mm !important;
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';


     /* @page :top {
         margin-top: 0cm;
      }
     @page :left {
         margin-left: 0.5cm;
      }
      @page :right {
         margin-right: 0.5cm; */

      }
.page-break {page-break-after: always !important; }
/* .footer {position: absolute; bottom: 0px;} */

}

</style>


