<template>

    <template>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card class="">
       <div class="w-full">
         <button class="bg-blue-800 cursor-pointer py-2 px-3 rounded-lg text-white mb-4"  @click="printDiv" style="position: fixed; z-index:9999">Print Me</button>
          <div class=" flex justify-center px-0 card-print">
            <div class="w-full" >
              <div class="printMe">
                    <PrintHPV
                      :getbilltests="billtests"
                      :testElements="testElements"
                      :eurolab='eurolab'
                      :ouread='ouread'
                      :pathLogoEurolab='pathLogoEurolab'
                      />
                </div>
          </div>
        </div>
    </div>
      </Card>
    </Container>
</template>

<script>
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import PrintHPV from '@/Pages/PrinviewMulti/FormHPV'

export default {
  name:'In Hpv',
    props: {
      billtests:'',
      testElements:'',
      eurolab:'',
      ouread:'',
  },
  components: {

    Breadcrumb,
    Container,
    Card,
    PrintHPV
   },
   data(){
    return{
      pathLogoEurolab:'/storage/Image_Eurolab/',
    }
   },
   methods:{

      printDiv(){
        window.print();
      },
       currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },
   }
}
</script>



<style media="print" >
@page {
    size: a4;

   margin: 10mm 0.5mm 10mm 0.5mm !important;
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';
    font-size: 20px;
}

@media print {
  /*media="print" .noPrint :not(.printMe){
    display:none;
  }*/
     body {
      padding: 10px 20px;
    visibility: hidden;
  }
  *{
    margin: 0;
    padding: 0;
  }
  .card-print{
    margin: 0;
    padding-left: 0;
    width:110%;
  }
  .nofooter{
    visibility: hidden;
  }
  .printMe {
    visibility: visible;
    padding:0px;
    margin: 0px;


  }




.page-break {page-break-after: always !important; }
.footer {position: absolute; bottom: 0px;}

}

</style>








