<div class="container-fluid " style="padding:20px">
        <table class="table borderless " style="padding:0 20px">
            <tbody>
                <tr>
                    <td colspan="5" style="border:none !important"><img style="width:180px; height:75px" src="{{ public_path('/storage/Logo/logoSG.png') }}"/></td>
                    <td colspan="5" class="text-right" style="border:none !important"> <img style="width:120px; height:75px" src="{{ public_path('/storage/Logo/Thinprep.jpg') }}"/></td>
                </tr>

                <tr  style="border:none !important" class="mt-4">
                    <td style="border:none !important" class="" colspan=""></td>
                    <td  style="border:none !important" class="col-1 py-0 text-right" colspan="5">
                        <div class="d-flex flex-column text-center uppercase py-0">
                            <div class="py-0 font-bold text-right text-primary" style="font-size:16px;line-height:1; text-decoration:underline;">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</div>
                        </div>
                    </td>
                    <td style="border:none !important " colspan="4" class=" py-0 pt-1">
                        <p style="line-height:50%">Mã y tế: <span>{{$value->thinprep_code}}</span></p>
                        <p style="line-height:50%">STT:</p>

                    </td>
                </tr>
                <tr>
                    <td class="py-0" colspan="10" style="border:none !important">
                        <div class="py-0 font-bold  text-primary" style="font-size:14px;line-height:1; text-decoration:underline">THÔNG TIN BỆNH NHÂN</div>
                    </td>
                </tr>
                <tr style="border:none !important" >
                        <td style="border:none !important" class="py-1" colspan="4"><span>Họ và tên: </span><span class="font-bold">{{$value->custommer->name}}</span></td>
                        <td style="border:none !important" class=" py-1" colspan="3">Năm sinh: <span>{{$value->custommer->birthday}}</span></td>
                        <td style="border:none !important" colspan="3" class="py-0" colspan="4">Para: <span>{{$value->para}}</span></td>
                </tr>
                <tr>
                    <td style="border:none !important" class="py-0" colspan="10"><span>Địa chỉ: </span><span class="font-bold">{{$value->custommer->address}}</span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="10"><span>Chẩn đoán lâm sàng : </span><span class="font-bold"></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" colspan="5" class="py-0">Bác sỹ lấy mẫu: <span class="font-bold">{{$value->doctor->name}}</span></td>
                    <td style="border:none !important" class="py-0" colspan="5"><span>Ngày lấy mẫu: </span><span class="font-bold"></span></td>
                </tr>
            </tbody>
        </table>
    <div class="text-center text-danger font-bold mb-0" style="line-height:50%; font-size:14px; text-decoration:underline">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
        <table class="table mt-0 mb-0 pb-0" style="">
            <tbody>
            <tr class="">
                <td class="py-0" colspan="10" style="border:none !important" >
                        <span class="font-bold text-primary uppercase py-0 my-0" style='line-height:50%'> LOẠI BỆNH PHẨM </span>
                        <span class="ml-4 font-bold text-danger py-0 my-0" style='line-height:50%'> Tế bào học nhúng dịch ThinPrep®</span>
                    </td>
            </tr>

                <tr class="align-middle">
                    <td class="py-0" colspan="3" style="border:none !important" >
                        <span class="font-bold text-primary uppercase py-0 my-0" style='line-height:50%'> TÍNH CHẤT BỆNH PHẨM:</span>
                    </td>
                         @foreach ($testElements as $key=>$elm )
                            @if ($elm->element_group ==1)
                                <td colspan="3" class="align-middle py-0" style="border:none !important">

                                        @if ($elm->valueresult($value->id)!==null)
                                            <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                        @else
                                            <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                        @endif
                                    <span class="align-middle m-0 p-0 font-bold ">{{$elm->name}}</span>

                                </td>
                            @endif
                        @endforeach
                </tr>
                <tr class="pt-2">
                    <td class="py-0 mt-2" colspan="10" style="border:none !important">
                        <div class="py-0 pt-2 font-bold  text-primary" style="font-size:12px;">KẾT QUẢ</div>
                    </td>
                </tr>
                <tr class="py-0 bordered  align-middle">
                    <td colspan="5" class="py-0 my-0  align-middle" style="border:none !important">
                        @foreach ($testElements as $key=>$elm2 )
                            @if ($elm2->element_group ==12)
                                    <div class="pl-2  m-0 align-middle">
                                                @if ($elm2->valueresult($value->id)!==null)
                                            <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                                @else
                                                <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                            @endif
                                        <span class="align-middle m-0 font-bold text-primary" style="decoration:underline">{{$elm2->name}}</span>

                                    </div>
                            @endif
                        @endforeach
                        </td>
                    <td colspan="5" class="py-0 my-0 align-middle" style="border:none !important">
                        @foreach ($testElements as $key=>$elm2 )
                            @if ($elm2->element_group ==112)
                                    <div class="p-0 m-0 align-middle">
                                                @if ($elm2->valueresult($value->id)!==null)
                                            <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                                @else
                                                <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:8px;border-radius:1px;">v</span>
                                            @endif
                                        <span class="align-middle m-0 p-0 font-bold text-primary" style="border-bottom:1px solic black">{{$elm2->name}}</span>
                                    </div>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr class="py-0 m-0 align-middle">
                    <td colspan="5"  style="border:none !important" class="-p-2 pl-2">
                        <div class="text-primary font-bold" style="font-size:12px; line-height:1; text-decoration:underline">BIẾN ĐỔI TẾ BÀO DO VI SINH</div>
                            @foreach ($testElements as $key=>$elm13 )
                                @if ($elm13->element_group == 13)
                                    <div class="px-2 py-0 m-0 align-middle"  style="font-size:9px; line-height:1.6">
                                                    @if ($elm13->valueresult($value->id)!==null)
                                                <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @else
                                                <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @endif
                                                <span class="align-middle m-0 p-0 font-bold font-italic" style="font-size:9px;" >{{$elm13->name}}</span>
                                        </div>
                                    @endif
                            @endforeach
                    </td>
                    <td colspan="5"  style="border:none !important" class="-p-2 pl-2">
                        <div class="text-primary font-bold" style="font-size:12px; line-height:1; text-decoration:underline">TẾ BÀO GAI</div>
                            @foreach ($testElements as $key=>$elm14)
                                @if ($elm14->element_group == 14)
                                    <div class="px-2 py-0 m-0 align-middle"  style="font-size:9px; line-height:1.6">
                                                    @if ($elm14->valueresult($value->id)!==null)
                                                <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @else
                                                <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @endif
                                                <span class="align-middle m-0 p-0 font-bold" style="font-size:9px;" >{{$elm14->name}}</span>
                                        </div>
                                    @endif
                            @endforeach
                    </td>


                </tr>
                <tr class="py-0 m-0 align-middle">
                    <td colspan="5"  style="border:none !important" class="py-0 pl-2">
                        <div class="text-primary font-bold py-0" style="font-size:12px; line-height:1; text-decoration:underline">BIẾN ĐỔI TẾ BÀO KHÁC</div>
                            @foreach ($testElements as $key=>$elm15 )
                                @if ($elm15->element_group == 15)
                                    <div class="px-2 py-0 m-0 align-middle"  style="font-size:9px; line-height:1.6">
                                                    @if ($elm15->valueresult($value->id)!==null)
                                                <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @else
                                                <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @endif
                                                        <span class="align-middle m-0 p-0 font-bold" style="font-size:9px;" >{{$elm15->name}}</span>

                                        </div>
                                    @endif
                            @endforeach
                    </td>
                    <td colspan="5"  style="border:none !important" class="py-0 pl-2">
                        <div class="text-primary font-bold py-0" style="font-size:12px; line-height:1; text-decoration:underline">TẾ BÀO TUYẾN</div>
                            @foreach ($testElements as $key=>$elm16 )
                                @if ($elm16->element_group == 16)
                                    <div class="px-2 py-0 m-0 align-middle"  style="font-size:9px; line-height:1.6">
                                                    @if ($elm16->valueresult($value->id)!==null)
                                                <span class="text-white py-0 px-1 align-middle content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @else
                                                <span class=" py-0 px-1 align-middle  content-middle font-bold" style="border:1px solid black;font-size:6px;border-radius:1px;">v</span>
                                                    @endif
                                                        <span class="align-middle m-0 p-0 font-bold" style="font-size:9px;" >{{$elm16->name}}</span>

                                        </div>
                                    @endif
                            @endforeach
                    </td>


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

            <tr class="py-0 m-0 bordered align-middle">
                    <td colspan="5"  style="border:none !important" class=" p-0 pl-2">
                       <div class="d-flex flex-col">
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
                       </div>
                       <div class="mt-4">
                        <p class="py-0 m-0 text-primary font-italic" style="line-height:1;font-size:12px"><span class="uppercase font-bold">ĐỀ NGHỊ:</span>:</p>
                        <span class="m-0 uppercase py-0 pl-2 text-danger" style="line-height:1;font-size:12px">

                        </span>
                       </div>

                    </td>
                    <td colspan="5" class="p-0 text-right"  style="border:none !important">
                        <div class="text-center">
                            <p class=" font-bold" style="line-height:1;font-size:12px;">Ngày đọc kết quả: {{$dateNow}} </p>
                            <p class="font-bold" style="line-height:50%;font-size:10px; margin-bottom:80px">BS/KTV đọc kết quả</p>

                    </td>
            </tr>
            <tr class="pb-0 m-0 bordered align-middle">
                    <td colspan="5"  style="border:none !important " class="font-bold p-0 pl-2 align-bottom">
                       <p style="line-height:50%; font-size:9px"> Tầng 4-5-6, Số 9-11-13-15 Trịnh Văn Cấn, P.Cầu Ông Lãnh, Q.1, TP.HCM</p>
                       <p style="line-height:50%; font-size:9px"> T: +848 28 213 456 * F: -848 28 210 799 * W: www.taimuihongsg.com</p>
                    </td>
                    <td colspan="5" class="p-0 text-right"  style="border:none !important">
                        <div class="text-center pb-4">
                            <p class="uppercase font-bold" style="line-height:50%;font-size:12px; line-height:50%" >@if($value->doctor){{$value->doctor->name}}@endif</p>
                            <p class="uppercase font-bold" style="line-height:50%;font-size:12px; line-height:50%">Khoa giải phẩu bệnh từ dũ</p>
                            <p class="uppercase font-bold pb-2" style="line-height:50%;font-size:12px">Bệnh viện từ dũ</p>
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
                <td width="10%"  style="border:none !important"></td>
            </tr>
            </tbody>
        </table>
</div>
<div style="page-break-after: avoid;"></div>