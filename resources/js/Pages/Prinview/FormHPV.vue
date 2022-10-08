<template>
<div id="printMe" ref="printMe" class="px-0 my-0 " >
    <div v-if="getbilltests.resulthpvs">
        <div  v-if="getbilltests.ousent">
            <div v-if="getbilltests.ousent['header_view'] == 1">
                 <img class="h-24 w-full" :src="imageHeaderPath+getbilltests.ousent['image_header']">
            </div>
            <div v-else class="grid grid-cols-8 mt-0 mb-0 pb-0 align-middle">
                <div class="col-span-2 text-center " >
                    <span class="flex justify-end object object-end pr-2" v-if=" getbilltests.ousent['logo_view'] ==1">
                        <img class="h-20" :src="logoPath+getbilltests.ousent['logo']">
                    </span>
                    <span v-else class="flex justify-center object object-end pr-2">
                            <img class="w-48" :src="imagePathLogoEro">
                    </span>
                </div>
                <div class="col-span-6 py-0 m-0" >
                    <div class="w-full" v-if="getbilltests.ousent['address_view'] == 1">
                        <p class="uppercase font-sans-Timenew font-bold text-xl" v-if="getbilltests.ousent.title">{{getbilltests.ousent['title']}}</p>
                        <p class="uppercase font-sans-Timenew font-bold text-xl" v-else>{{getbilltests.ousent['name']}}</p>
                        <div class="grid grid-cols-8 text-lg">
                            <div class="font-bold font-sans-Timenew col-span-1">Địa chỉ: </div>
                            <div class="col-span-6 text-left ml-0 pl-0 font-sans-Timenew w-auto" v-if="getbilltests.ousent">
                                <span class="" >{{getbilltests.ousent['address']}}</span>
                            </div>
                        </div>
                        <div class="flex text-lg mb-2" style="line-height:80%" v-if="getbilltests.ousent['phone_contact'] " >
                            <div class="font-bold font-sans-Timenew" >ĐT(Hostline):</div>
                            <div class=" text-left ml-1 pl-0 font-sans-Timenew"  >
                                {{getbilltests.ousent['phone_contact']}}
                            </div>
                        </div>
                        <div class="flex text-lg mb-2" style="line-height:80%" v-if="getbilltests.ousent['website'] ">
                            <div class="font-bold font-sans-Timenew ">Website:</div>
                            <div class=" text-left ml-1 pl-0 font-sans-Timenew"  >
                                {{getbilltests.ousent['website']}}
                            </div>
                        </div>
                    </div>

                 <div class="w-full" v-if="((getbilltests.ousent['address_view'] ===null && getbilltests.ousent['logo_view'] ===null) || (getbilltests.ousent['address_view'] ==0 && getbilltests.ousent['logo_view'] ==0))">
                        <p class="uppercase font-sans-Timenew font-bold text-xl" >{{eurolab.name}}</p>
                        <div class="grid grid-cols-8 text-lg">
                            <div class="font-bold font-sans-Timenew col-span-1 -mt-1">Địa chỉ: </div>
                            <div class="col-span-6 text-left ml-0 pl-0 font-sans-Timenew w-auto leading-5">
                                <span class="" >{{eurolab.addressHN}}</span>
                            </div>
                        </div>
                        <div class="flex text-lg mb-2 mt-2" style="line-height:80%">
                            <div class="font-bold font-sans-Timenew">Hostline:</div>
                            <div class=" text-left ml-1 pl-0 font-sans-Timenew"  >
                                {{eurolab.phoneHN}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <hr class="mt-0 p-0 h-2 bg-gray-800">
    <div class="text-center font-bold text-2xl font-sans-Timenew mt-2 text-red-600">
        <P>PHIẾU TRẢ KẾT QUẢ XÉT NGHỆM E6/E7 mRNA HPV</P>
        <P class="leading-3">(<span class="mt-0 pl-0">APTIMA</span> <span class="ml-0 pl-0" style="vertical-align: super; font-size:16px ; padding:0px">&reg;</span> HPV Assay)</P>
    </div>
    <!--INFOMATION OF PATIENT==================-->
      <div style="border:none;" class="pb-0 font-sans-Timenew mb-0 leading-3"><span class="text-red-600 uppercase  underline font-bold text-xl">1. Thông tin mẫu:</span><span class="text-md italic">(Information)</span></div>
    <!-- <div class="bg-logo_background bg-center bg-40 bg-no-repeat backdrop-opacity-[0.15]"> -->
     <div class="absolute mt-0 flex justify-center w-full opacity-30 h-28">
        <img class="w-96" :src="pathImageBackground">
    </div>
    <div class="relative">
    <!-- <img src="/images/Logo/logoGG.png"> -->
    <table class="table mt-0">
        <tr class="">
            <td class="py-0 pl-2" style="border:none !important">
                <div class="grid grid-cols-4 font-sans-Timenew text-lg  m-0 p-0" style="border:none !important">
                    <div class="col-span-2">
                         <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Tên bệnh nhân: </span>
                                <p class="leading-3 italic text-sm">(Full name)</p>
                            </div>
                            <div>
                               <span class="font-bold text-xl"> {{printCustommers['name']}} </span>
                            </div>
                        </div>

                    </div>
                    <div class="">
                        <div class="flex flex-row text-lg" >
                            <div>
                                <span class="font-bold mr-2">Giới tính: </span>
                                <p class="leading-3 italic text-sm">(Sex)</p>
                            </div>
                            <div>
                                <span class="font-bold"> "Nữ" </span>
                                <p class="leading-3 italic text-">Female</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row text-lg">
                            <div>
                                <span class="font-bold mr-2">Năm sinh: </span>
                                <p class="leading-3 italic text-sm">(Date of birth)</p>
                            </div>
                            <div>
                                <span class="font-bold"> {{printCustommers['birthday']}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl p-0 m-0" style="border:none !important">
                    <div class="col-span-4  leading-3">
                        <div class="flex flex-row ">
                              <div>
                                <span class="font-bold mr-2 text-lg">Địa chỉ: </span>
                                <p class="leading-3 italic text-sm">(Address)</p>
                            </div>
                            <div>
                               <span class="font-bold text-lg"> {{printCustommers['address']}} </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl p-0 m-0" style="border:none !important">
                    <div class="col-span-4  leading-3">
                        <div class="flex flex-row ">
                              <div>
                                <span class="font-bold mr-2 text-lg">Đơn vị gửi mẫu: </span>
                                <p class="leading-3 italic text-sm">(Custommer)</p>
                            </div>
                            <div>
                               <span class="font-bold text-lg"> {{getbilltests.ousent.name}} </span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl m-0 p-0" style="border:none !important">
                    <div class="col-span-2  py-1">
                        <div class="flex flex-row text-lg">
                            <div>
                                <span class="font-bold mr-2 ">Bác sĩ chỉ định: </span>
                                <p class="leading-3 italic text-sm">(Medical Doctor)</p>
                            </div>
                            <div>
                                <span class="font-bold"> {{getbilltests['doctor_indi']}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="leading-5  py-1 text-lg">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2 ">Ngày gửi: </span>
                                <p class="leading-3 italic text-sm">(Date of sending)</p>
                            </div>
                            <div>
                                <span class="font-bold">
                                     {{formatDate(getbilltests['date_receive']) }}
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="leading-5  py-1 text-lg">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-0 ">Khoa: </span>
                                <p class="leading-3 italic text-sm">(Depart)</p>
                            </div>
                            <div>
                                <span class="font-bold"> </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl m-0 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Yêu cầu xét nghiệm: </span>
                                <p class="leading-3 italic text-sm">(Test Requesting)</p>
                            </div>
                            <div>
                                <span class=" "> "Định týp HPV" </span>
                                 <p class="leading-3 italic text-sm">(HPV Genotyping)</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row text-lg">
                            <div class="m-0 p-0 text-left">
                                <span class="font-bold pr-1 ">Mã BN: </span>
                                <p class="leading-3 italic text-sm">(Partient ID)</p>
                            </div>
                            <div class="m-0 p-0">
                                <span class="font-bold p-0 m-0 text-left">{{getbilltests['patient_code']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row text-lg">
                            <div>
                                <span class="font-bold pr-1 ">Mã XN: </span>
                                <p class="leading-3 italic text-sm">(Lab Barcode)</p>
                            </div>
                            <div>
                                <span class="font-bold"> {{getbilltests['hpv_code']}} </span>
                                  <p class="-mt-1">
                                     <vue-barcode class="h-8 w-24" :value="getbilltests['hpv_code']" :options="{ displayValue: false }"></vue-barcode>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl mt-0 p-0 " style="border:none !important">
                    <div class="col-span-4" style="border:none !important">
                        <div class="flex flex-row" style="border:none !important">
                            <div class="">
                                <span class="font-bold mr-2 ">Phương pháp: </span>
                                <p class="leading-3 italic text-sm">(Analytical Method)</p>
                            </div>
                            <div class="" style="border:none !important">
                                <span class="font-bold text-red-600 text-sm"> APTIMA <span class="-ml-1" style="vertical-align: super; font-size:16px ; padding:0px;">&reg;</span> HPV Assay. Approved by the FDA  </span>
                            </div>
                        </div>
                    </div>

                </div>
            </td>
        </tr>
    </table>
    </div>

     <!--==================-->
     <!--===========================================================================-->
    <div style="border:none;border:none !important" class="pb-0 font-sans-Timenew"><span class="text-red-600  uppercase  underline font-bold text-xl">2. KẾT QUẢ:</span><span class="text-md italic">(Reporting result)</span></div>
        <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '56').result >= 0.5">
            <table class="font-sans-Timenew " style="">
                <tr class="bg-black border-1 border-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-black text-lg" colspan="4">14 HPV high-risk</td></tr>
                <tr class="bg-gray-300 font-sans-Timenew font-bold border-1 border-black">
                    <td class="border-1  border-gray-900 text-blue-700 text-center text-xl" colspan="2">S/CO sample value</td>
                    <td class="border-1  border-gray-900 text-center text-xl" colspan="2">S/CO analyte</td>
                </tr>
                <tr class=" font-sans-Timenew border-1">
                    <td class="  text-center align-middle font-bold border-1  border-gray-900" colspan="2" width="50%">
                        <div v-for="(sco, i) in getbilltests.resulthpvs" :key="i">
                            <div v-if="sco.element_id == 56">
                                <div v-if="sco.result != null">
                                    <span v-if=" sco.result >=0.5"  class="text-lg text-red-700">
                                {{ formatPrice(sco.result) }}
                                    </span>
                                    <span v-else>
                                        {{ formatPrice(sco.result) }}
                                    </span>
                                </div>
                                <div v-else> Chưa có kQ</div>
                            </div>
                        </div>
                    </td>
                    <td class="border-1  border-gray-900  text-center" colspan="2">
                        <div class="text-left">
                            <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-10">&lt;</span> 0.5 </span>
                            <p class="leading-3 italic text-xs">(Negative)</p>
                        </div>
                        <div class="text-left">
                            <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-6">&ge;</span> 0.5 </span>
                            <p class="leading-3 italic text-xs">(Positive)</p>
                        </div>
                    </td>
                </tr>
                <tr class=" font-sans-Timenew ">
                    <td class="border-1 border-gray-900" width="50%" colspan="2">
                        <span class="mr-2 text-lg font-bold">Kết quả HPV </span>
                            <p class="leading-3 italic text-md">(HPV result)</p>
                    </td>
                    <td class=" border-1 border-gray-900 text-center" colspan="2">
                        <div class="text-left ">
                            <div v-for="(sco, i) in getbilltests.resulthpvs" :key="i">

                                    <div v-if="sco.element_id == 56">
                                        <div v-if="sco.result != null">
                                            <div v-if="sco.result >= 0.5">
                                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                                <p class="leading-3 italic text-md">(Positive)</p>
                                            </div>
                                            <div v-else>
                                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                                <p class="leading-3 italic text-md">(Negative)</p>
                                            </div>
                                        </div>
                                        <div v-else>---</div>
                                    </div>
                                </div>

                        </div>
                    </td>
                </tr>
        </table>
        </div>
        <div v-else class="mt-2 w-1/2">
            <table class="font-sans-Timenew " style="">
                <tr class="bg-black border-1 border-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-black text-lg" colspan="4">14 HPV high-risk</td></tr>
                <tr class="bg-gray-300 font-sans-Timenew font-bold border-1 border-black">
                    <td class="border-1  border-gray-900 text-blue-700 text-center text-xl" colspan="2">S/CO sample value</td>
                    <td class="border-1  border-gray-900 text-center text-xl" colspan="2">S/CO analyte</td>
                </tr>
                <tr class=" font-sans-Timenew border-1">
                    <td class="  text-center align-middle font-bold border-1  border-gray-900" colspan="2" width="50%">
                        <div v-for="(sco, i) in getbilltests.resulthpvs" :key="i">
                            <div v-if="sco.element_id == 56">
                                <div v-if="sco.result != null">
                                    <span v-if=" sco.result >=0.5"  class="text-lg text-red-700">
                                {{ formatPrice(sco.result) }}
                                    </span>
                                    <span v-else>
                                        {{ formatPrice(sco.result) }}
                                    </span>
                                </div>
                                <div v-else> Chưa có kQ</div>
                            </div>
                        </div>
                    </td>
                    <td class="border-1  border-gray-900  text-center" colspan="2">
                        <div class="text-left">
                            <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-10">&lt;</span> 0.5 </span>
                            <p class="leading-3 italic text-xs">(Negative)</p>
                        </div>
                        <div class="text-left">
                            <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-6">&ge;</span> 0.5 </span>
                            <p class="leading-3 italic text-xs">(Positive)</p>
                        </div>
                    </td>
                </tr>
                <tr class=" font-sans-Timenew ">
                    <td class="border-1 border-gray-900" width="50%" colspan="2">
                        <span class="mr-2 text-lg font-bold">Kết quả HPV </span>
                            <p class="leading-3 italic text-md">(HPV result)</p>
                    </td>
                    <td class=" border-1 border-gray-900 text-center" colspan="2">
                        <div class="text-left ">
                            <div v-for="(sco, i) in getbilltests.resulthpvs" :key="i">

                                    <div v-if="sco.element_id == 56">
                                        <div v-if="sco.result != null">
                                            <div v-if="sco.result >= 0.5">
                                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                                <p class="leading-3 italic text-md">(Positive)</p>
                                            </div>
                                            <div v-else>
                                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                                <p class="leading-3 italic text-md">(Negative)</p>
                                            </div>
                                        </div>
                                        <div v-else>---</div>
                                    </div>
                                </div>

                        </div>
                    </td>
                </tr>
            </table>
        </div>

    <div  v-if="getbilltests.resulthpvs">
       <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '56').result >= 0.5">
            <table>
                <tr class="bg-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-gray-900" colspan="4">GT HPV 16, 18/45</td></tr>
                <tr class="bg-gray-300 font-sans-Timenew font-bold">
                    <td class=" text-blue-700 text-center text-lg border-1 border-gray-900" width="25%">
                        <span>S/CO HPV 16 </span>
                        <p>sample value </p>
                    </td>
                    <td class=" text-center text-lg border-1 border-gray-900" width="25%">
                        <span>S/CO HPV 16 </span>
                        <p>analyte </p>
                    </td>
                    <td class="border-1 border-gray-900 text-blue-700 text-center text-lg" width="25%">
                        <span>S/CO HPV 18/45 </span>
                        <p>sample value </p>
                    </td>
                    <td class=" text-center text-lg border-1 border-gray-900" width="25%">
                        <span>S/CO HPV 18/45</span>
                        <p>analyte </p>
                    </td>
                </tr>
                <tr class=" font-sans-Timenew">
                    <td class="  text-center align-middle font-bold border-1 border-gray-900">
                                <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '57')">
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '57').result >= 1">
                                   <span  class="text-red-700 text-xl"> {{formatPrice(getbilltests.resulthpvs.find((result) => result.element_id === '57').result)}}</span>
                                </div>
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '57').result < 1">
                                   <span  class="text-blue-700 text-xl">{{formatPrice(getbilltests.resulthpvs.find((result) => result.element_id === '57').result)}}</span>
                                </div>

                                </div>
                                    <div v-else>
                                        {{formatPrice(0)}}
                                    </div>

                    </td>
                    <td class="  text-center border-1 border-gray-900">
                        <div class="text-left">
                                    <span class=" mr-2 text-sm">Âm tính nếu <span class="ml-10">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-xs">(Negative)</p>
                        </div>
                        <div class="text-left">
                            <span class=" mr-2 text-sm">Dương tính nếu <span class="ml-4">&ge;</span> 1.00 </span>
                            <p class="leading-3 italic text-xs">(Positive)</p>
                        </div>
                    </td>
                    <td class="text-center align-middle font-bold border-1 border-gray-900">
                                 <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '58')">
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                                   <span  class="text-red-700 text-xl"> {{formatPrice(getbilltests.resulthpvs.find((result) => result.element_id === '58').result)}}</span>
                                </div>
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '58').result < 1">
                                   <span  class="text-blue-700 text-xl">{{formatPrice(getbilltests.resulthpvs.find((result) => result.element_id === '58').result)}}</span>
                                </div>
                                </div>
                                    <div v-else>{{formatPrice(0)}}
                                </div>
                    </td>
                    <td class="  text-center border-1 border-gray-900">
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
                            <td class="border-1 border-gray-900">
                                <span class=" mr-2 text-lg font-bold">Kết quả HPV 16 </span>
                                    <p class="leading-3 italic text-md">(HPV 16 result)</p>
                            </td>
                            <td class="  text-center border-1 border-gray-900">
                                <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '57')">
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '57').result >= 1">
                                    <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                    <p class="leading-3 italic text-md">(Positive)</p>
                                </div>
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '57').result < 1">
                                   <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                    <p class="leading-3 italic text-md">(Negative)</p>
                                </div>

                                </div>
                                <div v-else>
                                    <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                    <p class="leading-3 italic text-md">(Negative)</p>
                                </div>
                            </td>
                            <td class="border-1 border-gray-900">
                                <span class="font-bold mr-2 text-lg">Kết quả HPV 18/45 </span>
                                    <p class="leading-3 italic text-md">(HPV 18/45result)</p></td>
                            <td class="  text-center border-1 border-gray-900">
                                 <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '58')">
                                    <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '58').result >= 1">
                                        <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                        <p class="leading-3 italic text-md">(Positive)</p>
                                    </div>
                                    <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '58').result < 1">
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
            <div  class="pb-0 font-sans-Timenew mb-0 mt-3"><span class="text-red-600  uppercase  underline font-bold text-xl">3. KẾT Luận:</span><span class="text-md italic">(Conclusion)</span></div>
            <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '57') || getbilltests.resulthpvs.find((x) => x.element_id === '58')">
                <div v-if="(getbilltests.resulthpvs.find((x) => x.element_id === '57') && getbilltests.resulthpvs.find((x) => x.element_id === '57').result >=1)|| getbilltests.resulthpvs.find((x) => x.element_id === '58').result >=1">
                    <table class="font-sans-Timenew" >
                    <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 16</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 18/45</td>
                    </tr>
                    <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                        <td class="font-bold text-red-600 text-center  border-black border-1" colspan="2" width="" >
                                <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '57')">
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '57').result >= 1">
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
                        <td class="font-bold text-red-600 text-center  border-black border-1" colspan="2" width="" >
                                <div v-if="getbilltests.resulthpvs.find((x) => x.element_id === '58')">
                                <div v-if="getbilltests.resulthpvs.find((result) => result.element_id === '58').result >= 1">
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
                        <!-- <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >
                            <div v-for="(sco18, i) in getbilltests.resulthpvs" :key="i">
                                <div v-if="sco18.element_id == 58">
                                    <div v-if="sco18.result != null">
                                            <div v-if="sco18.result>=1">
                                        <span  class="text-red-700 text-lg">Dương tính (Positive)</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-lg">Âm tính (Negative)</span>
                                        </div>
                                    </div>
                                    <div v-else>
                                        --
                                    </div>


                                </div>
                            </div>
                        </td> -->
                    </tr>
                    </table>
                </div>
                <div v-else>
                    <table class="font-sans-Timenew" >
                        <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">11 Orther HPV High-Risk</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                        <td class="font-bold text-red-600 text-center  border-black border-1" colspan="2" width="" >Dương tính (Positive)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" width="" >Âm tính (Negative)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >Âm tính (Negative)</td>
                        </tr>
                    </table>
                </div>

            </div>
            <div v-else>
                <table class="font-sans-Timenew" >
                    <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">11 Orther HPV High-Risk</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 16</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 18/45</td>
                    </tr>
                    <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                    <td class="font-bold text-red-600 text-center  border-black border-1" colspan="2" width="" >Dương tính (Positive)</td>
                        <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" width="" >Âm tính (Negative)</td>
                        <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >Âm tính (Negative)</td>
                    </tr>
                </table>
            </div>
       </div>
        <div v-else>
            <div  class="pb-0 font-sans-Timenew mb-0 mt-3"><span class="text-red-600  uppercase  underline font-bold text-lg">3. KẾT Luận:</span><span class="text-md italic">(Conclusion)</span></div>
                <table class="font-sans-Timenew" >
                    <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">11 Orther HPV High-Risk</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 16</td>
                        <td class=" bg-gray-300 text-center font-bold border-black border-1 text-lg" colspan="2">Genotype HPV 18/45</td>
                    </tr>
                    <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                        <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" width="" >Âm tính (Negative)</td>
                        <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" width="" >Âm tính (Negative)</td>
                        <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >Âm tính (Negative)</td>
                    </tr>
                </table>
        </div>
    </div>
     <!--======================================Sign footer=======================================================-->
        <table class="font-sans-Timenew table" >
            <tr class=" font-sans-Timenew">
                <td class="text-center font-bold" colspan="2"  style="border:none !important" width="50%"></td>
                <td class=" text-center " colspan="2"  style="border:none !important">
                    <p class="italic leading-3 text-lg" style="border:none">Ngày (date): <span>{{currentDate}}</span></p>
                    <p class="leading-3 text-xl font-bold" style=" border:none">Trưởng Khoa GPB</p>
                        <span v-if="getbilltests.ousent['asign_view']" class="text-center">
                            <span class="flex justify-center" v-if="ouread">
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
    <div v-else></div>
</div>
</template>

<script>
import Table from '../../Components/Table.vue'
import moment from 'moment'
import VueBarcode from '@chenfengyuan/vue-barcode';

export default {
  components: { Table,VueBarcode},
    props:{
        getbilltests:Object,
        printCustommers:Object,
        printAddress:'',
        printOutsent:'',
        ouread:'',
        printDoctor:'',
        selectedArray:'',
        testElements:'',
        eurolab:'',
        pathLogo:'',
        currentDate:'',
        pathLogoOusent:'',
        pathLogoEurolab:'',
        pathImageBackground:'',

    },
    computed:{
        getSCo(){
            return this.sco.result
        },
         decimalRounded() {
      return this.myDecimal.toFixed(2)
    }
    },
    filters: {
    decimalFiltered: function (value) {
      if (!value) return ''
      return value.toFixed(2)
    }
  },

    data(){
        return{
            imagePathBackground:'/images/Logo/logoGG.png',
            imagePathLogoEro:'/images/Logo/logohpv(30_30).png',
            logoPathGG_40:'/images/Logo/logoGG(40_40).png',
            logoPath:'/storage/Image_Ousent/',
            asignPath:'/storage/Image_Ouread/',
            imageHeaderPath:'/storage/imageHeader_Ousent/',
        }
    },
    methods:{
        formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    },
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', '.')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }


    }
}


</script>

<style>

</style>