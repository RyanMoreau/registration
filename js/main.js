// Show the first tab and hide the rest
$('#tabs-nav li:first-child').addClass('active');
$('.tab-content').hide();
$('.tab-content:first').show();

// Click function
$('#tabs-nav li').click(function(){
  $('#tabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.tab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});

// URL contains
if (window.location.href.indexOf("?signup=empty") > -1) {
    $('#tabs-nav li').removeClass('active');
    $('#tabs-nav li:first-child').addClass('active');
    $('#tabs-nav li:first-child').addClass('active');    $('.tab-content').hide();
    $('.tab-content:first-child').show();
    alert('There was an error when registering');
} else if (window.location.href.indexOf("?login=empty") > -1) {
    $('#tabs-nav li').removeClass('active');
    $('#tabs-nav li:last-child').addClass('active');
    $('#tabs-nav li:last-child').addClass('active');    $('.tab-content').hide();
    $('.tab-content:last-child').show();
    alert('There was an error when signing in');
} else if (window.location.href.indexOf("?signup=success") > -1) {
    $('#tabs-nav li').removeClass('active');
    $('#tabs-nav li:last-child').addClass('active');
    $('#tabs-nav li:last-child').addClass('active');    $('.tab-content').hide();
    $('.tab-content:last-child').show();
    alert('You have successfully signed up!');    
} else if (window.location.href.indexOf("?login=success") > -1) {
    $('#tabs-nav li').removeClass('active');
    $('#tabs-nav li:last-child').addClass('active');
    $('#tabs-nav li:last-child').addClass('active');    $('.tab-content').hide();
    $('.tab-content:last-child').show();
    alert('Congratulations! You have logged in.');    
}