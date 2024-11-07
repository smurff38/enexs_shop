<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_user');  // столбец с именем id_user
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('summ', 10, 2);
            $table->enum('status', ['Создан', 'В обработке', 'Сборка', 'Готов к выдаче', 'Завершён', 'Отменён'])->default('Создан');
            $table->boolean('payment_method');
            $table->foreign('id_user')
            ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
