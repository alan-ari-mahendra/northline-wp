<?php
/**
 * Northline – Native Elements Rebuild v2
 * Rebuilds _elementor_data with native heading/text-editor/image/button widgets.
 * Also fixes nl_setup_v1 option so assets load correctly.
 *
 * Access: http://northline-wp.local/northline-native2.php?token=northline2024
 */

if ( ! isset( $_GET['token'] ) || $_GET['token'] !== 'northline2024' ) {
	http_response_code( 403 );
	die( 'Access denied.' );
}

require_once dirname( __FILE__ ) . '/wp-load.php';

// ============================================================
// HELPERS
// ============================================================

function nlid( $name ) {
	return substr( md5( 'nl3-' . $name ), 0, 7 );
}

function nl_ct( $name, $css, $extra, $children ) {
	return [
		'id'       => nlid( $name ),
		'elType'   => 'container',
		'isInner'  => false,
		'settings' => array_merge( [
			'_title'        => $name,
			'flex_direction' => 'column',
			'content_width'  => 'full',
			'_css_classes'   => $css,
			'padding'        => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
		], $extra ),
		'elements' => $children,
	];
}

function nl_h( $name, $text, $tag, $extra = [] ) {
	return [
		'id'         => nlid( $name ),
		'elType'     => 'widget',
		'widgetType' => 'heading',
		'isInner'    => false,
		'settings'   => array_merge( [ 'title' => $text, 'header_size' => $tag ], $extra ),
		'elements'   => [],
	];
}

function nl_te( $name, $html, $extra = [] ) {
	return [
		'id'         => nlid( $name ),
		'elType'     => 'widget',
		'widgetType' => 'text-editor',
		'isInner'    => false,
		'settings'   => array_merge( [ 'editor' => $html ], $extra ),
		'elements'   => [],
	];
}

function nl_btn( $name, $text, $url, $extra = [] ) {
	return [
		'id'         => nlid( $name ),
		'elType'     => 'widget',
		'widgetType' => 'button',
		'isInner'    => false,
		'settings'   => array_merge( [
			'text'                     => $text,
			'link'                     => [ 'url' => $url, 'is_external' => false, 'nofollow' => false ],
			'background_color'         => '#14213d',
			'button_text_color'        => '#ffffff',
			'hover_background_color'   => '#000a24',
			'hover_color'              => '#ffffff',
			'border_border'            => 'none',
			'border_radius'            => [ 'unit' => 'px', 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'isLinked' => true ],
			'typography_typography'    => 'custom',
			'typography_font_family'   => 'DM Sans',
			'typography_font_weight'   => '500',
			'typography_font_size'     => [ 'unit' => 'px', 'size' => 11 ],
			'typography_letter_spacing' => [ 'unit' => 'em', 'size' => 0.08 ],
			'typography_text_transform' => 'uppercase',
			'padding'                  => [ 'unit' => 'px', 'top' => 16, 'right' => 40, 'bottom' => 16, 'left' => 40, 'isLinked' => false ],
		], $extra ),
		'elements'   => [],
	];
}

function nl_html( $name, $html ) {
	return [
		'id'         => nlid( $name ),
		'elType'     => 'widget',
		'widgetType' => 'html',
		'isInner'    => false,
		'settings'   => [ 'html' => $html ],
		'elements'   => [],
	];
}

// ============================================================
// SECTION BUILDERS
// ============================================================

// 1. HEADER
function nl_s_header() {
	return nl_ct( 's-header', '', [], [
		nl_html( 'w-header', '<header class="nl-header">
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
      <div class="nl-avatar"><span class="material-symbols-outlined">person</span></div>
    </div>
  </div>
</header>
<div class="nl-header-spacer"></div>' ),
	] );
}

// 2. HERO
function nl_s_hero() {
	return nl_ct( 's-hero', 'nl-hero', [], [
		nl_ct( 's-hero-wrap', 'nl-wrap', [], [
			nl_ct( 's-hero-grid', 'nl-hero-grid', [], [

				// Left column
				nl_ct( 's-hero-left', 'nl-hero-left', [], [
					nl_html( 'w-hero-eyebrow', '<span class="nl-eyebrow">Operational Diagnostics &amp; Workflow Realignment</span>' ),
					nl_h( 'w-hero-h1', 'Your business grew. Your operations didn&#8217;t.', 'h1', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 56 ],
						'typography_line_height'    => [ 'unit' => 'em', 'size' => 1.14 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.02 ],
					] ),
					nl_te( 'w-hero-body', '<p>We fix the handoffs, processes, and tools that slow growing UK companies down — cleanly and without six-month advisory programmes.</p>', [
						'_css_classes'              => 'nl-hero-body',
						'text_color'                => '#45464d',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'DM Sans',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 18 ],
						'typography_line_height'    => [ 'unit' => 'px', 'size' => 28 ],
					] ),
					nl_ct( 's-hero-cta', 'nl-cta-row', [ 'flex_direction' => 'row', 'flex_wrap' => 'wrap' ], [
						nl_btn( 'w-hero-btn', 'Book a Discovery Call', '#contact' ),
						nl_html( 'w-hero-link', '<a class="nl-link-arrow" href="#approach"><span>See how we work</span><span class="material-symbols-outlined">arrow_forward</span></a>' ),
					] ),
				] ),

				// Right column
				nl_ct( 's-hero-right', 'nl-hero-right', [], [
					nl_html( 'w-hero-photo', '<div class="nl-photo-frame">
  <div class="nl-photo-box">
    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCa7lkh5E9R6c9NEfAIPR-31Mq-QsLUxoEmCtkS_QSHZYkp-pWcXQbAMoFTHnuJdFPc1yhRh8702Dsjff8htXW25204FwCE-DKkuUdbofwnuVXQga6V6pzs_FKtJf266IMejNtFEJbRgjlztEc_tiuqIK8-7YY4riLg-G59LLdqwK2c3F4UOHLKF1h_X_MWMem-OCt0ZM9DuzemF0AV7REZTyFTn9Mg10dWrJBPd6XY" alt="Manchester office">
    <div class="nl-photo-caption">LOC: Manchester · Studio Desk</div>
  </div>
  <div class="nl-photo-meta">
    <span>Fig 1.0 — Field Observations</span>
    <span>Unvarnished Diagnosis</span>
  </div>
</div>' ),
				] ),

			] ),
		] ),
	] );
}

// 3. SOUND FAMILIAR
function nl_s_familiar() {
	return nl_ct( 's-familiar', 'nl-familiar', [ 'custom_css' => '#wrapper_familiar { scroll-margin-top: 80px; }', '_element_id' => 'familiar' ], [
		nl_ct( 's-fam-wrap', 'nl-wrap', [], [

			nl_ct( 's-fam-header', 'nl-section-header', [], [
				nl_ct( 's-fam-header-left', 'nl-section-header-left', [], [
					nl_html( 'w-fam-eyebrow', '<span class="nl-eyebrow">Common Bottlenecks</span>' ),
					nl_h( 'w-fam-h2', 'Sound familiar?', 'h2', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 40 ],
						'typography_line_height'    => [ 'unit' => 'em', 'size' => 1.2 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.015 ],
					] ),
				] ),
				nl_te( 'w-fam-desc', '<p>Friction outpaces revenue as teams expand. Most leadership teams encounter the exact same structural ceilings.</p>', [
					'text_color'            => '#45464d',
					'typography_font_family' => 'DM Sans',
					'typography_font_size'   => [ 'unit' => 'px', 'size' => 13 ],
				] ),
			] ),

			nl_ct( 's-fam-cards', 'nl-cards-3', [], [

				nl_ct( 's-fam-card1', 'nl-card', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-fam-c1-hdr', '<div class="nl-card-header"><span class="nl-numeral">01</span><span class="nl-tag">Bottleneck</span></div>' ),
					nl_h( 'w-fam-c1-h3', 'Everything goes through you.', 'h3' ),
					nl_te( 'w-fam-c1-p', '<p>Decisions wait on key founders. When leadership steps away, progress stalls.</p>' ),
					nl_html( 'w-fam-c1-ftr', '<div class="nl-card-footer"><span class="nl-status">[ Dependency Ratio: High ]</span></div>' ),
				] ),

				nl_ct( 's-fam-card2', 'nl-card', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-fam-c2-hdr', '<div class="nl-card-header"><span class="nl-numeral">02</span><span class="nl-tag">Alignment</span></div>' ),
					nl_h( 'w-fam-c2-h3', 'Work falls between teams.', 'h3' ),
					nl_te( 'w-fam-c2-p', '<p>Sales promises, operations scrambles, and handoffs create invisible chasms.</p>' ),
					nl_html( 'w-fam-c2-ftr', '<div class="nl-card-footer"><span class="nl-status">[ Friction: Interdepartmental ]</span></div>' ),
				] ),

				nl_ct( 's-fam-card3', 'nl-card', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-fam-c3-hdr', '<div class="nl-card-header"><span class="nl-numeral">03</span><span class="nl-tag">Fragmentation</span></div>' ),
					nl_h( 'w-fam-c3-h3', 'Your tools don&#8217;t talk.', 'h3' ),
					nl_te( 'w-fam-c3-p', '<p>Spreadsheets and siloed systems force teams to cross-check data all week.</p>' ),
					nl_html( 'w-fam-c3-ftr', '<div class="nl-card-footer"><span class="nl-status">[ Integration Loss: Critical ]</span></div>' ),
				] ),

			] ),
		] ),
	] );
}

// 4. SERVICES
function nl_s_services() {
	return nl_ct( 's-services', 'nl-services', [ '_element_id' => 'services' ], [
		nl_ct( 's-svc-wrap', 'nl-wrap', [], [

			nl_ct( 's-svc-header', 'nl-services-header', [], [
				nl_ct( 's-svc-header-left', '', [], [
					nl_html( 'w-svc-eyebrow', '<span class="nl-eyebrow">Core Capabilities</span>' ),
					nl_h( 'w-svc-h2', 'Services', 'h2', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 40 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.015 ],
					] ),
				] ),
				nl_te( 'w-svc-desc', '<p>Focused operational interventions. We build autonomy rather than perpetual retainers.</p>', [
					'text_color'             => '#45464d',
					'typography_font_family' => 'DM Sans',
					'typography_font_size'   => [ 'unit' => 'px', 'size' => 18 ],
				] ),
			] ),

			nl_ct( 's-svc-cards', 'nl-cards-3', [], [

				nl_ct( 's-svc-card1', 'nl-service-card', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-svc-c1-lbl', '<span class="nl-service-label">01 · Diagnostic Review</span>' ),
					nl_h( 'w-svc-c1-h3', 'Operations Audit', 'h3', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 28 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.01 ],
					] ),
					nl_te( 'w-svc-c1-p', '<p>A two-week diagnostic shadowing live workflows to identify and catalog operational drag.</p>', [
						'text_color'            => '#45464d',
						'typography_font_size'  => [ 'unit' => 'px', 'size' => 15 ],
					] ),
					nl_html( 'w-svc-c1-ftr', '<div class="nl-service-footer"><a class="nl-link-ne" href="#contact"><span>Explore the Operations Audit</span><span class="material-symbols-outlined">north_east</span></a></div>' ),
				] ),

				nl_ct( 's-svc-card2', 'nl-service-card', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-svc-c2-lbl', '<span class="nl-service-label">02 · Architecture</span>' ),
					nl_h( 'w-svc-c2-h3', 'Process Redesign', 'h3', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 28 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.01 ],
					] ),
					nl_te( 'w-svc-c2-p', '<p>Clear handoffs and single-owner accountability frameworks your team actually adopts.</p>', [
						'text_color'           => '#45464d',
						'typography_font_size' => [ 'unit' => 'px', 'size' => 15 ],
					] ),
					nl_html( 'w-svc-c2-ftr', '<div class="nl-service-footer"><span class="nl-service-meta">Cadence · 4 to 6 Weeks</span></div>' ),
				] ),

				nl_ct( 's-svc-card3', 'nl-service-card', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-svc-c3-lbl', '<span class="nl-service-label">03 · Infrastructure</span>' ),
					nl_h( 'w-svc-c3-h3', 'Systems and Tooling', 'h3', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 28 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.01 ],
					] ),
					nl_te( 'w-svc-c3-p', '<p>Eliminate software bloat and configure resilient integrations built around how you work.</p>', [
						'text_color'           => '#45464d',
						'typography_font_size' => [ 'unit' => 'px', 'size' => 15 ],
					] ),
					nl_html( 'w-svc-c3-ftr', '<div class="nl-service-footer"><span class="nl-service-meta">Scope · Stack Realignment</span></div>' ),
				] ),

			] ),
		] ),
	] );
}

// 5. APPROACH
function nl_s_approach() {
	return nl_ct( 's-approach', 'nl-approach', [ '_element_id' => 'approach' ], [
		nl_ct( 's-app-wrap', 'nl-wrap', [], [

			nl_ct( 's-app-intro', 'nl-approach-intro', [], [
				nl_html( 'w-app-eyebrow', '<span class="nl-eyebrow">Methodology</span>' ),
				nl_h( 'w-app-h2', 'Our approach', 'h2', [
					'title_color'               => '#000a24',
					'typography_typography'     => 'custom',
					'typography_font_family'    => 'Newsreader',
					'typography_font_weight'    => '400',
					'typography_font_size'      => [ 'unit' => 'px', 'size' => 40 ],
					'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.015 ],
				] ),
				nl_te( 'w-app-p', '<p>A four-stage methodology calibrated to minimize organizational fatigue while driving structural clarity.</p>', [
					'text_color'           => '#45464d',
					'typography_font_size' => [ 'unit' => 'px', 'size' => 15 ],
				] ),
			] ),

			nl_ct( 's-app-steps', 'nl-steps', [], [

				nl_ct( 's-app-step1', 'nl-step', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-app-s1-hdr', '<div class="nl-step-header"><span class="nl-step-num">01</span><span class="nl-step-label">Discovery</span></div>' ),
					nl_h( 'w-app-s1-h3', 'Listen', 'h3' ),
					nl_te( 'w-app-s1-p', '<p>Direct, confidential interviews to identify hidden workflow blockers.</p>' ),
					nl_html( 'w-app-s1-sts', '<span class="nl-step-status">All Teams Audited</span>' ),
				] ),

				nl_ct( 's-app-step2', 'nl-step', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-app-s2-hdr', '<div class="nl-step-header"><span class="nl-step-num">02</span><span class="nl-step-label">Mapping</span></div>' ),
					nl_h( 'w-app-s2-h3', 'Map', 'h3' ),
					nl_te( 'w-app-s2-p', '<p>Documenting how daily work actually moves across informal channels.</p>' ),
					nl_html( 'w-app-s2-sts', '<span class="nl-step-status">As-Is Blueprint</span>' ),
				] ),

				nl_ct( 's-app-step3', 'nl-step', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-app-s3-hdr', '<div class="nl-step-header"><span class="nl-step-num">03</span><span class="nl-step-label">Synthesis</span></div>' ),
					nl_h( 'w-app-s3-h3', 'Redesign', 'h3' ),
					nl_te( 'w-app-s3-p', '<p>Targeting the high-leverage fixes instead of 100-page roadmaps.</p>' ),
					nl_html( 'w-app-s3-sts', '<span class="nl-step-status">High-Leverage Focus</span>' ),
				] ),

				nl_ct( 's-app-step4', 'nl-step', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-app-s4-hdr', '<div class="nl-step-header"><span class="nl-step-num">04</span><span class="nl-step-label">Retention</span></div>' ),
					nl_h( 'w-app-s4-h3', 'Embed', 'h3' ),
					nl_te( 'w-app-s4-p', '<p>Training, documentation, and check-ins to make habits stick.</p>' ),
					nl_html( 'w-app-s4-sts', '<span class="nl-step-status">Long-Term Adoption</span>' ),
				] ),

			] ),
		] ),
	] );
}

// 6. SELECTED WORK
function nl_s_work() {
	return nl_ct( 's-work', 'nl-work', [ '_element_id' => 'work' ], [
		nl_ct( 's-wrk-wrap', 'nl-wrap', [], [

			nl_ct( 's-wrk-header', 'nl-work-header', [], [
				nl_ct( 's-wrk-hdr-left', '', [], [
					nl_html( 'w-wrk-eyebrow', '<span class="nl-eyebrow">Dossiers</span>' ),
					nl_h( 'w-wrk-h2', 'Selected work', 'h2', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 40 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.015 ],
					] ),
				] ),
				nl_html( 'w-wrk-anon', '<span class="nl-work-anon">Anonymized Engagements</span>' ),
			] ),

			nl_ct( 's-wrk-cases', 'nl-cases', [], [

				nl_ct( 's-wrk-case1', 'nl-case', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-wrk-c1-top', '<div class="nl-case-top"><span class="nl-case-badge">Concept case study</span><span class="nl-case-num">Case // 041</span></div>' ),
					nl_h( 'w-wrk-c1-h3', 'Regional logistics firm', 'h3', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 28 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.01 ],
					] ),
					nl_html( 'w-wrk-c1-img', '<div class="nl-case-img"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxkUu9ghoEYCM-2YVCkB8iCYXn2MQxsDzPS04fFlUPY68AePPojXvr9L-3QudT6y6aTfusYlzHGG35kbtNT0SZjkXoxe9ZNM1mfpXxgagpvHHvyRDM1xpi2_S-Qsu4CTliUQMFcjoRxlccUs1g_4W3m_YlyWhuOVif9u7I6tjtPwMX5i0lbuZf2GbSt03KrNIbJSGkcPQV6a_6esVgoDF40tQgc9knsufsh2uny158" alt="warehouse operations"></div>' ),
					nl_te( 'w-wrk-c1-p', '<p>Reworked order-to-dispatch handoffs between sales and the warehouse team, with one shared tracking board replacing four spreadsheets.</p>', [
						'text_color'           => '#45464d',
						'typography_font_size' => [ 'unit' => 'px', 'size' => 15 ],
					] ),
					nl_html( 'w-wrk-c1-ftr', '<div class="nl-case-foot"><span class="nl-case-sector">Sector: Supply Chain · MCR</span><span class="nl-case-type">Dispatch Restructuring</span></div>' ),
				] ),

				nl_ct( 's-wrk-case2', 'nl-case', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-wrk-c2-top', '<div class="nl-case-top"><span class="nl-case-badge">Concept case study</span><span class="nl-case-num">Case // 042</span></div>' ),
					nl_h( 'w-wrk-c2-h3', 'Family-run manufacturer', 'h3', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 28 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.01 ],
					] ),
					nl_html( 'w-wrk-c2-img', '<div class="nl-case-img"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHF4FKnDgTo1QtSuHED8FhXL50mYpy9LzgZHS0AQcHeiEyXYsIlNJhx-geSgdbdARtovYv79u_PMWATZTnHwh3qJObyPGL2Dp5-ac1JpDq_mmz7kUeuA0UdeZ9F_5nFrFBYThmk5lNbCA6rjMSDq_44NR_PGIvEnXpcsaajomKzD0hcjsdJxjjXpqZZmqw66GaWT8r-9PqziIRpTOq68v4o1TmUpZvRz5IXhs6OOe8" alt="team workshop office"></div>' ),
					nl_te( 'w-wrk-c2-p', '<p>Created a weekly operating rhythm and clear decision owners so the founders could step back from day-to-day approvals.</p>', [
						'text_color'           => '#45464d',
						'typography_font_size' => [ 'unit' => 'px', 'size' => 15 ],
					] ),
					nl_html( 'w-wrk-c2-ftr', '<div class="nl-case-foot"><span class="nl-case-sector">Sector: Precision Engineering · Cheshire</span><span class="nl-case-type">Governance &amp; Delegation</span></div>' ),
				] ),

			] ),
		] ),
	] );
}

// 7. ABOUT
function nl_s_about() {
	return nl_ct( 's-about', 'nl-about', [ '_element_id' => 'about' ], [
		nl_ct( 's-abt-wrap', 'nl-wrap', [], [
			nl_ct( 's-abt-grid', 'nl-about-grid', [], [

				// Left photo column
				nl_ct( 's-abt-photo', 'nl-about-photo', [], [
					nl_html( 'w-abt-photo', '<div class="nl-about-photo-box">
  <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCebdvuJPKzNBxaXYRapIQd_Zo5hnl4x2435tfArr38rXwhRGzi9nL8UH72A1vYRX3NyK-8tbYQQzVR0fegzyaEACk-yOQsqjM4IPipTNRm2xuoor5baIfzNeoBMmA1GtkMOFg8uXRMxeivnUoKNmlwOAKf5Al_iSyKAa2JQ0CzvF7mNQ8HIHqL6VkzLTBfJqtcPbLaefkDQPN-WEO9xuYYurDCgxeRCTwBCQWbKfCx" alt="Founder — lead practitioner">
  <div class="nl-photo-caption">Founder · Lead Practitioner</div>
</div>' ),
				] ),

				// Right column
				nl_ct( 's-abt-right', 'nl-about-right', [], [
					nl_html( 'w-abt-eyebrow', '<span class="nl-eyebrow">Perspective</span>' ),
					nl_h( 'w-abt-h2', 'Practitioners, not career theorists.', 'h2', [
						'title_color'               => '#000a24',
						'typography_typography'     => 'custom',
						'typography_font_family'    => 'Newsreader',
						'typography_font_weight'    => '400',
						'typography_font_size'      => [ 'unit' => 'px', 'size' => 40 ],
						'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.015 ],
					] ),
					nl_ct( 's-abt-quote', 'nl-pullquote', [], [
						nl_te( 'w-abt-quote', '<p>&#8220;We work with a small number of clients at a time, led directly by operators who stay until changes stick.&#8221;</p>', [
							'text_color'               => '#000a24',
							'typography_typography'    => 'custom',
							'typography_font_family'   => 'Newsreader',
							'typography_font_weight'   => '400',
							'typography_font_size'     => [ 'unit' => 'px', 'size' => 22 ],
							'typography_line_height'   => [ 'unit' => 'px', 'size' => 30 ],
						] ),
					] ),
					nl_te( 'w-abt-body', '<p>The healthiest businesses operate on fewer dashboards, simpler rules, and direct personal accountability.</p>', [
						'_css_classes'             => 'nl-about-body',
						'text_color'               => '#45464d',
						'typography_typography'    => 'custom',
						'typography_font_family'   => 'DM Sans',
						'typography_font_size'     => [ 'unit' => 'px', 'size' => 18 ],
						'typography_line_height'   => [ 'unit' => 'px', 'size' => 28 ],
					] ),
				] ),

			] ),
		] ),
	] );
}

// 8. CONTACT
function nl_s_contact() {
	$form_html = '<form class="nl-form" id="nl-discovery-form">
  <div class="nl-form-row">
    <div class="nl-field"><label for="nl-name">Full Name <span class="nl-req">*</span></label><input type="text" id="nl-name" name="name" placeholder="e.g. Alistair Finch" required></div>
    <div class="nl-field"><label for="nl-email">Work Email <span class="nl-req">*</span></label><input type="email" id="nl-email" name="email" placeholder="a.finch@company.co.uk" required></div>
  </div>
  <div class="nl-form-row">
    <div class="nl-field"><label for="nl-company">Company <span class="nl-req">*</span></label><input type="text" id="nl-company" name="company" placeholder="e.g. Finch Logistics Ltd" required></div>
    <div class="nl-field"><label for="nl-size">Company Size</label><select id="nl-size" name="size"><option value="1 to 19">1 to 19</option><option value="20 to 49" selected>20 to 49</option><option value="50 to 199">50 to 199</option><option value="200+">200+</option></select></div>
  </div>
  <div class="nl-field"><label for="nl-challenge">Primary Operational Friction</label><select id="nl-challenge" name="challenge"><option value="Process">Process (handoffs, broken workflows, manual gaps)</option><option value="Team structure">Team structure (decision bottlenecks, role confusion)</option><option value="Tools">Tools (disconnected software, spreadsheet overload)</option><option value="Not sure yet">Not sure yet (general friction or scaling ceiling)</option></select></div>
  <div class="nl-field"><label for="nl-message">Describe the bottleneck briefly</label><textarea id="nl-message" name="message" rows="4" placeholder="Where do handoffs fail today?"></textarea></div>
  <div class="nl-form-submit">
    <button type="submit" class="nl-btn-primary">Request a Call</button>
    <span class="nl-submit-promise">Response Promise: Within 24 Hours</span>
  </div>
</form>
<div class="nl-form-success" id="nl-form-success">
  <div>
    <div class="nl-success-badges"><span class="nl-success-confirmed">[ Transmission Confirmed ]</span><span class="nl-success-ref">Ref: NL-INTAKE-OK</span></div>
    <h3>Transmission Received</h3>
    <p>Thanks. We\'ll reply within one working day to arrange a 30-minute call.</p>
  </div>
  <button class="nl-success-reset" id="nl-form-reset" type="button">Submit another inquiry &rarr;</button>
</div>';

	$expect_html = '<div class="nl-what-to-expect">
  <span class="nl-expect-label">What to Expect</span>
  <ul class="nl-expect-list">
    <li><span class="nl-expect-num">01</span><span>Direct diagnostic review with our principal operator.</span></li>
    <li><span class="nl-expect-num">02</span><span>Strict confidentiality under standard NDA terms.</span></li>
    <li><span class="nl-expect-num">03</span><span>Clear go/no-go recommendation within 48 hours.</span></li>
  </ul>
  <div class="nl-direct-contact">
    <span class="nl-direct-label">Direct Protocol:</span>
    <span class="nl-direct-info">0161 496 0123 · hello@northline.demo</span>
  </div>
</div>';

	return nl_ct( 's-contact', 'nl-contact', [ '_element_id' => 'contact' ], [
		nl_ct( 's-cnt-wrap', 'nl-wrap', [], [
			nl_ct( 's-cnt-inner', 'nl-contact-inner', [], [
				nl_ct( 's-cnt-grid', 'nl-contact-grid', [], [

					// Left
					nl_ct( 's-cnt-left', 'nl-contact-left', [ 'justify_content' => 'space-between' ], [
						nl_html( 'w-cnt-badges', '<div class="nl-contact-badges"><span class="nl-contact-label">Engagement Brief</span><span class="nl-contact-active">[ Active Intake ]</span></div>' ),
						nl_h( 'w-cnt-h2', 'Let&#8217;s talk about what&#8217;s slowing you down', 'h2', [
							'title_color'               => '#000a24',
							'typography_typography'     => 'custom',
							'typography_font_family'    => 'Newsreader',
							'typography_font_weight'    => '400',
							'typography_font_size'      => [ 'unit' => 'px', 'size' => 40 ],
							'typography_letter_spacing' => [ 'unit' => 'em', 'size' => -0.015 ],
						] ),
						nl_te( 'w-cnt-desc', '<p>Every conversation begins with an unhurried, confidential 30-minute review of your current workflow friction. No high-pressure sales cadence. Just an honest evaluation of whether we are the right fit for your team.</p>', [
							'_css_classes'         => 'nl-contact-desc',
							'text_color'           => '#45464d',
							'typography_font_size' => [ 'unit' => 'px', 'size' => 15 ],
						] ),
						nl_html( 'w-cnt-expect', $expect_html ),
					] ),

					// Right (form)
					nl_ct( 's-cnt-right', 'nl-contact-right', [], [
						nl_html( 'w-cnt-form', $form_html ),
					] ),

				] ),
			] ),
		] ),
	] );
}

// 9. FOOTER
function nl_s_footer() {
	$brand_html = '<div>
  <a class="nl-footer-logo" href="#">Northline</a>
  <p class="nl-footer-tagline">Operations Consultancy · Manchester, UK</p>
</div>
<div class="nl-footer-copy">&copy; 2024 Northline Operations. All rights reserved.</div>';

	$inquiries_html = '<h4>Inquiries &amp; Studio</h4>
<p><span>Phone</span> 0161 496 0123</p>
<p><span>Email</span> hello@northline.demo</p>
<p><span>Location</span> Manchester, UK</p>';

	$network_html = '<h4>Network</h4>
<ul>
  <li><a href="#" class="nl-footer-underline">LinkedIn</a></li>
  <li><a href="#contact">Operations Audit Protocol</a></li>
  <li><a href="#work">Selected Client Dossiers</a></li>
</ul>';

	$bottom_html = '<div class="nl-footer-bottom">
  <p>Concept project. Brand, people, prices and reviews are fictional.</p>
  <span>MCR &middot; Archival Ref 0161</span>
</div>';

	return nl_ct( 's-footer', 'nl-footer', [], [
		nl_ct( 's-ftr-wrap', 'nl-wrap nl-wrap-pad', [], [
			nl_ct( 's-ftr-grid', 'nl-footer-grid', [ 'flex_direction' => 'row', 'flex_wrap' => 'wrap' ], [
				nl_ct( 's-ftr-brand', 'nl-footer-brand', [ 'justify_content' => 'space-between' ], [
					nl_html( 'w-ftr-brand', $brand_html ),
				] ),
				nl_ct( 's-ftr-col1', 'nl-footer-col', [], [
					nl_html( 'w-ftr-inquiries', $inquiries_html ),
				] ),
				nl_ct( 's-ftr-col2', 'nl-footer-col', [], [
					nl_html( 'w-ftr-network', $network_html ),
				] ),
			] ),
			nl_html( 'w-ftr-bottom', $bottom_html ),
		] ),
	] );
}

// ============================================================
// BUILD FULL PAGE DATA
// ============================================================

function nl_build_data() {
	return [
		nl_s_header(),
		nl_s_hero(),
		nl_s_familiar(),
		nl_s_services(),
		nl_s_approach(),
		nl_s_work(),
		nl_s_about(),
		nl_s_contact(),
		nl_s_footer(),
	];
}

// ============================================================
// EXECUTE
// ============================================================

$log     = [];
$page_id = (int) get_option( 'page_on_front' );

if ( ! $page_id ) {
	$pages = get_posts( [
		'post_type'   => 'page',
		'post_status' => 'any',
		'title'       => 'Northline Operations',
		'numberposts' => 1,
	] );
	if ( $pages ) {
		$page_id = (int) $pages[0]->ID;
		$log[]   = "Found page by title: #{$page_id}";
	}
}

if ( ! $page_id ) {
	$page = get_page_by_path( 'northline' );
	if ( $page ) {
		$page_id = (int) $page->ID;
		$log[]   = "Found page by path 'northline': #{$page_id}";
	}
}

if ( ! $page_id ) {
	$log[] = '<strong style="color:red;">ERROR: Could not find front page. Run northline-setup first.</strong>';
} else {

	// Fix nl_setup_v1 so mu-plugin loads CSS/JS
	update_option( 'nl_setup_v1', $page_id );
	$log[] = "Set nl_setup_v1 = {$page_id}";

	// Ensure front page settings
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_id );
	$log[] = "Front page confirmed: show_on_front=page, page_on_front={$page_id}";

	// Build Elementor data
	$data     = nl_build_data();
	$json     = wp_json_encode( $data );
	$slashed  = wp_slash( $json );

	// Verify JSON is valid before writing
	$decoded = json_decode( $json );
	if ( $decoded === null ) {
		$log[] = '<strong style="color:red;">ERROR: JSON encoding failed — ' . json_last_error_msg() . '</strong>';
	} else {

		// Write to post meta
		update_post_meta( $page_id, '_elementor_data',          $slashed );
		update_post_meta( $page_id, '_elementor_edit_mode',     'builder' );
		update_post_meta( $page_id, '_wp_page_template',        'elementor_canvas' );
		update_post_meta( $page_id, '_elementor_template_type', 'page' );

		$page_settings = get_post_meta( $page_id, '_elementor_page_settings', true );
		if ( ! is_array( $page_settings ) ) {
			update_post_meta( $page_id, '_elementor_page_settings', [] );
		}

		$json_len = strlen( $json );
		$log[]    = "Elementor data written: {$json_len} bytes, " . count( $data ) . " root sections";

		// Count widget types
		$counts = [ 'heading' => 0, 'text-editor' => 0, 'button' => 0, 'image' => 0, 'html' => 0, 'container' => 0 ];
		nl_count_widgets( $data, $counts );
		$native  = $counts['heading'] + $counts['text-editor'] + $counts['button'] + $counts['image'];
		$log[]   = "Native widgets: heading={$counts['heading']}, text-editor={$counts['text-editor']}, button={$counts['button']}, image={$counts['image']}";
		$log[]   = "HTML widgets: {$counts['html']} | Containers: {$counts['container']} | Total native: {$native}";

		// Clear Elementor CSS cache
		$uploads   = wp_upload_dir();
		$cache_dir = $uploads['basedir'] . '/elementor/css/';
		$deleted   = 0;
		if ( is_dir( $cache_dir ) ) {
			foreach ( glob( $cache_dir . '*.css' ) as $f ) {
				unlink( $f );
				$deleted++;
			}
		}
		$log[] = "Deleted {$deleted} Elementor cached CSS files";

		if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
			\Elementor\Plugin::$instance->files_manager->clear_cache();
			$log[] = 'Elementor files_manager cache cleared';
		}

		clean_post_cache( $page_id );
		$log[] = 'Post cache cleared';
	}
}

function nl_count_widgets( $elements, &$counts ) {
	foreach ( $elements as $el ) {
		if ( $el['elType'] === 'container' ) {
			$counts['container']++;
		} elseif ( isset( $el['widgetType'] ) ) {
			$type = $el['widgetType'];
			if ( isset( $counts[ $type ] ) ) {
				$counts[ $type ]++;
			}
		}
		if ( ! empty( $el['elements'] ) ) {
			nl_count_widgets( $el['elements'], $counts );
		}
	}
}

?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Northline Native Rebuild v2</title>
<style>
body { font-family: system-ui, sans-serif; padding: 2rem; background: #f0f3ff; }
h1 { font-family: 'Newsreader', serif; color: #000a24; font-weight: 400; margin: 0 0 1.5rem; }
.log { background: #fff; border: 1px solid #c5c6ce; padding: 1.5rem; margin-bottom: 1.5rem; }
.log p { margin: .3rem 0; font-size: 14px; color: #006a60; font-family: monospace; }
.actions { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1.5rem; }
.btn { display: inline-block; background: #14213d; color: #fff; padding: .75rem 1.5rem; text-decoration: none; font-size: 11px; letter-spacing: .08em; text-transform: uppercase; font-family: 'DM Sans', sans-serif; }
.btn-secondary { background: #006a60; }
.note { font-size: 12px; color: #75777e; margin-top: 1rem; }
</style>
</head>
<body>
<h1>Northline Native Rebuild v2</h1>
<div class="log">
<?php foreach ( $log as $entry ) : ?>
  <p><?= $entry ?></p>
<?php endforeach; ?>
</div>
<div class="actions">
  <a class="btn" href="/">View Home Page &rarr;</a>
  <a class="btn btn-secondary" href="/northline-fix.php?token=northline2024">Run Fix (clear cache) &rarr;</a>
  <a class="btn btn-secondary" href="/northline-debug.php?token=northline2024">Debug Info &rarr;</a>
</div>
<p class="note">Native elements used: heading, text-editor, button widgets for content. HTML widgets retained for: header nav, photo frames with overlays, card/step header rows, icons, form, footer columns.</p>
</body>
</html>
