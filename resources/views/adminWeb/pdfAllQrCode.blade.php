<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDF</title>
  </head>
  <body>

    <!-- <table border="2">
      <thead>
        @foreach($barang as $data)
        <tr>
            <th>{!! DNS2D::getBarcodeHTML($data->id_barang, 'QRCODE',3,3,"black",true) !!}</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td>{{ $data->id_barang }}</td>
          </tr>
        @endforeach
      </tbody>
    </table> -->

    @foreach($barang as $key => $data)
      <div  style="display:inline-block; margin:0px 10px 10px 20px;">
        <table border="1">
          <thead>
            <tr>
              <th>
                  {!! DNS2D::getBarcodeHTML($data->id_barang, 'QRCODE',3,3,"black",true) !!}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align:center; font-size:10px;">{{ $data->id_barang }}</td>
            </tr>
          </tbody>
        </table>
    </div>
    @endforeach

  </body>
</html>
