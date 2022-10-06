<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags font-family: "Dojo Sans Serif", "DejaVu Sans", sans-serif; -->

    {{-- <meta charset="utf-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" href="css/app.css" />
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<style>
@font-face {
/*--font-family: 'font_family';-->*/

  font-style: normal;
  font-weight: normal;

  /*src: url(/storage/fonts/Roboto-Bold.ttf) format('truetype');*/
}
  @font-face {


        }
* {
  font-family: Serif;
}

        @media print {
  h1 {page-break-before: !always;}
}
</style>
  </head>
  <body style="bg-primary">
  <table>
    <tr>
      <td><img class='w-20' src="{{ public_path('/storage/Logo/Thinprep.jpg') }}" ></td>


      <td class="text-center">PHIếU XÉT NGHIEM TE BAO CO TU CUNG</td>
      <td>Logo right</td>
    </tr>
  </table>

          <table class="table">
                <thead>
                  <tr class="bg-danger">
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($billtests as $key=>$value )
                  <tr class="">
                      <td>{{$value->id}}</td>
                      <td style="">{{$value->custommer->name}}</td>
                      <td></td>
                      <td></td>

                  </tr>


                @endforeach

                </tbody>
      </table>
</div>


<h1></h1>

  </body>
</html>


