<template>
  <div class="w-80 m-auto flex flex-col   bg-gray-200">
      <div class=" bg-red-700 px-4 w-full text-right"><span class="bg-blue-800 cursor-pointer py-1 px-3 rounded-lg text-white"  @click="printDiv" style="position:fixed; z-index:9999">Print Thin Code</span> </div>

      <div class="container_all">
          <div class="">
            <div class="" v-for="(b,i) in billtests" :key="i">
             <template v-for="i in 3" :key="i.index">
              <div class="frame_print text-center border-1">
                <span class="name_print font-bold text-xs">{{b.custommer.name}} - {{b.custommer.birthday}}</span>
                <p class="badcode_print -my-1 flex justify-center" v-if="b.thinprep_code">
                  <vue-barcode class="h-8 w-28" :value="b.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
                </p>
                <p v-else></p>
                <span class="code_print font-bold z-40 text-xs">{{b.thinprep_code}}</span>
              </div>
          <div class="page-break"></div>
             </template>


              <!-- <div class="">Print code</div>
          <div class="page-break"></div>

              <div class="">Print code</div> -->
            </div>

        </div>

      </div>

</div>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

import Container from "@/Components/Container";
import Card from "@/Components/Card";

import moment from 'moment'
import VueBarcode from '@chenfengyuan/vue-barcode';

export default defineComponent({

  name: "Danh sách(Report)",
  props: {
    billtests:''
  },
  components: {
    AppLayout,
    Container,
    Card,
    VueBarcode
  },
data(){
  return{

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
  .frame_print{
    display: flex;
    visibility: visible;
    flex-direction: column;
    flex-wrap: nowrap;
    border: 1px solid #7F8C8D;
    width: 152px;
    height: 56px;
    padding: 1px 0px;
    margin: auto;

  }
  .name_print{
    text-align:center;
    vertical-align: bottom;
  }



  @page{
    size: 110mm 72mm;
   /* margin: 20mm 0.5mm 0.1mm 0.1mm !important; */
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';
    margin-top: 20%;

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


