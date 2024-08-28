<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

//function for provide student guard name
if (! function_exists('getStudentGuard')) {

    function getStudentGaurd(): string
    {
        return "student-web";
    } //end getStudentGaurd

} //end if


//function for provide student guard name
if (! function_exists('getInstructorGuard')) {

    function getInstructorGuard(): string
    {
        return "instructor-web";
    } //end getInstructorGuard

} //end if


//function for check student is auth or no
if (! function_exists('isStudentAuth')) {

    function isStudentAuth(): bool
    {
        return auth(getStudentGaurd())->check();
    } //end getInstructorGuard

} //end if


//function for check instructor is auth or no
if (! function_exists('isInstructorAuth')) {

    function isInstructorAuth(): bool
    {
        return auth(getInstructorGuard())->check();
    } //end getInstructorGuard

} //end if


//function for encrypt password
if (! function_exists('encryptPassword')) {

    function encryptPassword($password): string
    {
        return Hash::make($password);
    } //end encryptPassword

} //end if


//function for encrypt password
if (! function_exists('dencryptPassword')) {

    function isPasswordCorrect($plainPassword, $hashedPassword): bool
    {
        if (Hash::check($plainPassword, $hashedPassword)) {
            // كلمة المرور مطابقة
            return true;
        } else {
            // كلمة المرور غير مطابقة
            return false;
        }
    } //end dencryptPassword

} //end if


//function for provide status name
if (! function_exists('provideStatusName')) {

    function provideStatusName($status): string
    {
        if ($status == 1) {
            return 'active';
        } else {
            return 'deactive';
        }
    } //end encryptPassword

} //end if


//function for provide status color
if (! function_exists('provideStatusColor')) {

    function provideStatusColor($status): string
    {
        if ($status == 1) {
            return 'color:limegreen';
        } else {
            return 'color:red';
        }
    } //end encryptPassword

} //end if


//function for format date
if (! function_exists('formatDate')) {

    function formatDate($dateString): string
    {
        // تحويل السلسلة النصية إلى كائن Carbon
        $date = Carbon::parse($dateString);

        // تنسيق التاريخ إلى الشكل المطلوب
        $formattedDate = $date->format('Y/m/d');

        return $formattedDate;
    } //end encryptPassword

} //end if


//function for provide react count for teacher
if (! function_exists('reactCount')) {

    function reactCount($teacher)
    {
        $contents = $teacher->contents;
        $result = 0;

        foreach ($contents as $content) {
            $result += count($content->reacts ?: []);
        } //end foreach

        return $result;
    } //end reactCount

} //end if


//function for provide react count for teacher
if (! function_exists('commentCount')) {

    function commentCount($teacher)
    {
        $contents = $teacher->contents;
        $result = 0;

        foreach ($contents as $content) {
            $result += count($content->comments ?: []);
        } //end foreach

        return $result;
    } //end commentCount

} //end if


//function for make payment session
if (! function_exists('makePaymentSession')) {

    function makePaymentSession($course, $contentid)
    {
        // إعداد المفتاح السري الخاص بـ Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // الحصول على المستخدم المفوض
        $user = Auth::guard(getStudentGaurd())->user();

        // التحقق من وجود معرف العميل في Stripe
        if (!$user->stripe_account_id) {
            // إذا لم يكن موجوداً، قم بإنشاء عميل جديد في Stripe
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);
            $user->stripe_account_id = $customer->id;
            $user->save();
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        // إنشاء الجلسة مع `metadata`
        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => [
                        'name' => $course->title
                    ],
                    'unit_amount' => $course->course_price * 100
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_intent_data' => [
                'metadata' => [
                    'course_id' => (string) $course->id,
                    'user_id' => (string) $user->id,
                    'course_price' => (string) $course->course_price,
                ],
            ],
            'customer' => $user->stripe_account_id,
            'success_url' => route('student.playlist.content', $contentid),
            'cancel_url' => route('student.playlist.comments.view'),
        ]);

        // إعادة توجيه المستخدم إلى رابط الجلسة
        return redirect($session->url);
    } //end makePaymentSession

}//end if
