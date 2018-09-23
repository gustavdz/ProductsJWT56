<?php

namespace Products_JWT\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class eBillEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from(env("MAIL_FROM_ADDRESS"),env("MAIL_FROM_NAME"))
            ->subject('Ha recibido un nuevo Comprobante Electrónico');
            //->view('mails.facturas.emitidas')
            //->text('mails.facturas.emitidas');
            //->with(['testVarOne' => '1', 'testVarTwo' => '2']);

        // $attachments is an array with file paths of attachments
        foreach($this->info->attached as $filePath){
            $email->attach($filePath);
        }

        $email->markdown('mails.facturas.emitidas');
        return $email;
    }
}
