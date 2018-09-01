<?php


if (!function_exists("current_is")) {
    /**
     * 判断路由
     * @return bool
     */
    function current_is($name)
    {
        $is = false;
        $route = \Illuminate\Support\Facades\Route::current();
        if ($route->getName() == $name) {
            $is = true;
        }
        return $is;
    }
}


if (!function_exists("cdn")) {
    /**
     * 拼接云储存的地址
     * @param $name
     * @param string $prot
     * @return string
     */
    function cdn($name, $prot = '')
    {
        $domain = config('filesystems.disks.qiniu.domains.https');
        $protocol = !empty($prot) ? $prot : config('filesystems.disks.qiniu.protocol');
        $url = sprintf("%s://%s/%s", $protocol, $domain, $name);
        return $url;
    }
}


if (!function_exists("bloginfo")) {
    /**
     * 读取动态配置
     * @param $name
     * @param bool $clear
     * @return string
     */
    function bloginfo($name, $clear = false)
    {
        // $options = cache('options');
        // if (empty($options) || $clear) {
        //     cache()->forget('options');
        //     $expiresAt = \Carbon\Carbon::now()->addMinutes(1440);
        //     $optionsList = \Models\Options::orderBy('id')->select('option_name', 'option_value')->get()->toArray();
        //     foreach ($optionsList as $key => $option) {
        //         $options[strtolower($option['option_name'])] = $option['option_value'];
        //     }
        //     cache(['options' => $options], $expiresAt);
        // }
        // return isset($options[$name]) ? $options[$name] : '';
    }
}


if (!function_exists('msubstr')) {
    /**
     * 字符串截取
     * @param           $str
     * @param int $start
     * @param           $length
     * @param string $charset
     * @param bool|true $suffix
     * @return string
     * @author Mr.Cong <i@cong5.net>
     */
    function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        return $suffix ? $slice . '...' : $slice;

    }
}


if (!function_exists("get_description")) {
    /**
     * 根据文章ID截取描述
     * @param $id
     * @param int $word
     * @return string
     * @author Mr.Cong <i@cong5.net>
     */
    function get_description($content, $word = 210)
    {
        if (empty($content)) {
            return '...';
        }
        $description = msubstr(strip_tags($content), 0, $word);
        return $description;
    }
}


if (!function_exists("transferMonth")) {
    /**
     * 英文月份解析
     * @param $zhDate
     * @return string
     */
    function transferMonth($zhDate)
    {
        $month = [
            '一月' => 'Jan',
            '二月' => 'Feb',
            '三月' => 'Mar',
            '四月' => 'Apr',
            '五月' => 'May',
            '六月' => 'Jun',
            '七月' => 'Jul',
            '八月' => 'Aug',
            '九月' => 'Sep',
            '十月' => 'Oct',
            '十一月' => 'Nov',
            '十二月' => 'Dec',
        ];
        $zhMonth = explode(' ', $zhDate);
        return sprintf("%s %s %s", $month[$zhMonth[0]], $zhMonth[1], $zhMonth[2]);
    }
}

if (!function_exists("getcurl")) {
    /**
     * 模拟访问
     * @param $url
     * @return string
     */
    function getcurl($url)
    {
        $headerArray =array("Content-type:application/json;","Accept:application/json");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}

if (!function_exists("dealjson")) {
    /**
     * 模拟访问
     * @param $url
     * @return string
     */
    function dealjson($json)
    {
        $data = [];
        $json = str_replace(PHP_EOL, '', $json);
        $json = str_replace('"', '', $json);
        $json = str_replace(" ", '', $json);
        $json = str_replace("}", '', $json);
        $json = str_replace("{", '', $json);
        $first = explode(':',$json);
        for ($i= 1; $i < count($first); $i++) { 
            $second = explode(',',$first[$i]);
            array_unshift($data,$second[0]);
        }
        return array_reverse($data);
    }
}

if (!function_exists("getweather")) {
    /**
     * 模拟访问
     * @param $url
     * @return string
     */
    function getweather()
    {
        $url = 'https://apis.map.qq.com/ws/location/v1/ip?key=BOEBZ-FWXCW-BJARZ-RYP33-2PWN5-XOBF4';
        $json =getcurl($url);
        $json = dealjson($json);
        $lat=$json[5];
        $lon=$json[6];
        $address_url = 'https://apis.map.qq.com/ws/geocoder/v1/?location='.$lat.','.$lon.'&key=BOEBZ-FWXCW-BJARZ-RYP33-2PWN5-XOBF4&get_poi=1';
        $weather_url = 'http://m.weather.com.cn/d/town/index?lat='.$lat.'&lon='.$lon;
        $html = getcurl($weather_url);
        $address = getcurl($address_url);
        $address = json_decode($address);
        $html = preg_replace("/[\t\n\r]+/","",$html);//去掉特殊字符
        $pattern_1 = '/<span>-?[1-9]\d*<\/span><b>°<\/b><em>.*?<\/em>/';
        $pattern_2 = '/<span class="flfx iconli">.*?<\/span>\s*<span class="xdsd iconli">.*?<\/span>/';
        preg_match_all($pattern_1,$html,$result_1); 
        preg_match_all($pattern_2,$html,$result_2);
        $result_1 = preg_replace("/\s+/","",$result_1[0]);
        $result_2 = preg_replace("/\s+/","",$result_2[0]);
        $split_1 = explode('</span>',$result_1[0]);
        $data['temp'] = str_replace('<span>', '',$split_1[0]);
        $split_2 = explode('<em>',$split_1[1]);
        $data['weather'] = str_replace('</em>', '',$split_2[1]);
        $split_3 = explode('</span>',$result_2[0]);
        $data['wind'] = str_replace('<spanclass="flfxiconli">','',$split_3[0]);
        $data['wet'] = str_replace('<spanclass="xdsdiconli">相对湿度','',$split_3[1]);
        $data['wet'] = str_replace('%','',$data['wet']);
        $data['address'] = $address->result->address;
        return $data;
    }
}
