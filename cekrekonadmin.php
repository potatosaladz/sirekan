<style type="text/css">
    #grid {
        margin: 3% 2%;
        border: 1px solid black;
        font-family: Calibri, sans-serif;
        font-size: 16px;
        width: 95%;
        text-align: left;
    }
    
    #rekon_sakpa {
        width: 90%;
        margin-left: 5%;
    }

    thead tr {
        border-bottom: 1px solid black;
        background: #A7C9B8;
        text-align: center;
    }

    thead tr:hover {
        background: #A7C9B8;
    }

    tr {
        height: 20px;
        text-align: left;
    }

    tr:hover {
        background-color: #ccc;
    }

    tr:nth-child(even) {
        background: #B7E9F7;
    }

    tr:nth-child(even):hover {
        background: #ccc;
    }

    td {
        padding: 0 2px;
        text-align: left;
    }

    td:hover {
        cursor: pointer;
    }

    #grid td:last-child {
        text-align: left;
        width: auto;
    }
    
    input[type=text], option {
        background-color: #fbec88;
        border-width: 1px;
    }
    
    div.ui-datepicker, .ui-datepicker input{
        font-size:62.5%;
    }
    
    #mask {
        display: none;
        background: #000; 
        position: fixed; left: 0; top: 0; 
        z-index: 10;
        width: 100%; height: 100%;
        opacity: 0.8;
        z-index: 999;
    }

    #loader {
        display:none;
        width: 20%;
        height: 13%;
        background: #111;
        padding: 10px; 	
        border: 2px solid #ddd;
        float: left;
        font-size: 1.2em;
        color: white;
        position: fixed;
        top: 50%; left: 50%;
        z-index: 99999;
        text-align: center;
        box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
        border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
    }
    #rekon_sakpa {
        display: none;
    }
    
    #hasil_rekon {
        border: 1px solid #111;
    }
        
    #data_rekon {
        overflow-y: auto;
        height: 60%;
    }
    
    tr#red {
        background-color: red;
    }
    
    .error {
        border: 1px solid;
        margin: 1% 2%;
        width: 45%;
        padding:15px 10px 15px 50px;
        border-radius: 3px;
        background-repeat: no-repeat;
        background-position: 10px center;
        color: #D8000C;
        background-color: #FFBABA;
        background-image: url('img/error.png');
        display: none;
    }
</style>
<form id="ceksakpa" method="post" action="">
    <table id="grid">
        <thead>
        <th colspan="7">Cek Hasil Rekonsiliasi SAKPA</th>
        </thead>
        <tr>
        <th><label>Kode Departemen</label></th><td><input type="text" class="int" name="kddept" maxlength="3" id="kddept"/></td><td colspan="5"><span id="kddept"></span></td>
    </tr>
    <tr>
     <th><label>Kode Eselon 1</label></th><td><input type="text" name="kdunit"  class="int" maxlength="2" id="kdunit"/></td><td colspan="5"><span id="kdunit"></span></td>
    </tr>
    <tr>
     <th><label>Kode Satker</label></th><td><input type="text" name="kdsatker"  class="int" maxlength="6" id="kdsatker"/></td><td colspan="5"><span id="kdsatker"></span></td>
    </tr>
        <tr>
            <th>Jenis Satker</th>
            <td><input type="radio" name="dekon" id="dekon" value="KP"/>Kantor Pusat</td>
            <td><input type="radio" name="dekon" id="dekon" value="KD"/>Kantor Daerah</td>
            <td><input type="radio" name="dekon" id="dekon" value="DK"/>Dekonsentrasi</td>
            <td><input type="radio" name="dekon" id="dekon" value="TP"/>Tugas Pembantuan</td>
            <td><input type="radio" name="dekon" id="dekon" value="UB"/>Urusan Bersama</td>
        </tr>
        <tr>
            <th>Tgl Awal</th>
            <td ><input type="text" name="tgl_awal" id="tgl_awal" /></td>
            <th>Tgl Akhir</th>
            <td><input type="text" name="tgl_akhir" id="tgl_akhir" /></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th>Jenis Rekonsiliasi</th>
            <td colspan="6" >
                <select id="jenis_rekon">
<!--                    <option value="1">Realisasi Belanja</option>
                    <option value="2">Realisasi Pengembalian Belanja</option>
                    <option value="3">Realisasi Pendapatan Non Pajak</option>
                    <option value="4">Realisasi Pendapatan Pajak</option>
                    <option value="5">Realisasi Penerimaan Pembiayaan</option>
                    <option value="6">Realisasi Pengeluaran Pembiayaan</option>
                    <option value="7">Realisasi Mutasi Uang Persediaan</option>-->
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="7"><input type="submit" id="cek_rekon" value="Cek"/></td>
        </tr>
    </table>
</form>

<script type="text/javascript" src="js/cek_rekon_admin.js"></script>
<div id="loader" style="display:none;">
    <br />
    <img src="img/loader.gif" alt="loader" />
    <div class="message"></div>   
</div>
<div class="error" id="loader2"></div>
<div id="rekon_sakpa">
    <pre>Hasil Rekonsiliasi Saldo</pre>
    <table id="hasil_rekon">
        <thead>
            <tr>
            <th>KDPERK</th>
            <th>KDBAES1</th>
            <th>KDSATKER</th>
            <th>JNSDOK1</th>
            <th>TGLDOK1</th>
            <th>NODOK1</th>
            <th>RPSAU</th>
            <th>RPSAI</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>