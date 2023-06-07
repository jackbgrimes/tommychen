<?php
add_action('wp_ajax_nopriv_submit_music_form', 'submit_music_form');
add_action('wp_ajax_submit_music_form',  'submit_music_form');
$responseIdentifier = null;
$apiErrorResponse = null;

function submit_music_form()
{
  check_ajax_referer( 'awal_spotify' );
  
    if (isset($_POST)) {
        $options = get_option('awal_option_name');
        $spotifyFollower = null;
        if ($_REQUEST['spotify_follower'] !== "" && $_REQUEST['spotify_follower'] !== null) {
            $spotifyFollower = intval($_REQUEST['spotify_follower']);
        }
        $country = getCountryDetail($_POST["country"]);
		$external_test = sanitize_text_field( $_POST['external_test'] ); 
		        
        if (!$country) {
          $return =["status" => "error", "message" => "Country is not correct."];
          echo json_encode($return);
          die();
          return;
        } 
        $postRequest = array(
            'first_name' => $_REQUEST['first_name'],
            'last_name' => $_REQUEST['last_name'],
            'email' => $_REQUEST['email'],
            'role' => $_REQUEST['role'],
            'company' => $_REQUEST['spotify_name'] == "" ? null : $_REQUEST['spotify_name'],
            'country' => $country[1],
            'signing_entity' => $country[2],
            'currency' => $_REQUEST['currency'],
            'spotify_url' => $_REQUEST['spotify_link'] == "" ? null : $_REQUEST['spotify_link'],
            'spotify_followers' => $spotifyFollower,
            'language' => ICL_LANGUAGE_CODE,
            "instagram_url" => null,
            "youtube_url" => null,
            "deezer_url" => null,
            "amazon_music_url" => null,
            "facebook_url" => null,
            "twitter_url" => null,
            "tiktok_url" => null,
            "soundcloud_url" => null,
            "other_url" => null,
            "external_test" => $external_test == 'true' ? true : false
        );
        if (isset($_POST['voucher_code'])) {
          $postRequest['voucher_code'] = $_POST['voucher_code'];
        }
        foreach ($_POST['social_type'] as $idx => $socialType) {
          if (!trim($_POST['social_link'][$idx])) {
            continue;
          }
          $socialLink = $_POST['social_link'][$idx];
          switch($socialType) {
            case "Instagram":
              $postRequest["instagram_url"] = "https://www.instagram.com/" . $socialLink;
              break;
            case "YouTube":
              $postRequest["youtube_url"] = "https://www.youtube.com/" . $socialLink;
              break;
            case "Deezer":
              $postRequest["deezer_url"] = "https://www.deezer.com/us/artist/" . $socialLink;
              break;
            case "Amazon Music":
              $postRequest["amazon_music_url"] = "https://music.amazon.com/artists/" . $socialLink;
              break;
            case "Facebook":
              $postRequest["facebook_url"] = "https://www.facebook.com/" . $socialLink;
              break;
            case "Twitter":
              $postRequest["twitter_url"] = "https://twitter.com/" . $socialLink;
              break;
            case "TikTok":
              $postRequest["tiktok_url"] = "https://www.tiktok.com/@" . $socialLink;
              break;
            case "SoundCloud":
              $postRequest["soundcloud_url"] = "https://soundcloud.com/" . $socialLink;
              break;
            case "Other":
              $postRequest["other_url"] = $socialLink;
              break;
          }
        }

        $tokenPostRequest = array(
            'client_id' => $options['api_key_id'],
            'client_secret' => $options['api_key_secret'],
            'audience' => $options['auth0audience'],
            'grant_type' => 'client_credentials'
        );

        $apiPostRes = curl_init();
        curl_setopt_array($apiPostRes, [
            CURLOPT_URL => $options['auth0url'],
            CURLOPT_HTTPHEADER => ['content-type: application/json'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($tokenPostRequest)
        ]);
        $apiTokenResult = curl_exec($apiPostRes);
        curl_close($apiPostRes);
        $accessTokenValues = (array) json_decode($apiTokenResult);

        if (empty($accessTokenValues)) {
            $accessTokenValues['access_token'] = '';
            $accessTokenValues['token_type'] = '';
        }
        $token = $accessTokenValues['access_token'];
        $tokenType = $accessTokenValues['token_type'];
        $reqHeaders = array('content-type: application/json', "authorization: $tokenType $token");
        $postRes = curl_init();
        
        curl_setopt_array($postRes, [
            CURLOPT_URL => $options['url'],
            CURLOPT_HTTPHEADER => $reqHeaders,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($postRequest)
        ]);
        $dataPostResult = curl_exec($postRes);
        curl_close($postRes);
        $convertDataPostResult = (array) json_decode($dataPostResult);

        if (empty($convertDataPostResult)) {
            $return = ["status" => "error", "message" => _e("There was an error while submitting form. Please try again.", "awal")];
        }

        if ($convertDataPostResult['response'] == 'ok' || $convertDataPostResult['response'] == '200') {
          $return = ["status" => "success", "payload" => $postRequest];
        } else {
            $GLOBALS['responseIdentifier'] = 'error';
            $return = ["status" => "error"];
            if ($options['envmode'] == 'development') {
              $errors = [];
              foreach ($convertDataPostResult as $resKey => $value) {
                if (is_object($value)) {
                  foreach ($value as $key => $val) {
                      $errors[] = $key . ":" . $val[0];
                  }
                } else {
                    $errors[] = $resKey . ' : ' . $value;
                }
              }
              $return["message"] = implode(", ", $errors);
            } else {
              $return["message"] = _e("There was an error while submitting form. Please try again.", "awal");
            }
        }
        echo json_encode($return);
    } else {
      $return =["status" => "error", "message" => _e("Country is not correct.", "awal")];
      echo json_encode($return);
    }
    die();
}

function showForm()
{
    $options = get_option('awal_option_name');

    // request to spotify
    $spClientId =  isset($options["clientId"]) ? $options["clientId"] : null;
    $spClientSecret = isset($options["clientSecret"]) ? $options["clientSecret"] : null;
    $encodedClientKey = base64_encode("$spClientId:$spClientSecret");

    ob_start();
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('select2-css');
    wp_enqueue_style('magnific-popup-css');
    wp_enqueue_script('jquey-js',  get_site_url() . '/wp-content/plugins/awalform/includes/js/jquery-3.6.0.min.js', array('jquery'), '', false);
    wp_enqueue_script('bootstrap-js',  get_site_url() . '/wp-content/plugins/awalform/includes/js/bootstrap.bundle.min.js', array('jquery'), '', false);
    wp_enqueue_script('email-domains',  get_site_url() . '/wp-content/plugins/awalform/includes/js/disposable_domain.js', array('jquery'), '', false);
    wp_enqueue_script('formvalidator-js',  get_site_url() . '/wp-content/plugins/awalform/includes/js/awal-form-validator.js', array('jquery'), '', false);
    wp_enqueue_script('tmpl',  get_site_url() . '/wp-content/plugins/awalform/includes/js/tmpl.min.js', array('jquery'), '', false);
    wp_enqueue_script('select2',  get_site_url() . '/wp-content/plugins/awalform/includes/js/select2.min.js', array('jquery'), '', false);
    wp_enqueue_script('debounce',  get_site_url() . '/wp-content/plugins/awalform/includes/js/jquery.debounce.js', array('jquery'), '', false);
    wp_enqueue_script('magnific',  get_site_url() . '/wp-content/plugins/awalform/includes/js/jquery.magnific-popup.min.js', array('jquery'), '', false);

    // Generate Spotify Token
    get_spotify_token();

    //Getting Terms and Conditions
    $termsPost = get_post(intval($options["terms_condition"]));
    $privacyPost = get_post(intval($options["privacy_policy"]));

    $terms_link = get_permalink(intval($options["terms_condition"]));
    $privacy_link = get_permalink(intval($options["privacy_policy"]));


    $defaultCountry = getCountryFromIP();
    $countryList = getCountryList();
?>
    <div class="container awal-form-container">
        <!-- Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered awal-form-modal modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModal"><?php echo !$termsPost ? "Error" : $termsPost->post_title ?></h5>
                        <button type="button" style="background-color: transparent;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                        echo !$termsPost ? "Please set the page on the plugin settings page." : apply_filters("the_content", $termsPost->post_content);
                      ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered awal-form-modal modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="privacyModal"><?php echo !$privacyPost ? "Error" : $privacyPost->post_title ?></h5>
                        <button type="button" style="background-color: transparent;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                        echo !$privacyPost ? "Please set the page on the plugin settings page." : apply_filters("the_content", $privacyPost->post_content);
                      ?>
                    </div>
                </div>
            </div>
        </div>
        <p class="top-title"><?php esc_html_e( 'APPLY TO AWAL', 'awal' ); ?></p>
        <form method="POST" class="needs-validation" id="awalForm" action="<?php echo admin_url( 'admin-ajax.php' )  ?>" novalidate>
		      <input type="hidden" name="external_test" value="<?php echo esc_attr( sanitize_text_field( $_GET['external_test'] ) ); ?>" />
          <input type="hidden" name="whatever" value="12" />
          <input type="hidden" name="action" value="submit_music_form">
          <?php if (isset($_GET['code']) && !empty($_GET['code'])): ?>
          <input type="hidden" name="voucher_code" value="<?php echo $_GET['code']; ?>">
          <?php endif; ?>
          <div class="form-page was-validated" id="information-form">
            <h2 class="form-title"><?php esc_html_e( 'First thing first, tell us about your role', 'awal' ); ?></h2>
            <div class="row">
              <div class="col-sm-12">
                <div class="role-radio-wrapper">
                  <span>
                    <input type="radio" name="role" id="role-artist" value="Artist or Band" data-nav-title="<?php echo _e("Your music", "awal"); ?>" />
                    <label for="role-artist"><?php esc_html_e( "Artist or Band", "awal"); ?></label>
                  </span>
                  <span>
                    <input type="radio" name="role" id="role-label" value="Label" data-nav-title="<?php echo _e("The artist or band", "awal"); ?>" />
                    <label for="role-label"><?php esc_html_e( "Label", "awal"); ?></label>
                  </span>
                  <span>
                    <input type="radio" name="role" id="role-manager" value="Manager" data-nav-title="<?php echo _e("The artist or band", "awal"); ?>" />
                    <label for="role-manager"><?php esc_html_e( "Manager", "awal"); ?></label>
                  </span>
                  <span>
                    <input type="radio" name="role" id="role-other" value="Other"  data-nav-title="<?php echo _e("The artist or band", "awal"); ?>" />
                    <label for="role-other"><?php esc_html_e( "Other", "awal"); ?></label>
                  </span>
                </div>
              </div>
            </div>
            <div class="info-row" style="display: none">
              <div class="form-nav">
                <a href="javascript: void(0)" class="active"><?php esc_html_e( "1. Your information", "awal"); ?></a>
                <span class="brd"></span>
                <a  href="javascript: void(0)" class="disabled"><?php esc_html_e( "2. Your music", "awal"); ?></a>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label"><?php esc_html_e( "First Name", "awal" ); ?></label>
                        <input type="text" class="form-control" autocomplete="off" id="first_name" name="first_name" required>
                        <div class="invalid-feedback">
                          <?php echo _e("Please enter your first name.", "awal"); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label"><?php esc_html_e( "Last Name", "awal" ); ?></label>
                        <input type="text" class="form-control" autocomplete="off" id="last_name" name="last_name" required>
                        <div class="invalid-feedback">
                          <?php echo _e("Please enter your last name.", "awal"); ?>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                        <label class="form-label"><?php esc_html_e( "Email", "awal" ); ?></label>
                        <input type="email" class="form-control" autocomplete="off" id="email" name="email" required />
                        <div class="invalid-feedback" id="email-validation-message">
                         <?php echo _e("Please enter your email address.", "awal"); ?>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row country-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label"><?php esc_html_e( "Country of Tax Residence", "awal" ); ?></label>
                      <select class="form-select select2" name="country" autocomplete="off" id="country" required>
                          <?php foreach ($countryList as $cItem) { ?>
                          <option value="<?php echo $cItem[1]; ?>" data-currency="<?php echo $cItem[3]; ?>"><?php echo $cItem[0]; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label"><?php esc_html_e( "Currency for Reporting and Payment", "awal" ); ?></label>
                      <select class="form-select select2" name="currency" id="currency" required>
                        <option value="AUD">AUD</option>
                        <option value="CAD">CAD</option>
                        <option value="CHF">CHF</option>
                        <option value="DKK">DKK</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="JPY">JPY</option>
                        <option value="NOK">NOK</option>
                        <option value="SEK">SEK</option>
                        <option value="USD" selected>USD</option>
                      </select>
                      <div class="invalid-feedback">
                          Add a valid Name
                      </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col">
                  <a class="help-link" data-bs-toggle="collapse" href="#whyNeedThis" aria-expanded="false" aria-controls="whyNeedThis"><?php echo esc_html_e( "why do we need this?", "awal" ); ?></a>
                  <div id="whyNeedThis" class="collapse help-desc">
                    <p>We need to collect your personal information and country of tax residence in order to setup your contract and your AWAL account. We won’t share it with anyone and won’t keep it for longer than we need according to 
                    <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#privacyModal">our privacy policy</a>.</p>
                  </div>
                </div>
                <div class="col">
                  <a class="help-link" data-bs-toggle="collapse" href="#nofindcurrency" aria-expanded="false" aria-controls="nofindcurrency"><?php echo esc_html_e( "Can't find your currency?", "awal" ); ?></a>
                  <div id="nofindcurrency" class="collapse help-desc">
                    <p>We recommend you select your own currency. If you can't find it in this list, please select USD.</p>
                  </div>
                </div>
              </div>
              <div class="form-footer">
                <button type="button" class="btn btn-default ms-auto" id="nextBtn" onclick="goToMusic()">Next</button>
              </div>
            </div>
          </div>

          <!-- form section 2 -->
          <div class="form-page was-validated" id="music-form" style="display: none">
            <h2 class="form-title"><?php esc_html_e( 'Submit your music', 'awal' ); ?></h2>
            <div class="form-nav">
                <a href="javascript: void(0)" class="" onclick="gotoInfo()"><?php esc_html_e( "1. Your information", "awal"); ?></a>
                <span class="brd"></span>
                <a  href="javascript: void(0)" class="active"><?php esc_html_e( "2. Your music", "awal"); ?></a>
            </div>
            <p class="form-desc"><?php esc_html_e( 'We carefully review each and every application but we only work with a select group of artists so be sure to share as much information here as possible.', 'awal'); ?></p>
            <div class="form-group">
              <label class="form-label">Artist or Band Name</label>
              <div class="spotify-input-group">
                <i class="fa fa-spin fa-spinner"></i>
                <i class="fa fa-times" id="clear-artist-name"></i>
                <input list="spotify-artist-list" class="form-control" id="spotifyInput" name="spotify_name" autocomplete="off" required />
                <?php wp_nonce_field( 'awal_spotify' ); ?>
                <div class="invalid-feedback">
                  <?php echo _e("Please enter your artist or band name.", "awal"); ?>
                </div>
                <div id="spotify-artist-section" style="display: none">
                  <div class="spotify-artist-header">
                    <h3><?php echo esc_html_e( "Select Profile", "awal"); ?></h3>
                    <p><?php echo _e( "Is this artist one of the following on <b>Spotify</b>?", "awal"); ?></p>
                    <a href="javascript: void(0);"><i class="fa fa-times"></i></a>
                  </div>
                  <div class="spotify-artist-body">
                    <div class="spotify-artist-scroll" id="spotify-artist-scroll">
                      <ul id="spotify-artist-list">
                        <li class="no-item-li" data-url="" data-followers="">
                            <span class="name">
                                <h5><?php echo _e( "This artist isn't on Spotify", "awal"); ?></h5>
                            </span>
                            <span class="radio">
                                <input type="radio" class="form-check-input" name="spotify-artist-item" id="spotify-artist-item-no" value="no-item" />
                            </span>
                        </li>
                      </ul>
                    </div>
                    <div class="show-more">
                        <a href="javascript: void(0)" id="show-more-link"><?php echo _e("Show More Results", "awal"); ?></a>
                    </div>
                  </div>
                  <div class="spotify-artist-footer">
                      <button type="button" class="btn" id="select-spotify-btn"><?php echo _e("Done", "awal"); ?></button>
                  </div>
                </div>
              </div>
              <input type="hidden" name="spotify_follower" id="spFollowers">
              <input type="hidden" name="spotify_link" id="spLink">
            </div>
            <div class="form-group">
              <label class="form-label"><?php echo _e( "Music Profiles", "awal"); ?></label>
              <div id="music-profile-list">
                
              </div>
              <div class="invalid-feedback">
                <?php echo _e("Please enter at least one profile.", "awal"); ?>
              </div>
              <a href="javascript: void(0)" id="add-profile-link"><?php echo _e("+ Add a profile", "awal"); ?></a>
            </div>
            <div class="form-group google-captcha-row">
              <div class="captcha" id="google-captcha"></div>
              <div class="invalid-feedback">
                <?php echo _e("Please complete the captcha and try submitting again.", "awal"); ?>
              </div>
            </div>
            <div class="form-footer">
              <a href="javascript: void(0)" class="back-link" onclick="gotoInfo()"><?php echo _e("Back", "awal"); ?></a>
              <button type="button" class="btn btn-default ms-auto" id="submit-form-btn" onclick="submitForm()">
                <i class="fa fa-spin fa-spinner"></i>
                <?php echo _e("submit your application", "awal"); ?>
              </button>
            </div>
            
            <div id="error-message-wrapper" style="display: none" class="alert alert-danger mt-4"></div>
          </div>

          <div class="form-page thankyou-form" id="thankyou-form" style="display: none">
            <h2 class="form-title"><?php esc_html_e( 'Thank you', 'awal' ); ?></h2>
            <p class="form-desc"><?php esc_html_e( 'You’ve successfully submitted your application and we just sent you a confirmation email. Our team will carefully review it and get back to you shortly.', 'awal'); ?></p>
            <p class="form-desc"><?php esc_html_e( 'Watch out for an email from us!', 'awal'); ?></p>
            
          </div>
        </form>
      </div>

      <div id="terms-content" class="mfp-hide">
        <div class="popup-header">
          Terms & Conditions
        </div>
        <div class="popup-content"> 
          <div class="popup-content-wrapper">
            <?php echo get_the_content(null, false, $options['terms_condition']); ?>
          </div>
        </div>
        <div class="popup-footer"> 
          <div class="popup-footer__desc">
            You must read to the end of these T&C to continue.
          </div>
          <a href="#" class="btn btn-decline">Decline</a> 
          <a href="#" class="btn btn-agree">Accept & Submit</a>
        </div>
      </div>
      
      <div id="music-profile-row-template" class="row" style="display: none">
        <div class="col-md-4 form-group">
          <select class="form-select social-type" name="social_type[]">
            <option value="Instagram" data-index="1" data-url="https://www.instagram.com/" data-placeholder="username">Instagram</option>
            <option value="YouTube" data-index="2" data-url="https://www.youtube.com/" data-placeholder="channelname">YouTube</option>
            <option value="Deezer" data-index="3" data-url="https://www.deezer.com/us/artist/" data-placeholder="number">Deezer</option>
            <option value="Amazon Music" data-index="4" data-url="https://music.amazon.com/artists/" data-placeholder="id">Amazon Music</option>
            <option value="Facebook"  data-index="5" data-url="https://www.facebook.com/" data-placeholder="username">Facebook</option>
            <option value="Twitter"  data-index="6" data-url="https://twitter.com/" data-placeholder="username">Twitter</option>
            <option value="TikTok"  data-index="7" data-url="https://www.tiktok.com/@" data-placeholder="profileId">TikTok</option>
            <option value="SoundCloud" data-index="8" data-url="https://soundcloud.com/" data-placeholder="username">SoundCloud</option>
            <option value="Other" data-index="9" data-url="" data-placeholder="Other Url">Other</option>
          </select>
        </div>
        <div class="col-md-8 form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"></span>
            </div>
            <!-- pattern="http(s?)://([a-zA-Z0-9\.\/\+-_%]+)" -->
            <input type="text" class="form-control social-link empty" required name="social_link[]" placeholder="" autocomplete="off" required value="" />
            <div class="invalid-feedback">
              <?php echo _e("Please enter a valid url.", "awal"); ?>
            </div>
            <button type="button" class="remove-profile-btn" style="display: block"></button>
          </div>
        </div>
      </div>
    <script src="https://www.google.com/recaptcha/api.js?onload=recaptchaOnLoadedCallback&render=explicit" async defer></script>
    <script type="text/javascript">
      var captchaWidget = null;                        
      var enterOneProfileMessage = "<?php echo _e("Please enter at least one profile.", "awal"); ?>";
      var enterValidUrlMessage = "<?php echo _e("Please enter a valid url.", "awal"); ?>";
      var enterEmailMessage = "<?php echo _e("Please enter your email address.", "awal"); ?>";
      var enterValidEmailMessage = "<?php echo _e("Please enter a valid email address.", "awal"); ?>";
      var enterDeposableEmailMessage = "<?php echo _e("You can't use a disposable email address.", "awal"); ?>";
      var submitErrorMessage = "<?php echo _e("We're having trouble submitting your request, please refresh and try again", "awal"); ?>";
      var recaptchaOnLoadedCallback = function() {
        captchaWidget = grecaptcha.render('google-captcha', {
          'sitekey' : '<?php echo $options['recaptcha_key'];?>',
          'callback': function() {
            $('.google-captcha-row .invalid-feedback').hide();
          }
        });
      };
    </script>
    <script type="text/x-tmpl" id="spotify-li">
        <li 
          data-id="{%=o.id%}"
          data-followers="{%=o.followers%}"
          data-name="{%= o.name %}"
          data-url="{%= o.link %}"
        >
            <span class="img">
                <img src="{%= o.img %}"" />
            </span>
            <span class="name">
                <h5>{%= o.name %}</h5>
                <b>{%= o.followers %} <?php echo _e("Followers", "awal"); ?></b>
                <a href="{%= o.link %}" target="_blank"><?php echo _e("View on Spotify", "awal"); ?></a>
            </span>
            <span class="radio">
            <input type="radio" class="form-check-input" name="spotify-artist-item" id="spotify-artist-item-{%= o.id %}" value="{%= o.id %}" />
            </span>
        </li>
    </script>

<?php
    return ob_get_clean();
}

if (isset($_POST['artist-submit'])) {
    save_custom_form();
}

if (!is_admin()) {
  // we are not in admin mode
  add_shortcode('awal-form', 'showForm');
}

add_action( 'wp_ajax_spotify_search_artists', 'spotify_search_artists' );
add_action( 'wp_ajax_nopriv_spotify_search_artists', 'spotify_search_artists' );

function spotify_search_artists() {
  check_ajax_referer( 'awal_spotify' );

  $spotify_search_url      = sanitize_url( $_POST['spotify_search_url'] );

  $token = get_spotify_token();  
  $reqHeaders = array('content-type: application/json', "authorization: Bearer $token");
  $postRes = curl_init();
  
  curl_setopt_array($postRes, [
    CURLOPT_URL => $spotify_search_url,
    CURLOPT_HTTPHEADER => $reqHeaders,
    CURLOPT_RETURNTRANSFER => true,
  ]);
  $dataPostResult = curl_exec($postRes);
  curl_close($postRes);
  $convertDataPostResult = (array) json_decode($dataPostResult);

  wp_send_json_success( $convertDataPostResult );
}

function get_spotify_token() {
  $spData = get_transient( 'spotify_token' );

  if( empty( $spData ) ) {
    $options = get_option('awal_option_name');

    // request to spotify
    $spClientId =  isset($options["clientId"]) ? $options["clientId"] : null;
    $spClientSecret = isset($options["clientSecret"]) ? $options["clientSecret"] : null;
    $encodedClientKey = base64_encode("$spClientId:$spClientSecret");

    $spRequestHeaders = array('Content-Type: application/x-www-form-urlencoded', "Authorization: Basic $encodedClientKey");    
    $spPostRequest = curl_init();
    curl_setopt_array($spPostRequest, [
        CURLOPT_URL => 'https://accounts.spotify.com/api/token',
        CURLOPT_HTTPHEADER => $spRequestHeaders,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => "grant_type=client_credentials"
    ]);
    $spDataPostResult = curl_exec($spPostRequest);
    curl_close($spPostRequest);
    $convertSpDataPostResult = (array) json_decode($spDataPostResult);
    $spData = isset($convertSpDataPostResult['access_token']) ? $convertSpDataPostResult['access_token'] : null;

    if( ! empty( $spData ) ) {
      set_transient( 'spotify_token', $spData, 2700 );
    }
  }

  return $spData;
}