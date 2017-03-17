<?php

use yii\db\Migration;

class m170303_022355_create_timekeeper_tables extends Migration
{
    public function up()
    {
        $this->createTable('entries',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(4)->notNull(),
            'title' => $this->string(64)->notNull(),
            'hours' => $this->decimal(5,2)->notNull(),
            'entry_date' => $this->date()->notNull(),
            'date_created' => $this->dateTime()->notNull(),
            'date_modified' => $this->dateTime()->null(),
        ]);
    }

    public function down()
    {
        $this->dropTable('entries');
    }
}
