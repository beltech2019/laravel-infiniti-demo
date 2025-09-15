@foreach ($response->ticketList as $ticket)
<div class="ticket-card">
    <div class="ticket-left">
        <h3>{{$ticket->gameName ?? ''}}</h3>
        <p class="ticket-id">{{$ticket->transactionId ?? ''}}</p>
        <p class="ticket-time">{{formatDateTime($ticket->transactionDate ?? '')}}</p>
        <div class="ticket-price">{{getCurrencyDetailcode()}} {{$ticket->amount ?? ''}}</div>
    </div>
    <div class="ticket-divider"></div>
    <div class="ticket-right">
<img src="https://d1n3o8efs042su.cloudfront.net/IGEContentWLS/content/gamePlayContent/launcher/eng/{{ str_replace(' ', '', $ticket->gameName) }}.png" alt="Game Logo">
        <p>{{$ticket->gameName ?? ''}}</p>
    </div>
</div>
@endforeach