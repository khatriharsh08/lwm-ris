<?php

namespace App\Controllers;

// (1) Import your models
use App\Models\EventModel;
use App\Models\CentersModel;
use App\Models\ContactMessageModel;
use App\Models\WasteModel;

require_once(APPPATH . 'ThirdParty/tcpdf/tcpdf.php');

// (2) Helper functions for masking
function mask_email($email) {
    // Check for empty or invalid email string
    if (empty($email) || !str_contains($email, '@')) {
        return ""; // Return empty or "N/A"
    }
    
    list($user, $domain) = explode('@', $email);
    
    // Handle cases like "@domain.com"
    if (empty($user)) {
        return "*@" . $domain;
    }

    $user_len = floor(strlen($user) / 2);
    return substr($user, 0, $user_len) . str_repeat('*', strlen($user) - $user_len) . '@' . $domain;
}

function mask_phone($phone) {
    // Check for empty string or NULL
    if (empty($phone)) {
        return ""; // Return empty or "N/A"
    }

    $length = strlen($phone);

    // If phone is too short, just mask the whole thing
    if ($length <= 4) {
        return str_repeat('*', $length);
    }
    
    // This part will now only run if length is > 4
}

// (3) Custom TCPDF class for Header/Footer
// Note: We use \TCPDF because we are in a namespace
class LWMReport extends \TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 16);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'LWM-RIS - General System Report', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(128);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() . ' | Generated: ' . date('d-m-Y H:i:s'), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


// (4) The Main Controller
class ReportController extends BaseController
{
    public function index()
    {
        $data['page_title'] = 'Generate Reports';
        
        $eventModel = new EventModel();
        $centerModel = new CentersModel();
        $contactModel = new ContactMessageModel();
        $categoryModel = new WasteModel();
        
        // Get counts for summary
        $data['waste_count'] = $categoryModel->countAllResults();
        $data['center_count'] = $centerModel->where('is_deleted', '0')->countAllResults();
        $data['event_count'] = $eventModel->where('is_deleted', '0')->countAllResults();
        $data['message_count'] = $contactModel->countAllResults();
        
        // Get recent data for preview tables
        $data['recent_events'] = $eventModel->where('is_deleted', '0')->orderBy('date', 'DESC')->findAll(5);
        $data['recent_centers'] = $centerModel->where('is_deleted', '0')->orderBy('id', 'DESC')->findAll(5);
        
        return view('admin/report/view', $data);
    }

    public function generateFullReport()
    {
        // (A) Include the TCPDF Library
        

        // (B) Instantiate Models
        $eventModel = new EventModel();
        $centerModel = new CentersModel();
        $contactModel = new ContactMessageModel();
        $categoryModel = new WasteModel();

        // (C) Fetch All Data
        $waste_count = $categoryModel->countAllResults();
        $center_count = $centerModel->countAllResults();
        $event_count = $eventModel->countAllResults();
        $message_count = $contactModel->countAllResults();
        
        $all_events = $eventModel->orderBy('date', 'DESC')->findAll();
        $all_centers = $centerModel->findAll();
        $all_messages = $contactModel->orderBy('submitted_at', 'DESC')->findAll();

        // (D) Create PDF Document
        $pdf = new LWMReport(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator('LWM-RIS');
        $pdf->SetAuthor('LWM-RIS Admin');
        $pdf->SetTitle('LWM-RIS General System Report');
        
        $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // --- PAGE 1: DASHBOARD SUMMARY ---
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'System Dashboard Summary', 0, 1, 'L');
        $pdf->Ln(5);

        $summaryHtml = '
        <table border="1" cellpadding="10" cellspacing="0">
            <tr style="background-color:#F0F0F0;">
                <th>Module</th>
                <th>Total Count</th>
            </tr>
            <tr>
                <td>Waste Categories</td>
                <td>' . $waste_count . '</td>
            </tr>
            <tr>
                <td>Recycling Centers</td>
                <td>' . $center_count . '</td>
            </tr>
            <tr>
                <td>Events/Seminars</td>
                <td>' . $event_count . '</td>
            </tr>
            <tr>
                <td>"Get in Touch" Requests</td>
                <td>' . $message_count . '</td>
            </tr>
        </table>';
        $pdf->SetFont('helvetica', '', 11);
        $pdf->writeHTML($summaryHtml, true, false, true, false, '');


        // --- PAGE 2: EVENTS/SEMINARS LIST ---
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'All Events & Seminars', 0, 1, 'L');
        $pdf->Ln(5);

        $eventsHtml = '
        <table border="1" cellpadding="5" cellspacing="0">
            <tr style="background-color:#F0F0F0;">
                <th width="35%">Event Title</th>
                <th width="35%">Venue</th>
                <th width="30%">Date and Time</th>
            </tr>';
        
        foreach ($all_events as $event) {
            $eventsHtml .= '<tr>
                <td width="35%">' . esc($event['title']) . '</td>
                <td width="35%">' . esc($event['venue']) . '</td>
                <td width="30%">' . esc($event['date']) . '</td>
            </tr>';
        }
        $eventsHtml .= '</table>';
        $pdf->SetFont('helvetica', '', 10);
        $pdf->writeHTML($eventsHtml, true, false, true, false, '');


        // --- PAGE 3: RECYCLING CENTERS LIST ---
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'All Recycling Centers', 0, 1, 'L');
        $pdf->Ln(5);

        $centersHtml = '
        <table border="1" cellpadding="5" cellspacing="0">
            <tr style="background-color:#F0F0F0;">
                <th width="30%">Center Name</th>
                <th width="50%">Address</th>
                <th width="20%">Contact</th>
            </tr>';
        foreach ($all_centers as $center) {
             $centersHtml .= '<tr>
                <td width="30%">' . esc($center['name']) . '</td>
                <td width="50%">' . esc($center['address']) . '</td>
                <td width="20%">' . esc($center['phone_number']) . '</td>
            </tr>';
        }
        $centersHtml .= '</table>';
        $pdf->SetFont('helvetica', '', 10);
        $pdf->writeHTML($centersHtml, true, false, true, false, '');


        // --- PAGE 4: "GET IN TOUCH" REQUESTS ---
        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'All "Get in Touch" Requests', 0, 1, 'L');
        $pdf->Ln(5);

        $contactHtml = '
        <table border="1" cellpadding="5" cellspacing="0">
            <tr style="background-color:#F0F0F0;">
                <th width="15%">Date</th>
                <th width="20%">Name</th>
                <th width="30%">Email (Masked)</th>
                <th width="15%">Phone (Masked)</th>
                <th width="20%">Subject</th>
            </tr>';
        foreach ($all_messages as $msg) {
            $contactHtml .= '<tr>
                <td width="15%">' . esc($msg['submitted_at']) . '</td>
                <td width="20%">' . esc($msg['name']) . '</td>
                <td width="30%">' . esc(mask_email($msg['email'])) . '</td>
                <td width="15%">' . esc(mask_phone($msg['mobile'])) . '</td>
                <td width="20%">' . esc($msg['subject']) . '</td>
            </tr>';
        }
        $contactHtml .= '</table>';
        $pdf->SetFont('helvetica', '', 10);
        $pdf->writeHTML($contactHtml, true, false, true, false, '');

        
        // (E) OUTPUT THE PDF
        
        // Clean any output buffers
        $this->response->removeHeader('Content-Type'); 

        // 'D' forces a download
        $pdf->Output('LWM-RIS_General_Report_'.date('Y-m-d').'.pdf', 'D');
        die(); // Stop CI4 from sending any other output
    }

    public function generateEventsReport()
    {
        $eventModel = new EventModel();
        $all_events = $eventModel->where('is_deleted', '0')->orderBy('date', 'DESC')->findAll();
        $total_events = count($all_events);
        $upcoming = $eventModel->getTotalUpcomingEvents();
        $completed = $eventModel->getTotalCompletedEvents();

        $pdf = new LWMReport(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('LWM-RIS');
        $pdf->SetAuthor('LWM-RIS Admin');
        $pdf->SetTitle('LWM-RIS Events Report');
        $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Events & Seminars Report', 0, 1, 'L');
        $pdf->Ln(5);

        $summaryHtml = '<table border="1" cellpadding="8"><tr style="background-color:#1cc88a;color:white;"><th>Total Events</th><th>Upcoming</th><th>Completed</th></tr><tr><td align="center">'.$total_events.'</td><td align="center">'.$upcoming.'</td><td align="center">'.$completed.'</td></tr></table>';
        $pdf->writeHTML($summaryHtml, true, false, true, false, '');
        $pdf->Ln(10);

        $eventsHtml = '<table border="1" cellpadding="5"><tr style="background-color:#F0F0F0;"><th width="40%">Event Title</th><th width="30%">Venue</th><th width="30%">Date</th></tr>';
        foreach ($all_events as $event) {
            $eventsHtml .= '<tr><td width="40%">' . esc($event['title']) . '</td><td width="30%">' . esc($event['venue']) . '</td><td width="30%">' . date('M d, Y h:i A', strtotime($event['date'])) . '</td></tr>';
        }
        $eventsHtml .= '</table>';
        $pdf->SetFont('helvetica', '', 10);
        $pdf->writeHTML($eventsHtml, true, false, true, false, '');

        $this->response->removeHeader('Content-Type');
        $pdf->Output('LWM-RIS_Events_Report_'.date('Y-m-d').'.pdf', 'D');
        die();
    }

    public function generateCentersReport()
    {
        $centerModel = new CentersModel();
        $all_centers = $centerModel->where('is_deleted', '0')->findAll();
        $total_centers = count($all_centers);

        $pdf = new LWMReport(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('LWM-RIS');
        $pdf->SetAuthor('LWM-RIS Admin');
        $pdf->SetTitle('LWM-RIS Recycling Centers Report');
        $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Recycling Centers Report', 0, 1, 'L');
        $pdf->Ln(5);

        $summaryHtml = '<table border="1" cellpadding="8"><tr style="background-color:#36b9cc;color:white;"><th>Total Recycling Centers</th></tr><tr><td align="center" style="font-size:18px;font-weight:bold;">'.$total_centers.'</td></tr></table>';
        $pdf->writeHTML($summaryHtml, true, false, true, false, '');
        $pdf->Ln(10);

        $centersHtml = '<table border="1" cellpadding="5"><tr style="background-color:#F0F0F0;"><th width="25%">Center Name</th><th width="30%">Address</th><th width="15%">City</th><th width="15%">State</th><th width="15%">Phone</th></tr>';
        foreach ($all_centers as $center) {
            $centersHtml .= '<tr><td width="25%">' . esc($center['name']) . '</td><td width="30%">' . esc($center['address']) . '</td><td width="15%">' . esc($center['city']) . '</td><td width="15%">' . esc($center['state']) . '</td><td width="15%">' . esc($center['phone_number']) . '</td></tr>';
        }
        $centersHtml .= '</table>';
        $pdf->SetFont('helvetica', '', 9);
        $pdf->writeHTML($centersHtml, true, false, true, false, '');

        $this->response->removeHeader('Content-Type');
        $pdf->Output('LWM-RIS_Centers_Report_'.date('Y-m-d').'.pdf', 'D');
        die();
    }
}