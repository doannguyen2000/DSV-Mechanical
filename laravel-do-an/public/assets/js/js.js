const input = document.getElementById('file-input');
const image = document.getElementById('img-preview');

input.addEventListener('change', (e) => {
    if (e.target.files.length) {
        const src = URL.createObjectURL(e.target.files[0]);
        image.src = src;
    }
});

function showUser(url = null) {
    $.ajax({
        method: "GET",
        url: url,
        success: function(response) {
            $("#modal-show-user").html(response);
        }
    });
}