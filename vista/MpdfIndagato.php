<?php


/**
 * Class HtmlIndagato
 * La classe si occupa delle operazioni di visualizzazione dei dati relativi agli indagati
 */
class MpdfIndagato
{
    private $StyleTdDetttaglio = "style='font-size: 8pt;'";
    private $StyleTdHash = "style='font-size: 8pt; text-align: left;'";
    private $StyleTdColTitle = "style='background: #003c78; color:white; font-family: Arial; font-size:9pt; color:white;'";

    /**
     * Visualizza l'intestazione del REPORT di supporto alla creazione del DOCX di un determinato indagato
     * @param $ind_cognome
     * @param $ind_nome
     */
    public function HTML_REPORT_header_mpdf($ind_cognome, $ind_nome){
        $html = "<html>
            <head>
                <title>$ind_cognome $ind_nome</title>
                <style>
                    body {background: white;}
                        p {color: black;}
                            table
                            {
                                width: 695px;
                                border: solid thin #333333;
                                border-collapse: collapse;
                                
                            }
                            thead, tr, th, b
                            {
                                font-family: Arial;
                            }
                            td{
                                font-family: Arial;
                                border: solid thin #333333;
                                text-align: center;
                                padding: 7px;
                            }
                            pre{
                            word-wrap: break-word;
                            white-space: pre-line;
                            width: 680px;
                            font-size: 8pt;
                            }

                </style>
            </head>
        <body>";
        return $html;
    }

    /**
     * Visualizza l'intestazione della pagina del REPORT PDF di un indagato
     * @param $titolo
     */
    public function HTML_REPORT_page_header_mpdf($titolo)
    {
        $html = "
        <table>
                <tbody>
                    <tr>
                        <td style='width: 160px;'>Computer Forensics Case Manager</td>
                        <td style='width: 395px;'><center><b style='font-size: 14pt'>$titolo</b></center></td>
                        <td style='width: 140px;'><img src='images/logo.png' width='100px' align='left'></td>
                    </tr>
                </tbody>
            </table>
            <br>";
        return $html;
    }


    /**
     * Visualizza le informazioni di prima pagina del report di un indagato
     * @param $ca_num
     * @param $ca_tipo
     * @param $ind_titolo
     * @param $ind_cognome
     * @param $ind_nome
     * @param $cli_nome
     * @param $cli_citta
     * @param $pm_titolo
     * @param $pm_cognome
     * @param $pm_nome
     * @param $ctu
     */
    public function HTML_REPORT_info_mpdf($ca_num, $ca_tipo, $ind_titolo, $ind_cognome, $ind_nome, $cli_nome, $cli_citta, $pm_titolo, $pm_cognome, $pm_nome, $ctu)
    {
        $html = "
        <table>
            <tbody>
                <tr>
                    <td style='text-align: left;'><strong>Numero del Caso:</strong><br>$ca_num</td>
                    <td colspan='2' style='text-align: left;'><strong>$ind_titolo</strong><br>$ind_cognome $ind_nome</td>
                </tr>
                <tr>
                    <td style='text-align: left;'><strong>Cliente</strong><br>$cli_nome</td>
                    <td colspan='2' style='text-align: left;'><strong>Contatto Cliente</strong><br>";
        if($_SESSION['cli_type'] == 'P'){$html .='PM'. $pm_titolo. " " . $pm_cognome . " " . $pm_nome;}else{$html .= $pm_titolo. " " .$pm_cognome. " " .$pm_nome;}
        "</td>
                </tr>
                <tr>
                    <td style='text-align: left;'><strong>Luogo</strong><br>$cli_citta</td>";
        if($_SESSION['cli_type']=='P'){$html .= "<td style='text-align: left;'><strong>C.T.U.</strong><br>$ctu</td>";};
        if($_SESSION['cli_type']=='T'){$html .= "<td style='text-align: left;'><strong>Perito</strong><br>$ctu</td>";};
        if($_SESSION['cli_type']=='C'){$html .= "<td style='text-align: left;'><strong>C.T.P.</strong><br>$ctu</td>";};
        $html .= "<td style='text-align: left;'><strong>Tipo di Investigazione</strong><br>$ca_tipo</td>
                </tr>
            </tbody>
        </table>";
        return $html;
    }


    public function HTML_REPORT_dettaglio_host_mpdf($ho_etichetta, $ho_modello, $ho_seriale, $ho_pwd, $ho_pwd_used, $ho_tipo)
    {
        $html = "
        <table>
                <tbody>
                    <tr>
                        <td $this->StyleTdColTitle>ID Host</td>
                        <td $this->StyleTdColTitle>Tipo</td>
                        <td $this->StyleTdColTitle>Modello</td>
                        <td $this->StyleTdColTitle>Nr. Seriale</td>
                        <td $this->StyleTdColTitle>Password</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdDetttaglio>" . $ho_etichetta . "</td>
                        <td $this->StyleTdDetttaglio>" . $ho_tipo . "</td>
                        <td $this->StyleTdDetttaglio>" . $ho_modello . "</td>
                        <td $this->StyleTdDetttaglio>" . $ho_seriale . "</td>";
        if($ho_pwd_used == 0){$html .= "<td align='center'>" . $ho_pwd . "</td>";}
        if($ho_pwd_used == 1){$html .= "<td align='center'>" . $ho_pwd . "&nbsp;&nbsp;" . "<img src='font/icon/check.png' style='height: 12px;'> </td>";}
        $html .= "       </tr>
                    </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_dettaglio_host_special_mpdf($ho_etichetta, $ho_modello, $ho_seriale, $ho_tipo)
    {
        $html="
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr>
                        <td $this->StyleTdColTitle>ID Host</td>
                        <td $this->StyleTdColTitle>Tipo</td>
                        <td $this->StyleTdColTitle>Modello</td>
                        <td $this->StyleTdColTitle>Nr. Seriale</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdDetttaglio>" . $ho_etichetta . "</td>
                        <td $this->StyleTdDetttaglio>" . $ho_tipo . "</td>
                        <td $this->StyleTdDetttaglio>" . $ho_modello . "</td>
                        <td $this->StyleTdDetttaglio>" . $ho_seriale . "</td>";
        $html.="       </tr>
                    </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_descrizione_host_mpdf($Info, $HostsSpecial, $ho_id, $ho_spec_id)
    {
        $html = "
        <p align='center' style='font-family: Arial; font-size: 14pt;'><b>Descrizione Host</b></p>
        <table border='1' cellpadding='7px'>
        <tbody>
            <tr>
                <td $this->StyleTdColTitle>ID Host</td>
                <td $this->StyleTdColTitle>Tipo</td>
                <td $this->StyleTdColTitle>Modello</td>
                <td $this->StyleTdColTitle>Seriale</td>
            </tr>";
        foreach($Info as $row){
            if ($row['ho_id'] != $ho_id) {
                $html .= "<tr>
                            <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                            <td $this->StyleTdDetttaglio>" . $row['ho_tipo'] . "</td>
                            <td $this->StyleTdDetttaglio>" . $row['ho_modello'] . "</td>
                            <td $this->StyleTdDetttaglio>" . $row['ho_seriale'] . "</td>
                         </tr>";
                $ho_id = $row['ho_id'];
            }
        }
        // Imposto ho_id a null siccome nel DETTAGLIO HOST ci sarà un nuovo controllo sugli ho_id per non stampare duplicati
        $ho_id = null;
        if($HostsSpecial != 0) {

            foreach ($HostsSpecial as $row) {
                if ($row['ho_id'] != $ho_spec_id) {
                    $html .= "
                            <tr>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_tipo'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_modello'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                    $ho_spec_id = $row['ho_id'];
                }
            }
        }
        $html .="
        </tbody>
     </table>";
        return $html;
    }


    public function HTML_REPORT_descrizione_media_mpdf($arr, $HostsSpecial)
    {
        $html = "
        <p align='center' style='font-family: Arial; font-size:14pt;' xmlns=\"http://www.w3.org/1999/html\"><b>Descrizione Media</b></p>
        <table border='1' cellpadding='7px'>
    <thead>
    </thead>
    <tbody>
        <tr>
            <td $this->StyleTdColTitle>Host</td>
            <td $this->StyleTdColTitle>Evidence</td>
            <td $this->StyleTdColTitle>Modello</td>
            <td $this->StyleTdColTitle>Dim.</td>
            <td $this->StyleTdColTitle>Nr. Seriale</td>
        </tr>";
        $IdEvi = 0;
        $ho_spec_id = 0;
        foreach($arr as $row){
            if($IdEvi != $row['evi_id']) {
                $html .= "<tr>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_modello'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_dimensione'] . " " . $row['evi_kbmbgbtb'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_seriale'] . "</td>
                     </tr>";
                $IdEvi = $row['evi_id'];
            }
        }

        if($HostsSpecial != 0) {
            foreach ($HostsSpecial as $row) {
                if ($row['ho_id'] != $ho_spec_id) {
                    $html .= "
                            <tr>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_modello'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_dimensione'] . " " . $row['ho_kbmbgbtb'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                    $ho_spec_id = $row['ho_id'];
                }
            }
        }
        $html .="
    </tbody>
</table>";
        return $html;
    }


    public function HTML_REPORT_dettaglio_evidence_mpdf($ho_etichetta, $evi_etichetta, $evi_tipo, $evi_modello, $evi_seriale, $evi_pwd, $evi_pwd_used, $evi_dimensione, $evi_kbmbgbtb)
    {
        $html = "
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr>
                        <td $this->StyleTdColTitle>ID Host</td>
                        <td $this->StyleTdColTitle>Evidence</td>
                        <td $this->StyleTdColTitle>Tipo</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdDetttaglio>" . $ho_etichetta . "</td>
                        <td $this->StyleTdDetttaglio>" . $evi_etichetta . "</td>
                        <td $this->StyleTdDetttaglio>" . $evi_tipo . "</td>
                    </tr>


                    <tr>
                        <td $this->StyleTdColTitle>Modello</td>
                        <td $this->StyleTdColTitle>Seriale</td>
                        <td $this->StyleTdColTitle>Dimensione</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdDetttaglio>" . $evi_modello . "</td>
                        <td $this->StyleTdDetttaglio>" . $evi_seriale . "</td>
                        <td $this->StyleTdDetttaglio>" . $evi_dimensione . $evi_kbmbgbtb . "</td>
                    </tr>";

        if($evi_tipo == 'SimCard'){
            $html.="<tr>
                                <td $this->StyleTdColTitle>Password</td>
                             </tr>
                             <tr>";
            if($evi_pwd_used == 0){$html.="<td $this->StyleTdDetttaglio>" . $evi_pwd . "</td>";};
            if($evi_pwd_used == 1){$html.="<td $this->StyleTdDetttaglio>" . $evi_pwd . "&nbsp;&nbsp;<img src='font/icon/check.png' style='height: 12px;'> </td>";}
            $html.="</tr>";
        }

        $html.="</tbody>
            </table>
            <br>
            <b style='font-family: Arial; font-size: 14pt;'>Note:</b>
            <table>
                <tbody>
                    <tr><td height='70px'></td></tr>
                </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_clone_mpdf($evi_etichetta, $clo_tipoacq, $clo_altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256)
    {
        $html="<table>
                <tbody>
                    <tr>
                        <td $this->StyleTdColTitle>Evidence</td>
                        <td $this->StyleTdColTitle>Tipo Acquisizione</td>
                        <td $this->StyleTdColTitle>Strumento</td>

                    </tr>
                    <tr>
                        <td $this->StyleTdDetttaglio>" . $evi_etichetta . "</td>";
        if($clo_tipoacq == "Altro")
        {
            $html.="<td $this->StyleTdDetttaglio>" . $clo_tipoacq . ": " . $clo_altro_tipo ."</td>";
        }
        else
        {
            $html.="<td $this->StyleTdDetttaglio>" . $clo_tipoacq . "</td>";
        }

        $html.="<td $this->StyleTdDetttaglio>" . $clo_stracq . "</td>
                    </tr>
                    </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td $this->StyleTdColTitle>Hash Generati</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdHash>MD5: $clo_md5</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdHash>SHA1: $clo_sha1</td>
                    </tr>
                    <tr>
                        <td $this->StyleTdHash>SHA256: $clo_sha256</td>
                    </tr>
                    </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_table_one_tr($stringa)
    {
        $html="<table>
                <tbody>
                    <tr>
                        <td $this->StyleTdColTitle>$stringa</td>
                    </tr>
                </tbody>
               </table>";
        return $html;
    }




}