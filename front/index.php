<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <?php include "../includes/header.php"; 
    //include "../includes/points.php"; ?>
    <head>
        <title>Home</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <link rel="stylesheet\" href="../css/navbar.css">
        <link rel="stylesheet\" href="../css/index.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">
        

        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>


        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
            #map {
                width: 100%;
                /*height: 100%;*/
            }
        </style>
    </head>
    
    <body>
        <?php require '../includes/navbar.php'; ?>
        <?php
            if(empty($_COOKIE['annee'])) {
                setcookie('annee', 1790);
            }
            if (!empty($_POST['annee'])) {
                $_COOKIE['annee'] = $_POST['annee'];
            }
            $etage = 1;
            if (!empty($_POST['etage'])) {
                $etage = $_POST['etage'];
            }         
        ?>

        <div class="tl-wrapper" style="height: 65%; background-color: #fff">
            <div style = "display:flex; height: 100%;">
                <div style = "flex:10%;">
                <p>Etage :</p>
                    <form action='index.php' method="post">
                        <ul id = "etage">
                            <style>
                                ul {
                                        list-style-type: none;
                                }
                                #etage li {
                                        position: relative;
                                        margin: 0;
                                        padding-bottom: 1em;
                                        padding-left: 20px;
                                }
                                #etage li:before {
                                        content: '';
                                        background-color: #000;
                                        position: absolute;
                                        bottom: 0;
                                        top: 0;
                                        left: 6px;
                                        width: 3px;
                                }
                                #etage li:after {
                                        content: '';
                                        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' aria-hidden='true' viewBox='0 0 32 32' focusable='false'%3E%3Ccircle stroke='none' fill='%23000' cx='16' cy='16' r='10'%3E%3C/circle%3E%3C/svg%3E");
                                        position: absolute;
                                        left: 0;
                                        height: 15px;
                                        width: 15px;
                                        
                                }
                            </style>
                            <li><input type="submit" name="etage" value="1" style="background-color: transparent; border: none;"/></li>
                            <li><input type="submit" name="etage" value="2" style="background-color: transparent; border: none;"/></li>
                            <li><input type="submit" name="etage" value="3" style="background-color: transparent; border: none;"/></li>
                        </ul>
                    </form>
                </div>
                <div id='map' style = "flex:90%;"></div>
                <div id='info' style="flex:25%;">
                    <div id='info-img' style="height: 30%; overflow: hidden;">
                        <img src="../images/800px-Louis_XIV_of_France.jpg" width="100%" style="position:relative; bottom:35%;">
                    </div>
                    <div id='info-titre' style="height: 20%; text-align: center;">
                        <p style="top: 10%;position: relative;">Louis XIV</p>
                    </div>
                    <div id='info-txt' style="height: 40%;">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-parent" style="height: 15%; background-color: #fff;">
            <style>
                html, body {
                    height: 100%;
                    
                }

                body {
                    font-family: "Quicksand", sans-serif;
                    font-weight: 500;
                    color: #424949;
                    background-color: #ECF0F1;
                    padding: 0px;
                    display: flex;
                    flex-direction: column;
                    position: relative;
                }

                h1 {
                    text-align: center;
                    height: 38px;
                    margin: 60px 0;
                }
                h1 span {
                    white-space: nowrap;
                }

                .flex-parent {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    width: 100%;
                    height: 15%;
                }

                .input-flex-container {
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                    width: 80vw;
                    height: 100px;
                    max-width: 1000px;
                    position: relative;
                    z-index: 0;
                }

                .input {
                    width: 25px;
                    height: 25px;
                    background-color: #2C3E50;
                    position: relative;
                    border-radius: 50%;
                }
                .input:hover {
                    cursor: pointer;
                }
                .input::before, .input::after {
                    content: "";
                    display: block;
                    position: absolute;
                    z-index: -1;
                    top: 50%;
                    transform: translateY(-50%);
                    background-color: #2C3E50;
                    width: 4vw;
                    height: 5px;
                    max-width: 50px;
                }
                .input::before {
                    left: calc(-4vw + 12.5px);
                }
                .input::after {
                    right: calc(-4vw + 12.5px);
                }
                .input.active {
                    background-color: #2C3E50;
                }
                .input.active::before {
                    background-color: #2C3E50;
                }
                .input.active::after {
                    background-color: #AEB6BF;
                }
                .input.active span {
                    font-weight: 700;
                }
                .input.active span::before {
                    font-size: 13px;
                }
                .input.active span::after {
                    font-size: 15px;
                }
                .input.active ~ .input, .input.active ~ .input::before, .input.active ~ .input::after {
                    background-color: #AEB6BF;
                }
                .input span {
                    width: 1px;
                    height: 1px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    visibility: hidden;
                }
                .input span::before, .input span::after {
                    visibility: visible;
                    position: absolute;
                    left: 50%;
                }
                .input span::after {
                    content: attr(data-year);
                    top: 25px;
                    transform: translateX(-50%);
                    font-size: 14px;
                }
                .input span::before {
                    content: attr(data-info);
                    top: -65px;
                    width: 70px;
                    transform: translateX(-5px) rotateZ(-45deg);
                    font-size: 12px;
                    text-indent: -10px;
                }

                .description-flex-container {
                    width: 80vw;
                    font-weight: 400;
                    font-size: 22px;
                    margin-top: 100px;
                    max-width: 1000px;
                }
                .description-flex-container p {
                    margin-top: 0;
                    display: none;
                }
                .description-flex-container p.active {
                    display: block;
                }

                @media (min-width: 1250px) {
                    .input::before {
                        left: -37.5px;
                    }

                    .input::after {
                        right: -37.5px;
                    }
                }
                @media (max-width: 850px) {
                    .input {
                        width: 17px;
                        height: 17px;
                    }
                    .input::before, .input::after {
                        height: 3px;
                    }
                    .input::before {
                        left: calc(-4vw + 8.5px);
                    }
                    .input::after {
                        right: calc(-4vw + 8.5px);
                    }
                }
                @media (max-width: 600px) {
                    .flex-parent {
                        justify-content: initial;
                    }

                    .input-flex-container {
                        flex-wrap: wrap;
                        justify-content: center;
                        width: 100%;
                        height: auto;
                        margin-top: 15vh;
                    }

                    .input {
                        width: 60px;
                        height: 60px;
                        margin: 0 10px 50px;
                        background-color: #AEB6BF;
                    }
                    .input::before, .input::after {
                        content: none;
                    }
                    .input span {
                        width: 100%;
                        height: 100%;
                        display: block;
                    }
                    .input span::before {
                        top: calc(100% + 5px);
                        transform: translateX(-50%);
                        text-indent: 0;
                        text-align: center;
                    }
                    .input span::after {
                        top: 50%;
                        transform: translate(-50%, -50%);
                        color: #ECF0F1;
                    }

                    .description-flex-container {
                        margin-top: 30px;
                        text-align: center;
                    }
                }
                @media (max-width: 400px) {
                    body {
                        min-height: 950px;
                    }
                }
            </style>
            
            <form id="form" action="index.php" method="post">
                <input type="hidden" ID="year" name="annee">
                <noscript><input type="submit" value="submit" class="button"></noscript>
            </form>
            <div class="input-flex-container mb-auto">
                <div class="input" data-year="1790">
                    <span class=data-year data-year="1790" data-info=""></span>
                </div>
                <div class="input" data-year="1780">
                    <span class=data-year data-year="1780" data-info=""></span>
                </div>
                <div class="input" data-year="1940">
                    <span class=data-year data-year="1940" data-info=""></span>
                </div>
                <div class="input" data-year="1940">
                    <span class=data-year data-year="1940" data-info=""></span>
                </div>
                <div class="input" data-year="1950">
                    <span class=data-year data-year="1950" data-info=""></span>
                </div>    
            </div>
            <script defer>
                    $("#year").val(<?php 
                        echo $_COOKIE['annee'];
                        if (!empty($_POST['annee'])) {
                            echo $_POST['annee'];
                        }
                        else {
                            echo $_COOKIE['annee'];
                        }
                        ?>);
                    $("div[data-year="+<?php 
                        echo $_COOKIE['annee'];
                        if (!empty($_POST['annee'])) {
                            echo $_POST['annee'];
                        }
                        else {
                            echo $_COOKIE['annee'];
                        }
                        ?>+"]").addClass("active");
                    $(function () {
                    var inputs = $(".input");
                    var paras = $(".description-flex-container").find("p");
                    inputs.click(function () {
                        var t = $(this),
                            ind = t.index(),
                            matchedPara = paras.eq(ind);
                            $("#year").val(t.data("year"));
                            //t.add(matchedPara).addClass("active");
                            inputs.not(t).add(paras.not(matchedPara)).removeClass("active");
                            $("#form").submit();
                        });
                    });
                </script>
        </div>

        

        <script>

                var map = L.map('map', {
                        crs: L.CRS.Simple,
                        minZoom: -3
                });

                var yx = L.latLng;

                var xy = function(x, y) {
                        if (L.Util.isArray(x)) {    // When doing xy([x, y]);
                                return yx(x[1], x[0]);
                        }
                        return yx(y, x);  // When doing xy(x, y);
                };

                var iconVersailles = L.icon({
                        iconUrl: '../images/icon.png',
                        iconAnchor:   [19, 50]
                });

                var x = 6507;
                var y = 2319;

                var bounds = [xy(0, 0), xy(x, y)];
                var image = L.imageOverlay('<?php echo '../images/'.$_COOKIE["annee"].'_'.$etage.'.png';?>', bounds).addTo(map);

                var sol      = xy(175.2, 145.0);
                var mizar    = xy( 41.6, 130.1);
                var kruegerZ = xy( 13.4,  56.5);
                var deneb    = xy(218.7,   8.3);

                L.marker(     sol, {icon: iconVersailles}).addTo(map).bindPopup(      'Sol');
                L.marker(   mizar, {icon: iconVersailles}).addTo(map).bindPopup(    'Mizar');
                L.marker(kruegerZ, {icon: iconVersailles}).addTo(map).bindPopup('Krueger-Z');
                L.marker(   deneb, {icon: iconVersailles}).addTo(map).bindPopup(    'Deneb');

                

        </script>
        
    </body>

    <footer>
        <p style="top: 10%;">Fait par Alan GARCIA CALZADA et Logan DELPORTE pour le CRCV</p>
        <style>
            footer {
                height: 10%;
                background-color: #000;
                font-size: 70%;
                color: #fff;
                text-align: center;
            }
        </style>
    </footer>
</html>
