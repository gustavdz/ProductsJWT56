<?php

namespace Products_JWT\Http\Controllers;

use Products_JWT\Http\Controllers\Controller;
use Products_JWT\Mail\eBillEmail;
use Illuminate\Support\Facades\Mail;
use stdClass;


class MailController extends Controller
{
    public function send_factura($receiver='',$factura='00X-00X-00000000X',$attachments=array(),$email_titular)
    {
        $objInfo = new stdClass();
        $objInfo->sender = 'Ecuabill';
        $objInfo->receiver = $receiver;
        $objInfo->factura = $factura;
        $objInfo->attached = $attachments;
        Mail::to($email_titular)->send(new eBillEmail($objInfo));
    }
}