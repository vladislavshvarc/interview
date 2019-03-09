<?php

use yii\db\Migration;

/**
 * Class m190308_071804_add_train_schedule
 */
class m190308_071804_add_train_schedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->createTable('{{%stations}}', [
    		'id'	=> $this->primaryKey(),
			'name'	=> $this->string(255)->notNull()
		]);

    	$this->createTable('{{%carriers}}', [
    		'id'	=> $this->primaryKey(),
			'name'	=> $this->string(255)->notNull()
		]);

		$this->createTable('{{%train_voyage}}', [
			'id'					=> $this->primaryKey(),
			'carrier_id'			=> $this->integer()->notNull(),
			'station_departure'		=> $this->integer()->notNull(),
			'station_arrival'		=> $this->integer()->notNull(),
			'time_departure'		=> $this->string()->notNull(),
			'time_arrival'			=> $this->string()->notNull(),
			'cost'					=> $this->float()->notNull(),
			'created_at'			=> $this->integer()->notNull(),
			'updated_at'			=> $this->integer()->notNull()
		]);

		$this->createTable('{{%train_schedule}}', [
			'voyage_id'				=> $this->primaryKey(),
			'monday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
			'tuesday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
			'wednesday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
			'thursday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
			'friday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
			'saturday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
			'sunday'				=> $this->tinyInteger()->defaultValue(0)->notNull(),
		]);

		$this->addForeignKey('tv_c', '{{%train_voyage}}', 'carrier_id', '{{%carriers}}', 'id', 'RESTRICT', 'RESTRICT');

		$this->addForeignKey('tv_sd', '{{%train_voyage}}', 'station_departure', '{{%stations}}', 'id', 'RESTRICT', 'RESTRICT');

		$this->addForeignKey('tv_sa', '{{%train_voyage}}', 'station_arrival', '{{%stations}}', 'id', 'RESTRICT', 'RESTRICT');

		$this->addForeignKey('ts_sa', '{{%train_schedule}}', 'voyage_id', '{{%train_voyage}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('ts_sa', '{{%train_schedule}}');

		$this->dropForeignKey('tv_sa', '{{%train_voyage}}');

		$this->dropForeignKey('tv_sd', '{{%train_voyage}}');

		$this->dropForeignKey('tv_c', '{{%train_voyage}}');

		$this->dropTable('{{%train_schedule}}');

		$this->dropTable('{{%train_voyage}}');

		$this->dropTable('{{%carriers}}');

		$this->dropTable('{{%stations}}');
    }
}
