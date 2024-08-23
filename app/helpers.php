<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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

}//end if


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

}//end if
