$(document).ready(function() {
$(".scroll").click(function(event) {
$('html,body').animate({ scrollTop: $(this.hash).offset().top }, 500);
});
});