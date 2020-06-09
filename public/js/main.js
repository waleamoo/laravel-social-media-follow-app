/*
$('.post').find('.edit').on('click', function(event){
    event.preventDefault();
    var postBody = event.target.parentNode.parentNode.childNodes[1].textContent; // get the content of <p>
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

*/
var postId = 0;
var postBodyElement = null;

//$('.posts').on('click', '.post .interaction .edit', function(event) {
$('.post').find('.edit').on('click', function(event){
	event.preventDefault();
    //postBodyElement = $(this).closest('.post').find('p:eq(0)').text();
    //postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    //var postBody = $(this).closest('.post').find('p:eq(0)').text();
	postBodyElement = $(this).closest('.post').find('p:eq(0)');
    var postBody = postBodyElement.text();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function() {
    $.ajax({
        method: 'POST',
        url: url,
        data: { body: $('#post-body').val(), postId: postId, _token: token }
    })
    .done(function(msg){
        //console.log(msg['message']);
        $(postBodyElement).text(msg['new_body']);
        $('#edit-modal').modal('hide');
    });
});