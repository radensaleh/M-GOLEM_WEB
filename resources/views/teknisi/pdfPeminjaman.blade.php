<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PDF</title>
</head>

<body>
  <p>
    <b>| Peminjaman [ Sudah dikembalikan ]</b> <br>
    M - GOLEM [Mobile Goods Lending System Using Barcode]
  </p>
  <hr>
  <table border="1" cellspacing="1" width="100%" style='font-size:75%'>
    <thead style="text-align:center;">
      <tr>
        <th width="1%">No</th>
        <th width="2%">Id</th>
        <th width="3%">Nama Mahasiwa</th>
        <th width="3%">Kegiatan</th>
        <th width="4%">Barang</th>
        <th width="2%">Tanggal Peminjaman</th>
        <th width="2%">Tanggal Pengembalian</th>
        <th width="3%">Verifikasi Peminjaman</th>
        <th width="4%">Verifikasi Pengembalian</th>
      </tr>
    </thead>
    <tbody style="text-align:center; font-size:70%">
      @foreach($pinjam as $key => $data)
      <tr>
        <td width="1%">{{ ++$key }}</td>
        <th width="2%">{{ $data->id_pinjam }}</th>
        <th width="3%">{{ $data->nama_mhs }}</th>
        <th width="3%">{{ $data->nama_kegiatan }}</th>
        <th width="4%">
          @foreach($daftar_barang as $key => $Data)
          @if($Data->id_pinjam == $data->id_pinjam)
          @foreach($barang as $key => $data_barang)
          @if($data_barang->id_barang == $Data->id_barang )
          {{$data_barang->id_kategori}}
          @endif
          @endforeach
          @endif
          @endforeach
        </th>
        <th width="2%">{{ $data->tgl_pinjam }}</th>
        <th width="2%">{{ $data->tgl_kembali }}</th>
        <th width="3%">{{ $data->teknisi_pinjam }}</th>
        <th width="4%">{{ $data->teknisi_kembali }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>

</body>

</html>