<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QA;

class QASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionsAndAnswers = [
            [
                'question' => 'Tại sao nên quyên góp cho động vật?',
                'answer' => 'Quyên góp cho động vật là cách để giúp cải thiện cuộc sống và giảm bớt nỗi đau cho các loài động vật bị bỏ rơi, bị bạo hành hoặc đang đối mặt với nguy cơ bị tuyệt chủng. Bằng cách hỗ trợ các tổ chức và dự án quyên góp cứu trợ động vật, bạn có thể giúp cung cấp thức ăn, chăm sóc y tế, và môi trường sống an toàn cho động vật, đồng thời thúc đẩy sự nhân đạo và lòng yêu thương.',
            ],
            [
                'question' => 'Quyên góp của tôi sẽ được sử dụng như thế nào?',
                'answer' => 'Tiền quyên góp của bạn sẽ được sử dụng để cung cấp thức ăn, chăm sóc y tế, cứu trợ khẩn cấp và xây dựng môi trường sống mới cho các động vật cần được giúp đỡ.',
            ],
            [
                'question' => 'Làm thế nào tôi có thể đóng góp?',
                'answer' => 'Bạn có thể đóng góp bằng cách quyên tiền mặt, cung cấp thức ăn và vật dụng, tình nguyện làm việc tại các trung tâm cứu trợ, hoặc lan tỏa thông điệp về tình yêu thương và chăm sóc đến cộng đồng xung quanh bạn.',
            ],
            [
                'question' => 'Làm thế nào để biết được công việc cứu trợ của tổ chức của bạn là minh bạch và đáng tin cậy?',
                'answer' => 'Chúng tôi cam kết đảm bảo sự minh bạch và công khai trong mọi hoạt động cứu trợ của chúng tôi. Bạn có thể tìm hiểu thêm về các dự án và chương trình cứu trợ của chúng tôi qua website hoặc các tài liệu thông tin.',
            ],
            [
                'question' => 'Tôi có thể giúp đỡ thế nào ngoài việc quyên góp tiền bạc?',
                'answer' => 'Ngoài việc quyên góp tiền bạc, bạn cũng có thể giúp đỡ bằng cách chia sẻ thông điệp về quyên góp, tình nguyện làm việc tại các trung tâm cứu trợ, hoặc tổ chức các sự kiện gây quỹ và gây động viên trong cộng đồng của bạn.',
            ],
            [
                'question' => 'Làm sao để nhận nuôi thú cưng?',
                'answer' => 'Nhận nuôi thú cưng là một quyết định có trách nhiệm và cần được xem xét kỹ lưỡng. Đầu tiên, bạn cần xác định loài thú cưng phù hợp với tình hình và điều kiện của bạn, bao gồm không gian sống, thời gian dành cho chăm sóc và tài chính.',
            ],
        ];

        foreach ($questionsAndAnswers as $qa) {
            QA::create($qa);
        }
    }
}
