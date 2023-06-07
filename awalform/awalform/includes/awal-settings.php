<?php
class Awal_Settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Overdrive API Settings',
            'Artist API Settings',
            'manage_options',
            'awal-settings',
            array($this, 'create_admin_page')
        );
    }
    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option('awal_option_name');
?>
        <div class="wrap">
            <h1>Artist Form Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('awal_option_group');
                do_settings_sections('awal-settings');
                submit_button();
                ?>
            </form>
        </div>
<?php
    }
    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'awal_option_group', // Option group
            'awal_option_name', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Api configurations', // Title
            array($this, 'print_section_info'), // Callback
            'awal-settings' // Page
        );

        add_settings_field(
            'url', // ID
            'API URL', // Title 
            array($this, 'url_callback'), // Callback
            'awal-settings', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'auth0url', // ID
            'Auth0 Api Url', // Title 
            array($this, 'auth0_url_callback'), // Callback
            'awal-settings', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'auth0audience', // ID
            'Auth0 Audience', // Title 
            array($this, 'auth0_audience_callback'), // Callback
            'awal-settings', // Page
            'setting_section_id' // Section           
        );

        add_settings_field(
            'clientId',
            'Spotify client Id',
            array($this, 'client_id_callback'),
            'awal-settings',
            'setting_section_id'
        );

        add_settings_field(
            'clientSecret',
            'Spotify client Secret Key',
            array($this, 'client_secret_callback'),
            'awal-settings',
            'setting_section_id'
        );

        add_settings_field(
            'api_key_id',
            'Api Client Id',
            array($this, 'api_key_callback'),
            'awal-settings',
            'setting_section_id'
        );

        add_settings_field(
            'api_key_secret',
            'Api Client Secret Key',
            array($this, 'api_secret_key_callback'),
            'awal-settings',
            'setting_section_id'
        );

        add_settings_field(
            'envmode',
            'Environment' . '<br><small>(select development only for testing process.)</small>',
            array($this, 'env_callback'),
            'awal-settings',
            'setting_section_id'
        );

        add_settings_field(
            'recaptcha_key',
            'Recaptcha Secret Key',
            array($this, 'recaptcha_key_callback'),
            'awal-settings',
            'setting_section_id'
        );
        // editor
        add_settings_field(
            'terms_condition',
            'Terms & condition Page Id ',
            array($this, 'terms_callback'),
            'awal-settings',
            'setting_section_id'
        );
        add_settings_field(
            'privacy_policy',
            'Privacy Policy Page Id ',
            array($this, 'privacy_callback'),
            'awal-settings',
            'setting_section_id'
        );
        add_settings_field(
            'external_test',
            'External Test Parameter',
            array($this, 'external_test'),
            'awal-settings',
            'setting_section_id'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();
        if (isset($input['url']))
            $new_input['url'] = sanitize_text_field($input['url']);
        if (isset($input['clientSecret']))
            $new_input['clientSecret'] = sanitize_text_field($input['clientSecret']);
        if (isset($input['clientId']))
            $new_input['clientId'] = sanitize_text_field($input['clientId']);
        if (isset($input['api_key_id']))
            $new_input['api_key_id'] = sanitize_text_field($input['api_key_id']);
        if (isset($input['api_key_secret']))
            $new_input['api_key_secret'] = sanitize_text_field($input['api_key_secret']);
        if (isset($input['auth0url']))
            $new_input['auth0url'] = sanitize_text_field($input['auth0url']);
        if (isset($input['auth0audience']))
            $new_input['auth0audience'] = sanitize_text_field($input['auth0audience']);
        if (isset($input['envmode']))
            $new_input['envmode'] = sanitize_text_field($input['envmode']);
        if (isset($input['recaptcha_key']))
            $new_input['recaptcha_key'] = sanitize_text_field($input['recaptcha_key']);
        // editor
        if (isset($input['terms_condition']))
            $new_input['terms_condition'] = sanitize_text_field($input['terms_condition']);
        if (isset($input['privacy_policy']))
            $new_input['privacy_policy'] = sanitize_text_field($input['privacy_policy']);
        if (isset($input['external_test']))
            $new_input['external_test'] = sanitize_text_field($input['external_test']);
        return $new_input;
    }
    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
    /** 
     * Get the settings option array and print one of its values
     */
    public function url_callback()
    {
        printf(
            '<input type="text"  size="50" id="url" name="awal_option_name[url]" value="%s" />',
            isset($this->options['url']) ? esc_attr($this->options['url']) : ''
        );
    }

    public function auth0_url_callback()
    {
        printf(
            '<input type="text"  size="50" id="auth0url" name="awal_option_name[auth0url]" value="%s" />',
            isset($this->options['auth0url']) ? esc_attr($this->options['auth0url']) : ''
        );
    }

    public function auth0_audience_callback()
    {
        printf(
            '<input type="text"  size="50" id="auth0audience" name="awal_option_name[auth0audience]" value="%s" />',
            isset($this->options['auth0audience']) ? esc_attr($this->options['auth0audience']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function client_id_callback()
    {
        printf(
            '<input type="text"  size="50" id="clientId" name="awal_option_name[clientId]" value="%s" />',
            isset($this->options['clientId']) ? esc_attr($this->options['clientId']) : ''
        );
    }

    public function client_secret_callback()
    {
        printf(
            '<input type="text"  size="50" id="clientSecret" name="awal_option_name[clientSecret]" value="%s" />',
            isset($this->options['clientSecret']) ? esc_attr($this->options['clientSecret']) : ''
        );
    }

    public function api_key_callback()
    {
        printf(
            '<input type="text"  size="50" id="api_key_id" name="awal_option_name[api_key_id]" value="%s" />',
            isset($this->options['api_key_id']) ? esc_attr($this->options['api_key_id']) : ''
        );
    }

    public function api_secret_key_callback()
    {
        printf(
            '<input type="text"  size="50" id="api_key_secret" name="awal_option_name[api_key_secret]" value="%s" />',
            isset($this->options['api_key_secret']) ? esc_attr($this->options['api_key_secret']) : ''
        );
    }

    public function recaptcha_key_callback()
    {
        printf(
            '<input type="text"  size="50" id="recaptcha_key" name="awal_option_name[recaptcha_key]" value="%s" />',
            isset($this->options['recaptcha_key']) ? esc_attr($this->options['recaptcha_key']) : ''
        );
    }
    public function env_callback()
    {
        $html = '<select id="envmode" name="awal_option_name[envmode]">';
        $html .= '<option value="production"';
        if ($this->options["envmode"] == "production" || $this->options["envmode"] == null) {
            $html .= 'selected';
        }
        $html .= ' >Production</option>';

        $html .= '<option value="development" ';
        if ($this->options["envmode"] == "development") {
            $html .= 'selected';
        }
        $html .= '>Development</option>';
        echo $html;
    }
    public function terms_callback()
    {
        $html = '<select id="terms_conditions_page" name="awal_option_name[terms_condition]">';
        $html .= '<option value="0">- Select -</option>';
        $pages = get_pages();
        foreach ($pages as $page) {
            $html .= '<option value="' . $page->ID . '" ' . ($this->options['terms_condition'] == $page->ID ? 'selected' : '') . '>' . $page->post_title . '</option>';
        }
        echo $html;
    }
    public function privacy_callback()
    {
        $html = '<select id="privacy_policy_page" name="awal_option_name[privacy_policy]">';
        $html .= '<option value="0">- Select -</option>';
        $pages = get_pages();
        foreach ($pages as $page) {
            $html .= '<option value="' . $page->ID . '" ' . ($this->options['privacy_policy'] == $page->ID ? 'selected' : '') . '>' . $page->post_title . '</option>';
        }
        echo $html;
    }
    public function external_test()
    {
        $html = '<select id="external_test" name="awal_option_name[external_test]">';
        $html .= '<option value="true" ' . ($this->options['external_test'] == "true" ? 'selected' : '') . '>True</option>';
        $html .= '<option value="false" ' . ($this->options['external_test'] != "true" ? 'selected' : '') . '>False</option>';
        echo $html;
    }
}

if (is_admin())
    return new Awal_settings();