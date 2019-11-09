<?php

namespace App\Console\Commands\Daily;

use DOMDocument;
use Huojunhao\Lib\Base\FileUtil;
use Huojunhao\Lib\Base\FormatConversion;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use XMLWriter;

class PrimaryTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dl:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '主要测试';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jmeter_xml = file_get_contents(base_path("test.jmx"));
        $doc = new DOMDocument();
        $doc->loadXML($jmeter_xml);

        dd($doc);

        $r = simplexml_load_string($jmeter_xml, 'SimpleXMLElement', LIBXML_NOCDATA);
//        $r->hashTree->TestPlain->attributes("testname") = "haha改改试试";
        $res = $r->hashTree->TestPlain
            ->attributes();
        dd($res);
        $jmeter_arr = FormatConversion::xmlToArray($jmeter_xml);
        file_put_contents(base_path("test_new.jmx"),FormatConversion::arrayToXml($jmeter_arr));


//        dd($jmeter_arr);
        $res = array(
            'hello' => '11212',
            'world' => '232323',
            'array' => array(
                'test' => 'test',
                'b'    => array('c'=>'c', 'd'=>'d')
            ),
            'a' => 'haha'
        );
        $xml = new A2Xml();
        echo $xml->toXml($jmeter_arr);

        dd(1);

        $r =is_dir(null);
        dd($r);

        $str = "";
        $files = FileUtil::allFile(database_path('migrations'));
//        dd($files);
       $r = collect($files)->some(function($value)use ($str){
           dump($value);
           dump($str);
           return Str::contains($value, $str);
       });
        dd($r);
        dd(Str::snake('LaraAdminGenerator'));
        dd(config('admin.name'));
        throw new \Exception("haha");

    }


    protected function testArrToXml()
    {

    }


}




class A2Xml {
    private $version    = '1.0';
    private $encoding   = 'UTF-8';
    private $root       = 'jmeterTestPlan';
    private $xml        = null;
    function __construct() {
        $this->xml = new XmlWriter();
    }
    function toXml($data, $eIsArray=FALSE) {
        if(!$eIsArray) {
            $this->xml->openMemory();
            $this->xml->startDocument($this->version, $this->encoding);
            $this->xml->startElement($this->root);
        }
        foreach($data as $key => $value){
            if(is_array($value)){
                $this->xml->startElement($key);
                $this->toXml($value, TRUE);
                $this->xml->endElement();
                continue;
            }
            $this->xml->writeElement($key, $value);
        }
        if(!$eIsArray) {
            $this->xml->endElement();
            return $this->xml->outputMemory(true);
        }
    }
}



