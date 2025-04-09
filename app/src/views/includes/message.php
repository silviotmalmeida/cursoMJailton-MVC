<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,700');

    .message {
        display: block;
        background: #de6d6d;
        border-radius: 5px;
        padding: 10px;
        border: solid 1px #d74e4e;
        color: #7f2e2e;
        font-weight: 600;
        margin: 5px auto;
        font-family: 'Roboto', sans-serif;
    }

    .message.success {
        background: rgba(0, 128, 0, 0.35);
        border-color: #669866;
        color: #4d754d;
    }

    .message .fa-times {
        float: right;
        text-decoration: none
    }

    .message.success .fa-times {
        color: #4d754d;
    }

    .message.error {
        background: #e69f9f;
        border-color: #967272;
        color: #9a4848;
    }

    .message.error .fa-times {
        color: #9a4848;
    }

    .message.info {
        background: #aed8e6;
        border-color: #5899af;
        color: #5594a9;
    }

    .message.info .fa-times {
        color: #5594a9;
    }
</style>

<div>
    <span class="message <?php echo $message->class ?>"><i class="fas <?php echo $message->icon ?>"></i> <?php echo $message->message ?><a href="javascript:;" onclick="fecharMsg()" class="fas fa-times float-right"></a></span>
</div>