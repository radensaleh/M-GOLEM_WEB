<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDF</title>
  </head>
  <body>
    <p>
      <b>| Data Barang</b> <br>
       M - GOLEM [Mobile Goods Lending System Using Barcode]
    </p>
  <hr>

  <table border="1" cellspacing="1" width="100%">
      <thead style="text-align:center;">
        <tr>
          <th width="3%">No</th>
          <th width="3%">QR-Code</th>
          <th width="7%">Id Barang</th>
          <th width="5%">Kategori</th>
          <th width="5%">Merk</th>
          <th width="5%">Tipe</th>
          <th width="3%">Kuantitas</th>
        </tr>
      </thead>
      <tbody style="text-align:center;">
        @foreach($barang as $key => $data)
          <tr>
            <td width="3%">{{ ++$key }}</td>
            <th width="3%">{!! DNS2D::getBarcodeHTML($data->id_barang, 'QRCODE',3,3,"black",true) !!}</th>
            <th width="7%">{{ $data->id_barang }}</th>
            <th width="5%">{{ $data->kategori->nama_kategori }}</th>
            <th width="5%">{{ $data->merk->nama_merk }}</th>
            <th width="5%">{{ $data->tipe->nama_tipe }}</th>
            <th width="3%">{{ $data->kuantitas }}</th>
          </tr>
        @endforeach
      </tbody>
  </table>

  </body>
</html>
