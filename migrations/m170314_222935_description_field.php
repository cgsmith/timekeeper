<?php

use yii\db\Migration;

class m170314_222935_description_field extends Migration
{
    public function up()
    {
        $this->addColumn('entries','description','text');
    }

    public function down()
    {
        $this->dropColumn('entries','description');
    }
}
