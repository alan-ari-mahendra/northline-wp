<?php
/**
 * Northline Landing Page – One-Time Setup Script
 *
 * Access: http://northline-wp.local/northline-setup.php?token=northline2024
 * DELETE THIS FILE after running!
 */

define( 'NORTHLINE_TOKEN', 'northline2024' );

if ( ! defined( 'ABSPATH' ) ) {
	require_once dirname( __FILE__ ) . '/wp-load.php';
}

$token_ok = isset( $_GET['token'] ) && $_GET['token'] === NORTHLINE_TOKEN;
$auth_ok  = function_exists( 'is_user_logged_in' ) && is_user_logged_in() && current_user_can( 'manage_options' );

if ( ! $token_ok && ! $auth_ok ) {
	die( '<p style="font-family:sans-serif;padding:2rem;">Access denied. Add <code>?token=' . NORTHLINE_TOKEN . '</code> to the URL.</p>' );
}

$log = [];

// ===========================================================================
// HTML SECTION DEFINITIONS
// ===========================================================================

$s_header = <<<'HTML'
<header class="fixed top-0 left-0 right-0 bg-[#FAFAF7] border-b border-outline-variant/30" style="z-index:99999;position:fixed;top:0;left:0;right:0;">
  <div class="max-w-[1280px] mx-auto px-gutter lg:px-margin-desktop h-20 flex items-center justify-between">
    <a class="flex items-baseline gap-space-sm" href="/">
      <span class="font-headline-sm text-headline-sm text-primary tracking-tight font-normal">Northline</span>
      <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline border-l border-outline-variant/60 pl-space-sm">Operations · Manchester</span>
    </a>
    <nav class="hidden xl:flex items-center gap-space-lg">
      <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="#services">Services</a>
      <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="#approach">Approach</a>
      <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="#work">Selected Work</a>
      <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="#about">About</a>
      <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="#">Operations Audit</a>
      <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-on-surface transition-colors" href="#contact">Contact</a>
    </nav>
    <div class="flex items-center gap-space-md">
      <a class="hidden sm:inline-flex items-center justify-center bg-primary-container text-surface-container-lowest font-label-editorial text-label-editorial uppercase tracking-widest px-space-lg py-space-sm hover:bg-primary transition-colors border border-primary-container" href="#contact">Book a Discovery Call</a>
      <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
        <span class="material-symbols-outlined text-on-primary" style="font-size:18px;">person</span>
      </div>
    </div>
  </div>
</header>
<div style="height:80px;"></div>
HTML;

$s_hero = <<<'HTML'
<section class="w-full bg-[#FAFAF7]">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop pt-space-xl lg:pt-space-2xl pb-space-3xl">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter lg:gap-gutter-desktop items-start">
      <!-- Left Narrative: 7 cols -->
      <div class="lg:col-span-7 flex flex-col justify-between pr-0 lg:pr-space-md">
        <div>
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-md">OPERATIONAL DIAGNOSTICS &amp; WORKFLOW REALIGNMENT</span>
          <h1 class="font-display-xl text-display-xl text-primary font-normal tracking-tight leading-none mb-space-lg max-w-xl">
            Your business grew. Your operations didn't.
          </h1>
          <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed mb-space-2xl">We fix the handoffs, processes, and tools that slow growing UK companies down — cleanly and without six-month advisory programmes.</p>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-space-lg pt-space-md">
          <a class="inline-flex items-center justify-center bg-primary-container text-surface-container-lowest font-label-editorial text-label-editorial uppercase tracking-widest px-space-xl py-space-md hover:bg-primary transition-colors" href="#contact">
            Book a Discovery Call
          </a>
          <a class="inline-flex items-center gap-space-xs font-body-sm text-body-sm text-primary hover:text-secondary group transition-colors" href="#approach">
            <span class="underline decoration-tertiary-fixed-dim underline-offset-8 group-hover:decoration-primary">See how we work</span>
            <span class="material-symbols-outlined text-primary transition-transform group-hover:translate-x-1" style="font-size:16px;">arrow_forward</span>
          </a>
        </div>
      </div>
      <!-- Right Editorial Photography Frame: 5 cols -->
      <div class="lg:col-span-5 mt-space-xl lg:mt-0 flex flex-col">
        <div class="bg-surface-container-lowest p-space-sm">
          <div class="relative w-full bg-surface-container overflow-hidden" style="aspect-ratio:4/5;">
            <img alt="Manchester office" class="w-full h-full object-cover grayscale contrast-[1.05]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCa7lkh5E9R6c9NEfAIPR-31Mq-QsLUxoEmCtkS_QSHZYkp-pWcXQbAMoFTHnuJdFPc1yhRh8702Dsjff8htXW25204FwCE-DKkuUdbofwnuVXQga6V6pzs_FKtJf266IMejNtFEJbRgjlztEc_tiuqIK8-7YY4riLg-G59LLdqwK2c3F4UOHLKF1h_X_MWMem-OCt0ZM9DuzemF0AV7REZTyFTn9Mg10dWrJBPd6XY">
            <div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 px-space-sm py-0.5">
              <span class="font-label-editorial text-label-editorial uppercase text-on-surface tracking-widest" style="font-size:10px;">LOC: MANCHESTER · STUDIO DESK</span>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between mt-space-sm text-on-surface-variant">
          <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline" style="font-size:10px;">FIG 1.0 — FIELD OBSERVATIONS</span>
          <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline" style="font-size:10px;">UNVARNISHED DIAGNOSIS</span>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;

$s_familiar = <<<'HTML'
<section class="w-full bg-surface-container-lowest py-space-3xl" id="services">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-2xl">
      <div>
        <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-xs">COMMON BOTTLENECKS</span>
        <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal">Sound familiar?</h2>
      </div>
      <p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm mt-space-sm md:mt-0">Friction outpaces revenue as teams expand. Most leadership teams encounter the exact same structural ceilings.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter lg:gap-gutter-desktop">
      <!-- Card 1 -->
      <div class="bg-surface p-space-xl flex flex-col justify-between" style="min-height:300px;">
        <div>
          <div class="flex items-center justify-between pb-space-md mb-space-lg">
            <span class="font-numeral-accent text-numeral-accent text-tertiary-fixed-dim">01</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">BOTTLENECK</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm leading-snug">
            Everything goes through you.
          </h3>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">Decisions wait on key founders. When leadership steps away, progress stalls.</p>
        </div>
        <div class="pt-space-lg mt-space-lg">
          <span class="font-label-editorial text-label-editorial text-secondary tracking-widest uppercase" style="font-size:10px;">[ DEPENDENCY RATIO: HIGH ]</span>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="bg-surface p-space-xl flex flex-col justify-between" style="min-height:300px;">
        <div>
          <div class="flex items-center justify-between pb-space-md mb-space-lg">
            <span class="font-numeral-accent text-numeral-accent text-tertiary-fixed-dim">02</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">ALIGNMENT</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm leading-snug">
            Work falls between teams.
          </h3>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">Sales promises, operations scrambles, and handoffs create invisible chasms.</p>
        </div>
        <div class="pt-space-lg mt-space-lg">
          <span class="font-label-editorial text-label-editorial text-secondary tracking-widest uppercase" style="font-size:10px;">[ FRICTION: INTERDEPARTMENTAL ]</span>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="bg-surface p-space-xl flex flex-col justify-between" style="min-height:300px;">
        <div>
          <div class="flex items-center justify-between pb-space-md mb-space-lg">
            <span class="font-numeral-accent text-numeral-accent text-tertiary-fixed-dim">03</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">FRAGMENTATION</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm leading-snug">
            Your tools don't talk.
          </h3>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">Spreadsheets and siloed systems force teams to cross-check data all week.</p>
        </div>
        <div class="pt-space-lg mt-space-lg">
          <span class="font-label-editorial text-label-editorial text-secondary tracking-widest uppercase" style="font-size:10px;">[ INTEGRATION LOSS: CRITICAL ]</span>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;

$s_services = <<<'HTML'
<section class="w-full bg-[#FAFAF7] py-space-3xl" id="services-detail">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter lg:gap-gutter-desktop mb-space-2xl">
      <div class="lg:col-span-4">
        <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-xs">CORE CAPABILITIES</span>
        <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal">Services</h2>
      </div>
      <div class="lg:col-span-8 flex items-end">
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Focused operational interventions. We build autonomy rather than perpetual retainers.</p>
      </div>
    </div>
    <!-- 3 Columns Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter lg:gap-gutter-desktop">
      <!-- Col 1: Operations Audit -->
      <div class="bg-surface-container-lowest p-space-xl flex flex-col justify-between">
        <div>
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-secondary block mb-space-md">01 · DIAGNOSTIC REVIEW</span>
          <h3 class="font-headline-md text-headline-md text-primary mb-space-md leading-tight">Operations Audit</h3>
          <p class="font-body-md text-body-md text-on-surface-variant mb-space-lg leading-relaxed">A two-week diagnostic shadowing live workflows to identify and catalog operational drag.</p>
        </div>
        <div class="pt-space-md">
          <a class="inline-flex items-center gap-space-xs font-body-sm text-body-sm text-primary hover:text-secondary group transition-colors" href="#">
            <span class="underline decoration-tertiary-fixed-dim underline-offset-4 group-hover:decoration-primary">Explore the Operations Audit</span>
            <span class="material-symbols-outlined text-primary transition-transform group-hover:translate-x-1" style="font-size:16px;">north_east</span>
          </a>
        </div>
      </div>
      <!-- Col 2: Process Redesign -->
      <div class="bg-surface-container-lowest p-space-xl flex flex-col justify-between">
        <div>
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-secondary block mb-space-md">02 · ARCHITECTURE</span>
          <h3 class="font-headline-md text-headline-md text-primary mb-space-md leading-tight">Process Redesign</h3>
          <p class="font-body-md text-body-md text-on-surface-variant mb-space-lg leading-relaxed">Clear handoffs and single-owner accountability frameworks your team actually adopts.</p>
        </div>
        <div class="pt-space-md">
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">CADENCE · 4 TO 6 WEEKS</span>
        </div>
      </div>
      <!-- Col 3: Systems & Tooling -->
      <div class="bg-surface-container-lowest p-space-xl flex flex-col justify-between">
        <div>
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-secondary block mb-space-md">03 · INFRASTRUCTURE</span>
          <h3 class="font-headline-md text-headline-md text-primary mb-space-md leading-tight">Systems and Tooling</h3>
          <p class="font-body-md text-body-md text-on-surface-variant mb-space-lg leading-relaxed">Eliminate software bloat and configure resilient integrations built around how you work.</p>
        </div>
        <div class="pt-space-md">
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">SCOPE · STACK REALIGNMENT</span>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;

$s_approach = <<<'HTML'
<section class="w-full bg-surface-container-low py-space-3xl" id="approach">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop">
    <div class="max-w-xl mb-space-2xl">
      <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-xs">METHODOLOGY</span>
      <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal">Our approach</h2>
      <p class="font-body-md text-body-md text-on-surface-variant mt-space-sm">
        A four-stage methodology calibrated to minimize organizational fatigue while driving structural clarity.
      </p>
    </div>
    <!-- 4 Horizontal Steps -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-space-lg">
      <!-- Step 1 -->
      <div class="bg-surface-container-lowest p-space-lg flex flex-col justify-between">
        <div>
          <div class="flex items-baseline justify-between mb-space-md">
            <span class="font-numeral-accent text-numeral-accent text-primary">01</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">DISCOVERY</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm">Listen</h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Direct, confidential interviews to identify hidden workflow blockers.</p>
        </div>
        <div class="pt-space-md mt-space-lg">
          <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-secondary" style="font-size:10px;">ALL TEAMS AUDITED</span>
        </div>
      </div>
      <!-- Step 2 -->
      <div class="bg-surface-container-lowest p-space-lg flex flex-col justify-between">
        <div>
          <div class="flex items-baseline justify-between mb-space-md">
            <span class="font-numeral-accent text-numeral-accent text-primary">02</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">MAPPING</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm">Map</h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Documenting how daily work actually moves across informal channels.</p>
        </div>
        <div class="pt-space-md mt-space-lg">
          <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-secondary" style="font-size:10px;">AS-IS BLUEPRINT</span>
        </div>
      </div>
      <!-- Step 3 -->
      <div class="bg-surface-container-lowest p-space-lg flex flex-col justify-between">
        <div>
          <div class="flex items-baseline justify-between mb-space-md">
            <span class="font-numeral-accent text-numeral-accent text-primary">03</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">SYNTHESIS</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm">Redesign</h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Targeting the high-leverage fixes instead of 100-page roadmaps.</p>
        </div>
        <div class="pt-space-md mt-space-lg">
          <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-secondary" style="font-size:10px;">HIGH-LEVERAGE FOCUS</span>
        </div>
      </div>
      <!-- Step 4 -->
      <div class="bg-surface-container-lowest p-space-lg flex flex-col justify-between">
        <div>
          <div class="flex items-baseline justify-between mb-space-md">
            <span class="font-numeral-accent text-numeral-accent text-primary">04</span>
            <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">RETENTION</span>
          </div>
          <h3 class="font-title-editorial text-title-editorial text-primary mb-space-sm">Embed</h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Training, documentation, and check-ins to make habits stick.</p>
        </div>
        <div class="pt-space-md mt-space-lg">
          <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-secondary" style="font-size:10px;">LONG-TERM ADOPTION</span>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;

$s_work = <<<'HTML'
<section class="w-full bg-[#FAFAF7] py-space-3xl" id="work">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop">
    <div class="flex flex-col md:flex-row md:items-end justify-between pb-space-lg mb-space-2xl">
      <div>
        <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-xs">DOSSIERS</span>
        <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal">Selected work</h2>
      </div>
      <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline mt-space-sm md:mt-0">ANONYMIZED ENGAGEMENTS</span>
    </div>
    <!-- 2 Editorial Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter lg:gap-gutter-desktop">
      <!-- Card 1 -->
      <article class="bg-surface-container-lowest p-space-xl flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between pb-space-sm mb-space-lg">
            <span class="font-label-editorial text-label-editorial text-secondary tracking-widest uppercase bg-surface-container-low px-space-sm py-1">Concept case study</span>
            <span class="font-label-editorial text-label-editorial uppercase text-outline">CASE // 041</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary mb-space-md">Regional logistics firm</h3>
          <div class="w-full bg-surface-container mb-space-lg overflow-hidden" style="aspect-ratio:16/9;">
            <img alt="warehouse operations" class="w-full h-full object-cover grayscale contrast-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxkUu9ghoEYCM-2YVCkB8iCYXn2MQxsDzPS04fFlUPY68AePPojXvr9L-3QudT6y6aTfusYlzHGG35kbtNT0SZjkXoxe9ZNM1mfpXxgagpvHHvyRDM1xpi2_S-Qsu4CTliUQMFcjoRxlccUs1g_4W3m_YlyWhuOVif9u7I6tjtPwMX5i0lbuZf2GbSt03KrNIbJSGkcPQV6a_6esVgoDF40tQgc9knsufsh2uny158">
          </div>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            Reworked order-to-dispatch handoffs between sales and the warehouse team, with one shared tracking board replacing four spreadsheets.
          </p>
        </div>
        <div class="pt-space-lg mt-space-lg flex items-center justify-between">
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">SECTOR: SUPPLY CHAIN · MCR</span>
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-primary font-medium">DISPATCH RESTRUCTURING</span>
        </div>
      </article>
      <!-- Card 2 -->
      <article class="bg-surface-container-lowest p-space-xl flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between pb-space-sm mb-space-lg">
            <span class="font-label-editorial text-label-editorial text-secondary tracking-widest uppercase bg-surface-container-low px-space-sm py-1">Concept case study</span>
            <span class="font-label-editorial text-label-editorial uppercase text-outline">CASE // 042</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary mb-space-md">Family-run manufacturer</h3>
          <div class="w-full bg-surface-container mb-space-lg overflow-hidden" style="aspect-ratio:16/9;">
            <img alt="team workshop office" class="w-full h-full object-cover grayscale contrast-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHF4FKnDgTo1QtSuHED8FhXL50mYpy9LzgZHS0AQcHeiEyXYsIlNJhx-geSgdbdARtovYv79u_PMWATZTnHwh3qJObyPGL2Dp5-ac1JpDq_mmz7kUeuA0UdeZ9F_5nFrFBYThmk5lNbCA6rjMSDq_44NR_PGIvEnXpcsaajomKzD0hcjsdJxjjXpqZZmqw66GaWT8r-9PqziIRpTOq68v4o1TmUpZvRz5IXhs6OOe8">
          </div>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            Created a weekly operating rhythm and clear decision owners so the founders could step back from day-to-day approvals.
          </p>
        </div>
        <div class="pt-space-lg mt-space-lg flex items-center justify-between">
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">SECTOR: PRECISION ENGINEERING · CHESHIRE</span>
          <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-primary font-medium">GOVERNANCE &amp; DELEGATION</span>
        </div>
      </article>
    </div>
  </div>
</section>
HTML;

$s_about = <<<'HTML'
<section class="w-full bg-surface-container-lowest py-space-3xl" id="about">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter lg:gap-gutter-desktop items-start">
      <!-- Left: Founder Photo -->
      <div class="lg:col-span-5 flex flex-col">
        <div class="bg-surface p-space-sm">
          <div class="relative w-full bg-surface-container overflow-hidden" style="aspect-ratio:4/5;">
            <img alt="Founder — stock image" class="w-full h-full object-cover grayscale" style="filter:grayscale(1) contrast(1.08);" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCebdvuJPKzNBxaXYRapIQd_Zo5hnl4x2435tfArr38rXwhRGzi9nL8UH72A1vYRX3NyK-8tbYQQzVR0fegzyaEACk-yOQsqjM4IPipTNRm2xuoor5baIfzNeoBMmA1GtkMOFg8uXRMxeivnUoKNmlwOAKf5Al_iSyKAa2JQ0CzvF7mNQ8HIHqL6VkzLTBfJqtcPbLaefkDQPN-WEO9xuYYurDCgxeRCTwBCQWbKfCx">
            <div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 px-space-sm py-0.5">
              <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline" style="font-size:10px;">FOUNDER · LEAD PRACTITIONER</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Right: Editorial Monograph -->
      <div class="lg:col-span-7 flex flex-col justify-between pt-space-md lg:pt-0">
        <div class="flex flex-col justify-between h-full">
          <div>
            <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-sm">PERSPECTIVE</span>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal mb-space-xl">Practitioners, not career theorists.</h2>
            <div class="bg-surface-container-low p-space-xl mb-space-2xl">
              <p class="font-headline-sm text-headline-sm text-primary italic leading-relaxed">"We work with a small number of clients at a time, led directly by operators who stay until changes stick."</p>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed">The healthiest businesses operate on fewer dashboards, simpler rules, and direct personal accountability.</p>
          </div>
          <div class="mt-space-2xl pt-space-md"></div>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;

$s_contact = <<<'HTML'
<section class="w-full bg-[#FAFAF7] py-space-3xl scroll-mt-24" id="contact">
  <div class="max-w-[1280px] w-full mx-auto px-gutter lg:px-margin-desktop">
    <div class="bg-surface-container-lowest p-space-xl lg:p-space-2xl">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter lg:gap-gutter-desktop">
        <!-- Left Explanatory Column -->
        <div class="lg:col-span-5 flex flex-col justify-between pr-0 lg:pr-space-lg">
          <div>
            <div class="flex items-center gap-space-sm mb-space-xs">
              <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">ENGAGEMENT BRIEF</span>
              <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-secondary">[ ACTIVE INTAKE ]</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal mb-space-md">
              Let's talk about what's slowing you down
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-space-lg">
              Every conversation begins with an unhurried, confidential 30-minute review of your current workflow friction. No high-pressure sales cadence. Just an honest evaluation of whether we are the right fit for your team.
            </p>
          </div>
          <div class="space-y-space-md pt-space-lg">
            <div>
              <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-xs">WHAT TO EXPECT</span>
              <ul class="space-y-space-xs font-body-sm text-body-sm text-on-surface">
                <li class="flex items-start gap-space-sm">
                  <span class="font-numeral-accent text-numeral-accent text-tertiary-fixed-dim" style="font-size:16px;line-height:1;">01</span>
                  <span>Direct diagnostic review with our principal operator.</span>
                </li>
                <li class="flex items-start gap-space-sm">
                  <span class="font-numeral-accent text-numeral-accent text-tertiary-fixed-dim" style="font-size:16px;line-height:1;">02</span>
                  <span>Strict confidentiality under standard NDA terms.</span>
                </li>
                <li class="flex items-start gap-space-sm">
                  <span class="font-numeral-accent text-numeral-accent text-tertiary-fixed-dim" style="font-size:16px;line-height:1;">03</span>
                  <span>Clear go/no-go recommendation within 48 hours.</span>
                </li>
              </ul>
            </div>
            <div class="pt-space-md">
              <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline block" style="font-size:11px;">DIRECT PROTOCOL:</span>
              <span class="font-body-sm text-body-sm text-primary font-medium">0161 496 0123 · hello@northline.demo</span>
            </div>
          </div>
        </div>
        <!-- Right Form Column -->
        <div class="lg:col-span-7 mt-space-xl lg:mt-0">
          <form class="space-y-space-md" id="discovery-form" onsubmit="event.preventDefault(); document.getElementById('discovery-form').style.display='none'; document.getElementById('form-success').style.display='flex';">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
              <div class="flex flex-col space-y-space-xs">
                <label class="font-body-sm text-body-sm font-medium text-primary" for="contact-name">Full Name <span class="text-tertiary-fixed-dim">*</span></label>
                <input class="w-full bg-[#FAFAF7] text-primary font-body-md text-body-md px-space-md py-space-sm focus:outline-none focus:bg-surface-container-low transition-colors border border-outline/40 focus:border-primary" id="contact-name" name="name" placeholder="e.g. Alistair Finch" required type="text">
              </div>
              <div class="flex flex-col space-y-space-xs">
                <label class="font-body-sm text-body-sm font-medium text-primary" for="contact-email">Work Email <span class="text-tertiary-fixed-dim">*</span></label>
                <input class="w-full bg-[#FAFAF7] text-primary font-body-md text-body-md px-space-md py-space-sm focus:outline-none focus:bg-surface-container-low transition-colors border border-outline/40 focus:border-primary" id="contact-email" name="email" placeholder="a.finch@company.co.uk" required type="email">
              </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
              <div class="flex flex-col space-y-space-xs">
                <label class="font-body-sm text-body-sm font-medium text-primary" for="contact-company">Company <span class="text-tertiary-fixed-dim">*</span></label>
                <input class="w-full bg-[#FAFAF7] text-primary font-body-md text-body-md px-space-md py-space-sm focus:outline-none focus:bg-surface-container-low transition-colors border border-outline/40 focus:border-primary" id="contact-company" name="company" placeholder="e.g. Finch Logistics Ltd" required type="text">
              </div>
              <div class="flex flex-col space-y-space-xs">
                <label class="font-body-sm text-body-sm font-medium text-primary" for="company-size">Company Size</label>
                <select class="w-full bg-[#FAFAF7] text-primary font-body-md text-body-md px-space-md py-space-sm focus:outline-none focus:bg-surface-container-low transition-colors border border-outline/40 focus:border-primary" id="company-size" name="size">
                  <option value="1 to 19">1 to 19</option>
                  <option selected value="20 to 49">20 to 49</option>
                  <option value="50 to 199">50 to 199</option>
                  <option value="200+">200+</option>
                </select>
              </div>
            </div>
            <div class="flex flex-col space-y-space-xs">
              <label class="font-body-sm text-body-sm font-medium text-primary" for="main-challenge">Primary Operational Friction</label>
              <select class="w-full bg-[#FAFAF7] text-primary font-body-md text-body-md px-space-md py-space-sm focus:outline-none focus:bg-surface-container-low transition-colors border border-outline/40 focus:border-primary" id="main-challenge" name="challenge">
                <option value="Process">Process (handoffs, broken workflows, manual gaps)</option>
                <option value="Team structure">Team structure (decision bottlenecks, role confusion)</option>
                <option value="Tools">Tools (disconnected software, spreadsheet overload)</option>
                <option value="Not sure yet">Not sure yet (general friction or scaling ceiling)</option>
              </select>
            </div>
            <div class="flex flex-col space-y-space-xs">
              <label class="font-body-sm text-body-sm font-medium text-primary" for="contact-message">Describe the bottleneck briefly</label>
              <textarea class="w-full bg-[#FAFAF7] text-primary font-body-md text-body-md px-space-md py-space-sm focus:outline-none focus:bg-surface-container-low transition-colors resize-y border border-outline/40 focus:border-primary" id="contact-message" name="message" placeholder="Where do handoffs fail today? What happens when you or key staff take time away?" rows="4"></textarea>
            </div>
            <div class="pt-space-sm flex flex-col sm:flex-row sm:items-center justify-between gap-space-md">
              <button class="inline-flex items-center justify-center bg-primary-container text-surface-container-lowest font-label-editorial text-label-editorial uppercase tracking-widest px-space-xl py-space-md hover:bg-primary transition-colors cursor-pointer" type="submit">
                Request a Call
              </button>
              <span class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline" style="font-size:11px;">RESPONSE PROMISE: WITHIN 24 HOURS</span>
            </div>
          </form>
          <!-- Success State -->
          <div style="display:none;min-height:360px;" class="bg-surface-container-low p-space-xl flex flex-col justify-between" id="form-success">
            <div>
              <div class="flex items-center gap-space-sm mb-space-md">
                <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-secondary font-medium">[ TRANSMISSION CONFIRMED ]</span>
                <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">REF: NL-INTAKE-OK</span>
              </div>
              <h3 class="font-headline-md text-headline-md text-primary mb-space-sm">Transmission Received</h3>
              <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                Thanks. We'll reply within one working day to arrange a 30-minute call.
              </p>
              <p class="font-body-sm text-body-sm text-outline mt-space-md">
                We review every brief internally before proposing times to ensure your initial 30 minutes are spent productively.
              </p>
            </div>
            <div class="pt-space-lg">
              <button class="font-label-editorial text-label-editorial uppercase tracking-widest text-primary underline decoration-tertiary-fixed-dim underline-offset-4 hover:decoration-primary" onclick="document.getElementById('form-success').style.display='none'; document.getElementById('discovery-form').style.display='block';" type="button">
                Submit another inquiry →
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
HTML;

$s_footer = <<<'HTML'
<footer class="w-full bg-[#FAFAF7] border-t border-outline-variant/40" style="margin-top:0;">
  <div class="max-w-[1280px] mx-auto px-gutter lg:px-margin-desktop py-space-2xl">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter-desktop pb-space-2xl border-b border-outline-variant/30">
      <div class="md:col-span-4 flex flex-col justify-between space-y-space-md">
        <div>
          <span class="font-headline-sm text-headline-sm text-primary block">Northline</span>
          <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">Operations Consultancy · Manchester, UK</p>
        </div>
        <div class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline">© 2024 Northline Operations. All rights reserved.</div>
      </div>
      <div class="md:col-span-4 space-y-space-sm">
        <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-sm">Inquiries &amp; Studio</span>
        <p class="font-body-sm text-body-sm text-on-surface"><span class="text-outline block">Phone</span> 0161 496 0123</p>
        <p class="font-body-sm text-body-sm text-on-surface"><span class="text-outline block">Email</span> hello@northline.demo</p>
        <p class="font-body-sm text-body-sm text-on-surface"><span class="text-outline block">Location</span> Manchester, UK</p>
      </div>
      <div class="md:col-span-4 space-y-space-sm">
        <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline block mb-space-sm">Network</span>
        <ul class="space-y-space-xs">
          <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors underline decoration-outline-variant underline-offset-4" href="#">LinkedIn</a></li>
          <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Operations Audit Protocol</a></li>
          <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Selected Client Dossiers</a></li>
        </ul>
      </div>
    </div>
    <div class="pt-space-lg flex flex-col sm:flex-row items-baseline justify-between gap-space-md">
      <p class="font-label-editorial text-label-editorial uppercase tracking-wider text-outline">Concept project. Brand, people, prices and reviews are fictional.</p>
      <span class="font-label-editorial text-label-editorial uppercase tracking-widest text-outline/80">MCR · ARCHIVAL REF 0161</span>
    </div>
  </div>
</footer>
HTML;

// ===========================================================================
// BUILD ELEMENTOR JSON
// ===========================================================================

function nl_container( $id, array $elements, array $extra_settings = [] ) {
	return array_merge( [
		'id'       => $id,
		'elType'   => 'container',
		'isInner'  => false,
		'settings' => array_merge( [
			'flex_direction'   => 'column',
			'flex_wrap'        => 'nowrap',
			'content_width'    => 'full',
			'gap'              => [ 'column' => '', 'row' => '', 'unit' => 'px' ],
			'padding'          => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
			'margin'           => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ],
			'min_height'       => [ 'unit' => 'px', 'size' => '', 'sizes' => [] ],
			'width'            => [ 'unit' => '%', 'size' => 100 ],
		], $extra_settings ),
		'elements' => $elements,
	] );
}

function nl_html_widget( $id, $html ) {
	return [
		'id'               => $id,
		'elType'           => 'widget',
		'isInner'          => false,
		'widgetType'       => 'html',
		'settings'         => [ 'html' => $html ],
		'defaultEditSettings' => [],
		'elements'         => [],
	];
}

$id = 1000;
$next = function() use (&$id) {
	return sprintf( '%07x', $id++ );
};

$elementor_data = [
	nl_container( $next(), [ nl_html_widget( $next(), $s_header ) ], [ 'background_color' => '#FAFAF7' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_hero ) ],   [ 'background_color' => '#FAFAF7' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_familiar ) ], [ 'background_color' => '#ffffff' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_services ) ], [ 'background_color' => '#FAFAF7' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_approach ) ], [ 'background_color' => '#f0f3ff' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_work ) ],    [ 'background_color' => '#FAFAF7' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_about ) ],   [ 'background_color' => '#ffffff' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_contact ) ], [ 'background_color' => '#FAFAF7' ] ),
	nl_container( $next(), [ nl_html_widget( $next(), $s_footer ) ],  [ 'background_color' => '#FAFAF7' ] ),
];

$elementor_json = wp_json_encode( $elementor_data );

$page_settings = wp_json_encode( [
	'custom_css' => '
/* Northline canvas fix */
body { background:#f9f9ff !important; }
.elementor-widget-html { display:block; width:100%; }
.elementor-widget-container { padding:0 !important; }
e-con.e-con-full { max-width:100% !important; }
',
] );

// ===========================================================================
// CREATE OR UPDATE HOME PAGE
// ===========================================================================

$page_id = null;

// Look for existing page titled "Home" or "Marlow House" or the current front page
$front_page_id = (int) get_option( 'page_on_front' );
if ( $front_page_id ) {
	$front_page = get_post( $front_page_id );
	if ( $front_page && $front_page->post_status === 'publish' ) {
		$page_id = $front_page_id;
	}
}

if ( ! $page_id ) {
	$existing = get_page_by_title( 'Home', OBJECT, 'page' );
	if ( $existing ) {
		$page_id = $existing->ID;
	}
}

if ( ! $page_id ) {
	$page_id = wp_insert_post( [
		'post_title'  => 'Home',
		'post_name'   => 'home',
		'post_status' => 'publish',
		'post_type'   => 'page',
	], true );

	if ( is_wp_error( $page_id ) ) {
		$log[] = '❌ Could not create page: ' . $page_id->get_error_message();
		$page_id = null;
	} else {
		$log[] = '✅ Created page ID ' . $page_id;
	}
} else {
	wp_update_post( [ 'ID' => $page_id, 'post_status' => 'publish', 'post_title' => 'Home' ] );
	$log[] = '✅ Using existing page ID ' . $page_id;
}

if ( $page_id ) {
	// Set Elementor data
	update_post_meta( $page_id, '_elementor_data',          $elementor_json );
	update_post_meta( $page_id, '_elementor_edit_mode',     'builder' );
	update_post_meta( $page_id, '_elementor_template_type', 'page' );
	update_post_meta( $page_id, '_elementor_page_settings', $page_settings );
	update_post_meta( $page_id, '_wp_page_template',        'elementor_canvas' );

	$log[] = '✅ Elementor data saved to page ' . $page_id;

	// Set as front page
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $page_id );
	$log[] = '✅ Set page ' . $page_id . ' as site front page';

	// Flush Elementor cache for this post
	if ( class_exists( '\Elementor\Plugin' ) ) {
		\Elementor\Plugin::$instance->files_manager->clear_cache();
		$log[] = '✅ Elementor cache cleared';
	}
}

// ===========================================================================
// ELEMENTOR KIT: GLOBAL COLORS + FONTS
// ===========================================================================

$kit_id = get_option( 'elementor_active_kit' );
if ( $kit_id ) {
	$global_colors = [
		[ '_id' => 'nl-primary',          'title' => 'NL Primary',          'color' => '#000a24' ],
		[ '_id' => 'nl-primary-ink',      'title' => 'NL Primary Ink',      'color' => '#14213d' ],
		[ '_id' => 'nl-secondary',        'title' => 'NL Secondary',        'color' => '#006a60' ],
		[ '_id' => 'nl-surface',          'title' => 'NL Surface',          'color' => '#f9f9ff' ],
		[ '_id' => 'nl-surface-white',    'title' => 'NL Surface White',    'color' => '#ffffff' ],
		[ '_id' => 'nl-surface-low',      'title' => 'NL Surface Low',      'color' => '#f0f3ff' ],
		[ '_id' => 'nl-surface-med',      'title' => 'NL Surface Med',      'color' => '#e7eefe' ],
		[ '_id' => 'nl-on-surface',       'title' => 'NL On Surface',       'color' => '#151c27' ],
		[ '_id' => 'nl-on-surface-var',   'title' => 'NL On Surface Var',   'color' => '#45464d' ],
		[ '_id' => 'nl-outline',          'title' => 'NL Outline',          'color' => '#75777e' ],
		[ '_id' => 'nl-outline-var',      'title' => 'NL Outline Var',      'color' => '#c5c6ce' ],
		[ '_id' => 'nl-sand',             'title' => 'NL Sand Accent',      'color' => '#e7c268' ],
	];

	$global_fonts = [
		[
			'_id'                        => 'nl-display-xl',
			'title'                      => 'Display XL',
			'typography_typography'      => 'custom',
			'typography_font_family'     => 'Newsreader',
			'typography_font_size'       => [ 'unit' => 'px', 'size' => 56 ],
			'typography_line_height'     => [ 'unit' => 'em', 'size' => 1.14 ],
			'typography_letter_spacing'  => [ 'unit' => 'em', 'size' => -0.02 ],
			'typography_font_weight'     => '400',
		],
		[
			'_id'                        => 'nl-headline-lg',
			'title'                      => 'Headline LG',
			'typography_typography'      => 'custom',
			'typography_font_family'     => 'Newsreader',
			'typography_font_size'       => [ 'unit' => 'px', 'size' => 40 ],
			'typography_line_height'     => [ 'unit' => 'em', 'size' => 1.2 ],
			'typography_letter_spacing'  => [ 'unit' => 'em', 'size' => -0.015 ],
			'typography_font_weight'     => '400',
		],
		[
			'_id'                        => 'nl-headline-md',
			'title'                      => 'Headline MD',
			'typography_typography'      => 'custom',
			'typography_font_family'     => 'Newsreader',
			'typography_font_size'       => [ 'unit' => 'px', 'size' => 28 ],
			'typography_line_height'     => [ 'unit' => 'em', 'size' => 1.29 ],
			'typography_letter_spacing'  => [ 'unit' => 'em', 'size' => -0.01 ],
			'typography_font_weight'     => '400',
		],
		[
			'_id'                        => 'nl-body-md',
			'title'                      => 'Body MD',
			'typography_typography'      => 'custom',
			'typography_font_family'     => 'DM Sans',
			'typography_font_size'       => [ 'unit' => 'px', 'size' => 15 ],
			'typography_line_height'     => [ 'unit' => 'em', 'size' => 1.6 ],
			'typography_font_weight'     => '400',
		],
		[
			'_id'                        => 'nl-label',
			'title'                      => 'Label Editorial',
			'typography_typography'      => 'custom',
			'typography_font_family'     => 'DM Sans',
			'typography_font_size'       => [ 'unit' => 'px', 'size' => 11 ],
			'typography_line_height'     => [ 'unit' => 'em', 'size' => 1.45 ],
			'typography_letter_spacing'  => [ 'unit' => 'em', 'size' => 0.08 ],
			'typography_font_weight'     => '500',
		],
	];

	// Merge with existing kit settings to avoid overwriting other settings
	$existing_kit = get_post_meta( $kit_id, '_elementor_page_settings', true );
	$kit_settings = $existing_kit ? json_decode( $existing_kit, true ) : [];
	if ( ! is_array( $kit_settings ) ) {
		$kit_settings = [];
	}
	$kit_settings['custom_colors']     = $global_colors;
	$kit_settings['custom_typography'] = $global_fonts;

	update_post_meta( $kit_id, '_elementor_page_settings', wp_json_encode( $kit_settings ) );

	$log[] = '✅ Elementor Kit (' . $kit_id . ') global colors + fonts saved';
}

// ===========================================================================
// OUTPUT
// ===========================================================================
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Northline Setup</title>
  <style>
    body { font-family: system-ui, sans-serif; padding: 2rem; background: #f5f5f5; }
    h1 { color: #14213d; }
    .log { background: #fff; border: 1px solid #ddd; padding: 1rem; border-radius: 4px; }
    .log p { margin: 0.25rem 0; font-size: 14px; }
    .ok { color: #006a60; }
    .err { color: #ba1a1a; }
    .btn { display:inline-block; margin-top:1rem; background:#14213d; color:#fff; padding:.75rem 1.5rem; text-decoration:none; font-size:13px; letter-spacing:.08em; text-transform:uppercase; }
  </style>
</head>
<body>
  <h1>Northline Setup</h1>
  <div class="log">
    <?php foreach ( $log as $entry ) : ?>
      <p class="<?= strpos( $entry, '❌' ) !== false ? 'err' : 'ok' ?>"><?= esc_html( $entry ) ?></p>
    <?php endforeach; ?>
  </div>
  <?php if ( $page_id ) : ?>
    <a class="btn" href="<?= get_permalink( $page_id ) ?>">View Landing Page →</a>
    <p style="margin-top:1rem;font-size:13px;color:#666;">
      ⚠️ Delete <code>northline-setup.php</code> after confirming the page looks correct.
    </p>
  <?php endif; ?>
</body>
</html>
