<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use App\Models\Ticket;
use App\Models\User;

class TicketController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display a listing of the resource.
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(15);
        return view('auth.user-tickets', compact('tickets'));
    }

    /*
    |--------------------------------------------------------------------------
    | Display creating a new ticket form.
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        // Get active categories and sections
        $categories = Category::getCategories();
        $sections = Section::getSections();

        return view('create-ticket', compact('categories', 'sections'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store a newly created resource in storage.
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Ticket $ticket)
    {
        // Validate erorr messages
        $messages = [
            'name.required'     => __('ticket.name_required'),
            'ext.required'      => __('ticket.ext_required'),
            'ip.required'       => __('ticket.ip_required'),
            'ip.ip'             => __('ticket.ip_ip'),
            'category.required' => __('ticket.category_required'),
            'section.required'  => __('ticket.section_required'),
        ];

        // Validate incoming data
        $validated = $request->validate([
            'name'     => 'required',
            'ext'      => 'required',
            'ip'       => 'required|ip',
            'category' => 'required',
            'section'  => 'required'
        ], $messages);

        if ($validated) {

            $ticket->user_id       = $request->user_id;
            $ticket->author_id     = $request->author_id;
            $ticket->author_name   = $request->name;
            $ticket->author_mobile = $request->mobile;
            $ticket->author_ext    = $request->ext;
            $ticket->author_ip     = $request->ip;
            $ticket->category_id   = $request->category;
            $ticket->section_id    = $request->section;
            $ticket->content       = $request->content;

            if ($ticket->save()) {
                session()->flash('success', __('ticket.store_success').$ticket->id.'.');
                session()->flash('ticket_id', $ticket->id);
                return redirect()->back();
            } else {
                session()->flash('erorr', __('ticket.store_erorr'));
                return redirect()->back();
            }

        } else {
            session()->flash('erorr', __('ticket.store_erorr'));
            return redirect()->back();
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Display the ticket details page.
    |--------------------------------------------------------------------------
    */

    public function show(Request $request)
    {

        if(isset($request->ticketID) && !empty($request->ticketID)) {

            // Validate erorr messages
            $messages = [
                'ticketID.required' => __('ticket.ticketID_required'),
                'ticketID.integer' => __('ticket.ticketID_integer'),
            ];

            // Validate incoming data
            $validated = $request->validate([
                'ticketID' => 'required|integer',
            ], $messages);

            // Get ticket data
            $ticket = Ticket::find($request->ticketID);

            if ($ticket) {
                return view('ticket', compact('ticket'));
            } else {
                session()->flash('erorr', __('ticket.ticketID_erorr'));
                return redirect()->back();
            }

        } else {
            session()->flash('erorr', __('ticket.ticketID_erorr'));
            return redirect('/');
        }

    }

}
