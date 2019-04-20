<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDF</title>
  </head>
  <body>
    {!! DNS2D::getBarcodeHTML($id, 'QRCODE',3,3,"black",true) !!}
    <!-- <span style="margin-left: 4%; font-family: sans-serif;" text-anchor= "middle" >{{$id}}</span> -->
  </body>
</html>
