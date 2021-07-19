<?php

declare(strict_types=1);

use Ctrlc\Order\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('total')->unsigned()->nullable();
            $table->enum('status', [Status::toValues()])->default(Status::PENDING());
            $table->text('cart_snapshot')->nullable();
            $table->nullableMorphs('submittable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
