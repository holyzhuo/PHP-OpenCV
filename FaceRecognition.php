<?php
/**
 * Created by PhpStorm.
 * User: zcer
 * Date: 2020/3/10
 * Time: 下午4:56
 */

use CV\CascadeClassifier, CV\Scalar;
use function CV\{
    imread, imwrite, cvtColor, equalizeHist, rectangleByRect
};
use const CV\{
    COLOR_BGR2GRAY
};

class FaceRecognition
{
    const MODEL_PATH = 'models/lbpcascade_frontalface.xml';

    const RESULT_IMG = 'result-img/_detect_face_by_cascade_classifier.jpg';

    private $src;

    public function __construct($imgPath)
    {
        $this->src = imread($imgPath);
    }

    public function getFaceResult()
    {
        $gray = cvtColor($this->src, COLOR_BGR2GRAY);

        $faceClassifier = new CascadeClassifier();
        $faceClassifier->load(self::MODEL_PATH);

        $faces = null;
        $faceClassifier->detectMultiScale($gray, $faces);
        return $faces;
    }

    public function createRetImg()
    {
        imwrite(self::RESULT_IMG, $this->src);
    }

    function drawFaceFrame($faces)
    {
        if ($faces) {
            $scalar = new Scalar(0, 0, 255); //blue
            foreach ($faces as $face) {
                rectangleByRect($this->src, $face, $scalar, 3);
            }
        }
    }

    public static function calRunTime($func)
    {
        $startTime = microtime(true);

        $func();

        $endTime = microtime(true);

        $runTime = ($endTime - $startTime) * 1000 . ' ms';
        var_dump("run time:", $runTime);
    }
}