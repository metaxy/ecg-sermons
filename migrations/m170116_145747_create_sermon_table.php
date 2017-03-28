<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sermon`.
 */
class m170116_145747_create_sermon_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sermon', [
            'id' => $this->primaryKey(),
            'groupId' => $this->integer(),

            'date' => $this->date(),
            'hits' => $this->integer(),
            'title' => $this->string(),
            'languageJson' => $this->text(),
            'speaker' => $this->string(),

            'picture' => $this->string(),
            'notes' => $this->text(),
            'filesJson' => $this->text(),
            'scripture' => $this->string(),
            'seriesName' => $this->string()
        ]);

        //groupId
        $this->createIndex(
            'idx-sermon-groupId',
            'sermon',
            'groupId'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-sermon-groupId',
            'sermon',
            'groupId',
            'group',
            'id',
            'CASCADE'//on delete
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sermon');
    }
}
