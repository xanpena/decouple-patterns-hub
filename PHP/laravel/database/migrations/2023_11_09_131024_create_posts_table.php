<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $tableName = 'posts';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id()->comment('PK');
            $table->bigInteger('user_id')->unsigned()->comment('FK to users table.');
            $table->string('title', 100)->comment('PostTitle string');
            $table->text('body')->comment('PostBody text');
            $table->timestamp('created_at')->useCurrent()->comment('CURRENT_TIMESTAMP');
            $table->timestamp('updated_at')
                  ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                  ->comment('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
            $table->softDeletes()->comment('Internal softDeletes');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
