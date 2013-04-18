<?php

class Pdf_Print {

    public function createBar() {

        require_once('../tcpdf/config/lang/eng.php');
        require_once('../tcpdf/tcpdf.php');


        $html = '<html><head><title>BAR</title><style type="text/css">@import url("https://themes.googleusercontent.com/fonts/css?kit=soa_V42eXREs8LDkwBiWS_esZW2xOQ-xsNqO47m55DA");ol{margin:0;padding:0}.c18{vertical-align:top;width:221.4pt;border-style:solid;border-color:#000000;border-width:0pt;padding:0pt 5.4pt 0pt 5.4pt}.c7{margin-right:-2.8pt;height:12pt;text-align:right;direction:ltr}.c26{max-width:486.2pt;background-color:#ffffff;padding:27.2pt 53.8pt 31.2pt 72pt}.c5{height:12pt;text-align:center;direction:ltr}.c24{font-size:13pt;font-family:"Bookman Old Style";text-decoration:underline}.c9{list-style-type:decimal;margin:0;padding:0}.c10{height:12pt;direction:ltr}.c2{font-size:11pt;font-family:"Arial Narrow"}.c3{text-align:justify;margin-left:36pt}.c0{line-height:1.5;direction:ltr}.c1{text-align:justify;padding-bottom:6pt}.c21{padding-left:0pt;margin-left:55.4pt}.c8{padding-left:0.7pt;margin-left:55.4pt}.c19{padding-top:18pt}.c27{padding-top:12pt}.c4{text-indent:36pt}.c25{text-align:right}.c22{border-collapse:collapse}.c28{font-size:8pt}.c11{font-weight:bold}.c16{direction:ltr}.c23{margin-right:18pt}.c17{color:#ff0000}.c20{margin-right:-2.8pt}.c14{line-height:1.5}.c12{text-align:center}.c13{height:0pt}.c15{font-style:italic}.c6{text-align:justify}.title{padding-top:24pt;line-height:1.0;text-align:left;color:#000000;font-size:36pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:6pt}.subtitle{padding-top:18pt;line-height:1.0;text-align:left;color:#666666;font-style:italic;font-size:24pt;font-family:"Georgia";padding-bottom:4pt}li{color:#000000;font-size:12pt;font-family:"Times New Roman"}p{color:#000000;font-size:12pt;margin:0;font-family:"Times New Roman"}h1{padding-top:24pt;line-height:1.0;text-align:left;color:#000000;font-size:24pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:6pt}h2{padding-top:18pt;line-height:1.0;text-align:left;color:#000000;font-size:18pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:4pt}h3{padding-top:14pt;line-height:1.0;text-align:left;color:#000000;font-size:14pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:4pt}h4{padding-top:12pt;line-height:1.0;text-align:left;color:#000000;font-size:12pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:2pt}h5{padding-top:11pt;line-height:1.0;text-align:left;color:#000000;font-size:11pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:2pt}h6{padding-top:10pt;line-height:1.0;text-align:left;color:#000000;font-size:10pt;font-family:"Times New Roman";font-weight:bold;padding-bottom:2pt}</style>
            </head>
            <body class="c26"><div><p class="c5"><span><IMG SRC="../img/garuda2.png" ALIGN="CENTER" WIDTH=159 HEIGHT=106></span></p><p class="c12 c16"><span>MENTERI KEUANGAN</span></p><p class="c16 c12 c20"><span>REPUBLIK INDONESIA</span></p></div>
            <p class="c0 c12 c19"><span class="c11 c24">Berita Acara Rekonsiliasi</span></p><p class="c16 c12"><span>No. BA- &nbsp; &nbsp; &nbsp; /WPB.06/KP.0140/2011</span></p><p class="c0 c1 c4 c27"><span class="c2">Pada hari ini Senin tanggal satu bulan Maret tahun Dua ribu sebelas</span><span class="c2 c17">&nbsp;</span><span class="c2">telah diselenggarakan rekonsiliasi Laporan Realisasi Anggaran antara satuan kerja / satuan kerja perangkat daerah Dinas Kehutanan Provinsi Jambi (029.05.100082.dk), yang selanjutnya disebut Kuasa Pengguna Anggaran (KPA), dengan Kantor Pelayanan Perbendaharaan Negara Jambi &nbsp;kode (527890), yang selanjutnya disebut Kuasa Bendahara Umum Negara.</span></p><p class="c0 c4 c6"><span class="c2">Kuasa Pengguna Anggaran menyampaikan Laporan Realisasi Anggaran sebagai bahan rekonsiliasi, berupa:</span></p><ol class="c9" start="1"><li class="c0 c8 c6"><span class="c2">Laporan Realisasi Anggaran Belanja periode &nbsp;Bulan Februari &nbsp;TA 2011</span></li><li class="c0 c8 c6"><span class="c2">Laporan Realisasi Anggaran Pengembalian Belanja periode &nbsp;Bulan &nbsp;Februari </span><span class="c2 c17">&nbsp;</span><span class="c2">TA 2011</span></li><li class="c0 c8 c6"><span class="c2">Laporan Realisasi Anggaran Pendapatan periode Bulan Februari </span><span class="c2 c17">&nbsp;</span><span class="c2">TA 2011</span></li><li class="c0 c1 c8"><span class="c2">Laporan Realisasi Anggaran Pengembalian Pendapatan periode bulan Februari</span><span class="c2 c17">&nbsp;</span><span class="c2">TA 2011</span></li></ol><p class="c0 c1"><span class="c2">Pada tanggal 28 Bulan Februari 2011</span></p><p class="c0 c1 c4"><span class="c2">Selanjutnya Kuasa Bendahara Umum Negara menyediakan data transaksi dan Laporan Realisasi Anggaran berdasarkan SPM/STS yang disampaikan oleh Kuasa Pengguna Anggaran yang diproses berdasarkan Sistem Akuntansi Umum.</span></p><p class="c0 c1 c4"><span class="c2">Rekonsiliasi dilaksanakan oleh secara bersama-sama, yang hasilnya dituangkan kedalam </span><span class="c2 c15">Berita Acara Rekonsiliasi (BAR)</span><span class="c2">&nbsp;ini dengan hasil sebagai berikut:</span></p><ol class="c9" start="1"><li class="c0 c6 c8"><span class="c2 c11">DIPA</span></li></ol><p class="c0 c3"><span class="c2">Tidak terdapat perbedaan antara data SAU dengan data SAI </span></p><ol class="c9" start="2"><li class="c0 c6 c21"><span class="c2 c11">LRA</span></li></ol><p class="c3 c0"><span class="c2">Tidak terdapat perbedaan antara data SAU dengan data SAI </span></p><ol class="c9" start="3"><li class="c0 c21 c6"><span class="c2 c11">NERACA</span></li></ol><p class="c3 c0"><span class="c2">Tidak terdapat perbedaan antara data SAU dengan data SAI </span></p><p class="c0 c1"><span class="c2">yang secara rinci tertuang dalam </span><span class="c2 c15">Laporan Hasil Rekonsiliasi</span><span class="c2">&nbsp;yang merupakan bagian &nbsp;yang tidak terpisahkan dari Berita Acara Rekonsiliasi (BAR) ini.</span></p><p class="c0 c4 c6"><span class="c2">Kesalahan/ketidakcocokan data yang tertuang dalam Laporan Hasil Rekonsiliasi, akan dijadikan dasar perbaikan terhadap data dan laporan Kuasa Pengguna Anggaran dan Kuasa Bendahara Umum Negara.</span></p><p class="c0 c4 c6"><span class="c2">Demikian berita acara ini dibuat untuk dilaksanakan.</span></p><p class="c10 c4 c14 c6"><a name="h.gjdgxs"></a></p><a href="#" name="edb53d1fefac213d40952232af8cc5211664cada"></a><a href="#" name="0"></a><table cellpadding="0" cellspacing="0" class="c22"><tbody><tr class="c13"><td class="c18"><p class="c0 c12"><span class="c2">A.n. Kuasa Bendahara Umum Negara,<br></span></p><p class="c0 c12"><span class="c2">Kepala Seksi Verifikasi dan Akuntansi<br></span></p><p class="c5 c14"><span class="c2"><br></span></p><p class="c10 c14"><span class="c2"><br></span></p><p class="c0 c12"><span class="c2">Noegroho, S.Sos<br></span></p><p class="c0 c12"><span class="c2">NIP &nbsp;197304041994021001</span></p></td><td class="c18"><p class="c0 c12"><span class="c2">&nbsp;a.n Kuasa Pengguna Anggaran<br></span></p><p class="c0 c12"><span class="c2">Pejabat Pembuat Komitmen<br></span></p><p class="c10 c14"><span class="c2"><br></span></p><p class="c10 c14"><span class="c2"><br></span></p><p class="c0"><span class="c2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br></span></p><p class="c0 c12"><span class="c2">NIP </span></p></td></tr></tbody></table><p class="c10 c14 c6"><span class="c2"></span></p><p class="c10"><span class="c2"></span></p><div><p class="c10"><span></span></p><p class="c10 c23"><span></span></p></div></body></html>';

        $pdf = new TCPDF('P', 'mm', 'F4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Eko Sigit / 5210105007');
        $pdf->SetTitle('Berita Acara Rekonsiliasi');
        $pdf->SetSubject('Laporan Hasil rekonsiliasi');
        $pdf->SetKeywords('rekonsiliasi,report,bar, php, mysql');


        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        $pdf->SetMargins('4', '1', '2');
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
        $pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set default font subsetting mode
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('helvetica', '', 11, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
        $pdf->AddPage();

//*************
        ob_end_clean();
//************* 
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, 
                $align = 'left', $autopadding = false);

        $pdf->Output('../BAR.pdf', 'F');
        echo json_encode('BAR.pdf');
    }

}

?>
