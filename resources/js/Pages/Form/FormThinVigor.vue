<template>
  <app-layout title="Form Vigor">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="text-right w-full">
        <button class="rounded-md mb-1  bg-gray-800 text-white cursor-pointer px-2 py-2 hover:bg-gray-600" type="" @click="printDiv('printMe')" >Print test</button>
        </div>
        <div class="py-4 px-40 " id="printMe">
          <div>
            <div class="col-span-2 py-0">
                  <img
                    class="max-h-24 w-full"
                    :src="pathImageTop"
                    :alt="LogoThin"
                  />
              </div>
          </div>
          <div class="grid grid-cols-8 mx-0 py-0">
                    <div class="col-span-6 ">
                      <div class="text-center pl-40">
                          <div class="font-bold text-xl font-sans-Timenew">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                          <span class="font-bold text-xl font-sans-Timenew">PAP'S SMEAR - ThinPrep</span>
                      </div>
                    </div>
                    <div>
                      <span class="text-xs font-sans-Timenew font-bold mt-2">Số(Number):"12345678910"/2022</span>
                    </div>
          </div>

      <!--==============--->

      <div class="grid grid-cols-4 leading-6">
          <div class="col-span-2 font-bold font-sans-Timenew italic">Họ và tên (Name):</div>
          <div class="font-bold text-md font-sans-Timenew italic">Tuổi (Age):</div>
          <div class=" font-bold font-sans-Timenew italic">Para: </div>
      </div>
      <div class="grid grid-cols-4">
          <div class="col-span-3 font-bold font-sans-Timenew leading-6 italic">Đia chỉ(Address):</div>
          <div class="font-bold font-sans-Timenew leading-6 italic">Số điện thoại:</div>
      </div>

      <div class="font-bold font-sans-Timenew leading-6 italic">Đơn vị gửi(Custommer):</div>
      <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic">
          <div class="font-bold">IUD (Intra-Uterine Devices) <i class="fa fa-square-o mt-2"></i></div>
          <div class="font-bold text-center">Nội tiết (Hormone) <i class="fa fa-square-o mt-2"></i></div>
          <div class="font-bold text-center">Xạ (Radiation) <i class="fa fa-square-o mt-2"></i></div>
          <div class="font-bold text-center">Có thai (Pregnancy) <i class="fa fa-square-o mt-2"></i></div>
      </div>

       <div class="grid grid-cols-2 italic">
          <div class="font-bold font-sans-Timenew leading-6">Kinh chót(Last Menstrual Period):</div>
          <div class="font-bold text-center font-sans-Timenew leading-6">Ngày gửi (Date sent):</div>
      </div>
        <div class="grid grid-cols-2 italic">
          <div class="font-bold font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnossis):</div>
          <div class="font-bold font-sans-Timenew leading-6">Bs. Chỉ định(Physician):</div>
      </div>
       <!--/==============--->
        <!--==============--->
        <div class="text-center font-bold text-xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

        <div class="grid grid-cols-5 font-sans-Timenew leading-6">
          <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
          <div class="font-bold text-center align-midle italic">Đạt (Satisfactory) <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i></div>
          <div class="font-bold text-center italic col-span-2">Không đạt (Unsatisfactory) <i class="fa fa-square-o"></i></div>
        </div>
        <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Bình thường <i class="fa fa-square-o"></i></div>
        <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Biến đổi lành tính(Begin changes) <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i></div>
        <div class="grid grid-cols-5 font-sans-Timenew leading-6 italic text-xs">
          <div class="font-bold">+ Trichomonas vaginalis<i class="fa fa-square-o "></i></div>
          <div class="font-bold text-center">+ Candida spp <i class="fa fa-square-o"></i></div>
          <div class="font-bold text-center">+ Antinomyces spp <i class="fa fa-square-o"></i></div>
          <div class="font-bold text-center">+ Herpes siplex virus <i class="fa fa-square-o "></i></div>
          <div class="font-bold text-center">+ Khác (Other) <i class="fa fa-square-o"></i></div>
          </div>
          <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Bất thường tế bào biểu mô <i class="fa fa-square-o"></i></div>
         <!--/==============--->
         <!--==============--->
        <div class="col-span-2">
              <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
              <div class="grid grid-cols-2 leading-5 italic">
                <div class="flex flex-col">
                    <span class="ml-3 font-bold font-sans-Timenew text-sm" v-for="(e, i) in 3" :key="i">* Element-{{i}} <i class="fa fa-square-o mr-2"> </i></span>
                </div>
                <div class="flex flex-col">
                  <span class="ml-3 font-bold font-sans-Timenew text-sm" v-for="(e, i) in 3" :key="i">* Element-{{i}} <i class="fa fa-square-o mr-2"> </i></span>
                </div>

              </div>
            </div>

         <div class="grid grid-cols-1 mt-2">
            <div>
              <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Tuyến</span>
              <div class="grid grid-cols-3 leading-5">
                <span class="ml-3 font-bold italic font-sans-Timenew text-sm" v-for="(e, i) in 3" :key="i"> * fdfadsf Element-{{i}} <i class="fa fa-square-o mr-2"> </i></span>
              </div>
            </div>
         </div>
         <!------KET LUẬN------------------->
        <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-2">
          <div class="font-bold">Đề nghị (Suggestions):</div>
          <div class="font-bold flex flex-col">
             <div class="grid grid-cols-3">
                <span class="col-span-2 mr-0 pr-0">*  Phết lại (Pap's)</span>
                <span class="ml-0 pl-0 text-left" > <i class="fa fa-square-o"></i></span>
            </div>
             <div class="grid grid-cols-3">
                <span class="col-span-2 mr-0 pr-0">* Nạo kênh (Edocervical curettage)</span>
                <span class="ml-0 pl-0 text-left text-middle" > <i class="fa fa-square-o"></i></span>
            </div>
          </div>
          <div class="font-bold flex flex-col">
             <div class="grid grid-cols-3">
                <span class="col-span-2 mr-0 pr-0">* Soi CTC (Colposcopy)</span>
                <span class="ml-0 pl-0 text-left" > <i class="fa fa-square-o"></i></span>
            </div>
             <div class="grid grid-cols-3">
                <span class="col-span-2 mr-0 pr-0">* Nạo lòng (Endometrial)</span>
                <span class="ml-0 pl-0 text-left text-middle" > <i class="fa fa-square-o"></i></span>
            </div>
          </div>
          <div class="font-bold flex flex-col">
             <div class="grid grid-cols-3">
                <span class="col-span-2 mr-0 pr-0">* Bấm sinh thiết (Biopsies)</span>
                <span class="ml-0 pl-0 text-left" > <i class="fa fa-square-o"></i></span>
            </div>
          </div>
        </div>
         <!------/KET LUẬN------------------->

         <div class="grid grid-cols-2 mt-2 text-center">
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
               <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
               <span class="font-bold text-red-700 font-sans-Timenew text-xs uppercase">- Không tổn thương trong biểu mô hay ung thư</span>
               <span class="font-bold text-md font-sans-Timenew">- Tế bào cổ tử cung biến đổi do viêm</span>
             </div>
           </div>
           <div class="grid grid-cols-1 text-center">
             <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả:</span>
             <span class="mb-16 font-bold font-sans-Timenew text-md">BS/KTV đọc kết quả:</span>
             <span class="font-bold font-sans-Timenew text-md">"tên Bác sỹ"</span>
             <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
             <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
           </div>
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
  name: "Form Vigor",
  props: {
    edit: Boolean,
    articles: Object,
  },
  data(){
    return{
      pathImageTop:'/images/Logo/vigor.jpg',

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
      return [{ label: "FORM PKĐK Vigor", class: "text-red-800" }];
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
     padding-left:0px;
   }


   @page{
     margin-left:60px;
     margin-right:60px;
   }
 }
</style>
