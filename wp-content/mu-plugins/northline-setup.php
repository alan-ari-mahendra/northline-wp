<?php
/**
 * Plugin Name: Northline Operations Landing Page
 * Description: Builds the Northline Operations landing page in Elementor.
 * Version: 1.0.0
 */

defined( 'ABSPATH' ) || exit;

define( 'NL_SETUP_KEY', 'nl_setup_v1' );
define( 'NL_DATA_VERSION', '3.4' );

/* ===== SETUP (runs once on first request) ===== */

add_action( 'init', 'nl_run_setup', 20 );
add_action( 'init', 'nl_maybe_update_data', 25 );

function nl_run_setup() {
	if ( get_option( NL_SETUP_KEY ) ) {
		return;
	}
	if ( ! function_exists( 'wp_insert_post' ) ) {
		return;
	}

	nl_setup_kit();
	$page_id = nl_create_page();

	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page_id );
		update_option( NL_SETUP_KEY, $page_id );
	}
}

function nl_maybe_update_data() {
	$page_id = (int) get_option( NL_SETUP_KEY );
	if ( ! $page_id ) {
		return;
	}
	if ( get_option( 'nl_data_version' ) === NL_DATA_VERSION ) {
		return;
	}

	$data = nl_build_elementor_data();
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );
	delete_post_meta( $page_id, '_elementor_css' );
	// Delete filesystem CSS cache so Elementor regenerates on next load.
	$css_file = WP_CONTENT_DIR . '/uploads/elementor/css/post-' . $page_id . '.css';
	if ( file_exists( $css_file ) ) {
		@unlink( $css_file );
	}
	if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
	}
	update_option( 'nl_data_version', NL_DATA_VERSION );
}

/* ===== ASSETS ===== */

add_action( 'wp_enqueue_scripts', 'nl_enqueue_assets' );
add_filter( 'body_class', 'nl_body_class' );

function nl_enqueue_assets() {
	$page_id = (int) get_option( NL_SETUP_KEY );
	if ( ! $page_id ) {
		return;
	}
	if ( ! is_front_page() && ! is_page( $page_id ) ) {
		return;
	}

	$base = WPMU_PLUGIN_URL . '/northline-assets/';

	wp_enqueue_style(
		'nl-google-fonts',
		'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		'nl-material-symbols',
		'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,300,0,0',
		[],
		null
	);

	wp_enqueue_style( 'nl-styles', $base . 'northline.css', [ 'nl-google-fonts', 'nl-material-symbols' ], '1.0.5' );
	wp_enqueue_script( 'nl-scripts', $base . 'northline.js', [], '1.0.3', true );
}

function nl_body_class( $classes ) {
	$page_id = (int) get_option( NL_SETUP_KEY );
	if ( $page_id && ( is_front_page() || is_page( $page_id ) ) ) {
		$classes[] = 'nl-page';
	}
	return $classes;
}

/* ===== ELEMENTOR KIT ===== */

function nl_setup_kit() {
	$kit_id = (int) get_option( 'elementor_active_kit' );
	if ( ! $kit_id ) {
		return;
	}

	$settings = get_post_meta( $kit_id, '_elementor_page_settings', true );
	if ( ! is_array( $settings ) ) {
		$settings = [];
	}

	$settings['custom_colors'] = [
		[ '_id' => 'nl-primary',   'title' => 'NL Primary',   'color' => '#000a24' ],
		[ '_id' => 'nl-ink',       'title' => 'NL Ink',       'color' => '#14213d' ],
		[ '_id' => 'nl-secondary', 'title' => 'NL Secondary', 'color' => '#006a60' ],
		[ '_id' => 'nl-surface',   'title' => 'NL Surface',   'color' => '#f9f9ff' ],
		[ '_id' => 'nl-white',     'title' => 'NL White',     'color' => '#ffffff' ],
		[ '_id' => 'nl-sand',      'title' => 'NL Sand',      'color' => '#e7c268' ],
		[ '_id' => 'nl-outline',   'title' => 'NL Outline',   'color' => '#75777e' ],
	];

	$settings['custom_typography'] = [
		[
			'_id'                       => 'nl-display',
			'title'                     => 'NL Display (Newsreader)',
			'typography_typography'     => 'custom',
			'typography_font_family'    => 'Newsreader',
			'typography_font_weight'    => '400',
		],
		[
			'_id'                       => 'nl-body',
			'title'                     => 'NL Body (DM Sans)',
			'typography_typography'     => 'custom',
			'typography_font_family'    => 'DM Sans',
			'typography_font_weight'    => '400',
		],
		[
			'_id'                       => 'nl-label',
			'title'                     => 'NL Label',
			'typography_typography'     => 'custom',
			'typography_font_family'    => 'DM Sans',
			'typography_font_weight'    => '500',
			'typography_text_transform' => 'uppercase',
			'typography_letter_spacing' => [ 'unit' => 'em', 'size' => 0.08 ],
			'typography_font_size'      => [ 'unit' => 'px', 'size' => 11 ],
		],
	];

	update_post_meta( $kit_id, '_elementor_page_settings', $settings );
}

/* ===== PAGE CREATION ===== */

function nl_create_page() {
	$page_id = wp_insert_post( [
		'post_title'   => 'Northline Operations',
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_name'    => 'northline',
		'post_content' => '',
	] );

	if ( ! $page_id || is_wp_error( $page_id ) ) {
		return false;
	}

	update_post_meta( $page_id, '_wp_page_template', 'elementor_canvas' );
	update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $page_id, '_elementor_template_type', 'page' );
	update_post_meta( $page_id, '_elementor_page_settings', [] );
	update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( nl_build_elementor_data() ) ) );

	return $page_id;
}

/* ===== ELEMENTOR DATA BUILDER ===== */

function nl_build_elementor_data() {
	return [
		nl_ct( 'header',   [], [ nl_wg( 'header-html',   nl_html_header() ) ] ),
		nl_ct( 'hero',     [], [ nl_wg( 'hero-html',     nl_html_hero() ) ] ),
		nl_ct( 'familiar', [], [ nl_wg( 'familiar-html', nl_html_familiar() ) ] ),
		nl_ct( 'services', [], [ nl_wg( 'services-html', nl_html_services() ) ] ),
		nl_ct( 'approach', [], [ nl_wg( 'approach-html', nl_html_approach() ) ] ),
		nl_ct( 'work',     [], [ nl_wg( 'work-html',     nl_html_work() ) ] ),
		nl_ct( 'about',    [], [ nl_wg( 'about-html',    nl_html_about() ) ] ),
		nl_ct( 'contact',  [], [ nl_wg( 'contact-html',  nl_html_contact() ) ] ),
		nl_ct( 'footer',   [], [ nl_wg( 'footer-html',   nl_html_footer() ) ] ),
	];
}

/* ===== HELPERS ===== */

function nl_ct( $id, $extra, $elements ) {
	return [
		'id'      => substr( md5( 'nl-ct-' . $id ), 0, 8 ),
		'elType'  => 'container',
		'isInner' => false,
		'settings' => array_merge( [
			'_title'        => ucfirst( $id ),
			'flex_direction' => 'column',
			'content_width'  => 'full',
			'padding' => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
			'margin'  => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
		], $extra ),
		'elements' => $elements,
	];
}

function nl_wg( $id, $html ) {
	return [
		'id'         => substr( md5( 'nl-wg-' . $id ), 0, 8 ),
		'elType'     => 'widget',
		'widgetType' => 'html',
		'isInner'    => false,
		'settings'   => [ 'html' => $html ],
		'elements'   => [],
	];
}

/* ===== HTML SECTIONS ===== */

function nl_html_header() {
	return <<<'HTML'
<header class="nl-header">
  <div class="nl-header-inner">
    <a class="nl-logo" href="#">
      <span class="nl-logo-name">Northline</span>
      <span class="nl-logo-sub">Operations · Manchester</span>
    </a>
    <nav class="nl-nav">
      <a href="#services">Services</a>
      <a href="#approach">Approach</a>
      <a href="#work">Selected Work</a>
      <a href="#about">About</a>
      <a href="#contact">Operations Audit</a>
      <a href="#contact">Contact</a>
    </nav>
    <div class="nl-header-actions">
      <a class="nl-header-cta" href="#contact">Book a Discovery Call</a>
      <div class="nl-avatar">
        <span class="material-symbols-outlined">person</span>
      </div>
    </div>
  </div>
</header>
<div class="nl-header-spacer"></div>
HTML;
}

function nl_html_hero() {
	return <<<'HTML'
<div class="flex flex-col w-full bg-[#FAFAF7] text-primary">
<section class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop pt-space-xl lg:pt-space-2xl pb-space-3xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter lg:gap-gutter-desktop items-start">

  <!-- Left: 7 cols -->
  <div class="lg:col-span-7 flex flex-col justify-between pr-0 lg:pr-space-md">
    <div>
      <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-md">OPERATIONAL DIAGNOSTICS &amp; WORKFLOW REALIGNMENT</span>
      <h1 class="font-display-xl text-display-xl text-primary font-normal tracking-tight leading-none mb-space-lg max-w-xl">
        Your business grew. Your operations didn't.
      </h1>
      <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed mb-space-2xl">We fix the handoffs, processes, and tools that slow growing UK companies down &mdash; cleanly and without six-month advisory programmes.</p>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center gap-space-lg pt-space-md">
      <a class="inline-flex items-center justify-center bg-primary-container text-surface-container-lowest font-label-editorial text-label-editorial uppercase tracking-widest px-space-xl py-space-md hover:bg-primary transition-colors" href="#contact">
        Book a Discovery Call
      </a>
      <a class="inline-flex items-center gap-space-xs font-body-sm text-body-sm text-primary hover:text-secondary group transition-colors" href="#approach">
        <span class="underline decoration-tertiary-fixed-dim underline-offset-8 group-hover:decoration-primary">See how we work</span>
        <span class="material-symbols-outlined text-[16px] text-primary transition-transform group-hover:translate-x-1">arrow_forward</span>
      </a>
    </div>
  </div>

  <!-- Right: 5 cols — editorial photo frame -->
  <div class="lg:col-span-5 mt-space-xl lg:mt-0 flex flex-col">
    <div class="bg-surface-container-lowest p-space-sm">
      <div class="relative w-full bg-surface-container overflow-hidden" style="aspect-ratio:4/5">
        <img
          alt="Manchester office"
          class="w-full object-cover grayscale contrast-[1.05]"
          style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuCa7lkh5E9R6c9NEfAIPR-31Mq-QsLUxoEmCtkS_QSHZYkp-pWcXQbAMoFTHnuJdFPc1yhRh8702Dsjff8htXW25204FwCE-DKkuUdbofwnuVXQga6V6pzs_FKtJf266IMejNtFEJbRgjlztEc_tiuqIK8-7YY4riLg-G59LLdqwK2c3F4UOHLKF1h_X_MWMem-OCt0ZM9DuzemF0AV7REZTyFTn9Mg10dWrJBPd6XY"
          loading="eager"
        >
        <div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 px-space-sm py-0.5">
          <span class="font-label-editorial text-label-editorial uppercase text-on-surface tracking-widest text-[10px]">LOC: MANCHESTER &middot; STUDIO DESK</span>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-between mt-space-sm text-on-surface-variant">
      <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline text-[10px]">FIG 1.0 &mdash; FIELD OBSERVATIONS</span>
      <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline text-[10px]">UNVARNISHED DIAGNOSIS</span>
    </div>
  </div>

</div>
</section>
</div>
HTML;
}

function nl_html_familiar() {
	return <<<'HTML'
<section class="nl-familiar" id="familiar">
  <div class="nl-wrap">
    <div class="nl-section-header">
      <div class="nl-section-header-left">
        <span class="nl-eyebrow">Common Bottlenecks</span>
        <h2>Sound familiar?</h2>
      </div>
      <p>Friction outpaces revenue as teams expand. Most leadership teams encounter the exact same structural ceilings.</p>
    </div>
    <div class="nl-cards-3">
      <div class="nl-card">
        <div>
          <div class="nl-card-header">
            <span class="nl-numeral">01</span>
            <span class="nl-tag">Bottleneck</span>
          </div>
          <h3>Everything goes through you.</h3>
          <p>Decisions wait on key founders. When leadership steps away, progress stalls.</p>
        </div>
        <div class="nl-card-footer">
          <span class="nl-status">[ Dependency Ratio: High ]</span>
        </div>
      </div>
      <div class="nl-card">
        <div>
          <div class="nl-card-header">
            <span class="nl-numeral">02</span>
            <span class="nl-tag">Alignment</span>
          </div>
          <h3>Work falls between teams.</h3>
          <p>Sales promises, operations scrambles, and handoffs create invisible chasms.</p>
        </div>
        <div class="nl-card-footer">
          <span class="nl-status">[ Friction: Interdepartmental ]</span>
        </div>
      </div>
      <div class="nl-card">
        <div>
          <div class="nl-card-header">
            <span class="nl-numeral">03</span>
            <span class="nl-tag">Fragmentation</span>
          </div>
          <h3>Your tools don't talk.</h3>
          <p>Spreadsheets and siloed systems force teams to cross-check data all week.</p>
        </div>
        <div class="nl-card-footer">
          <span class="nl-status">[ Integration Loss: Critical ]</span>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;
}

function nl_html_services() {
	return <<<'HTML'
<section class="nl-services" id="services">
  <div class="nl-wrap">
    <div class="nl-services-header">
      <div>
        <span class="nl-eyebrow">Core Capabilities</span>
        <h2>Services</h2>
      </div>
      <p>Focused operational interventions. We build autonomy rather than perpetual retainers.</p>
    </div>
    <div class="nl-cards-3">
      <div class="nl-service-card">
        <div>
          <span class="nl-service-label">01 · Diagnostic Review</span>
          <h3>Operations Audit</h3>
          <p>A two-week diagnostic shadowing live workflows to identify and catalog operational drag.</p>
        </div>
        <div class="nl-service-footer">
          <a class="nl-link-ne" href="#contact">
            <span>Explore the Operations Audit</span>
            <span class="material-symbols-outlined">north_east</span>
          </a>
        </div>
      </div>
      <div class="nl-service-card">
        <div>
          <span class="nl-service-label">02 · Architecture</span>
          <h3>Process Redesign</h3>
          <p>Clear handoffs and single-owner accountability frameworks your team actually adopts.</p>
        </div>
        <div class="nl-service-footer">
          <span class="nl-service-meta">Cadence · 4 to 6 Weeks</span>
        </div>
      </div>
      <div class="nl-service-card">
        <div>
          <span class="nl-service-label">03 · Infrastructure</span>
          <h3>Systems and Tooling</h3>
          <p>Eliminate software bloat and configure resilient integrations built around how you work.</p>
        </div>
        <div class="nl-service-footer">
          <span class="nl-service-meta">Scope · Stack Realignment</span>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;
}

function nl_html_approach() {
	return <<<'HTML'
<section class="nl-approach" id="approach">
  <div class="nl-wrap">
    <div class="nl-approach-intro">
      <span class="nl-eyebrow">Methodology</span>
      <h2>Our approach</h2>
      <p>A four-stage methodology calibrated to minimize organizational fatigue while driving structural clarity.</p>
    </div>
    <div class="nl-steps">
      <div class="nl-step">
        <div>
          <div class="nl-step-header">
            <span class="nl-step-num">01</span>
            <span class="nl-step-label">Discovery</span>
          </div>
          <h3>Listen</h3>
          <p>Direct, confidential interviews to identify hidden workflow blockers.</p>
        </div>
        <span class="nl-step-status">All Teams Audited</span>
      </div>
      <div class="nl-step">
        <div>
          <div class="nl-step-header">
            <span class="nl-step-num">02</span>
            <span class="nl-step-label">Mapping</span>
          </div>
          <h3>Map</h3>
          <p>Documenting how daily work actually moves across informal channels.</p>
        </div>
        <span class="nl-step-status">As-Is Blueprint</span>
      </div>
      <div class="nl-step">
        <div>
          <div class="nl-step-header">
            <span class="nl-step-num">03</span>
            <span class="nl-step-label">Synthesis</span>
          </div>
          <h3>Redesign</h3>
          <p>Targeting the high-leverage fixes instead of 100-page roadmaps.</p>
        </div>
        <span class="nl-step-status">High-Leverage Focus</span>
      </div>
      <div class="nl-step">
        <div>
          <div class="nl-step-header">
            <span class="nl-step-num">04</span>
            <span class="nl-step-label">Retention</span>
          </div>
          <h3>Embed</h3>
          <p>Training, documentation, and check-ins to make habits stick.</p>
        </div>
        <span class="nl-step-status">Long-Term Adoption</span>
      </div>
    </div>
  </div>
</section>
HTML;
}

function nl_html_work() {
	return <<<'HTML'
<section class="nl-work" id="work">
  <div class="nl-wrap">
    <div class="nl-work-header">
      <div>
        <span class="nl-eyebrow">Dossiers</span>
        <h2>Selected work</h2>
      </div>
      <span class="nl-work-anon">Anonymized Engagements</span>
    </div>
    <div class="nl-cases">
      <article class="nl-case">
        <div>
          <div class="nl-case-top">
            <span class="nl-case-badge">Concept case study</span>
            <span class="nl-case-num">Case // 041</span>
          </div>
          <h3>Regional logistics firm</h3>
          <div class="nl-case-img">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxkUu9ghoEYCM-2YVCkB8iCYXn2MQxsDzPS04fFlUPY68AePPojXvr9L-3QudT6y6aTfusYlzHGG35kbtNT0SZjkXoxe9ZNM1mfpXxgagpvHHvyRDM1xpi2_S-Qsu4CTliUQMFcjoRxlccUs1g_4W3m_YlyWhuOVif9u7I6tjtPwMX5i0lbuZf2GbSt03KrNIbJSGkcPQV6a_6esVgoDF40tQgc9knsufsh2uny158" alt="warehouse operations">
          </div>
          <p>Reworked order-to-dispatch handoffs between sales and the warehouse team, with one shared tracking board replacing four spreadsheets.</p>
        </div>
        <div class="nl-case-foot">
          <span class="nl-case-sector">Sector: Supply Chain · MCR</span>
          <span class="nl-case-type">Dispatch Restructuring</span>
        </div>
      </article>
      <article class="nl-case">
        <div>
          <div class="nl-case-top">
            <span class="nl-case-badge">Concept case study</span>
            <span class="nl-case-num">Case // 042</span>
          </div>
          <h3>Family-run manufacturer</h3>
          <div class="nl-case-img">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHF4FKnDgTo1QtSuHED8FhXL50mYpy9LzgZHS0AQcHeiEyXYsIlNJhx-geSgdbdARtovYv79u_PMWATZTnHwh3qJObyPGL2Dp5-ac1JpDq_mmz7kUeuA0UdeZ9F_5nFrFBYThmk5lNbCA6rjMSDq_44NR_PGIvEnXpcsaajomKzD0hcjsdJxjjXpqZZmqw66GaWT8r-9PqziIRpTOq68v4o1TmUpZvRz5IXhs6OOe8" alt="team workshop office">
          </div>
          <p>Created a weekly operating rhythm and clear decision owners so the founders could step back from day-to-day approvals.</p>
        </div>
        <div class="nl-case-foot">
          <span class="nl-case-sector">Sector: Precision Engineering · Cheshire</span>
          <span class="nl-case-type">Governance &amp; Delegation</span>
        </div>
      </article>
    </div>
  </div>
</section>
HTML;
}

function nl_html_about() {
	return <<<'HTML'
<section class="nl-about" id="about">
  <div class="nl-wrap">
    <div class="nl-about-grid">
      <div class="nl-about-photo">
        <div class="nl-about-photo-box" style="aspect-ratio:4/5">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCebdvuJPKzNBxaXYRapIQd_Zo5hnl4x2435tfArr38rXwhRGzi9nL8UH72A1vYRX3NyK-8tbYQQzVR0fegzyaEACk-yOQsqjM4IPipTNRm2xuoor5baIfzNeoBMmA1GtkMOFg8uXRMxeivnUoKNmlwOAKf5Al_iSyKAa2JQ0CzvF7mNQ8HIHqL6VkzLTBfJqtcPbLaefkDQPN-WEO9xuYYurDCgxeRCTwBCQWbKfCx" alt="Founder — lead practitioner" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover">
          <div class="nl-photo-caption">Founder · Lead Practitioner</div>
        </div>
      </div>
      <div class="nl-about-right">
        <span class="nl-eyebrow">Perspective</span>
        <h2>Practitioners, not career theorists.</h2>
        <div class="nl-pullquote">
          <p>"We work with a small number of clients at a time, led directly by operators who stay until changes stick."</p>
        </div>
        <p class="nl-about-body">The healthiest businesses operate on fewer dashboards, simpler rules, and direct personal accountability.</p>
      </div>
    </div>
  </div>
</section>
HTML;
}

function nl_html_contact() {
	return <<<'HTML'
<section class="nl-contact" id="contact">
  <div class="nl-wrap">
    <div class="nl-contact-inner">
      <div class="nl-contact-grid">
        <div class="nl-contact-left">
          <div>
            <div class="nl-contact-badges">
              <span class="nl-contact-label">Engagement Brief</span>
              <span class="nl-contact-active">[ Active Intake ]</span>
            </div>
            <h2>Let's talk about what's slowing you down</h2>
            <p class="nl-contact-desc">Every conversation begins with an unhurried, confidential 30-minute review of your current workflow friction. No high-pressure sales cadence. Just an honest evaluation of whether we are the right fit for your team.</p>
            <div class="nl-what-to-expect">
              <span class="nl-expect-label">What to Expect</span>
              <ul class="nl-expect-list">
                <li>
                  <span class="nl-expect-num">01</span>
                  <span>Direct diagnostic review with our principal operator.</span>
                </li>
                <li>
                  <span class="nl-expect-num">02</span>
                  <span>Strict confidentiality under standard NDA terms.</span>
                </li>
                <li>
                  <span class="nl-expect-num">03</span>
                  <span>Clear go/no-go recommendation within 48 hours.</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="nl-direct-contact">
            <span class="nl-direct-label">Direct Protocol:</span>
            <span class="nl-direct-info">0161 496 0123 · hello@northline.demo</span>
          </div>
        </div>
        <div class="nl-contact-right">
          <form class="nl-form" id="nl-discovery-form">
            <div class="nl-form-row">
              <div class="nl-field">
                <label for="nl-name">Full Name <span class="nl-req">*</span></label>
                <input type="text" id="nl-name" name="name" placeholder="e.g. Alistair Finch" required>
              </div>
              <div class="nl-field">
                <label for="nl-email">Work Email <span class="nl-req">*</span></label>
                <input type="email" id="nl-email" name="email" placeholder="a.finch@company.co.uk" required>
              </div>
            </div>
            <div class="nl-form-row">
              <div class="nl-field">
                <label for="nl-company">Company <span class="nl-req">*</span></label>
                <input type="text" id="nl-company" name="company" placeholder="e.g. Finch Logistics Ltd" required>
              </div>
              <div class="nl-field">
                <label for="nl-size">Company Size</label>
                <select id="nl-size" name="size">
                  <option value="1 to 19">1 to 19</option>
                  <option value="20 to 49" selected>20 to 49</option>
                  <option value="50 to 199">50 to 199</option>
                  <option value="200+">200+</option>
                </select>
              </div>
            </div>
            <div class="nl-field">
              <label for="nl-challenge">Primary Operational Friction</label>
              <select id="nl-challenge" name="challenge">
                <option value="Process">Process (handoffs, broken workflows, manual gaps)</option>
                <option value="Team structure">Team structure (decision bottlenecks, role confusion)</option>
                <option value="Tools">Tools (disconnected software, spreadsheet overload)</option>
                <option value="Not sure yet">Not sure yet (general friction or scaling ceiling)</option>
              </select>
            </div>
            <div class="nl-field">
              <label for="nl-message">Describe the bottleneck briefly</label>
              <textarea id="nl-message" name="message" rows="4" placeholder="Where do handoffs fail today? What happens when you or key staff take time away?"></textarea>
            </div>
            <div class="nl-form-submit">
              <button type="submit" class="nl-btn-primary">Request a Call</button>
              <span class="nl-submit-promise">Response Promise: Within 24 Hours</span>
            </div>
          </form>
          <div class="nl-form-success" id="nl-form-success">
            <div>
              <div class="nl-success-badges">
                <span class="nl-success-confirmed">[ Transmission Confirmed ]</span>
                <span class="nl-success-ref">Ref: NL-INTAKE-OK</span>
              </div>
              <h3>Transmission Received</h3>
              <p>Thanks. We'll reply within one working day to arrange a 30-minute call.</p>
              <p class="nl-success-note">We review every brief internally before proposing times to ensure your initial 30 minutes are spent productively.</p>
            </div>
            <button class="nl-success-reset" id="nl-form-reset" type="button">Submit another inquiry →</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;
}

function nl_html_footer() {
	return <<<'HTML'
<footer class="nl-footer">
  <div class="nl-wrap nl-wrap-pad">
    <div class="nl-footer-grid">
      <div class="nl-footer-brand">
        <div>
          <a class="nl-footer-logo" href="#">Northline</a>
          <p class="nl-footer-tagline">Operations Consultancy · Manchester, UK</p>
        </div>
        <div class="nl-footer-copy">© 2024 Northline Operations. All rights reserved.</div>
      </div>
      <div class="nl-footer-col">
        <h4>Inquiries &amp; Studio</h4>
        <p><span>Phone</span> 0161 496 0123</p>
        <p><span>Email</span> hello@northline.demo</p>
        <p><span>Location</span> Manchester, UK</p>
      </div>
      <div class="nl-footer-col">
        <h4>Network</h4>
        <ul>
          <li><a href="#" class="nl-footer-underline">LinkedIn</a></li>
          <li><a href="#contact">Operations Audit Protocol</a></li>
          <li><a href="#work">Selected Client Dossiers</a></li>
        </ul>
      </div>
    </div>
    <div class="nl-footer-bottom">
      <p>Concept project. Brand, people, prices and reviews are fictional.</p>
      <span>MCR · Archival Ref 0161</span>
    </div>
  </div>
</footer>
HTML;
}
