jQuery(document).ready(function($) {
    $('#send-button').on('click', function() {
        var message = $('#chat-input').val();
        $.ajax({
            url: llmChatAjax.ajaxurl,
            type: 'POST',
            data: {
                'action': 'llm_chat_request',
                'message': message
            },
            success: function(response) {
                if (response.success) {
                    $('.messages').append('<div class="message">' + response.data.message + '</div>');
                    $('#chat-input').val(''); // clear input
                }
            }
        });
    });
});
