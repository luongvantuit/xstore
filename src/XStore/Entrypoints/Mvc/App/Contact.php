<!DOCTYPE html>
<html lang="en">

</head>
    <title>Home - XStore</title>
</head>

<body>
    <?php
    require_once __DIR__ . "/../Common/Header.php"
    ?>
<div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="First Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div class="col-lg-12">
                                <input type="email" placeholder="E-mail">
                                <input type="text" placeholder="Subject">
                                <textarea placeholder="Message"></textarea>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit">Send message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="contact-widget">
                        <div class="cw-item">
                            <h5>Location</h5>
                            <ul>
                                <li>334 Nguyen Trai, Thanh Xuan, Ha Noi, Viet Nam </li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5>Phone</h5>
                            <ul>
                                <li>+84 (0)123456789</li>
                            </ul>
                        </div>
                        <div class="cw-item">
                            <h5>E-mail</h5>
                            <ul>
                                <li>contact@web.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map">
                <div class="row">
                    <div class="col-lg-12">
                    <iframe src="https://www.google.com/maps/embed/v1/search?q=334+Nguyễn+Trãi,+Thanh+Xuân+Trung,+Thanh+Xuân,+Hà+Nội,+Vietnam&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>