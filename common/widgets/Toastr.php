<?php
/**
 * Created by IntelliJ IDEA.
 * User: apex
 * Date: 27/04/17
 * Time: 12:26 PM
 */

namespace common\widgets;


use yii\base\Widget;

class Toastr extends Widget
{

    const SUCCESS = 'success';
    const ERROR = 'error';
    const INFO = 'info';
    const WARNING = 'warning';

    public function init()
    {
        parent::init();

        $typeHolder = '{type}';
        $contentHolder = '{content}';
        $baseToast = /** @lang JavaScript */
            <<<TOASTR
toastr['$typeHolder']('$contentHolder'); 
TOASTR;

        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        foreach ($flashes as $type => $data) {
            switch ($type) {
                case self::SUCCESS:
                    $toast = str_replace($type, self::SUCCESS, $baseToast);
                    break;
                case self::ERROR:
                    $toast = str_replace($type, self::ERROR, $baseToast);
                    break;
                case self::WARNING:
                    $toast = str_replace($type, self::WARNING, $baseToast);
                    break;
                default:
                case self::INFO:
                    $toast = str_replace($type, self::INFO, $baseToast);
                    break;
            }
            die();
            echo str_replace($contentHolder, $data, $toast);
            $session->remove($type);
        }
    }


}