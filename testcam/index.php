<?php
	include_once ('Common.php');
?>

<!DOCTYPE html>
<!--
 *  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a BSD-style license
 *  that can be found in the LICENSE file in the root of the source
 *  tree.
-->
<html>
<head>

  <meta charset="utf-8">
  <meta name="description" content="WebRTC code samples">
  <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
  <meta itemprop="description" content="Client-side WebRTC code samples">
  <meta itemprop="image" content="../../../images/webrtc-icon-192x192.png">
  <meta itemprop="name" content="WebRTC code samples">
  <meta name="mobile-web-app-capable" content="yes">
  <meta id="theme-color" name="theme-color" content="#ffffff">

  <base target="_blank">

  <title>getUserMedia + CSS filters</title>

  <link rel="stylesheet" href="main.css">

  <style>
    .none {
      -webkit-filter: none;
      filter: none;
    }
    .blur {
      -webkit-filter: blur(3px);
      filter: blur(3px);
    }
    .grayscale {
      -webkit-filter: grayscale(1);
      filter: grayscale(1);
    }
    .invert {
      -webkit-filter: invert(1);
      filter: invert(1);
    }
    .sepia {
      -webkit-filter: sepia(1);
      filter: sepia(1);
    }

    button#snapshot {
      margin: 0 10px 25px 0;
      width: 110px;
    }

    video {
      object-fit: cover;
    }
  </style>

</head>

<body>
  <div id="container">

    <video autoplay></video>

    <label for="select">Filter: </label>
    <select id="filter">
      <option value="none">None</option>
      <option value="blur">Blur</option>
      <option value="grayscale">Grayscale</option>
      <option value="invert">Invert</option>
      <option value="sepia">Sepia</option>
    </select>

    <button id="snapshot">Take snapshot</button>

    <!--<canvas></canvas>-->
  </div>
  <script src="adapter.js"></script>
  <script src="common.js"></script>
  <script src="main.js"></script>
 </body>
</html>