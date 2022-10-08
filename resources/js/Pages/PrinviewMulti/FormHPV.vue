<template>
  <div v-for="td in getbilltests" :key="td.id" class="">
    <div v-if="td.resultHpv == 1">
     <div id="" ref="" class="px-0 my-0">
        <div class="flex  mt-0 pb-1 align-middle w-full border-b border-gray-500"  v-if="td.ousent">
            <div v-if="td.ousent.header_view == 1" class="w-full">
                <img  class="h-24 w-full" :src="imageHeaderPath+td.ousent.image_header">
            </div>
            <div v-else class="grid grid-cols-8 w-full">
                <div class="m-0 p-0 flex justify-end mb-1 mr-2 col-span-2">
                    <span v-if="td.ousent.logo_view == 1" class="pr-2">
                        <img  class="h-20 w-40 object object-contain " :src="logoPath+td.ousent.logo">
                    </span>
                    <span v-else class="mr-4"><img class=" w-44" :src="imagePathLogoEro"></span>
                </div>
                <div class="col-span-6" >
                    <div  v-if="td.ousent.address_view == 1">
                        <p class="uppercase font-sans-Timenew font-bold text-sm" v-if="td.ousent.title">{{td.ousent.title}}</p>
                        <p class="uppercase font-sans-Timenew font-bold text-sm" v-else>{{td.ousent.name}}</p>
                        <div class="flex">
                            <div class="font-bold font-sans-Timenew text-sm w-14" v-if="td.ousent.address">Địa chỉ: </div>
                            <div class=" text-left ml-0 pl-0 pr-2 font-sans-Timenew w-96 text-sm" v-if="td.ousent">
                                {{td.ousent.address}}
                            </div>
                        </div>
                        <div class="flex  mt-1 text-sm" style="line-height:80%"  v-if="td.ousent.phone_contact">
                            <div class="font-bold font-sans-Timenew">ĐT(Hostline):</div>
                            <div class=" text-left ml-2 pl-0 font-sans-Timenew" >
                                {{td.ousent.phone_contact}}
                            </div>
                        </div>
                        <div class="flex  mt-1 text-sm" style="line-height:80%" v-if="td.ousent.website">
                            <div class="font-bold font-sans-Timenew">Website:</div>
                            <div class=" text-left ml-2 pl-0 font-sans-Timenew"  >
                                {{td.ousent.website}}
                            </div>
                        </div>
                    </div>
                    <div  v-if="(td.ousent.address_view === null && td.ousent.logo_view === null) ||(td.ousent.address_view == 0 && td.ousent.logo_view == 0)">
                        <p class="uppercase font-sans-Timenew font-bold text-sm" >{{eurolab.name}}</p>
                        <div class="flex ">
                            <div class="font-bold font-sans-Timenew text-sm w-14">Địa chỉ: </div>
                            <div class=" text-left ml-0 pl-1 font-sans-Timenew col-span-7 text-sm w-96" >
                                {{eurolab.addressHN}}
                            </div>
                        </div>
                        <div class="flex  mt-1 text-sm" style="line-height:80%">
                            <div class="font-bold font-sans-Timenew">ĐT(Hostline):</div>
                            <div class=" text-left ml-2 pl-0 font-sans-Timenew " >
                                {{eurolab.phoneHN}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- <hr class="mt-1 p-0 h-3 bg-gray-900"> -->

    <div class="text-center font-bold text-lg font-sans-Timenew mt-2 text-red-600">
        <P>PHIẾU TRẢ KẾT QUẢ XÉT NGHỆM E6/E7 mRNA HPV</P>
        <P class="leading-3 text-sm">(<span class="mt-0 pl-0 -mr-1">APTIMA</span> <span class="ml-0 pl-0" style="vertical-align: super; font-size:14px ; padding:0px">&reg;</span> HPV Assay)</P>
    </div>
    <!--INFOMATION OF PATIENT==================-->

    <div style="border:none;" class="pb-0 font-sans-Timenew mb-0 leading-3"><span class="text-red-600 uppercase  underline font-bold text-sm">1. Thông tin mẫu:</span><span class="text-md italic">(Information)</span></div>
     <div class="absolute mt-0 flex justify-center w-full opacity-40">
        <img class="w-1/2" :src="pathLogoEurolab + eurolab.background_hpv">
    </div>
    <div class="relative">
    <table class="table mt-0 py-0 my-0">
        <tr class="">
            <td class="py-0 pl-2" style="border:none !important">
                <div class="grid grid-cols-4 font-sans-Timenew text-md  m-0 mt-1 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row">

                              <div>
                                <span class="font-bold mr-2 text-sm">Tên bệnh nhân: </span>
                                <p class="leading-3 italic text-xs">(Full name)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> {{td.custommer.name}} </span>
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
                              <div>
                                <span class="font-bold mr-2 text-sm">Địa chỉ: </span>
                                <p class="leading-3 italic text-xs">(Address)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> {{td.custommer.address}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl p-0 m-0" style="border:none !important">
                    <div class="col-span-4  leading-3">
                        <div class="flex flex-row ">
                              <div>
                                <span class="font-bold mr-2 text-sm">Đơn vị gửi mẫu: </span>
                                <p class="leading-3 italic text-xs">(Custommer)</p>
                            </div>
                            <div>
                                <span class="font-bold text-sm"> {{td.ousent.name}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew m-0 p-0" style="border:none !important">
                    <div class="col-span-2  py-0">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 text-sm">Bác sĩ chỉ định: </span>
                                <p class="leading-3 italic text-xs">(Medical Doctor)</p>
                            </div>
                            <div>
                                <span class="font-bold text-lg" > {{td.doctor_indi}} </span>
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
                                <span class=" text-sm"> "Định týp HPV" </span>
                                 <p class="leading-3 italic text-xs">(HPV Genotyping)</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div class="m-0 p-0 text-left">
                                <span class="font-bold pr-1 text-sm">Mã BN:</span>
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
                <div class="grid grid-cols-4 font-sans-Timenew text-xl mt-1 p-0 " style="border:none !important">
                    <div class="col-span-3" style="border:none !important">
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
                    <div>
                        <p class="-mt-1">
                            <vue-barcode class="h-8 w-32" :value="td.hpv_code" :options="{ displayValue: false }"></vue-barcode>
                        </p>
                    </div>

                </div>
            </td>
        </tr>
    </table>
    </div>
     <!--==================-->
     <!--===========================================================================-->
    <div style="border:none;border:none !important" class="pb-0 font-sans-Timenew"><span class="text-red-600  uppercase  underline font-bold text-sm py-0">2. KẾT QUẢ:</span><span class="text-sm italic">(Reporting result)</span></div>
       <div v-if="td.resulthpvs.find((x) => x.element_id === '56').result >= 0.5" style="width:95%">
            <table class="font-sans-Timenew " style="">
                <tr class="bg-black border-1 border-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-black py-0" colspan="4">14 HPV high-risk</td></tr>
                <tr class="bg-gray-300 font-sans-Timenew font-bold border-1 border-black py-0">
                    <td class="border-1  border-gray-900 text-blue-700 text-center text-sm py-0" colspan="2">S/CO sample value</td>
                    <td class="border-1  border-gray-900 text-center text-sm py-0" colspan="2">S/CO analyte</td>
                </tr>
                <tr class=" font-sans-Timenew border-1">
                    <td class="  text-center align-middle font-bold border-1  border-gray-900 py-0" colspan="2" width="50%">
                        <div v-for="(sco, i) in td.resulthpvs" :key="i">
                            <span v-if="sco.element_id == 56">
                                <span v-if=" sco.result >=0.5"  class="text-sm text-red-700">
                                {{formatPrice(sco.result)}}
                                </span>
                                <span v-else>
                                {{formatPrice(sco.result)}}
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
                        <span class="mr-2 text-sm font-bold">Kết quả HPV </span>
                        <p class="leading-3 italic text-xs">(HPV result)</p>
                    </td>
                    <td class=" border-1 border-gray-900 text-center py-0 pb-1" colspan="2">
                        <div class="text-left ">
                            <div v-for="(sco, i) in td.resulthpvs" :key="i">
                                <div v-if="sco.element_id == 56">
                                <div v-if="sco.result >= 0.5">
                                        <span class=" mr-2 text-sm font-bold text-red-700">Dương tính </span>
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
                </tr>
            </table>
             <div width="95%">
                <table>
                    <tr class="bg-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-gray-900 py-0" colspan="4">GT HPV 16, 18/45</td></tr>
                    <tr class="bg-gray-300 font-sans-Timenew font-bold py-0 text-sm">
                        <td class=" text-blue-700 text-center border-1 border-gray-900 py-0" width="25%">
                            <span>S/CO HPV 16 </span>
                            <p>sample value </p>
                        </td>
                        <td class=" text-center  border-1 border-gray-900 py-0" width="25%">
                            <span>S/CO HPV 16 </span>
                            <p>analyte </p>
                        </td>
                        <td class="border-1 border-gray-900 text-blue-700 text-center py-0" width="25%">
                            <span>S/CO HPV 18/45 </span>
                            <p>sample value </p>
                        </td>
                        <td class=" text-center  border-1 border-gray-900 py-0" width="25%">
                            <span>S/CO HPV 18/45</span>
                            <p>analyte </p>
                        </td>
                    </tr>
                    <tr class=" font-sans-Timenew">
                        <td class="  text-center align-middle font-bold border-1 border-gray-900 py-0 text-sm">
                                <div v-if="td.resulthpvs.find((x) => x.element_id === '57')">
                                <div v-if="td.resulthpvs.find((result) => result.element_id === '57').result >= 1">
                                <span  class="text-red-700 text-xl"> {{formatPrice(td.resulthpvs.find((result) => result.element_id === '57').result)}}</span>
                                </div>
                                <div v-if="td.resulthpvs.find((result) => result.element_id === '57').result < 1">
                                <span  class="text-blue-700 text-xl">{{formatPrice(td.resulthpvs.find((result) => result.element_id === '57').result)}}</span>
                                </div>
                            </div>
                                <div v-else>
                                    {{formatPrice(0)}}
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
                                <div v-if="td.resulthpvs.find((x) => x.element_id === '58')">
                            <div v-if="td.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                                <span  class="text-red-700 text-xl"> {{formatPrice(td.resulthpvs.find((result) => result.element_id === '58').result)}}</span>
                            </div>
                            <div v-if="td.resulthpvs.find((result) => result.element_id === '58').result < 1">
                                <span  class="text-blue-700 text-xl">{{formatPrice(td.resulthpvs.find((result) => result.element_id === '58').result)}}</span>
                            </div>

                            </div>
                                <div v-else>
                                    {{formatPrice(0)}}
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
                            <span class=" mr-2 text-sm font-bold">Kết quả HPV 16 </span>
                                <p class="leading-3 italic text-xs">(HPV 16 result)</p>
                        </td>
                        <td class="  text-center border-1 border-gray-900 py-0">
                                <div v-if="td.resulthpvs.find((x) => x.element_id === '57')">
                            <div v-if="td.resulthpvs.find((result) => result.element_id === '57').result >= 1">
                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                <p class="leading-3 italic text-md">(Positive)</p>
                            </div>
                            <div v-if="td.resulthpvs.find((result) => result.element_id === '57').result < 1">
                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                <p class="leading-3 italic text-md">(Negative)</p>
                            </div>

                            </div>
                            <div v-else>
                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                <p class="leading-3 italic text-md">(Negative)</p>
                            </div>
                        </td>
                        <td class="border-1 border-gray-900 py-0">
                            <span class="font-bold mr-2 text-sm">Kết quả HPV 18/45 </span>
                                <p class="leading-3 italic text-xs">(HPV 18/45result)</p></td>
                        <td class="  text-center border-1 border-gray-900 py-0">
                                <div v-if="td.resulthpvs.find((x) => x.element_id === '58')">
                            <div v-if="td.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                <p class="leading-3 italic text-md">(Positive)</p>
                            </div>
                            <div v-if="td.resulthpvs.find((result) => result.element_id === '58').result < 1">
                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                <p class="leading-3 italic text-md">(Negative)</p>
                            </div>

                            </div>
                            <div v-else>
                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                <p class="leading-3 italic text-md">(Negative)</p>
                            </div>
                        </td>
                    </tr>
                </table>
                <div  class="pb-0 font-sans-Timenew mb-0 mt-1"><span class="text-red-600  uppercase  underline font-bold text-sm py-0">3. KẾT Luận:</span><span class="text-xs italic">(Conclusion)</span></div>
                <div v-if="td.resulthpvs.find((x) => x.element_id === '57') || td.resulthpvs.find((x) => x.element_id === '58')">
                    <table class="font-sans-Timenew" >
                        <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900 text-sm">
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 py-0" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 py-0" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                            <td class="font-bold text-red-600 text-center  border-black border-1 py-0 text-sm" colspan="2" width="" >
                                <div v-if="td.resulthpvs.find((x) => x.element_id === '57')">
                                    <div v-if="td.resulthpvs.find((result) => result.element_id === '57').result >= 1">
                                        <span  class="text-red-700 text-lg">Dương tính (Positive)</span>
                                    </div>
                                    <div v-else>
                                        <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
                                    </div>
                                </div>
                                <div v-else>
                                    <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
                                </div>
                            </td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" >
                                <div v-if="td.resulthpvs.find((x) => x.element_id === '58')">
                                    <div v-if="td.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                                        <span  class="text-red-700 text-lg">Dương tính (Positive)</span>
                                    </div>
                                    <div v-else>
                                        <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
                                    </div>
                                </div>
                                <div v-else>
                                    <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
                                </div>

                            </td>
                        </tr>
                    </table>
                </div>
                <div v-else>
                    <table class="font-sans-Timenew" >
                    <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900 py-0 text-sm">
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 py-0" colspan="2">11 Orther HPV High-Risk</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1  py-0" colspan="2">Genotype HPV 16</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1  py-0" colspan="2">Genotype HPV 18/45</td>
                    </tr>
                    <tr class=" font-sans-Timenew border-1 border-gray-900 py-0 text-sm" style="">
                        <td class="font-bold text-red-600 text-xl text-center  border-black border-1 py-0" colspan="2" width="" >Dương tính (Positive)</td>
                        <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" width="" >Âm tính (Negative)</td>
                        <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" >Âm tính (Negative)</td>
                    </tr>
                </table>
                </div>
            </div>
       </div>
       <div v-else >
            <div class="w-1/2">
                    <table class="font-sans-Timenew ">
                        <tr class="bg-black border-1 border-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-black py-0" colspan="4">14 HPV high-risk</td></tr>
                        <tr class="bg-gray-300 font-sans-Timenew font-bold border-1 border-black py-0">
                            <td class="border-1  border-gray-900 text-blue-700 text-center text-sm py-0" colspan="2">S/CO sample value</td>
                            <td class="border-1  border-gray-900 text-center text-sm py-0" colspan="2">S/CO analyte</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1">
                            <td class="  text-center align-middle font-bold border-1  border-gray-900 py-0" colspan="2" width="40%">
                                <div v-if="td.resulthpvs.find((result) => result.element_id === '56')">
                                    <span>
                                        {{formatPrice(td.resulthpvs.find((result) => result.element_id === '56').result)}}
                                    </span>
                                </div>
                                <div v-else></div>
                            </td>
                            <td class="border-1  border-gray-900  text-center py-1" colspan="2" width="60%">
                                <div class="text-left flex flex-row">
                                    <div>
                                        <span class=" mr-2 text-sm">Âm tính nếu </span>
                                        <p class="leading-3"> (Negative)</p>
                                    </div>

                                    <div>
                                        <span class="ml-5">&lt; 0.5 </span>
                                    </div>
                                </div>
                                <div class="text-left flex flex-row mt-2">
                                    <div>
                                        <span class=" mr-2 text-sm">Dương tính nếu </span>
                                        <p class="leading-3"> (Positive)</p>
                                    </div>

                                    <div>
                                        <span>&ge; 0.5 </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class=" font-sans-Timenew ">
                            <td class="border-1 border-gray-900 py-0" width="50%" colspan="2">
                                <span class="mr-2 text-sm font-bold">Kết quả HPV </span>
                                <p class="leading-3 italic text-xs">(HPV result)</p>
                            </td>
                            <td class=" border-1 border-gray-900 text-center py-0 pb-1" colspan="2">
                                <div v-if="td.resulthpvs.find((result) => result.element_id === '56')">
                                    <span class=" mr-2 text-sm text-blue-600 font-bold">Âm tính </span>
                                    <p class="leading-3 italic text-xs">(Negative)</p>
                                </div>
                                <div v-else></div>

                            </td>
                        </tr>
                    </table>
            </div>
            <div>
                <div  class="pb-0 font-sans-Timenew mb-0"><span class="text-red-600  uppercase  underline font-bold text-sm py-0">3. KẾT Luận:</span><span class="text-md italic">(Conclusion)</span></div>
                <div class="" style="width:95%">
                    <table class="font-sans-Timenew" >
                        <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900 py-0 text-sm">
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 py-0" colspan="2">11 Orther HPV High-Risk</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1  py-0" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1  py-0" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 py-0 text-sm" style="">
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" width="" >Âm tính (Negative)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" width="" >Âm tính (Negative)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1 py-0" colspan="2" >Âm tính (Negative)</td>
                        </tr>
                    </table>
                </div>
            </div>
       </div>
        <table class="font-sans-Timenew table" >
                <tr class=" font-sans-Timenew text-sm">
                    <td class="text-center font-bold" colspan="2"  style="border:none !important" width="50%"></td>
                    <td class=" text-center " colspan="2"  style="border:none !important">
                        <p class="italic leading-3 " style="border:none">Ngày (date): <span>{{currentDate()}}</span></p>
                        <p class="leading-3 font-bold" style=" border:none">Trưởng Khoa GPB</p>
                        <span v-if="td.ousent.asign_view" class="text-center flex justify-center" style="border:none">
                            <span v-if="ouread">
                                <img :src="asignPath+ouread.asign" class="h-16 w-auto">
                            </span>
                            <span v-else></span>
                        </span>
                        <p v-else class=" py-5" style="border:none"></p>
                        <span class="text-xl font-bold" style=" border:none" v-if="ouread"><span class="mr-1">{{ouread.title}}</span><span>{{ouread.name}}</span></span>
                        <span class="text-xl font-bold" style=" border:none" v-else></span>
                    </td>
                </tr>
        </table>
    </div>
    </div>
        <div class="page-break"></div>
    </div>

</template>

<script>

import moment from 'moment'
import VueBarcode from '@chenfengyuan/vue-barcode';


export default {
    name: "In HPV",
  components: {
    VueBarcode
  },
    props:{
        getbilltests:Object,
        testElements:'',
        eurolab:'',
        ouread:'',
        pathLogoEurolab:''
    },
    computed:{
        getSCo(){
            return this.sco.result
        }
    },

    data(){
        return{
            barcodeValue:'123',
            imageHeaderPath:'/storage/imageHeader_Ousent/',
            logoPath:'/storage/Image_Ousent/',
            asignPath:'/storage/Image_Ouread/',
            logoGG:'/images/Logo/LogoGG(40_40).png',
            imagePathBackground:'/images/Logo/eurolab.png',
              imagePathLogoEro:'/images/Logo/logohpv(30_30).png',
        }
    },
    methods:{
        formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', '.')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
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
<style>
@page :first {

  margin-top: 0px;
  padding-top: 0px;
}
</style>


