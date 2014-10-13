<?php

class DirectoryController extends Controller
{
    public function actionIndex()
    {
        $list = Yii::app()->ldap->user()->all_valid();
        $this->render('index', array('list' => $list));
    }
    public function actionVcf()
    {
        $tmp_dir = "/tmp/";
        $fileName = "/tmp/vcf.zip";
        $i = 0;
        $zip = new ZipArchive();

        if ($zip->open($fileName, ZIPARCHIVE::OVERWRITE) !== true) {

            exit('1');
        }

        foreach (Yii::app()->ldap->user()->all_valid() as $person) {
            if (!isset($person['telephonenumber'])) {
                continue;
            }

            $i++;
            if ($i > 5) {
                // break;
            }
            $fileName_vcf = $tmp_dir . $person['displayname'] . '.vcf';
            $f = fopen($fileName_vcf, 'w');

            fwrite($f, "BEGIN:VCARD\r\n");
            fwrite($f, "VERSION:2.1\r\n");
            fwrite($f, "FN;ENCODING=QUOTED-PRINTABLE;CHARSET=utf-8:" .
                quoted_printable_encode($person['displayname']) . "\r\n");
            fwrite($f, "N;ENCODING=QUOTED-PRINTABLE;CHARSET=utf-8:;" .
                quoted_printable_encode($person['displayname']) . ";;;\r\n");
            fwrite($f, "TEL;CELL:+38" . str_replace(array(" ", "-"), "", $person['telephonenumber']) .
                "\r\n");
            if (isset($person['mail'])) {
                fwrite($f, "EMAIL:" . $person['mail'] . "\r\n");
            }
            fwrite($f, "X-CATEGORIES:AVMG\r\n");
            fwrite($f, "END:VCARD\r\n");
            fclose($f);
            // QRcode::png(file_get_contents($fileName_vcf), drupal_get_path('module', 'directory') .'/phpqrcode/qr/'.$person['mail'].'.png', 'L', 4, 2);
            $zip->addFile($fileName_vcf, basename($fileName_vcf));


            //header("Content-disposition: filename=avmg.vcf");
            //header("Content-type: text/x-vcard");
            //header("Pragma: no-cache");
            //header("Expires: 0");
            //$i=0;


        }
        $zip->close();

        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Pragma: no-cache");
        header("Content-Length: " . filesize($fileName));
        header("Content-Disposition: attachment; filename=" . basename($fileName));
        readfile($fileName);
        exit;
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
    // return the filter configuration for this controller, e.g.:
    return array(
    'inlineFilterName',
    array(
    'class'=>'path.to.FilterClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }

    public function actions()
    {
    // return external action classes, e.g.:
    return array(
    'action1'=>'path.to.ActionClass',
    'action2'=>array(
    'class'=>'path.to.AnotherActionClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }
    */
}
