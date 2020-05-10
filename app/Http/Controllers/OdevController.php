<?php

namespace App\Http\Controllers;

use App\Odevler;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class OdevController extends BaseController
{
    private $tumBenzerKelimeler = [];

    public function index()
    {
        $odevler = Odevler::all();
        foreach ($odevler as $key => $asilOdev) {
            $asilOdev->ortalama = 0;
            $asilOdevHaricOdevler = $odevler->forget($key);
            $odevKarsilastir = $this->odevKarsilastir($asilOdev, $asilOdevHaricOdevler, true);
            $odevKarsilastir2 = $this->odevKarsilastir($asilOdev, $asilOdevHaricOdevler, false);
            if (isset($odevKarsilastir[$asilOdev->id])) {
                $yuzdeler = $odevKarsilastir[$asilOdev->id];
                $asilOdev->ortalama_akhkat = number_format(array_sum($yuzdeler) / $asilOdevHaricOdevler->count(), 2);
            }
            if (isset($odevKarsilastir2[$asilOdev->id])) {
                $yuzdeler = $odevKarsilastir2[$asilOdev->id];
                $asilOdev->ortalama_akhkatma = number_format(array_sum($yuzdeler) / $asilOdevHaricOdevler->count(), 2);
            }
            $odevler->push($asilOdev);
        }
        return view('admin.odevler.index', compact('odevler'));
    }

    public function create()
    {
        $odevler = Odevler::all();
        $odev = new Odevler();
        return view('admin.odevler.create', compact('odev', 'odevler'));
    }

    public function store(Request $request)
    {
        $file_name = uniqid() . '.' . $request->dosya_adi->getClientOriginalExtension();
        $request->dosya_adi->move(public_path('files'), $file_name);
        $odev = new Odevler();
        $odev->ad = $request->get('adi');
        $odev->soyad = $request->get('soyadi');
        $odev->ders = $request->get('ders');
        $odev->dosya_adi = $file_name;
        $odev->save();
        return back();
    }

    public function edit($id)
    {
        $odev = Odevler::find($id);
        return view('admin.odevler.edit', compact('odev'));
    }

    public function update(Request $request, $id)
    {
        $file = $request->file("dosya_adi");
        $file_name = uniqid() . '-' . $file->getClientOriginalName();
        $file->move(public_path('files'), $file_name);
        $odev = Odevler::find($id);
        $odev->ad = $request->get('adi');
        $odev->soyad = $request->get('soyadi');
        $odev->ders = $request->get('ders');
        $odev->dosya_adi = $file_name;
        $odev->save();
        return back();
    }

    public function destroy($id)
    {
        Odevler::destroy($id);
        return back();
    }

    private function odevKarsilastir($asilOdev, $odevler, $ayniKelimeyiHesabaKatma = false)
    {
        $asilFile = fopen(public_path() . "/files/" . $asilOdev->dosya_adi, "r") or die("Unable to open file!");
        $asilIcerik = mb_convert_encoding(fread($asilFile, filesize(public_path() . "/files/" . $asilOdev->dosya_adi)), "UTF-8", "ISO-8859-9");
        $asilIcerikLength = strlen($asilIcerik);
        fclose($asilFile);
        $yuzdeler = [];
        foreach ($odevler as $odev) {
            $haricifile = public_path() . "/files/" . $odev->dosya_adi;
            if (file_exists($haricifile)) {
                $myfile2 = fopen($haricifile, "r") or die("Unable to open file!");
                $icerik2 = mb_convert_encoding(fread($myfile2, filesize($haricifile)), "UTF-8", "ISO-8859-9");
                fclose($myfile2);
                if ($asilIcerikLength > strlen($icerik2)) {
                    $buyuk = $asilIcerik;
                    $kucuk = $icerik2;
                }
                else {
                    $buyuk = $icerik2;
                    $kucuk = $asilIcerik;
                }
                $benzerKelimeSayisi = [];
                $length = (int)(2 * strlen($kucuk) / 100);
                if ($length <= 0) {
                    $length = 1;
                }
                for ($i = 0; $i < strlen($buyuk); $i += $length) {
                    $parca = substr($kucuk, $i, $length);
                    $temizlenmisParca = trim(preg_replace('/\s\s+/', ' ', $parca));
                    if ($ayniKelimeyiHesabaKatma) {
                        if ($temizlenmisParca && Str::contains($buyuk, [$temizlenmisParca]) && !in_array($temizlenmisParca, $this->tumBenzerKelimeler)) {
                            $benzerKelimeSayisi[] = $temizlenmisParca;
                            $this->tumBenzerKelimeler[] = $temizlenmisParca;
                        }
                    }
                    else {
                        if ($temizlenmisParca && Str::contains($buyuk, [$temizlenmisParca])) {
                            $benzerKelimeSayisi[] = $temizlenmisParca;
                        }
                    }
                }
                $benzerS = strlen(implode('', array_unique($benzerKelimeSayisi)));
                if ($benzerS > strlen($kucuk)) {
                    $benzerS = strlen($kucuk);
                }
                $yuzde = $benzerS * 100 / $asilIcerikLength;
                if ($yuzde < 1) {
                    $yuzde = 0;
                }
                $yuzdeler[$asilOdev->id][$odev->id] = number_format($yuzde, 2);
            }
        }
        return $yuzdeler;
    }

    public function benzerlikKarsilastir($id)
    {
        $asilOdev = Odevler::find($id);
        $odevler = Odevler::where("id", "<>", $asilOdev->id)->get();
        $yuzdeler = $this->odevKarsilastir($asilOdev, $odevler);
        return view('admin.odevler.benzerlik', compact('odevler', 'yuzdeler', 'asilOdev'));
    }

    public function tabloIndex()
    {
        return view('admin.tablo.index');
    }
}
