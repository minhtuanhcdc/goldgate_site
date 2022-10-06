<template>
  <app-layout title="Add Article">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="text-right w-full">
        <button class="rounded-md mb-1  bg-gray-800 text-white cursor-pointer px-2 py-2 hover:bg-gray-600" type="" @click="printDiv('printMe')" >Print test</button>
        </div>
        <div class="py-4 px-40 " id="printMe">
        <div class="flex justify-between mx-0 py-0">
            <div class=" py-0">
                <img
                  class="h-16 w-42"
                  :src="pathImageLeft"
                  :alt="LogoThin"
                />
            </div>
            <div class="py-0">
              <img
                  class="h-16 w-24 rounded-full"
                  :src="pathImageRight"
                  :alt="LogoThin"
                />
            </div>
        </div>
      <div class="grid grid-cols-5 w-full mt-0 py-0 my-0">
          <div class="col-span-4 text-center">
              <div class="pl-10 py-0 place-items-center">
                    <div class="pl-10 text-center font-bold text-xl underline underline-offset-2 font-sans-Timenew text-blue-700 ">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</div>
                 </div>

          </div>
          <div class="grid text-left text-italy text-md font-bold content-center font-sans-Timenew leading-5  pl-1 py-0">
              <span>Mã y tế:"Ma_Yte"</span>
              <span>STT:"MSTB"</span>
            </div>
      </div>
      <!--==============--->
      <div class="font-bold text-blue-800 font-sans-Timenew text-md">THÔNG TIN BỆNH NHÂN</div>
      <div class="grid grid-cols-4 leading-6">
          <div class="col-span-2 font-bold font-sans-Timenew">Họ tên:</div>
          <div class="font-bold text-md font-sans-Timenew">Năm sinh:</div>
          <div class=" font-bold font-sans-Timenew ">Para: </div>
      </div>
      <div class="font-bold font-sans-Timenew leading-6">Đia chỉ</div>
      <div class="font-bold font-sans-Timenew leading-6">Chẩn đoán lâm sàng:</div>
      <div class="grid grid-cols-3 font-sans-Timenew leading-6">
          <div class="font-bold col-span-2">Bác sỹ lấy mẫu:</div>
          <div class="font-bold">Ngày lấy mẫu:</div>
      </div>
       <!--/==============--->
        <!--==============--->
        <div class="text-center font-bold text-md underline underline-offset-2 font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
        <div class="text-left font-bold text-md  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
         <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
         </div>
         <div class="grid grid-cols-5">
           <div class=" col-span-2  text-left font-bold text-md  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>
           <div class=" col-span-2 font-bold flex flex-row  content-center font-sans-Timenew py-0 text-md">
           <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i>
              Đạt yêu cầu chẩn đoán
            </div>
           <div class="  content-center font-sans-Timenew py-1"> Không đạt yêu cầu,vì:</div>
           <div></div>
         </div>
         <!--/==============--->
         <!--==============--->
         <div class="font-bold text-blue-800 font-sans-Timenew text-md mt-0">KẾT QUẢ</div>
         <div class="grid grid-cols-3">
            <div class="mr-1">
            <span  class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700 leading-5">
              <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>Không tổn thương trong biểu mô hay ung thư</span>
            </div>
            <div>
            <span  class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700"><i class="fa fa-square-o mr-1"></i>bất thường tế bào biểu mô</span>
            </div>

            <div class="flex flex-col">
               <div> <i class="fa fa-square-o mr-1"></i>
            <span  class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Bất thường khác</span>
            </div>
              <span><i class="fa fa-square-o mr-1 font-sans-Timenew"></i>Tế bào nội mạc tử cung</span>
            </div>
         </div>

         <div class="grid grid-cols-3 mt-2">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào do vi sinh</span>
              <div class="flex flex-col leading-5">
                <span class="ml-3 font-bold italic font-sans-Timenew text-sm" v-for="(e, i) in 5" :key="i"><i class="fa fa-square-o mr-2"> </i>Element-{{i}}</span>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Gai</span>
              <div class="flex flex-col leading-5">
                <span class="ml-3 font-bold font-sans-Timenew text-sm" v-for="(e, i) in 5" :key="i"><i class="fa fa-square-o mr-2"> </i>Element-{{i}}</span>
              </div>
            </div>


         </div>
         <div class="grid grid-cols-3 mt-2">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Biến đổi tế bào khác</span>
              <div class="flex flex-col">
                <span class="ml-3 font-bold leading-5 font-sans-Timenew text-sm" v-for="(e, i) in 5" :key="i"><i class="fa fa-square-o mr-2"> </i>Element-{{i}}</span>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào tuyến</span>
              <div class="flex flex-col leading-5">
                <span class="ml-3 font-bold text-sm" v-for="(e, i) in 5" :key="i"><i class="fa fa-square-o mr-2"> </i>Element-{{i}}</span>
              </div>
            </div>


         </div>

         <div class="grid grid-cols-2">
            <div  class="text-center">
              <img
                  class="w-80 max-h-48 "
                  :src="pathThinLeft"
                  :alt="LogoThin"/>
                </div>
            <div class="text-center">
              <img
                  class="w-80 max-h-48 "
                  :src="pathThinRight"
                  :alt="LogoThin"/>
              </div>

         </div>
         <div class="grid grid-cols-3">
           <div class="col-span-2">
             <div class="grid grid-cols-1">
               <span class="font-bold text-blue-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN</span>
               <span class="font-bold text-red-700 font-sans-Timenew text-md">- Không tổn thương trong biểu mô hay ung thư</span>
               <span class="font-bold text-md font-sans-Timenew">- Tế bào cổ tử cung biến đổi do viêm</span>
             </div>

              <div class="font-bold text-blue-800 font-sans-Timenew text-md underline underline-offset-2">ĐỀ NGHỊ:</div>
           </div>
           <div class="grid grid-cols-1 text-center">
             <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả:</span>
             <span class="mb-16 font-bold font-sans-Timenew text-md">BÁC SĨ ĐỌC KẾT QUẢ</span>
             <span class="font-bold font-sans-Timenew text-md">"tên Bác sỹ"</span>
             <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
             <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
           </div>
           </div>
           <div class="grid grid-cols-3 -mt-8">
             <div class="col-span-2">
               <div class="w-full flex flex-col font-bold">
                 <span class="font-sans-Timenew text-xs">Tầng 4-5-6-7 số 9-11-13-15 Trịnh Văn Cấn, P.Cầu Ông Lãnh, Q.1, TP.HCM</span>
                 <span class="font-sans-Timenew text-xs">Tel: +848 28 213 456 * F: +848 28 210 799 * W: www.taimuihongsg.com</span>
                 </div>

             </div>
             <div></div>
           </div>
    </div>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import AppTable from "@/Components/Table";
import EditBtn from "@/Components/EditButton";

import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import Checkbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import CompSimplePage from "@/Components/SimplePage";

import { strSlug } from "@/helpers.js";

export default {
  name: "Add Category",
  props: {
    edit: Boolean,
    articles: Object,
  },
  data(){
    return{
      pathImageRight:'/images/Logo/Thinprep.jpg',
      pathImageLeft:'/images/Logo/LogoSG.png',
      pathThinLeft:'/images/Thinprep/hLeft.jpg',
      pathThinRight:'/images/Thinprep/hRight.jpg',
    }
  },
  components: {
    AppLayout,
    Container,
    Card,
    Breadcrumb,
    EditBtn,

    DeleteBtn,
    CompSimplePage,
    AppTable,
    JetButton,
    Checkbox,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
  },
  computed: {

    breadcrumbs() {
      return [{ label: "Article", class: "text-red-800" }];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Title" },
        { name: "Category" },
        { name: "Image" },
        { name: "Slug" },
        { name: "Description" },
        { name: "created_at_for_humans" },
        { name: "Actions", class: "text-right pr-2" },
        { classHeader: "bg-yellow-500" },
      ];
    },
    addClass() {
      return "bg-red-500 text-white";
    },
  },
  watch:{

  },
  methods:{
   printDiv(divName){

			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;
      window.close();
      window.print();
      window.focus();

			document.body.innerHTML = originalContents;
    return false;

		}
  }
};
</script>

<style media="print">
 @media print{
   #printMe{
     display: block;
     padding-left:40px;
   }


   @page{
     margin-left:75px;
     margin-right:75px;
   }
 }
</style>
