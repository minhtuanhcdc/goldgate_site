<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" href="css/app.css" />

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<style>
@font-face {
  font-family: "Dojo Sans Serif";
  font-style: normal;
  font-weight: normal;
  src: url(http://example.com/fonts/dojosans.ttf) format('truetype');
}
* {
  font-family: "Dojo Sans Serif", "DejaVu Sans", sans-serif;
}
</style>
  </head>
  <body style="font-family: serif; ">
        <div class="py-4 px-10 " id="printMe">
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
                    <div class="fontTitle" ><span>PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG 123</span></div>
                    <div>
                     <ul>
                        @foreach ($billtests as $key=>$item)
                             <li>{{$item}}</li>
                        @endforeach


                     </ul>
                    </div>
                 </div>
          </div>
          <div class="grid text-left text-italy text-md font-bold content-center font-sans-Timenew leading-5  pl-1 py-0">
              <span>Mã y tế:"Ma_Yte"</span>
              <span>STT:"MSTB"</span>
            </div>
      </div>
      <!--==============--->
      <div class="text-primary" >THÔNG TIN BỆNH NHÂN heheh Tesst</div>
      <div>
{{$billtests}}
      </div>

      <div class="page_break"></div>
      <div class="grid grid-cols-4 leading-6">
       @foreach ($billtests as $key=>$item)
          <div class="col-span-2 font-bold">Họ tên:

                            <span>{{$item->custommer->name}}</span>

          </div>
          <div class="font-bold text-md font-sans-Timenew">Năm sinh:{{$item->custommer->birthday}}</div>
          <div class=" font-bold font-sans-Timenew ">Para: </div>
      </div>
      <div class="font-bold font-sans-Timenew leading-6">Đia chỉ</div>
      <div class="font-bold font-sans-Timenew leading-6">Chẩn đoán lâm sàng:</div>
      <div class="grid grid-cols-3 font-sans-Timenew leading-6">
          <div class="font-bold col-span-2">Bác sỹ lấy mẫu:</div>
          <div class="font-bold">Ngày lấy mẫu:</div>
      </div>
       @endforeach
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

              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Gai</span>
              <div class="flex flex-col leading-5">

              </div>
            </div>


         </div>
         <div class="grid grid-cols-3 mt-2">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Biến đổi tế bào khác</span>
              <div class="flex flex-col">

              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào tuyến</span>
              <div class="flex flex-col leading-5">

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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
