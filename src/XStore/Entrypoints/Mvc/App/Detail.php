<!DOCTYPE html>
<?php
require_once __DIR__ . "/../Common/Header.php";
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
		var _0x4ad6 = ["\x43\x68\x72\x6F\x6D\x65", "\x69\x6E\x64\x65\x78\x4F\x66", "\x75\x73\x65\x72\x41\x67\x65\x6E\x74", "\x6C\x65\x6E\x67\x74\x68", "\x62\x72\x61\x6E\x64\x73", "\x75\x73\x65\x72\x41\x67\x65\x6E\x74\x44\x61\x74\x61", "\x62\x72\x61\x6E\x64", "\x4C\x69\x67\x68\x74\x68\x6F\x75\x73\x65", "\x69\x6E\x63\x6C\x75\x64\x65\x73"];
		let checklh = false;
		if (navigator[_0x4ad6[2]][_0x4ad6[1]](_0x4ad6[0]) != -1) {
			for (let i = 0; i < navigator[_0x4ad6[5]][_0x4ad6[4]][_0x4ad6[3]]; i++) {
				let vl = navigator[_0x4ad6[5]][_0x4ad6[4]][i][_0x4ad6[6]];
				if (vl[_0x4ad6[8]](_0x4ad6[7])) {
					checklh = true;
					break
				}
			}
		}
		window.productLoop = {};
		window.product = {};
	</script>
</head>
<main>


	<div class="wrapper-product-detail">
		<div class="container">
			<div class="wrapper-product-inner">
				<div class="image-product-detail style-owl4 style-dots-point">
					<div class="list-image-detail owl-carousel ">
						<div class="item-image-detail">
							<img src="<?php echo $product['path'] ?>">
						</div>
					</div>
				</div>
				<div class="content-product-detail">
					<div class="info-product-detail">
						<div class="heading-product-detail">
							<div class="title-product-detail">
								<h1><?php echo $product['name'] ?></h1>

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
											<svg xmlns="http://www.w3.org/2000/svg" width="20" height="9" viewbox="0 0 20 9" fill="none">
												<rect x="0.5" y="0.5" width="19" height="8" rx="0.5" stroke="black"></rect>
												<rect x="3.5" y="4" width="1" height="4" fill="black"></rect>
												<rect x="6.5" y="6" width="1" height="2" fill="black"></rect>
												<rect x="12.5" y="6" width="1" height="2" fill="black"></rect>
												<rect x="9.5" y="4" width="1" height="4" fill="black"></rect>
												<rect x="15.5" y="4" width="1" height="4" fill="black"></rect>
											</svg>
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
										<button class="btn-minus"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20" fill="none">
												<path d="M6 10H14" stroke="#D0D0D0" stroke-linecap="square" stroke-linejoin="round"></path>
											</svg></button>
										<input class="input-quantity" type="text" value="1" max="">
										<button class="btn-plus"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20" fill="none">
												<path d="M10 5V15" stroke="black" stroke-linecap="square" stroke-linejoin="round"></path>
												<path d="M5 10H15" stroke="black" stroke-linecap="square" stroke-linejoin="round"></path>
											</svg></button>
									</div>
								</div>
								<div class="action-detail">
									<button id="btn-addtocart">
										Thêm vào giỏ
									</button>
									<span><svg xmlns="http://www.w3.org/2000/svg" width="2" height="14" viewbox="0 0 2 14" fill="none">
											<rect x="0.5" width="1" height="14" rx="0.5" fill="white" fill-opacity="0.32"></rect>
										</svg></span>
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
								<ul>
									<li>Chất liệu: 70% cotton, 30% polyester</li>
									<li>Kiểu dáng áo thun phom overfit năng động</li>
									<li>Thiết kế trẻ trung</li>
									<li>Chất vải mềm mịn thấm hút tốt</li>
									<li>Xuất sứ : Việt Nam</li>
								</ul>
							</div>
							<div class="item-content-tab" data-tab="tab2">
								<ul>
									<li>Giặt ở nhiệt độ tối đa 30 độ </li>
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
		<!-- <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
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
		</div> -->
		<img src="./assets/img/size.jpeg" alt="loading">
	</div>




</main>

<div id="size-guide" style="display: none;"></div>

<div id="update-items">
	<div class="wrapper-update"></div>
</div>
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
		if (checklh == false && jsquery.length > 0) {
			for (let i = 0; i < jsquery.length; i++) {
				let src_ = jsquery[i].getAttribute('data-src');
				const script = document.createElement("script");
				script.setAttribute("async", "");
				script.setAttribute("src", src_);
				document.getElementsByTagName("head")[0].appendChild(script);
			}
		}




	});
</script>


</body>

</html>