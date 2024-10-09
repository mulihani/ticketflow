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

    'tickets' => 'التذاكر',
    'ticket'  => 'تذكرة',

    /*
    |--------------------------------------------------------------------------
    | Support Request Form (create-ticket.blade.php - TicketResource.php)
    |--------------------------------------------------------------------------
    */

    'request_form'       => 'نموذج طلب دعم',
    'customer_info'      => 'معلومات الموظف :',
    'author_id'          => 'رقم الموظف',
    'your_id'            => 'الرقم الوظيفي',
    'name'               => 'الاسم',
    'your_name'          => 'اكتب اسمك',
    'mobile'             => 'الجوال',
    'mobile_number'      => 'رقم الجوال',
    'extension'          => 'التحويلة',
    'extension_number'   => 'رقم التحوية',
    'issue_info'         => 'معلومات المشكلة :',
    'ip'                 => 'IP',
    'ip_address'         => 'IP عنوان',
    'category'           => 'التصنيف',
    'select_category'    => 'اختر تصنيف المشكلة',
    'section'            => 'القسم',
    'select_section'     => 'اختر القسم',
    'additional_info'    => 'معلومات اضافية عن المشكلة',
    'issue_description'  => 'اكتب وصف المشكلة هنا',
    'submit'             => ' + ارسال ',
    'open_ticket'        => 'استعراض التذكرة',

    /*
    |--------------------------------------------------------------------------
    | Ticket page (ticket.blade.php)
    |--------------------------------------------------------------------------
    */

    'ticket_number'        => 'رقم التذكرة',
    'ticket_status'        => 'الحالة : ',
    'ticket_customer_info' => 'معلومات الموظف',
    'ticket_ip'            => 'IP',
    'ticket_category'      => 'التصنيف',
    'ticket_section'       => 'القسم :',
    'ticket_issue'         => 'معلومات المشكلة',
    'ticket_notes'         => 'ملاحظات الفني',
    'ticket_created_at'    => 'تم الانشاء في',
    'ticket_updated_at'    => 'تم التعديل في',
    'your_tickets_total'   => 'مجموع تذاكرك هو',
    
    /*
    |--------------------------------------------------------------------------
    | TicketController
    |--------------------------------------------------------------------------
    */

    'name_required'      => 'حقل الاسم مطلوب',
    'ext_required'       => 'حقل رقم التحويلة مطلوب',
    'ip_required'        => 'حقل عنوان الـ IP مطلوب.',
    'ip_ip'              => 'حقل عنوان الـ IP يحب ان يحتوى على عنوان صحيح',
    'category_required'  => 'حقل التصنيف  مطلوب.',
    'store_success'      => 'تم ارسال الطلب بنجاح. رقم التذكرة : ',
    'store_erorr'        => 'غير قادر على ارسال الطلب, الرجاء المحاولة لاحقاً',
    'ticketID_required'  => 'رقم التذكرة مطلوب.',
    'ticketID_integer'   => 'القيمة المدخلة يحب أن تكون رقم صحيح.',
    'ticketID_erorr'     => 'لا يوجد تذكرة بهذا الرقم',

    /*
    |--------------------------------------------------------------------------
    | TicketResource
    |--------------------------------------------------------------------------
    */

    'customer_data'         => 'بيانات الموظف الذي بلغ عن المشكلة',
    'troubleshooter_notes'  => 'ملاحظات المعالج مستكشف الأخطاء ومعالجها',
    'technician'            => 'الفني',
    'status'                => 'حالة التذكرة',
    'processing'            => 'تحت المعالجة',
    'closed'                => 'مغلقة',
    'open'                  => 'مفتوحة',
    'created_at'            => 'تم الانشاء في',
    'updated_at'            => 'تم التحديث في',
    'created_from'          => 'من',
    'created_until'         => 'الى',
    'ticket_number_label'   => 'رقم التذكرة',

    // Widgets ----------------------------------------------------------------
    'latest_tickets'              => 'آخر التذاكر المضافة',
    'tickets_today'               => 'تذاكر اليوم',
    'tickets_added_today'         => 'التذاكر المضافة اليوم',
    'open_tickets'                => 'تذاكر مفتوحة',
    'still_open_tickets'          => 'التذاكر التي لا تزال مفتوحة',
    'in_progress_tickets'         => 'تذاكر تحت المعالجة',
    'still_in_progress_tickets'   => 'التذاكر التي لا تزال تحت المعالجة',
    'total_tickets'               => 'اجمال التذاكر',
    'ttal_of_all_tickets'         => 'جميع التذاكر المدرجة في النظام',

];
