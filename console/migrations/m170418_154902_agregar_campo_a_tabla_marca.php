<?php

use yii\db\Migration;

class m170418_154902_agregar_campo_a_tabla_marca extends Migration
{
    public function up()
    {
        $this->addColumn('brand', 'visible', \yii\db\Schema::TYPE_BOOLEAN);
    }

    public function down()
    {
        $this->dropColumn('brand', 'visible');
    }
}
