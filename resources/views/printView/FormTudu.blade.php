<div class="container-fluid " style="padding:20px; margin-top:10px">
        <table class="table borderless " style="padding:20px 0px 20px 20px">
            <tbody>

                <tr  style="border:none !important" class="mt-4">
                    <td style="border:none !important" class="w-40 m-0 py-0"><img style="width:120px; height:80px" src="{{ public_path('/storage/Logo/Thinprep.jpg') }}"/> </td>
                    <td  style="border:none !important" class="col-1 py-0" colspan="4">
                        <div class="d-flex flex-column text-center uppercase py-0">
                            <div class="py-0 font-bold" style="font-size:18px;line-height:1">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                            <div class="py-0" style="line-height:1;font-size:14px">PAP'S SMEAR - ThinPrep®</div>
                            <div class="py-0" style="line-height:1; font-size:14px">REQUEST FOR COLLECTION OF SPECIMEN</div>
                        </div>
                    </td>
                    <td style="border:none !important" colspan="" class="w-40 py-0"><span>{{$value->thinprep_code}}</span></td>
                </tr>
                <tr style="border:none !important" >
                        <td style="border:none !important" class="py-1" colspan="3"><span>Họ và tên (Name): </span><span class="font-bold">{{$value->custommer->name}}</span></td>
                        <td style="border:none !important" class=" py-1">Tuổi:<span>{{$value->custommer->birthday}}</span></td>
                        <td style="border:none !important" colspan="py-1" class="py-0">Para:<span>{{$value->para}}</span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Địa chỉ (Address): </span><span class="font-bold">{{$value->custommer->address}}</span></td>
                    <td style="border:none !important" class=" py-0"><span></span></td>
                    <td style="border:none !important" colspan="2" class="py-0">Số điện thoại:<span>{{$value->custommer->phone}}</span></td>

                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Đơn vị gửi(Custommer): </span><span class="font-bold">{{$value->ousent->name}}</span></td>
                    <td style="border:none !important" class=" py-0"><span></span></td>
                    <td style="border:none !important" colspan="2" class="py-0"><span></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="2"><span>IUD (Intra-Uterine Devices) : </span><span class="font-bold">{{$value->ousent_id}}</span></td>
                    <td style="border:none !important" class=" py-0" colspan="">Nội tiết (Hormone)<span></span></td>
                    <td style="border:none !important" colspan="" class="py-0" colspan="2">Xạ (Radiation)<span></span></td>
                    <td style="border:none !important" colspan="2" class="py-0" colspan="2">Không đạt (Unsatisfactory)<span></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Kinh chót (Last Menstrual Period) : </span><span class="font-bold"></span></td>
                    <td style="border:none !important" colspan="3" class="py-0">Ngày gửi (Date sent):<span></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Chẩn đoán lâm sàng (Clinical diagnose) : </span><span class="font-bold"></span></td>
                    <td style="border:none !important" colspan="3" class="py-0">Bác sỹ chỉ định (Physician):<span class="font-bold">{{$value->doctor->name}}</span></td>
                </tr>
            </tbody>
        </table>
    <div class="text-center text-danger font-weight-thin mb-0 p-0" style="line-height:30%; font-size:16px">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
        <table class="table mt-0" style="padding:0px 0px 20px 20px">
            <tbody>
                <tr class="align-middle">
                    <td class="" colspan="5" style="border:none !important" ><span class="font-bold" >Đánh giá lam (Specimen evalueation):</span></td>
                        @foreach ($testElements as $key=>$elm )
                            @if ($elm->element_group ==1)
                                <td colspan="3" class="align-middle" style="border:none !important">
                                        <span class="align-middle m-0 p-0  ">{{$elm->name}}</span>
                                                @if ($elm->valueresult($value->id)!==null)
                                                 <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                       @else
                                        <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                        @endif
                                </td>
                            @endif
                        @endforeach
                </tr>
                <tr class="py-0 bordered  align-middle">

                    @foreach ($testElements as $key=>$elm2 )
                        @if ($elm2->element_group ==2)
                            <td colspan="5" class="py-0 my-0 align-middle" style="border:none !important">
                                   <div class="p-0 m-0 align-middle">
                                   <span class="align-middle m-0 p-0 font-bold">- {{$elm2->name}}</span>

                                      @if ($elm2->valueresult($value->id)!==null)
                                                 <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                       @else
                                        <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                        @endif
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
                <tr class="py-0 bordered align-middle">
                     @foreach ($testElements as $key=>$elm3 )
                        @if ($elm3->element_group == 3)
                            <td colspan="2" width="" class="py-0 my-0 align-middle " style="border:none !important">
                                   <div class="p-0 m-0 align-middle">
                                   <span class="align-middle m-0 p-0" style="font-size:9px">- {{$elm3->name}}</span>

                                      @if ($elm3->valueresult($value->id)!==null)
                                           <span class=" py-0 px-1 align-middle text-white content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                       @else
                                        <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                        @endif
                                </div>
                            </td>
                        @endif

                    @endforeach
                </tr>
                <tr class="py-0 bordered align-middle">
                    @foreach ($testElements as $key=>$elm4 )
                        @if ($elm4->element_group == 4)
                            <td colspan="10" width="" class="py-0 my-0 align-middle " style="border:none !important">
                                   <div class="p-0 m-0 align-middle">
                                   <span class="align-middle m-0 p-0 font-bold" style="font-size:9px">- {{$elm4->name}}</span>
                                   @if ($elm4->valueresult($value->id)=='on')
                                           <span class=" py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                       @else
                                        <span class=" py-0 px-1 align-middle text-white content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                        @endif
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>

                <tr class="m-0"><td class="uppercase font-bold p-0 m-0" style="border:none !important" colspan="10">Tế bào gai<span class="font-normal m-0">(Squamous cell)</span></td></td>
                <tr class="py-0 -mt-2 bordered align-middle">
                    <td colspan="5"  style="border:none !important" class="-p-2 pl-2">
                         @foreach ($testElements as $key=>$elm5 )
                                @if ($elm5->element_group == 5)
                                        <div class="p-0 m-0 align-middle"  style="font-size:9px; line-height:1.6">
                                        <span class="align-middle m-0 p-0 font-bold" style="font-size:9px;" >- {{$elm5->name}}</span>
                                            @if($value->results->count())
                                                @foreach ($value->results as $k)
                                                    @if($k->element_id == $elm5->id)
                                                        <span class="w-3 h-3 py-0 px-1 align-middle content-middle font-bold m-0" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                                    @endif
                                                @endforeach

                                        @endif
                                        </div>
                                @endif
                         @endforeach
                    </td>
                    <td colspan="5" class="p-2 -0"  style="border:none !important">@foreach ($testElements as $key=>$elm6 )
                        @if ($elm6->element_group == 6)
                                   <div class="p-0 m-0 align-middle" style="font-size:9px; line-height:1.6">
                                   <span class="align-middle m-0 p-0 font-bold" style="font-size:9px">- {{$elm6->name}}</span>
                                         @if($value->results->count())
                                                @foreach ($value->results as $k)
                                                    @if($k->element_id == $elm6->id)
                                                        <span class="w-3 h-3 py-0 px-1 align-middle content-middle font-bold m-0" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                                    @endif
                                                @endforeach
                                        @endif
                                </div>
                        @endif
                    @endforeach
                    </td>
                </tr>
               <tr class=" mt-2"><td class="uppercase font-bold p-0 m-0" style="border:none !important" colspan="10">Tế bào tuyến<span class="font-normal m-0"></span></td></tr>
                  <tr class="mt-4" style="border:none !important">
                          @foreach ($testElements as $key=>$elm7 )
                                @if ($elm7->element_group == 7)
                                        <td colspan="4"  style="border:none !important" class=" p-0 pl-1">
                                        <div class="p-0 m-0 align-middle  mr-4">
                                        <span class="align-middle m-0 p-0 font-bold pl-2" style="font-size:9px"> {{$elm7->name}}</span>
                                             @foreach ($value->results as $k)
                                                @if($k->element_id == $elm7->id)
                                                        <span class="w-3 h-3 py-0 px-1 align-middle content-middle font-bold m-0" style=" border:1px solid black;font-size:10px;border-radius:1px;line-height:50%">v</span>
                                                    @if($k->element_id !== $elm7->id)
                                                        @break
                                                    @endif
                                                @endif
                                                @if($k->element_id !== $elm7->id)
                                                    <span class="w-3 h-3 py-0 px-1 align-middle content-middle text-white font-bold  m-0" style="border:1px solid black;font-size:8px;border-radius:1px; color:white; line-height:50%">v</span>
                                                    @if($k->element_id !== $elm7->id)
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                </td>
                                @endif
                        @endforeach
                </tr>
               <tr class=" mt-2"><td class="uppercase font-bold p-0 m-0" style="border:none !important" colspan="10">Đề nghị<span class="font-normal m-0">(Suggestions)</span></td></tr>
                  <tr class="mt-4" style="border:none !important">
                          @foreach ($testElements as $key=>$elm8 )
                                @if ($elm8->element_group == 8)
                                        <td colspan="2"  style="border:none !important" class=" p-0 pl-1">
                                        <div class="p-0 m-0 align-middle  mr-4">
                                        <span class="align-middle m-0 p-0 font-bold" style="font-size:9px"> {{$elm8->name}}</span>
                                            @foreach ($value->results as $k)
                                                @if($k->element_id == $elm8->id)
                                                        <span class="w-3 h-3 py-0 px-1 align-middle content-middle font-bold m-0" style=" border:1px solid black;font-size:10px;border-radius:1px;line-height:50%">v</span>
                                                    @if($k->element_id !== $elm8->id)
                                                        @break
                                                    @endif
                                                @endif
                                                @if($k->element_id !== $elm8->id)
                                                    <span class="w-3 h-3 py-0 px-1 align-middle content-middle text-white font-bold  m-0" style="border:1px solid black;font-size:8px;border-radius:1px; color:white; line-height:50%">v</span>
                                                    @if($k->element_id !== $elm8->id)
                                                        @break
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                </td>
                                @endif
                        @endforeach
                    </tr>


                    <tr class="py-0 m-0 bordered align-middle">
                        <td colspan="5"  style="border:none !important" class="text-center p-0 pl-2">
                             @if ($value->imageLeft)
                                <img class="" style="width:260px; height:180px"
                                src="{{ public_path('/storage') }}/imageThinLeft/{{$value->imageLeft->thinLeft}}"
                            />
                            @elseif(!$value->imageLeft)
                              <img class="" style="width:260px; height:180px; opacity:0.3"
                                src="{{ public_path('/storage') }}/Logo/Thinprep.jpg"/>
                            @endif

                        </td>
                        <td colspan="5" class="p-0"  style="border:none !important">
                             @if ($value->imageLeft)
                                <img class="" style="width:260px; height:180px"
                                src="{{ public_path('/storage') }}/imageThinLeft/{{$value->imageLeft->thinLeft}}"
                            />
                               @elseif(!$value->imageLeft)
                              <img class="" style="width:260px; height:180px; opacity:0.3"
                                src="{{ public_path('/storage') }}/Logo/Thinprep.jpg"/>
                            @endif
                        </td>
                    </tr>
            <tr class="py-0 m-0 bordered align-middle mt-2">
                    <td colspan="5"  style="border:none !important" class=" p-0 pl-2">
                        @foreach ($testElements as $key=>$elm9 )
                                @if ($elm9->element_group == 9)

                                        <div class="p-0 m-0 align-middle  mr-4">
                                        <span class="align-middle m-0 p-0 font-bold uppercase" style="font-size:12px"> {{$elm9->name}}</span>
                                            @foreach ($value->results as $k=>$v)
                                                @if ($v->element_id == 26)
                                                    <p class="text-danger uppercase" style="line-heigh:50%">- {{$v->result}}</p>
                                                @endif


                                            @endforeach
                                        </div>

                                @endif
                        @endforeach
                    </td>
                    <td colspan="5" class="p-0 text-right"  style="border:none !important">
                        <div class="text-center font-bold">
                            <p style="line-height:1;font-size:12px; font-weight:normal">Ngày đọc kết quả: {{$dateNow}} </p>
                            <p style="line-height:50%;font-size:12px mb-10">BS/KTV độc kết quả</p>
                            <p class="my-20"></p>
                            <p class="uppercase" style="line-height:50%;font-size:12px; line-height:50%">Khoa giải phẩu bệnh từ dũ</p>
                            <p class="uppercase" style="line-height:50%;font-size:12px">Bệnh viện từ dũ</p>

                        </div>
                    </td>
                </tr>

            <tr>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important"></td>
                <td width="10%"  style="border:none !important">

                </td>
            </tr>
            </tbody>
        </table>

</div>
<div style="page-break-after: avoid;"></div>
