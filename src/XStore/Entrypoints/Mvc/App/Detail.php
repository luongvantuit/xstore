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
<style>
    :root {
        --color: transition;
    }

    #container {
        display: flex;
        flex-direction: column;
        gap: 32px;
        align-items: center;
        justify-content: center;
        height: 400px;
    }

    #colors,
    #sizes {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .size {
        border: 1px solid #e8e8e8;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 18px;
        min-width: 65px;
        cursor: pointer;
        margin: 0 8px 8px 0;
        color: #202846;
        line-height: 20px;
        transition: all 200ms ease-out;
        text-transform: uppercase;
    }

    .size:hover {
        background-color: rgba(0, 0, 0, 0.15);
    }

    .color {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        padding: 2px;
        cursor: pointer;
        transition: all 200ms ease-in-out;
        background-color: var(--color);
        outline-color: var(--color);
    }

    .color.active {
        outline-offset: 4px;
        outline: 2px auto var(--color);
    }

    .size.active {
        color: #ffffff;
        background-color: #000000;
        border-color: #000000;
    }

    #tabs {
        width: 700px;
        max-width: 700px;
    }

    #tab-title {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tab-item {
        flex: 1;
        text-align: center;
        cursor: pointer;
        text-transform: uppercase;
        position: relative;
        padding: 16px 0px;
        font-size: 14px;
        border-bottom: 2px solid transparent;
    }

    .tab-item.active {
        border-bottom: 2px solid black;
    }

    .item-content-tab {
        display: none;
    }

    .item-content-tab.active {
        display: block;
    }
</style>
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
								Mua sản phẩm <span><?php echo $product["id"]?></span>
							</p>
						</div>
					</div>
					<div class="price-product-detail ">
						<span><?php echo $product['price'] ?></span>
						<del class="d-none">0&#8363;</del>
					</div>
                    <body>
                    <div id="container">
                        <div id="colors"></div>
                        <div id="sizes"></div>
                        <div id="tabs">
                            <div id="tab-title">
                                <div class="tab-item active" data-tab="0">Thông tin sản phẩm</div>
                                <div class="tab-item" data-tab="1">Hướng dẫn bảo quản</div>
                            </div>
                            <div id="tab-content">
                                <div class="item-content-tab active" data-tab="0">
                                    <ul>
                                        <li><?php echo $product['']               ?></li>
                                        <li>Chất liệu: 70% cotton, 30% polyester</li>
                                        <li>Kiểu dáng áo thun phom overfit năng động</li>
                                        <li>Thiết kế trẻ trung</li>
                                        <li>Chất vải mềm mịn thấm hút tốt</li>
                                        <li>Xuất sứ : Việt Nam</li>
                                    </ul>
                                </div>
                                <div class="item-content-tab" data-tab="1">
                                    <ul>
                                        <li>Giặt ở nhiệt độ tối đa 30 độ</li>
                                        <li>Không dùng chất tẩy</li>
                                        <li>Phơi trong bóng râm</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>

                        const onAddElement = ({ data, activeItem, rootElement, id, isTextContent, isProperty }) => {
                            const dataItem = data.map((item, i) => {
                                const element = document.createElement('div');
                                let className = id;
                                if (!i) className = `${id} active`;

                                element.dataset[id] = item;
                                element.className = className;
                                if (isTextContent) element.textContent = item;
                                if (isProperty) element.style.setProperty('--color', item);

                                element.onclick = (e) => {
                                    const item = e.target;
                                    const itemData = item.dataset[id];
                                    Array.from(rootElement.children).forEach((ele) => {
                                        const isBeforeActive = ele.classList.contains('active');
                                        if (isBeforeActive) ele.classList.remove('active');
                                    });
                                    item.classList.add('active');
                                    currentSize = { index: i, [id]: itemData };
                                };

                                return element;
                            });

                            dataItem.forEach((item) => rootElement.appendChild(item));
                        };

                        // Màu
                        let currentColor = { index: 0, color: 'red' }; // Chỉ sô tương ứng với mã màu trong mảng dưới

                        // Tùy chỉnh màu
                        const colorData = ['whitesmoke', 'black', 'pink', 'yellow'];
                        const colorsElement = document.getElementById('colors');

                        //   Size
                        let currentSize = { index: 0, size: 'xs' }; // Chỉ sô tương ứng với mã size trong mảng dưới

                        // Tùy chỉnh size
                        const sizesData = ['xs', 's', 'm', 'l', 'xl'];
                        const sizesElement = document.getElementById('sizes');

                        //   Bắt đầu khởi tạo
                        //   Màu
                        onAddElement({
                            data: colorData,
                            activeItem: currentColor,
                            id: 'color',
                            rootElement: colorsElement,
                            isProperty: true,
                        });

                        //   Size
                        onAddElement({
                            data: sizesData,
                            activeItem: currentSize,
                            id: 'size',
                            rootElement: sizesElement,
                            isTextContent: true,
                        });

                        //   Tabs
                        const tabTitleElement = document.getElementById('tab-title');
                        const tabContentElement = document.getElementById('tab-content');
                        const tabTitleData = Array.from(tabTitleElement.children);
                        const tabContentData = Array.from(tabContentElement.children);

                        tabTitleData.forEach((item) => {
                            item.onclick = (e) => {
                                const item = e.target;
                                const itemData = Number(item.dataset.tab);

                                tabTitleData.forEach((ele, index) => {
                                    if (index != itemData) {
                                        ele.classList.remove('active');
                                        tabContentData[index].classList.remove('active');
                                    }
                                });

                                item.classList.add('active');
                                tabContentData[itemData].classList.add('active');
                            };
                        });
                    </script>
                    </body>
<!--Color-->
                    <div id="color-custom">

                    </div>


					<input type="hidden" class="product-select" value="">

					<div class="selector-product-detail">
						<div class="selector-product-detail-inner">
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

					
				</div>
			</div>
		</div>
	</div>
</div>




</main>



<div id="update-items"><div class="wrapper-update"></div></div>
<div class="overflow-popup"></div>

<div id="warning-form" style="display: none;">
	<div class="warning-form-inner">
		<h3></h3>
		<p></p>
		<a href="#" onclick="return false;">Kiểm tra</a>
	</div>
</div>


    </body></html>
