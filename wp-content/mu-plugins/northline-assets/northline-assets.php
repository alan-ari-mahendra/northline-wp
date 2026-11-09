<?php
/**
 * Northline Landing Page – Asset Loader
 * Loads Tailwind CDN, Google Fonts, Material Symbols on the front page only.
 */

add_action( 'wp_head', function () {
	if ( ! is_front_page() && ! is_home() ) {
		return;
	}
	echo '<!-- nl-assets -->' . "\n";
	?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "surface-dim": "#d3daea",
        "outline-variant": "#c5c6ce",
        "on-error-container": "#93000a",
        "background": "#f9f9ff",
        "on-secondary-container": "#007166",
        "on-background": "#151c27",
        "surface-bright": "#f9f9ff",
        "on-surface": "#151c27",
        "surface-tint": "#525e7d",
        "surface": "#f9f9ff",
        "on-primary-fixed-variant": "#3a4664",
        "surface-container": "#e7eefe",
        "on-tertiary-fixed": "#251a00",
        "inverse-on-surface": "#ebf1ff",
        "on-primary-container": "#7c89aa",
        "primary-container": "#14213d",
        "error-container": "#ffdad6",
        "surface-container-highest": "#dce2f3",
        "on-secondary-fixed-variant": "#005048",
        "error": "#ba1a1a",
        "surface-container-high": "#e2e8f8",
        "surface-container-lowest": "#ffffff",
        "primary-fixed": "#d9e2ff",
        "inverse-surface": "#2a313d",
        "secondary": "#006a60",
        "tertiary-fixed": "#ffdf96",
        "on-primary-fixed": "#0d1b36",
        "outline": "#75777e",
        "on-tertiary": "#ffffff",
        "on-tertiary-container": "#a58532",
        "inverse-primary": "#b9c6ea",
        "primary-fixed-dim": "#b9c6ea",
        "on-secondary-fixed": "#00201c",
        "secondary-fixed": "#8cf5e4",
        "tertiary-fixed-dim": "#e7c268",
        "surface-variant": "#dce2f3",
        "tertiary-container": "#2c2000",
        "secondary-container": "#8cf5e4",
        "surface-container-low": "#f0f3ff",
        "on-tertiary-fixed-variant": "#5a4400",
        "on-surface-variant": "#45464d",
        "on-primary": "#ffffff",
        "primary": "#000a24",
        "tertiary": "#110a00",
        "on-secondary": "#ffffff",
        "on-error": "#ffffff",
        "secondary-fixed-dim": "#6fd8c8"
      },
      borderRadius: {
        DEFAULT: "0.25rem",
        lg: "0.5rem",
        xl: "0.75rem",
        full: "9999px"
      },
      spacing: {
        "space-sm": "0.5rem",
        "margin": "1.25rem",
        "gutter-desktop": "2.5rem",
        "space-3xl": "6rem",
        "space-md": "1rem",
        "space-xl": "2.5rem",
        "gutter": "1.5rem",
        "space-2xl": "4rem",
        "space-xs": "0.25rem",
        "margin-desktop": "4rem",
        "space-lg": "1.5rem"
      },
      fontFamily: {
        "headline-lg-mobile": ["Newsreader", "serif"],
        "body-sm": ["DM Sans", "sans-serif"],
        "headline-md": ["Newsreader", "serif"],
        "headline-sm": ["Newsreader", "serif"],
        "title-editorial": ["Newsreader", "serif"],
        "label-editorial": ["DM Sans", "sans-serif"],
        "numeral-accent": ["Newsreader", "serif"],
        "body-lg": ["DM Sans", "sans-serif"],
        "display-xl-mobile": ["Newsreader", "serif"],
        "headline-lg": ["Newsreader", "serif"],
        "display-xl": ["Newsreader", "serif"],
        "body-md": ["DM Sans", "sans-serif"]
      },
      fontSize: {
        "headline-lg-mobile": ["30px", {lineHeight: "38px", letterSpacing: "-0.01em", fontWeight: "400"}],
        "body-sm": ["13px", {lineHeight: "20px", fontWeight: "400"}],
        "headline-md": ["28px", {lineHeight: "36px", letterSpacing: "-0.01em", fontWeight: "400"}],
        "headline-sm": ["22px", {lineHeight: "30px", fontWeight: "400"}],
        "title-editorial": ["18px", {lineHeight: "26px", letterSpacing: "0.01em", fontWeight: "400"}],
        "label-editorial": ["11px", {lineHeight: "16px", letterSpacing: "0.08em", fontWeight: "500"}],
        "numeral-accent": ["24px", {lineHeight: "28px", letterSpacing: "0.02em", fontWeight: "400"}],
        "body-lg": ["18px", {lineHeight: "28px", fontWeight: "400"}],
        "display-xl-mobile": ["38px", {lineHeight: "46px", letterSpacing: "-0.015em", fontWeight: "400"}],
        "headline-lg": ["40px", {lineHeight: "48px", letterSpacing: "-0.015em", fontWeight: "400"}],
        "display-xl": ["56px", {lineHeight: "64px", letterSpacing: "-0.02em", fontWeight: "400"}],
        "body-md": ["15px", {lineHeight: "24px", fontWeight: "400"}]
      }
    }
  }
};
</script>
<style>
/* ======================================================
   Northline Canvas Overrides
   ====================================================== */
body.elementor-template-canvas,
body.elementor-template-canvas .site,
body.elementor-template-canvas #page {
  background: #f9f9ff !important;
  margin: 0 !important;
  padding: 0 !important;
}
.elementor.elementor-page,
.elementor-section-wrap {
  padding: 0 !important;
  margin: 0 !important;
}
.elementor-widget-html {
  width: 100% !important;
  display: block !important;
}
.elementor-widget-container {
  width: 100% !important;
}
/* Prevent Twenty Twenty-Five base styles from conflicting */
.wp-site-blocks {
  display: none !important;
}
body:not(.wp-admin) .wp-site-blocks ~ * {
  display: block;
}
/* Tailwind base overrides for Elementor canvas */
*, *::before, *::after {
  box-sizing: border-box;
}
/* Smooth scrolling for anchor links */
html {
  scroll-behavior: smooth;
}
/* Material Symbols sizing */
.material-symbols-outlined {
  font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 20;
}
/* aspect-ratio containers: img must be absolute to fill correctly */
[style*="aspect-ratio"] {
  position: relative;
}
[style*="aspect-ratio"] > img {
  position: absolute !important;
  top: 0; left: 0;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block;
}
</style>
	<?php
}, 1 );
