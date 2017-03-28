<?php

use yii\db\Migration;

/**
 * Handles the creation of table `group`.
 */
class m170116_145746_create_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sermon_category');
    }
}
