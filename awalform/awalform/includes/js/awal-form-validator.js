let $spotifyListContainer = $('#spotify-artist-section');
let $spotifyList = $('#spotify-artist-list');
let profileRow = null;
let requireProfileRow = true;
const MusicProfileLimit = 9;
function ValidateEmail() 
{
  $('#awalForm #email').removeClass('invalid');
  let email = $('#awalForm #email').val();
  let emailValidationMsg = $('#email-validation-message');
  let msg = '';
  if (!email.trim()) {
    msg = enterEmailMessage;
  } else {
    //regexpress doesn't work for long str, so we should split the email address and run separately.
    // /^[a-z0-9]+([\.+-_]?[a-z0-9]+)*@[a-z0-9]+([\.-]?[a-z0-9]+)*(\.[a-z0-9]{2,3})+$/

    if (email.indexOf("@") < 0 || email.indexOf(".") < 0) {
      msg = enterValidEmailMessage;
    } else {
      let strArr = email.split("@");
      if (strArr.length != 2) {
        msg = enterValidEmailMessage;
      } else if (!(/^[a-z0-9]+([\.+-_]?[a-z0-9]+)*$/.test(strArr[0].toLowerCase()))) {
        msg = enterValidEmailMessage;
      } else {
        if (strArr[1].indexOf(".") < 0) {
          msg = enterValidEmailMessage;
        } else {
          let lPos = strArr[1].lastIndexOf(".");
          let dStr1 = strArr[1].substr(0, lPos);
          let dStr2 = strArr[1].substr(lPos + 1);
          if (!(/^[a-z0-9]+([\.-_]?[a-z0-9]+)*$/.test(dStr1.toLowerCase()))) {
            msg = enterValidEmailMessage;
          } else if (!(/^[a-z0-9]{2,3}$/.test(dStr2.toLowerCase()))) {
            msg = enterValidEmailMessage;
          } else if (!checkEmailDomain(email)) {
            msg = enterDeposableEmailMessage;
          }
        }
      }
    }
  }
  
  $('#email-validation-message').html(msg);
  if (msg != '') {
    $('#awalForm #email').addClass('invalid');
    return false;
  }
  return true;
}

function addArtist(element) {
  var data = {
    "name": element.name,
    "img": element.images.length > 0 ? element.images[0].url: '',
    "followers": element.followers.total,
    "link": element.external_urls.spotify,
    "id": element.id 
  };
  $spotifyList.append(tmpl("spotify-li", data));
}
function callArtist() {
  const value = $('#spotifyInput').val().trim();
  // $('#spotifyInput').val(value);
  if (!value) {
    $('#spotifyInput').parent().removeClass('has-data');
    $spotifyListContainer.hide();
    return false;
  }
  $('.spotify-input-group').addClass("loading").addClass('has-data');
  $spotifyListContainer.find('#spotify-artist-item-no').prop('checked', false);

  const form_data = new FormData();
  form_data.set('spotify_search_url', 'https://api.spotify.com/v1/search?q=' + value + '&type=artist');
  form_data.set('_wpnonce', $('#_wpnonce').val());
  form_data.set('action', 'spotify_search_artists');

  $.ajax({
    url: wp.ajax_url,
    method: 'POST',
    xhrFields: { withCredentials: false },
    data: form_data,
    contentType: false,
    processData: false,
    dataType: 'json',
    beforeSend: function () {
      
    },
    complete: function () {
    },
    success: function (response, textStatus, jqXHR) {
      $('.spotify-input-group').removeClass("loading");
      let json = response.data;
      
      if (!json.artists) {
        // alert('No record on spotify');
      } else {
        json.artists.items.forEach(element => {
          addArtist(element);
        });
        if (json.artists.next) {
          $spotifyListContainer.find("#show-more-link").data("href", json.artists.next);
          $spotifyListContainer.find(".show-more").show();
        } else {
          $spotifyListContainer.find(".show-more").hide();
        }
        $spotifyListContainer.show();
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('An error has occurred!');
    }
  });
}

function loadMoreArtist() {
  $('.spotify-input-group').addClass("loading");

  const form_data = new FormData();
  form_data.set('spotify_search_url', $("#show-more-link").data("href"));
  form_data.set('_wpnonce', $('#_wpnonce').val());
  form_data.set('action', 'spotify_search_artists');

  $.ajax({
    url: wp.ajax_url,
    method: 'POST',
    xhrFields: { withCredentials: false },
    data: form_data,
    contentType: false,
    processData: false,
    dataType: 'json',
    beforeSend: function () {
      
    },
    complete: function () {
    },
    success: function (response, textStatus, jqXHR) {
      $('.spotify-input-group').removeClass("loading");
      let json = response.data;
      
      if (!json.artists) {
        // alert('No record on spotify');
      } else {
        json.artists.items.forEach(element => {
            addArtist(element);
        });
        if (json.artists.next) {
          $spotifyListContainer.find("#show-more-link").data("href", json.artists.next);
          $spotifyListContainer.find(".show-more").show();
        } else {
          $spotifyListContainer.find(".show-more").hide();
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('An error has occurred!');
    }
  });
}

function initSpotifySelector() {
  $spotifyList.find("li:gt(0)").remove();
  $spotifyListContainer.find(".show-more").hide();
  $spotifyListContainer.find("#select-spotify-btn").prop("disabled", true);
  $("#spFollowers").val('');
  $("#spLink").val('');
}

function updateMusicProfileValidationMessage() {
  // const row = $("#music-profile-list .row:eq(0)");
  // const input = row.find(".social-link");
  // const defUrl = $(row).find(".social-type option:selected").data("url");
  // // row.find(".invalid-feedback").html(requireProfileRow && input.val().replace(defUrl, "") == "" ? enterOneProfileMessage : enterValidUrlMessage);
  // row.find(".invalid-feedback").html(enterValidUrlMessage);
  // input.prop('required', requireProfileRow);
}

function initMusicProfileRow(row) {
  const option = $(row).find(".social-type option:eq(0)");
  option.prop("selected", true)
  const urlInput = $(row).find(".social-link");
  if (!option.data("url")) {
    $(row).find(".input-group-text").hide();
    urlInput.attr('pattern', 'http(s?)://([a-zA-Z0-9\.\/\+-_%]+)');
  } else {
    $(row).find(".input-group-text").html(option.data("url"));
    urlInput.removeAttr('pattern');
  }
  urlInput.prop("required", true);
  urlInput.attr('placeholder', option.data("placeholder")).val("");
  urlInput.data("value", ""); 
}
function initMusicProfile() {
  $('#music-profile-list .row:gt(0)').remove();
  $('#music-profile-list .row:eq(0) select').val("");
  initMusicProfileRow($('#music-profile-list .row:eq(0)'));
}

function goToMusic() {
    let isValid = true;
    $('#information-form [required]').addClass('edited');
    $('#information-form [required]').each(function(){
        if (!this.checkValidity()) {
            isValid = false;
        }
    });
    isValid = ValidateEmail() ? isValid : false;

    if (isValid) {
      $('#information-form').hide();
      $('#music-form').show();
      $('html, body').scrollTop(0);
    }
}
function gotoInfo() {
    $('#information-form').show();
    $('#music-form').hide();
}
function gotoThankyou() {
    $('#information-form').remove();
    $('#music-form').remove();
    $('#thankyou-form').show();
}
function submitForm() {
  $("#error-message-wrapper").hide();
  let isValid = true;
  $('#music-form [required]').addClass('edited');
  
  updateMusicProfileValidationMessage();

  isValid = !$('#spotifyInput').get(0).checkValidity() ? false : isValid;
  // isValid = !$('#terms-check').get(0).checkValidity() ? false : isValid;
  if (captchaWidget !== null) {
      if (!grecaptcha.getResponse()) {
          $('.google-captcha-row .invalid-feedback').show();
          isValid = false;
      } else {
          $('.google-captcha-row .invalid-feedback').hide();
      }
  } else {
      $('.google-captcha-row .invalid-feedback').show();
  }

  if (requireProfileRow && $('#music-profile-list .row').length == 0) {
    isValid = false;
    $('#add-profile-link').prev().show();
  } else {
    $('#add-profile-link').prev().hide();
  }
  //music profile validate
  $('#music-profile-list .row').each(function(idx){    
    const input = $(this).find(".social-link");
    const defUrl = $(this).find(".social-type option:selected").data("url");
    isValid = $(this).find(".social-link").get(0).checkValidity() ? isValid : false;
  });

  if (isValid) {
    $('#terms-content .popup-footer__desc').show();
    $('#terms-content .popup-footer .btn').hide();

    $.magnificPopup.open({
      items: {
        src: '#terms-content',
        type: 'inline'
      },
      closeOnBgClick: false,
      enableEscapeKey: false
    });
  }
}

$('#terms-content .btn-decline').click(function(e){
  e.preventDefault();
  $('.mfp-close').click();
});

$('#terms-content .btn-agree').click(function(e){
  e.preventDefault();
  $('.mfp-close').click();
  submit_your_form();
});

$('#terms-content .popup-content-wrapper').scroll(function(e){
  if ($('.popup-content-wrapper').height() + $('.popup-content-wrapper').prop('scrollTop') >= $('.popup-content-wrapper').prop('scrollHeight')) {
    $('#terms-content .popup-footer__desc').hide();
    $('#terms-content .popup-footer .btn').show();
  }
});

function submit_your_form() {
  $('#music-profile-list .row').each(function(idx){    
    const input = $(this).find(".social-link");
    const defUrl = $(this).find(".social-type option:selected").data("url");
    if (input.val() == defUrl) {
      input.val("");
    }
  });  

  $('#submit-form-btn').addClass("processing").prop("disabled", true);

  var $form = $('#awalForm');

  $.ajax({
    url: $form.attr('action'),
    type: "post",
    dataType: "json",
    data: $form.serialize(),
    success: function(rsp) {
      console.log(rsp);
      if (rsp['status'] == "error") {
        $("#error-message-wrapper").html(submitErrorMessage).show();
      } else {
        gotoThankyou();
      }
    },
    error: function(err) {
      $("#error-message-wrapper").html(submitErrorMessage).show();
    },
    complete: function() {
      $('#submit-form-btn').removeClass("processing").prop("disabled", false);
    }
  });
}

function onSearchSpotify(e) {
  if (e.keyCode >= 37 && e.keyCode <= 40) {
    return;
  }
  initSpotifySelector();
  callArtist();
  // $spotifyListContainer.hide();
  if (e.keyCode == 13) {
    e.preventDefault();
    e.stopPropagation();
  }
}
function updateProfileDropdowns(item, isAdd = true) {
  if (!isAdd) {
    $("#music-profile-list select").each(function(){
      if ($(this).val() != item) {
        $(this).find("option[value='" + item + "']").remove();
        $(this).select2();
      }
    });
  } else {
    const newRow = profileRow.find("option[value='" + item + "']").clone();
    $("#music-profile-list select").each(function(){
      if ($(this).find('option[value="' + item + '"]').length == 0){
        let isAdded = false;
        $(this).find("option").each(function(){
          if (isAdded == false && $(newRow).data("index") < $(this).data("index")) {
            $(this).before(newRow.clone());
            isAdded = true;
          }
        })
        if (!isAdd) {
          $(this).append(newRow.clone());
        }
        $(this).select2();
      }
    });
  }
}
$(function(){
  $('body').on('change', '#awalForm input[type="text"], #awalForm input[type="email"], #awalForm input[type="url"], #spotifyInput', function(){
    $(this).val(this.value.trim());
  });
  $("body").on("keyup", '#awalForm input[type="email"]', function(){
    ValidateEmail();
  });
  $("body").on("keydown", '#awalForm input[type="email"]', function(e){
    if (e.keyCode == 9) {
      ValidateEmail();
    }
  });

  $('body').on('click', '#spotify-artist-section li', function(){
    $(this).find('input[type="radio"]').prop("checked", true);
    $spotifyListContainer.find('#select-spotify-btn').prop('disabled', false);
  })
  profileRow = $('#music-profile-row-template').clone();
  $('.awal-form-container select').select2();
  $("body").on("change", "#country", function(){
    $("#currency").val($("#country option:selected").data("currency")).trigger("change");
  });
  initSpotifySelector();
  $("body").on("click", ".spotify-artist-header > a", function(){
    $spotifyListContainer.hide();
  });
  $("body").on("keyup", "#spotifyInput", $.debounce(onSearchSpotify, 200));
  $("#spotify-artist-list").on("click", "input[type='radio']", function(){
    $spotifyListContainer.find('#select-spotify-btn').prop('disabled', false);
  });
  $("body").on("click", "#show-more-link", function(e){
    loadMoreArtist();
    e.stopPropagation();
    e.preventDefault();
  });
  $("body").on("click", "#clear-artist-name", function(e){
    $('#spotifyInput').val('');
    initSpotifySelector();
    callArtist();
  });
  $("body").on("click", "#select-spotify-btn", function(e){
    const selected = $spotifyList.find("input[type='radio']:checked").closest("li");
    if (!selected.hasClass("no-item-li")) {
      $("#spotifyInput").val(selected.data("name"));
      requireProfileRow = false;
      $("#add-profile-link").prev().hide();

    } else {
      requireProfileRow = true;
    }
    $('#music-profile-list .edited').removeClass("edited");
    updateMusicProfileValidationMessage();
    $("#spFollowers").val(selected.data("followers"));
    $("#spLink").val(selected.data("url"));
    $spotifyListContainer.hide();
  });
  //Music Profile
  $("body").on("click", "#add-profile-link", function(){
    $("#add-profile-link").prev().hide();
    const tProfileRow = profileRow.clone();
    $("#music-profile-list select").each(function(){
      tProfileRow.find("option[value='" + $(this).val() + "']").remove();
    });
    tProfileRow.find(".remove-profile-btn").show();
    initMusicProfileRow(tProfileRow);
    $("#music-profile-list").append(tProfileRow);
    tProfileRow.show();
    $("#music-profile-list .row:last .social-type").select2();
    if ($("#music-profile-list .social-type").length >= MusicProfileLimit) {
      $(this).hide();
    }
    updateProfileDropdowns(tProfileRow.find('select').val(), false);
  });

  let prevValue = null;
  $("body").on("select2:open", "#music-profile-list select", function(){
    prevValue = $(this).val();
  });
  $("body").on("change", "#music-profile-list select", function(){
    const option = $(this).find("option:selected");
    const row = $(this).closest(".row");
    option.prop("selected", true)
    const urlInput = $(this).closest(".row").find(".social-link");
    urlInput.prop("required", true);
    urlInput.attr('placeholder', option.data("placeholder")).val("");
    urlInput.data("value", "");
    if (!option.data("url")) {
      $(row).find(".input-group-text").hide();
      urlInput.attr('pattern', 'http(s?)://([a-zA-Z0-9\.\/\+-_%]+)');
    } else {
      $(row).find(".input-group-text").html(option.data("url")).show();
      urlInput.removeAttr('pattern');
    }
    updateProfileDropdowns($(this).val(), false);
    updateProfileDropdowns(prevValue, true);
  });

  $("body").on("click", ".remove-profile-btn", function(){
    const item = $(this).closest('.row').find('select').val();

    $(this).closest('.row').remove();
    if ($("#music-profile-list .social-type").length < MusicProfileLimit) {
      $("#add-profile-link").show();
    }
    if ($("#music-profile-list .row").length == 0 && requireProfileRow) {
      $("#add-profile-link").prev().show()
    }
    updateProfileDropdowns(item, true);
  });
  $("body").on("focus", ".social-link", function(){
    $(this).removeClass('empty');
  });
  $("body").on("blur", "[required]", function(){
    if ($(this).hasClass("social-link")) {
      const input = $(this);
      const row = input.closest(".row");
      const idx = $("#music-profile-list .row").index(row);
      if (idx == 0) {
        updateMusicProfileValidationMessage();
        if (requireProfileRow) {
          $(this).addClass("edited");
        } else {
          $(this).removeClass("edited");
        }
      } else {
        $(this).addClass("edited");
      }
    } else {
      $(this).addClass("edited");
    }
  });
  //Form Navigator
  $('.role-radio-wrapper input[type="radio"]').click(function(){
      $("#information-form .info-row").show();
      $("#information-form .form-nav a.disabled").html($(this).data("nav-title"));
  });
});
