<template>
  <app-layout title="Nhập thông tin BN">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container id="all">
      <Card>
        <!--====message==================------->
        <div>
          <div v-if="$page.props.flash.success || $page.props.flash.failure"
              class="fixed bottom-4 right-4 flex items-center text-white px-8 py-4 bg-opacity-80"
              :class="{
                'bg-green-500':$page.props.flash.success,
                'bg-red-500':$page.props.flash.failure, }"
            >
            <div>
              {{$page.props.flash.success}}
            </div>
            <div>
              {{$page.props.flash.failure}}
            </div>
            <button class="ml-4" @click="hideMessage">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </button>
            </div>
        </div>
        <!--====/message==================------->
        <div>
          <div class="text-red-700" v-if="errors.hpv_code">
          <span class="mr-2">Trùng mã HPV:</span><span class="font-bold">{{ code_repeat}}</span>
          </div>
          <div class="text-red-700" v-if="errors.thinprep_code">
            <span class="mr-2">Trùng mã Thinprep:</span><span class="font-bold">{{ code_repeat_thin}}</span>
          </div>
          <div class=" flex flex-row border-1 border-red-700 mb-2 justify-between"  v-if="errorsView">
          <div v-if="errors" class="grid grid-cols-4">
              <p class="text-red-700 px-4" v-for="(er,i) in errors" :key="i">
                {{er}}
              </p>
          </div>
          <div class=" text-right">
          <XCircleIcon @click="closeError" class="w-8 text-red-700 cursor-pointer"/>
          </div>
          </div>
        </div>
        <!--====view Errors==================------->

        <div class="grid grid-cols-1 mb-2">
          <div class="flex flex-1 justify-between">
            <button  class="cursor-pointe bg-blue-600 px-2 py-1 rounded-md hover:bg-blue-800 hover:text-gray-900 h-8 text-white"   @click="addCustommer">+ Add</button>
            <div class="flex flex-row">
            <!-- <a :href="route('downloadPDF',checkPrint)" class="bg-green-800 py-1 px-2 rounded-md text-white cursor-pointer h-8" target="blank" >Print PDF <span class="text-xs m-0 ">({{checkPrint?checkPrint.length:0}})</span></a> -->
            <button  class="ml-2 bg-green-600 px-2 py-0 rounded-md float-right cursor-pointer h-8 text-white">Export EXCEL<span class="text-xs ml-1">(1)</span></button>
            <button @click="deleteMulte(checkSelect)"  class="ml-2 bg-red-600 px-2 py-0 rounded-md float-right cursor-pointer h-8 text-white">Multi Delete<span class="text-xs ml-1">({{checkSelect?checkSelect.length:0}})</span></button>
            </div>
            <div class="flex flex-row border-solid border-1 border-gray-300 py-0 bg-green-200 h-8">
              <form @submit.prevent="submitFile">
                <div class="flex flex-row">
                    <div>
                        <input type="file"
                          class="w-full px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                          @change="previewImage" ref="photo"/>
                    </div>
                    <div class="flex items-center mt-0">
                        <button class="px-2 py-1 text-white bg-gray-900 rounded " >Upload</button>
                    </div>
                  </div>
                </form>

            </div>
          </div>
        </div>
        <!---/////==================------->
        <!---==================------->
        <hr class="mb-2">
        <div class="flex justify-between">
          <div class="w-1/4 ">
            <div class="flex flex-row">
              <div class="">
                <span>ĐV gửi mẫu:</span>
              </div>
              <div class="flex-1">
                <select
                  name="testgroup"
                  id="testgroup"
                  class="block py-0 w-full form-input h-8 rounded-lg text-md"
                  v-model="ousentFill"
                >
                  <option value="">All</option>
                  <option
                    v-for="(ous,i) in ousents"
                    :key="i"
                    :value="ous.id"
                  >
                    {{ous.id}} - {{ ous.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>
            <div class="col-span-2  mx-2">
              <div class="flex flex-grow">
                <div class="">
                  <span>Xét nghiệm:</span>
                </div>
                <div class="col-span-2 w-52">
                  <select
                    name="testgroup"
                    id="testgroup"
                    class="block py-0 w-full form-input h-8 rounded-lg text-md"
                    v-model="nametestFill"
                  >
                    <option value="">All</option>
                    <option
                      v-for="(nt,i) in nametests.data"
                      :key="i"
                      :value="nt.id"
                    >
                      {{ nt.name }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
          <div class="col-span-2  mx-2">
            <div class="flex flex-grow">
              <div class="">
                <span>BS đọc KQ:</span>
              </div>
              <div class="col-span-2 w-52">
                <select
                  name="testgroup"
                  id="testgroup"
                  class="block py-0 w-full form-input h-8 rounded-lg text-md"
                  v-model="readcodeFill"
                >
                  <option value="">All</option>
                  <option
                    v-for="(rcd,i) in readcodes"
                    :key="i"
                    :value="rcd.read_code"
                  >
                    {{ rcd.name }} ({{rcd.read_code}})
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-span-2">
            <div class="flex flex-row">
                <div class="flex flex-row">
                  <span>Từ:</span>
                  <div class="flex flex-row">
                    <jet-input
                    id="startDate"
                    type="date"
                    class="h-8 block w-full"
                    v-model="startDate"
                    autocomplete="startDate"/>
                  </div>
                </div>
                <div class="flex flex-row ml-2">
                  <span>Đến:</span>
                    <jet-input
                      id="endDate"
                      type="date"
                      class= "h-8 block w-full"
                      v-model="endDate"
                      autocomplete="endDate"
                    />
                </div>
            </div>
          </div>
          <div class="col-span-1 text-right">
            <button @click="getPageFill" class="px-4 ml-2 py-2 justify-auto text-white font-bold bg-blue-400 rounded-md text-sm h-8">
                Fill
            </button>
            <button @click="refreshFill" class="px-2 mx-2 py-2 justify-auto text-white font-bold bg-yellow-400 rounded-md text-sm h-8">
                Refresh
            </button>
          </div>
        </div>
        <hr class="mt-2">
        <!---==================------->
        <div class="flex justify-between mt-2 my-1">
          <div>
          <a :href="route('printCode',checkSelect)" class="ml-4 bg-blue-800 py-1 px-2 rounded-md text-white cursor-pointer h-8" target="blank" >Print Hpv Code <span class="text-xs m-0 ">
            ({{checkSelect?checkSelect.length:0}})</span></a>
          </div>
          <div>
          <a :href="route('printThin',checkSelect)" class="ml-4 bg-green-800 py-1 px-2 rounded-md text-white cursor-pointer h-8" target="blank" >Print Thin Code <span class="text-xs m-0 ">
            ({{checkSelect?checkSelect.length:0}})</span></a>
          </div>
          <div class="">
            <div class=" bg-blue-100">
              <div class=" text-right">
                <div class="flex mb-2 text-right h-8 px-2 w-full">
                    <jet-input
                      placeholder="...Nhập Mã XN"
                      id="search"
                      type="text"
                      class="mt-1 block w-full h-8 mr-2"
                      autocomplete="search"
                      v-model="termSearch"
                        @keyup="search"
                    />
                    <span class="justify-center justify-items-center mt-2 cursor-pointer" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    </span>
                  </div>
              </div>
            </div>
          </div>
          <div class="p-0 text-right rounded-sm">
              <div class="flex flex-row justify-end">
                <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="perPage:" />
                <select
                  name="perPage"
                  id="perPage"
                  class="block py-0 w-24 form-input h-8 rounded-lg"
                  v-model="perPage"
                  @change="getfilePerpage"
                >
                  <option value="1">1</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                  <option value="150">150</option>
                  <option value="200">200</option>
                  <option value="250">250</option>
                </select>
            </div>
          </div>
        </div>
        <!---//////////==================------->
        <Table :headers="headers" :addClass="addClass" id="exportMe">
          <tr><td class="text-sm font-bold" colspan="2"><input class="mr-2" type="checkbox" v-model="allSelected" @click="checkAll">CheckAll</td></tr>
            <tr class="hover:bg-gray-300 align-midle" v-for="(bill,i) in billtests.data" :key="i">
              <td><input type="checkbox" :value="bill.id" v-model="checkSelect"></td>
              <td class="border-r-2 text-center">{{i +1}}</td>
              <td class="border-r-2 text-center font-bold">
                  {{bill.thinprep_code}}
                </td>
                <td class="border-r-2 text-center font-bold">
                    {{bill.hpv_code}}
                </td>
              <td class="border-r-2 text-midle">{{bill.custommer.name}}</td>
              <td class="border-r-2">
                <span v-if="bill.custommer.gender==0">Nữ</span>
                <span v-else>Nam</span>
                </td>
              <td class="border-r-2">{{bill.custommer.birthday}}</td>
              <td class="border-r-2 text-center">
                <span v-if="bill.custommer">{{bill.custommer.address}}, </span>
                <span v-if="bill.custommer.ward">{{bill.custommer.ward.name}}, </span>
                <span v-if="bill.custommer.district">{{bill.custommer.district.name}}, </span>
                <span v-if="bill.custommer.province">{{bill.custommer.province.title}}. {{bill.custommer.province.name}}</span>
              </td>
              <td class="border-r-2 text-center" v-if="bill.phone!==null">{{bill.custommer.phone}}</td>
              <td class="border-r-2 text-center" v-else></td>
              <td class="border-r-2 text-center" >
                <span class="text-green-800 font-bold" v-for="(tn,i) in bill.testnames" :key="i">
                  {{tn.name}},
                </span>
                </td>
              <td class="border-r-2" ><span >{{bill.doctor_indi}}</span></td>
              <td class="border-r-2 text-center uppercase" >
                    {{bill.ousent.name}}
              </td>
              <td class="border-r-2 text-center" >
                <span class="text-center">
                  {{formatDate(bill.date_receive)}}
                </span>
              </td>
              <td class="border-r-2" >
                <span v-for="(rs,i) in bill.results" :key="i">
                  <span v-if="rs.element_id ==26" class="text-red-600">
                      {{rs.result}},
                  </span>
                </span>
              </td>
              <td class="border-r-2" v-if="bill.usercreate">{{bill.usercreate.name}}</td>
              <td class="border-r-2" v-else>--</td>
              <td class="border-r-2" v-if="bill.userupdate">{{bill.userupdate.name}}</td>
              <td class="border-r-2" v-else>--</td>
              <td class="border-r-2 w-32">
                <div class="flex items-center justify-end space-x-3">
                  <EditBtn
                    title="Edit"
                    class="text-blue-800"
                    @click="editCustommer(bill)"
                    >
                    <PencilIcon class="w-6 h-6"/>
                  </EditBtn>
                  <DeleteBtn
                    :url="route('custommers.destroy', bill.id )"
                    class="p-0 cursor-pointer text-red-700"
                    module-name="el"
                  />
                </div>
              </td>
            </tr>
        </Table>
        <div class="mt-4">
          <div class="flex">
              <Pagination :links="billtests.links"/>
          </div>
        </div>
        <DialogModal :show="showModal"  class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
          <template v-slot:title >
            <div class="flex justify-between text-bold text-xl">
            <div>
              <span>
                <label v-for="veggie in veggies" :key="veggie.id" class="text-lg">
                        {{veggie.name}}
                </label>
              </span>
            </div>
            <h3 v-show="!editMode">Add Bệnh Nhân </h3>
            <h3 v-show="editMode">Chỉnh sửa thông tin Bệnh nhân</h3>
            <button  @click.prevent="closeModal" class="text-white text-lg bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
            </div>
          </template>
          <template v-slot:content>
            <div class="px-1 pb-0 scrollable" :ref="'aKeyValue'" >
              <form
                @submit="checkForm"
                @submit.prevent="saveCustommer(form)"
                class="py-0 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
              >
                <div class="">
                  <!----Info Custommer @submit.prevent="saveCustommer(form)">================================================----->
                  <div class="bg-gray-100 p-2 border-solid border-2 border-blue-500 rounded-md">
                    <div class="w-full flex flex-row place-content-between">
                      <span class="text-gray-400 underline">Info Custommer</span>
                      <span v-show="editMode"  class="text-white  bg-blue-600 px-2 py-0 rounded-md cursor-pointer" @click="updateCustommer(form)">Update</span>
                    </div>
                    <div class="ml-4 grid grid-cols-4">
                        <div  class=" col-span-3 mr-2 h-8">
                            <div class="grid grid-cols-4">
                                <div class="col-span-1 pr-2 h-8">
                                  <!-- <jet-label for="name" class="text-right pr-1 text-bold text-lg text-blue-800 w-full" value="Tên bệnh nhân (name):" /> -->
                                  <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 h-6 leading-3">Tên bệnh nhân <span class=" h-8 m-0 font-normal text-base font-italic text-gray-400">(name)</span></div>
                                </div>
                            <div class="col-span-3">
                              <jet-input
                              required
                                id="name"
                                type="text"
                                class="mt-1 block w-full h-8"
                                v-model="form.name"
                                autocomplete="name"/>
                            </div>

                            </div>
                        </div>
                        <div class="">
                          <div class="grid grid-cols-4">
                              <div class="col-span-2 text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3"> Giới tính <span class="m-0 font-normal text-base font-italic text-gray-400">(gender)</span></div>
                            <div class=" border-gray-300 rounded-md h-8 px-1 col-span-2 leading-4">
                              <input :checked="true" type="radio" id="female" value="0" v-model="form.gender">
                              <label for="one" class="ml-2">Nữ</label>
                              <br>
                              <input type="radio" id="man" value="1" v-model="form.gender">
                              <label for="two" class="ml-2">Nam</label>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="mt-2 ml-4 grid grid-cols-4">
                      <div  class="col-span-2 mr-2">
                          <div class="grid grid-cols-4">
                              <div class="">
                                  <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Năm sinh <span class="m-0 font-normal text-base font-italic text-gray-400">(Birthday )</span></div>
                              </div>
                          <div class="col-span-3">
                              <jet-input
                              validation="bail|required|number|between:1,2,value"
                              id="birthday"
                              type="text"
                              class="mt-1 block w-full h-8"
                              v-model="form.birthday"
                              autocomplete="birthday"
                            />
                          </div>
                          </div>
                      </div>
                      <div  class="col-span-2 mr-2">
                        <div class="grid grid-cols-4">
                          <div class="">
                              <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Điện thoại <span class="m-0 font-normal text-base font-italic text-gray-400">(Phone )</span></div>
                          </div>
                          <div class="col-span-3">
                              <jet-input
                              id="phone"
                              type="text"
                              class="mt-1 block w-full h-8"
                              v-model="form.phone"
                              autocomplete="birthday"
                            />
                          </div>
                        </div>
                      </div>
                      </div>
                        <!---Address ====================================---->
                    <div class="flex mb-1">
                        <div class="text-right pr-1 text-bold text-lg text-blue-800 m-0 leading-3">Địa chỉ <span class="m-0 font-normal text-base font-italic text-gray-400">(Address)</span></div>
                        <div class="flex-1">
                            <jet-input
                            required
                            id="address"
                            type="text"
                            class="mt-1 block w-full h-8"
                            v-model="form.address"
                            autocomplete="address"
                          />
                        </div>
                    </div>
                    <div class="flex justify-between">
                       <div class="flex flex-col flex-1">
                          <div class=" text-bold text-lg text-blue-800 w-full m-0 leading-3">Tỉnh/thành <span class="m-0 font-normal text-base font-italic text-gray-400">(Province)</span></div>
                          <div class="flex-1">
                            <select
                              @change="provinceHandle(form.province_id)"
                              ref="provinceOut"
                              id="Province"
                              class="block w-full form-input rounded-lg h-8 py-1"
                              v-model="form.province_id">
                                <option value="">--</option>
                              <option v-for="(pce, i) in provinces" :key="i" :value="pce.code">{{pce.name}}</option>
                            </select>
                          </div>
                      </div>
                      <div class="flex flex-col mx-2 flex-1">
                          <div class=" pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Quận/Huyện <span class="m-0 font-normal text-base font-italic text-gray-400">(District)</span></div>
                          <div class="flex-1">
                            <select
                              @change="districtHandle(form.district_id)"
                              name="district"
                              id="district"
                              class="block w-full form-input rounded-lg h-8 py-1"
                              v-model="form.district_id">
                              <option value="">--</option>
                              <option v-for="(dst, i) in getdistricts" :key="i" :value="dst.code">{{dst.name}}</option>
                            </select>
                          </div>
                      </div>
                      <div class="flex flex-col flex-1">
                          <div class=" pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Phường/Xã <span class="m-0 font-normal text-base font-italic text-gray-400">(Ward)</span></div>
                          <div class="col-span-3">
                            <select
                              name="ward"
                              id="ward"
                              class="block w-full form-input rounded-lg h-8 py-1"
                              v-model="form.ward_id">
                              <option value="12">--</option>
                              <option v-for="(wd, i) in getwards" :key="i" :value="wd.code">{{wd.name}})</option>
                            </select>
                          </div>
                      </div>
                    </div>
                          <!---/Address ====================================---->
                  </div>
                  <!----/Info Custommer======================== grid========================----->
                  <!----Info Indication OU================================================----->
                  <div class="mt-0 bg-gray-200 p-2 border-solid border-2 border-blue-500 rounded-md">
                      <div class="w-full flex flex-row place-content-between">
                        <span class="text-gray-400 underline">Thông tin ĐV gửi:</span>
                        <span v-show="editMode"  class="text-white  bg-blue-600 px-2 py-0 rounded-md cursor-pointer" @click.prevent="updateBill(form)">Update</span>
                      </div>
                      <div class="flex justify-between ">
                        <div class="flex flex-row flex-1">
                          <div class="py-0 text-center pr-1 text-bold text-lg text-blue-800 m-0 leading-3">Đơn vị gửi mẫu: <span class="m-0 p-0 font-normal text-xs font-italic text-gray-400"></span></div>
                          <jet-input
                            id="ousent"
                            type="text"
                            class=" h-8 flex-1"
                            v-model="form.ousent"
                            autocomplete="ousent"
                          />
                        </div>
                        <div class="flex flex-1 flex-row ml-2">
                          <div class="py-0 text-center pr-1 text-bold text-lg text-blue-800 m-0 leading-3">Bác sỹ chỉ định: <span class="m-0 p-0 font-normal text-base font-italic text-gray-400"></span></div>
                          <jet-input
                            id="doctor_indi"
                            type="text"
                            class="flex-1 h-8"
                            v-model="form.doctor_indi"
                            autocomplete="doctor_indi"
                          />
                        </div>
                      </div>
                      <div class="flex justify-between mt-2">
                        <div class="flex items-center">
                          <Checkbox class="w-4 h-4" :checked="intra" v-model="form.intra"/>
                          <div class="pl-1 text-bold text-lg text-blue-800 m-0 leading-3">IUD: <span class="m-0 font-normal text-xs font-italic text-gray-400">(Intra-Uterind Divices)</span></div>
                        </div>
                        <div class="flex items-center">
                          <Checkbox class="w-4 h-4" :checked="hormone"  v-model="form.hormone"/>
                          <div class="pl-1 text-bold text-lg text-blue-800  m-0 leading-3">Nội tiết: <span class="m-0 font-normal text-base font-italic text-gray-400">(Hormone)</span></div>
                        </div>
                        <div class="flex items-center">
                          <Checkbox class="w-4 h-4" :checked="radiation"  v-model="form.radiation"/>
                          <div class="pl-1 text-bold text-lg text-blue-800  m-0 leading-3">Xạ: <span class="m-0 font-normal text-base font-italic text-gray-400">(Radiation)</span></div>
                        </div>
                        <div class="flex items-center">
                          <Checkbox class="w-4 h-4" :checked="preg" v-model="form.preg"/>
                          <div class="pl-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Có thai: <span class="m-0 font-normal text-base font-italic text-gray-400">(Pregnancy)</span></div>
                        </div>
                      </div>
                      <div class="flex justify-between items-center mt-2">
                        <div class="flex flex-1 items-center">
                          <div class="text-bold text-lg text-blue-800 m-0 leading-3 ">Chỉ định XN: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                          <div class="flex-1">
                            <Multiselect
                              max=1
                              required
                              class="rounded-sm py-0 h-4"
                              v-model="form.testname_id"
                              v-bind="example4"
                            >
                            </Multiselect>
                          </div>
                        </div>
                        <div class="flex justify-between flex-1 items-center">
                          <div class="pl-2 text-bold text-lg text-blue-800 m-0 leading-3">Chẩn đoán: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                          <jet-input
                            id="diagonose"
                            type="text"
                            class="flex-1 h-10"
                            v-model="form.diagnose"
                            autocomplete="diagonose"
                          />
                        </div>
                      </div>
                      <div class="flex justify-between items-center mt-2">
                        <div class="flex flex-row">
                          <div class="text-bold text-lg text-blue-800 m-0 leading-3">Para: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                          <jet-input
                          id="para"
                          type="text"
                          class="h-8"
                          v-model="form.para"
                          autocomplete="para"
                          />
                        </div>
                        <div class="flex flex-row">
                          <div class="text-right pr-1 text-bold text-lg text-blue-800 m-0 leading-3">Kinhcuoi: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                          <jet-input
                          id="king"
                          type="text"
                          class="h-8"
                          v-model="form.kinhchot"
                          autocomplete="king"
                          />
                        </div>
                      </div>
                      <div class="ml-2 flex flex-row">
                            <div class="mt-2 w-1/2">
                              <div class="flex flex-row">
                              <jet-label for="sample_id" class="self-center text-right pr-1 text-bold text-lg text-blue-800 w-48 leading-3" value="Mã XN ĐV gửi:" />
                              <jet-input
                                id="sample_code"
                                type="text"
                                class="mt-1 block w-full h-8"
                                v-model="form.sample_code"
                                autocomplete="sample_code"
                              />
                              </div>
                          </div>
                        <div class="w-1/2">
                            <div class="mt-2">
                              <div class="flex flex-row">
                              <jet-label for="date_sent" class="self-center text-right pr-1 text-bold text-lg text-blue-800 w-48" value="Ngày lấy mẫu:" />
                              <jet-input
                                id="date_sent"
                                type="datetime-local"
                                class="mt-1 block w-3/4"
                                v-model="form.date_sent"
                                autocomplete="date_sent"
                              />
                              </div>
                        </div>
                        </div>
                      </div>
              <!----/Info Indication OU   @change="getfileReadCode"================================================----->
              <!----Info Goldgate================================================----->
                      <div class="grid grid-cols-8 border-2 border-blue-500 rounded-md">
                        <div class=" col-span-5 border-r border-blue-500 ">
                          <div class="grid grid-cols-6 mb-2 mt-2 px-2">
                            <div class="col-span-2 text-blue-600 font-bold">Mã chính: </div>
                              <div class="col-span-4 h-8">
                                <select
                                  id="Province"
                                  class="block w-full form-input rounded-lg h-8 py-1"
                                  v-model="form.chooseReadCode"
                                  @change="getfileReadCode(form.chooseReadCode)"
                                  >
                                  <option v-for="(rd, i) in getParenReadCode" :key="i" :value="rd.read_code">
                                    <span>{{rd.name}} - ({{rd.read_code}})</span>
                                  </option>
                                </select>
                              </div>
                          </div>
                          <div class="flex">
                            <span class="w-48 pl-2 text-blue-500 font-semibold">Mã phụ: </span>
                            <div class=" flex-1">
                              <template v-for="(rc,i) in readcodeSub" :key="i">
                                <input class="ml-2" type="radio" :value="rc.sub_read_code" v-model="form.sub_read_code" />
                                <label>{{rc.sub_read_code}}</label>
                              </template>
                            </div>
                          </div>
                        </div>
                        <div class="col-span-3">
                            <div class="flex flex-row mx-2 items-center">
                                <label class="w-48 text-blue-800 font-bold text-right mr-2">Mã Thin:</label>
                                <div>
                                <input class=" h-10" v-if="editMode" v-model="selectThin[1]"/>
                                 <jet-input v-else
                                  id="thinprep_code"
                                  type="text"
                                  class="mt-1 h-10 flex-1"
                                  v-model="selectThin[0]"
                                  autocomplete="thinprep_code"
                                />
                                </div>
                              </div>
                                <jet-input-error :message="errors.thinprep_code" class=" text-md" />
                            <div class="flex mt-1 px-2 items-center">{{hpv_code_edit}}
                              <label class="w-48 text-blue-800 font-bold text-right mr-2">Mã HPV:</label>
                                <div v-if="editMode">
                                  <div v-if="form.hpv_code">
                                    <input class=" h-10"  v-model="form.hpv_code"/>
                                  </div>
                                  <div v-else>
                                    <input class=" h-10"  v-model="hpv_code"/>
                                  </div>
                                </div>
                                <div v-else>
                                  <jet-input
                                    id="hpv_code"
                                    type="text"
                                    class="h-10 flex-1"
                                    v-model="selectHpvCode"
                                    autocomplete="hpv_code"/>
                                </div>
                            </div>
                                <jet-input-error :message="errors.hpv_code" class="ml-4 text-lg text-center" />
                        </div>
                      </div>
                      <div class=" flex flex-row">
                            <div class=" w-1/2">
                            <div class="mt-2">
                              <div class="flex flex-row">
                              <jet-label for="date_receive" class="text-center pr-1 text-bold text-lg text-blue-800 w-48" value="Ngày nhận mẫu:" />
                              <jet-input
                                id="date_receive"
                                type="datetime-local"
                                class="mt-1 h-10 w-full"
                                v-model="form.date_receive"
                                autocomplete="date_receive"/>
                              </div>
                            </div>
                          </div>
                            <div class="mt-2 w-1/2">
                                <div class="flex flex-row">
                              <jet-label for="note" class="text-center pr-1 text-bold text-lg text-blue-800 w-48" value="Ghi chú(note):" />
                              <jet-input
                                id="note"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.note"
                                autocomplete="note"/>
                              </div>
                          </div>
                      </div>
                      <div class="px-2 flex justify-between mt-2 border-t border-gray-700 py-2">
                    <!-- Print code Edit====================================================================================================-->
                          <div v-if="editMode" class="flex">
                            <div class="flex border-l border-blue-600 px-2">
                              <div class=" flex" id="print_hpv">
                                <div class="flex flex-col  print_hpv_class mr-2">
                                    <span class="text-center name_class text-xs">{{form.name}} - {{form.birthday}}</span>
                                      <p class="">
                                          <vue-barcode class="w-24 h-8 badcode_class" :value="selectHpvCode?selectHpvCode:0" :options="{ displayValue: false }"></vue-barcode>
                                      </p>
                                    <span class="text-center code_class text-xs">{{form.hpv_code}}</span>
                                </div>
                              </div>
                              <span type="button" class="ml-2 bg-blue-500 px-2 py-1 rounded-md text-white h-8" @click="printHpv">Print Hpv</span>
                            </div>
                            <div class="flex border-l border-r border-blue-600 px-2">
                              <div class="flex flex-col  print_thin_class" id="printThin_code" >
                                <span class="text-center name_class text-xs">{{form.name}} - {{form.birthday}}</span>
                                  <p class="">

                                      <vue-barcode class="w-24 h-8 badcode_class" :value="selectThin?selectThin:22000001" :options="{ displayValue: false }"></vue-barcode>
                                  </p>
                                  <span class="text-center code_class text-xs">{{form.thinprep_code}}</span>
                              </div>
                              <span type="button" class="ml-2 bg-blue-500 px-2 py-1 rounded-md text-white h-8" @click="printThin"> Print Thin</span>
                            </div>
                          </div>

                    <!-- Print code Add====================================================================================================-->
                          <div v-else class="flex">
                            <div class="flex border-l border-r border-blue-600 px-2">
                                <div class=" flex print_parent" id="print_hpv">
                                <div class="flex flex-col  print_class mr-2" >
                                    <span class="text-center name_class text-xs font-bold">{{getName}} - {{form.birthday}}</span>
                                      <span class="">
                                        <vue-barcode class="w-24 h-8 badcode_class" :value="selectHpvCode?selectHpvCode:0" :options="{ displayValue: false }"></vue-barcode>
                                      </span>
                                    <span class="text-center code_class text-xs font-bold">{{selectHpvCode}}</span>
                                </div>
                          <!--Thin code==============================================================-->
                                  <div class="flex flex-col  print_class mr-2">
                                    <span class="text-center name_class text-xs font-bold">{{getName}} - {{form.birthday}}</span>
                                        <span class="">
                                          <vue-barcode class="w-24 h-8 badcode_class" :value="selectThin111?selectThin111:22000001" :options="{ displayValue: false }"></vue-barcode>
                                        </span>
                                    <span class="text-center code_class text-xs font-bold">{{selectThin111}}</span>
                                  </div>
                                  <!-- <div v-else></div> -->
                              </div>
                              <span type="button" class="ml-2 bg-blue-500 px-2 py-1 rounded-md text-white h-8" @click="printThin()"> Print code</span>
                          </div>
                          </div>
                          <!--Kích thước tem 1.5cm x 4cm--->
                          <!--/Print Thin 2cm x 2cm--->
                          <!--Print Hpv 2x3.8cm--->
                            <div class="flex flex-col  border-l border-blue-800">
                              <span class=" text-bold text-lg text-blue-800">Ẩn tên ký KQ</span>
                              <input type="checkbox" class="w-4 h-4 m-auto" :checked="asignView" v-model="form.asign_view"/>
                            </div>
                      </div>
                  </div>
                <!----Info Indication================================================----->
                </div>
                <div class="mt-1 text-center mb-1" >
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto justify-between">
                      <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-red-600 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Save
                      </button>
                      <span>
                        <label v-for="veggie in veggies" :key="veggie.id">
                              {{veggie.name}}
                        </label>
                        </span>
                        <span>
                          <label v-for="veggie in veggies" :key="veggie.id">
                              {{veggie.name}}
                          </label>
                        </span>
                      </span>

                </div>
              </form>
            </div>
          </template>
        </DialogModal>
      </Card>
    </Container>
  </app-layout>
</template>
<script>
//import { ref, watchEffect } from 'vue'
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import Table from "@/Components/Table";
import Pagination from "@/Components/Pagination";

import AppImageView from "@/Components/ImageView";
import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import Modal from "@/Components/Modal";
import DialogModal from "@/Components/DialogModal";
import Button from "@/Jetstream/Button";
import Multiselect from "@vueform/multiselect";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import AppImage from "@/Components/Image";
import { Link } from "@inertiajs/inertia-vue3";
import Checkbox from "@/Jetstream/Checkbox";
import JetInputError from "@/Jetstream/InputError";

import PrintviewTudu from "@/Pages/Prinview/FormTudu";
import PrintviewSaigon from "@/Pages/Prinview/FormSaigon";
import PrintviewVigor from "@/Pages/Prinview/FormVigor";
import PrintviewGenaral from "@/Pages/Prinview/FormGenaral";
import PrintHPV from "@/Pages/Prinview/FormHPV";

import { BeakerIcon } from "@heroicons/vue/solid";
import { PencilIcon } from "@heroicons/vue/solid";
import { CheckIcon } from "@heroicons/vue/solid";
import { XCircleIcon } from "@heroicons/vue/solid";
import { PrinterIcon } from "@heroicons/vue/solid";

import { useForm } from "@inertiajs/inertia-vue3";
import moment from "moment";
import VueBarcode from '@chenfengyuan/vue-barcode';
import  VueHtmlToPaper from '@/Components/VueHtmlToPaper'
import Label from '../../Jetstream/Label.vue';
 import axios from 'axios';
 import {ref,watch} from "vue";

export default defineComponent({
  name: "Danh sách nhập thông tin",
  props: {
    billtests: "",
    nametests: "",
    testElements: "",
    provinces: "",
    districts: "",
    wards: "",
    ousents: "",
    doctors: "",
    readcodes: "",
    custommer: "",
    filters: {},
    errors: "",
    hpv_code_last: "",
    thin_code_last: "",

  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    Pagination,
    EditBtn,
    DeleteBtn,
    JetButton,
    AppImage,
    Modal,
    DialogModal,
    Button,
    Multiselect,
    JetLabel,
    JetInput,
    AppImageView,
    Link,
    Checkbox,
    PrintviewTudu,
    PrintviewSaigon,
    PrintviewVigor,
    PrintviewGenaral,
    PencilIcon,
    CheckIcon,
    BeakerIcon,
    PrintHPV,
    JetInputError,
    XCircleIcon,
    VueBarcode,
    PrinterIcon,
    VueHtmlToPaper,
    Label
  },
  data() {
    return {
      selectThin111:'',
      getValueDistrict:'',
      readcodeSub:'',
      allSelected:'',
      name:'',
      birthday:'',
      hpv_code_print:'',
      showModalPrintCode:false,
      hpv_code:this.hpv_code_last,
      thinprep_code:'',
      code_repeat_thin:'',
      code_repeat:'',
      checkErrors: this.errors,
      errorsView: false,
      perPage: this.filters.perPage,
      nametestFill: this.filters.nametestFill,
      ousentFill: this.filters.ousentFill,
      readcodeFill: this.filters.readcodeFill,
      startDate: this.filters.startDate,
      endDate: this.filters.endDate,
      intra: false,
      hormone: false,
      radiation: false,
      preg: false,
      asignView: false,
      termSearch: "",
      checkSelect: [],
      url: null,

      ousentFill: this.filters.ousentFill,
      getOusents: this.ousents,
      nametestFill: this.nametestFill,
      getdistricts: "",
      getwards: "",
      getdoctors: this.doctors,

      perPage: "",
      checkededit: "",
      userEdit: "",
      showModal: "",
      showModlPrint: false,
      showModlPrintMulti: false,
      editMode: false,
      //titleModal:'Them user',
      maxWidth: "4xl",
      maxWidthPrint: "2xl",
      titleHeader: "Edit",
      example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options: this.nametests.data,
        searchable: true,
        createTag: true,
      },
      readcodeThin: {
        mode: "tags",
        value: "value",
        label: "name",
        options: this.readcodes,
        searchable: true,
        createTag: true,
      },
      veggies: [
        { id: 1, name: "🍠", selected: true,oucode:'SG' },
        { id: 2, name: "🥦", selected: false ,oucode:'GM'},
        { id: 3, name: "🌶", selected: false ,oucode:'MK'},
        { id: 4, name: "🌽", selected: true , oucode:'EU'}
      ]
    };
  },
  setup() {
    //this.form.hpv_code = this.hpv_code;
    const form = useForm({
      file: null,
      gender: 0,
      date_receive: "",
      testname_id: [],
      asignView: false,
      intra: false,

    });
    const test_hehe='';

    return { form, test_hehe};
  },
  watch: { },
  computed: {
    getParenReadCode(){
      return this.readcodes.filter(e=>e.id_parent==null);
    },
    getName(){
      var result;
      if(this.form.name){
        let anArray = this.form.name.split(/<[/\w\s-]+>|\s/g);
        result = anArray.pop();
      }
      else result ='';

      return result ;
    },
    selectThin() {

      return [this.selectThin=this.thin_code_last,this.selectThin_edit=this.thin_code_last];
      },

    selectHpvCode() {
      //alert(123);
      return this.hpv_code=this.hpv_code_last;
        },

    errorsGet() {
      return this.errors;
    },
    breadcrumbs() {
      return [
        {
          label: "Danh sách nhập thông tin(Mặc định hiển thị ngày hôm nay và hôm qua",
          class: "text-white",
        },
      ];
    },

    headers() {
      return [
        { name: "Check", class: "w-12 text-center" },
        { name: "#", class: "w-12 text-center" },
        { name: "Mã Thinprep", class: "border-l-2 text-center font-normal" },
        { name: "Mã HPV", class: "border-l-2 text-center font-normal" },
        {
          name: "Tên khách hàng",
          class: "border-l-2 text-center w-52 px-2 font-normal",
        },
        {
          name: "Giới tính",
          class: "border-l-2 text-center w-8 px-2 font-normal",
        },
        { name: "Năm sinh", class: "border-l-2 text-center px-0 font-normal" },
        { name: "Địa chỉ", class: "border-l-2 text-center font-normal" },
        {
          name: "Điện thoại",
          class: "border-l-2 text-center px-1 font-normal",
        },
        { name: "Tên xét nghiệm", class: "border-l-2 text-center font-normal" },

        {
          name: "Bác sỹ chỉ định",
          class: "border-l-2 text-center font-normal",
        },
        { name: "Đơn vị gửi mẫu", class: "border-l-2 text-center font-thin" },
        {
          name: "Ngày nhận mẫu mẫu",
          class: "border-l-2 text-center font-thin",
        },

        { name: "Kết quả", class: "border-l-2 text-center font-normal" },
        { name: "User create", class: "border-l-2 text-center font-normal" },
        { name: "User update", class: "border-l-2 text-center font-normal" },
        { name: "Action", class: "text-right border-l-2 font-normal" },
      ];
    },
    addClass() {
      return "bg-blue-200 text-indigo-700";
    },
    bgSave() {
      return "bg-red-900 text-white";
    },
    bgEdit() {
      return "bg-green-600 text-white";
    },

  },
  mounted() {
  },
  methods: {
    provinceHandle(province_id){
       const fillData = this.districts.filter(function (el) {
        return el.province_id == province_id;
      });
      this.getdistricts = fillData;
    },
    districtHandle(district_id){
       const fillWards = this.wards.filter(function (el) {
        return el.district_id == district_id;
      });
      this.getwards = fillWards;
    },
    async checkAll() {
      if (!this.allSelected) {
        const selected = this.billtests.data.map((u) => u.id);
        this.checkSelect = selected;
      } else {
        this.checkSelect = [];
      }
    },
    printCode(){
      window.print();
    },
    closeModalPrint(){
      this.showModalPrintCode = false;
    },
    saveCustommer(data) {
      var hpv;
      var thin;
      if(data.testname_id !=1){
        hpv = this.hpv_code
      }
      else{
        hpv = null;
      }
      if(data.testname_id !=2 || data.testname_id !=3){
        thin = this.selectThin[0]
      }
      else{
        thin = null;
      }

      const data2 ={
        'hpv_code': hpv,
        'thinprep_code': thin,
      }
      const dataEdit = {...data,...data2}
      try {
        this.$inertia.post(route("inputinfo.store"), dataEdit);
        // setTimeout(() =>{
        //     this.$inertia.get(route("inputinfo.index"));
        //   },4000)


      } catch (error) {
        //console.log("Errors_ hehehehehehehe= ")
      }
//
    },
    reset() {
      // this.thinprep_code=null;
      // this.hpv_code = this.hpv_code_last;
      // this.chooseReadCode = null;
      this.intra= false;
      this.hormone= false;
      this.radiation= false;
      this.preg=false;
      this.asignView = null;

      this.form = {
        sub_read_code:false,
        asign_view: false,
        name: null,
        birthday: null,
        date_receive: "",
        doctor_indi: null,
        kinhchot: null,
        phone: "",
        gender: "",
        address: "",
        province_id: null,
        district_id:null,
        ward_id:null,
        testname_id: [],
        selected: "",
        diagnose: "",
      };
     // this.$inertia.get(route("inputinfo.index"));
    },
    getfileReadCode(data) {
      var readCode = this.readcodes.filter(x=>x.read_code==data);
     // alert(JSON.stringify(readCode));
       var fillReadcodeSub = readCode.filter(y=>y.id_parent!=null)

      this.$inertia.get("/dashboard/inputinfo?",
        {
          //search:this.search,
          chooseReadCode: this.form.chooseReadCode,
        },
        {
          preserveState: true,
          replace: false,
        }
      );
      setTimeout(()=>{
          return this.readcodeSub = fillReadcodeSub;
      },1000)

    },
    closeError(){
      this.refreshFill();
    },
    checkForm: function (e) {
      console.log(e);
      if (this.form.hpv_code) {
        return true;
      }

      this.checkErrors = [];

      if (!this.form.hpv_code) {
        this.checkErrors.push("Trùng Hpv");
      }

      e.preventDefault();
    },
    deleteMulte(checkDelete) {
      this.$inertia.post(route("multidelete", checkDelete));
    },
    formatDate(value) {
      if (value) {
        return moment(String(value)).format("DD/MM/YYYY hh:mm");
      }
    },
    search() {
      // this.$inertia.replace(this.$route('inputhpv.index',{term: this.termSearch}));

      this.$inertia.get(
        "/dashboard/inputinfo?",
        {
          //alert(ousentFill);
          term: this.termSearch,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    editCustommer(bill) {
      this.form = Object.assign({}, bill);
      //console.log(bilForm);
      this.intra = this.form.intra;
      this.hormone = this.form.hormone;
      this.radiation = this.form.radiation;
      this.preg = this.form.preg;
      this.form.name = this.form.custommer.name;
      this.form.ousent = this.form.ousent.name;
      this.form.gender = this.form.custommer.gender;
      this.form.birthday = this.form.custommer.birthday;
      this.form.address = this.form.custommer.address;
      this.form.phone = this.form.custommer.phone;
      this.form.para = this.form.para;
      this.form.kinhchot = this.form.kinhchot;

      this.selectThin[1]=this.form.thinprep_code?this.form.thinprep_code:this.selectThin[1];

      this.getDistrictFill(bill.custommer.province_id)
      this.getWardFill(bill.custommer.district_id);

      this.form.province_id = bill.custommer.province_id;
      this.form.district_id = bill.custommer.district_id;
      this.form.ward_id = bill.custommer.ward_id;

      var result = this.form.testnames.map(function (a) {
        return a.id;
      });
      this.form.chooseReadCode=this.form.read_code
      this.getValueDistrict=this.getValueDistrict
      this.form.testname_id = result;
      this.asignView =this.form.asign_view;
      this.editMode = true;
      this.showModal = true;
    },
    updateCustommer(bill) {
      bill._method = "PUT";
      this.$inertia.post("/dashboard/custommers/" + bill.id, bill);
      this.reset();
      this.closeModal();
    },
    updateBill(bill) {
      var hpv_code_update;
      var thin_code_update;
      if(bill.testname_id != 1){
        if(bill.hpv_code){
          hpv_code_update = bill.hpv_code
        }
        else{
          hpv_code_update = this.hpv_code
        }
      }
      if(bill.testname_id != 2||bill.testname_id != 3){
          thin_code_update = this.selectThin[1]
      }
      const dataupdate = {
        billtest_id: bill.id,
        //'ousent_id':bill.ousent_id,
        ousent: bill.ousent,
        doctor_indi: bill.doctor_indi,
        diagnose: bill.diagnose,
        hpv_code: hpv_code_update,
        thinprep_code: thin_code_update,
        sample_code: bill.sample_code,
        patient_code: bill.patient_code,
        date_receive: bill.date_receive,
        date_sent: bill.date_sent,
        read_code: bill.read_code,
        asign_view: bill.asign_view,
        para: bill.para,
        kinhchot: bill.kinhchot,
        intra: bill.intra,
        hormone: bill.hormone,
        radiation: bill.radiation,
        preg: bill.preg,
        note: bill.note,
        testname_id: bill.testname_id,
        userupdate_id: bill.userupdate_id,

      };
      dataupdate._method = "PUT";
      this.$inertia.post("/dashboard/inputinfo/" + bill.id, dataupdate);
      this.closeModal();
    },
    currentDate() {
      const current = new Date();
      const date =
        " " +
        `${current.getDate()}/${
          current.getMonth() + 1
        }/${current.getFullYear()}`;
      return date;
    },
    getDoctorFill(doctor) {
      const fillData = this.doctors.filter(function (el) {
        return el.ousent_id == doctor;
      });
      //console.log(fillData);
      this.getdoctors = fillData;
    },
     getDistrictFill(province) {
      // alert(province)
      const fillData = this.districts.filter(function (el) {
        return el.province_id == province;
      });
      this.getdistricts = fillData;
    },
    getWardFill(district) {
      const fillWards = this.wards.filter(function (el) {
        return el.district_id == district;
      });
      this.getwards = fillWards;
    },
    scrollToView(element) {
      var offset = element.offset().top;
      if (!element.is(":visible")) {
        element.css({ visibility: "hidden" }).show();
        var offset = element.offset().top;
        element.css({ visibility: "", display: "" });
      }

      var visible_area_start = $(window).scrollTop();
      var visible_area_end = visible_area_start + window.innerHeight;

      if (offset < visible_area_start || offset > visible_area_end) {
        // Not in view so scroll to it
        $("html,body").animate(
          { scrollTop: offset - window.innerHeight / 3 },
          1000
        );
        return false;
      }
      return true;
    },
    getelementSearch(data) {
      this.$inertia.get(
        "testelements?",
        {
          perPage: this.perPage,
          testName: this.testName,
          elementSearch: data,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    getPageFill() {
      this.$inertia.get(
        "inputinfo?",
        {
          //alert(ousentFill);
          perPage: this.perPage,
          nametestFill: this.nametestFill,
          ousentFill: this.ousentFill,
          readcodeFill: this.readcodeFill,
          startDate: this.startDate,
          endDate: this.endDate,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    getfilePerpage() {
      this.$inertia.get(
        "inputinfo?",
        {
          //search:this.search,
          perPage: this.perPage,
          ousentFill: this.ousentFill,
          readcodeFill: this.readcodeFill,
          nametestFill: this.nametestFill,
          startDate: this.startDate,
          endDate: this.endDate,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    refreshFill() {
      this.nametestFill = "";
      this.perPage = "";
      this.ousentFill = "";
      this.readcodeFill = "";
      this.$inertia.get(route("inputinfo.index"));
    },
    closeModal() {
      this.reset();
      this.showModal = false;
      this.editMode = false;
      //this.$inertia.get(route("inputinfo.index"));
    },
    openModal() {
      this.showModal = true;
    },
    addCustommer() {
      this.showModal = true;
    },
    submitFile() {
      if (this.$refs.photo) {
        this.form.file = this.$refs.photo.files[0];
      }

      //this.form.post('/dashboard/importcustommers/');
      this.form.post(route("importcustommers"));
      this.$refs.photo.value = null;
      this.form.file = "";

      this.errorsView = !this.errorsView;
    },
    previewImage(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    hideMessage(){
             this.$page.props.flash.success=""
             this.$page.props.flash.failure=""
    }
  },
  created() {
   this.getDistrictFill(1)
      this.getWardFill(1);

  }
});
</script>
<style media="print">
@media print {
  /* .noPrint :not(.printMe){
    display:none;
  }*/
   body{
    margin: 0px;
    padding: 0px;
    visibility: hidden;
   }

/*==========================================Print from Table list============================================*/
.frame_print{
  visibility: visible;
}
/*==========================================Print Class============================================*/

  @page{
    size: a4;
    margin: 0.5mm 0.5mm 0.5mm 0.5mm;
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';
    /* font-size: 20px; */
   }
      /* @page :top {
         margin-top: 0.5cm;
      }
     @page :left {
         margin-left: 0.5cm;

      }

      @page :right {

         margin-right: 0.5cm;
      } */
/*page-break-after: auto|always|avoid|left|right|initial|inherit;*/
.page-break {page-break-after: always !important; }

}

</style>


 <style src="@vueform/multiselect/themes/default.css"></style>


