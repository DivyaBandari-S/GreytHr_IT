<?php

namespace App\Livewire;

use App\Helpers\FlashMessageHelper;
use App\Mail\ApproveRequestMail;
use App\Mail\assigneRequestMail;
use App\Mail\cancelRequestMail;
use App\Mail\RejectRequestMail;
use App\Mail\statusRequestMail;
use App\Models\ActivityLog;
use App\Models\EmployeeDetails;
use App\Models\HelpDesks;
use App\Models\HolidayCalendar;
use App\Models\Request;
use App\Models\IT;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Client\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use function Termwind\render;

class RequestProcess extends Component
{
    public $activeTab = 'active';
    public $requests = [];
    public $viewingDetails = false;
    public $recentrequestDetails = false;
    public $rejectedrequestDetails = false;
    public $viewRecentRequests = true;
    public $viewRejectedRequests = false;
    public $viewEmpRequest = false;
    public $showPopup = false;
    public $assignTo;
    public $comments;
    public $remarks =[];
    public $request;
    public $selectedRequest;
    public $recentRequest;
    public $cancelRequest;
    public $rejectedRequest;
    public $showOverview = false;
    public $showRejectionModal = false;
    public $showCancelModal = false;
    public $attachments;
    public $currentRequestId;
    public $newRequestCount;
    public $newRejectionCount;
    public $activeCount;
    public $pendingCount;
    public $inprogressCount;
    public $closedCount;
    public $file_path;
    public $pendingReason;





    protected $rules = [
        'request.assignTo' => 'required',
        'comments' => 'required',
        'request.status' => 'required',
        'remarks' => 'required',
        'selectedStatus' => 'required',
        'selectedAssigne' => 'required',
    ];


    public function setActiveTab($tab)
    {

        $this->activeTab = $tab;
        $this->viewingDetails = false;
        $this->recentrequestDetails = false;
        $this->rejectedrequestDetails = false;

        $this->selectedStatus = '';
        $this->selectedAssigne = '';
        $this->updateCounts();
    }

    public $employee ;

    public function mount()
    {
        try {
            // Get the authenticated user
            $employee = auth()->user();

            // Set flags based on user role
            if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))) {
                // Admin or super admin user settings
                $this->viewRecentRequests = true; // User can view recent requests
                $this->viewRejectedRequests = false; // User can view recent requests
            } else {
                // Non-admin user settings
                $this->viewRecentRequests = false; // User cannot view recent requests
                $this->viewRejectedRequests = false; // User cannot view rejected requests
                $this->recentrequestDetails = false; // No request details available
                $this->rejectedrequestDetails = false; // No request details available
                $this->viewEmpRequest = true; // User can view their own requests
            }

            // Initialize other properties
            $this->selectedStatus = '';
            $this->selectedAssigne = '';

            // Update counts
            $this->updateCounts();

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in mount method", [
                'exception' => $e,
                'user' => auth()->check() ? auth()->user()->id : 'Guest',
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while initializing the request details.");

            // Optionally, reset or set default values in case of an error
            $this->viewRecentRequests = false;
            $this->viewRejectedRequests = false;
            $this->recentrequestDetails = false;
            $this->rejectedrequestDetails = false;
            $this->viewEmpRequest = true; // Default to showing employee requests
        }
    }


    public function showAllRequest() {
        $this->viewRecentRequests = false;
        $this->viewRejectedRequests = false;
        $this->viewEmpRequest = true;
    }

    public function showRejectedRequest() {
        $this->viewRecentRequests = false;
        $this->viewRejectedRequests = true;
        $this->viewEmpRequest = false;
    }

    public function showRecentRequest() {
        $this->viewRecentRequests = true;
        $this->viewRejectedRequests = false;
        $this->viewEmpRequest = false;
    }

    public function showAttachments($requestId)
    {
        $request = collect($this->requests)->firstWhere('id', $requestId);
        $this->attachments = explode(',', $request['attach_files']);
    }

    public function getInProgressRequestsProperty()
    {
        return array_filter($this->requests, function ($request) {

            return $request['status_code'] == '5';
        });
    }
    public function getClosedRequestsProperty()
    {
        return array_filter($this->requests, function ($request) {
            return $request['status_code'] == '11';
        });
    }

    public function viewRejectDetails($index)
    {
        try {
            $this->comments = '';
            $this->rejectedRequest = $this->rejectDetails->where('status_code', '3')->values()->get($index);

            // Check if the selected request exists
            if (!$this->rejectedRequest) {
                abort(404, 'Request not found');
            }

            $this->rejectedrequestDetails = true;
            $this->currentRequestId = $this->rejectedRequest->id;

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in viewRejectDetails method", [
                'exception' => $e,
                'index' => $index,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while viewing the rejected request.");

            // Optionally, reset properties in case of error
            $this->rejectedrequestDetails = false;
            $this->currentRequestId = null;
        }
    }

    public function viewApproveDetails($index)
    {
        try {
            $this->comments = '';
            $this->recentRequest = $this->recentDetails->where('status_code', '8')->values()->get($index);

            // Check if the selected request exists
            if (!$this->recentRequest) {
                abort(404, 'Request not found');
            }

            $this->recentrequestDetails = true;
            $this->currentRequestId = $this->recentRequest->id;

            $requestedBy= EmployeeDetails::where('emp_id' ,  $this->recentRequest->emp_id)->first();
            $fullName = ucwords(strtolower($requestedBy->first_name . ' ' . $requestedBy->last_name));
               ActivityLog::create([
                   'impact' => 'High',
                   'opened_by' =>  $fullName ,
                   'priority' =>  $this->recentRequest->priority,
                   'state' => "Recent",
                   'performed_by' =>  $fullName,
                   'request_type' => $this->recentRequest->category,
                   'request_id' => $this->recentRequest->request_id,
               ]);


        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in viewApproveDetails method", [
                'exception' => $e,
                'index' => $index,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while viewing the approved request.");

            // Optionally, reset properties in case of error
            $this->recentrequestDetails = false;
            $this->currentRequestId = null;
        }
    }

    public function viewDetails($index)
    {
        try {
            $this->comments = '';
            $this->selectedAssigne = '';
            $this->selectedStatus = '';
            $this->selectedRequest = $this->forIT->where('status_code', '10')->values()->get($index);
            $this->viewingDetails = true;

            // Check if the selected request exists
            if (!$this->selectedRequest) {
                abort(404, 'Request not found');
            }

            $this->currentRequestId = $this->selectedRequest->id;
            $file_path = $this->selectedRequest->file_path;

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in viewDetails method", [
                'exception' => $e,
                'index' => $index,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while viewing the request details.");

            // Optionally, reset properties in case of error
            $this->viewingDetails = false;
            $this->currentRequestId = null;
        }
    }


    public function toggleOverview()
    {
        $this->showOverview = !$this->showOverview;
    }


    public function closeDetailsBack()
    {
        $this->viewingDetails = false;
        $this->viewRecentRequests = false;
        $this->recentrequestDetails = false;

        // $this->mount();
        // $this->selectedRequest = true;
    }

    public function closeDetails()
    {
        $this->viewingDetails = false;
        $this->recentrequestDetails = false;

        $this->mount();
        // $this->selectedRequest = true;
    }

    public function closeRejectDetails()
    {

        $this->viewingDetails = false;
        $this->viewRejectedRequests = true;
        $this->rejectedrequestDetails = false;


        $this->viewEmpRequest = false;

        $this->mount();
        // $this->selectedRequest = true;
    }

    public function redirectBasedOnStatus()
    {

        $this->validate([
            'selectedStatus' => 'required',

            'selectedAssigne' => 'required',
        ], [
            'selectedStatus.required' => 'Status is required.',
            'selectedAssigne.required' => 'Assign to is required.',
        ]);


        if ($this->selectedStatus === '5') {

            $this->setActiveTab('pending');

        } elseif ($this->selectedStatus === '11') {

            $this->setActiveTab('closed');

        }
        $this->reset(['selectedStatus', 'selectedAssigne']);
        $this->resetErrorBag();
        $this->updateCounts();
    }







    public function openForDesks($taskId)
    {
        $task = HelpDesks::find($taskId);

        if ($task) {
            $task->update(['status_code' => '11']);
            FlashMessageHelper::flashSuccess("Status Closed successfully!");

            $employee = auth()->guard('it')->user(); // Get the logged-in user
    ActivityLog::create([
        'action' => 'State',
        'details' => "Work in Progress was Closed for Request ID - {$task->request_id}",
        'performed_by' => $employee->employee_name,
        'request_type' => 'Catologue Request',
        'request_id' => $task->request_id,
    ]);

        }

        $this->updateCounts();
    }
    public $error = '';
    public $loading = false;
    public function closeForDesks($taskId)
    {
        $this->loading = true;
        sleep(3);
        $task = HelpDesks::find($taskId);
        try {
        if ($task) {
            $task->update(['status_code' => '10']);
            FlashMessageHelper::flashSuccess("Status Reopened successfully!");

        }
    }catch (\Exception $e) {
        // Handle exception
        $this->error = "An unexpected error occurred. Please try again.";
    } finally {
        $this->loading = false;

    }
        $this->updateCounts();
    }



    public function approveStatus($taskId)
    {

        $task = HelpDesks::with('emp')->where('id', $taskId)->find($taskId);

        $admindetails = EmployeeDetails::with('its')
        ->whereHas('its', function ($query) {
            $query->where('role', 'admin');
        })
        ->get();

        if ($admindetails->isEmpty()) {
            Log::error("No admin details found.");
            FlashMessageHelper::flashError("No admin details available. ");

            return back()->withErrors(['error' => 'No admin details available.']);
        }

        $adminEmail = $admindetails[0]->email;

        $adminEmail = preg_replace('/\s+/', '', $adminEmail); // Removes all whitespace characters
        if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            // Log or handle the invalid email scenario
            FlashMessageHelper::flashError("Invalid email address: ");
            Log::error("Invalid email address: " . $adminEmail);
            return back()->withErrors(['error' => 'Invalid email address.']);
        }


        if (empty($adminEmail)) {
            Log::error("No email address provided for request ID: " . $admindetails[0]->request_id);
            return back()->withErrors(['error' => 'No email address associated with this request.']);
        }


        $employeeName = $task ->emp->first_name . ' ' . $task ->emp->last_name;

        $employee = auth()->guard('it')->user();
        $requestId = $task->request_id;

        $category = $task->category;
        $shortDescription = $task->description; // Assuming this field exists
        $RejetedEmployeeName =  ucwords(strtolower($employee->employee_name));
    // Send rejection email
       Mail::to($adminEmail)->send(new ApproveRequestMail(
        $employeeName,
        $RejetedEmployeeName ,
        $requestId,
        $shortDescription,
        $category,

    ));


        if ($task) {
            $activityDetails = '';
            // Set the status to "Open" when approving
            $task->update(['status_code' => '10']);
            $activityDetails = "Request was Approved by {$RejetedEmployeeName} for Request ID - {$task->request_id}";
            FlashMessageHelper::flashSuccess("Request has been approved, and email has been sent!");
            ActivityLog::create([
                'action' => 'State',
                'details' => $activityDetails,
                'performed_by' => $RejetedEmployeeName,
                'request_type' => 'Catologue Request',
                'request_id' => $task->request_id,
            ]);
            $this->updateCounts();
        }
        return redirect()->route('requests');

    }

    public $recordId;
    public $reason = [];

    public function rejectionModal($taskId)
    {
        $this->recordId = $taskId;
        $this->showRejectionModal =true;

    }

    public function cancelModal($taskId)
    {
        $this->recordId = $taskId;
        $this->showCancelModal =true;

    }

    public $priority;
    public function selectPriority($value)
    {
        // Update the priority field in the database

        $activityDetails = '';
        $this->recentRequest->priority = $value;
        $this->recentRequest->save();


        $employee = auth()->guard('it')->user();
        $RejetedEmployeeName =  ucwords(strtolower($employee->employee_name));

        $activityDetails = "Priority has been changed to {$value} for Request ID - {$this->recentRequest->request_id}";
        ActivityLog::create([
            'action' => 'State',
            'details' => $activityDetails,
            'performed_by' => $RejetedEmployeeName,
            'request_type' => 'Catologue Request',
            'priority' => $value,
            'request_id' => $this->recentRequest->request_id,
        ]);
        FlashMessageHelper::flashSuccess("Priority updated successfully!!");

        // Optionally, you can flash a success message or notify the user
    }


         public $showPendingModal = false;
         public $pendingRequestId = '';
        public function handleStatusChange($requestId)
    {
        if ($this->selectedStatus == '5') { // Pending
            $this->showPendingModal = true;
            $this->pendingRequestId = $requestId;

        } elseif ($this->selectedStatus == '15') { // Cancel
            $this->cancelModal($requestId);
        } else {
            $this->updateStatus($requestId);
        }
    }

        public function closePendingModal()
    {
        $this->showPendingModal = false;
        $this->reset(['pendingReason', 'pendingRequestId']);
    }


    public function submitPendingReason()
    {
        $this->validate([
            'pendingReason' => 'required|string|max:255',
        ]);
        // Update the request status and reason

        $task = HelpDesks::find($this->pendingRequestId);

        if ($task && $this->selectedStatus) {

            $employee = auth()->guard('it')->user();
            $employeeEmail = $task->mail;  // The input string

            $employeeName = $task->emp->first_name . ' ' . $task->emp->last_name;

            $requestId = $task->request_id;
            $shortDescription = $task->description; // Assuming this field exists

            if ($this->selectedStatus === '5') {
                // Send Pending email
                Mail::to($employeeEmail)->send(new StatusRequestMail(
                    $employeeName,
                    $requestId,
                    $shortDescription,
                    $task->category,
                    'Pending'  // Passing a flag for Pending
                ));
            }

            // Update the task status
            $task->update(['status_code' => $this->selectedStatus,
                            'pending_reason' => $this->pendingReason]);


            // Flash a success message based on the selected status
            if ($this->selectedStatus === '5') {
                $activityDetails = "Work in Progress was Pending for Request ID - {$task->request_id}";
                FlashMessageHelper::flashSuccess("Status has been set to Pending, and email has been sent!");
            }
             else {
                FlashMessageHelper::flashSuccess("Status Updated successfully!");
            }
        } else {
            // Handle case where the task was not found or no status is selected
            FlashMessageHelper::flashError("Task not found or invalid status.");
        }


        $assigneName =  ucwords(strtolower($employee->employee_name));
        ActivityLog::create([
            'action' => 'State',
            'details' => $activityDetails,
            'performed_by' => $assigneName,
            'request_type' => 'Catologue Request',
            'request_id' => $task->request_id,
        ]);




        $this->closePendingModal();
        
    }


    public function cancelStatus()
    {
        $this->validate([

            'reason' => 'required|string|max:255', // Validate the remark input
        ], [
            'reason.required' => 'Reason is required.',
        ]);


        try {

            $cancelRequest = HelpDesks::with('emp')->where('id', $this->recordId)->first();

            if ($cancelRequest) {

                if ($cancelRequest) {
                    $cancelRequest->update([
                        'status_code' => '15',
                        'rejection_reason' => $this->reason,
                    ]);
                }


                // Set the status to "Reject" when rejecting the request

                $employee = auth()->guard('it')->user();
                $employeeEmail = $cancelRequest->mail;  // The input string
                $rejectionReason = $this->reason;

            // Send rejection email
               Mail::to($employeeEmail)->send(new cancelRequestMail(
               $cancelRequest,
               $employee,
               $rejectionReason,
            ));
            FlashMessageHelper::flashSuccess("Request has been canceled, and email has been sent!");

                $this->updateCounts();

                $this->showCancelModal = false;

                // Reset the recordId and reason after processing
                $this->recordId = null;
                $this->reason = '';
            } else {
                // Handle case when the request is not found
                FlashMessageHelper::flashError("Request not found.");
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in rejectStatus method", [
                'exception' => $e,
                'recordId' => $this->recordId,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while rejecting the request.");
        }
    }

    public function rejectStatus()
    {
        $this->validate([

            'reason' => 'required|string|max:255', // Validate the remark input
        ], [
            'reason.required' => 'Reason is required.',
        ]);

        try {
            $recentRequest = HelpDesks::with('emp')->where('id', $this->recordId)->first();

            if ($recentRequest) {

                if ($recentRequest) {
                    $recentRequest->update([
                        'rejection_reason' => $this->reason,
                        'status_code' => '3'
                    ]);
                }
                // Set the status to "Reject" when rejecting the request


                $employee = auth()->guard('it')->user();
                $employeeEmail = $recentRequest->mail;  // The input string




                // Output the matched IDs

                $employeeName = $recentRequest->emp->first_name . ' ' . $recentRequest->emp->last_name;

                $requestId = $recentRequest->request_id;

                $shortDescription = $recentRequest->description; // Assuming this field exists

                $RejetedEmployeeName =  ucwords(strtolower($employee->employee_name));

            // Send rejection email
               Mail::to($employeeEmail)->send(new RejectRequestMail(
                $employeeName,
                $this->reason,
                $requestId,
                $shortDescription,
                $RejetedEmployeeName,
                $recentRequest->category,


            ));

            $activityDetails = '';
            // Set the status to "Open" when approving

            $activityDetails = "Request was Rejected by {$RejetedEmployeeName} for Request ID - {$recentRequest->request_id}";

            FlashMessageHelper::flashSuccess("Request has been rejected, and email has been sent!");

            ActivityLog::create([
                'action' => 'State',
                'details' => $activityDetails,
                'performed_by' => $RejetedEmployeeName,
                'request_type' => 'Catologue Request',
                'request_id' => $recentRequest->request_id,
            ]);

                $this->updateCounts();

                $this->showRejectionModal = false;

                // Reset the recordId and reason after processing
                $this->recordId = null;
                $this->reason = '';
            } else {
                // Handle case when the request is not found
                FlashMessageHelper::flashError("Request not found.");
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in rejectStatus method", [
                'exception' => $e,
                'recordId' => $this->recordId,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while rejecting the request.");
        }
    }


    public function Cancel()
    {

        $this->showRejectionModal = false;
        $this->showCancelModal = false;
    }


    public function inprogressForDesks($taskId)
    {

        $task = HelpDesks::find($taskId);

        if ($task) {
            if ($task->in_progress_since === null) {

                $task->in_progress_since = now();
            }

            $task->status_code = '16';  // Set status to InProgress
            $task->save();

            $activityDetails = "Work in Progress was Inprogress for Request ID - {$task->request_id}";

            $employee = auth()->guard('it')->user(); // Get the logged-in user
            ActivityLog::create([
                'action' => 'State',
                'details' => "$activityDetails",
                'performed_by' => $employee->employee_name,
                'request_type' => 'Catologue Request',
                'request_id' => $task->request_id,
            ]);

            FlashMessageHelper::flashSuccess("Status Changed to inprogress!");
            $this->updateCounts();
        }

    }




    public function pendingForDesks($taskId)
    {

        $task = HelpDesks::find($taskId);

        if ($task) {
           // Calculate elapsed time since "InProgress" state started
    $elapsedTime = \Carbon\Carbon::parse($task->in_progress_since)->diffInMinutes(now());

    // Update the total in-progress time and set status to Pending
    $task->total_in_progress_time += $elapsedTime;  // Add elapsed time to total
    $task->update([
        'status_code' => '5',  // Set status to Pending
        'in_progress_since' => null,  // Stop the timer
    ]);

    $employee = auth()->guard('it')->user(); // Get the logged-in user
    ActivityLog::create([
        'action' => 'State',
        'details' => "Work in Progress was changed from Inprogress to Pending for Request ID - {$task->request_id}",
        'performed_by' => $employee->employee_name,
        'request_type' => 'Catologue Request',
        'request_id' => $task->request_id,
    ]);

            FlashMessageHelper::flashSuccess("Status Changed to pending!");
            $this->updateCounts();

        }

    }


    public $selectedStatus;

    public function updateStatus($taskId)
    {

        $this->validateOnly('selectedStatus');

        try {

            $this->resetErrorBag('selectedStatus');

            // Find the task by ID
            $task = HelpDesks::find($taskId);
            // Check if the task exists and a valid status is selected
            if ($task && $this->selectedStatus) {

                $employee = auth()->guard('it')->user();
                $employeeEmail = $task->mail;  // The input string

                $employeeName = $task->emp->first_name . ' ' . $task->emp->last_name;

                $requestId = $task->request_id;
                $shortDescription = $task->description; // Assuming this field exists

                if ($this->selectedStatus === '5') {
                    // Send Pending email
                    Mail::to($employeeEmail)->send(new StatusRequestMail(
                        $employeeName,
                        $requestId,
                        $shortDescription,
                        $task->category,
                        'Pending'  // Passing a flag for Pending
                    ));
                } elseif ($this->selectedStatus === '11') {
                    // Send Completed email
                    Mail::to($employeeEmail)->send(new StatusRequestMail(
                        $employeeName,
                        $requestId,
                        $shortDescription,
                        $task->category,
                        'Completed'  // Passing a flag for Completed
                    ));
                }

                // Update the task status
                $task->update(['status_code' => $this->selectedStatus]);


                // Flash a success message based on the selected status
                if ($this->selectedStatus === '5') {
                    $activityDetails = "Work in Progress was Pending for Request ID - {$task->request_id}";
                    FlashMessageHelper::flashSuccess("Status has been set to Pending, and email has been sent!");
                }  elseif ($this->selectedStatus === '16') {
                    $task->in_progress_since = now();  // Set the current timestamp
                    $task->save();
                    $activityDetails = "Work in Progress was Inprogress for Request ID - {$task->request_id}";
                    FlashMessageHelper::flashSuccess("Status has been set to Inprogress, and email has been sent!");
                } elseif ($this->selectedStatus === '11') {
                    $activityDetails = "Work in Progress was Completed for Request ID - {$task->request_id}";
                    FlashMessageHelper::flashSuccess("Status has been set to Completed, and email has been sent!");
                }elseif ($this->selectedStatus === '15') {
                    $activityDetails = "Work in Progress was Cancelled for Request ID - {$task->request_id}";
                    FlashMessageHelper::flashSuccess("Status has been set to Cancelled, and email has been sent!");
                }
                 else {
                    FlashMessageHelper::flashSuccess("Status Updated successfully!");
                }
            } else {
                // Handle case where the task was not found or no status is selected
                FlashMessageHelper::flashError("Task not found or invalid status.");
            }


            $assigneName =  ucwords(strtolower($employee->employee_name));
            ActivityLog::create([
                'action' => 'State',
                'details' => $activityDetails,
                'performed_by' => $assigneName,
                'request_type' => 'Catologue Request',
                'request_id' => $task->request_id,
            ]);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in updateStatus method", [
                'exception' => $e,
                'taskId' => $taskId,
                'selectedStatus' => $this->selectedStatus,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while updating the task status.");
        }
    }






    public $selectedAssigne;


    public function updateAssigne($taskId)
    {
        try {
            // Validate the selected assignee
            $this->validateOnly('selectedAssigne');
            $this->resetErrorBag('selectedAssigne');

            // Find the task by ID
            $task = HelpDesks::find($taskId);



            // Check if the task exists and a valid assignee is selected
            if ($task && $this->selectedAssigne) {
                // Update the task with the selected assignee

                $fullNameAndEmpId = $this->selectedAssigne;

                // Split the string by space
                $parts = explode(' ', $fullNameAndEmpId);

                // Extract emp_id (last element in the array)
                $empId = array_pop($parts);


                // Join the remaining parts to get the full name
                $fullName = implode(' ', $parts);

                $employee = auth()->guard('it')->user();

             $assignedAssigne = EmployeeDetails::where('emp_id' ,   $empId )->get();

                $fullName = $assignedAssigne[0]->first_name . ' ' . $assignedAssigne[0]->last_name;  // Concatenate first and last name
                $email = $assignedAssigne[0]->email;


            $employeeName = $fullName;
            $requestId = $task->request_id;
            $shortDescription = $task->description; // Assuming this field exists
            $assigneName =  ucwords(strtolower($employee->employee_name));


                // Send Pending email
                Mail::to($email)->send(new assigneRequestMail(
                    $assigneName,
                    $requestId,
                    $shortDescription,
                    $task->category,

                ));


                $task->update(['assign_to' => $this->selectedAssigne]);

                ActivityLog::create([
                    'action' => 'Assigned to',
                    'details' => "{$fullName}",
                    'performed_by' => $assigneName , // Assuming user is logged in
                    'request_type' => 'Catologue Request',
                    'request_id' =>   $task->request_id ,
                ]);

                FlashMessageHelper::flashSuccess("Task assigned successfully, and email has been sent!");
                // Optionally, you can add a success message here
                // session()->flash('message', 'Task assigned successfully!');
            } else {
                // Handle case where task was not found or no assignee selected
                FlashMessageHelper::flashError("Task not found or invalid assignee.");
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error("Error occurred in updateAssigne method", [
                'exception' => $e,
                'taskId' => $taskId,
                'selectedAssigne' => $this->selectedAssigne,
            ]);

            // Flash an error message for the user
            FlashMessageHelper::flashError("An error occurred while assigning the task.");
        }
    }



    public $showModal = false;

    public function viewRecord($id)
    {

        $requestCategories = Request::select('Request', 'category')
        ->where('Request', 'IT') // Adjust this to match the condition for IT requests
        ->pluck('category');
        // Fetch the record based on the ID
        $this->selectedRecord = HelpDesks::with('emp')
        ->whereIn('category',  $requestCategories)
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->orderBy('created_at', 'desc')
        ->find($id);

        $this->showModal = true;


    }

    public function closeModal()
        {
            $this->showModal = false; // Hide the modal
            $this->selectedRecord = null; // Reset the selected record
        }





    public function postComment($taskId)
{
    try {
        // Find the task by taskId
        $task = HelpDesks::find($taskId);

        // Check if task exists and a comment is provided
        if ($task && $this->comments) {
            // Update the task with the comment
            $task->update(['active_comment' => $this->comments]);

            $employee = auth()->guard('it')->user(); // Get the logged-in user

            ActivityLog::create([
                'action' => 'Active Comment',
                'details' => "$this->comments",
                'performed_by' => $employee->employee_name,
                'request_type' => 'Catologue Request',
                'request_id' => $task->request_id,
            ]);

            // Flash a success message
            FlashMessageHelper::flashSuccess("Comment posted successfully!");
        } else {
            // Handle case where task not found or no comment provided
            FlashMessageHelper::flashError("Task not found or no comment provided.");
        }
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error("Error occurred while posting comment", [
            'exception' => $e,
            'taskId' => $taskId,
            'comments' => $this->comments,
        ]);

        // Flash an error message
        FlashMessageHelper::flashError("An error occurred while posting the comment.");
    }
}

public function postPendingRemarks($taskId)
{
    try {
        // Retrieve remarks for the specific task
        $remarks = $this->remarks[$taskId] ?? '';
        // Find the task by taskId
        $task = HelpDesks::find($taskId);

        // Check if the task exists
        if ($task) {

            if (empty($this->remarks)) {
                FlashMessageHelper::flashError("Remarks cannot be empty.");
                return;
            }
            // Update the task with the remarks
            $task->update(['pending_remarks' => $remarks]);


            $employee = auth()->guard('it')->user(); // Get the logged-in user
            ActivityLog::create([
                'action' => 'Pending Comment',
                'details' =>  $remarks,
                'performed_by' => $employee->employee_name,
                'request_type' => 'Catologue Request',
                'request_id' => $task->request_id,
            ]);

            // Flash a success message
            FlashMessageHelper::flashSuccess("Remarks posted successfully!");
        } else {
            // Handle case where task not found
            FlashMessageHelper::flashError("Task not found.");
        }
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error("Error occurred while posting remarks", [
            'exception' => $e,
            'taskId' => $taskId,
            'remarks' => $remarks,
        ]);

        // Flash an error message
        FlashMessageHelper::flashError("An error occurred while posting the remarks.");
    }
}


public function postInprogressRemarks($taskId)
{
    try {
        // Retrieve remarks for the specific task
        $remarks = $this->remarks[$taskId] ?? '';
        // Find the task by taskId
        $task = HelpDesks::find($taskId);

        // Check if the task exists
        if ($task) {

            if (empty($this->remarks)) {
                FlashMessageHelper::flashError("Remarks cannot be empty.");
                return;
            }

            // Update the task with the remarks
            $task->update(['inprogress_remarks' => $remarks]);

            $employee = auth()->guard('it')->user(); // Get the logged-in user
            ActivityLog::create([
                'action' => 'Inprogress Comment',
                'details' => $remarks,
                'performed_by' => $employee->employee_name,
                'request_type' => 'Catologue Request',
                'request_id' => $task->request_id,
            ]);


            // Flash a success message
            FlashMessageHelper::flashSuccess("Remarks posted successfully!");
        } else {
            // Handle case where task not found
            FlashMessageHelper::flashError("Task not found.");
        }
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error("Error occurred while posting remarks", [
            'exception' => $e,
            'taskId' => $taskId,
            'remarks' => $remarks,
        ]);

        // Flash an error message
        FlashMessageHelper::flashError("An error occurred while posting the remarks.");
    }
}


public $filterType;
public function filterLogs($type)
{
    $this->filterType = $type;
    $this->loadLogs($this->requestID); // Re-load logs with the new filter
}


public $requestID;
public $catologueIDHeader = '';
public $activityLogs;
public $employeeInitials;

public function loadLogs($requestID = null)
{

    if ($requestID) {

        $this->requestID = $requestID;
        $this->catologueIDHeader =   $this->requestID;
        $query = ActivityLog::where('request_id', $this->requestID)
        ->when($this->filterType, function ($q) {
            return $q->where('created_at', $this->filterType);
        })
        ->orderBy('created_at', 'desc');

        $this->showPopup = true;


        // Apply filter if filterType is set
        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        // Fetch activity logs sorted by created_at in descending order
        $this->activityLogs = $query->get();

        $this->employeeInitials = [];
        foreach ($this->activityLogs as $log) {
            $this->employeeInitials[] = $this->getInitials($log->performed_by);
        }
    }
}


private function getInitials($name)
{
    $nameParts = explode(' ', $name);

    if (count($nameParts) < 2) {
        // If the name has less than 2 parts, just return the first letter of the first part
        return strtoupper(substr($nameParts[0], 0, 1));
    }

    // Extract the first letter of the first part and the last part
    $firstInitial = strtoupper(substr($nameParts[0], 0, 1));
    $lastInitial = strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));

    return $firstInitial . $lastInitial;
}


public function closePopup()
{
$this->showPopup = false;
$this->activityLogs = null; // Clear logs if needed
}


public function updateCounts()
{
    try {
        // Fetch categories for IT requests
        $requestCategories = Request::select('Request', 'category')
            ->where('Request', 'IT') // Adjust this to match the condition for IT requests
            ->pluck('category');

        // Count new requests (Recent)
        $this->newRequestCount = HelpDesks::where('status_code', '8')
            ->whereIn('category', $requestCategories)->count();

        // Count rejected requests (Reject)
        $this->newRejectionCount = HelpDesks::where('status_code', '3')
            ->whereIn('category', $requestCategories)->count();

        // Count active requests (Open)
        $this->activeCount = HelpDesks::where('status_code', '10')
            ->whereIn('category', $requestCategories)->count();

        // Count pending requests (Pending)
        $this->pendingCount = HelpDesks::where('status_code', '5')
            ->whereIn('category', $requestCategories)->count();

            $this->inprogressCount = HelpDesks::where('status_code', '16')
            ->whereIn('category', $requestCategories)->count();

        // Count closed requests (Completed)
        $this->closedCount = HelpDesks::where('status_code', ['11', '15'])
        ->whereIn('category', $requestCategories)->count();

    } catch (\Exception $e) {
        // Log the exception for debugging purposes
        Log::error("Error occurred while updating counts", [
            'exception' => $e,
        ]);

        // Optionally, set all counts to zero or handle the error gracefully
        $this->newRequestCount = 0;
        $this->newRejectionCount = 0;
        $this->activeCount = 0;
        $this->pendingCount = 0;
        $this->closedCount = 0;

        // Flash an error message to inform the user
        FlashMessageHelper::flashError("An error occurred while updating the request counts.");
    }
}

     public $sortColumn = 'emp_id'; // default sorting column
    public $sortDirection = 'asc'; // default sorting direction

    public function toggleSortOrder($column)
    {
        try {
        if ($this->sortColumn == $column) {
            // If the column is the same, toggle the sort direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {

            // If a different column is clicked, set it as the new sort column and default to ascending order
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }

    } catch (\Exception $e) {
        // Log the error message
        Log::error('Error in toggleSortOrder: ' . $e->getMessage());

        // Optionally, set default sort direction or handle the error gracefully
        $this->sortColumn = 'emp_id'; // Example default sort column
        $this->sortDirection = 'asc'; // Example default sort direction

        // You may want to display an error message to the user, if needed
        session()->flash('error', 'An error occurred while changing the sort order.');
    }

    }


    public $selectedRecord = null;




    public $forIT;
    public $recentDetails;
    public $rejectDetails;
    public $requestData;
    public $itData;
    public $requestCategories='';
  public function render()
{
    try {
        // Fetch IT request categories
        $requestCategories = Request::select('Request', 'category')
            ->where('Request', 'IT') // Adjust this to match the condition for IT requests
            ->pluck('category');

        // Fetch IT data (empIt related data)
        $this->itData = IT::with('empIt')->get();

        $companyId = auth()->guard('it')->user()->company_id;

        // Fetch HelpDesk records based on the category and companyId
        $this->forIT = HelpDesks::with('emp')
            ->whereHas('emp', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->orderBy('created_at', 'desc')
            ->whereIn('category',  $requestCategories)
            ->get();

        // Fetch recent, rejected, and active details based on status
        $this->recentDetails = HelpDesks::with('emp')
            ->where('status_code', '8')
            ->orderBy('created_at', 'desc')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->whereIn('category',  $requestCategories)
            ->get();

        $this->rejectDetails = HelpDesks::with('emp')
            ->where('status_code', '3')
            ->orderBy('created_at', 'desc')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->whereIn('category',  $requestCategories)
            ->get();

        // Dynamic query for the active tab filter
        if ($this->activeTab == 'active') {
            $this->forIT = HelpDesks::with('emp')
                ->where('status_code', '10')
                ->orderBy('created_at', 'desc')
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->whereIn('category',  $requestCategories)
                ->get();
        } elseif ($this->activeTab == 'pending') {
            $this->forIT = HelpDesks::with('emp')
                ->where('status_code', '5')
                ->whereIn('category', $requestCategories)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->orderBy('created_at', 'desc')
                ->get();
        }elseif ($this->activeTab == 'inprogress') {
            $this->forIT = HelpDesks::with('emp')
                ->where('status_code', '16')
                ->whereIn('category', $requestCategories)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        elseif ($this->activeTab == 'closed') {
            $this->forIT = HelpDesks::with('emp')
            ->whereIn('status_code', ['11', '15'])
                ->whereIn('category',  $requestCategories)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Handling IT requests after 7 days to update status
        if (auth()->guard('it')->check()) {
            $companyId = auth()->guard('it')->user()->company_id;
            $thresholdDate = Carbon::now()->subDays(7);

            // Get holidays within the last 7 days
            $holidays = HolidayCalendar::whereBetween('date', [$thresholdDate->startOfDay(), Carbon::now()->endOfDay()])
                ->pluck('date')
                ->map(function($date) {
                    return Carbon::parse($date)->format('Y-m-d'); // Normalize date format
                })
                ->toArray();

            // Count the number of non-holiday days in the last 7 days
            $nonHolidayDays = 0;
            $currentDate = Carbon::now()->startOfDay();

            while ($currentDate->greaterThanOrEqualTo($thresholdDate->startOfDay())) {
                $formattedDate = $currentDate->format('Y-m-d');

                // Check if it's a weekend or a holiday
                if (!in_array($formattedDate, $holidays) && !in_array($currentDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    $nonHolidayDays++;
                }

                $currentDate->subDay(); // Move to the previous day
            }

            // Update the status of older IT requests
            $recentRequest = HelpDesks::where('status_code', '8')
            ->where('created_at', '<=', $thresholdDate)
            ->first();

            if ($recentRequest) {

                // Update the status of older IT requests
                $recentRequest->update(['status_code' => '3']);
                $employee = auth()->guard('it')->user();
                // Prepare the email details
                $employeeEmail = $recentRequest->mail;
                $employeeName = $recentRequest->emp->first_name . ' ' . $recentRequest->emp->last_name;
                $requestId = $recentRequest->request_id;
                $shortDescription = $recentRequest->description;
                $RejetedEmployeeName = "Auto Rejected";
                $rejectionReason =  "This request is auto rejected ,sorry for inconvinience";
                // Send rejection email
                Mail::to($employeeEmail)->send(new RejectRequestMail(
                    $employeeName,
                    $rejectionReason,
                    $requestId,
                    $shortDescription,
                    $RejetedEmployeeName,

                ));
                FlashMessageHelper::flashSuccess("Email sent successfully!");

            } else {
                // Handle case where no matching request was found
                Log::info('No IT request found for rejection after 7 days.');
            }



        }

        // Handle category grouping
        if ($requestCategories->isNotEmpty()) {
            $this->requestCategories = $requestCategories->groupBy('Request')->map(function ($group) {
                return $group->unique('category'); // Ensure categories are unique
            });
        } else {
            $this->requestCategories = collect(); // Initialize as an empty collection
        }

        return view('livewire.request-process', [
            'newRequestCount' => $this->newRequestCount,
            'newRejectionCount' => $this->newRejectionCount,
            'activeCount' => $this->activeCount,
            'pendingCount' => $this->pendingCount,
            'closedCount' => $this->closedCount,
            'ClosedRequests' => $this->ClosedRequests,
            'inProgressRequests' => $this->inProgressRequests,
            'viewingDetails' => $this->viewingDetails,
            'recentrequestDetails' => $this->recentrequestDetails,
            'rejectedrequestDetails' => $this->rejectedrequestDetails,
            'requests' => $this->requests,
            'activeTab' => $this->activeTab,
        ]);
    } catch (\Exception $e) {
        // Log the exception for debugging
        Log::error("Error occurred in rendering requests: ", ['exception' => $e]);

        // Optionally, set default values or handle failure
        FlashMessageHelper::flashError("An error occurred while loading the request data.");

        // Return an empty view or partial data if needed
        return view('livewire.request-process', [
            'newRequestCount' => 0,
            'newRejectionCount' => 0,
            'activeCount' => 0,
            'pendingCount' => 0,
            'closedCount' => 0,
            'requests' => collect(),
            'activeTab' => $this->activeTab,
        ]);
    }
}

}
