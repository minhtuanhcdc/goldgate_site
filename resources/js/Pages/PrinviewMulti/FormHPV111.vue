<template>
  <div v-for="td in getbilltests" :key="td.id" class="">

    <div v-if="td.resultHpv == 1">
     <div id="" ref="" class="px-0 my-0">
        <div class="flex  mt-0 pb-0 align-middle"  v-if="td.ousent">
            <div v-if="td.ousent.image_header" class="w-full">
                <img  class="h-24 w-full" :src="imageHeaderPath+td.ousent.image_header">
            </div>
            <div v-else class="grid grid-cols-6">
                <div class="m-0 p-0 flex justify-end mb-1 mr-2">
                    <span v-if="td.ousent.logo" class="pr-2">
                        <img  class="h-20 w-40 object mt-0 p-0 pr-4 object-contain " :src="logoPath+td.ousent.logo">
                    </span>
                    <span v-else class="mr-10"></span>
                </div>
                <div class="col-span-4">
                    <p class="uppercase font-sans-Timenew font-bold text-sm" v-if="td.ousent">{{td.ousent.name}}</p>
                    <div class="grid grid-cols-8 ">
                        <div class="font-bold font-sans-Timenew text-sm">Địa chỉ: </div>
                        <div class=" text-left ml-0 pl-0 font-sans-Timenew col-span-7 text-sm" v-if="td.ousent">
                            {{td.ousent.address}}
                        </div>
                    </div>
                    <div class="flex  mt-1" style="line-height:80%">
                        <div class="font-bold font-sans-Timenew text-md">ĐT(Hostline):</div>
                        <div class=" text-left ml-2 pl-0 font-sans-Timenew" v-if="td.ousent" >
                            {{td.ousent.phone_contact}}
                        </div>

                    </div>

                </div>
                <div>
                    <img  class="w-16" :src="logoGG">
                </div>
            </div>

        </div>

        <hr class="mt-0 p-0 h-2 bg-gray-800">

    <div class="text-center font-bold text-lg font-sans-Timenew mt-2 text-red-600">
        <P>PHIẾU TRẢ KẾT QUẢ XÉT NGHỆM E6/E7 mRNA HPV</P>
        <P class="leading-3">(<span class="mt-0 pl-0">APTIMA</span> <span class="ml-0 pl-0" style="vertical-align: super; font-size:16px ; padding:0px">&reg;</span> HPV Assay)</P>
    </div>
    <!--INFOMATION OF PATIENT==================-->

    <div style="border:none;" class="pb-0 font-sans-Timenew mb-0 leading-3"><span class="text-red-600 uppercase  underline font-bold text-sm">1. Thông tin mẫu:</span><span class="text-md italic">(Information)</span></div>
    <table class="table mt-0 py-0 my-0">
        <tr class="">
            <td class="py-0 pl-2" style="border:none !important">
                <div class="grid grid-cols-4 font-sans-Timenew text-md  m-0 mt-1 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Tên Bệnh Nhân: </span>
                                <p class="leading-3 italic text-xs">(Full Name)</p>
                            </div>
                            <div>
                                <span class="font-bold text-lg"> {{td.custommer.name}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Giới tính: </span>
                                <p class="leading-3 italic text-xs">(Sex)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> "Nữ" </span>
                                <p class="leading-3 italic text-xs">Female</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Năm sinh: </span>
                                <p class="leading-3 italic text-xs">(Date of birth)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> {{td.custommer.birthday}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl p-0 m-0" style="border:none !important">
                    <div class="col-span-4  leading-3">
                        <div class="flex flex-row ">
                            <div class="leading-5 ">
                                <span class="font-bold mr-2 text-sm">Địa chỉ: </span>
                                <p class="leading-3 italic text-xs">(Address)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm">  {{td.custommer.address}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew m-0 p-0" style="border:none !important">
                    <div class="col-span-2  py-0">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Bác sĩ điều trị: </span>
                                <p class="leading-3 italic text-xs">(Medical Doctor)</p>
                            </div>
                            <div>
                                <span class="font-bold text-lg" v-if="td.doctor"> {{td.doctor.name}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="leading-5  py-1">
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
                    <div class="leading-5  py-1">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-0 text-sm">Khoa: </span>
                                <p class="leading-3 italic text-xs">(Depart)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew m-0 p-0" style="border:none !important">
                    <div class="col-span-2 mr-0 py-0">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Yêu cầu xét nghiệm: </span>
                                <p class="leading-3 italic text-sm">(Test Requesting)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> "Định týp HPV" </span>
                                 <p class="leading-3 italic text-xs">(HPV Genotyping)</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div class="m-0 p-0 text-left">
                                <span class="font-bold pr-1 text-sm">Mã BN: </span>
                                <p class="leading-3 italic text-xs">(Partient ID)</p>
                            </div>
                            <div class="m-0 p-0">
                                <span class="font-bold text-lg p-0 m-0 text-left">{{td.patient_code}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold pr-1 text-sm">Mã XN: </span>
                                <p class="leading-3 italic text-xs">(Lab Barcode)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> {{td.hpv_code}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl mt-0 p-0 " style="border:none !important">
                    <div class="col-span-4" style="border:none !important">
                        <div class="flex flex-row" style="border:none !important">
                            <div class="">
                                <span class="font-bold mr-2 text-sm">Phương pháp: </span>
                                <p class="leading-3 italic text-xs">(Analytical Method)</p>
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
     <!--==================-->
     <!--===========================================================================-->
    <div style="border:none;border:none !important" class="pb-0 font-sans-Timenew"><span class="text-red-600  uppercase  underline font-bold text-sm py-0">2. KẾT QUẢ:</span><span class="text-sm italic">(Reporting result)</span></div>

       <table class="font-sans-Timenew " style="">
        <tr class="bg-black border-1 border-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-black py-0" colspan="4">14 HPV high-risk</td></tr>
        <tr class="bg-gray-300 font-sans-Timenew font-bold border-1 border-black py-0">
            <td class="border-1  border-gray-900 text-blue-700 text-center text-lg py-0" colspan="2">S/CO sample value</td>
            <td class="border-1  border-gray-900 text-center text-lg py-0" colspan="2">S/CO analyte</td>
        </tr>
        <tr class=" font-sans-Timenew border-1">
            <td class="  text-center align-middle font-bold border-1  border-gray-900 py-0" colspan="2" width="50%">
                <div v-for="(sco, i) in td.resulthpvs" :key="i">
                     <span v-if="sco.element_id == 56">
                        <span v-if=" sco.result >=0.5"  class="text-lg text-red-700">
                        {{sco.result}}
                        </span>
                        <span v-else>
                        {{sco.result}}
                        </span>
                    </span>

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
            <td class="border-1 border-gray-900 py-0" width="50%" colspan="2">
                <span class="mr-2 text-lg font-bold">Kết quả HPV </span>
                    <p class="leading-3 italic text-md">(HPV result)</p>
            </td>
            <td class=" border-1 border-gray-900 text-center py-0 pb-1" colspan="2">
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
     <div  v-if="td.resulthpvs">
       <div v-if="td.resulthpvs.find((result) => result.element_id === '56').result < 0.5">
         <div  class="pb-0 font-sans-Timenew mb-0 mt-1"><span class="text-red-600  uppercase  underline font-bold text-sm py-0">3. KẾT Luận:</span><span class="text-md italic">(Reporting result)</span></div>

            <!-- <table class="font-sans-Timenew" >
                                <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900 py-0">
                                    <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">11 Orther HPV High-Risk</td>
                                    <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">Genotype HPV 16</td>
                                    <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">Genotype HPV 18/45</td>
                                </tr>
                                <tr class=" font-sans-Timenew border-1 border-gray-900 py-0 " style="">

                                    <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" width="" >Âm tính (Negative)</td>
                                    <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" width="" >Âm tính (Negative)</td>
                                    <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" >Âm tính (Negative)</td>
                                </tr>
            </table> -->
       </div>
       <!-- <div v-if="td.resulthpvs.find((result) => result.element_id === '56').result >= 0.5">
                <div v-if="td.resulthpvs.find((result) => result.element_id === '59').result >= 0.5">
                        <table>
                        <tr class="bg-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-gray-900 py-0" colspan="4">GT HPV 16, 18/45</td></tr>
                        <tr class="bg-gray-300 font-sans-Timenew font-bold py-0">
                            <td class=" text-blue-700 text-center text-lg border-1 border-gray-900 py-0" width="25%">
                                <span>S/CO HPV 16 </span>
                                <p>sample value </p>
                            </td>
                            <td class=" text-center text-lg border-1 border-gray-900 py-0" width="25%">
                                <span>S/CO HPV 16 </span>
                                <p>analyte </p>
                            </td>
                            <td class="border-1 border-gray-900 text-blue-700 text-center text-lg py-0" width="25%">
                                <span>S/CO HPV 18/45 </span>
                                <p>sample value </p>
                            </td>
                            <td class=" text-center text-lg border-1 border-gray-900 py-0" width="25%">
                                <span>S/CO HPV 18/45</span>
                                <p>analyte </p>
                            </td>
                        </tr>
                        <tr class=" font-sans-Timenew">
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
                                    <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-10">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-xs">(Negative)</p>
                                </div>
                                <div class="text-left">
                                    <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-4">&ge;</span> 1.00 </span>
                                    <p class="leading-3 italic text-xs">(Positive)</p>
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
                                    <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-10">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-xs">(Negative)</p>
                                </div>
                                <div class="text-left">
                                    <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-4">&ge;</span> 1.00 </span>
                                    <p class="leading-3 italic text-xs">(Positive)</p>
                                </div>
                            </td>

                        </tr>
                        <tr class=" font-sans-Timenew ">
                            <td class="border-1 border-gray-900 py-0">
                                <span class=" mr-2 text-lg font-bold">Kết quả HPV 16 </span>
                                    <p class="leading-3 italic text-md">(HPV 16 result)</p></td>
                            <td class="  text-center border-1 border-gray-900 py-0">
                                 <div class="text-left ">
                                    <div v-for="(sco16, i) in td.resulthpvs" :key="i">
                                        <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result >= 1">
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
                            <td class="border-1 border-gray-900 py-0">
                                <span class="font-bold mr-2 text-lg">Kết quả HPV 18/45 </span>
                                    <p class="leading-3 italic text-md">(HPV 18/45result)</p></td>
                            <td class="  text-center border-1 border-gray-900 py-0">
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
                    <div  class="pb-0 font-sans-Timenew mb-0 mt-1"><span class="text-red-600  uppercase  underline font-bold text-sm py-0">3. KẾT Luận:</span><span class="text-md italic">(Reporting result)</span></div>
                     <table class="font-sans-Timenew" >
                        <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                             <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">11 Orther HPV High-Risk</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg py-0" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                            <td  class="border-black border-1 text-center"><span  class="text-blue-700 text-lg font-bold py-0">Âm tính (Negative)</span></td>
                            <td class="font-bold text-red-600 text-center  border-black border-1 py-0" colspan="2" width="" >
                                <div v-for="(sco16, i) in td.resulthpvs" :key="i">
                                    <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result>=1">
                                            <span  class="text-red-700 text-lg">Dương tính (Positive)</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
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
                     <div  class="pb-0 font-sans-Timenew mb-0 mt-1"><span class="text-red-600  uppercase  underline font-bold text-sm">3. KẾT Luận:</span><span class="text-md italic">(Reporting result)</span></div>
                     <table class="font-sans-Timenew" >
                                <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                                    <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">11 Orther HPV High-Risk</td>
                                    <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 16</td>
                                    <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 18/45</td>
                                </tr>
                                <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                                    <td class="font-bold text-red-700 text-center   border-black border-1 text-lg" colspan="2" width="" >Dương tính (Positive)</td>
                                    <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" width="" >Âm tính (Negative)</td>
                                    <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >Âm tính (Negative)</td>
                                </tr>
                    </table>
                </div>
       </div> -->

     </div>

    <table class="font-sans-Timenew table" >
                        <tr class=" font-sans-Timenew">
                            <td class="text-center font-bold" colspan="2"  style="border:none !important" width="50%"></td>
                            <td class=" text-center " colspan="2"  style="border:none !important">
                                <p class="italic leading-3 text-lg" style="border:none">Ngày (date): <span>{{currentDate()}}</span></p>
                                <p class="leading-3 text-lg font-bold" style="margin-bottom:80px; border:none">Trưởng Khoa GPB</p>
                                <span class="text-xl font-bold" style=" border:none">ThS. BS. HUỲNH GIANG CHÂU</span>
                            </td>
                        </tr>
    </table>
    </div>

     <div class="page-break"></div>
    </div>
    </div>

</template>

<script>

import moment from 'moment'
export default {
    name: "In HPV",
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
            imageHeaderPath:'/storage/imageHeader_Ousent/',
            logoPath:'/storage/Image_Ousent/',
            logoGG:'/images/Logo/LogoGG(40_40).png'
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

