<?php

namespace App\Http\Controllers\CourseBuyings;

use App\Http\Controllers\Controller;
use App\Models\Buying;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class StudentBuyingCourseController extends Controller
{

    //function for return your buying courses view
    public function index()
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get buying courses
            $courses = $authUser->buyings()
                ->distinct('course_id')
                ->orderByDesc('created_at')
                ->get();

            return view('students.buyings')
                ->with('courses', $courses);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for store course buying operation
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $webhookSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $signature, $webhookSecret);
            switch ($event->type) {
                case 'payment_intent.succeeded':

                    $session = $event->data->object; // Contains the metadata and other details

                    $courseId = $session->metadata->course_id;
                    $userId = $session->metadata->user_id;
                    $coursePrice = $session->metadata->course_price;

                    Course::findOrFail($courseId);

                    Buying::create(
                        [
                            'course_id' => $courseId,
                            'student_id' => $userId,
                            'course_price' => $coursePrice
                        ]
                    );

                    break;
                default:
                    Log::warning('Unhandled webhook event type: ' . $event->type);
                    break;
            }
            return response('Success', 200);
        } catch (SignatureVerificationException $e) {
            return response($e->getMessage(), 403);
        } catch (\Exception $e) {
            return response('Error', 500);
        }
    } //end handleWebhook

}//end StudentBuyingCourseController
