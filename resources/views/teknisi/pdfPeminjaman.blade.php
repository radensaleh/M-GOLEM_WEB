<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PDF</title>
  </head>
  <body>
    <p>
      <b>| Peminjaman</b> <br>
       M - GOLEM [Mobile Goods Lending System Using Barcode]
    </p>
  <hr>

  <table border="1" cellspacing="1" width="100%">
      <thead style="text-align:center;">
        <tr>
          <th width="3%">No</th>
          <th width="3%">Id</th>
          <th width="7%">Nama Mahasiwa</th>
          <th width="3%">Kegiatan</th>
          <th width="5%">Tanggal Peminjaman</th>
          <th width="5%">Tanggal Pengembalian</th>
          <th width="5%">Status Peminjaman</th>
          <th width="7%">Verifikasi Pinjam oleh</th>
        </tr>
      </thead>
      <tbody style="text-align:center;">
        @foreach($pinjam as $key => $data)
          <tr>
            <td width="3%">{{ ++$key }}</td>
            <th width="3%">{{ $data->id_pinjam }}</th>
            <th width="7%">{{ $data->mahasiswa->nama_mhs }}</th>
            <th width="3%">{{ $data->nama_kegiatan }}</th>
            <th width="5%">{{ $data->tgl_pinjam }}</th>
            <th width="5%">{{ $data->tgl_kembali }}</th>
            <th width="5%">{{ $data->status }}</th>
            <th width="7%">{{ $data->teknisipinjam->nama_teknisi }}</th>
          </tr>
        @endforeach
      </tbody>
  </table>

  </body>
</html>
