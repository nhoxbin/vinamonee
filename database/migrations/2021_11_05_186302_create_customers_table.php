<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->json('info');
            /* Tên, ngày sinh
            - Số chưng minh, ngày cấp, nơi cấp
            - Nghề nghiệp - mức lương
            - Hộ khẩu thường trú
            - Nơi ở hiện tại
            - Số điện thoại
            - Số tiền vay
            - Thời gian vay bao nhiêu tháng
            - Tài sản đảm bảo( các loại giấy tờ )
            - 2 số điện thoại tham chiếu người thân */
            $table->boolean('is_appraised')->default(false); // thẩm định
            $table->boolean('is_disbursed')->default(false); // giải ngân
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
        Schema::dropIfExists('customers');
    }
}
