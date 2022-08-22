<?php

use yii\db\Migration;

/**
 * Class m220822_004656_seed_products_table
 */
class m220822_004656_seed_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insetFakeProduct();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220822_004656_seed_products_table cannot be reverted.\n";

        return false;
    }


    private function insetFakeProduct()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $this->insert(
                'products',
                [
                    "name" => $faker->name(),
                    "details" =>$faker->text()
                ]
            );
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220822_004656_seed_products_table cannot be reverted.\n";

        return false;
    }
    */
}
}
