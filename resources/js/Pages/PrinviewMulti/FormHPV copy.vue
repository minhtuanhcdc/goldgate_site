<template>
  <div v-for="td in getbilltests" :key="td.id" class="">
        <div class="grid grid-cols-3 mt-0 mb-1 pb-0 align-middle pt-0">
            <div class="m-0 p-0 flex flex-wrap justify-end brightness-100" v-if="td.ousent">
                <img class="h-24 object object-end mt-0 p-0 mr-2" :src="logoPath+td.ousent.logo"></div>
            <div class="col-span-2">
                <p class="uppercase font-sans-Timenew font-bold text-md my-0" v-if="td.ousent">{{td.ousent.name}}</p>
                <div class="grid grid-cols-6">
                    <div class="font-bold font-sans-Timenew text-md">Địa chỉ: </div>
                    <div class="col-span-5 text-left ml-2 font-sans-Timenew">
                        <p class="" v-if="td.ousent">{{td.ousent.address}}</p>
                    </div>
                </div>
                <div class="flex mt-1" style="line-height:80%">
                    <div class="font-bold font-sans-Timenew mr-2 text-md">Điện thoại:</div>
                    <div class="text-left ml-0 pl-0 font-sans-Timenew" >
                        <p class="" v-if="td.ousent">{{td.ousent.phone_contact}}</p>
                    </div>
                </div>
                <div class="flex mt-1" style="line-height:80%">
                    <div class="font-bold font-sans-Timenew mr-2 text-md">Website:</div>
                    <div class="text-left ml-0 pl-0 font-sans-Timenew" >
                        <p class="" v-if="td.ousent">{{td.ousent.website}}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-0 p-0 bg-gray-800">
    <div class=" text-center font-bold text-md font-sans-Timenew mt-1 text-red-600">
        <P class="text-center">PHIẾU TRẢ KẾT QUẢ XÉT NGHỆM E6/E7 mRNA HPV</P>
        <P class="leading-3 text-center">(<span class="mt-0 pl-0">APTIMA</span> <span class="ml-0 pl-0" style="vertical-align: super; font-size:16px ; padding:0px">&reg;</span> HPV Assay)</P>
    </div>
      <div style="border:none;" class="pb-0 font-sans-Timenew mb-0 leading-3"><span class="text-red-600 uppercase  underline font-bold text-sm">1. Thông tin mẫu:</span><span class="text-md italic">(Information)</span></div>
    <table class="table m-0 p-0">
        <tr class="p-0">
            <td class="py-0 pl-2" style="border:none !important">
                <div class="grid grid-cols-4 font-sans-Timenew text-sm  m-0 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row ">
                            <div class="leading-5  py-1">
                                <span class="font-bold mr-2 text-sm">Tên Bệnh Nhân: </span>
                                <p class="leading-3 italic text-xs">(Full Name)</p>
                            </div>
                            <div>
                               <span class="font-bold text-lg">  {{td.custommer.name}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Giới tính: </span>
                                <p class="leading-3 italic text-xs">(Sex)</p>
                            </div>
                            <div>
                                <span class="font-bold"> "Nữ" </span>
                                <p class="leading-3 italic text-xs">Female</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row ">
                            <div class="leading-5  py-1">
                                <span class="font-bold mr-2 text-sm">Năm sinh: </span>
                                <p class="leading-3 italic text-xs">(Date of birth)</p>
                            </div>
                            <div>
                               <span class="font-bold text-lg"> {{td.custommer.birthday}} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 font-sans-Timenew p-0 m-0" style="border:none !important">
                    <div class="col-span-4  leading-3">
                        <div class="flex flex-row ">
                            <div class="leading-5">
                                <span class="font-bold mr-2 text-sm">Địa chỉ: </span>
                                <p class="leading-3 italic text-xs">(Address)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm">  {{td.custommer.address}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew m-0 p-0 leading-3 bg-gray-500" style="border:none !important">
                    <div class="col-span-2  leading-3  py-0">
                        <div class="flex flex-row leading-3">
                            <div class="leading-3">
                                <span class="font-bold mr-2 text-sm">Bác sĩ điều trị: </span>
                                <p class="leading-3 italic text-xs">(Medical Doctor)</p>
                            </div>
                            <div class="leading-3">
                                <span class="font-bold text-lg" v-if="td.doctor"> {{td.doctor.name}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="leading-5 py-0">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Ngày gửi: </span>
                                <p class="leading-3 italic text-xs">(Date of sending)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm">
                                     {{formatDate(td.date_receive) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="leading-5  py-0">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Khoa: </span>
                                <p class="leading-3 italic text-xs">(Depart)</p>
                            </div>
                            <div>
                                <span class="font-bold"> </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew m-0 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text=sm">Yêu cầu xét nghiệm: </span>
                                <p class="leading-3 italic text-xs">(Test Requesting)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> "Định týp HPV" </span>
                                 <p class="leading-3 italic text-xs">(HPV Genotyping)</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Mã BN: </span>
                                <p class="leading-3 italic text-xs">(Partient ID)</p>
                            </div>
                            <div>
                                <span class="font-bold"> </span>

                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Mã XN: </span>
                                <p class="leading-3 italic text-xs">(Lab Barcode)</p>
                            </div>
                            <div>
                                <span class="font-bold text-lg"> {{td.hpv_code}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew  mt-0 p-0 " style="border:none !important">
                    <div class="col-span-4" style="border:none !important">
                        <div class="flex flex-row" style="border:none !important">
                            <div class="pt-1">
                                <span class="font-bold mr-2 text-md">Phương pháp: </span>
                                <p class="leading-3 italic text-sm">(Analytical Method)</p>
                            </div>
                            <div class="" style="border:none !important">
                                <span class="font-bold text-red-600 text-sm"> APTIMA <span style="vertical-align: super; font-size:16px ; padding:0px">&reg;</span> HPV Assay. Approved by the FDA  </span>
                            </div>
                        </div>
                    </div>

                </div>
            </td>
        </tr>
    </table>

      <div style="border:none;border:none !important " class="pb-0 font-sans-Timenew mt-1"><span class="text-red-600  uppercase  underline font-bold text-lg ">2. KẾT QUẢ:</span><span class="text-md italic">(Reporting result)</span></div>
   <table class="font-sans-Timenew " style=" m-0">
        <tr class="bg-black border-1 border-black py-0"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-black py-0" colspan="4">14 HPV high-risk</td></tr>
        <tr class="bg-gray-300 font-sans-Timenew font-bold border-1 border-black">
            <td class="border-1  border-gray-900 text-blue-700 text-center text-lg p-0" colspan="2">S/CO sample value</td>
            <td class="border-1  border-gray-900 text-center text-lg p-0" colspan="2">S/CO analyte</td>
        </tr>
        <tr class=" font-sans-Timenew border-1">
            <td class=" text-red-700 text-center align-middle font-bold border-1  border-gray-900" colspan="2" width="50%">
                <div v-for="(sco, i) in td.resulthpvs" :key="i">
                     <span v-if="sco.element_id == 56" class="text-lg">{{sco.result}}</span>
                </div>
            </td>
            <td class="border-1  border-gray-900  text-center py-0" colspan="2">
                <div class="text-left">
                    <span class=" mr-2 text-sm">Âm tính nếu (Negative) <span class="ml-7">&lt;</span> 0.5 </span>

                </div>
                <div class="text-left">
                    <span class=" mr-2 text-sm">Dương tính nếu (Positive) <span class="ml-4">&ge;</span> 0.5 </span>

                </div>
            </td>

        </tr>
        <tr class=" font-sans-Timenew ">
            <td class="border-1 border-gray-900 py-1" width="50%" colspan="2">
                <span class="mr-2 text-lg font-bold">Kết quả HPV </span>
                <p class="leading-3 italic text-md">(HPV result)</p>
            </td>
            <td class=" border-1 border-gray-900 text-center py-1" colspan="2">
                <div class="text-left ">
                    <div v-for="(sco, i) in td.resulthpvs" :key="i">
                        <div v-if="sco.element_id == 56">
                           <div v-if="sco.result >= 0.5">
                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                <p class="leading-3 italic text-md">(Positive)</p>
                           </div>
                           <div v-else>
                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                <p class="leading-3 italic text-md">(Negative)</p>
                           </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
     </table>

      <div v-for="(sco2, i) in td.resulthpvs" :key="i" class="mb-0 mt-0">
            <div v-if="sco2.element_id == 59">
                <div v-if="sco2.result >= 0.5">
                    <table class="mt-0">
                        <tr class="bg-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-gray-900 text-lg py-0" colspan="4">GT HPV 16, 18/45</td></tr>
                        <tr class="bg-gray-300 font-sans-Timenew font-bold">
                            <td class=" text-blue-700 text-center text-sm border-1 border-gray-900 py-1" width="25%">
                                <span>S/CO HPV 16 </span>
                                <p class="leading-3">sample value </p>
                            </td>
                            <td class=" text-center text-sm border-1 border-gray-900 py-1" width="25%">
                                <span>S/CO HPV 16 </span>
                                <p class="leading-3">analyte </p>
                            </td>
                            <td class="border-1 border-gray-900 text-blue-700 text-center text-sm py-1" width="25%">
                                <span>S/CO HPV 18/45 </span>
                                <p class="leading-3">sample value </p>
                            </td>
                            <td class=" text-center text-sm border-1 border-gray-900 py-1" width="25%">
                                <span>S/CO HPV 18/45</span>
                                <p class="leading-3">analyte </p>
                            </td>
                        </tr>
                        <tr class=" font-sans-Timenew py-0">
                            <td class="  text-center align-middle font-bold border-1 border-gray-900 py-0">
                                <div v-for="(sco16, i) in td.resulthpvs" :key="i">
                                    <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result>=1">
                                            <span  class="text-red-700 text-xl">{{sco16.result}}</span>
                                        </div>
                                        <div v-else>
                                                 <span  class="text-blue-700 text-xl">{{sco16.result}}</span>
                                        </div>

                                    </div>
                                </div>
                                </td>
                            <td class="  text-center border-1 border-gray-900 py-0">
                                <div class="text-left">
                                    <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-2">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Negative)</p>
                                </div>
                                <div class="text-left">
                                    <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-2">&ge;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Positive)</p>
                                </div>
                            </td>
                            <td class="text-center align-middle font-bold border-1 border-gray-900 py-0">
                                 <div v-for="(sco18, i) in td.resulthpvs" :key="i">
                                    <div v-if="sco18.element_id == 58">
                                        <div v-if="sco18.result>=1">
                                            <span  class="text-red-700 text-xl">{{sco18.result}}</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-xl">{{sco18.result}}</span>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="  text-center border-1 border-gray-900 py-0">
                                <div class="text-left">
                                    <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-2">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Negative)</p>
                                </div>
                                <div class="text-left">
                                    <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-2">&ge;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Positive)</p>
                                </div>
                            </td>

                        </tr>
                        <tr class=" font-sans-Timenew ">
                            <td class="border-1 border-gray-900">
                                <span class=" mr-2 text-lg font-bold">Kết quả HPV 16 </span>
                                    <p class="leading-3 italic text-md">(HPV 16 result)</p></td>
                            <td class="  text-center border-1 border-gray-900">
                                 <div class="text-left ">
                                    <div v-for="(sco16, i) in td.resulthpvs" :key="i">
                                        <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result >= 1">
                                                <span class=" mr-2 textsm font-bold text-red-700">Dương tính </span>
                                                <p class="leading-3 italic text-xs">(Positive)</p>
                                        </div>
                                        <div v-else>
                                            <span class=" mr-2 text-sm text-blue-600 font-bold">Âm tính </span>
                                            <p class="leading-3 italic text-xs">(Negative)</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-1 border-gray-900">
                                <span class="font-bold mr-2 text-lg">Kết quả HPV 18/45 </span>
                                    <p class="leading-3 italic text-md">(HPV 18/45result)</p></td>
                            <td class="  text-center border-1 border-gray-900">
                                <div class="text-left ">
                                    <div v-for="(sco18, i) in td.resulthpvs" :key="i">
                                        <div v-if="sco18.element_id == 58">
                                        <div v-if="sco18.result >= 1">
                                            <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                            <p class="leading-3 italic text-md">(Positive)</p>
                                        </div>
                                        <div v-else>
                                            <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                            <p class="leading-3 italic text-md">(Negative)</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>
                <div v-else>

                </div>


        </div>
    </div>

      <div v-for="(sco2, i) in td.resulthpvs" :key="i" class=" mt-0 p-0">
            <div v-if="sco2.element_id == 59" class="m-0 p-0">
                <div  class="pb-0 font-sans-Timenew mb-0 mt-1"><span class="text-red-600  uppercase  underline font-bold text-lg">3. KẾT Luận:</span><span class="text-md italic">(Reporting result)</span></div>
                <div v-if="sco2.result >= 0.5" class="m-0 p-0">
                    <table class="font-sans-Timenew m-0 p-0" >
                        <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900 p-0">
                             <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg p-0" colspan="2">11 Orther HPV High-Risk</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg p-0" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg p-0" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 py-0 " style="">
                            <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >Âm tính (Negative)</td>
                            <td class="font-bold text-red-600 text-center  border-black border-1 py-0" colspan="2" >
                                <div v-for="(sco16, i) in td.resulthpvs" :key="i" class="py-0">
                                    <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result>=1">
                                            <span  class="text-red-700 text-xl">Dương tính (Positive)</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-xl">Âm tính (Negative)</span>
                                        </div>

                                    </div>
                                    </div>
                            </td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" >
                                <div v-for="(sco18, i) in td.resulthpvs" :key="i">
                                    <div v-if="sco18.element_id == 58">
                                        <div v-if="sco18.result>=1">
                                            <span  class="text-red-700 text-lg">Dương tính (Positive)</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div v-else>
                     <table class="font-sans-Timenew table" >
                        <tr class="bg-gray-300 font-sans-Timenew py-0 ">
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">11 Orther HPV High-Risk</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 p-0" style="">
                            <td class="font-bold text-red-700 text-center   border-black border-1 text-lg py-0" colspan="2" width="" >Dương tính (Positive)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" width="" >Âm tính (Negative)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" >Âm tính (Negative)</td>
                        </tr>

                    </table>
                </div>
            </div>
    </div>




     <table class="font-sans-Timenew table" >
        <tr class=" font-sans-Timenew">
            <td class="text-center font-bold" colspan="2"  style="border:none !important" width="50%"></td>
                <td class=" text-center leading-3 " colspan="2"  style="border:none !important">
                                <p class="italic leading-2 text-lg" style="border:none; line-height:30%">Ngày (date): {{currentDate()}}<span></span></p>
                                <p class=" text-lg font-bold" style="margin-bottom:60px; border:none; line-height:30%">Trưởng Khoa GPB</p>
                                <span class="text-xl font-bold" style=" border:none">ThS. BS. HUỲNH GIANG CHÂU</span>
                </td>
        </tr>
    </table>
     <div class="page-break"></div>
    </div>
</template>

<script>
//import Table from '../../Components/Table.vue'
import moment from 'moment'
export default {
  components: { },
    props:{
        getbilltests:Object,
        testElements:'',


    },
    computed:{
        getSCo(){
            return this.sco.result
        }
    },

    data(){
        return{
            logoPath:'/storage/Image_Ousent/',
        }
    },
    methods:{
         currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },
        formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    }
    }

    }


</script>

