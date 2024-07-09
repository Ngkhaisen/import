<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hextar_dataset_combine', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_backup')->nullable();
            $table->string('points')->nullable();
            $table->string('status_id')->nullable();
            $table->string('skype')->nullable();
            $table->string('zoom')->nullable();
            $table->string('telegram')->nullable();
            $table->string('member_from')->nullable();
            $table->string('wechat')->nullable();
            $table->string('QQ')->nullable();
            $table->string('weibo')->nullable();
            $table->string('twitter')->nullable();
            $table->string('michat')->nullable();
            $table->string('facebook')->nullable();
            $table->string('login_from')->nullable();
            $table->string('firebase_token')->nullable();
            $table->string('device_token')->nullable();
            $table->string('firebase_register')->nullable();
            $table->string('send')->nullable();
            $table->string('phone_verified')->nullable();
            $table->string('imported')->nullable();
            $table->string('no_show_phone')->nullable();
            $table->string('primary_company')->nullable();
            $table->string('employee_level')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('channel_id')->nullable();
            $table->string('ihextar_used_id')->nullable();
            $table->string('profile_image')->nullable();



            $table->boolean('is_active')->default(1);
            $table->string('point_updated_at')->nullable();
            $table->string('license_accept_version')->nullable();
            $table->string('is_viewable')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hextar_dataset_combine');
    }
};
