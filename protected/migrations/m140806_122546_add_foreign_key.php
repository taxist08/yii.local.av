<?php

class m140806_122546_add_foreign_key extends CDbMigration
{
    public function up()
    {
        $this->addForeignKey('queue_user_FK', 'queue_sk', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('status_user_FK', 'queue_sk_status', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('status_queue_FK', 'queue_sk_status', 'queue_id', 'queue_sk', 'queue_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('status_type_FK', 'queue_sk_status', 'status_id', 'queue_sk_status_type', 'type_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('comment_queue_FK', 'queue_sk_comments', 'queue_id', 'queue_sk', 'queue_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('comment_user_FK', 'queue_sk_comments', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        
    }

    public function down()
    {
        $this->dropForeignKey('queue_user_FK', 'queue_sk');
        $this->dropForeignKey('status_user_FK', 'queue_sk_status');
        $this->dropForeignKey('status_queue_FK', 'queue_sk_status');
        $this->dropForeignKey('status_type_FK', 'queue_sk_status');
        $this->dropForeignKey('comment_queue_FK', 'queue_sk_comments');
        $this->dropForeignKey('comment_user_FK', 'queue_sk_comments');
        
        //echo "m140806_122546_add_foreign_key does not support migration down.\n";
        //return false;
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
