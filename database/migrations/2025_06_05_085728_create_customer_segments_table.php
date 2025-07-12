<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_segments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->enum('segment_type', ['silver', 'gold', 'platinum'])->default('silver');
            $table->integer('transaction_count')->default(0);
            $table->decimal('total_spent', 15, 2)->default(0);
            $table->date('last_transaction_date')->nullable();
            $table->timestamps();
            
            $table->index(['users_id', 'segment_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_segments');
    }
};