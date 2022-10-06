<template>
  <div class="w-80 m-auto flex flex-col   bg-gray-400">
      <div class=" bg-red-700 px-4 w-full text-right"><span class="bg-blue-800 cursor-pointer py-1 px-3 rounded-lg text-white"  @click="printDiv" style="position:fixed; z-index:9999">Print Hpv Code</span> </div>

      <div class="container_all">
          <div class="">
            <div class="" v-for="(b,i) in billtests" :key="i">
              <div class="frame_print text-center border-1">
                <span class="font-bold mb-1 text-xs">{{b.custommer.name}} - {{b.custommer.birthday}}</span>
                <p class="-my-2 flex justify-center py-1" v-if="b.hpv_code">
                  <vue-barcode class="h-8 w-28" :value="b.hpv_code" :options="{ displayValue: false }"></vue-barcode>
                </p>
                <p v-else></p>
                <span class="font-bold z-40 text-sm">{{b.hpv_code}}</span>
              </div>
          <div class="page-break"></div>


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
  .container_all{
    visibility: visible;
    display: flex;
    flex-direction: column;
  }

  .container_print{
    visibility: visible;
    width: 100%;
    background: greenyellow;
    position: relative;
    display: flex;
    justify-content: center;
    justify-items: center;
  }

  .frame_print {
    visibility: visible;
    position: relative;
    width: 100%;
    margin: auto;
    border:1px solid gray;
    width: 150px;
    height: 75px;

    top: 100%;

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


