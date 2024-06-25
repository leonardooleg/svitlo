<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use voku\helper\HtmlDomParser;
class GrafikController extends Controller
{
    public function cherga($cherga_id )
    {
        $url = 'https://energy-ua.info/cherga/' . $cherga_id . '/'; // Отримайте URL-адресу з запиту

        $htmlContent= HtmlDomParser::file_get_html($url);

        $styleElement = $htmlContent->find('style', 0); // Знайдіть перший елемент `<style>`
        if ($styleElement) {
            $cssStyles = $styleElement->outerHtml(); // Отримайте вміст елемента `<style>`
        }
        $jsElement = $htmlContent->find('script', 12); // Знайдіть перший елемент `<style>`
        if ($jsElement) {
            $jsScript = $jsElement->outerHtml(); // Отримайте вміст елемента `<style>`
        }

        $tables = $htmlContent->findMulti('.grafik_string')->innertext();
        $timer = $htmlContent->findOne('.countdown_info')->outerHtml();
        $clock_1_h = $htmlContent->findOne('.clocks .clock1 .hour')->outerHtml();
        $clock_1_m = $htmlContent->findOne('.clocks .clock1 .min')->outerHtml();
        $clock_2_h = $htmlContent->findOne('.clocks .clock2 .hour')->outerHtml();
        $clock_2_m = $htmlContent->findOne('.clocks .clock2 .min')->outerHtml();

        return view('cherga', [
            'cherga_id' => $cherga_id,
            'htmlContent' => implode("",$tables),
            'cssStyles' => $cssStyles,
            'jsScript' => $jsScript,
            'timer' => $timer,
            'clock_1_h' => $clock_1_h,
            'clock_1_m' => $clock_1_m,
            'clock_2_h' => $clock_2_h,
            'clock_2_m' => $clock_2_m,
        ]);
    }
}
