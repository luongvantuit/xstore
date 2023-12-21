<!DOCTYPE html>
<?php
    require_once __DIR__ . "/../Common/Header.php";
    use XStore\Services\DetailService;
    use XStore\Services\ProductService;
    $products = new DetailService();
    try {
        $params = [
          'id' => $_GET['id'] ?? '',
          'color' => $_GET['color'] ?? ''
        ];
        $products = $products->getProperties($params);

        $product = $products[0];
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    ?>
<html lang="vi">
	<head>
    
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=2.0" name="viewport">
		
<link rel="stylesheet" href="./assets/css/detail/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="./assets/css/detail/style.css" type="text/css">

<link fetchpriority="high" href="./assets/js/plugins-jquery.js" rel="preload" as="script" type="text/javascript">
<link fetchpriority="high" href="./assets/js/file-sha256.min_3a36b086b03842bdb6ec4337db5e9e38.js" rel="preload" as="script" type="text/javascript">
<link fetchpriority="medium" href="//theme.hstatic.net/200000642007/1001179574/14/plugins-jquery-footer.js?v=73" rel="preload" as="script" type="text/javascript">
<link fetchpriority="medium" href="//theme.hstatic.net/200000642007/1001179574/14/jquery.fancybox.min.js?v=73" rel="preload" as="script" type="text/javascript">
<link fetchpriority="medium" href="//hstatic.net/0/0/global-api.jquery.js" rel="preload" as="script" type="text/javascript">

<script type="text/javascript" src="./assets/js/plugins-jquery.js"></script>
<script async type="text/javascript" src="./assets/js/file-sha256.min_3a36b086b03842bdb6ec4337db5e9e38.js"></script>
<script async type="text/javascript" src="./assets/js/plugins-jquery-footer.js"></script>
<script async type="text/javascript" src="./assets/js/jquery.fancybox.min.js"></script>
<script async type="text/javascript" src="./assets/js/global-api.jquery.js"></script>

<script>
	//checklh;
	var _0x4ad6=["\x43\x68\x72\x6F\x6D\x65","\x69\x6E\x64\x65\x78\x4F\x66","\x75\x73\x65\x72\x41\x67\x65\x6E\x74","\x6C\x65\x6E\x67\x74\x68","\x62\x72\x61\x6E\x64\x73","\x75\x73\x65\x72\x41\x67\x65\x6E\x74\x44\x61\x74\x61","\x62\x72\x61\x6E\x64","\x4C\x69\x67\x68\x74\x68\x6F\x75\x73\x65","\x69\x6E\x63\x6C\x75\x64\x65\x73"];let checklh=false;if(navigator[_0x4ad6[2]][_0x4ad6[1]](_0x4ad6[0])!=  -1){for(let i=0;i< navigator[_0x4ad6[5]][_0x4ad6[4]][_0x4ad6[3]];i++){let vl=navigator[_0x4ad6[5]][_0x4ad6[4]][i][_0x4ad6[6]];if(vl[_0x4ad6[8]](_0x4ad6[7])){checklh= true;break}}}
	window.productLoop = {};
	window.product = {};
</script>		
</head>
<main>
    <script>
	window.product_collect = [];
	product_collect.push({"available":true,"content":null,"description":" ","featured_image":"https://product.hstatic.net/200000642007/product/43sas_3atsm3033_1_65aba97fa6a745e0b48ec508cecfa8cd_214b9fa4577844c9b2d14be95ce31c18.jpg","handle":"","id":1046062449,"images":["https://product.hstatic.net/200000642007/product/43sas_3atsm3033_1_65aba97fa6a745e0b48ec508cecfa8cd_214b9fa4577844c9b2d14be95ce31c18.jpg","https://product.hstatic.net/200000642007/product/43sas_3atsm3033_2_3090b2f46067447ebfb65a2b8e979c98_3ba89dfbacd04886b91463b0596dc840.jpg","https://product.hstatic.net/200000642007/product/43sas_3atsm3033_3_f6927aa0e5894180b308a41b0ec5eaaf_1a3e00614e9e46bc96b29ae8103c61b2.jpg","https://product.hstatic.net/200000642007/product/43sas_3atsm3033_4_eefef79367704ef58de18e2936f16b71_ba4123189ec34dafb92f584cc32cbe88.jpg","https://product.hstatic.net/200000642007/product/43sas_3atsm3033_5_fd8502e7d7154d37a330f255bb964ebc_f9b5c33f0d24433ca6037267a821c6bc.jpg","https://product.hstatic.net/200000642007/product/43sas_3atsm3033_6_0a178fd39cfd4e5d908b0bba261b445b_73768de5fd1b4f7cb2fa691118353682.jpg","https://product.hstatic.net/200000642007/product/icon_43sas_3atsm3033_4c53b61c8a894d3c89fd5eeb08858a42_b88633869f674f6d95e0de1d7bee9bd4.jpg"],"options":["M&agrave;u s&#7855;c","K&iacute;ch th&#432;&#7899;c","Stylecode"],"price":179000000.0,"price_max":179000000.0,"price_min":179000000.0,"price_varies":false,"tags":["MALE","sizechart:aounisex","sub4:&Aacute;o thun","Unisex","N&#7919;","N&#7919;/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Qu&#7847;n &aacute;o","Unisex/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Nam/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","&Aacute;o","W13/23","&Aacute;o thun","sub3:&Aacute;o","FEMALE","UnisexMLB","Nam"],"template_suffix":null,"title":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","type":"&Aacute;o thun","url":"/products/mlb-ao-thun-unisex-co-tron-tay-ngan-monotive-overfit-3atsm3033-1","pagetitle":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","metadescription":"Ch&#7845;t li&#7879;u: 70% cotton, 30% polyesterKi&#7875;u d&aacute;ng &aacute;o thun phom overfit n&#259;ng &#273;&#7897;ngC&#7893; tr&ograve;n, tay ng&#7855;n tr&#7867; trungThi&#7871;t k&#7871; logo in n&#7893;i b&#7853;t &#7903; ng&#7921;c tr&aacute;i v&agrave; h&igrave;nh in l&#7899;n &#7903; m&#7863;t sauCh&#7845;t v&#7843;i m&#7873;m m&#7883;n, th&#7845;m h&uacute;t t&#7889;tXu&#7845;t x&#7913; th&#432;&#417;ng hi&#7879;u: H&agrave;n Qu&#7889;c","variants":[{"id":1102192795,"barcode":"8809903808056","available":true,"price":179000000.0,"sku":"100180719001_3ATSM3033","option1":"43SAS","option2":"L","option3":"3ATSM3033","options":["43SAS","L","3ATSM3033"],"inventory_quantity":20.0,"old_inventory_quantity":20.0,"title":"43SAS / L / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192796,"barcode":"8809903808049","available":true,"price":179000000.0,"sku":"100180719002_3ATSM3033","option1":"43SAS","option2":"M","option3":"3ATSM3033","options":["43SAS","M","3ATSM3033"],"inventory_quantity":33.0,"old_inventory_quantity":33.0,"title":"43SAS / M / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192798,"barcode":"8809903808032","available":true,"price":179000000.0,"sku":"100180719003_3ATSM3033","option1":"43SAS","option2":"S","option3":"3ATSM3033","options":["43SAS","S","3ATSM3033"],"inventory_quantity":30.0,"old_inventory_quantity":30.0,"title":"43SAS / S / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192799,"barcode":"8809903808063","available":true,"price":179000000.0,"sku":"100180719004_3ATSM3033","option1":"43SAS","option2":"XL","option3":"3ATSM3033","options":["43SAS","XL","3ATSM3033"],"inventory_quantity":7.0,"old_inventory_quantity":7.0,"title":"43SAS / XL / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192800,"barcode":"8809903808025","available":true,"price":179000000.0,"sku":"100180719005_3ATSM3033","option1":"43SAS","option2":"XS","option3":"3ATSM3033","options":["43SAS","XS","3ATSM3033"],"inventory_quantity":32.0,"old_inventory_quantity":32.0,"title":"43SAS / XS / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null}],"vendor":"MLB","published_at":"2023-04-11T16:00:00.305Z","created_at":"2023-04-09T14:12:57.505Z","not_allow_promotion":false});
	product_collect.push({"available":true,"content":null,"description":"","featured_image":"https://product.hstatic.net/200000642007/product/50bks_3atsm3033_1_79e073e4d9904275b43a36c81f979b41_866bffc0ad3b4db3a3ad34d029d2bc1c.jpg","handle":"","id":1046062450,"images":["https://product.hstatic.net/200000642007/product/50bks_3atsm3033_1_79e073e4d9904275b43a36c81f979b41_866bffc0ad3b4db3a3ad34d029d2bc1c.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_2_3bb3843beb714645a59d5cafd14b3913_482d5176c0574e1f9e115e641b2e209a.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_3_a6cf24d1e7db4120b5502dafd953ea24_39590e48587a4c3cba1d81bbc5c46ee6.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_4_93038bf9b68c4e1490a723251e6ae9d4_26fdaae333bf4b3a846e6835661f2bb4.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_5_b7f7345eabc444e4b5c7b9c79124ca17_24b4a7e2ae624851a8fef8be7a9492c3.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_6_0f93359ba44a4954be04eee2f5f5e5d0_e0a97aaa9de3456c90a156fb00479161.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_7_d4b7e913ca924aa882b22907a151aae8_0f5e8fcfdb554bbaad0fed517126414b.jpg","https://product.hstatic.net/200000642007/product/50bks_3atsm3033_8_3fd9011cbf594cc99a43612d67da4896_2095394d60c243c1ba4ed1eb96b4c0e9.jpg","https://product.hstatic.net/200000642007/product/icon_50bks_3atsm3033_825f1cdcc79a4c38afef54d5c4d1bdef_66c620ca1a6e40ca9eb9a5a03883ab00.jpg"],"options":["M&agrave;u s&#7855;c","K&iacute;ch th&#432;&#7899;c","Stylecode"],"price":179000000.0,"price_max":179000000.0,"price_min":179000000.0,"price_varies":false,"tags":["FEMALE","sub3:&Aacute;o","&Aacute;o thun","Nam","sizechart:aounisex","W13/23","Nam/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","N&#7919;/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","MALE","N&#7919;","Qu&#7847;n &aacute;o","UnisexMLB","Unisex/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Unisex","&Aacute;o","sub4:&Aacute;o thun","halloween2023"],"template_suffix":null,"title":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","type":"&Aacute;o thun","url":"/products/mlb-ao-thun-unisex-co-tron-tay-ngan-monotive-overfit-3atsm3033-2","pagetitle":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","metadescription":"Ch&#7845;t li&#7879;u: 70% cotton, 30% polyesterKi&#7875;u d&aacute;ng &aacute;o thun phom overfit n&#259;ng &#273;&#7897;ngC&#7893; tr&ograve;n, tay ng&#7855;n tr&#7867; trungThi&#7871;t k&#7871; logo in n&#7893;i b&#7853;t &#7903; ng&#7921;c tr&aacute;i v&agrave; h&igrave;nh in l&#7899;n &#7903; m&#7863;t sauCh&#7845;t v&#7843;i m&#7873;m m&#7883;n, th&#7845;m h&uacute;t t&#7889;tXu&#7845;t x&#7913; th&#432;&#417;ng hi&#7879;u: H&agrave;n Qu&#7889;c","variants":[{"id":1102192840,"barcode":"8809903808117","available":true,"price":179000000.0,"sku":"100180719006_3ATSM3033","option1":"50BKS","option2":"L","option3":"3ATSM3033","options":["50BKS","L","3ATSM3033"],"inventory_quantity":24.0,"old_inventory_quantity":24.0,"title":"50BKS / L / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192841,"barcode":"8809903808100","available":true,"price":179000000.0,"sku":"100180719007_3ATSM3033","option1":"50BKS","option2":"M","option3":"3ATSM3033","options":["50BKS","M","3ATSM3033"],"inventory_quantity":50.0,"old_inventory_quantity":50.0,"title":"50BKS / M / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192842,"barcode":"8809903808094","available":true,"price":179000000.0,"sku":"100180719008_3ATSM3033","option1":"50BKS","option2":"S","option3":"3ATSM3033","options":["50BKS","S","3ATSM3033"],"inventory_quantity":39.0,"old_inventory_quantity":39.0,"title":"50BKS / S / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192843,"barcode":"8809903808124","available":true,"price":179000000.0,"sku":"100180719009_3ATSM3033","option1":"50BKS","option2":"XL","option3":"3ATSM3033","options":["50BKS","XL","3ATSM3033"],"inventory_quantity":9.0,"old_inventory_quantity":9.0,"title":"50BKS / XL / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192844,"barcode":"8809903808087","available":true,"price":179000000.0,"sku":"100180719010_3ATSM3033","option1":"50BKS","option2":"XS","option3":"3ATSM3033","options":["50BKS","XS","3ATSM3033"],"inventory_quantity":43.0,"old_inventory_quantity":43.0,"title":"50BKS / XS / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null}],"vendor":"MLB","published_at":"2023-04-11T16:00:00.305Z","created_at":"2023-04-09T14:13:10.625Z","not_allow_promotion":false});
	product_collect.push({"available":true,"content":null,"description":"","featured_image":"https://product.hstatic.net/200000642007/product/50whs_3atsm3033_8_ee4d85aaac574215a7a5f1df4fc90335_e8f059cd7962403c8cee6607f7e10259.jpg","handle":"","id":1046062451,"images":["https://product.hstatic.net/200000642007/product/50whs_3atsm3033_8_ee4d85aaac574215a7a5f1df4fc90335_e8f059cd7962403c8cee6607f7e10259.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_1_37ef539a5b434f829c79ea6ec99642f9_01a646cb192c4f6ba87d1d2ae58c0813.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_2_35196ab311ce491fa51971771797dc2a_bc9f5cd88e6a4e1fa12b1fbc49981cb4.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_7_ab7633dd0f884d3b9e798d177823b503_f28465d851674ab4be13b7773347fc45.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_3_e06687a70cc44cf9835aee7de96c71c2_ba4015903bb44822a38c9799816f45d3.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_4_8c809912025e4952adf115e5a3615dda_64c34ff833724e50ac52af9497f600c1.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_5_75aa728fd01b407ea58f40e0d85c253a_4220b591d258437b91323dc64f1eec42.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_6_00a64f8318dd4ec7b0c1abd89f5b72af_e5e273f3c7084b13af3220bb21bd333f.jpg","https://product.hstatic.net/200000642007/product/icon_50whs_3atsm3033_f227ef38f9064ea389b2e7220c1cdabe_b4c44750685e494da169ac373867e762.jpg"],"options":["M&agrave;u s&#7855;c","K&iacute;ch th&#432;&#7899;c","Stylecode"],"price":179000000.0,"price_max":179000000.0,"price_min":179000000.0,"price_varies":false,"tags":["UnisexMLB","MALE","N&#7919;","Nam/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Nam","sizechart:aounisex","Unisex/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","sub3:&Aacute;o","Qu&#7847;n &aacute;o","W13/23","&Aacute;o","&Aacute;o thun","FEMALE","N&#7919;/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","sub4:&Aacute;o thun","Unisex","Collection_TravelVacation"],"template_suffix":null,"title":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","type":"&Aacute;o thun","url":"/products/mlb-ao-thun-unisex-co-tron-tay-ngan-monotive-overfit-3atsm3033-3","pagetitle":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","metadescription":"Ch&#7845;t li&#7879;u: 70% cotton, 30% polyesterKi&#7875;u d&aacute;ng &aacute;o thun phom overfit n&#259;ng &#273;&#7897;ngC&#7893; tr&ograve;n, tay ng&#7855;n tr&#7867; trungThi&#7871;t k&#7871; logo in n&#7893;i b&#7853;t &#7903; ng&#7921;c tr&aacute;i v&agrave; h&igrave;nh in l&#7899;n &#7903; m&#7863;t sauCh&#7845;t v&#7843;i m&#7873;m m&#7883;n, th&#7845;m h&uacute;t t&#7889;tXu&#7845;t x&#7913; th&#432;&#417;ng hi&#7879;u: H&agrave;n Qu&#7889;c","variants":[{"id":1102192845,"barcode":"8809903808179","available":true,"price":179000000.0,"sku":"100180719011_3ATSM3033","option1":"50WHS","option2":"L","option3":"3ATSM3033","options":["50WHS","L","3ATSM3033"],"inventory_quantity":20.0,"old_inventory_quantity":20.0,"title":"50WHS / L / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192846,"barcode":"8809903808162","available":true,"price":179000000.0,"sku":"100180719012_3ATSM3033","option1":"50WHS","option2":"M","option3":"3ATSM3033","options":["50WHS","M","3ATSM3033"],"inventory_quantity":22.0,"old_inventory_quantity":22.0,"title":"50WHS / M / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192847,"barcode":"8809903808155","available":true,"price":179000000.0,"sku":"100180719013_3ATSM3033","option1":"50WHS","option2":"S","option3":"3ATSM3033","options":["50WHS","S","3ATSM3033"],"inventory_quantity":26.0,"old_inventory_quantity":26.0,"title":"50WHS / S / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192848,"barcode":"8809903808186","available":true,"price":179000000.0,"sku":"100180719014_3ATSM3033","option1":"50WHS","option2":"XL","option3":"3ATSM3033","options":["50WHS","XL","3ATSM3033"],"inventory_quantity":7.0,"old_inventory_quantity":7.0,"title":"50WHS / XL / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192849,"barcode":"8809903808148","available":true,"price":179000000.0,"sku":"100180719015_3ATSM3033","option1":"50WHS","option2":"XS","option3":"3ATSM3033","options":["50WHS","XS","3ATSM3033"],"inventory_quantity":25.0,"old_inventory_quantity":25.0,"title":"50WHS / XS / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null}],"vendor":"MLB","published_at":"2023-04-11T16:00:00.305Z","created_at":"2023-04-09T14:13:19.934Z","not_allow_promotion":false});
	product_collect.push({"available":true,"content":null,"description":"","featured_image":"https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_9_fcce5860d4cc4dd6878466c7769281ab_cc773a19bfe247d6a4a0553909cd2423.jpg","handle":"","id":1046199675,"images":["https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_9_fcce5860d4cc4dd6878466c7769281ab_cc773a19bfe247d6a4a0553909cd2423.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_1_758ef4cc355b4b74a11709b16e8148fd_3922622d730b444aa945d524bc90b478.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_2_d4299568a872465b81e78f8d570229b3_962944193c044620bbfbf6997e40bb7c.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_7_a753926c49c44689afbaa2940f831800_70ab095a9efa4561b12fb77029477876.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_8_6759b5c2ddf54305989cb83991cfc38a_55a81a02efba4022a82b0ef10b201464.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_3_33089754f0204287b5b57f1087b1ca65_238c0a5c05154bc68602698eb4b4ce36.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_4_b88e041a69cd4832a6b89d2a8c4474f5_67c711914cfb428eb68953af7a623f59.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_5_96ea92a2c2974786830c1e5bc40eab26_987ffbd28aa14861b6ae8531ada993e4.jpg","https://product.hstatic.net/200000642007/product/43cgs_3atsm3033_6_4034d86a2a724f269ebeba60237b0683_ab4a5b30ebe340519a6eac91d58d40bb.jpg","https://product.hstatic.net/200000642007/product/icon_43cgs_3atsm3033_dd2e34a6d42d4226a5b4b134fd46a146_440ebde14bb34a459259edbe9b816a29.jpg"],"options":["M&agrave;u s&#7855;c","K&iacute;ch th&#432;&#7899;c","Stylecode"],"price":179000000.0,"price_max":179000000.0,"price_min":179000000.0,"price_varies":false,"tags":["Nam/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","MALE","sub3:&Aacute;o","N&#7919;","Qu&#7847;n &aacute;o","UnisexMLB","&Aacute;o thun","sub4:&Aacute;o thun","Unisex","sizechart:aounisex","&Aacute;o","W15/23","Unisex/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Nam","N&#7919;/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","FEMALE","Collection_TravelVacation"],"template_suffix":null,"title":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","type":"&Aacute;o thun","url":"/products/mlb-ao-thun-unisex-co-tron-tay-ngan-monotive-overfit-3atsm3033-4","pagetitle":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","metadescription":"Ch&#7845;t li&#7879;u: 70% cotton, 30% polyesterKi&#7875;u d&aacute;ng &aacute;o thun phom overfit n&#259;ng &#273;&#7897;ngC&#7893; tr&ograve;n, tay ng&#7855;n tr&#7867; trungThi&#7871;t k&#7871; logo in n&#7893;i b&#7853;t &#7903; ng&#7921;c tr&aacute;i v&agrave; h&igrave;nh in l&#7899;n &#7903; m&#7863;t sauCh&#7845;t v&#7843;i m&#7873;m m&#7883;n, th&#7845;m h&uacute;t t&#7889;tXu&#7845;t x&#7913; th&#432;&#417;ng hi&#7879;u: H&agrave;n Qu&#7889;c","variants":[{"id":1102755966,"barcode":"8809908438845","available":true,"price":179000000.0,"sku":"100180719016_3ATSM3033","option1":"43CGS","option2":"L","option3":"3ATSM3033","options":["43CGS","L","3ATSM3033"],"inventory_quantity":19.0,"old_inventory_quantity":19.0,"title":"43CGS / L / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102755967,"barcode":"8809908438838","available":true,"price":179000000.0,"sku":"100180719017_3ATSM3033","option1":"43CGS","option2":"M","option3":"3ATSM3033","options":["43CGS","M","3ATSM3033"],"inventory_quantity":23.0,"old_inventory_quantity":23.0,"title":"43CGS / M / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102755968,"barcode":"8809908438821","available":true,"price":179000000.0,"sku":"100180719018_3ATSM3033","option1":"43CGS","option2":"S","option3":"3ATSM3033","options":["43CGS","S","3ATSM3033"],"inventory_quantity":27.0,"old_inventory_quantity":27.0,"title":"43CGS / S / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102755969,"barcode":"8809908438852","available":true,"price":179000000.0,"sku":"100180719019_3ATSM3033","option1":"43CGS","option2":"XL","option3":"3ATSM3033","options":["43CGS","XL","3ATSM3033"],"inventory_quantity":8.0,"old_inventory_quantity":8.0,"title":"43CGS / XL / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102755970,"barcode":"8809908438814","available":true,"price":179000000.0,"sku":"100180719020_3ATSM3033","option1":"43CGS","option2":"XS","option3":"3ATSM3033","options":["43CGS","XS","3ATSM3033"],"inventory_quantity":27.0,"old_inventory_quantity":27.0,"title":"43CGS / XS / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null}],"vendor":"MLB","published_at":"2023-04-22T10:00:00.023Z","created_at":"2023-04-14T16:56:19.306Z","not_allow_promotion":false});
</script>
<script>window.product = {"available":true,"featured_image":"https://product.hstatic.net/200000642007/product/50whs_3atsm3033_8_ee4d85aaac574215a7a5f1df4fc90335_e8f059cd7962403c8cee6607f7e10259.jpg","handle":"mlb-ao-thun-unisex-co-tron-tay-ngan-monotive-overfit-3atsm3033-3","id":1046062451,"images":["https://product.hstatic.net/200000642007/product/50whs_3atsm3033_8_ee4d85aaac574215a7a5f1df4fc90335_e8f059cd7962403c8cee6607f7e10259.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_1_37ef539a5b434f829c79ea6ec99642f9_01a646cb192c4f6ba87d1d2ae58c0813.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_2_35196ab311ce491fa51971771797dc2a_bc9f5cd88e6a4e1fa12b1fbc49981cb4.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_7_ab7633dd0f884d3b9e798d177823b503_f28465d851674ab4be13b7773347fc45.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_3_e06687a70cc44cf9835aee7de96c71c2_ba4015903bb44822a38c9799816f45d3.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_4_8c809912025e4952adf115e5a3615dda_64c34ff833724e50ac52af9497f600c1.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_5_75aa728fd01b407ea58f40e0d85c253a_4220b591d258437b91323dc64f1eec42.jpg","https://product.hstatic.net/200000642007/product/50whs_3atsm3033_6_00a64f8318dd4ec7b0c1abd89f5b72af_e5e273f3c7084b13af3220bb21bd333f.jpg","https://product.hstatic.net/200000642007/product/icon_50whs_3atsm3033_f227ef38f9064ea389b2e7220c1cdabe_b4c44750685e494da169ac373867e762.jpg"],"options":["M&agrave;u s&#7855;c","K&iacute;ch th&#432;&#7899;c","Stylecode"],"price":179000000.0,"price_max":179000000.0,"price_min":179000000.0,"price_varies":false,"tags":["N&#7919;","UnisexMLB","MALE","Nam/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Nam","sizechart:aounisex","sub3:&Aacute;o","Unisex/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","W13/23","&Aacute;o","FEMALE","Qu&#7847;n &aacute;o","&Aacute;o thun","Unisex","sub4:&Aacute;o thun","N&#7919;/Qu&#7847;n &aacute;o/&Aacute;o/&Aacute;o thun","Collection_TravelVacation"],"template_suffix":null,"title":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","type":"&Aacute;o thun","url":"/products/mlb-ao-thun-unisex-co-tron-tay-ngan-monotive-overfit-3atsm3033-3","pagetitle":"MLB - &Aacute;o thun unisex c&#7893; tr&ograve;n tay ng&#7855;n Monotive Overfit","metadescription":"Ch&#7845;t li&#7879;u: 70% cotton, 30% polyesterKi&#7875;u d&aacute;ng &aacute;o thun phom overfit n&#259;ng &#273;&#7897;ngC&#7893; tr&ograve;n, tay ng&#7855;n tr&#7867; trungThi&#7871;t k&#7871; logo in n&#7893;i b&#7853;t &#7903; ng&#7921;c tr&aacute;i v&agrave; h&igrave;nh in l&#7899;n &#7903; m&#7863;t sauCh&#7845;t v&#7843;i m&#7873;m m&#7883;n, th&#7845;m h&uacute;t t&#7889;tXu&#7845;t x&#7913; th&#432;&#417;ng hi&#7879;u: H&agrave;n Qu&#7889;c","variants":[{"id":1102192845,"barcode":"8809903808179","available":true,"price":179000000.0,"sku":"100180719011_3ATSM3033","option1":"50WHS","option2":"L","option3":"3ATSM3033","options":["50WHS","L","3ATSM3033"],"inventory_quantity":20.0,"old_inventory_quantity":20.0,"title":"50WHS / L / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192846,"barcode":"8809903808162","available":true,"price":179000000.0,"sku":"100180719012_3ATSM3033","option1":"50WHS","option2":"M","option3":"3ATSM3033","options":["50WHS","M","3ATSM3033"],"inventory_quantity":22.0,"old_inventory_quantity":22.0,"title":"50WHS / M / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192847,"barcode":"8809903808155","available":true,"price":179000000.0,"sku":"100180719013_3ATSM3033","option1":"50WHS","option2":"S","option3":"3ATSM3033","options":["50WHS","S","3ATSM3033"],"inventory_quantity":26.0,"old_inventory_quantity":26.0,"title":"50WHS / S / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192848,"barcode":"8809903808186","available":true,"price":179000000.0,"sku":"100180719014_3ATSM3033","option1":"50WHS","option2":"XL","option3":"3ATSM3033","options":["50WHS","XL","3ATSM3033"],"inventory_quantity":7.0,"old_inventory_quantity":7.0,"title":"50WHS / XL / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null},{"id":1102192849,"barcode":"8809903808148","available":true,"price":179000000.0,"sku":"100180719015_3ATSM3033","option1":"50WHS","option2":"XS","option3":"3ATSM3033","options":["50WHS","XS","3ATSM3033"],"inventory_quantity":25.0,"old_inventory_quantity":25.0,"title":"50WHS / XS / 3ATSM3033","weight":800.0,"compare_at_price":0.0,"inventory_management":"haravan","inventory_policy":"deny","selected":false,"url":null,"featured_image":null}],"vendor":"MLB","published_at":"2023-04-11T16:00:00.305Z","created_at":"2023-04-09T14:13:19.934Z","not_allow_promotion":false};</script>

	<div class="wrapper-product-detail">
	<div class="container">
		<div class="wrapper-product-inner">
			<div class="image-product-detail style-owl4 style-dots-point">
				<div class="list-image-detail owl-carousel ">
                  <div class="item-image-detail">
                    <img src="<?php echo $product['path'] ?>">
                  </div>
                </div>
				<div class="wrapper-list-thumb-image-detail">
					<div class="list-thumb-image-detail owl-carousel ">
                      
                    </div>
				</div>
				<div class="single-image-detail d-none">
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYscfUBUbqwGd_DHVhG-ZjCOD7MUpxp4uhNe7toUg4ug&s" >
				</div>
			</div>
			<div class="content-product-detail">
				<div class="info-product-detail">
					<div class="heading-product-detail">
						<div class="title-product-detail">
							<h1><?php echo $product['name'] ?></h1>
							<p class="sku-product-detail">
								Mua sản phẩm <span><?php echo $product["id"] ?></span>
							</p>
						</div>
					</div>
					<div class="price-product-detail ">
						<span><?php echo $product['price'] ?></span>
						<del class="d-none">0&#8363;</del>
					</div>
					<div class="swatch-color" data-index="option1">
						<div class="item-swatch">
							<img src="./assets/img/file-icon_fake_f2e1b6f97b6a4c479b0eb245964d642a.jpeg" alt="loading">
						</div>
						<div class="item-swatch">
							<img src="./assets/img/file-icon_fake_f2e1b6f97b6a4c479b0eb245964d642a.jpeg" alt="loading">
						</div>
					</div>
<!--Color-->
                    <div id="color-custom">

                    </div>


					<input type="hidden" class="product-select" value="">
					
					<div class="selector-product-detail">
						<div class="selector-product-detail-inner">
							<div class="option-swatch">
								<div class="title-swatch">
									<h4>Chọn kích thước</h4>	
									<span class="open-size-chart">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="9" viewbox="0 0 20 9" fill="none"> <rect x="0.5" y="0.5" width="19" height="8" rx="0.5" stroke="black"></rect> <rect x="3.5" y="4" width="1" height="4" fill="black"></rect> <rect x="6.5" y="6" width="1" height="2" fill="black"></rect> <rect x="12.5" y="6" width="1" height="2" fill="black"></rect> <rect x="9.5" y="4" width="1" height="4" fill="black"></rect> <rect x="15.5" y="4" width="1" height="4" fill="black"></rect> </svg>
										Hướng dẫn kích thước
									</span>
								</div>
								<div class="swatch-size" data-index="option2">
									<div class="item-swatch">Chọn màu trước</div>
								</div>
							</div>
							<div class="option-swatch d-none">
								<div class="title-swatch">
									<h4>Stylecode</h4>
								</div>
								<div class="swatch-stylecode" data-index="option3"></div>
							</div>
							<div class="quantity-detail">
								<div class="wrapper-quantity">
									<button class="btn-minus"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20" fill="none"> <path d="M6 10H14" stroke="#D0D0D0" stroke-linecap="square" stroke-linejoin="round"></path> </svg></button>
									<input class="input-quantity" type="text" value="1" max="">
									<button class="btn-plus"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20" fill="none"> <path d="M10 5V15" stroke="black" stroke-linecap="square" stroke-linejoin="round"></path> <path d="M5 10H15" stroke="black" stroke-linecap="square" stroke-linejoin="round"></path> </svg></button>
								</div>
							</div>
							<div class="action-detail">
								<button id="btn-addtocart">
									Thêm vào giỏ
								</button>
								<span><svg xmlns="http://www.w3.org/2000/svg" width="2" height="14" viewbox="0 0 2 14" fill="none"> <rect x="0.5" width="1" height="14" rx="0.5" fill="white" fill-opacity="0.32"></rect> </svg></span>
								<button id="btn-buynow">
									Mua ngay
								</button>
							</div>
							<div class="action-detail-2 d-none">
								<button>Hết hàng</button>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="description-product-detail">
				<div class="wrapper-description">
					<div class="tab-description">
						<div class="item-tab-des active" data-tab="tab1">
							Thông tin sản phẩm
						</div>
						<div class="item-tab-des" data-tab="tab2">
							Hướng dẫn bảo quản
						</div>
						
					</div>
					<div class="content-tab-description">
						<div class="item-content-tab active" data-tab="tab1">
								<ul><li>Chất liệu: 70% cotton, 30% polyester</li>
									<li>Kiểu dáng áo thun phom overfit năng động</li>
									<li>Thiết kế trẻ trung</li>
									<li>Chất vải mềm mịn thấm hút tốt</li>
									<li>Xuất sứ  : Việt Nam</li>
								</ul>
						</div>
						<div class="item-content-tab" data-tab="tab2">
							<ul><li>Giặt ở nhiệt độ tối đa 30 độ </li>
								<li>Không dùng chất tẩy </li>
								<li>Phơi trong bóng râm</li>
								
							</ul>
								
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div style="display: none;" class="mlb_aounisex" id="size-guide-modal" data-sizechart-name="mlb_aounisex">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bảng Size</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="pu" style="margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<th class="pu-uqo3" colspan="7">áo unisex</th>
</tr>
<tr>
<td class="pu-dxqr"><b>MLB</b></td>
<td class="pu-dxqr"><b>XS</b></td>
<td class="pu-dxqr"><b>S</b></td>
<td class="pu-dxqr"><strong>M</strong></td>
<td class="pu-dxqr"><strong>L</strong></td>
<td class="pu-dxqr"><strong>XL</strong></td>
<td class="pu-dxqr"><strong>XXL</strong></td>
</tr>
<tr>
<td class="pu-dxqr"><strong>Vòng ngực (cm)</strong></td>
<td class="pu-dxqr">85</td>
<td class="pu-dxqr">90</td>
<td class="pu-dxqr">95</td>
<td class="pu-dxqr">100</td>
<td class="pu-dxqr">105</td>
<td class="pu-dxqr">110</td>
</tr>
</tbody>
</table>
<table class="pu" style="margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<th class="pu-uqo3" colspan="8">Bảng size </th>
</tr>
<tr>
<td class="pu-dxqr" style="width: 77px;"><strong>MLB SIZE</strong></td>
<td class="pu-dxqr" style="width: 20px;">XS</td>
<td class="pu-dxqr" style="width: 18px;">S</td>
<td class="pu-dxqr" style="width: 18px;">M</td>
<td class="pu-dxqr" style="width: 18px;">L</td>
<td class="pu-dxqr" style="width: 18px;">XL</td>
<td class="pu-dxqr" style="width: 28px;">XXL</td>
<td class="pu-dxqr" style="width: 30.9028px;">3XL</td>
</tr>
<tr>
<td class="pu-c3ow" style="width: 77px;"><strong>UK</strong></td>
<td class="pu-ta4l" style="width: 20px;">6</td>
<td class="pu-ta4l" style="width: 18px;">8</td>
<td class="pu-ta4l" style="width: 18px;">10</td>
<td class="pu-ta4l" style="width: 18px;">12</td>
<td class="pu-dxqr" style="width: 18px;">14</td>
<td class="pu-dxqr" style="width: 28px;">16</td>
<td class="pu-dxqr" style="width: 30.9028px;">18</td>
</tr>
<tr>
<td class="pu-c3ow" style="width: 77px;"><strong>EU</strong></td>
<td class="pu-ta4l" style="width: 20px;">34</td>
<td class="pu-ta4l" style="width: 18px;">36</td>
<td class="pu-ta4l" style="width: 18px;">38</td>
<td class="pu-ta4l" style="width: 18px;">40</td>
<td class="pu-dxqr" style="width: 18px;">42</td>
<td class="pu-dxqr" style="width: 28px;">44</td>
<td class="pu-dxqr" style="width: 30.9028px;">46</td>
</tr>
<tr>
<td class="pu-c3ow" style="width: 77px;"><strong>US</strong></td>
<td class="pu-ta4l" style="width: 20px;">2</td>
<td class="pu-ta4l" style="width: 18px;">4</td>
<td class="pu-ta4l" style="width: 18px;">6</td>
<td class="pu-ta4l" style="width: 18px;">8</td>
<td class="pu-dxqr" style="width: 18px;">10</td>
<td class="pu-dxqr" style="width: 28px;">12</td>
<td class="pu-dxqr" style="width: 30.9028px;">14</td>
</tr>
<tr>
<td class="pu-c3ow" style="width: 77px;"><strong>AUS</strong></td>
<td class="pu-ta4l" style="width: 20px;">6</td>
<td class="pu-ta4l" style="width: 18px;">8</td>
<td class="pu-ta4l" style="width: 18px;">10</td>
<td class="pu-ta4l" style="width: 18px;">12</td>
<td class="pu-dxqr" style="width: 18px;">14</td>
<td class="pu-dxqr" style="width: 28px;">16</td>
<td class="pu-dxqr" style="width: 30.9028px;">18</td>
</tr>
<tr>
<td class="pu-c3ow" style="width: 77px;"><strong>JP</strong></td>
<td class="pu-ta4l" style="width: 20px;">7</td>
<td class="pu-ta4l" style="width: 18px;">9</td>
<td class="pu-ta4l" style="width: 18px;">11</td>
<td class="pu-ta4l" style="width: 18px;">13</td>
<td class="pu-dxqr" style="width: 18px;">15</td>
<td class="pu-dxqr" style="width: 28px;">17</td>
<td class="pu-dxqr" style="width: 30.9028px;">19</td>
</tr>
</tbody>
</table>
					
				</div>
			</div>
		</div>
	</div>
</div>




</main>

<div id="size-guide" style="display: none;"></div>

<div id="update-items"><div class="wrapper-update"></div></div>
<div class="overflow-popup"></div>

<div id="warning-form" style="display: none;">
	<div class="warning-form-inner">
		<h3></h3>
		<p></p>
		<a href="#" onclick="return false;">Kiểm tra</a>
	</div>
</div>

<script>
	var template = 'product';
	var formatMoney = '{{amount}}';
	window.shop = {
		
	}
	window.app = {
		productKeyCombo: "",
		urlGetCombo: "/",
		urlGetBuyXSelectY: "/",
		urlListApplyable: "/",
		urlGetListXY: "/",
		urlFile: '',
		postRating: '/',
		listOrder: '/'
	}
</script>

</script>




<script type="text/javascript" data-src="//theme.hstatic.net/200000642007/1001179574/14/scripts.js?v=73"></script>

<script>
	document.addEventListener("DOMContentLoaded", function(event) { 
		let jsquery = document.querySelectorAll('script[data-src]');
		if(checklh == false && jsquery.length > 0){
			for(let i=0;i< jsquery.length;i++){
				let src_ = jsquery[i].getAttribute('data-src');
				const script = document.createElement("script");
				script.setAttribute("async","");
				script.setAttribute("src",src_);
				document.getElementsByTagName("head")[0].appendChild(script);
			}
		}




	});
</script>


</body></html>
