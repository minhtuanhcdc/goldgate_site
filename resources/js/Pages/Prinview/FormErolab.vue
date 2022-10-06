<template>
  <div>
    <h4>Form group 5</h4>
    <div class="pl-2" ref="printMe" id="printMe" >
      <div class="flex justify-between mx-0 py-0">
        <div class="flex">
          <span>
            <img
              class="object-contain h-14"
              :src="imageGGSqure"
              :alt="LogoThin"
            />
          </span>
          <div class="flex-1 pl-3">
            <span class="leading-5">
              <p class="font-bold font-sans-Timenew uppercase"> {{eurolab.name}}</p>
              <span class="mt-2">
                <span class="flex font-sans-Timenew">
                      <span class="font-bold">Địa chỉ:</span>
                      <span class="flex-1"> {{eurolab.addressSG}}</span>
                </span>
                <p v-if="eurolab.phoneSG"><span class="font-bold font-sans-Timenew mr-2">Điện thoại:</span>{{eurolab.phoneSG}}</p>
                <p v-if="eurolab.website"><span class="font-bold font-sans-Timenew mr-2">Website:</span>{{eurolab.website}}</p>

              </span>
            </span>
          </div>
        </div>
        <div class=" text-center font-sans-Timenew leading-5 fontsizeElement w-80">
          <p class="-mt-1  flex justify-center">
            <vue-barcode class="h-10 w-44" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
          </p>
            <p class="p-0 w-full  font-bold text-lg">Số (Number): {{getbilltests['thinprep_code']}}</p>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div></div>
        <div class="pt-0 py-0 place-items-center flex flex-col text-blue-800 fontsizeTitle">
          <span class="text-center font-bold text-2xl font-sans-Timenew ">PHIẾU XÉT NGHIỆM TẾ BÀO</span>
          <div>
            <span class="text-center font-bold text-2xl font-sans-Timenew ml-0 pl-0">PAP'S SMEAR - ThinPrep</span>
            <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>
          </div>
        </div>
      </div>
      <div class="mt-2 text-blue-700 fontsizeInfo">
        <div class="text-red-800"><span class="text-xl uppercase underline text-red-800 font-bold font-sans-Timenew">THÔNG TIN BỆNH NHÂN</span> <span class="font-sans-Timenew font-bold" >(Patient Information)</span></div>
          <div class="grid grid-cols-4 leading-6  font-sans-Timenew">
              <div class="col-span-2 font-sans-Timenew italic"><span class="font-bold">Họ và tên</span> (Name):<span class=" font-bold">{{printCustommers['name']}}</span></div>
              <div class="  font-sans-Timenew italic"><span class="font-bold">Năm sinh</span> (Age):<span class="pl-2">{{printCustommers['birthday']}}</span></div>
              <div class="  font-sans-Timenew italic font-bold">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
          </div>
          <div class="">
              <span class="col-span-3 font-sans-Timenew leading-8 italic font-bold">Đia chỉ</span> <span>(Address):{{printCustommers['address']}}</span>
          </div>
            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic text-sm fontsizeElement">
              <div class="font-bold">IUD (Intra-Uterine Devices)  <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests['intra']" ></div>
              <div class="font-bold text-center">Nội tiết (Hormone) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests['hormone']"  ></div>
              <div class="font-bold text-center">Xạ (Radiation) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3"  :checked="getbilltests['radiation']" ></div>
              <div class="font-bold text-center">Có thai (Pregnancy) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests['preg']"  ></div>
          </div>
          <div class="font-sans-Timenew leading-8 italic text-md flex justify-between">
            <div>
              <span class="font-bold">Ngày kinh chót</span>(Last Menstual Periad):<span class="pl-2 font-bold">{{getbilltests['kinhchot']}} </span>
            </div>
            <div>
              <span class="font-bold">Ngày gửi</span>(Date sent):<span class="pl-2 font-bold">{{ formatDate(getbilltests['date_sent'])}} </span>
            </div>
          </div>
          <div class="grid grid-cols-2 italic text-md mb-2">
              <div class="font-sans-Timenew leading-8"><span class="font-bold">Chẩn đoán lâm sàng</span>(Clinical diagnose):<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>
          </div>
      </div>
      <div>
        <div class="grid grid-cols-2">
          <div>
            <div  class="text-center flex justify-center">
              <img v-if="getbilltests['thinprep_code']"
                class="w-86 max-h-72 object-cover "
                :src="pathThinLeft+imageThinLeft"
                :alt="imageThinLeft"/>
              <img v-else
                class="w-80 max-h-52 "
                :src="pathImageLeft"
                alt="imageThinLeft"/>
            </div>
          </div>
          <div class="text-blue-700 fontsizeInfo">
            <div class="font-sans-Timenew leading-6 mb-2"><span class="font-bold">Bs. Chỉ định </span>(Physician):<span class="font-bold pl-2"> {{getbilltests['doctor_indi']}}</span></div>
            <div class="font-bold italic col-span-2 font-sans-Timenew ">Đánh giá lam (Specimen evalueation)</div>
            <div class="flex  font-sans-Timenew fontsizeLabel" >
              <div class="" v-for="eg1 in testElements" :key="eg1.id">
                <div class="font-bold pl-2 mr-4" v-if="eg1.element_group == 1">{{eg1.name}}
                  <span v-if="eg1.id == 1">
                    <span v-if="getbilltests.results">
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests.results.map(({result }) =>result)[0] !=='2'" />
                    </span>
                    <span v-else>
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" />
                    </span>
                  </span>
                  <span v-else>
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg1.id" v-model="selectedArray"/>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" font-bold fontsizeKQ font-sans-Timenew mt-2 text-red-600 py-2">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
        <div class="border-2 border-black px-2 py-3 text-blue-700 ">
          <div class="grid grid-cols-1 font-sans-Timenew">
            <div class="fontsizeElement" v-for="(eg2,i) in testElements" :key="i">
              <div class="font-bold text-green-700 " v-if="eg2.element_group == 2">{{i-1}}. {{eg2.name}}
                <span v-if="eg2.id == 4">
                  <span v-if="ketluan">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3"/>
                  </span>
                  <span v-else>
                    <span v-if="getbilltests.results">
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests.results.map(({result})=> result)[0] !=='3'"/>
                    </span>
                  </span>
                </span>
                <span v-else>
                  <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg2.id" v-model="selectedArray"/>
                </span>
              </div>
            </div>
          </div>
          <div class="flex flex-cols-5 fontsizeElement">
            <div class="" v-for="eg3 in testElements" :key="eg3.id">
              <span class="text-left font-bold   font-sans-Timenew mr-5 pl-2" v-if="eg3.element_group == 3">+ {{eg3.name}}
                <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg3.id" v-model="selectedArray"/>
              </span>
            </div>
          </div>
          <div class="grid grid-cols-1 fontsizeElement">
            <div class="" v-for="eg4 in testElements" :key="eg4.id">
              <span class="text-left font-bold text-lg  font-sans-Timenew mr-5 text-green-700" v-if="eg4.element_group == 4">3. {{eg4.name}}
                <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg4.id" v-model="selectedArray"/>
              </span>
            </div>
          </div>
          <div class="col-span-2">
            <span class=" font-sans-Timenew font-bold text-lg   text-red-700 pl-3">+ TẾ BÀO GAI (Squamuos cell)</span>
            <div class="grid grid-cols-2 leading-5 italic fontsizeElement">
              <div class="flex flex-col">
                <div class="" v-for="eg5 in testElements" :key="eg5.id">
                <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5"><span class="text-black mr-1">&lowast;</span>{{eg5.name}}
                  <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg5.id" v-model="selectedArray"/>
                </span>
                </div>
              </div>
              <div class="flex flex-col">
                <div class="" v-for="eg6 in testElements" :key="eg6.id">
                  <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6"><span class="text-black mr-1">&lowast;</span>{{eg6.name}}
                    <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg6.id" v-model="selectedArray"/>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-1 mt-2">
            <div>
              <span class=" font-sans-Timenew font-bold text-lg uppercase text-red-700 pl-4"> + Tế bào Tuyến</span>
              <div class="grid grid-cols-2 leading-5">
                <div v-for="eg21 in testElements" :key="eg21.id">
                  <div v-if="eg21.element_group == 21">
                    <span class="text-left font-bold text-xs ml-4 mr-6  font-sans-Timenew" >- {{eg21.name}}
                      <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg21.id" v-model="selectedArray"/>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-5 font-sans-Timenew leading-6 italic  mt-2">
            <div class="font-bold  p-0 font-sans-Timenew">Đề nghị (Suggestions):</div>
            <div class="font-bold col-span-4">
              <div class="flex flex-rows-2">
                <div  v-for="eg18 in testElements" :key="eg18.id">
                  <span class="font-bold text-xs w-full mr-3" v-if="eg18.element_group ==18 && eg18.element_group !==null ">{{eg18.name}}
                    <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg18.id" v-model="selectedArray"/>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="font-bold mt-2 p-0 font-sans-Timenew fontsizeElement">Ghi chú (Notes):{{getbilltests['note']}}</div>
        </div>
        <div class="flex justify-between">
          <div class="flex flex-col">
            <div class="grid grid-cols-1">
              <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
              <div  v-for="eg9 in testElements" :key="eg9.id">
                <span class="font-bold text-xs w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                  <span v-if="ketluan" class="uppercase text-red-800 font-sans-Timenew fontsizeLabel pl-2">- {{ketluan}}</span>
                  <span v-else >
                    <span class="  font-sans-Timenew text-lg pl-2 font-bold">Biến đổi tế bào lành tính (Benign change)</span>
                  </span>
                </span>
              </div>
            </div>
          </div>
          <div class="flex flex-col text-center fontsizeInfo">
            <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
            <span class="font-bold font-sans-Timenew ">BS GPBL - TB</span>
            <div v-if="getbilltests['asign_view']" ></div>
            <div v-else>
              <span class="py-2 flex justify-end" v-if="printOutsent.asign_view">
                <img class="h-14" :src="path_asign +doctorread.asign"/>
              </span>
              <span class="py-10" v-else></span>
              <span class="font-bold font-sans-Timenew ">{{doctorread.title }}<span class="ml-2">{{doctorread.name}}</span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
import AppImageView from "@/Components/ImageView";
import VueBarcode from '@chenfengyuan/vue-barcode';
import moment from 'moment';
export default {
    props:{
        getbilltests:Object,
        printCustommers:Object,
        printAddress:'',
        printOutsent:'',
        printDoctor:'',
        doctorread:'',
        selectedArray:'',
        testElements:'',
        pathImageLeft:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        imageThinRight:'',
        ketluan:'',
        logo:'',
        pathLogo:'',
        currentDate:'',
        imageGGSqure:'',
        imagePathBackground:'',
        eurolab:'',
        pathLogoEuro:'',
        path_asign:'',
    },
    components:{
      CheckIcon,
      AppImageView,
      VueBarcode
    },
      methods:{
       formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    },
    }
}
</script>

<style media="print">
@media print {
  .bodyview111{
  position:relative;
  }
  @page{
     margin: 10mm 0.5mm 20mm 10mm;
  }

  .fontsizeLabel{
    font-size: 12pt;
  }
  .fontsizeInfo{
    font-size: 16pt;
  }
  .fontsizeElement{
    font-size: 14pt;
  }
  .fontsizeTitle{
    font-size: 20pt;
  }
  .fontsizeKQ{
    font-size: 18pt;
  }

 .page-footer {
    position:fixed !important;

    bottom: 0;

  }
}

</style>