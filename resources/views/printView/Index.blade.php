<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    {{-- <meta charset="utf-8"> --}}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
     <link rel="stylesheet" href="css/app.css" />
     <link rel="stylesheet" href="css/myPDF.css" />
     <link type="text/css" rel="stylesheet" href="css/font-awesome.css">

          <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

   <style type="text/css">

    </style>

  </head>
  <body style="">

      @foreach ($billtests as $key=>$value)
          @if ($value->ousent_id == 1)
              @include('printView.FormTudu')
          @elseif ($value->ousent_id == 6)
              @include('printView.FormSaigon')
          @elseif ($value->ousent_id == 9)
              @include('printView.FormVigor')
          @else{
                   @include('printView.FormGenaral')
                  }
                  @endif
      @endforeach


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
  </body>
</html>


<style media="print">
@media print {
  /* .noPrint :not(.printMe){
    display:none;
  }
   body * {
    visibility: hidden;
  }*/
  #printMe * {
    visibility: visible;
    padding:0px;
    margin: 0px;
  }
  @page{
    size: a4;
    /* margin: 05mm 15mm 5mm 10mm; */
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman', serif;
    /* font-size: 20px; */
   }
   @page :left {
         margin-left: 1cm;
         /* margin-right: 2cm; */
      }

      @page :right {
         margin-left: 1cm;
         /* margin-right: 2cm; */
      }
}


</style>