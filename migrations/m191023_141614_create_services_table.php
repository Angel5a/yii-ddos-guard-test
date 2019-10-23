<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m191023_141614_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string(10)->notNull(),
            'ip' => $this->string(16)->notNull(),
            'domain' => $this->string()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-services-user_id}}',
            '{{%services}}',
            'user_id'
        );

        if ( $this->db->driverName !== 'sqlite' ) {
            // add foreign key for table `{{%user}}`
            $this->addForeignKey(
                '{{%fk-services-user_id}}',
                '{{%services}}',
                'user_id',
                '{{%users}}',
                'id',
                'CASCADE'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if ( $this->db->driverName !== 'sqlite' ) {
            // drops foreign key for table `{{%user}}`
            $this->dropForeignKey(
                '{{%fk-services-user_id}}',
                '{{%services}}'
            );
        }

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-services-user_id}}',
            '{{%services}}'
        );

        $this->dropTable('{{%services}}');
    }
}
