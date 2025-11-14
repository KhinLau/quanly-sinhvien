<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoVietnameseCharacters implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Biểu thức chính quy kiểm tra SỰ CÓ MẶT của các ký tự tiếng Việt
        // Bao gồm các chữ cái có dấu và chữ 'đ'
        $pattern = '/[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ]/u';

        // Nếu chuỗi chứa ký tự tiếng Việt (preg_match trả về true), gọi hàm $fail
        if (preg_match($pattern, $value)) {
            $fail('Trường :attribute không được chứa ký tự tiếng Việt.');
        }
    }
//     public function passes($attribute, $value): bool
//     {
//         // Kiểm tra xem chuỗi có chứa ký tự tiếng Việt hay không
//         return !preg_match('/[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ]/u', $value);
//     }

//     public function message(): string
//     {
//         return 'Trường :attribute không được chứa ký tự tiếng Việt.';
//     }
}
