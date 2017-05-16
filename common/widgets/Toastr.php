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

        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $data) {
            $toast = /** @lang JavaScript */
                "toastr['$type']('$data[0]');";
            echo $toast;
            $session->remove($type);
        }
    }


}