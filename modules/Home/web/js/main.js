var contactSearchField = $('#contact_search');
var oldContactSearchVal = '';
var contactTemplate = '<li>\n' +
    '                            <div class="d-flex bd-highlight">\n' +
    '                                <div class="img_cont">\n' +
    '                                    <img src="../img/no-avatar.png" class="rounded-circle user_img">\n' +
    '                                    <span class="online_icon"></span>\n' +
    '                                </div>\n' +
    '                                <div class="user_info">\n' +
    '                                    <span>{username}</span>\n' +
    '                                    <p>{status}</p>\n' +
    '                                </div>\n' +
    '                            </div>\n' +
    '                        </li>';

var contactsBlock = $('.contacts');

contactSearchField.keyup(function (ev) {
    let str = ev.target.value;
    if (str === oldContactSearchVal) return;

    oldContactSearchVal = str;

    searchContact(str);
});

function searchContact(str) {
    $.ajax({
        url: '/home/chat/find-chat',
        type: 'GET',
        data: {'UserSearch[username]': str},
        success: function (response) {
            if (response.success) {
                let data = response.data;
                contactsBlock.empty();
                for (let i = 0; i < data.length; i++) {
                    contactsBlock.append(contactTemplate.replace('{username}', data[i].username));
                }
            }
        }
    });
}

searchContact('');