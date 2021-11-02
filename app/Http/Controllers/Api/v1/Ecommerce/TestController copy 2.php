<?php

namespace App\Http\Controllers\Api\v1\Ecommerce;

use App\Models\Post;
use App\Models\Ecommerce\Item;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function submit(Request $request) {
        $data = [
            10 => [
                'title' => 'Tričko Jawa Kývačka',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem Jawa Kývačka ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem Jawa Kývačka - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko Jawa Kývačka',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem Jawa Kývačka ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, kývačka, jawa kývačka',
                'term' => 1,
            ],11 => [
                'title' => 'Tričko Jawa Panelka',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem Jawa Panelka ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem Jawa Panelka - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko Jawa Panelka',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem Jawa Panelka ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, panelka, jawa panelka, jawa 250',
                'term' => 1,
            ],13 => [
                'title' => 'Tričko Jawa 350/634 Konopnice',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem Jawa 350/634 Konopnice ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem Jawa 350/634 Konopnice - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko Jawa 350/634 Konopnice',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem Jawa 350/634 Konopnice ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, konopnice, jawa konopnice, jawa 350, jawa 350/634, 350/634',
                'term' => 1,
            ],16 => [
                'title' => 'Tričko Jawa 500 OHC',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem Jawa 500 OHC ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem Jawa 500 OHC - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko Jawa 500 OHC',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem Jawa 500 OHC ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, jawa 500, jawa 500 ohc, 500 ohc',
                'term' => 1,
            ],17 => [
                'title' => 'Tričko ČZ 175/501 Prase',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem ČZ 175/501 Prase ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem ČZ 175/501 (502, 505) Prase - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko ČZ 175/501 Prase',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem ČZ 175/501 Prase ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, čz, čezeta, čz 175, čz 501, čz 502, čz 505, čz 175/501, 175/501, tričko čezeta, tričko čz',
                'term' => 1,
            ],18 => [
                'title' => 'Tričko ČZ 125/476, 175/477',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem ČZ 125/476, 175/477 ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem ČZ 125/476, 175/477 - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko ČZ 125/476, 175/477',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem ČZ 125/476, 175/477 ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, čz, čezeta, čz 175, čz 125, čz 476, čz 477, 125/476, 175/477, tričko čezeta, tričko čz',
                'term' => 1,
            ],19 => [
                'title' => 'Tričko ČZ 125/487, 175/488',
                'teaser' => 'Černé tričko s krátkým rukávem a s motivem ČZ 125/487, 175/488 ze 100% bavlny. Tisknuto kvalitním sítotiskem. Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.',
                'value' => '<p>Černé bavlněné tričko s motivem ČZ 125/487, 175/488 - legendární motorkou z 20. století, která si získala nadšence napříč všemi generacemi. Motiv je tištěn pomocí technologie sítotisku, díky čemuž je potisk kvalitnější. Motivy jsou detailnější a taky v lepším rozlišení. </p><br><p>Trika mají krátký rukáv, kulatý výstřih a jsou unisex – vhodná jak pro muže, tak i pro ženy. Látka je ze 100% bavlny a díky vyšší gramáži je pevnější a odolnější.</p><br><p>Vhodné jako dárek pro vás či Vaše blízké. Zkrátka pro všechny, kteří ocení kvalitu a originalitu.</p>',
                'post_seo_title' => 'Tričko ČZ 125/487, 175/488',
                'post_seo_description' => 'Černé tričko s krátkým rukávem a s motivem ČZ 125/487, 175/488 ze 100% bavlny.',
                'post_seo_keywords' => 'jawa, jawa tričko, jawa dárek, čz, čezeta, čz 175, čz 125, čz 487, čz 488, 125/487, 175/488, tričko čezeta, tričko čz',
                'term' => 1,
            ]
        ];

        foreach($data as $item) {
            $post = Post::create([
                'collection_name' => 'product',
                'status' => 'published',
                'tmp' => 0
            ]);
            $post->versions()->create([
                'name' => 'main',
                'label' => 'Hlavní verze',
            ]);
            $post->locales()->create([
                'locale_name' => 'cs',
                'post_title' => $item['title'],
                'post_slug' => Str::slug($item['title'], '-'),
                'post_teaser' => $item['teaser'],
                'post_custom_teaser' => 1,
                'post_value' => $item['value'],
                'post_seo_title' => $item['post_seo_title'],
                'post_seo_description' => $item['post_seo_description'],
                'post_seo_keywords' => $item['post_seo_keywords'],
                'version_name' => 'main',
            ]);
            $post->terms()->sync([$item['term']]);

            if($item['term'] == 1) {
                $buy_price = 105;
                $price = 329.00;
                $priceEur = 12.99;
            }elseif($item['term'] == 2) {
                $buy_price = 350;
                $price = 699.00;
                $priceEur = 27.49;
            }else {
                $buy_price = 100;
                $price = 199.00;
                $priceEur = 7.99;
            }

            $sizes = ['S','M','L','XL','2XL','3XL'];

            foreach($sizes as $size) {
                $item = Item::create([
                    'post_id' => $post->id,
                    'sub_name' => $size,
                    'weight' => '0.124',
                    'weight_unit' => 'kg',
                    'width' => 0,
                    'width_unit' => 'cm',
                    'height' => 0,
                    'height_unit' => 'cm',
                    'depth' => 0,
                    'depth_unit' => 'cm',
                    'buy_price' => $buy_price,
                    'buy_price_unit' => 'Kč',
                    'quantity' => 10,
                    'active' => 1
                ]);
                $item->currencies()->create([
                    'locale_name' => 'cs',
                    'price' => $price,
                    'price_VAT' => $price,
                    'VAT' => 0,
                    'active' => 1
                ]);
                $item->currencies()->create([
                    'locale_name' => 'sk',
                    'price' => $priceEur,
                    'price_VAT' => $priceEur,
                    'VAT' => 0,
                    'active' => 1
                ]);
            }
        }
    }
}