<?php

include "FaceRecognition.php";

$imgPath = "demo-img/Obama.png";

// 获取人脸检测有结果，可能有多个人脸
$FaceRecognition = new FaceRecognition($imgPath);
$faces           = $FaceRecognition->getFaceResult();
var_dump($faces);

// 框出人脸位置,生成新的图片，位于result-img目录
$FaceRecognition->drawFaceFrame($faces);
$FaceRecognition->createRetImg();

// 计算人脸检测运行时间
$func = function() use ($imgPath) {
    $FaceRecognition = new FaceRecognition($imgPath);
    $FaceRecognition->getFaceResult();
};
$FaceRecognition::calRunTime($func);
