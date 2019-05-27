<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Barang;
use App\Type;
use App\Kategori;
use App\Merk;
use Illuminate\Http\Request;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use \Milon\Barcode\DNS2D;

class BarangController extends Controller
{
    // --------------------- TEKNISI ---------------------- //
    public function showDataBarang(Request $request){
        $username = $request->session()->get('usernameTeknisi');
        $nama_teknisi = DB::table('tb_teknisi')->where('username', $username)->value('nama_teknisi');

        $barang   = Barang::orderBy('id_barang', 'asc')->get();
        $tipe     = Type::orderBy('nama_tipe', 'asc')->get();
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $merk     = Merk::orderBy('nama_merk', 'asc')->get();

        return view('teknisi.dataBarang', compact('nama_teknisi', 'barang', 'tipe', 'kategori', 'merk'));
    }

    // --------------------- ADMIN ---------------------- //
    public function showDtBarangAdmin(Request $request){
        $username = $request->session()->get('usernameAdmin');
        $nama_admin = DB::table('tb_admin')->where('username', $username)->value('nama');

        $barang   = Barang::orderBy('id_barang', 'asc')->get();
        $tipe     = Type::orderBy('nama_tipe', 'asc')->get();
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $merk     = Merk::orderBy('nama_merk', 'asc')->get();

        return view('adminWeb.dataBarang', compact('nama_admin', 'barang', 'tipe', 'kategori', 'merk'));
    }

    public function store(Request $request){
        $checkIfExist = Barang::where('id_barang', $request->id_barang)->get();

        if( count($checkIfExist) != 0 ){
          return response()->json([
             'error' => 1,
             'message' => 'Id Barang Already Exist'
           ], 200);
        }

        $barang = new Barang();
        $create = Barang::create($request->all());

        // $qrCode = new QrCode();
        //   $qrCode
        //       ->setText($request->id_barang)
        //       ->setSize(400)
        //       ->setPadding(20)
        //       ->setErrorCorrection('high')
        //       ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        //       ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        //       ->setLabel('Scan Me by M-GOLEM')
        //       ->setLabelFontSize(14)
        //       ->setImageType(QrCode::IMAGE_TYPE_PNG)
        //   ;
        //
        // $barang->generate    = DNS2D::getBarcodePNG($request->id_barang, "QRCODE");
        // $barang->id_barang   = $request->id_barang;
        // $barang->id_kategori = $request->id_kategori;
        // $barang->id_merk     = $request->id_merk;
        // $barang->id_tipe     = $request->id_tipe;
        // $barang->kuantitas   = $request->kuantitas;
        // $barang->save();

        if( $barang ) {
           return response()->json([
             'error' => 0,
             'message' => 'Success Add Data'
           ], 200);
      }
    }

    public function update(Request $request){
        $data = Barang::findOrFail($request->id_barang);
        $data->update($request->all());

        if( $data ){
          return response()->json([
            'error' => 0,
            'message' => 'Success Edit Data'
          ], 200);
        }
    }

    public function destroy(Request $request){
         $data = Barang::findOrFail($request->id_barang);

         try {
           $data->delete();

           if( $data ){
             return response()->json([
               'error' => 0,
               'message' => 'Success Delete Data'
             ], 200);
           }
         } catch (\Exception $e) {
             return response()->json([
               'error' => 1,
               'message' => 'Failed Delete Data'
             ], 200);
         }
    }

    public function pngQrcode($id_barang){
        $id = $id_barang;
        $pdf   = PDF::loadView('adminWeb.pdfQrCode', compact('id'));
        return $pdf->download('QR-Code-'.$id.'');

        // $qrCode = new QrCode();
        //   $qrCode
        //       ->setText("http://buatkamu.herokuapp.com/")
        //       ->setSize(500)
        //       ->setPadding(10)
        //       ->setErrorCorrection('high')
        //       ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        //       ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        //       ->setLabel('24/4/19')
        //       ->setLabelFontSize(17)
        //       ->setImageType(QrCode::IMAGE_TYPE_PNG)
        //   ;
        //
        // echo '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';

        // $barang = Barang::where('id_barang', $id_barang)->firstOrFail();
        // $path = public_path(). '/images/'. $barang->filename
        // return response()->download($path, $barang->original_filename, ['Content-Type' => $barang->mime]);

    }

    public function allQrCode(){
        $barang = Barang::all();
        $pdf    = PDF::loadView('adminWeb.pdfAllQrCode', compact('barang'));
        return $pdf->download('QR-Code');
    }

    public function allDtBarang(){
      $barang = Barang::all();
      $pdf    = PDF::loadView('adminWeb.pdfDtBarang', compact('barang'));
      return $pdf->download('Data Barang');
    }

}
