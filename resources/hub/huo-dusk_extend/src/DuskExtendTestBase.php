<?php
namespace Huojunhao\DuskExtend;
use Facebook\WebDriver\Exception\WebDriverCurlException;
use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase;

/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2019/5/12
 * Time: 16:49
 */

abstract  class DuskExtendTestBase extends TestCase {

    protected $domain;
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);



        Browser::macro('clickAndDelay',function($selector,$pause=0.5){
            $pause = $pause * 1000;
            $this->click($selector)
                ->pause($pause);
            return $this;
        });



        Browser::macro('clickAndAssertDownload',function($selector,$pause=0.5){
            $old_window_count = count($this->driver->getWindowHandles());
//            dump($old_window_count);

            $this->clickAndDelay($selector,$pause);
          $new_window_count = count($this->driver->getWindowHandles());
//            dump($new_window_count);
            $this->assertTrue($old_window_count == $new_window_count);
            return $old_window_count == $new_window_count;
        });


        $domain = $this->domain;
        Browser::macro('visitAndDelay',function($url,$pause=0.5)use($domain){
            $pause = $pause * 1000;
//            dump($pause);
            $domain && $url = $domain.$url;
            try {
                $this->visit($url)
                    ->pause($pause)
                    ->ensureJquery()
                    ->pause(100);
            } catch (WebDriverCurlException $curlException) {
                dump($curlException->getMessage());
                $this->delay(20);
            }

            return $this;
        });

        Browser::macro('delay',function($pause=0.5){
            $pause = $pause * 1000;
            $this->pause($pause);
            return $this;
        });

        Browser::macro('ensureJquery',function(){
            if ($this->driver->executeScript("return window.jQuery == null")) {

                $s =  file_get_contents(__DIR__.'/bin/jquery.js');
                $this->driver->executeScript($s);
                $js = "window.$=window.jQuery";
                $this->driver->executeScript($js);

            }

            return $this;

        });
        Browser::macro('getBatchAttr',function($selector,$attr_name){

            $js = <<<DDD
            var arr = [];
$('$selector').each(function(key,value){
    arr.push($(this).attr('$attr_name'));
})
return arr;

DDD;
            $res = $this->driver->executeScript($js);
            return $res;
        });

        Browser::macro('getBatchContent',function($selector,$type='html'){

            $js = <<<DDD
            var arr = [];
$('$selector').each(function(key,value){
    arr.push($(this).$type());
})
return arr;

DDD;
            $res = $this->driver->executeScript($js);
            return $res;
        });

        Browser::macro('html',function($selector,$content=''){
            if($content){
                $js = <<<DDD
return $('$selector').html('$content');
DDD;
            }else{
                $js = <<<DDD
return $('$selector').html();
DDD;
            }

            return $this->driver->executeScript($js);

        });


        Browser::macro('print',function($url,$download_dir,$hide_arr=[],$pause=0){

            $this->visitAndDelay($url);
//            $this->pause(1000);
            $driver = $this->driver;
            $js = '';
            foreach ($hide_arr as $item) {
                $js .= <<<DDD
$("$item").hide();
DDD;
            }
            $js && $driver->executeScript($js);


//        $browser->pause(5000);
            $py = new Win32PY();
//            dump(33);
            $py->press("Control","P");//打印
            if ($pause == 0) {
                //等于0则自已算
                $body = $this->text('');
                $total = ceil(strlen($body)/1500);
                $pause = $total >6 ? $total: 6;

            }
            $this->pause($pause*1000);
            $py->enter();//确定后台弹出输入文件框，此时应输入文件名
            $this->pause(1000);
            $py->enter();
            $this->pause(500);
            $py->enter();
            $this->pause(2000);
            $py->esc();
            //将文件重命名，避免后边的冲突
            $files = FileUtil::allFile($download_dir);
            $res = $download_dir . $files[0];
            $base =  base_path("/browserout/");
            $des = $base . time() . ".pdf";
            dump($download_dir . $files[0]);

            FileUtil::move($res,$des);
            $this->pause(1000);

//            //URL 写过的存入缓存
//            $cache[] = $url;
//            cache(["daily_wechat_doc_url_visited" => $cache],Carbon::now()->addMinutes(60000));
//            dump(cache("daily_wechat_doc_url_visited"));
//
//            $once===0 ? :  die;
        });



        Browser::macro('joinHtmlsAndWaitToPrint',function($selector,$url_arr=[],$hidden_selectors=[],$remove_selectors=[]){
            $html = "";
            foreach ($url_arr as $item) {
                $html .= $this->visitAndDelay($item)->html($selector);
            }
            $html = str_replace("\n", '', $html);
            $html = addslashes($html);

            $html = str_replace('<code>', "<div>", $html);
            $html = str_replace('</code>', "</div>", $html);

            $this->html($selector, $html);
//
            foreach ($hidden_selectors as $hidden_selector) {
                $js = <<<DDD
$('$hidden_selector').hide();
DDD;
                $this->driver->executeScript($js);

            }
            foreach ($remove_selectors as $remove_selector) {
                $js = <<<DDD
$('$remove_selector').remove();
DDD;
                $this->driver->executeScript($js);

            }

            $this->delay(1);
            return $html;
        });



        Browser::macro('select2',function($name,$value){
            $js = <<<DDD
$('[name="$name"]').val($value).select2()
DDD;
            $this->driver->executeScript($js)
            ;
            $this->delay(1);
            return $this;
        });

        Browser::macro('currentFullUrl',function(){
            $js = <<<DDD
return location.href;
DDD;
           $url = $this->driver->executeScript($js);
           return $url;
        });


        Browser::macro('assertTrue', function ($bool) {
            \PHPUnit\Framework\Assert::assertTrue($bool);
        });


        Browser::macro('switchToNewWindow', function () {
            $driver = $this->driver;
            $handles = $driver->getWindowHandles();
            $driver->switchTo()->window(end($handles));
            return $this;
        });

        Browser::macro('switchToBackWindow', function () {
            $driver = $this->driver;
            $handles = $driver->getWindowHandles();
            $driver->switchTo()->window($handles[count($handles)-2]);
            return $this;
        });


    }

}
