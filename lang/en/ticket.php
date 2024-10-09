<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ticket Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the various messages
    | that used with tickets. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Singular and plural lable. Used everywhere.
    |--------------------------------------------------------------------------
    */

    'tickets' => 'Tickets',
    'ticket'  => 'Ticket',

    /*
    |--------------------------------------------------------------------------
    | Support Request Form (create-ticket.blade.php - TicketResource.php)
    |--------------------------------------------------------------------------
    */

    'request_form'       => 'Support Request Form',
    'customer_info'      => 'Employee info :',
    'author_id'          => 'Employee ID',
    'your_id'            => 'Employee number',
    'name'               => 'Name',
    'your_name'          => 'Your name',
    'mobile'             => 'Mobile',
    'mobile_number'      => 'Mobile number',
    'extension'          => 'Extension',
    'extension_number'   => 'Extension number',
    'issue_info'         => 'Issue info :',
    'ip'                 => 'IP',
    'ip_address'         => 'IP address',
    'category'           => 'Category',
    'select_category'    => 'Select the issue category',
    'section'            => 'Section',
    'select_section'     => 'Select the section',
    'additional_info'    => 'Additional information about the issue',
    'issue_description'  => 'Type the issue description here',
    'submit'             => ' + Submit ',
    'open_ticket'        => 'Open ticket',

    /*
    |--------------------------------------------------------------------------
    | Ticket page (ticket.blade.php)
    |--------------------------------------------------------------------------
    */

    'ticket_number'        => 'Ticket number',
    'ticket_status'        => 'Status',
    'ticket_customer_info' => 'Employee info',
    'ticket_ip'            => 'IP',
    'ticket_category'      => 'Category',
    'ticket_section'       => 'Section',
    'ticket_issue'         => 'Issue info',
    'ticket_notes'         => 'Technician notes',
    'ticket_created_at'    => 'Created at',
    'ticket_updated_at'    => 'Updated at',
    'your_tickets_total'   => 'Your tickets total',

    /*
    |--------------------------------------------------------------------------
    | TicketController
    |--------------------------------------------------------------------------
    */

    'name_required'      => 'The Name field is required.',
    'ext_required'       => 'The Extension number field is required.',
    'ip_required'        => 'The IP address field is required.',
    'ip_ip'              => 'The IP field must be a valid IP address.',
    'category_required'  => 'The category field is required.',
    'store_success'      => 'The request has been sent successfully. Your ticket number: ',
    'store_erorr'        => 'Unable to send new request, please try again later',
    'ticketID_required'  => 'The ticket number field is required.',
    'ticketID_integer'   => 'The entered value must be an integer number.',
    'ticketID_erorr'     => 'There is no ticket with this number.',

    /*
    |--------------------------------------------------------------------------
    | TicketResource
    |--------------------------------------------------------------------------
    */

    'customer_data'         => 'Data of the employee who submitted the issue',
    'troubleshooter_notes'  => 'Troubleshooter notes',
    'technician'            => 'Technician',
    'status'                => 'Status',
    'processing'            => 'In processing',
    'closed'                => 'Closed',
    'open'                  => 'Open',
    'created_at'            => 'Created at',
    'updated_at'            => 'Updated at',
    'created_from'          => 'From',
    'created_until'         => 'To',
    'ticket_number_label'   => 'Ticket Number',

    // Widgets ----------------------------------------------------------------
    'latest_tickets'              => 'Latest Tickets',
    'tickets_today'               => 'Tickets Today',
    'tickets_added_today'         => 'Tickets added today',
    'open_tickets'                => 'Open Tickets',
    'still_open_tickets'          => 'Tickets that are still open',
    'in_progress_tickets'         => 'In Progress Tickets',
    'still_in_progress_tickets'   => 'Tickets still under processing',
    'total_tickets'               => 'Total Tickets',
    'ttal_of_all_tickets'         => 'All tickets in the system',

];
