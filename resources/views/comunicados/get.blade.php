<div class="inbox-body">
    <div class="mail_heading row">
        <div class="col-md-8">
            <h4 style="margin-top: -5px">{{$comunicados->first()->title}}</h4>
        </div>
        <div class="col-md-4 text-right">
            <p class="date"> {{$comunicados->first()->created_at}}</p>
        </div>
    </div>
    <div class="sender-info">
        <div class="row">
            <div class="col-md-12">
                <strong>{{env('MAIL_FROM_NAME')}}</strong>
                <span>{{env('MAIL_FROM_ADDRESS')}}</span> para
                <strong>mí</strong>
                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
            </div>
        </div>
    </div>
    <div class="view-mail">
        <br>
        <p>
            {{$comunicados->first()->detail}}
        </p>
        <br>
    </div>
</div>